<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends AuthController{
	public function index(){
		$m=M('User');
		if (!empty($_POST['search'])){
			$search='%'.$_POST['search'].'%';
        	$where['selfphone|companyphone|username|companyname|name']=array('like',$search);
        	$where['status']=1;
		}else{
			$where['status']=1;
		}
		$count = $m->where($where)->count();
		$Page = new \Think\Page($count,8);
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$show = $Page->show();
		$data = $m->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('data',$data);
		$this->assign('page',$show);
		$this->display();
	}
	public function approve(){
		$m=M('User');
		if (!empty($_POST['search'])){
			$search='%'.$_POST['search'].'%';
        	$where['selfphone|companyphone|username|companyname|name']=array('like',$search);
        	$where['status']=0;
		}else{
			$where['status']=0;
		}
		$count = $m->where($where)->count();
		$Page = new \Think\Page($count,8);
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$show = $Page->show();
		$data = $m->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('count',$count);
		$this->assign('data',$data);
		$this->assign('page',$show);
		$this->display();
	}
	public function alt(){
		if (IS_GET){
			$m=M('User');
			$id=$_GET['id'];
			$data=$m->where("id = $id")->find();
			$this->assign('data',$data);
		}
		else{
			$this->error("发生错误！");
		}
		$this->display();
	}
	public function doalt(){
		if (IS_POST){
			$m=M('User');
			$id=(int)$_GET['id'];
			$data['password']=md5($_POST['password']);
			$data['status']=(int)$_POST['status'];
			var_dump($data);
			var_dump($_POST);
			$result=$m->where("id = %s",$id)->save($data);
			var_dump($result);
			if ($result) {
				$this->success("修改成功！");
			}
		}
		else{
			$this->error("未作修改！");
		}
	}
	public function doapprove(){
		if (!empty($_POST)) {
			$m=M('User');
			$user_id=$_POST['id'];
			$map['id'] = array('in',$user_id);
			if($data=$m->where($map)->setField('status',1)){
				$this->success("用户审核通过！");
			}
			else{
				$this->error("审核通过失败！");
			}
		}
		else{
			$this->error("无可审批用户！");
		}
	}
	public function del(){
		if (isset($_GET)) {
			$id=$_GET['id'];
			$m=M('User');
			if ($m->where("id=$id")->delete()) {
				$this->success("删除成功！");
			}
			else{
				$this->error("删除失败！");
			}
		}else{
			$this->error("发生错误！");
		}
	}
	public function adduser(){
		$this->display();
	}
	public function doadduser(){
		if (!empty($_POST)) {
			$data['username']=$_POST['user_rname'];
			$data['password']=$_POST['user_pwd'];
			$data['name']=$_POST['user_name'];
			$data['companyname']=$_POST['companyname'];
			$data['companyphone']=$_POST['companyphone'];
			$data['selfphone']=$_POST['user_phone'];
			$data['address']=$_POST['address'];
			$data['qq']=$_POST['qq'];
			$data['wechat']=$_POST['wechat'];
			$data['email']=$_POST['user_email'];
			$data['status']=1;
			$data['time']=date("Y-m-d h:m:s",time());
			M('User')->create();
			if (M('User')->add($data)) {
				$this->success('添加成功，无需审批！');
			}else{
				$this->error('添加失败！');
			}
		}else{
			$this->error('成员信息数据为空！');
		}
	}
	public function alteruser(){
		// var_dump($_GET);
		$id=$_GET['id'];
		$data=M('User')->where("id = $id")->find();
		$this->assign('data',$data);
		$this->display();
	}
    public function	doalteruser(){
    	$id=$_GET['id'];
    	$data['name']=$_POST['user_name'];
    	$data['companyname']=$_POST['companyname'];
    	$data['companyphone']=$_POST['companyphone'];
    	$data['address']=$_POST['address'];
    	$data['selfphone']=$_POST['user_phone'];
    	$data['email']=$_POST['user_email'];
    	$data['qq']=$_POST['qq'];
    	$data['wechat']=$_POST['wechat'];
    	if (M('User')->where("id = $id")->save($data)) {
    		$this->success("修改成功！");
    	}else{
    		$this->error("未做修改！");
    	}
    }
    public function deluser(){
    	$id=$_GET['id'];
    	if (M('User')->where("id = $id ")->delete()) {
    		$this->success("删除成功！");
    	}else{
    		$this-error("删除失败！");
    	}
    }
}