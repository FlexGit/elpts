<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/auth', 'auth');

Route::post('/users/ajaxAuthRequest', 'UsersController@ajaxAuthRequestPost')->name('usersAuth.post');

Route::get('/', 'MainController@index')->name('main.index')->middleware('checkUser', 'checkAdmin');

Route::resource('/countries', 'CountriesController', ['except' => ['show']])->middleware('checkUser', 'checkAdmin', 'loadSettings');
Route::resource('/prefixes', 'PrefixesController', ['except' => ['show']])->middleware('checkUser', 'checkAdmin', 'loadSettings');
Route::resource('/okopfs', 'OkopfsController', ['except' => ['show']])->middleware('checkUser', 'checkAdmin', 'loadSettings');
Route::resource('/users', 'UsersController', ['except' => ['show']])->middleware('checkUser', 'checkAdmin', 'loadSettings');

Route::get('/templates/{doctypes_id}', 'TemplatesController@index')->name('templates.index')->middleware('checkUser', 'checkAdmin', 'loadSettings');
Route::get('/templates/{doctypes_id}/{id}/edit', 'TemplatesController@edit')->name('templates.edit')->middleware('checkUser', 'checkAdmin');
Route::get('/templates/{doctypes_id}/create', 'TemplatesController@create')->name('templates.create')->middleware('checkUser', 'checkAdmin');
Route::post('/templates/{doctypes_id}', 'TemplatesController@store')->name('templates.store')->middleware('checkUser', 'checkAdmin', 'loadSettings');
Route::put('/templates/{doctypes_id}/{id}', 'TemplatesController@update')->name('templates.update')->middleware('checkUser', 'checkAdmin');
Route::delete('/templates/{doctypes_id}/{id}', 'TemplatesController@destroy')->name('templates.destroy')->middleware('checkUser', 'checkAdmin', 'loadSettings');

Route::get('/aliases/{doctypes_id}/{templates_id}', 'AliasesController@index')->name('aliases.index')->middleware('checkUser', 'checkAdmin');
Route::get('/aliases/{doctypes_id}/{templates_id}/{docs_fields_id}/edit', 'AliasesController@edit')->name('aliases.edit')->middleware('checkUser', 'checkAdmin');
Route::post('/aliases/{doctypes_id}/{templates_id}/{docs_fields_id}', 'AliasesController@store')->name('aliases.store')->middleware('checkUser', 'checkAdmin');

Route::get('/log', 'LogController@index')->name('log.index')->middleware('checkUser', 'checkAdmin', 'loadSettings');
Route::post('/log', 'LogController@index')->name('log.index')->middleware('checkUser', 'checkAdmin', 'loadSettings');

Route::get('/settings', 'SettingsController@index')->name('settings.index')->middleware('checkUser', 'checkAdmin');
Route::post('/settings/notifications', 'SettingsController@storeNotifications')->name('settings.storeNotifications')->middleware('checkUser', 'checkAdmin', 'loadSettings');
Route::post('/settings', 'SettingsController@store')->name('settings.store')->middleware('checkUser', 'checkAdmin', 'loadSettings');
Route::get('/settings/{id}', 'SettingsController@edit')->name('settings.edit')->middleware('checkUser', 'checkAdmin');
Route::put('/settings/{id}', 'SettingsController@update')->name('settings.update')->middleware('checkUser', 'checkAdmin', 'loadSettings');

Route::get('/email-registry', 'EmailRegistryController@index')->name('email_registry.index')->middleware('checkUser', 'checkAdmin');
Route::post('/email-registry/import', 'EmailRegistryController@import')->name('emailRegistryImport');

Route::fallback(function () {
    abort(404);
});
