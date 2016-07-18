<?php
namespace Home\Controller;
use Think\Controller;
class LogController extends Controller {
    public function index(){
        $this->display();
    }
    public function checklogin(){
    	if (isset($_POST)){
    		$m=M(User);
    		$username=$_POST['username'];
    		$where=array(
				'username' =>$_POST['username'],
				'status'=>1,
  	       	);
    		$result=$m->where($where)->find();
    		$password=$result['password'];
    		$key=md5($_POST['password']);
            $uid=$result['id'];
    		if($password!=''){
    			// var_dump($password);
    			// var_dump($key);
    			$key=md5($_POST['password']);
    			if($password == $key){
                    $_SESSION['uid']=$uid;
    				$_SESSION['username']=$_POST['username'];
    				$_SESSION['password']=md5($_POST['password']);   
                    $uid=$_SESSION['uid'];
                    M('Count')->Where("uid=$uid")->delete();
    				$this->redirect('Index/index');
    			}else{
    				$this->error("登录密码错误！",U('Log/index'));
                }
    		}
    		else{
    			$this->error("请确保账户存在且通过审核！",U('Log/index'));
    		}
    	}
    	else{
    		$this->error("请输入账号和密码！");
    	}
    }
    public function logout(){
        if (!empty($_SESSION['uid'])) {
            $uid=$_SESSION['uid'];
            M('Count')->Where("uid=$uid")->delete();
        }
        unset($_SESSION['click']);
    	unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['uid']);
    	$this->redirect('Log/index');
    }
    public function checkuser(){
        $where=array('username'=>$_GET['user_rname']);
        if (M('User')->where($where)->find()){
            echo $_GET['user_rname']."已被注册;";
        }else{
            echo true;
        }
    }
    public function checkemail(){
        $where=array('email'=>$_GET['email']);
        if (M('User')->where($where)->find()){
            echo $_GET['email']."已被注册;";
        }else{
            echo true;
        }
    }
    public function register(){
    	$this->display();
    }
    public function doregister(){
    	if (IS_POST) {
    		$m=M('User');
    		if ($_POST['username']!=''&&$_POST['password']!=''&&$_POST['name']!=''&&$_POST['email']!=''&&$_POST['selfphone']!='') {
    			$where=array(
					'username' =>$_POST['username'],
                    'email'=>$_POST['email'],
					'_logic'=>'OR',
  	       		);
    			$result=$m->where($where)->select();
    			if (empty($result)){
    				$data = $m->create();
    				$data=$_POST;
    				$data['password']=md5($_POST['password']);
    				$data['status'] = 0;
    				$data['time'] = date("Y-m-d h:m:s",time());
    				$add=$m->add($data);
    				if($add){
    					$this->success("注册成功",U('Log/index'));
    				}
    			}
    			else{
    				$this->error("账号或邮箱已被注册！");
    			}
    		}
    		else{
    			$this->error("账号,密码，姓名，邮箱，电话必填！");
    		}
    	}
    	else{
    		$this->error("注册信息不能为空!");
    	}
    }
    public function altpaw(){
        $id=$_GET['id'];
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
                    $this->success("密码重置成功，请重新登录！",U('Log/logout'));
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
    public function findpaw(){
        $this->display();
    }
    public function mail(){
        import("Org.Util.Mail");
        $m=M('User');
        $where=array(
            'username' =>$_POST['find'],
            'email'=>$_POST['find'],
            '_logic'=>'OR',
        );
        $data=$m->where($where)->field('email,username')->find();
        if (!empty($data)) {
            $email=$data['email'];
            $content=md5(time());
            session($content,$content);
            $u=M('Site');
            $ur=$u->field('url')->find(1);
            $url=$ur['url'];
            // var_dump($url);
            $content='重置密码地址：'.'http://'.$url.U('Log/find',array('res'=>$content,'user'=>$data['username']));
            // var_dump($content);
            if (SendMail($email,'密码找回验证',$content,'基业箱')){
                $this->success('发送成功！注意查收及时验证');
            }else
              $this->error('发送失败');
        }else{
            $this->error("账号不存在或绑定邮箱错误！");
        }
        
    }
    public function find(){
        header("Content-type: text/html; charset=utf-8");  
        $res=I('res');
        $user=I('user');
        $where=array('username'=>$user); 
        if(session($res)==$res){
            $m=M('User');
            $data=$m->where($where)->find();
            $id=$data['id'];
            session($res,null); 
            $this->assign('id',$id);
            $this->display('altpaw');
        }else{ 
        echo '已经过期'; 
        } 
    }
}