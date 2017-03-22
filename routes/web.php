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
    Route::get('activities/hsblockgame', 'TicketController@index');
    Route::get('activities/hsblockgame/register', 'TicketController@create');
    Route::get('activities/hsblockgame/result', 'TicketController@result');
    Route::get('result/{id}', 'MatchResultController@show');
    Route::post('activities/hsblockgame', 'TicketController@store');
    Route::get('residentialArea/{id}/blockName', 'BlockController@blockNameOfArea');
});

$adminMiddleware = isWeChatBrowser(app('request')) ? ['wechat.oauth', 'login.wechat', 'admin'] : (config('app.env') == 'production' ? ['auth.basic'] : []);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => $adminMiddleware], function () {
    Route::get('/', function () {
        return redirect('admin/ticket');
    });
    Route::resource('role', 'RoleController');
    Route::resource('block', 'BlockController');
    Route::resource('area', 'AreaController');
    Route::resource('user', 'UserController');
    Route::resource('ticket', 'TicketController');
    Route::resource('match/result', 'MatchResultController');
    Route::get('wechat/material', 'WechatController@material');
    Route::get('wechat/updateMenu', 'WechatController@updateMenu');
});

Route::group(['namespace' => 'Admin'], function () {
    Route::any('/wechat', 'WechatController@serve');
});
