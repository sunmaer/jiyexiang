<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户登录</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="/jiyexiang/Public/css/login.css">
	<script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
	<!-- 表单验证 -->
	<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/lib/jquery.js"></script>
	<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
	<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/localization/messages_zh.js"></script>
	<script>
	$().ready(function() {
	// 在键盘按下并释放及提交后验证提交表单
	  $("#signupForm").validate({
		    rules: {
		      username: {
		        required: true,
		        // digits: true,
		        rangelength: [6,12]
		      },
		      password: {
		        required: true,
		        rangelength: [6,16]
		      },
		    },
		    messages: {
		      username: {
		        required: "请输入注册账号",
		        digits: "注册账号由 6-12 个字符组成",
		        rangelength: "注册账号由 6-12 个字符组成",
		      },
		      password: {
		        required: "请输入登录密码",
		        rangelength: "密码由 6-16 个字符组成",
		      },
		  },
		});
	});
</script>
</head>
<body>
	<div id="container">
		<div id="form">
			<p><span class="word-hidden">凡创电气基业箱报价系统</p>
			<form id="signupForm" action="<?php echo U('Log/checklogin');?>" method="post">
			<div class="item">
				<label for="user_name"><span class="icon icon-name"></span></label>
				<input type="text" id="user_name" name="username" placeholder="注册账号" />
			</div>
			<div class="item">
				<label for="user_pwd"><span class="icon icon-pwd"></span></label>
				<input type="password" id="user_pwd" name="password" placeholder="登录密码"/>
			</div>
				<a class="forpwd" href="<?php echo U('Log/findpaw');?>"}>忘记密码</a>
				<a class="freereg"href="/jiyexiang/index.php/Home/Log/register">免费注册</a>
				<input type="submit" value="登&nbsp;&nbsp;录">
			</form>
		</div>
	</div>
</body>
</html>