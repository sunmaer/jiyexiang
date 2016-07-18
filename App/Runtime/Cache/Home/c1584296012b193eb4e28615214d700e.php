<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>忘记密码</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="/jiyexiang/Public/css/login.css">
	<script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
	<div id="container" class="forget-pwd">
		<div id="form">
			<!-- <p><span class="word-hidden">凡创电气基业箱报价系统</p> -->
			<form  action="<?php echo U('Log/mail');?>" method="post">
				<label for="user-regemail"><span class="icon icon-regemail"></span></label>
				<input type="text" id="user-regemail" required="required" placeholder="注册邮箱/注册账号" name="find"/>
			<a class="forpwd"href="<?php echo U('Log/Index');?>">返回登录</a>
			<a class="freereg"href="<?php echo U('Log/register');?>">免费注册</a>
			<input type="submit" value="确&nbsp;&nbsp;定">
			</form>
		</div>
	</div>
</body>
</html>