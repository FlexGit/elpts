<?php

namespace App\Http\Controllers;

use Session;
use App\Doctypes;
use App\Docs;
use App\Users;
use App\Settings;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// Create Docs Object
		$docs_obj = new Docs;

		// Get Settings Object
		$settings_obj = new Settings;

		// Get Users Object
		$users_obj = new Users;

		// Get Doctypes
        $doctypes = Doctypes::where('enable', '1')->get();

		// Get Roles
		$roles = $users_obj->getRoles(1);

		// Get Rights
		$rights = $settings_obj->getRights();

        // Get Docs Fields Roles Rights
		$docs_fields_roles_rights = $settings_obj->getDocsFieldsRolesRights();

        // Get Only Doc User Fields
        if (count($doctypes) > 0)
        {
        	foreach($doctypes as $doctype)
        	{
        		$docs_fields[$doctype->id] = $docs_obj->getDocsFields($doctype->id, true);
        	}
        }

        // Get Settings
		$settings = Settings::where('enable', 1)->orderBy('id')->get();
	
		// Get Statuses
		$statuses = $docs_obj->getStatuses();
	
		return view('settings.index')
        	->withSettings($settings)
        	->withDoctypes($doctypes)
        	->with('roles', $roles)
        	->with('rights', $rights)
        	->with('docs_fields', $docs_fields)
			->with('statuses', $statuses)
        	->with('docs_fields_roles_rights', $docs_fields_roles_rights);
    }
	
	/**
	 * Store Email Notifications.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function storeNotifications(Request $request)
	{
		// Create Docs Object
		$docs_obj = new Docs;

		// Get Statuses
		$statuses = $docs_obj->getStatuses();

		// Get Settings Object
		$settings_obj = new Settings;

		// Save Statuses Notifications
		$settings_obj->storeStatusesNotifications($statuses, $request->all());

		return redirect('/settings')
			->with('success','Уведомления успешно сохранены!');
	}
	
	/**
	 * Store Fields Roles Rights.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
    {
		// Create Docs Object
		$docs_obj = new Docs;

		// Get Users Object
		$users_obj = new Users;

		// Get Settings Object
		$settings_obj = new Settings;

		// Get Roles
		$roles = $users_obj->getRoles(1);

		// Get Doctypes
        $doctypes = Doctypes::where('enable', '1')->get();
        
        // Get Only Doc User Fields
        if (count($doctypes) > 0)
        {
        	foreach($doctypes as $doctype)
        	{
        		$docs_fields = $docs_obj->getDocsFields($doctype->id, true);

				// Save Docs Fields Roles Rights
				$settings_obj->storeDocsFieldsRolesRights($docs_fields, $roles, $request->all());
        	}
        }

		return redirect('/settings')
			->with('success','Права доступа успешно сохранены!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		// Get Setting
        $setting = Settings::findOrFail($id);

		$posible_values_arr = explode(';', $setting['posible_values']);

		if(empty($setting))
		{
			abort(404);
		}

        return view('settings.edit')
        	->withSetting($setting)
        	->with('posible_values_arr', $posible_values_arr)
        	->with('id', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		// Prepare Validation Rules
		$rules = array(
		    'value' => 'required',
		);

	    // Request Validation
		$this->validate($request, $rules);

		// Save Setting
		$setting = Settings::findOrFail($id);
		$setting->value = $request->value;
		$setting->save();

		return redirect('/settings')->with('success','Настройка успешно сохранена!');
    }
}
