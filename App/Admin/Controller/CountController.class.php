<?php
namespace Admin\Controller;
use Thinkphp\Controller;

class CountController extends AuthController
{
	public function index(){
		$m=M('ReportForms');
		if ((!empty($_POST['date1'])&&!empty($_POST['date2']))||!empty($_POST['search'])) {
			if (!empty($_POST['date1'])&&!empty($_POST['date2'])&&empty($_POST['search'])) {
				$where['time'] = array(array('egt',strtotime($_POST["date1"])),array('elt',strtotime($_POST["date2"])),'AND');
			}elseif ((empty($_POST['date1'])&&empty($_POST['date2']))&&!empty($_POST['search'])) {
				$search='%'.$_POST['search'].'%';
				$where['name|companyname|companyname']=array('like',$search);
			}else{
				$where['time'] = array(array('egt',strtotime($_POST["date1"])),array('elt',strtotime($_POST["date2"])),'AND');
				$search='%'.$_POST['search'].'%';
				$where['name|companyname|companyname']=array('like',$search);
				$where['_logic'] = 'and';
			}
			$count = $m->where($where)->count();
			$Page = new \Think\Page($count,8);
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$show = $Page->show();
			$data = $m->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
			
		}else{
			$count = $m->where("1=1")->count();
			$Page = new \Think\Page($count,8);
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$show = $Page->show();
			$data = $m->where("1=1")->limit($Page->firstRow.','.$Page->listRows)->select();
		}
		for ($i=2016; $i <=2026 ; $i++) { 
			$year[]=$i;
		}
		for ($i=1; $i <=31 ; $i++) { 
			$date1[]=(string)$i;
			$date[]=sprintf("%02d",$date1[$i-1]);
		}
		for ($i=1; $i <=12 ; $i++) { 
			$month1[]=$i;
			$month[]=sprintf("%02d",$month1[$i-1]);
		}
		$this->assign('page',$show);
		$this->assign('year',$year);
		$this->assign('month',$month);
		$this->assign('date',$date);
		$this->assign('data',$data);
		$this->assign('where',$where);
		$this->display();
	}
	public function del(){
		if (!empty($_GET)) {
			$id=$_GET['id'];
			if (M('ReportForms')->where("id=$id")->delete()) {
				$this->success("删除成功！");
			}else{
				$this->error("删除失败！");
			}
		}else{
			$this->redirect("index");
		}
	}
}