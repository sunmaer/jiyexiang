<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户注册</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="/jiyexiang/Public/css/register.css">
	<script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
	<!-- 表单验证 -->
	<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/lib/jquery.js"></script>
	<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
	<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/localization/messages_zh.js"></script>
	<script>
	function checkUser(){
		var val = $("#user_rname").val();
		$.get('<?php echo U('Log/checkuser');?>',{'user_rname':val},function(data){
			if (data==1) {
				return true;
			}else{
				alert(data);
			}
		});
	}
	function checkEmail(){
		var val = $("#user_email").val();
		$.get('<?php echo U('Log/checkemail');?>',{'email':val},function(data){
			if (data==1) {
				return true;
			}else{
				$("#user_email").attr("value","");
				alert(data);
			}
		});
	}
	$().ready(function() {
	// 在键盘按下并释放及提交后验证提交表单
	  $("#signupForm").validate({
		    rules: {
		      username: {
		        required: true,
		        // digits: true,
		        rangelength: [6,12]
		      },
		      name: {
		        required: true,
		        minlength: 2
		      },
		      password: {
		        required: true,
		        rangelength: [6,16]
		      },
		      user_confirmpwd: {
		        required: true,
		        equalTo: "#user_pwd"
		      },
		      selfphone: {
		      	required: true,
		      	digits: true,
		        minlength: 11,
		        maxlength: 11
		      },
		      email: {
		        required: true,
		        email: true
		      },
		    },
		    messages: {
		      username: {
		        required: "请输入注册账号",
		        // digits: "注册账号由 7-11 个数字组成",
		        rangelength: "注册账号由 6-12 个字符组成",
		      },
		      name: {
		        required: "请输入客户姓名",
		        minlength: "客户姓名至少由两个字符组成"
		      },
		      password: {
		        required: "请输入登录密码",
		        rangelength: "密码由 6-16 个字符组成",
		      },
		      user_confirmpwd: {
		        required: "请输入确认密码",
		        equalTo: "两次密码输入不一致"
		      },
		      selfphone: {
		      	required: "请输入手机号码",
		      	digits: "手机号码为11位数字",
		      	minlength: "请输入一个正确的手机号码",
		      	maxlength: "请输入一个正确的手机号码",
		      },
		      email: "请输入一个正确的邮箱",
		    }
		});
	});
</script>
</head>
<body>

	<div id="container">
		<div id="form">
			<p class="title">注册信息</p>
			<p class="cue">已有账号？<a href="<?php echo U('Log/Index');?>">立即登录</a></p>
			<div class="clear"></div>
			<form class="signupForm" id="signupForm" action="<?php echo U('Log/doregister');?>" method="post">
			<div class="item">
				<label for="user_rname">
					<div class="info">
						<span class="icon icon-rname"></span>
						<span class="info-word"><em>*</em>注册账号</span>
					</div>
				</label>
				<input type="text" id="user_rname" onblur="checkUser()" name="username" placeholder="注册账号为 7-11 个数字" />
			</div>
			<div class="item">
				<label for="user_name">
					<div class="info">
						<span class="icon icon-name"></span>
						<span class="info-word"><em>*</em>客户姓名</span>
					</div>
				</label>
				<input type="text" id="user_name" name="name" placeholder="客户姓名至少为两个字符" />
			</div>
			<div class="item">
				<label for="user_pwd">
					<div class="info">
						<span class="icon icon-pwd"></span>
						<span class="info-word"><em>*</em>登录密码</span>
					</div>
				</label>
				<input type="password" id="user_pwd" name="password" placeholder="登录密码为 6-16 个字符"/>
			</div>
			<div class="item">
				<label for="user_confirmpwd">
					<div class="info">
						<span class="icon icon-confirmpwd"></span>
						<span class="info-word"><em>*</em>确认密码</span>
					</div>
				</label>
				<input type="password" id="user_confirmpwd" name="user_confirmpwd" placeholder=""/>
			</div>
			<div class="item">
				<label for="user_comname">
					<div class="info">
						<span class="icon icon-comname"></span>
						<span class="info-word">公司名称</span>
					</div>
				</label>
				<input type="text" id="user_comname" name="companyname" />
			</div>
			<div class="item">
				<label for="user_comphone">
					<div class="info">
						<span class="icon icon-comphone"></span>
						<span class="info-word">公司电话</span>
					</div>
				</label>
				<input type="text" id="user_comphone" name="companyphone" />
			</div>
			<div class="item">
				<label for="user_address">
					<div class="info">
						<span class="icon icon-address"></span>
						<span class="info-word">地址</span>
					</div>
				</label>
				<input type="text" id="user_address" name="address" />
			</div>
			<div class="item">
				<label for="user_phone">
					<div class="info">
						<span class="icon icon-phone"></span>
						<span class="info-word"><em>*</em>手机号码</span>
					</div>
				</label>
				<input type="text" id="user_phone" name="selfphone" />
			</div>
			<div class="item">
				<label for="user_email">
					<div class="info">
						<span class="icon icon-email"></span>
						<span class="info-word"><em>*</em>邮箱</span>
					</div>
				</label>
				<input type="text" onblur="checkEmail()" id="user_email" name="email" />
			</div>
			<div class="item">
				
			</div>
			<div class="item">
				<label for="user_qq">
					<div class="info">
						<span class="icon icon-qq"></span>
						<span class="info-word">QQ号</span>
					</div>
				</label>
				<input type="text" id="user_qq"  name="qq" />
			</div>
			<div class="item">
				<label for="user_weixin">
					<div class="info">
						<span class="icon icon-weixin"></span>
						<span class="info-word">微信号</span>
					</div>
				</label>
				<input type="text" id="user_weixin" name="wechat" />
			</div>
				<input type="submit" value="立即注册">
			</div>
			<div class="clear"></div>
			</form>
		</div>
	</div>
</body>
</html>