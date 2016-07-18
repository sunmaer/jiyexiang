<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台管理系统</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="/jiyexiang/Public/css/admin.css">
	<script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
	<!-- jquery插件表单验证 -->
	<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/lib/jquery.js"></script>
	<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
	<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/localization/messages_zh.js"></script>
	<script type="text/javascript">
		 function toData(){				 	
			var yyyy=document.getElementById("year1").value;
			var mm=document.getElementById("month1").value;	
			var dd=document.getElementById("data1").value;
			try{							
				document.getElementById("startdate").value =  yyyy+"-"+mm+"-"+dd;
				var date1=document.getElementById("startdate").value;
				if(new Date(date1).getDate() == date1.substring(date1.length - 2)){
					return true;
				}
				else{
					alert("输入的日期有误");
				}
			}catch(e){
				alert("输入的日期有误");	
			}
		};
		function toData2(){				 	
			var yyyy=document.getElementById("year2").value;
			var mm=document.getElementById("month2").value;	
			var dd=document.getElementById("data2").value;
			try{							
				document.getElementById("enddate").value =  yyyy+"-"+mm+"-"+dd;
				var date2=document.getElementById("enddate").value;
				if(new Date(date2).getDate() == date2.substring(date2.length - 2)){
					return true;
				}
				else{
					alert("输入的日期有误");
				}
			}catch(e){
				alert("输入的日期有误");	
			}
		};
		$(function() {
			// 一级菜单
			$(".co").on("click",function(){
				if ($(this).siblings("ul").css("display") == "none"){
					$(".co").siblings("ul").slideUp("500");
					$(".words").removeClass("icon-word1");
					$(this).siblings("ul").slideDown("slow");
					$(this).children("span:eq(0)").removeClass("icon-word");
			  		$(this).children("span:eq(1)").addClass("icon-word1");	
				}
				else {
					$(this).siblings("ul").slideUp("500");
					$(this).children("span:eq(1)").removeClass("icon-word1");
				}
			});
			$("#mobilemenu").on("click",function(){
				if ($(".sidebar").offset().left=="-220") {
					$(".sidebar").animate({left:"0"},500);
				}
				 else {
				 	$(".sidebar").animate({left:"-220"},500);
				 }
			});
			// 用户审核状态切换
			// $(".alluser-verify").on("click",function() {
			// 	if ($(this).text()=="未审核") {
			// 			if(confirm("确定用户通过审核吗")){
			// 				$(this).removeClass("alluser-abutton");
			// 				$(this).addClass("alluser-button");
			// 				$(this).text("已审核");
			// 			}
			// 	}
			// 	else {
			// 		if(confirm("确定取消用户审核吗")) {
			// 			$(this).removeClass("alluser-button");
			// 			$(this).addClass("alluser-abutton");
			// 			$(this).text("未审核");
			// 		}
			// 	}
			// });

			// 批量删除
			$(".alluser-choose").on("click",function() {
				if ($(this).hasClass("alluser-choose")) {
					$(this).removeClass("alluser-choose").addClass("alluser-achoose");
					$(this).addClass("icon-choose");
				}
				else {
					$(this).removeClass("alluser-achoose").addClass("alluser-choose");
					$(this).removeClass("icon-choose");
				}
			});
		});
		// 修改管理员密码表单验证
			$().ready(function() {
			// 在键盘按下并释放及提交后验证提交表单
			  $("#alterInfoForm").validate({
				    rules: {
				      alterInfo_confirmpwd: {
				        equalTo: "#alterInfo-newpwd"
				      },
				    },
				    messages: {
				    	alterInfo_confirmpwd: {
				    	required: "请输入确认密码",
				        equalTo: "两次密码输入不一致"
				      },
				    }
			})
		 })
		// 添加用户表单验证
		$().ready(function() {
		// 在键盘按下并释放及提交后验证提交表单
		  $("#adduserForm").validate({
			    rules: {
			      user_rname: {
			        required: true,
			        // digits: true,
			        rangelength: [6,12]
			      },
			      user_name: {
			        required: true,
			        minlength: 2
			      },
			      user_pwd: {
			        required: true,
			        rangelength: [6,16]
			      },
			      user_confirmpwd: {
			        required: true,
			        equalTo: "#user_pwd"
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
			      user_rname: {
			        required: "请输入注册账号",
			        // digits: "注册账号由 7-11 个数字组成",
			        rangelength: "注册账号由 6-12 个字符组成",
			      },
			      user_name: {
			        required: "请输入客户姓名",
			        minlength: "客户姓名至少由两个字符组成"
			      },
			      user_pwd: {
			        required: "请输入登录密码",
			        rangelength: "密码由 6-16 个字符组成",
			      },
			      user_confirmpwd: {
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
		});
	</script>
</head>
<body>
	<div id="header">
	    <span id="mobilemenu" class="icon-menu"></span>
		<h1><span class="icon icon-logo"></span>ZeroDegree</h1>
		<a href="<?php echo U('Admin/alt');?>" id="user">
			<img src="/jiyexiang/Public/images/user.jpg" />
			<span>Welcome,<strong><?php echo ($_SESSION['auth']['user']); ?></strong></span>
		</a>
	</div>
	<div id="container">
		<div class="sidebar">
			<div class="menu">
				<a href="<?php echo U('Home/Index/index');?>"><span class="icon1 icon-index" title="前台首页"></span></a>
				<a href="<?php echo U('Material/index');?>"><span class="icon1 icon-info" title="修改信息"></span></a>
				<a href="<?php echo U('Admin/logout');?>"><span class="icon1 icon-loginout" title="退出登录"></span></a>
			</div>
			<ul id="nav">
				<li class="navmenu">
				<div class="co">
					<span class="icon2 icon-cailiao"></span><span class="words icon-word">材料管理</span>
				</div>
					<ul>
						<li><a href="<?php echo U('Material/index');?>"><span class="icon-item"></span>材料公式设置</a></li>
					</ul>
				</li>
				<hr>
				<li class="navmenu">
				<div class="co">
					<span class="icon2 icon-baojia"></span><span class="words icon-word">报价管理</span>
				</div>
					<ul>
						<li><a href="<?php echo U('Admin/Count/Index');?>"><span class="icon-item"></span>报价查询</a></li>
					</ul>
				</li>
				<hr>
				<li class="navmenu">
				<div class="co">
					<span class="icon2 icon-yonghu"></span><span class="words icon-word">用户管理</span>
				</div>
					<ul>
						<li><a href="<?php echo U('User/approve');?>"><span class="icon-item"></span>审批用户</a></li>
						<li><a href="<?php echo U('User/index');?>"><span class="icon-item"></span>通过用户</a></li>
						<li><a href="<?php echo U('Admin/User/adduser');?>"><span class="icon-item"></span>添加用户</a></li>
					</ul>
				</li>
				<hr>
				<li class="navmenu">
				<div class="co">
					<span class="icon2 icon-seo"></span><span class="words icon-word">网站设置</span>
				</div>
					<ul>
						<li><a href="<?php echo U('Admin/System/config');?>"><span class="icon-item"></span>seo优化设置</a></li>
						<li><a href="<?php echo U('Admin/System/dataBackups');?>"><span class="icon-item"></span>数据库备份</a></li>
					</ul>
				</li>
				<hr>
				<li class="navmenu">
				<div class="co">
					<span class="icon2 icon-admin"></span><span class="words icon-word">管理员</span>
				</div>
					<ul>
						<li><a href="<?php echo U('Admin/Index/index');?>"><span class="icon-item"></span>系统信息</a></li>
						<li><a href="<?php echo U('Admin/alt');?>"><span class="icon-item"></span>修改信息</a></li>
					</ul>
				</li>
				<hr>
			</ul>
		</div>
		<div id="right">
			<p class="welcome">欢迎使用 <strong class="blue">ZeroDegree</strong> 后台管理系统 V2.0</p>
			<div class="content">
	<div class="wrapper">
		<p class="title">版块说明</p>
		<div class="info">
			你好！欢迎使用ZeroDegree后台管理系统管理“凡创电气基业箱报价系统”！
			<br />
			你可以在本版块查看所有用户信息，还可以按特定条件对用户进行查询。你还可以对用户进行审核、修改、删除操作。
			<br />如果你需要添加用户，请点击 <a href="<?php echo U('User/adduser');?>" class="link">添加用户</a>
		</div>
	</div>
	<div class="alluser-search">
	<form action="<?php echo U('User/index');?>" method="post">
			<span class="icon-search"></span><input type="text" placeholder="输入注册账号或者客户姓名或者邮箱" name="search"/><input type="submit" value="搜索" />
	</form>
	</div>
	<table class="alluser-table">
		<tr>
			<th class="rname">注册账号</th>
			<th class="alluser-name namehidden">客户姓名</th>
			<th class=" comnamehidden">公司名称</th>
			<th class=" comphonehidden">公司电话</th>
			<th class=" phonehidden">手机号码</th>
			<th class=" qqhidden">QQ号</th>
			<th class=" weixinhidden">微信号</th>
			<th class="alluser-shenhe">状态</th>
			<th class="alluser-caozuo">操作</th>
		</tr>
		<?php if(is_array($data)): foreach($data as $k=>$vo): ?><tr>
			<td><?php echo ($vo["username"]); ?></td>
			<td class="namehidden"><?php echo ($vo["name"]); ?></td>
			<td class=" comnamehidden"><?php echo ($vo["companyname"]); ?></td>
			<td class=" comphonehidden"><?php echo ($vo["companyphone"]); ?></td>
			<td class=" phonehidden"><?php echo ($vo["selfphone"]); ?></td>
			<td class=" qqhidden"><?php echo ($vo["qq"]); ?></td>
			<td class=" weixinhidden"><?php echo ($vo["wechat"]); ?></td>
			<td>
				<button id="<?php echo ($vo['i']); ?>" class="alluser-verify alluser-button">已审核</button>
			</td>
			<td>
				<a href="<?php echo U('User/alteruser',array('id'=>$vo['id']));?>"><span class="alluser-icon icon-alter" title="修改用户信息"></span></a>
				<a href="<?php echo U('User/deluser',array('id'=>$vo['id']));?>"><span class="alluser-icon icon-delete" title="删除用户" ></span></a>
			</td>
		</tr><?php endforeach; endif; ?>
	</table>
	<div class="tfoot">
			<div class="page">
				<?php echo ($page); ?>
			</div>
	</div>
</div>
			<div id="footer">
				<span class="c-hidden">Copyright </span>© 2016 <strong class="zero">零度工作室</strong> 版权所有
				<img src="/jiyexiang/Public/images/zero.png" />
			</div>
		</div>
	</div>
</body>
</html>