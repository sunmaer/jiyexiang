<?php
namespace Admin\Controller;
use Think\Controller;
class SystemController extends AuthController
{
    // 备份路径
	private $path = "./Database/";
	public function index(){
		echo "网站设置";
		echo '<br><a href="'.U('System/config').'">seo及网址设置</a><br>';
		echo '<br><a href="'.U('System/dataBackups').'">数据库备份</a><br>';
	}
    // seo及邮件验证网址
	public function config(){
		$m=M('Site');
		$data=$m->find(1);
		$this->assign('data',$data);
		$this->display();
	}
	public function altsite(){
		if(isset($_POST)){
			$m=M('Site');
			if ($m->where("id=1")->save($_POST)) {
				$this->success("修改成功！");
			}else{
				$this->error("未作修改！");
			}
		}else{
			$this->error("错误！");
		}
	}
	public function dataBackups(){
        $arr = $this->my_scandir($this->path);
        $this->assign("list",$arr);
        $this->display();
    }

    public function doBackups(){
        header("Content-type: text/html; charset=utf-8");
        $name = $_POST['name']?$_POST['name']:date("Y-m-d",time());
        $this->Mydb();    //连接数据库
        $sql=$this->sqlcreate();
        $sql2=$this->sqlinsert();
        $data=$sql.$sql2;
        $result = file_put_contents($this->path."{$name}(".time().").sql", $data);
        $this->myRelust($result);
    }

    public function doReduction(){
        $name = $_GET['name'];
        $result = $this->reduction($this->path.$name);
        $this->myRelust($result);
    }

    /**
     * 表集合 ...
     */
    public function tblist() {
        $list=array();
        $dbname = C("DB_NAME");
        $rs=mysql_query("SHOW TABLES FROM {$dbname}");
        while ($temp=mysql_fetch_row($rs)) {
            $list[]=$temp[0];
        }
        return $list;
    }


	/**
     * 表结构SQL ...
     */
    public function sqlcreate() {
        $sql='';

        $tb=$this->tblist();
        foreach ($tb as $v) {
            $rs=mysql_query("SHOW CREATE TABLE $v");
            $temp=mysql_fetch_row($rs);
            $sql.="-- 表的结构：{$temp[0]} --\r\n";
            $sql.="{$temp[1]}";
            $sql.=";-- <xjx> --\r\n\r\n";
        }
        return $sql;
    }

    /**
     * 数据插入SQL ...
     */
    public function sqlinsert() {
        $sql='';

        $tb=$this->tblist();
        foreach ($tb as $v) {
            $rs=mysql_query("SELECT * FROM $v");
            if (!mysql_num_rows($rs)) {//无数据返回
                continue;
            }
            $sql.="-- 表的数据：$v --\r\n";
            $sql.="INSERT INTO `$v` VALUES\r\n";
            while ($temp=mysql_fetch_row($rs)) {
                $sql.='(';
                foreach ($temp as $v2) {
                    if ($v2===null) {
                        $sql.="NULL,";
                    }
                    else {
                        $v2=mysql_real_escape_string($v2);
                        $sql.="'$v2',";
                    }
                }
                $sql=mb_substr($sql, 0, -1);
                $sql.="),\r\n";
            }
            $sql=mb_substr($sql, 0, -3);
            $sql.=";-- <xjx> --\r\n\r\n";
        }

        return $sql;
    }

    public function Mydb() {
        $host = C("DB_HOST");
        $user = C("DB_USER");
        $pass = C("DB_PWD");
        $dbname = C("DB_NAME");
        $m = mysql_connect($host,$user,$pass);
        mysql_select_db("{$dbname}");
        mysql_set_charset("utf8");
        return $m;
    }

    public function my_scandir($dir)
    {
           $files = array();
           if ( $handle = opendir($dir) ) {
              while ( ($file = readdir($handle)) !== false )
              {
                 if ( $file != ".." && $file != "." )
                 {
                    if ( is_dir($dir . "/" . $file) )
                    {
                       $files[$file] = my_scandir($dir . "/" . $file);
                   }
                   else
                   {
                        $aaa = fopen($this->path.$file,"r");
                        $fstat = fstat($aaa);
                        $fstat['name']=$file;
                        $fstat['size']=round(filesize($this->path.$file)/1024,2);
                       $files[] = $fstat;
                   }
               }
           }
           closedir($handle);
           return $files;
       }
    }

    /**
     * 还原 ...
     * @param $filename 文件路径
     */
    public function reduction($filename) {
        $this->Mydb();    //连接数据库

        //删除数据表
        $list=$this->tblist();
        $tb='';
        foreach ($list as $v) {
            $tb.="`$v`,";
        }
        $tb=mb_substr($tb, 0, -1);
        if ($tb) {
            $rs=mysql_query("DROP TABLE $tb");
            if ($rs===false) {
                return false;
            }
        }

        //执行SQL
        $str=file_get_contents($filename);
        $arr=explode('-- <xjx> --', $str);
        array_pop($arr);

        foreach ($arr as $v) {
            $rs=mysql_query($v);
            if ($rs===false) {
                return false;
            }
        }

        return true;
    }
    public function delData(){
        $name = $_GET['name'];
        if(empty($name)){
            $this->error("没有文件");
        }else{
            $result = unlink($this->path.$name);
            $this->myRelust($result);
        }
    }
}