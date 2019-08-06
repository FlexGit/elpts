<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\EmailRegistry;
use App\Imports\EmailRegistryImport;
use Maatwebsite\Excel\Facades\Excel;

class EmailRegistryController extends Controller
{
	/**
	 * Display a listing of the E-mail Registry.
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
		
		// Get E-mail Registry
		$emailRegistry = EmailRegistry::orderBy('id', 'asc')->paginate($rows_quantity);
		
		$page = $request->page;
		if(!isset($request->page)) $page = 1;
		
		return view('email_registry.index')
			->withEmailRegistry($emailRegistry)
			->with('rows_quantity', $rows_quantity)
			->withRequest($request)
			->with('page', $page);
	}
	
	/**
	 * Import Excel File.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function import(Request $request)
	{
		if ($request->hasFile('import_file')) {
			EmailRegistry::truncate();
			Excel::import(new EmailRegistryImport, $request->file('import_file')->getRealPath());
			return redirect('/email-registry')->with('success', 'Файл успешно загружен!');
		}
		return redirect('/email-registry')->with('error', 'Файл не был загружен!');
	}
}
