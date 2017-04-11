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

Route::group(['middleware' => ['wechat.oauth', 'login.wechat']], function () {
    // Route::get('activities/hsblockgame', 'TicketController@index'); //index
    // Route::get('activities/hsblockgame/register', 'TicketController@create'); //create
    // Route::post('activities/hsblockgame', 'TicketController@store'); // store
    Route::get('activities/hsblockgame/result', 'TicketController@result');
    Route::get('match/result/{id}', 'MatchResultController@show');
    // Route::get('residentialArea/{id}/blockName', 'BlockController@blockNameOfArea');

    Route::get('i/ticket', 'TicketController@indexOfUser');

    Route::resource('ticket', 'TicketController');
    Route::get('street/{street}/area', 'AreaController@indexByStreet');

    Route::group(['namespace' => 'Admin'], function () {
        Route::get('admin/request/create', 'AdminRequestController@create');
        Route::post('admin/request', 'AdminRequestController@store');
    });
});

$adminMiddleware = isWeChatBrowser(app('request')) ? ['wechat.oauth', 'login.wechat', 'admin'] : (config('app.env') == 'production' ? ['auth.basic'] : []);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => $adminMiddleware], function () {
    Route::get('/', function () {
        return redirect('admin/ticket');
    });
    Route::resource('request', 'AdminRequestController', ['only' => ['index']]);
    Route::resource('role', 'RoleController');
    Route::resource('street', 'StreetController');
    Route::get('street/{street}/block', 'BlockController@indexByStreet');
    Route::get('street/{street}/blocks/import', 'StreetController@importForm');
    Route::post('street/{street}/blocks/import', 'StreetController@import');
    Route::resource('block', 'BlockController');
    Route::resource('area', 'AreaController');
    Route::resource('user', 'UserController');
    Route::resource('ticket', 'TicketController');
    Route::resource('match', 'MatchController', ['only' => ['index', 'create', 'store']]);
    Route::get('match/register/qrcode', 'MatchController@registerQrcodeForm');
    Route::get('match/register/qrcode/generate', 'MatchController@generateRegisterQrcode');
    Route::resource('match/result', 'MatchResultController');
    Route::get('wechat/material', 'WechatController@material');
    Route::get('wechat/updateMenu', 'WechatController@updateMenu');
});

Route::group(['namespace' => 'Admin'], function () {
    Route::any('/wechat', 'WechatController@serve');
});
