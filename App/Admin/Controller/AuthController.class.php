<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Auth;
class AuthController extends Controller {
	protected function _initialize(){
		$sess_auth = session('auth');
		if (!$sess_auth) {
			$this->redirect("Admin/login");
		}
		// 超级管理员赋予所有权限
		if ($sess_auth['uid']==1) {
			return true;
		}
		//权限赋予
		else{
			$auth=new Auth();
			if(!$auth->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME,$sess_auth['uid'])){
				$this->error("没有权限");
			}
		}	

	}   
	public function myRelust($result)
      {
            if ($result == false) {
                  $this->error("操作失败！");
            } else {
                  $this->success("操作成功！");
            }
    } 
}