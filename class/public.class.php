<?php
include("./class/conn.php");
class common extends connect{
	public $d;

	public function __construct(){
		header("Content-type: text/html; charset=utf-8");
		session_start();
		if($_SESSION['chk']!="ok"){
			$url="http://".$_SERVER ['HTTP_HOST']."/project/login.html";
			header("Location: $url");
		}
		$dp=$_GET['d'];
		if($dp!=""){
			if($dp=="YXYDZX"){
				$this->d="医学运动中心";
			}elseif($dp=="YXMRZX"){
				$this->d="医学美容中心";
			}elseif($dp=="YXSLZX"){
				$this->d="医学水疗中心";
			}elseif($dp=="NXJKZX"){
				$this->d="男性健康中心";
			}elseif($dp=="YKZX"){
				$this->d="牙科中心";
			}elseif($dp=="KSLZX"){
				$this->d="抗衰老中心";
			}elseif($dp=="QKMZZX"){
				$this->d="全科门诊中心";
			}elseif($dp=="YXJCZX"){
                $this->d="医学检测中心";
            }

		}
		// session_start();
		// if($_SESSION['chk']!="ok"){
		// 	$url="http://".$_SERVER ['HTTP_HOST']."/res/login.html";
		// 	header("Location: $url");
		// }
	}

	// public function get_dpm_code($dpm){
	// 	$this->connect_mysql();
	// 	$sql="select ";
	// }

///////根据输入title获取人名/////////////////////////////
	public function get_executor_name($title){
		$this->connect_mysql();
		$sql="select `name` from `executor_info` where `title`='{$title}'";
		$res=$this->mysqli->query($sql);
		if($res->num_rows>0){
			while($row=$res->fetch_array()){
				$result.="<option value=\"{$row['name']}\" disabled='disabled'>{$row['name']}</option>";
			}
		}else{
			$result="<option value='null' disabled='disabled'>暂无</option>";
		}
		return $result;
	}

/////////////////////////////项目及模块详情页中判断上一页下一页是否达到最后一页////////
	public function get_page_start_end($id,$table,$frist_last){
		$this->connect_mysql();
		$sql="select `id` from `{$table}` where `dpm`='{$this->d}' order by `id` asc";
		$res=$this->mysqli->query($sql);
		if($res->num_rows>0){
			while($row=$res->fetch_array()){
				$id_num[]=$row['id'];
			}
		}

		if($frist_last=="frist"){
			if($id==reset($id_num)){
				return 1;
			}else{
				return 0;
			}
		}
		
		if($frist_last=="last"){
			if($id==end($id_num)){
				return 1;
			}else{
				return 0;
			}
		}

	}

/////////////////////////////////////////获取项目及模块页上一页下一页的地址/////////////////
	public function get_page_link($id,$table,$frist_last){
		$this->connect_mysql();
		$sql="select `id` from `{$table}` where `dpm`='{$this->d}'";
		$res=$this->mysqli->query($sql);
		if($res->num_rows>0){
			while($row=$res->fetch_array()){
				$id_arr[]=$row['id'];
			}
		}

		$id=$_GET['id'];
		$key=array_search($id, $id_arr);
		if($frist_last=="frist"){
			if($key!=0){
				$frist_id=$id_arr[$key-1];
				if($table=="module"){
					$url="module_detail.php?d={$_GET['d']}&id=".$frist_id;
				}
				if($table=="project"){
					$url="project_detail.php?d={$_GET['d']}&id=".$frist_id;
				}
			}
			
			
		}
		if($frist_last=="last"){
			$last_id=$id_arr[$key+1];
			if($table=="module"){
				$url="module_detail.php?d={$_GET['d']}&id=".$last_id;
			}
			if($table=="project"){
				$url="project_detail.php?d={$_GET['d']}&id=".$last_id;
			}
			
		}
		echo $url;
	}


}
?>