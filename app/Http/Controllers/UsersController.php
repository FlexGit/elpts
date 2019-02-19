<?php

namespace App\Http\Controllers;

use Session;
use App\Users;
use App\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$rows_quantity = 30;
		if (Session::has('settings_rows_quantity')) {
			$rows_quantity = Session::get('settings_rows_quantity');
		}
		
		// Get Users
		$users = Users::orderBy('name', 'asc')->paginate($rows_quantity);
		
		$page = $request->page;
		if (!isset($request->page)) $page = 1;
		
		return view('users.index')
			->withUsers($users)
			->with('rows_quantity', $rows_quantity)
			->withRequest($request)
			->with('page', $page);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request) {
		return view('users.create')
			->withRequest($request);
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		// Request Validation
		$this->validate($request, [
			'name' => 'required|max:255|unique:users',
			'snils' => 'required|is_snils',
			'ogrn' => 'required|integer|is_ogrn',
			'snils_ogrn' => 'are_snils_ogrn_unique',
		]);
		
		// Save User
		$user = new Users;
		$user->name = $request->name;
		$user->snils = $request->snils;
		$user->ogrn = $request->ogrn;
		$user->enable = $request->enable;
		$user->save();
		
		return redirect('/users?page=' . $request->page)
			->with('success', 'Запись успешно сохранена!');
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request, $id) {
		// Get User
		$user = Users::findOrFail($id);
		
		return view('users.edit')
			->withUser($user)
			->withRequest($request);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		// Request Validation
		$this->validate($request, [
			'name' => 'required|max:255',
			'snils' => 'required|is_snils',
			'ogrn' => 'required|integer|is_ogrn',
			'snils_ogrn' => 'are_snils_ogrn_unique',
		]);
		
		// Get User
		$user = Users::findOrFail($id);
		
		// Save User
		$user->name = $request->name;
		$user->snils = $request->snils;
		$user->ogrn = $request->ogrn;
		$user->admin = $request->admin;
		$user->enable = $request->enable;
		$user->auth_at = null;
		$user->save();
		
		return redirect('/users?page=' . $request->page)
			->with('success', 'Запись успешно сохранена!');
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id) {
		//
		Users::destroy($id);
		
		return redirect('/users?page=' . $request->page)
			->with('success', 'Запись успешно удалена!');
	}
	
	/**
	 * Post Ajax Auth Request
	 */
	public function ajaxAuthRequestPost() {
		Session::flush();
		
		$input = request()->all();
		
		$ogrn = $input['ogrn'];
		$snils = $input['snils'];
		$snils = substr($snils, 0, 3) . '-' . substr($snils, 3, 3) . '-' . substr($snils, 6, 3) . '-' . substr($snils, 9, 2);
		
		$users = Users::where([
			['ogrn', $ogrn],
			['snils', $snils],
			['enable', '1'],
		])
			->orderBy('id')
			->limit(1)
			->get();
		
		if (!count($users)) {
			return response()->json([
				'response' => [
					'error' => 'users_error',
					'msg' => 'Отсутствуют права доступа',
				],
			]);
		}
		
		$auth_at = date('Y-m-d H:i:s');
		
		// Create Users Object
		$users_obj = new Users;
		
		foreach ($users as $user) {
			// Verify Signature by Signal-COM DSS Server
			$response = $users_obj->signatureVerify($input['file'], $input['signature']);
			
			if ($response['error']) {
				// Write Log
				$log = new Logs;
				$log->operation_id = 26;
				$log->user_name = $user->ogrn;
				$log->value = 'Ошибка: Подпись не прошла верификацию DSS-сервером. ' . $response['error'];
				$log->save();
				
				return response()->json([
					'response' => [
						'error' => $response['error'],
						'msg' => 'Подпись не прошла верификацию DSS-сервером.',
					],
				]);
			}
			
			Users::where('id', $user->id)->update(['auth_at' => $auth_at]);
			
			// Write Log
			$log = new Logs;
			$log->operation_id = 21;
			$log->user_name = $user->name;
			$log->save();
			
			session([
				'elpts_user_id' => $user->id,
				'elpts_user_name' => $user->name,
				'elpts_user_ogrn' => $user->ogrn,
				'elpts_user_snils' => $user->snils,
				'elpts_user_is_admin' => $user->admin,
				'elpts_user_auth_at' => $auth_at,
			]);
			
			return response()->json([
				'response' => [
					'msg' => 'success',
				],
			]);
		}
	}
}
