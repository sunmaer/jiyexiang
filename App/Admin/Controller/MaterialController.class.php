<?php
namespace Admin\Controller;
use thinkphp\Controller;
class MaterialController extends AuthController
{
	public function index(){
		// echo '<a href="'.U('formulate').'">公式管理</a><br>';
		// echo '<a href="'.U('otherConfig').'">材料管理</a>';
		$this->redirect('formulate');
	}
	public function formulate(){
		$m=M('Formulate');
		$for=$m->order("corder asc")->select();
		$this->assign('for',$for);
		$this->display();
	}
	public function altforsta(){
		$datas['status']=$_POST['sta'];
		$id=$_POST['id'];
		$corder['corder']=$_POST['corder'];
		$corder=$corder['corder'];
		$datas=$datas['status'];
		for ($i=0; $i <count($id); $i++) { 
			$tid=(int)$id[$i];
			$data['status']=(int)$datas[$i];
			$data['corder']=(int)$corder[$i];
			M('Formulate')->create($data);
			M('Formulate')->where("id=$tid")->save($data);
		}
		$this->redirect('formulate');
	}
	public function altonefor(){
		$id=$_GET['id'];
		$data1=M('Formulate')->where("id=$id")->find();
		$data2=M('Judge')->where("uid=$id")->select();
		$data3=M('Nojudge')->where("uid=$id")->select();
		$this->assign("data1",$data1);
		$this->assign("data2",$data2);
		$this->assign("data3",$data3);
		$this->display();
	}
	public function test(){
		$a='(3+23)+';
		var_dump($this->replace($a));
	}
	public function replace($a){
		$a=str_replace('（', '(', $a);
		$a=str_replace('）', ')', $a);
		$b=$this->isValid($a);
		return $b;
	}
	public function isValid($expstr) { 
	    $temp = array();  
	    for ($i=0; $i<strlen($expstr); $i++) {  
	        $ch = $expstr[$i];  
	        switch($ch) {  
	            case '(':  
	                array_push($temp, '(');  
	                break;
	            case ')':  
	                if (empty($temp) || array_pop($temp) != '(') {  
	                    return "缺少左括号（";  
	                }  
	        }  
	    }  
	    return empty($temp) == true ? '1' : "缺少右括号）";  
	}  
	// 修改公式及配置
	public function doaltonefor(){
		$id=(int)$_GET['id'];
		// 公式修改
		if (!empty($_POST['formulate'])) {
			if($this->replace($_POST['formulate'])==='1'){
				$data['formulate']=$_POST['formulate'];
				$data['name']=$_POST['name'];
				M('Formulate')->create($data);
				M('Formulate')->where("id=$id")->save($data);
			}else{
				$this->error($this->replace($_POST['formulate']));
			}
		}
		// 静态修改
		if (!empty($_POST['name']&&!empty($_POST['value']))){
			for ($i=0; $i < count($_POST['name']); $i++) { 
				$data['name']=$_POST['name'][$i];
				$data['value']=$_POST['value'][$i];
				$where=array('uid'=>$id,'name'=>$_POST['name'][$i],);
				if (strstr($_POST['formulate'],$data['name'])&&!preg_match("/[^\d-., ]/",$data['value'])) {	
					M('Nojudge')->create($data);
					M('Nojudge')->where($where)->save($data);
				}else{
					$this->error('非判定配置项错误！');
				}
			}

		}
		// 动态修改
		if (!empty($_POST['oldid'])&&!empty($_POST['item'])&&!empty($_POST['op'])&&!empty($_POST['contion'])&&!empty($_POST['result'])){
			$opt='>=<=<>';
			for ($i=0; $i <count($_POST['result']) ; $i++) { 
				$data1['item']=$_POST['item'][$i];
				$data1['op']=$_POST['op'][$i];
				$data1['contion']=$_POST['contion'][$i];
				$data1['result']=$_POST['result'][$i];
				$data1['judgename']=$_POST['judgename'][$i]; 
				$data1['uid']=$id;
				$where=array('id'=>$_POST['oldid'][$i]);
				if (strstr($_POST['formulate'],$data1['judgename'])&&strstr($opt,$data1['op'])&& is_numeric($data1['result'])) {
					M('Judge')->create($data1);
					M('Judge')->where($where)->save($data1);
				}else{
					$this->error('判定项配置错误！');
				}
			}
		}
		$this->redirect('Admin/Material/altonefor/id'.'/'.$id);
	}
	// 添加非判别项
	public function addnojudge(){
		$data['name']=$_POST['name'];
		$data['value']=$_POST['value'];
		$data['uid']=$_GET['uid'];
		$id=(int)$_GET['uid'];
		$for=M('Formulate')->where("id=$id")->getField('formulate');
		if (strstr($for,$data['name'])&&!preg_match("/[^\d-., ]/",$data['value'])) {
			M('Nojudge')->create($data);
			if(M('Nojudge')->add($data)){
				$this->success('增加成功！');
			}else{
				$this->error('增加失败！');
			}
		}else{
			$this->error("非法配置项！");
		}
		
	}
	// 添加判别项
	public function addjudge(){
		$data['judgename']=$_POST['judgename'];
		$data['op']=$_POST['op'];
		$data['contion']=$_POST['contion'];
		$data['item']=$_POST['item'];
		$data['result']=$_POST['result'];
		$data['uid']=$_GET['id'];
		$uid=(int)$_GET['id'];
		$for=M('Formulate')->where("id=$uid")->getField('formulate');
		$opt='>=<=<>';
		if (strstr($for,$data['judgename'])&&strstr($opt,$data['op'])&&!preg_match("/[^\d-., ]/",$data['result'])) {
			M('Judge')->create($data);
			if(M('judge')->add($data)){
				$jfid=M('Judge')->Distinct(true)->field('uid')->select();
				for ($i=0; $i <count($jfid) ; $i++) { 
					$fid[$i]=(int)$jfid[$i]['uid'];
				}
				$where['id']=array('in',$fid);
				M('Formulate')->where($where)->setField('judge',1);
				$this->success('增加成功！',U('altonefor',array('id'=>$uid)),3);
			}else{
				$this->error('增加失败！');
			}
		}else{
				$this->error("存在非法配置项！");
		}
	}
	// 删除一条非判别项
	public function deloneno(){
		$uid=(int)$_GET['uid'];
		$id=(int)$_GET['id'];
		if (M('Nojudge')->where("id=$uid")->delete()) {
			$this->redirect('Admin/Material/altonefor/id'.'/'.$id);
		}else{
			$this->error("删除失败!");
		}
	}
	// 删除一条判别项
	public function delone(){
		$uid=(int)$_GET['uid'];
		$id=(int)$_GET['id'];
		if (M('Judge')->where("id=$uid")->delete()) {
			$this->redirect('Admin/Material/altonefor/id'.'/'.$id);
		}else{
			$this->error("删除失败!");
		}
	}
	// 添加公式
	public function addfor(){
		$data['name']=$_POST['name'];
		$data['formulate']=$_POST['formulate'];
		$data['status']=1;
		$data['judge']=0;
		M('Formulate')->create($data);
		$id=M('Formulate')->add($data);
		if (!empty($data['name'])&&!empty($data['formulate'])) {
			if ($id) {
				$this->success('添加成功，前往配置页面！',U('altonefor',array('id'=>$id)),3);
			}else{
				$this->error("添加失败！");
			}
		}else{
			$this->error("信息不能为空！");
		}
	}
	// 删除公式
	public function delonefor(){
		$id=(int)$_GET['id'];
		if (M('formulate')->where("id = $id")->delete()||M('Nojudge')->where("uid = $id")->delete()||M('Judge')->where("uid = $id")->delete()) {
			$this->success("删除成功！",U('formulate'),3);
		}else{
			$this->error("删除失败！");
		}
	}
}