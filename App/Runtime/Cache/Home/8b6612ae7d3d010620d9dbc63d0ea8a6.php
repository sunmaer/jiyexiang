<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	 <meta charset="utf-8">
    <title><?php echo ($SiteInfo["title"]); ?></title>
    <meta name = "keywords" content="<?php echo ($SiteInfo["keywords"]); ?>" >
    <meta name = "description" content="<?php echo ($SitInfo["description"]); ?>" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="/jiyexiang/Public/css/index.css">
	<script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
	<!-- 表单验证 -->
	<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/lib/jquery.js"></script>
	<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
	<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/localization/messages_zh.js"></script>
	<script>
	$().ready(function() {
	// 在键盘按下并释放及提交后验证提交表单
	  $("#user_info").validate({
		    rules: {
		      user_name: {
		        required: true,
		        minlength: 2
		      },
		      user_pwd: {
		        required: true,
		        rangelength: [6,16]
		      },
		      user_newpwd: {
		      	required: true,
		        rangelength: [6,16]
		      },
		      user_connewpwd: {
		        required: true,
		        equalTo: "#user_newpwd"
		      },
		      user_phone: {
		      	required: true,
		      	digits: true,
		        minlength: 11,
		        maxlength: 11
		      },
		      user_email: {
		        required: true,
		        email: true
		      },
		    },
		    messages: {
		      user_name: {
		        required: "请输入客户姓名",
		        minlength: "客户姓名至少由两个字符组成"
		      },
		      user_pwd: {
		        required: "请输入登录密码",
		        rangelength: "密码由 6-16 个字符组成",
		      },
		      user_newpwd: {
		        required: "请输入登录密码",
		        rangelength: "密码由 6-16 个字符组成",
		      },
		      user_connewpwd: {
		        required: "请输入确认密码",
		        equalTo: "两次密码输入不一致"
		      },
		      user_phone: {
		      	required: "请输入手机号码",
		      	digits: "手机号码为11位数字",
		      	minlength: "请输入一个正确的手机号码",
		      	maxlength: "请输入一个正确的手机号码",
		      },
		      user_email: "请输入一个正确的邮箱",
		    }
		});
	  $("#signupForm").validate({
		    rules: {
		      height: {
		        required: true,
		        digits: true,
		        range: [0,5000]
		      },
		      width: {
		        required: true,
		        digits: true,
		        range: [0,5000]
		      },
		      depth: {
		        required: true,
		        digits: true,
		        range: [0,5000]
		      },
		      door_depth: {
		        required: true,
		        number: true,
		        range: [0.1,10]
		      },
		      box_depth: {
		        required: true,
		        number: true,
		        range: [0.1,10]
		      },
		      block_depth: {
		        required: true,
		        number: true,
		        range: [0.1,10]
		      },
		    },
		    messages: {
		      height: {
		        required: "请输入基业箱的高",
		        digits: "高为0~5000内的整数(mm)",
		        range: "高为0~5000内的整数(mm)"
		      },
		      width: {
		        required: "请输入基业箱的宽",
		        digits: "宽为0~5000内的整数(mm)",
		        range: "宽为0~5000内的整数(mm)"
		      },
		      depth: {
		        required: "请输入基业箱的深",
		        digits: "深为0~5000内的整数(mm)",
		        range: "深为0~5000内的整数(mm)"
		      },
		      door_depth: {
		        required: "请输入门厚度",
		        number: "门厚度为0.1~10内的一位小数(mm)",
		        range: "门厚度为0.1~10内的一位小数(mm)",
		      },
		      box_depth: {
		        required: "请输入箱体厚度",
		        number: "箱体厚度为0.1~10内的一位小数(mm)",
		        range: "箱体厚度为0.1~10内的一位小数(mm)",
		      },
		      block_depth: {
		        required: "请输入安装板厚度",
		        number: "安装板厚度为0.1~10内的一位小数(mm)",
		        range: "安装板厚度0.1~10内的一位小数(mm)",
		      },
		    }
		});
	});
</script>
	<script type="text/javascript">
		$(function() {
			// 一级菜单
			$("#hiddenmenu").on("click",function(){
				if ($("#mobile-nav").css("display") == "none"){
					$("#mobile-nav").slideDown("slow");	
				}
				else {
					$("#mobile-nav").slideUp("500");
				}
			})
			// 移动端导航二级菜单
			$("#mobile-menu").on("click",function(){
				if ($("#mobile-subnav").css("display") == "none"){
					$("#mobile-subnav").slideDown("slow");
					$("#icon1").removeClass("icon-menu");
			  		$("#icon1").addClass("icon-menu1");		
				}
				else {
					$("#mobile-subnav").slideUp("500");
					$("#icon1").removeClass("icon-menu1");
			  		$("#icon1").addClass("icon-menu");
				}
			})
			// PC端导航二级菜单
			$("#laptop-menu").on("click",function(){
				if ($("#laptop-subnav").css("display") == "none"){
					$("#laptop-subnav").slideDown("slow");
					$("#icon2").removeClass("icon-menu");
			  		$("#icon2").addClass("icon-menu1");		
				}
				else {
					$("#laptop-subnav").slideUp("500");
					$("#icon2").removeClass("icon-menu1");
			  		$("#icon2").addClass("icon-menu");
				}
			})
		})
	</script>
