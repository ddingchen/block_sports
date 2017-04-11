<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>街区运动会</title>
    <style type="text/css">
    body, html {
    	margin: 0;
    	padding: 0;
        background-color: #eee;
    }
    img {
    	display: block;
    	margin: 0;
    	padding: 0;
    	border: 0;
    }
    ul, li {
    	list-style: none;
    	margin: 0;
    	padding: 0;
    }
    ul {
    	margin: 10px;
    }
    li {
    	position: relative;
    	height: 140px;
    	margin-bottom: 10px;
    	border-radius: 10px;
    	background: linear-gradient(45deg, #3fd2ff, #1f4cff, #806aff);
    	overflow: hidden;
    	box-shadow: #666 0 3px 5px;
    }
    li .title {
    	position: absolute;
    	right: 10px;
    	bottom: 10px;
    	font-size: 26px;
    	color: #eef;
    	text-shadow: 0px 0px 5px #eef;
    }
    li .month {
    	position: absolute;
    	right: 10px;
    	bottom: 50px;
    	font-size: 24px;
    	font-style: initial;
    	color: #eef;
    	text-shadow: 0px 0px 5px #eef;
    }
    li .tag {
    	position: absolute;
    	left: -30px;
    	top: 30px;
    	padding: 0 30px;
    	background-color: #3fd2ff;
    	box-shadow: #666 0 3px 5px;
    	color: #666;
    	letter-spacing: 5px;
    	transform: rotate(-45deg);
    	font-weight: bold;
    }
    li .tag.hot {
    	background-color: #E64340;
    	color: #eef;
    }
    </style>
  </head>
  <body>
  	<ul>
  		<li>
  			<div class="month">5月开赛</div>
  			<div class="title">梁溪区广场舞比赛</div>
  			<span class="tag hot">火热报名</span>
  		</li>
  		<li>
  			<div class="month">6月开赛</div>
  			<div class="title">梁溪区羽毛球比赛</div>
  			<span class="tag">预热报名</span>
  		</li>
  	</ul>
  </body>
</html>
