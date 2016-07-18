<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends AuthController {
    public function index(){
      $this->display();
    }
    public function formulate(){
      If(!empty($_POST)){
        $data=$_POST;
        $data=$m->create();
        if ($m->where("id=0")->save($data)) {
          $this->success("修改成功！");
        }else{
          $this->error("修改失败！");
        }
      }
      $m=M('formulate');
      $data=$m->select();
      $str=$data['0']['formulate'];
      $str=str_replace("高", "300", $str);
      $str=str_replace("宽", "300", $str);
      $str=str_replace("深", "400", $str);
      $str=str_replace("（", "(", $str);
      $str=str_replace("）", ")", $str);
      if(preg_match("/[\+\-\*\/\.]{2}|[^\+\-\*\/\(\)\d\.]+/i", $str, $matches)){
          echo '非法算式';
      } else {
          if(substr_count($str,"(")==substr_count($str,")")){
              echo '合法算式';
          } else {
              echo '括号不匹配';
          }
      }
      $str=(string)$str;
      $result=eval("return $str;");
      $this->assign('result',$result);
      $this->assign('data',$str);
      $this->display();
    }
    public function op($a,$b,$c,$d){
      $h='<=';
      $i='>=';
      $j='<';
      $k='>';
      $l='=';
      switch ($b) {
        case '<=':
            for ($i=0; $i <count($c) ; $i++) {
              var_dump($d[$i]);
              if ($a<=$c[$i]) {
                return $d[$i];
              }
            }
            break;
          case '>=':
            for ($i=0; $i <count($c) ; $i++) {
              if ($a>=$c[$i]) {
                return $d[$i];
              }
            }
            break;
          case '<':
            for ($i=0; $i <count($c) ; $i++) {
              if ($a<$c[$i]) {
                return $d[$i];
              }
            }
            break;
           case '>':
            for ($i=0; $i <count($c) ; $i++) {
              if ($a>$c[$i]) {
                return $d[$i];
              }
            }
            break;
          case '=':
            for ($i=0; $i <count($c) ; $i++) {
              if ($a==$c[$i]) {
                return $d[$i];
              }
            }
            break;
        default:
          return 0;
          break;
      }
  }
}