</head>
<body>
	<div id="header">
		<div class="center">
			<img class="logo" src="/jiyexiang/Public/images/logo.png">
			<h1 class="h1-hidden">凡创电气专业生产配电箱，全过免费客服热线：<span>400-018-1188</span>
			</h1>
			<img id="hiddenmenu" class="menu" src="/jiyexiang/Public/images/menu.png">
		</div>
	</div>
	<div>
		<ul id="mobile-nav">
			<li><a href="<?php echo U('Log/alt');?>">用户信息</a></li>
			<li><a href="<?php echo U('Log/altpaw');?>">修改密码</a></li>
			<li id="mobile-menu"><a href="javascript:?"><span class="mobile-baojia"><span id="icon1" class="icon1 icon-menu"></span>产品报价</span></a>
				<ul id="mobile-subnav">
						<li><a href="<?php echo U('Count/Index','','');?>">基业箱</a></li>
				</ul>
			</li>
			<li><a href="<?php echo U('Log/logout');?>">退出登录</a></li>
		</ul>
	</div>
	<div class="container">
		<div class="sidebar">
			<ul id="laptop-nav">
				<li><a href="<?php echo U('User/alt');?>">用户信息</a></li>
				<li><a href="<?php echo U('Log/altpaw');?>">修改密码</a></li>
				<li id="laptop-menu"><a href="javascript:?"><span class="laptop-baojia"><span id="icon2" class="icon2 icon-menu"></span>产品报价</span></a>
					<ul id="laptop-subnav">
						<li><a href="<?php echo U('Count/Index','','');?>">基业箱</a></li>
					</ul>
				</li>
				<li><a href="<?php echo U('Log/logout');?>">退出登录</a></li>
			</ul>
		</div>
		<div class="right">
<form id="user_info" action="<?php echo U('Log/doalt');?>" method="post">
	<div class="item">
		<label for="user_rname" action="<?php echo U('Log/doalt',array('id'=>$data['id']));?>" method="post">
		<div class="user-input">
			<span class="icon3 icon-rname"></span>
			<span class="info-word">注册账号</span>
		</div>
	</label>
	<input type="text" id="user_rname" readonly  name="username" value="<?php echo ($data['username']); ?>" />
	</div>
	<div class="item">
		<label for="user_name">
		<div class="user-input">
			<span class="icon3 icon-name"></span>
			<span class="info-word"><em>*</em>客户姓名</span>
		</div>
	</label>
	<input type="text" id="user_name"  name="name" value="<?php echo ($data['name']); ?>" />
	</div>
	<div class="item">
		<label for="user_comname">
		<div class="user-input">
			<span class="icon3 icon-comname"></span>
			<span class="info-word">公司名称</span>
		</div>
	</label>
	<input type="text" id="user_comname" name="companyname" value="<?php echo ($data['companyname']); ?>" />
	</div>
	<div class="item">
		<label for="user_comphone">
		<div class="user-input">
			<span class="icon3 icon-comphone"></span>
			<span class="info-word">公司电话</span>
		</div>
	</label>
	<input type="text" id="user_comphone" name="companyphone" value="<?php echo ($data['companyphone']); ?>"/>
	</div>
	<div class="item">
		<label for="user_address">
		<div class="user-input">
			<span class="icon3 icon-address"></span>
			<span class="info-word">地址</span>
		</div>
	</label>
	<input type="text" id="user_address" name="address" value="<?php echo ($data['address']); ?>" />
	</div>
	<div class="item">
		<label for="user_phone">
		<div class="user-input">
			<span class="icon3 icon-phone"></span>
			<span class="info-word"><em>*</em>手机号码</span>
		</div>
	</label>
	<input type="text" id="user_phone"  name="selfphone" value="<?php echo ($data['selfphone']); ?>" />
	</div>
	<div class="item">
		<label for="user_email">
		<div class="user-input">
			<span class="icon3 icon-email"></span>
			<span class="info-word"><em>*</em>邮箱</span>
		</div>
	</label>
	<input type="text" id="user_email" name="email" value="<?php echo ($data['email']); ?>"/>
	</div>
	<div class="item">
		<label for="user_qq">
		<div class="user-input">
			<span class="icon3 icon-qq"></span>
			<span class="info-word">QQ号</span>
		</div>
	</label>
	<input type="text" id="user_qq" name="qq" value="<?php echo ($data['qq']); ?>"/>
	</div>
	<div class="item">
		<label for="user_weixin">
		<div class="user-input">
			<span class="icon3 icon-weixin"></span>
			<span class="info-word">微信号</span>
		</div>
	</label>
	<input type="text" id="user_weixin" name="wechat" value="<?php echo ($data['wechat']); ?>"/>
	</div>
	<input type="submit" value="保&nbsp;&nbsp;存">
</form>
</div>
</div>
<div id="footer">
		<p>版权所有©温州市凡创电气有限公司<span class="word-hidden"><span class="box-hidden">-配电箱、不锈钢配电箱、多媒体照明箱、等电位配电箱、光纤入户箱</span>&nbsp;&nbsp;&nbsp;&nbsp;电话：0577-62783779&nbsp;&nbsp;&nbsp;&nbsp;传真：0577-62783799<span class="fanchuang-hidden">&nbsp;&nbsp;&nbsp;&nbsp;技术支持：凡创科技</span></span></p>
		<p><span class="word-hidden"><span class="fanchuang-hidden">地址：浙江省乐清市柳市镇长江路33号&nbsp;&nbsp;&nbsp;&nbsp;</span>QQ：29178521 32396279&nbsp;&nbsp;&nbsp;&nbsp;<span class="website-hidden">网址：<a href="http://www.4000181188.com" target="_blank">http:/http://www.4000181188.com </a>&nbsp;&nbsp;&nbsp;&nbsp;</span></span>备案号：浙ICP备0701106611号</p>
</div>
</body>
</html>