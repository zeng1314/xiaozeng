<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/jquery/3.3.0/jquery.min.js"></script>
    <title>信息提示</title>
</head>
<body style="background: #000">
	<div class="container" style="text-align: center;margin: 200px auto">
		<h1 style="color: #fff"><?php echo $msg;?></h1>
        <hr>
		<p><a href="<?php echo $this->url;?>">等待 <span id="time">3</span> s或者点击跳转...</a></p>
		<p>
			<a class="btn btn-default btn-lg">关于作者</a>
		</p>
	</div>
</body>
<script>
    $(function () {
        // 设置定时器
        setInterval(function () {
            // 获取事件标签里面的内容
            var time = $('#time').html();
            // alert(time);
            // 时间自减
            time--;
            if (time==0){
                location.href="<?php echo $this->url;?>"
            }
            $('#time').html(time);
        },1000)
    })
</script>
</html>