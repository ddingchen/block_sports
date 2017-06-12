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

Route::post('payment/notify', 'PaymentController@notify');

Route::group(['middleware' => ['wechat.oauth', 'login.wechat']], function () {
    Route::group(['prefix' => 'wm'], function () {
        Route::get('/', 'WMSwimmingController@index');
        Route::get('group', 'WMSwimmingController@groups');
        Route::get('group/{group}/register', 'WMSwimmingController@registerForm');
        Route::post('group/{group}/register', 'WMSwimmingController@register');
        Route::get('ticket/{ticket}/pay', 'WMSwimmingController@payForm');
        Route::get('success', 'WMSwimmingController@success');
        Route::get('i/ticket', 'WMSwimmingController@myTickets');
        Route::get('ticket/{ticket}', 'WMSwimmingController@ticket');
        Route::get('ticket', 'WMSwimmingController@allTickets');
    });

    // 原链接重定向至新路由
    Route::get('activities/hsblockgame', function () {
        return redirect('match/1/ticket/create');
    });
    Route::get('activities/hsblockgame/register', function () {
        return redirect('match/1/ticket/create');
    });
    // Route::post('activities/hsblockgame', 'TicketController@store'); // store
    Route::get('activities/hsblockgame/result', 'TicketController@result');
    Route::get('match/result/{id}', 'MatchResultController@show');
    // Route::get('residentialArea/{id}/blockName', 'BlockController@blockNameOfArea');

    Route::get('/', function () {return redirect('sport/top-list');});
    Route::get('i', 'IController@index');
    Route::get('i/ticket', 'TicketController@indexOfUser');
    Route::resource('i/team', 'TeamController');
    Route::get('i/team/{team}/invite', 'TeamController@invite');
    Route::get('i/team/{team}/join', 'TeamController@join');
    Route::get('i/team/{team}/qrCode', 'TeamController@qrCode');
    Route::resource('i/team/{team}/member', 'MemberController', ['only' => ['edit', 'update', 'destroy']]);

    Route::resource('match/{match}/ticket', 'TicketController');
    Route::resource('match', 'MatchController');
    // Route::resource('match/group', 'MatchGroupController', ['only' => ['index', 'show']]);
    Route::get('street/{street}/area', 'AreaController@indexByStreet');

    Route::get('sport/top-list', 'TopListController@fetchFirstTopList');
    Route::get('sport/{sport}/top-list', 'TopListController@index');

    // Route::get('task', function () {
    //     return view('task.index');
    // });

    Route::group(['namespace' => 'Admin'], function () {
        Route::get('admin/request/create', 'AdminRequestController@create');
        Route::post('admin/request', 'AdminRequestController@store');
    });
});

$adminMiddleware = isWeChatBrowser(app('request')) ? ['wechat.oauth', 'login.wechat', 'admin'] : (config('app.env') == 'production' ? ['auth.basic'] : []);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => $adminMiddleware], function () {
    Route::get('/', function () {
        return redirect('admin/match');
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
    Route::resource('match/{match}/ticket', 'TicketController');
    Route::resource('match', 'MatchController', ['only' => ['index', 'create', 'store']]);
    // Route::resource('group', 'MatchGroupController');
    // Route::get('match/register/qrcode', 'MatchController@registerQrcodeForm');
    // Route::get('match/register/qrcode/generate', 'MatchController@generateRegisterQrcode');
    // Route::get('match/result', 'MatchResultController@fetchFirstMatch');
    Route::resource('match/{match}/result', 'ResultController', ['except' => ['create', 'store']]);
    Route::get('match/{match}/ticket/{ticket}/result/create', 'ResultController@create');
    Route::post('match/{match}/ticket/{ticket}/result', 'ResultController@store');

    Route::get('wm/group/{group}/ticket', 'WMSwimmingController@tickets');
    Route::get('wm/registion/{registion}', 'WMSwimmingController@registionForm');
    Route::put('wm/registion/{registion}', 'WMSwimmingController@editRegistion');
    Route::delete('wm/ticket/{ticket}', 'WMSwimmingController@destoryTicket');

    Route::get('wechat/material', 'WechatController@material');
    Route::get('wechat/updateMenu', 'WechatController@updateMenu');
});

Route::group(['namespace' => 'Admin'], function () {
    Route::any('/wechat', 'WechatController@serve');
});
