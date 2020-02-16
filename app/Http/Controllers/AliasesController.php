<?php

namespace App\Http\Controllers;

use App\Aliases;
use App\Templates;
use App\Doctypes;
use App\Docs;
use Illuminate\Http\Request;

class AliasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
	 * @param  int $doctypes_id
     * @param  int $templates_id
     * @return \Illuminate\Http\Response
     */
    public function index($doctypes_id, $templates_id)
    {
		// Get Doctypes
		$doctypes = Doctypes::get();
		$doctype = $doctypes->first(function($item) use ($doctypes_id) {
			return $item->id == $doctypes_id;
		});
	
		// Get Template
		$template = Templates::findOrFail($templates_id);

		// Create Docs Object
		$docsObj = new Docs;
		$docsFields = $docsObj->getDocsFields($doctypes_id);
	
		// Get Aliases
		$docsFieldsAliases = Aliases::where('templates_id', $templates_id)->get();
	
		$aliases = [];
		if (count($docsFieldsAliases) > 0) {
			foreach ($docsFieldsAliases->all() as $docsFieldsAlias) {
				$aliases[$docsFieldsAlias->docs_fields_id]['id'] = $docsFieldsAlias->id;
				$aliases[$docsFieldsAlias->docs_fields_id]['templates_id'] = $docsFieldsAlias->templates_id;
				$aliases[$docsFieldsAlias->docs_fields_id]['name'] = $docsFieldsAlias->alias;
			}
		}
		
		if(empty($template) || empty($docsFields)) {
			abort(404);
		}

		return view('aliases.index')
			->with('aliases', $aliases)
			->withDoctypes($doctypes)
			->withTemplate($template)
			->with('docsFields', $docsFields)
			->with('doctype', $doctype)
			->with('doctypes_id', $doctypes_id)
			->with('templates_id', $templates_id);
    }
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $doctypes_id
	 * @param  int $templates_id
	 * @param  int $docs_fields_id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($doctypes_id, $templates_id, $docs_fields_id)
	{
		// Get Doctypes
		$doctypes = Doctypes::get();
		$doctype = $doctypes->first(function($item) use ($doctypes_id) {
			return $item->id == $doctypes_id;
		});

		// Get Template
		$template = Templates::findOrFail($templates_id);
		
		// Create Docs Object
		$docsObj = new Docs;
		$docsFields = $docsObj->getDocsFields($doctypes_id);
		
		$docsFieldsArr = [];
		if (!empty($docsFields)) {
			foreach ($docsFields->all() as $docsField) {
				$docsFieldsArr[$docsField->id] = $docsField->name;
			}
		}
		
		// Get Aliases
		$docsFieldsAliases = Aliases::where('templates_id', $templates_id)->get();
		
		$aliases = [];
		if (count($docsFieldsAliases) > 0) {
			foreach ($docsFieldsAliases->all() as $docsFieldsAlias) {
				$aliases[$docsFieldsAlias->docs_fields_id]['id'] = $docsFieldsAlias->id;
				$aliases[$docsFieldsAlias->docs_fields_id]['templates_id'] = $docsFieldsAlias->templates_id;
				$aliases[$docsFieldsAlias->docs_fields_id]['name'] = $docsFieldsAlias->alias;
			}
		}
		
		if(empty($template) || empty($docsFields) || empty($docsFieldsArr[$docs_fields_id])) {
			abort(404);
		}
		
		return view('aliases.edit')
			->with('aliases', $aliases)
			->withDoctypes($doctypes)
			->withTemplate($template)
			->with('docsFields', $docsFields)
			->with('docsFieldsArr', $docsFieldsArr)
			->with('doctype', $doctype)
			->with('doctypes_id', $doctypes_id)
			->with('templates_id', $templates_id)
			->with('docs_fields_id', $docs_fields_id);
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $doctypes_id
	 * @param  int  $templates_id
	 * @param  int  $docs_fields_id
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, $doctypes_id, $templates_id, $docs_fields_id)
	{
		// Prepare Validation Rules
		/*$rules = [];
		$rules['alias'] = 'required';
		
		// Request Validation
		$this->validate($request, $rules);*/
		
		// Save Alias
		$alias = Aliases::where([
			['templates_id', '=', $templates_id],
			['docs_fields_id', '=', $docs_fields_id],
		])->first();
		if (empty($alias)) {
			$alias = new Aliases;
		}
		$alias->templates_id = $templates_id;
		$alias->docs_fields_id = $docs_fields_id;
		$alias->alias = $request->alias;
		$alias->save();
		
		return redirect('/aliases/'.$doctypes_id.'/'.$templates_id)
			->with('success','Псевдоним успешно сохранен!');
	}
}
