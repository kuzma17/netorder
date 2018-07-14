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

//Route::get('/', function () {
  //  return view('welcome');
//});

Auth::routes();

Route::group(['middleware' => 'auth'], function (){
    Route::get('/', ['as'=>'home', 'uses'=>'OrderController@list']);

//Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/users', ['as'=>'users', 'uses'=>'UserController@list']);
    Route::get('/user/view/{id}', ['as'=>'user.view', 'uses'=>'UserController@view']);
    Route::get('/user/add', ['as'=>'user.add', 'uses'=>'UserController@add']);
    Route::post('/user/add', ['as'=>'user.add', 'uses'=>'UserController@add']);
    Route::get('/user/edit/{id}', ['as'=>'user.edit', 'uses'=>'UserController@edit']);
    Route::post('/user/edit/{id}', ['as'=>'user.edit', 'uses'=>'UserController@edit']);
    Route::get('/user/passwd/edit/{id}', ['as'=>'user.passwd.edit', 'uses'=>'UserController@edit_passwd']);
    Route::post('/user/passwd/edit/{id}', ['as'=>'user.passwd.edit', 'uses'=>'UserController@edit_passwd']);
    Route::get('/user/del/{id}', ['as'=>'user.del', 'uses'=>'UserController@del']);

    Route::get('/orders', ['as'=>'orders', 'uses'=>'OrderController@list']);
    Route::post('/orders/filter', ['as'=>'orders.filter', 'uses'=>'OrderController@filter']);
    Route::get('/order/view/{id}', ['as'=>'order.view', 'uses'=>'OrderController@view']);
    Route::get('/order/add', ['as'=>'order.add', 'uses'=>'OrderController@add']);
    Route::post('/order/add', ['as'=>'order.add', 'uses'=>'OrderController@add']);
    Route::get('/order/edit/{id}', ['as'=>'order.edit', 'uses'=>'OrderController@edit']);
    Route::post('/order/edit/{id}', ['as'=>'order.edit', 'uses'=>'OrderController@edit']);
    Route::get('/order/del/{id}', ['as'=>'order.del', 'uses'=>'OrderController@del']);

    Route::post('/upload', ['as'=>'upload_act', 'uses'=>'UploadController@upload']);
    Route::post('/ajax_firm', ['as'=>'firm_act', 'uses'=>'AjaxController@ajax_firm']);
    Route::post('/ajax_branch', ['as'=>'branch_act', 'uses'=>'AjaxController@branch_list']);
    Route::post('/ajax_contractor', ['as'=>'contractor_act', 'uses'=>'AjaxController@contractor_list']);
    Route::post('/ajax_cartridge', ['as'=>'cartridge_act', 'uses'=>'AjaxController@cartridge_list']);
    Route::post('/ajax_add_printer', ['as'=>'printer_add_act', 'uses'=>'AjaxController@add_printer']);
    Route::post('/ajax_add_cartridge', ['as'=>'printer_add_act', 'uses'=>'AjaxController@add_cartridge']);
    Route::post('/ajax_cartridge_order', ['as'=>'cartridge_order_act', 'uses'=>'AjaxController@cartridge_order']);
    Route::post('/ajax_search_cartridge', ['as'=>'cartridge_search_act', 'uses'=>'AjaxController@search_cartridge']);
    Route::post('/ajax_search_printer', ['as'=>'printer_search_act', 'uses'=>'AjaxController@search_printer']);
    Route::post('/ajax_search_city', ['as'=>'city_search_act', 'uses'=>'AjaxController@search_city']);
    Route::post('/ajax_city_list', ['as'=>'city_list_act', 'uses'=>'AjaxController@city_list']);

    Route::get('/firms', ['as'=>'firms', 'uses'=>'FirmController@list']);
    Route::get('/firms/{id}', ['as'=>'firms.id', 'uses'=>'FirmController@list']);
    Route::get('/firm/view/{id}', ['as'=>'firm.view', 'uses'=>'FirmController@view']);
    Route::get('/firm/add', ['as'=>'firm.add', 'uses'=>'FirmController@add']);
    Route::post('/firm/add', ['as'=>'firm.add', 'uses'=>'FirmController@add']);
    Route::get('/firm/edit/{id}', ['as'=>'firm.edit', 'uses'=>'FirmController@edit']);
    Route::post('/firm/edit/{id}', ['as'=>'firm.edit', 'uses'=>'FirmController@edit']);
    Route::get('/firm/del/{id}', ['as'=>'firm.del', 'uses'=>'FirmController@del']);

   // Route::get('/clients', ['as'=>'clients', 'uses'=>'ClientController@list']);
    Route::get('/client/view/{id}', ['as'=>'client.view', 'uses'=>'ClientController@view']);
    Route::get('/client/add', ['as'=>'client.add', 'uses'=>'ClientController@add']);
    Route::post('/client/add', ['as'=>'client.add', 'uses'=>'ClientController@add']);
    //Route::get('/firm/{id}/client/add', ['as'=>'client.add', 'uses'=>'ClientController@add']);
    //Route::post('/firm/{id}/client/add', ['as'=>'client.add', 'uses'=>'ClientController@add']);
    Route::get('/client/edit/{id}', ['as'=>'client.edit', 'uses'=>'ClientController@edit']);
    Route::post('/client/edit/{id}', ['as'=>'client.edit', 'uses'=>'ClientController@edit']);
    Route::get('/client/del/{id}', ['as'=>'client.del', 'uses'=>'ClientController@del']);

   // Route::get('/contractors', ['as'=>'contractors', 'uses'=>'ContractorController@list']);
   // Route::get('/contractor/view/{id}', ['as'=>'contractor.view', 'uses'=>'ContractorController@view']);
    //Route::get('/contractor/add', ['as'=>'contractor.add', 'uses'=>'ContractorController@add']);
    //Route::post('/contractor/add', ['as'=>'contractor.add', 'uses'=>'ContractorController@add']);
    //Route::get('/contractor/edit/{id}', ['as'=>'contractor.edit', 'uses'=>'ContractorController@edit']);
    //Route::post('/contractor/edit/{id}', ['as'=>'contractor.edit', 'uses'=>'ContractorController@edit']);
    Route::get('/contractor/del/{id}', ['as'=>'contractor.del', 'uses'=>'ContractorController@delete']);

    Route::resource('contractors', 'ContractorController');

    Route::resource('printers', 'PrinterController');
    Route::get('/printers/del/{id}', ['as'=>'printers.del', 'uses'=>'PrinterController@delete']);

    Route::resource('cartridges', 'CartridgeController');
    Route::get('/cartridges/del/{id}', ['as'=>'cartridges.del', 'uses'=>'CartridgeController@delete']);

    Route::resource('cites', 'CityController');
    Route::get('/cites/del/{id}', ['as'=>'cites.del', 'uses'=>'CityController@delete']);

    Route::get('/help', ['as'=>'help', 'uses'=>'HelpController@help']);

    Route::get('/settings/edit', ['as'=>'setting.edit', 'uses'=>'SettingController@edit']);
    Route::post('/settings/update', ['as'=>'setting.update', 'uses'=>'SettingController@update']);

    Route::get('/load_printers', ['as'=>'load_printers', 'uses'=>'PrinterController@load_printers']); // Upload printers
    Route::post('/save_load_printers', ['as'=>'save_load_printers', 'uses'=>'PrinterController@save_load_printers']); // Upload printers


});