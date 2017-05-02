<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.card {
			position: relative;
			margin: 50px;
			width: 300px;
			height: 300px;
			font-size: 22px;
			color: #fff;
			text-shadow: 0 0 3px #eee;
		}
		.card .positive {
			position: absolute;
			width: 100%;
			height: 100%;
			background-color: red;
			transform: rotate3d(1, 0, 0, 0deg);
			border-radius:25px;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
		}
		.card .negative {
			position: absolute;
			width: 100%;
			height: 100%;
			background-color: blue;
			transform: rotate3d(1, 0, 0, 180deg);
			border-radius:25px;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.animated {
		  backface-visibility: hidden;
		  animation-duration: 2s;
		  animation-fill-mode: both;
		  animation-timing-function: ease-in-out;
		}


		.flip .positive {
		  animation-name: positive-flip;
		}
		@keyframes positive-flip {
		  from {
		    transform: perspective(400px) rotate3d(1, 0, 0, 0deg);
		    /*animation-timing-function: ease-in;*/
		  }

		  30% {
		    transform: perspective(400px) rotate3d(1, 0, 0, -10deg);
		    /*animation-timing-function: ease-in;*/
		  }

		  80% {
		    transform: perspective(400px) rotate3d(1, 0, 0, 200deg);
		  }

		  90% {
		    transform: perspective(400px) rotate3d(1, 0, 0, 170deg);
		  }

		  to {
		    transform: perspective(400px) rotate3d(1, 0, 0, 180deg);
		  }
		}

		.flip .negative {
		  animation-name: negative-flip;
		}
		@keyframes negative-flip {
		  from {
		    transform: perspective(400px) rotate3d(1, 0, 0, 180deg);
		    /*animation-timing-function: ease-in;*/
		  }

		  30% {
		    transform: perspective(400px) rotate3d(1, 0, 0, 170deg);
		    /*animation-timing-function: ease-in;*/
		  }

		  80% {
		    transform: perspective(400px) rotate3d(1, 0, 0, 380deg);
		  }

		  90% {
		    transform: perspective(400px) rotate3d(1, 0, 0, 350deg);
		  }

		  to {
		    transform: perspective(400px) rotate3d(1, 0, 0, 360deg);
		  }
		}
	</style>
</head>
<body>
	<div class="card">
		<div class="positive animated">
			<img src="image/logo.png" width="100">
			<p>任务卡</p>
		</div>
		<div class="negative animated">恭喜你领取了箭艺任务</div>
	</div>
	<script type="text/javascript" src="{{ mix('js/common.js') }}"></script>
	<script type="text/javascript">
	$('.card').click(function() {
		console.log('click')
		$(this).addClass('flip')
	})
	</script>
</body>
</html>
