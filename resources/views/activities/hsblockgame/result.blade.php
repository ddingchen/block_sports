<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>街区运动会－我的现场</title>
    <style type="text/css">
    html {
  		display: block;
  		height: 100%;
    }
  	body {
  		background: linear-gradient(#3fd2ff, #1f4cff, #806aff);
  	}
  	a {
  		text-decoration: none;
  	}
  	header {
  		display: flex;
  		justify-content: center;
  		margin: 20px;
  	}
  	video {
  		background-color: #333;
  		width: 80%;
  		border-radius: 10px;
  		margin: 0px 10%;
  	}
  	.honour {
  		box-sizing: border-box;
  		width: 80%;
  		margin: 20px 10%;
  		padding: 0 4px 4px 4px;
  		background: linear-gradient(90deg, #3fd2ff, #fff );
  		border-radius: 10px;
  	}
  	.alert {
  		text-align: center;
  		box-sizing: border-box;
  		width: 80%;
  		margin: 20px 10%;
  		padding: 5px;
  		background: linear-gradient(90deg, #3fd2ff, #fff );
  		border-radius: 10px;
  		font-size: 16px;
  		letter-spacing: 5px;
  		color: #2c62fa;
  	}
  	.honour .label {
  		text-align: center;
  		color: #2c62fa;
  		letter-spacing: 5px;
  		font-size: 16px;
  		padding: 5px 0;
  	}
  	.honour .text {
  		padding: 5px 0;
  		background-color: #2c62fa;
  		color: #fff;
  		letter-spacing: 5px;
  		font-size: 14px;
  		text-align: center;
  		border-bottom-left-radius: 10px;
  		border-bottom-right-radius: 10px;
  	}
  	.join {
  		box-sizing: border-box;
  		display: block;
  		width: 80%;
  		margin: 20px 10%;
  		padding: 5px;
  		text-align: center;
  		letter-spacing: 5px;
  		color: #fff;
  		background: linear-gradient(90deg, #3fd2ff, #c37fff);
  		border-radius: 10px;
  		box-shadow: 3px 3px 5px #666;
  	}
  	.join:active {
  		transform: translate(3px, 3px);
  		box-shadow: none;
  	}
	</style>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" charset="utf-8">
	    wx.config({!! $js->config(array('onMenuShareAppMessage', 'onMenuShareTimeline')) !!});
	    wx.ready(function() {
		    wx.onMenuShareTimeline({
			    title: '我正在参加广场舞大赛，为我喝彩吧～',
			    link: 'http://wap.zhongkaiyun.com/match/result/{{ $result->id }}',
			    imgUrl: 'http://wap.zhongkaiyun.com/image/logo.png'
			});
			wx.onMenuShareAppMessage({
			    title: '我正在参加广场舞大赛，为我喝彩吧～',
			    desc: '我的表演现场，可视频观看',
			    link: 'http://wap.zhongkaiyun.com/match/result/{{ $result->id }}',
			    imgUrl: 'http://wap.zhongkaiyun.com/image/logo.png'
			});
	    })
	</script>
  </head>
  <body>
  	<header>
  		<img src="/image/logo.png" width="50%" height="50%" />
  	</header>
  	@if($result && $result->video && $result->honour)
  	<section>
  		<video src="{{ $result->video }}" height="160px" controls autoplay preload="auto"></video>
  	</section>
  	<section>
  		<div class="honour">
  			<div class="label">本次比赛获得荣誉</div>
  			<div class="text">{{ $result->honour }}</div>
  		</div>
  	</section>
  	<a class="join" href="https://mp.weixin.qq.com/s?__biz=MzAwNTAyNzEwOQ==&mid=503151575&idx=1&sn=49cb1cce3c4b03d5dc87218664507990&chksm=032b3f9d345cb68b2bdab17fb08c7e6330221593a616354450743063f7286dfdb0a61f92659e#rd">关于街区体育</a>
  	@else
  	<section>
  		<div class="alert">
  			比赛成绩尚未公布
  		</div>
  	</section>
  	@endif
  </body>
</html>
