<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>报名列表</title>
    <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  	<div class="container">
	    <h1>报名列表</h1>
	    <div class="table-responsive">
		    <table class="table table-hover">
		      <thead>
		        <tr>
		          <th>#</th>
		          <th>姓名</th>
		          <th>联系电话</th>
		          <th>运动项目</th>
		          <th>小区</th>
		          <th>社区</th>
		        </tr>
		      </thead>
		      <tbody>
		      	@foreach($tickets as $ticket)
		        <tr>
		          <th scope="row">{{ $loop->index + 1 }}</th>
		          <td>{{ $ticket->owner->name }}</td>
		          <td>{{ $ticket->owner->tel }}</td>
		          <td>{{ $ticket->sports->implode('name', '，') }}</td>
		          <td>{{ $ticket->owner->residentialArea->name }}</td>
		          <td>{{ $ticket->owner->residentialArea->block->name or '' }}</td>
		        </tr>
		        @endforeach
		      </tbody>
		    </table>
	    </div>
    </div>
	<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>
