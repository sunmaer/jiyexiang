<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div ><h1>配置</h1></div>
	<div >
		<h2>锁</h2>
		<?php if(is_array($lock)): foreach($lock as $k=>$vo): ?>类型：<input type="text" name="spec" value="<?php echo ($vo['spec']); ?>"></input>
		价格：<input type="text" name="price" value="<?php echo ($vo['price']); ?>"></input>
		<a href="">修改</a>
		<a href="">删除</a><br><?php endforeach; endif; ?>
		<form>
			类型：<input></input><br>
			价格：<input></input>
			<button>增加</button>
		</form>
	</div>
	<div >
		<h2>附件</h2>
		<?php if(is_array($att)): foreach($att as $k=>$vo): ?>箱高低于：<input value="<?php echo ($vo['height']); ?>"></input>
		价格：<input value="<?php echo ($vo[price]); ?>"></input><br><?php endforeach; endif; ?>
		<button>修改</button>
		<form>
			箱高低于：<input></input>
			价格：<input></input><br>
			<button>增加</button>
		</form>
	</div>
	<div >
		<h2>塑粉颜色</h2>
		<?php if(is_array($col)): foreach($col as $k=>$vo): ?>颜色：<input value="<?php echo ($vo['color']); ?>"></input>
		<a href="">修改</a>
		<a href="">删除</a><br><?php endforeach; endif; ?>
		<form>
			颜色：<input></input>
			<button>增加</button>
		</form>

	</div>
	<div >
		<h2>强筋</h2>
		<?php if(is_array($gul)): foreach($gul as $k=>$vo): ?>箱高低于：<input value="<?php echo ($vo['length']); ?>"></input>
		数量：<input value="<?php echo ($vo['gulten']); ?>"></input>
		<a href="">修改</a>
		<a href="">删除</a><br><?php endforeach; endif; ?>
		<form>
			箱高低于：<input></input>
			数量：<input></input>
			<button>增加</button>
		</form>

	</div>
	<div >
		<h2>密封条</h2>
		<?php if(is_array($mft)): foreach($mft as $k=>$vo): ?>箱高低于：<input value="<?php echo ($vo['height']); ?>"></input>
		价格：<input value="<?php echo ($vo['price']); ?>"></input>
		<a href="">修改</a>
		<a href="">删除</a><br><?php endforeach; endif; ?>
		<form>
			箱高低于：<input></input>
			价格：<input></input>
			<button>增加</button>
		</form>
	</div>
	<div >
		<h2>其他配置</h2>
		<form>
			材料单价：<input value="<?php echo ($oth['materialprice']); ?>"></input><br>
			包装单价：<input value="<?php echo ($oth['packprice']); ?>"></input><br>
			线夹单价：<input value="<?php echo ($oth['xianjia']); ?>"></input><br>
			线夹数量：<input value="<?php echo ($oth['xianjianum']); ?>"></input><br>
			人员工资（每平米单价）<input value="<?php echo ($oth['areaprice']); ?>"></input><br>
			强筋单价；<input value="<?php echo ($oth['gultenprice']); ?>"></input><br>
			密度：<input value="<?php echo ($oth['density']); ?>"></input>
		</form>

	</div>
	<div  >
		<h2>产品类型及对应利润</h2>
		<?php if(is_array($pro)): foreach($pro as $k=>$vo): ?>产品类型：<input value="<?php echo ($vo['type']); ?>"></input>
		产品利润：<input value="<?php echo ($vo['profit']); ?>"></input>
		<a href="">修改</a>
		<a href="">删除</a><br><?php endforeach; endif; ?>
		<form>
		产品类型：<input value=""></input>
		产品利润：<input value=""></input>
		<button>增加</button>
		</form>
	</div>
	<div >
		<h2>场租设置</h2>
		百分比收取:<input value="<?php echo ($rent['0']['rental']); ?>"></input>
		<a href="">修改</a><br>
		每平米面积单价：<input value="<?php echo ($rent['1']['rental']); ?>"></input>
		<a href="">修改</a><br>
		当前使用:百分比收取</input><button >修改收费方式</button>
	</div>
		<div >
		<h2>喷塑价格设置</h2>
		<?php if(is_array($spr)): foreach($spr as $k=>$vo): ?>箱高低于：<input value="<?php echo ($vo['length']); ?>"></input>
		价格：<input value="<?php echo ($vo['price']); ?>"></input>
		<a href="">修改</a>
		<a href="">删除</a><br><?php endforeach; endif; ?>
		<form>
		箱高低于：<input value=""></input>
		价格：<input value=""></input>
		<button>增加</button>
		</form>
	</div>

</body>
</html>