<?php
namespace Home\Controller;
use Think\Controller;
/**
* 
*/
class UserController extends CommonController
{
	
	public function alt(){
        $m=M('User');
        $where = array('username' =>$_SESSION['username'] , );
        $data=$m->where($where)->find();
        $this->assign('data',$data);
        $this->display();
    }
    public function doalt(){
        if(isset($_POST)){
            $m=M('User');
            $data=$_POST;
            $id=$_SESSION['uid'];
            if ($_POST['name']!=''&&$_POST['email']!=''&&$_POST['selfphone']!='') {
                if($m->where("id=$id")->save($data)){
                    $this->success("修改成功！");
                }
                else{
                    $this->error("未作修改！");
                }
            }
            else{
                $this->error("账号,姓名，邮箱，电话必填！");
            }      
        }
        else{
            $this->error("错误！");
        }
    }
     public function checkemail(){
        $where['email']=array('eq',$_GET['email']);
        $where['id']=array('neq',$_GET['id']);
        if (M('User')->where($where)->find()){
            echo $_GET['email']."已被注册;";
        }else{
            echo true;
        }
    }
     public function altpaw(){
        $id=$_SESSION['uid'];
        $this->assign('id',$id);
        $this->display();
    }
    public function doaltpaw(){
        if (isset($_POST) && isset($_GET)) {
            $id=(int)$_GET['id'];
            if ($_POST['password1']==$_POST['password2']) {
                $data['password']=md5($_POST['password1']);
                $m=M('User');
                if ($m->where("id=$id")->save($data)) {
                    $this->success("密码重置成功，请重新登录！",U('Log/logout',3));
                }
                else{
                    $this->error("重置失败！");
                }
            }
            else{
                $this->error("两次密码不一致！");
            }
        }else{
            $this->error("错误！");
        }
    }
}