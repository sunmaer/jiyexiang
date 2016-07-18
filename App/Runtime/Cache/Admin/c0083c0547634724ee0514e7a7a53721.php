<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
	li{
		list-style: none;
	}
	</style>
</head>
<body>
	<div>
		<form action="<?php echo U('User/doalt',array('id'=>$data['id']));?>" method="post">
			<ul>
				<li>id:<?php echo ($data['id']); ?></li>
				<li>用户名：<?php echo ($data['username']); ?></li>
				<li>密码：<input type="text" name="password" /></li>
				<li>状态：<input type="text" name="status" value="<?php echo ($data['status']); ?>"  /></li>
				<li>姓名：<?php echo ($data['name']); ?></li>
				<li>邮箱：<?php echo ($data['email']); ?></li>
				<li>QQ:<?php echo ($data['qq']); ?></li>
				<li>地址：<?php echo ($data['address']); ?></li>
				<li>微信：<?php echo ($data['wechat']); ?></li>
				<li>公司：<?php echo ($data['companyname']); echo ($data['companyphone']); ?></li>
				<li></li>
				<li><button type="submit">修改</button></li>

			</ul>
		</form>
	</div>
</body>
</html>