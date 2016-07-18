<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div>
		<form>
			<textarea cols="100" name="formulate" ><?php echo ($data); ?></textarea>
			<button  type="submit">修改</button>
		</form>
		<div>计算计算结果:<?php echo ($result); ?></div>
	</div>
</body>
</html>