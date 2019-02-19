<?php

namespace App\Http\Controllers;

use Session;
use App\Logs;
use App\Users;
use Illuminate\Http\Request;

class LogController extends Controller
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

        // Get Logs
		$result = Logs::whereIn('elpts_logs.operation_id', [21,22])
			->orderBy('elpts_logs.id', 'desc');

		if($request->filter_user)
		{
			$result->where('elpts_logs.user_name', '=', $request->filter_user);
		}

		if($request->filter_date_from)
		{
			$result->where('elpts_logs.created_at', '>=', date('Y-m-d H:i:s', strtotime($request->filter_date_from)));
		}

		if($request->filter_date_to)
		{
			$result->where('elpts_logs.created_at', '<=', date('Y-m-d H:i:s', strtotime($request->filter_date_to)));
		}

		$logs = $result->paginate($rows_quantity);

        // Get Users
        $users = Users::all();

		// Create Logs Object
		$log_obj = new Logs;

        // Get Operations
		$operations = $log_obj->getOperations();

		$operations_arr = array();
		if(count($operations))
		{
			foreach($operations as $v)
			{
				$operations_arr[$v->id] = $v->name;
			}
		}

		$page = $request->page;
		if(!isset($request->page)) $page = 1;

        return view('log.index')
        	->withLogs($logs)
        	->withUsers($users)
        	->with('operations_arr', $operations_arr)
       		->with('rows_quantity', $rows_quantity)
       		->with('page', $page)
			->withRequest($request);
    }
}
