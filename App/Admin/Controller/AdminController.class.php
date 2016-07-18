<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function login(){
    	if ($_POST['user']!='' && $_POST['password']!='') {
            $user =  $_POST['user'];
            $password = md5($_POST['password']);
            $d=M('Admin');
            $where=array(
                'username' =>$user,
                'password' =>$password,
                'status'=>1,
            );
            $pro=$d->where($where)->field('id,admin')->find();
            if ($pro=='') {
                $this->error("账户不存在或密码错误！");
            }
    		switch ($pro['admin']) {
    			case 'super':
    				$login['uid']=$pro['id'];
    				$login['user']='SuperAdmin';
    				break;
    			case 'common':
    				$login['uid']=$pro['id'];
    				$login['user']='GeneralAdmin';
    				break;
    			default:
    				$this->error("此用户被禁用或不存在！");
    				break;
    		}
    		if(count($login)){
    			session('auth',$login);
    			$this->redirect("Index/index");
    		}
    	}
    	else{
    		$this->display();
    	}
    }
    public function alt(){
        $id=(int)$_SESSION['auth']['uid'];
        $m=M('admin');
        $data=$m->where("id = $id")->find();
        if ($data!='') {
            $this->assign('data',$data);
            $this->display();
        }else{
            $this->error("发生错误！");
        }
    }
    public function doalt(){
        if (isset($_POST)) {
            $id=(int)$_GET['id'];
            $data=$_POST;
            $user=M('Admin')->where("id = 1")->find();
            $oldpasw=$user['password'];
            if ($oldpasw!==md5($_POST['alterInfo_pwd'])) {
                $this->error("当前登录密码错误！");
            }
            if ($_POST['alterInfo_newpwd']!=$_POST['alterInfo_confirmpwd']) {
                $this->error("两次密码不一致！");
            }else{
                $data['username']=$_POST['alterInfo_name'];
                $data['password']=md5($_POST['alterInfo_newpwd']);
                $data['time']=date("Y-m-d h:m:s",time());
                $m=M('Admin');
                if($m->where("id=$id")->save($data)){
                   $this->success("修改成功！",U('Admin/logout'));
                }else{
                    $this->error("未做修改！");
                }
            }
        }
        else{
            $this->error("发生错误！");
        }

    }
    public function logout(){
    	unset($_SESSION['auth']);
    	$this->redirect('Admin/login');
    }
}