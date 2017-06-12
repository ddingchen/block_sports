<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>网民全民健身游泳比赛</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/weui.min.css">
    <link rel="stylesheet" href="/css/weui-example.min.css">
    <style type="text/css">
    	.page {
    		padding-bottom: 50px;
    	}
    </style>
</head>
<body>
	@yield('content')

    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('js')
</body>
</html>
