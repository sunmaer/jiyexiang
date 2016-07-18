<?php
namespace Admin\Controller;
use Think\Controller;

class TabexcelController extends AuthController{
	public function _empty($action='index')
    {
        $m = M('ReportForms');
        if($action == 'export'){
        	if(!$data){
        	    $this->error('没有搜索结果，无法导出数据');
        	}
        	else{
        		$this->export($data);
        	}
        }
        var_dump($_GET['date2']);
        var_dump($_GET);
        if ((!empty($_GET['date1'])&&!empty($_GET['date2']))||!empty($_GET['search'])) {
            if (!empty($_GET['date1'])&&!empty($_GET['date2'])&&empty($_GET['search'])) {
                $where['time'] = array(array('egt',$_GET["date1"]),array('elt',$_GET["date2"]),'AND');
            }elseif ((empty($_GET['date1'])&&empty($_GET['date2']))&&!empty($_GET['search'])) {
                $search=$_GET['search'];
                $where['name|companyname|companyname']=array('like',$search);
            }else{
                $where['time'] = array(array('egt',$_GET["date1"]),array('elt',$_GET["date2"]),'AND');
                $search=$_GET['search'];
                $where['name|companyname|companyname']=array('like',$search);
                $where['_logic'] = 'and';
            }
            $data = $m->where($where)->select();
            echo $m->getLastSql();
            echo "post搜索";
        }else{
            echo "无post搜索";
            $data=$m->select();
        }
        if(!$data){
            $this->error('没有搜索结果，无法导出数据');
        }
        else{
            $this->export($where);
        }
        var_dump($where);
    }
	 protected function export($where)
    {	
    	$m = M('ReportForms');
        $data = $m->where($where)->select();
        if (!$data) {
        	$this->error("没有搜索结果，无法导出数据！");
        }
		$data_excel = array();
        foreach ($data as $k=>$data_info){
            $data_excel[$k][name] = $data_info['name'];
            $data_excel[$k][selfphone] = $data_info['selfphone'];
            $data_excel[$k][companyname] = $data_info['companyname'];
            $data_excel[$k][type] = $data_info['type'];
            $data_excel[$k][locktype] = $data_info['locktype'];
            $data_excel[$k][color] = $data_info['color'];
            $data_excel[$k][height] = $data_info['height'];
            $data_excel[$k][width] = $data_info['width'];
            $data_excel[$k][depth] = $data_info['depth'];
            $data_excel[$k][box_depth] = $data_info['box_depth'];
            $data_excel[$k][door_depth] = $data_info['door_depth'];
            $data_excel[$k][block_depth] = $data_info['block_depth'];
            $data_excel[$k][unit_price]=$data_info['unit_price'];
            $data_excel[$k][count] = $data_info['count'];
            $data_excel[$k][total] = $data_info['total'];
            $data_excel[$k][time] =date('y-m-d',$data_info['time']);
        }
        foreach ($data_excel as $field=>$v){
            if($field == 'name'){
                $headArr[]='客户姓名';
            }

            if($field == 'selfphone'){
                $headArr[]='电话';
            }

            if($field == 'companyname'){
                $headArr[]='公司名称';
            }
            if($field == 'type'){
                $headArr[]='型号';
            }
            if($field == 'locktype'){
                $headArr[]='锁型号';
            }
            if($field == 'color'){
                $headArr[]='塑粉颜色';
            }
            if($field == 'height'){
                $headArr[]='箱高(mm)';
            }
            if($field == 'width'){
                $headArr[]='箱宽(mm)';
            }
            if($field == 'depth'){
                $headArr[]='箱深(mm)';
            }
            if($field == 'box_depth'){
                $headArr[]='箱厚(mm)';
            }
            if($field == 'door_depth'){
                $headArr[]='门厚(mm)';
            }
            if($field == 'block_depth'){
                $headArr[]='板厚(mm)';
            }
            if($field == 'unit_price'){
                $headArr[]='单价(￥)';
            }
            if($field == 'count'){
                $headArr[]='数量';
            }
            if($field == 'total'){
                $headArr[]='总价(￥)';
            }
            if($field == 'time'){
                $headArr[]='时间';
            }
        }

        $filename="基业箱表单";
        $this->getExcel($filename,$headArr,$data_excel);
    }


    private  function getExcel($fileName,$headArr,$data){
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.Util.PHPExcel");
        import("Org.Util.PHPExcel.Writer.Excel5");
        import("Org.Util.PHPExcel.IOFactory.php");

        $date = date("Y-m-d",time());
        $fileName .= "-{$date}.xls";

        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();

        //设置表头
        $key = ord("A");
        //print_r($headArr);exit;
        foreach($headArr as $v){
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $key += 1;
        }

        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();
        $objActSheet->getColumnDimension('A','B','C')->setAutoSize(true);

        //print_r($data);exit;
        foreach($data as $key => $rows){ //行写入
            $span = ord("A");
            foreach($rows as $keyName=>$value){// 列写入
                $j = chr($span);
                $objActSheet->setCellValue($j.$column, $value);
                $span++;
            }
            $column++;
        }

        $fileName = iconv("utf-8", "gb2312", $fileName);

        //重命名表
        //$objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0); 
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }
}