<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page-title')</title>
    <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    @yield('page-css')
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">中铠街区体育</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="dropdown @if(preg_match('/\/admin\/(street|block|area)/' ,url()->current())) active @endif">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">区域管理 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li @if(preg_match('/\/admin\/street/' ,url()->current())) class="active" @endif><a href="/admin/street">街道管理</a></li>
                <li @if(preg_match('/\/admin\/block/' ,url()->current())) class="active" @endif><a href="/admin/block">社区管理</a></li>
                <li @if(preg_match('/\/admin\/area/' ,url()->current())) class="active" @endif><a href="/admin/area">小区管理</a></li>
              </ul>
            </li>
            <li class="dropdown @if(preg_match('/\/admin\/ticket/' ,url()->current())) active @endif">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">报名列表 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                @foreach($menuMatches as $match)
                <li @if(preg_match("/\/admin\/ticket/" ,url()->current()) && url()->getRequest()->input('match') == $match->id ) class="active" @endif><a href="/admin/ticket?match={{ $match->id }}">{{ $match->street->name }}</a></li>
                @endforeach
              </ul>
            </li>
            <li class="dropdown @if(preg_match('/\/admin\/match/' ,url()->current())) active @endif">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">赛事管理 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li @if(preg_match('/\/admin\/match$/' ,url()->current())) class="active" @endif><a href="/admin/match">赛事列表</a></li>
                <li @if(preg_match('/\/admin\/match\/create/' ,url()->current())) class="active" @endif><a href="/admin/match/create">创建赛事</a></li>
                <li @if(preg_match('/\/admin\/match\/register\/qrcode/' ,url()->current())) class="active" @endif><a href="/admin/match/register/qrcode">报名二维码生成</a></li>
              </ul>
            </li>
            <li @if(preg_match('/\/admin\/match\/result/' ,url()->current())) class="active" @endif><a href="/admin/match/result">比赛成绩管理</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li @if(preg_match('/\/admin\/role/' ,url()->current())) class="active" @endif><a href="/admin/role">管理员管理</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div id="container" class="container">
      @yield('content')
    </div>

	  <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript">
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    </script>
	  <script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  @yield('page-js')
  </body>
</html>
