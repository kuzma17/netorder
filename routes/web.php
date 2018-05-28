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
    Route::get('/', ['as'=>'home', 'uses'=>'OrderController@list_order']);

//Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/users', ['as'=>'users', 'uses'=>'UserController@list']);
    Route::get('/user/add', ['as'=>'user.add', 'uses'=>'UserController@add']);
    Route::post('/user/add', ['as'=>'user.add', 'uses'=>'UserController@add']);
    Route::get('/user/edit/{id}', ['as'=>'user.edit', 'uses'=>'UserController@edit']);
    Route::post('/user/edit/{id}', ['as'=>'user.edit', 'uses'=>'UserController@edit']);
    Route::get('/user/del/{id}', ['as'=>'user.del', 'uses'=>'UserController@del']);

    Route::get('/orders', ['as'=>'orders', 'uses'=>'OrderController@list_order']);
    Route::post('/orders/filter', ['as'=>'orders.filter', 'uses'=>'OrderController@filter_order']);
    Route::get('/order/view/{id}', ['as'=>'order.view', 'uses'=>'OrderController@view_order']);
    Route::get('/order/add', ['as'=>'order.add', 'uses'=>'OrderController@add_order']);
    Route::post('/order/add', ['as'=>'order.add', 'uses'=>'OrderController@add_order']);
    Route::get('/order/edit/{id}', ['as'=>'order.edit', 'uses'=>'OrderController@edit_order']);
    Route::post('/order/edit/{id}', ['as'=>'order.edit', 'uses'=>'OrderController@edit_order']);
    Route::get('/order/del/{id}', ['as'=>'order.del', 'uses'=>'OrderController@del_order']);

    Route::post('/upload', ['as'=>'upload_act', 'uses'=>'UploadController@upload']);
    Route::post('/branch', ['as'=>'branch_act', 'uses'=>'UserController@branch_list']);

    Route::get('/firms', ['as'=>'firms', 'uses'=>'FirmController@list']);
    Route::get('/firms/{id}', ['as'=>'firms.id', 'uses'=>'FirmController@list']);
    Route::get('/firm/add', ['as'=>'firm.add', 'uses'=>'FirmController@add']);
    Route::post('/firm/add', ['as'=>'firm.add', 'uses'=>'FirmController@add']);
    Route::get('/firm/edit/{id}', ['as'=>'firm.edit', 'uses'=>'FirmController@edit']);
    Route::post('/firm/edit/{id}', ['as'=>'firm.edit', 'uses'=>'FirmController@edit']);
    Route::get('/firm/del/{id}', ['as'=>'firm.del', 'uses'=>'FirmController@del']);

   // Route::get('/clients', ['as'=>'clients', 'uses'=>'ClientController@list']);
    Route::get('/client/add', ['as'=>'client.add', 'uses'=>'ClientController@add']);
    Route::post('/client/add', ['as'=>'client.add', 'uses'=>'ClientController@add']);
    //Route::get('/firm/{id}/client/add', ['as'=>'client.add', 'uses'=>'ClientController@add']);
    //Route::post('/firm/{id}/client/add', ['as'=>'client.add', 'uses'=>'ClientController@add']);
    Route::get('/client/edit/{id}', ['as'=>'client.edit', 'uses'=>'ClientController@edit']);
    Route::post('/client/edit/{id}', ['as'=>'client.edit', 'uses'=>'ClientController@edit']);
    Route::get('/client/del/{id}', ['as'=>'client.del', 'uses'=>'ClientController@del']);

    Route::get('/contractors', ['as'=>'contractors', 'uses'=>'ContractorController@list']);
    Route::get('/contractor/add', ['as'=>'contractor.add', 'uses'=>'ContractorController@add']);
    Route::post('/contractor/add', ['as'=>'contractor.add', 'uses'=>'ContractorController@add']);
    Route::get('/contractor/edit/{id}', ['as'=>'contractor.edit', 'uses'=>'ContractorController@edit']);
    Route::post('/contractor/edit/{id}', ['as'=>'contractor.edit', 'uses'=>'ContractorController@edit']);
    Route::get('/contractor/del/{id}', ['as'=>'contractor.del', 'uses'=>'ContractorController@del']);

});