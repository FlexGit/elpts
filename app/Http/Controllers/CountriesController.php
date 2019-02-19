<?php

namespace App\Http\Controllers;

use Session;
use App\Countries;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows_quantity = 30;
		if(Session::has('settings_rows_quantity'))
		{
			$rows_quantity = Session::get('settings_rows_quantity');
		}

        // Get Countries
        $countries = Countries::orderByRaw('id = 1 desc')->orderBy('name', 'asc')->paginate($rows_quantity);

		$page = $request->page;
		if(!isset($request->page)) $page = 1;

        return view('countries.index')
        	->withCountries($countries)
       		->with('rows_quantity', $rows_quantity)
       		->withRequest($request)
       		->with('page', $page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('countries.create')
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
		    'name' => 'required|max:255|unique:elpts_countries',
		]);

        // Save Country
		$country = new Countries;
		$country->name = $request->name;
		$country->enable = $request->enable;
		$country->save();

		return redirect('/countries?page='.$request->page)
			->with('success','Запись успешно сохранена!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // Get Country
        $country = Countries::findOrFail($id);

        return view('countries.edit')
        	->withCountry($country)
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
		]);

        // Get Country
		$country = Countries::findOrFail($id);

        // Save Country
		$country->name = $request->name;
		$country->enable = $request->enable;
		$country->save();

		return redirect('/countries?page='.$request->page)
			->with('success','Запись успешно сохранена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Remove Country
  		Countries::destroy($id);

		return redirect('/countries?page='.$request->page)
			->with('success','Запись успешно удалена!');
    }
}
