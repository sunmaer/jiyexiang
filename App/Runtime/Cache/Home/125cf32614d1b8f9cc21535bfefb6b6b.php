<?php if (!defined('THINK_PATH')) exit();?>	<form class="product-form" id="signupForm" action="<?php echo U('Count/beforecount');?>" method="post">
	<div class="type">
		<span>产品型号</span><select name="type" id='type' onchange="toCheckone()">
		<?php if(is_array($type)): foreach($type as $k=>$vo): ?><option value="<?php echo ($vo['contion']); ?>"><?php echo ($vo['contion']); ?></option><?php endforeach; endif; ?>
		</select>
		<script type="text/javascript">
			var data=<?php echo json_encode($data);?>;
			var type0=<?php echo json_encode($type);?>;
			var type=document.getElementById("type");
			for (var i = 0; i < type0.length; i++) {
				if (data['type']===type0[i]['contion']) {
					type[i].selected = true;
				}
			}
		</script>
	</div>
	<div class="lock">
		<span>锁</span><select name="lock" id="lock">
		<?php if(is_array($lock)): foreach($lock as $k=>$vo): ?><option value="<?php echo ($vo['contion']); ?>"><?php echo ($vo['contion']); ?></option><?php endforeach; endif; ?>
		</select>
		<script type="text/javascript">
			var data=<?php echo json_encode($data);?>;
			var lock0=<?php echo json_encode($lock);?>;
			var lock=document.getElementById("lock");
			for (var i = 0; i < lock0.length; i++) {
				if (data['locktype']===lock0[i]['contion']) {
					lock[i].selected = true;
				}
			}
		</script>
	</div>
	<div class="height">
		<span>高</span><input type="text" id="height" name="height" placeholder="请输入0~5000内的整数(mm)" value="<?php echo ($data['height']); ?>" />
	</div>
	<div class="width">
		<span>宽</span><input type="text" id="width" name="width" placeholder="请输入0~5000内的整数(mm)" value="<?php echo ($data['width']); ?>"/>
	</div>
	<div class="depth">
		<span>深</span><input type="text" id="depth" name="depth" placeholder="请输入0~5000内的整数(mm)" value="<?php echo ($data['depth']); ?>" />
	</div>
	<div class="door_depth">
		<span>门厚度</span><input type="text" id="door_depth" name="door_depth" value="<?php echo ($data['door_depth']); ?>" placeholder="请输入0.1~10内的一位小数(mm)" />
	</div>
	<div class="box_depth">
		<span>箱体厚度</span><input type="text" id="box_depth" name="box_depth" value="<?php echo ($data['box_depth']); ?>" placeholder="请输入0.1~10内的一位小数(mm)" />
	</div>
	<div class="block_depth">
		<span>安装板厚度</span><input type="text" id="block_depth" name="block_depth" value="<?php echo ($data['block_depth']); ?>" placeholder="请输入0.1~10内的一位小数(mm)" />
	</div>
	<div class="color">
		<span>塑粉颜色</span><select name="color" id="color">
		<?php if(is_array($color)): foreach($color as $k=>$vo): ?><option value="<?php echo ($vo['contion']); ?>"><?php echo ($vo['contion']); ?></option><?php endforeach; endif; ?>
		</select>
		<script type="text/javascript">
			var color0=<?php echo json_encode($color);?>;
			var data=<?php echo json_encode($data);?>;
			var color=document.getElementById("color");
			for (var i = 0; i < color0.length; i++) {
				if (data['color']===color0[i]['contion']) {
					color[i].selected = true;
				}
			}
		</script>
	</div>
	<div class="xianjia">
		<span>线夹</span><select name="xianjia" id="xianjia">
		<option value="要">要</option>
		<option value="不要">不需要</option>
		</select>
		<script type="text/javascript">
			var color0=<?php echo json_encode($color);?>;
			var xianjia=document.getElementById("xianjia");
			if (data['xianjia']==='要') {
				xianjia[0].selected = true;
			}else{
				xianjia[1].selected = true;
			}
		</script>
	</div>
	<div class="mifengtiao">
		<span>密封条</span><select name="mft_type" id="mft_type" onchange="toCheck()">
		<option value="机浇">机浇</option>
		<option value="手工">手工</option>
		</select>
		<script type="text/javascript">
			var color0=<?php echo json_encode($color);?>;
			var mft=document.getElementById("mft_type");
			if (data['mft_type']==='机浇') {
				mft[0].selected = true;
			}else{
				mft[1].selected = true;
			}
		</script>
	</div>
	<div class="count">
		<span>箱子数量</span><input type="text" id="count" name="count" value="<?php echo ($data['count']); ?>" placeholder="请输入整数" />
	</div>
	</form>