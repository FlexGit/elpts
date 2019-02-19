<?php

namespace App\Http\Controllers;

use Session;
use App\Okopfs;
use Illuminate\Http\Request;

class OkopfsController extends Controller
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

        // Get Okopfs
        $okopfs = Okopfs::orderBy('name', 'asc')->paginate($rows_quantity);

		$page = $request->page;
		if(!isset($request->page)) $page = 1;

        return view('okopfs.index')
        	->withOkopfs($okopfs)
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
        return view('okopfs.create')
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
		    'id' => 'required|integer',
		    'name' => 'required|max:255',
		]);

        // Save Okopf
		$okopf = new Okopfs;
		$okopf->id = $request->id;
		$okopf->name = $request->name;
		$okopf->enable = $request->enable;
		$okopf->save();

		return redirect('/okopfs?page='.$request->page)
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
        // Get Okopf
        $okopf = Okopfs::findOrFail($id);

        return view('okopfs.edit')
        	->withOkopf($okopf)
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
		    'id' => 'required|integer', //|is_okopf_in_docs
		    'name' => 'required|max:255',
		]);

        // Get Okopf
		$okopf = Okopfs::findOrFail($id);

        // Save Okopf
		$okopf->id = $request->id;
		$okopf->name = $request->name;
		$okopf->enable = $request->enable;
		$okopf->save();

		return redirect('/okopfs?page='.$request->page)
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
        // Remove Okopf
  		Okopfs::destroy($id);

		return redirect('/okopfs?page='.$request->page)
			->with('success','Запись успешно удалена!');
    }
}
