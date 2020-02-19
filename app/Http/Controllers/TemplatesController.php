<?php

namespace App\Http\Controllers;

use Session;
use App\Doctypes;
use App\Prefixes;
use App\Users;
use App\Templates;
use Illuminate\Http\Request;

class TemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $doctypes_id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $doctypes_id)
    {
		if($doctypes_id == 'archive') {
			Session::put('archive', '1');
			$doctypes_id = 1;
		} else {
			Session::forget('archive');
		}
		
		//\Log::Debug(Session::get('archive'));
	
        $rows_quantity = 30;
		if(Session::has('settings_rows_quantity'))
		{
			$rows_quantity = Session::get('settings_rows_quantity');
		}

		// Get Templates
        $templates = Templates::whereIn('doctypes_id', [0,$doctypes_id])->orderBy('id', 'asc')->paginate($rows_quantity);

		// Get Doctypes
        $doctypes = Doctypes::get();
		$doctype = $doctypes->first(function($item) use ($doctypes_id) {
			return $item->id == $doctypes_id;
		});

		if(empty($templates) || empty($doctype))
		{
			abort(404);
		}

		$page = $request->page;
		if(!isset($request->page)) $page = 1;

        return view('templates.index')
       		->withTemplates($templates)
       		->withDoctypes($doctypes)
       		->with('doctypes_id', $doctypes_id)
       		->with('doctype', $doctype)
       		->with('rows_quantity', $rows_quantity)
       		->withRequest($request)
       		->with('page', $page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $doctypes_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $doctypes_id, $id)
    {
		// Get Template
        $template = Templates::findOrFail($id);

		// Get Doctypes
        $doctypes = Doctypes::get();
		$doctype = $doctypes->first(function($item) use ($doctypes_id) {
			return $item->id == $doctypes_id;
		});

		if(empty($template) || empty($doctype))
		{
			abort(404);
		}

		// Get Prefixes
        $prefixes = Prefixes::where([
			        	['enable', '=', '1'],
			        	['doctypes_id', '=', $doctypes_id],
			        ])
			        ->get();

		// Get Users
        $users = Users::where('enable', '1')->orderBy('name')->get();

		// Get Roles
		$users_obj = new Users;
		$roles = $users_obj->getRoles($doctypes_id);
		$template_users_roles = $users_obj->getTemplateUsersRoles($id);

		// Get Template Fields
		$template_fields_obj = new Templates;
		$template_fields = $template_fields_obj->getTemplateFields($doctypes_id);

		// Get Template Header Fields
		$template_header_fields = [];
		if (count($template_fields) > 0)
		{
			foreach ($template_fields->all() as $template_field)
			{
				if ($template_field->parent_id)
				{
					continue;
				}

				$template_header_fields[$template_field->id] = [
					'name' => $template_field->name,
					'short_name' => $template_field->short_name
				];
			}
		}
		
		// Get Template Fields Values
		$template_values_arr = $template_fields_obj->getTemplateFieldsValues($id);

        return view('templates.edit')
        	->withTemplate($template)
        	->with('prefixes', $prefixes)
        	->with('users', $users)
        	->with('roles', $roles)
        	->with('doctype', $doctype)
        	->with('template_fields', $template_fields)
        	->with('template_header_fields', $template_header_fields)
        	->with('template_values', $template_values_arr)
        	->with('template_users_roles', $template_users_roles)
        	->with('doctypes_id', $doctypes_id)
        	->with('id', $id)
        	->withRequest($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $doctypes_id
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $doctypes_id)
    {
		// Get Doctypes
        $doctypes = Doctypes::get();
		$doctype = $doctypes->first(function($item) use ($doctypes_id) {
			return $item->id == $doctypes_id;
		});

		if(empty($doctype))
		{
			abort(404);
		}

		// Get Prefixes
        $prefixes = Prefixes::where([
			        	['enable', '=', '1'],
			        	['doctypes_id', '=', $doctypes_id],
			        ])
			        ->get();

		// Get Users
        $users = Users::where('enable', '1')->orderBy('name')->get();

		// Get Roles
		$users_obj = new Users;
		$roles = $users_obj->getRoles($doctypes_id);

		// Get Template Fields
		$template_fields_obj = new Templates;
		$template_fields = $template_fields_obj->getTemplateFields($doctypes_id);

		// Get Template Header Fields
		$template_header_fields = [];
		if (count($template_fields) > 0)
		{
			foreach ($template_fields->all() as $template_field)
			{
				if ($template_field->parent_id)
				{
					continue;
				}

				$template_header_fields[$template_field->id] = [
					'name' => $template_field->name,
					'short_name' => $template_field->short_name
				];
			}
		}

        return view('templates.create')
        	->with('prefixes', $prefixes)
        	->with('users', $users)
        	->with('roles', $roles)
        	->with('doctype', $doctype)
        	->with('template_fields', $template_fields)
        	->with('template_header_fields', $template_header_fields)
        	->with('doctypes_id', $doctypes_id)
        	->withRequest($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $doctypes_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($doctypes_id, Request $request)
    {
		$template_fields_obj = new Templates;
		$users_obj = new Users;

		// Get Template Fields
		$template_fields = $template_fields_obj->getTemplateFields($doctypes_id);

		// Get Users
        $users = Users::where('enable', '1')->orderBy('name')->get();

		// Get Roles
		$roles = $users_obj->getRoles($doctypes_id);

		// Prepare Validation Rules
		$rules = [];
		$rules['name'] = 'required';
		if (count($template_fields) > 0)
		{
        	foreach ($template_fields->all() as $template_field)
        	{
   				if ($template_field->type == 'header')
   				{
   					continue;
   				}

				$key = 'template_field'.$template_field->id;

				if($template_field->required == 1)
				{
   					$rules[$key] = 'required';
   				}

   				if($template_field->valid_rules)
   				{
   					if(!empty($rules[$key]))
   					{
   						$rules[$key] .= '|'.$template_field->valid_rules;
   					}
   					else
   					{
   						$rules[$key] = $template_field->valid_rules;
   					}
   				}
        	}
        }

	    // Request Validation
		$this->validate($request, $rules);

		// Save Template
		$template = new Templates;
		$template->name = $request->name;
		$template->doctypes_id = $doctypes_id;
		$template->enable = $request->enable;
		$template->enable_closed = $request->enable_closed;
		$template->no_accept = $request->no_accept;
		$template->save();
		$templates_id = $template->id;

		// Save Template Fields Values
		$template_fields_obj->storeTemplateFieldsValues($templates_id, $template_fields, $request->all());

		// Save Template Users Roles
		$users_obj->storeTemplatesUsersRoles($templates_id, $users, $roles, $request->all());

		return redirect('/templates/'.$doctypes_id.'?page='.$request->page)
			->with('success','Шаблон успешно сохранен!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $doctypes_id
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($doctypes_id, Request $request, $id)
    {
		$template_fields_obj = new Templates;
		$users_obj = new Users;

		// Get Template Fields
		$template_fields = $template_fields_obj->getTemplateFields($doctypes_id);

		// Get Users
		$users = Users::all();

		// Get Roles
		$roles = $users_obj->getRoles($doctypes_id);

		// Prepare Validation Rules
		$rules = [];
		$rules['name'] = 'required';
		if (count($template_fields) > 0)
		{
        	foreach ($template_fields->all() as $template_field)
        	{
   				if ($template_field->type == 'header')
   				{
   					continue;
   				}

				$key = 'template_field'.$template_field->id;

				if($template_field->required == 1)
				{
   					$rules[$key] = 'required';
   				}

   				if($template_field->valid_rules)
   				{
   					if(!empty($rules[$key]))
   					{
   						$rules[$key] .= '|'.$template_field->valid_rules;
   					}
   					else
   					{
   						$rules[$key] = $template_field->valid_rules;
   					}
   				}
        	}
        }

	    // Request Validation
		$this->validate($request, $rules);

		// Save Template
		$template = Templates::findOrFail($id);
		$template->name = $request->name;
		$template->enable = $request->enable;
		$template->enable_closed = $request->enable_closed;
		$template->no_accept = $request->no_accept;
		$template->save();

		// Save Template Fields Values
		$template_fields_obj->updateTemplateFieldsValues($id, $template_fields, $request->all());

		// Save Template Users Roles
		$users_obj->storeTemplatesUsersRoles($id, $users, $roles, $request->all());

		return redirect('/templates/'.$doctypes_id.'?page='.$request->page)
			->with('success','Шаблон успешно сохранен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $doctypes_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(Request $request, $doctypes_id, $id)
    {
		if(empty($doctypes_id) || empty($id))
		{
			abort(404);
		}

        // Remove Template
  		Templates::destroy($id);

		$template_fields_obj = new Templates;
		$template_fields_obj->deleteTemplateFieldsValues($id);

		return redirect('/templates/'.$doctypes_id.'?page='.$request->page)
			->with('success','Запись успешно удалена!');
    }*/
}
