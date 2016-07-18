<?php if (!defined('THINK_PATH')) exit();?><div class="table">
    <p>基业箱价格表</p>
	<table>
		<tr>
			<th>序号</th>
			<th class="td-hidden">型号</th>
			<th class="td-hidden">高</th>
			<th class="td-hidden">宽</th>
			<th class="td-hidden">深</th>
			<th class="td-hidden">门厚</th>
			<th class="td-hidden">箱厚</th>
			<th class="td-hidden">板厚</th>
			<th class="td-hidden">锁</th>
			<th class="td-hidden">塑粉</th>
			<th>单价</th>
			<th>数量</th>
			<th>合计</th>
		</tr>
		<?php if(is_array($data)): foreach($data as $k=>$vo): ?><tr>
			<td ><?php echo ($vo['id']); ?></td>
			<td class="td-hidden"><?php echo ($vo['type']); ?></td>
			<td class="td-hidden"><?php echo ($vo['height']); ?></td>
			<td class="td-hidden"><?php echo ($vo['width']); ?></td>
			<td class="td-hidden"><?php echo ($vo['depth']); ?></td>
			<td class="td-hidden"><?php echo ($vo['door_depth']); ?></td>
			<td class="td-hidden"><?php echo ($vo['box_depth']); ?></td>
			<td class="td-hidden"><?php echo ($vo['block_depth']); ?></td>
			<td class="td-hidden"><?php echo ($vo['locktype']); ?></td>
			<td class="td-hidden"><?php echo ($vo['color']); ?></td>
			<td ><?php echo ($vo['unit_price']); ?></td>
			<td ><?php echo ($vo['count']); ?></td>
			<td ><?php echo ($vo['total']); ?></td>
		</tr><?php endforeach; endif; ?>
	</table>
</div>
<p class="total"><span>合计数量：<?php echo ($totalnum); ?></span><span class="nbsp-hidden">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="price">合计总价：<?php echo ($totalprice); ?>元</span></p>
<script type="text/javascript">
	$("table tr").click(function()
	{
		$this=$(this);
		var a={};
		var rows=this;
		if (rows.cells[0].innerHTML!=='序号') {
			for(var i=1;i<rows.cells.length;i++)
		    {
		        var cell = rows.cells[i];
		        a[i]=cell.innerHTML;
		    }
		    $.ajax({
			type:'POST',
			url:"<?php echo U('Count/showonedata');?>",
			data: a,  
            dataType: 'json',
			success:function(res){
				if(res['status']==0){
					alert("数据不完整");
				}else if(res['status']==1){
					alert("添加重复");
				}else{
					$("#ajaxform").html(res);
				}
			}
			})
		}
	})
</script>