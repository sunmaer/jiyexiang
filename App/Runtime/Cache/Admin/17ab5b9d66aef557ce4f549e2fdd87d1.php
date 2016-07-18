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
		<p class="title">公式说明</p>
		<div class="info">
			你好！欢迎使用ZeroDegree后台管理系统管理“凡创电气基业箱报价系统”！
			<br />你可以在本版块修改、删除、添加公式。
			<p>请在修改前做好数据库备份，以免错乱无法恢复；</p>
			<p>用户输入的数据（箱高，箱厚，塑粉颜色等关键字）不能改变；</p>
			<p>现有公式请谨慎删除，因为相应配置项（锁类型，产品型号等会影响客户端计算页面显示），如有变动请修改其比较符号、比较条件、比较结果，勿对条件对象及判定项做修改，若对前台页面显示无影响可修改；</p>
			<p>添加公式后，累加项改变，记得为添加公式后的所有公式的先后计算顺序排序，特别注意累加项的计算顺序；</p>
			<p>添加公式应保证其左右括号匹配完整性，只能使用小括号（‘（）’），不区分中英文！公式运算符只支持’+-*/‘,请勿使用其他运算符号；</p>
			<p>在配置不变常量时，注意非判定项要与公式中的项名一致，在配置判定量时，判定项要与公式中的项名一致，比较条件符号只支持“'<=','>=','=','<','>'”这五种,并且一个判定项的比较运算符只能选择一种,条件对象为客户输入的对象（箱高，箱厚，锁类型等），名称要一致，比较结果为判定后取值。特别注意：配置项要与公式中的项名一致，条件对象要与客户的输入集合中的名一致，注意多条判断的先后顺序逻辑性，逻辑错误可能导致最终取值错误！</p>
		</div>
	</div>
	<div class="wrapper">
		<p class="title">现用公式</p>
		<div class="info">
			<form id="form" action="<?php echo U('Material/altforsta');?>" method="post" >
				<?php if(is_array($for)): foreach($for as $k=>$vo): ?><div class="formula">
						<?php echo ($vo['name']); ?>:<strong><?php echo ($vo['formulate']); ?></strong><br>
						<input type="text" name="id[]" value="<?php echo ($vo['id']); ?>" style="display: none;" />
						<span>计算顺序：</span><input type="text" name="corder[]" value="<?php echo ($vo['corder']); ?>"><br>	
							<span>使用状态：</span><select id="sta" name="sta[]">
							<option value="1">是</option>
							<option value="0">否</option>
						</select><br>
						<a href="<?php echo U('Material/altonefor',array('id'=>$vo['id']));?>">修改公式</a>
						<a href="<?php echo U('Material/delonefor',array('id'=>$vo['id']));?>">删除公式</a><br>
					</div><?php endforeach; endif; ?>
			<button class="xiugai">修改</button>
			</form>
		</div>
		</div>
		<div class="wrapper">
			<p class="title">添加公式</p>
			<div class="formula-info">
			<form action="<?php echo U('addfor');?>" method="post">
				<span>计算式名称：</span><input type="text" name="name"></input><br>
				<span>计算式：</span><textarea name="formulate"></textarea><br>
				<button type="submit">添加</button><br>
			</form>
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
<script type="text/javascript">
	var arr=<?php echo json_encode($for);?>;
	var sta=[];
	for (var i = 0; i < arr.length; i++) {
		sta[i]=arr[i]['status'];
	var f=document.getElementById("form").getElementsByTagName("select");
		if ( sta[i]==0) {
			f[i][1].selected = true;
		}else{
			f[i][0].selected = true;
		}
	}
</script>