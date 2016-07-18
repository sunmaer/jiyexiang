<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    function _initialize(){
    	$Site = M("site");
      $SiteInfo =$Site->find(1);
      $this->SiteInfo = $SiteInfo;
      $this->assign("SiteInfo",$SiteInfo);
      if($_SESSION['username'] == "" || $_SESSION['password'] ==''){
       	$this->redirect("Log/index");
      }
    }
}