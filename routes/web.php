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
    Route::post('activities/hsblockgame', 'TicketController@store');
});

Route::get('doc', 'FileController@show');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('hsblockgame/ticket', 'TicketController@index');
    Route::get('wechat/material', 'WechatController@material');
    Route::get('wechat/updateMenu', 'WechatController@updateMenu');
});

Route::group(['namespace' => 'Admin'], function () {
    Route::any('/wechat', 'WechatController@serve');
});
