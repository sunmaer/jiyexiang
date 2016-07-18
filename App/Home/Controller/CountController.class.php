<?php
namespace Home\Controller;
use Think\Controller;
class CountController extends CommonController {
    public function index(){
    	  $where['item']=array('eq','类型');
        $type=M('Judge')->where($where)->select();
        $where['item']=array('eq','锁类型');
        $lock=M('Judge')->where($where)->select();
        $where['item']=array('eq','塑粉颜色');
        $color=M('Judge')->where($where)->select();
        $uid=$_SESSION['uid'];
        $data=M('Count')->where("uid = $uid")->Distinct(true)->select();
        $totalnum=0;
        $totalprice=0;
        if (!empty($data)) {
          for ($i=0; $i <count($data) ; $i++) { 
            $totalnum=$data[$i]['count']+$totalnum;
            $totalprice=$data[$i]['total']+$totalprice;
            $data[$i]['id']=$i+1;
          }
        }
        $this->assign('totalnum',$totalnum);
        $this->assign('totalprice',$totalprice);
        $this->assign('data',$data);
        $this->assign('lock',$lock);
        $this->assign('type',$type);
        $this->assign('color',$color);
        $this->display();
    }
    // ajax删除计算
    public function delonedata(){
      if ($this->dildata($_POST)) {
        $data['status']=0;
        $this->ajaxReturn($data);
      }else{
        $data=$this->changedata($_POST);
        $data['uid']=$_SESSION['uid'];
        if (M('Count')->where($data)->delete()) {
            $uid=$_SESSION['uid'];
            $data=M('Count')->where("uid = $uid")->Distinct(true)->select();
            if (!empty($data)) {
              for ($i=0; $i <count($data) ; $i++) { 
                $totalnum=$data[$i]['count']+$totalnum;
                $totalprice=$data[$i]['total']+$totalprice;
                $data[$i]['id']=$i+1;
              }
              $this->assign('totalnum',$totalnum);
              $this->assign('totalprice',$totalprice);
              $this->assign('data',$data);
              $html = $this->fetch('Count/ajaxtable');
              $this->ajaxReturn($html);
            }else{
              $totalnum=0;
              $totalprice=0;
              $data='';
              $this->assign('totalnum',$totalnum);
              $this->assign('totalprice',$totalprice);
              $this->assign('data',$data);
              $html = $this->fetch('Count/ajaxtable');
              $this->ajaxReturn($html);
            }
        }else{
          $data['status']=1;
          $this->ajaxReturn($data);
        }
      }
    }
    //ajax点击处理
    public function showonedata(){
      $_SESSION['click']=$_POST;
      if (!empty($_POST)) {
          $where['item']=array('eq','类型');
          $type=M('Judge')->where($where)->select();
          $where['item']=array('eq','锁类型');
          $lock=M('Judge')->where($where)->select();
          $where['item']=array('eq','塑粉颜色');
          $color=M('Judge')->where($where)->select();
          $data=$this->showchange($_POST);
          $data=M('Count')->where($data)->find();
          $this->assign('data',$data);
          $this->assign('type',$type);
          $this->assign('lock',$lock);
          $this->assign('color',$color);
          $html = $this->fetch('Count/ajaxform');
          $this->ajaxReturn($html);
      }

    }
    //保存
    public function keepdata(){
      $uid=$_SESSION['uid'];
      $data=M('Count')->where("uid = $uid")->select();
      if (empty($data)) {
          $back['status']=0;
          $this->ajaxReturn($back);
      }else{
          $id=$_SESSION['uid'];
          $user=M('User')->where("id = $id")->find();
          $name=$user['name'];
          $selfphone=$user['selfphone'];
          $companyname=$user['companyname'];
          $m=M('ReportForms');
          $alltime=$m->where("uid = $id")->field('time')->select();
          for ($i=0; $i <count($alltime) ; $i++) { 
              $time[$i]=$alltime[$i]['time'];
          }
          for ($i=0; $i <count($data) ; $i++) { 
              $deep[$i]['color']=$data[$i]['color'];
              $deep[$i]['uid']=$data[$i]['uid'];
              $deep[$i]['name']=$name;
              $deep[$i]['selfphone']=$selfphone;
              $deep[$i]['companyname']=$companyname;
              $deep[$i]['time']=$data[$i]['time'];
              $deep[$i]['type']=$data[$i]['type'];
              $deep[$i]['locktype']=$data[$i]['locktype'];
              $deep[$i]['height']=$data[$i]['height'];
              $deep[$i]['width']=$data[$i]['width'];
              $deep[$i]['depth']=$data[$i]['depth'];
              $deep[$i]['box_depth']=$data[$i]['box_depth'];
              $deep[$i]['door_depth']=$data[$i]['door_depth'];
              $deep[$i]['block_depth']=$data[$i]['block_depth'];
              $deep[$i]['unit_price']=$data[$i]['unit_price'];
              $deep[$i]['count']=$data[$i]['count'];
              $deep[$i]['total']=$data[$i]['total'];
              $m->create();
              if (!in_array($deep[$i]['time'],$time)){
                if (!($m->add($deep[$i]))) {
                  $back['status']=1;
                  $this->ajaxReturn($back);
                }
              }   
          }
        $back['status']=2;
        $this->ajaxReturn($back);
      }
      
    }
    //修改一条数据
    public function altdata(){
      $_POST['altis']=1;
      $this->beforecount($_POST);
    }
    //数据存储替换处理，用于点击显示
    public function showchange(){
      $data['uid']=$_SESSION['uid'];
      $data['type']=$_POST['1'];
      $data['height']=$_POST['2'];
      $data['width']=$_POST['3'];
      $data['depth']=$_POST['4'];
      $data['door_depth']=$_POST['5'];
      $data['box_depth']=$_POST['6'];
      $data['block_depth']=$_POST['7'];
      $data['locktype']=$_POST['8'];
      $data['color']=$_POST['9'];
      $data['unit_price']=$_POST['10'];
      $data['count']=$_POST['11'];
      $data['total']=$_POST['12'];
      return $data;
    }
    //输入数据判空处理
    public function dildata(){
      if(empty($_POST['width'])||empty($_POST['height'])||empty($_POST['depth'])||empty($_POST['box_depth'])||empty($_POST['door_depth'])||empty($_POST['block_depth'])||empty($_POST['xianjia'])||empty($_POST['color'])||empty($_POST['mft_type'])||empty($_POST['count'])){
        return true;
      }else{
        return false;
      }
    }
    //ajax添加计算
    public function beforecount(){
      if ($this->dildata($_POST)) {
        $data['status']=0;
        $this->ajaxReturn($data);
      }else{
          if ($_POST['xianjia']==='要') {
          $for=M('Formulate')->where("status = 1")->order("corder asc")->select();
        }else{
          $word='%'.'线夹'.'%';
          $whx['formulate']=array('like',$word);
          $xid=M('Formulate')->where($whx)->field('id')->find();
          $xid=$xid['id'];
          $whe['status']=array('eq',1);
          $whe['id']=array('neq',$xid);
          $for=M('Formulate')->where($whe)->order("corder asc")->select();
        }
        for ($i=0; $i <count($for) ; $i++) { 
            $formu=$for[$i]['formulate'];//取得当前公式
            $uid=(int)$for[$i]['id'];//对应的uid
            $nojudata=M('Nojudge')->where("uid = $uid")->select();//找出对应的非判定数据
            $nocou=count($nojudata);//非判定的数量
            // 将非判定项替换
            if ($nocou>0) {
                for ($j=0; $j < $nocou; $j++) { 
                    $name=$nojudata[$j]['name'];
                    $value=$nojudata[$j]['value'];
                    $formu=str_replace($name,$value,$formu);
                }
            }
            //找出对应的判定数据
            $judgename=M('Judge')->where("uid=$uid")->Distinct(true)->field('judgename')->select();
            // 将判定项替换
            $cou=count($judgename);//判定的数量
            //有判定项时执行
            if ($cou>0) {
                for ($k=0; $k <$cou ; $k++) {
                    $where['judgename']=array('eq',$judgename[$k]['judgename']);
                    $opt=M('Judge')->where($where)->Distinct(true)->field('op')->select();
                    $item1=M('Judge')->where($where)->Distinct(true)->field('item')->find();
                    $item=$item1['item']; 
                    $input=$this->findinput($_POST,$item);
                    $contion=M('Judge')->where($where)->field('contion')->select();
                    $result=M('Judge')->where($where)->field('result')->select();
                    $tresult=$this->findresult($input,$opt[0]['op'],$contion,$result);
                    $formu=str_replace($judgename[$k]['judgename'],$tresult,$formu);
                }
            }
            $str=$str.'+'.$formu;
        }
        $str=$this->strreplace($_POST,$str);
        // var_dump($str);
        $rep='+前式累加';
        $count=0;
        while (strpos($str,$rep) !== false) {
            // 求得截取前字符串的值
            $strf=strstr($str,$rep, TRUE);
            $result=eval("return $strf;");
           
            //获得后字符串去掉前面的+
            $strr=strstr($str,$rep);
            $str= ltrim($strr, "+");

            //获得中间字符串和后
            //通过是否有+判断是否为最后子式
            if (strpos($str,'+')) {
                $mid=strstr($str,$rep,true);
                $strb=strstr($str,$rep);
            }else{
                $mid=$str;
                $strb='';
            }
            //替换中间式
            $mid=str_replace('前式累加',$result,$mid);
            //最后公式
            $str=$result.'+'.$mid.$strb;
            if (strpos($str,$rep) === false) {
                 $price=eval("return $str;");
            }
        }
        $total=(double)$_POST['count']*$price;
        $price=number_format($price, 0, '.', '');
        $total=number_format($total, 0, '.', '');
        $data=$this->changedata($_POST);
        $data['unit_price']=$price;
        $wadd=$data;
        if (M('Count')->where($wadd)->select()) {
          $data['status']=1;
          $this->ajaxReturn($data);

        }else{
          $data['total']=$total;
          $data['count']=$_POST['count'];
          $data['uid']=$_SESSION['uid'];
          $data['time']=time();
          M('Count')->create();
          if ($_POST['altis']==1){
            if (empty($_SESSION['click'])) {
                $data['status']=2;
                $this->ajaxReturn($data);
            }else{
              $altis=$this->getsession($_SESSION['click']);
              $id=M('Count')->where($altis)->field('id')->find();
              $id=$id['id'];
              M('Count')->where("id = $id")->save($data);
              unset($_SESSION['click']);
            }
          }else{
            M('Count')->add($data);
          }
          $did=$_SESSION['uid'];
          $data=M('Count')->where("uid = $did")->Distinct(true)->select();
          if (!empty($data)) {
            $totalnum=0;
            $totalprice=0;
            for ($i=0; $i <count($data) ; $i++) { 
              $totalnum=$data[$i]['count']+$totalnum;
              $totalprice=$data[$i]['total']+$totalprice;
              $data[$i]['id']=$i+1;
            }
          }
          $this->assign('totalnum',$totalnum);
          $this->assign('totalprice',$totalprice);
          $this->assign('data',$data);
          $html = $this->fetch('Count/ajaxtable');
          $this->ajaxReturn($html);
        }
      }
    }
    public function getsession($sess){
        $data['height']=$sess['2'];
        $data['width']=$sess['3'];
        $data['depth']=$sess['4'];
        $data['box_depth']=$sess['6'];
        $data['door_depth']=$sess['5'];
        $data['block_depth']=$sess['7'];
        $data['locktype']=$sess['8'];
        $data['type']=$sess['1'];
        $data['color']=$sess['9'];
        $data['unit_price']=$sess['10'];
        $data['count']=$sess['11'];
        $data['totalprice']=$sess['12'];
        return $data;
    }
    //数据存储替换处理，用于添加和删除
    public function changedata(){
        $data['height']=$_POST['height'];
        $data['width']=$_POST['width'];
        $data['depth']=$_POST['depth'];
        $data['box_depth']=$_POST['box_depth'];
        $data['door_depth']=$_POST['door_depth'];
        $data['block_depth']=$_POST['block_depth'];
        $data['locktype']=$_POST['lock'];
        $data['type']=$_POST['type'];
        $data['color']=$_POST['color'];
        $data['xianjia']=$_POST['xianjia'];
        $data['mft_type']=$_POST['mft_type'];
        return $data;
    }
// 值选取替换
    public function findinput($input,$judgename){
       switch ($judgename) {
           case '箱高':
                return $input['height'];
               break;
           case '箱宽':
                return $input['width'];
               break;
            case '箱深':
                return $input['depth'];
               break;
            case '塑粉颜色':
                return $input['color'];
               break;
            case '线夹':
                return $input['xianjia'];
               break;
            case '锁类型':
                return $input['lock'];
               break;
            case '类型':
                return $input['type'];
               break;
            case '箱高,箱宽':
                if ($input['height']>$input['width']) {
                    return $input['height'];
                }else{
                    return $input['width'];
                }
               break;
            case '塑粉颜色':
                  return $input['color'];
               break;
           default:
               $this->error("判别公式匹配错误！");
               break;
       }
    }
 //判定项选取
    public function findresult($a,$b,$c,$d){
      $h='<=';
      $i='>=';
      $j='<';
      $k='>';
      $l='=';
      switch ($b) {
        case '<=':
            for ($i=0; $i <count($c) ; $i++) {
              if ($a<=$c[$i]['contion']) {
                return $d[$i]['result'];
              }
            }
            break;
          case '>=':
            for ($i=0; $i <count($c) ; $i++) {
              if ($a>=$c[$i]['contion']) {
                return $d[$i]['result'];
              }
            }
            break;
          case '<':
            for ($i=0; $i <count($c) ; $i++) {
              if ($a<$c[$i]['contion']) {
                return $d[$i]['result'];
              }
            }
            break;
           case '>':
            for ($i=0; $i <count($c) ; $i++) {
              if ($a>$c[$i]['contion']) {
                return $d[$i]['result'];
              }
            }
            break;
          case '=':
            for ($i=0; $i <count($c) ; $i++) {
              if ($a==$c[$i]['contion']) {
                return $d[$i]['result'];
              }
            }
            break;
        default:
               $this->error("判别符号匹配计算错误！");
          break;
      }
    }
// 客户输入选取
    public function strreplace($post,$str){
        $str=str_replace('箱高', $post['height']/1000, $str);
        $str=str_replace('箱宽', $post['width']/1000, $str);
        $str=str_replace('箱深', $post['depth']/1000, $str);
        $str=str_replace('箱厚', $post['box_depth']/1000, $str);
        $str=str_replace('门厚', $post['door_depth']/1000, $str);
        $str=str_replace('板厚', $post['block_depth']/1000, $str);
        $op=array("(","（");
        $str=str_replace($op,'(', $str);
        $op=array(")","）");
        $str=str_replace($op,')', $str);   
        return $str;
    }
}