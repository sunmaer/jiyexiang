<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
				<form method="post" class="form-horizontal" action="<?php echo U('Maintain/doClear');?>" enctype="multipart/form-data">
                                <div class="form-group has-success"><label class="col-sm-4 control-label">清理模板缓存</label>

                                    <div class="col-sm-3"><div class="checkbox i-checks"><label> <input type="checkbox" value="Cache" checked="checked" name = "data[]"> <i></i>清理模板缓存</label></div></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group has-success"><label class="col-sm-4 control-label">清理数据缓存</label>

                                    <div class="col-sm-3"><div class="checkbox i-checks"><label> <input type="checkbox" value="Temp"  name = "data[]"> <i></i> 清理数据缓存 </label></div></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group has-success"><label class="col-sm-4 control-label">清理数据目录</label>

                                    <div class="col-sm-3"><div class="checkbox i-checks"><label> <input type="checkbox" value="Data"  name = "data[]"> <i></i> 清理数据目录</label></div></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group has-success"><label class="col-sm-4 control-label">清理日志文件</label>

                                    <div class="col-sm-3"><div class="checkbox i-checks"><label> <input type="checkbox" value="Logs"  name = "data[]"> <i></i>清理日志文件</label></div></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                               <div class="ibox-content">
                            <div class="text-center">
                            <input type="submit" value="点击清理" class="btn btn-primary" data-toggle="modal">
                            </div>

                    </div>
                </form>
</body>
</html>