<?php

namespace App\Http\Controllers;

use Session;
use App\Doctypes;
use App\Prefixes;
use Illuminate\Http\Request;

class PrefixesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows_quantity = 30;
		if(Session::has('settings_rows_quantity'))
		{
			$rows_quantity = Session::get('settings_rows_quantity');
		}

        // Get Prefixes
        $prefixes = Prefixes::orderBy('doctypes_id', 'asc')
        	->orderBy('name', 'asc')
        	->paginate($rows_quantity);

        // Get Doctypes
        $doctypes = Doctypes::all();

		$page = $request->page;
		if(!isset($request->page)) $page = 1;

        return view('prefixes.index')
        	->withPrefixes($prefixes)
        	->withDoctypes($doctypes)
       		->with('rows_quantity', $rows_quantity)
       		->withRequest($request)
       		->with('page', $page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Get Doctypes
        $doctypes = Doctypes::where('enable', 1)->get();

        return view('prefixes.create')
        	->withDoctypes($doctypes)
        	->withRequest($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    // Request Validation
		$this->validate($request, [
		    'name' => 'required|max:255',
		    'doctypes_id' => 'required|min:1',
		]);

        // Save Prefix
		$prefix = new Prefixes;
		$prefix->name = $request->name;
		$prefix->doctypes_id = $request->doctypes_id;
		$prefix->enable = $request->enable;
		$prefix->save();

		return redirect('/prefixes?page='.$request->page)
			->with('success','Запись успешно сохранена!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // Get Prefix
        $prefix = Prefixes::findOrFail($id);

        // Get Doctypes
        $doctypes = Doctypes::where('enable', 1)->get();

        return view('prefixes.edit')
        	->withPrefix($prefix)
        	->withDoctypes($doctypes)
        	->withRequest($request);
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
	    // Request Validation
		$this->validate($request, [
		    'name' => 'required|max:255',
		    'doctypes_id' => 'required',
		]);

        // Get Prefix
		$prefix = Prefixes::findOrFail($id);

        // Save Prefix
		$prefix->name = $request->name;
		$prefix->doctypes_id = $request->doctypes_id;
		$prefix->enable = $request->enable;
		$prefix->save();

		return redirect('/prefixes?page='.$request->page)
			->with('success','Запись успешно сохранена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Remove Prefix
  		Prefixes::destroy($id);

		return redirect('/prefixes?page='.$request->page)
			->with('success','Запись успешно удалена!');
    }
}
