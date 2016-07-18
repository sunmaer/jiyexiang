<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
    	if (empty($_SESSION['uid'])) {
    		$this->redirect("Log/index");
    	}else{
     	   $this->redirect("Count/index");
    	}
    }
}