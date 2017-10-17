<?php
include("./class/conn.php");
//ini_set('display_errors',1);
error_reporting(E_ALL || ~E_NOTICE);
class ajax extends connect{
	private $s_title;
	private $dpm;
	private $field;

	public function __construct(){
		$this->s_title=$_POST['s_title'];
		$this->s_con=$_POST['s_con'];
		$this->dpm=array(
			'医学运动中心'=>'YXYDZX',
			'医学美容中心'=>'YXMRZX',
			'医学水疗中心'=>'YXSLZX',
			'男性健康中心'=>'NXJKZX',
			'牙科中心'=>'YKZX',
			'抗衰老中心'=>'KSLZX',
			'全科门诊中心'=>'QKMZZX'
		);
		$this->field=array(
				'mc'=>'name',
				'zxr'=>'executor_title',
				'sb'=>'device',
				'yp'=>'appliance',
				'zybw'=>'site',
				'zygn'=>'function',
				'syz'=>'indication',
				'jjz'=>'contraindication'
		);
	}

/////////////////////////////////登陆/退出//////////////////////////////////////
public function login(){	//登陆
	$user=$_POST['user'];
	$pwd=$_POST['pwd'];
	if($user!="" && $pwd!=""){
			 $this->connect_mysql();
			 $sql="select * from `user` where `username`='".$this->mysqli->real_escape_string($user)."' and `password`='".$this->mysqli->real_escape_string($pwd)."'";
	
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				$row=$res->fetch_array();
				session_start();
				$_SESSION['chk']="ok";
				$_SESSION['username']=$row['username'];
				$_SESSION['name']=$row['name'];
				$_SESSION['dpm']=$row['dpm'];
				$_SESSION['auth']=$row['authority'];
				$_SESSION['sex']=$row['sex'];
				$sql="insert into `land` (`name`,`datetime`) values ('{$row['name']}','".date('Y-m-d H:i:s',time())."')";
				$this->mysqli->query($sql);
				echo "ok";
			}else{
				echo "";
			}
		}

}


public function logout(){	//登出
		session_start();
		session_unset();
		session_destroy();
		echo "ok";
	}
/////////////////////////////////////////删除项目及模块////////////////////////

	public function del_project(){	//删除项目
		$this->connect_mysql();
		$id=$_POST['del_id'];
		$sql="delete from `project` where `id`={$id}";
		$this->mysqli->query($sql);
		if($this->mysqli->affected_rows>0){
			echo "ok";
		}
	}

	public function del_module(){	//删除模块，及包含此模块的项目
		$this->connect_mysql();
		$id=$_POST['del_id'];
		$sql="select `name` from `module` where `id`='{$id}'";
		$res=$this->mysqli->query($sql);
		$row=$res->fetch_array();
		$module_name=$row['name'];
		$sql="select `id`,`module` from `project` where `module` like '%{$module_name}%'";
		$res=$this->mysqli->query($sql);
		if($res->num_rows>0){
			while($row=$res->fetch_array()){
				if(strstr($row['module'],",")){
					$module_arr=explode(",",$row['module']);
					foreach($module_arr as $val){
						if($val==$module_name){
							$del_sql="delete from `project` where `id`={$row['id']}";
							$this->mysqli->query($del_sql);
						}
					}
				}else{
					if($row['module']==$module_name){
						$del_sql="delete from `project` where `id`={$row['id']}";
						$this->mysqli->query($del_sql);
					}
				}
			}
		}
		//echo $del_sql;
		$sql="delete from `module` where `id`={$id}";
		$this->mysqli->query($sql);
		if($this->mysqli->affected_rows>0){
			echo "ok";
		}
	}

//////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////关键字查询///////////////////////////
	public function get_keyword_con(){	/////////////获取关键字查询后表格所输出的内容
		$title=$_POST['s_title'];
		$con=$_POST['s_con'];
		if($title!="" && $con!=""){
			// $this->connect_mysql();
			// if()
			// $sql=""
			$result=<<<EOF
			<div class="am-tabs" data-am-tabs>
                          <ul class="am-tabs-nav am-nav am-nav-tabs">
                            <li class="am-active"><a href="#tab1">项目</a></li>
                            <li><a href="#tab2">模块</a></li>
                          </ul>

                          <div class="am-tabs-bd">
                            <div class="am-tab-panel am-fade am-in am-active" id="tab1">
                              <table class="am-table  am-table-striped am-table-hover" style="width:98%;display:;" align="center" valign="middle" >
                            <thead>
                                <tr>
                                    <th >项目编号</th>
                                    <th>项目名称</th>
                                    <th>所属中心</th>
                                    <th>项目类别</th>
                                    <th>项目时间</th>
                                    <th ><span style="margin-left:20px;">操作</span></th>
                                </tr>
                            </thead>
                            <tbody>

		{$this->get_project_table()}
  
             </tbody>
                    </table>
                            </div>

                            <div class="am-tab-panel am-fade" id="tab2">
                                    <table class="am-table  am-table-striped am-table-hover  " style="width:98%;" align="center" valign="middle" >
                            <thead>
                                <tr>
                                    <th >模块编号</th>
                                    <th>模块名称</th>
                                    <th>所属中心</th>
                                    <th>执行人</th>
                                    <th>设备</th>
                                    <th>用品</th>
                                    <th>作用功能</th>
                                    <th>模块时间</th>
                                    <th ><span style="margin-left:20px;">操作</span></th>
                                </tr>
                            </thead>
                            <tbody>
                            {$this->get_module_table()}            
                            </tbody>
                        </table>
                            </div>
                          </div>
                        </div>
EOF;
		}
		echo $result;
		
	}

	private function get_project_table(){	//////////////获取项目的关键字查询内容
		
		$is_empty=0;
		$module_name=$this->get_module_in_project();
		if(count($module_name)>0){
			foreach($module_name as $val){
				$str.=$val."|";
			}
			$str=rtrim($str,"|");
		}else{
			$str="";
		}
		//print_r($module_name);

		if($str!="" && $this->s_title=="mc"){
			$sql="select * from `project` where `name` like '%".$this->s_con."%' or `module` REGEXP '".$this->mysqli->real_escape_string($str)."'";	
		}elseif($str=="" && $this->s_title=="mc"){
			$sql="select * from `project` where `name` like '%".$this->s_con."%'";
		}elseif($str!="" && $this->s_title!="mc"){
			$sql="select * from `project` where `module` REGEXP '".$this->mysqli->real_escape_string($str)."'";
		}elseif($str=="" && $this->s_title!="mc"){
			$result.="<div class=\"am-alert am-alert-danger\" data-am-alert ><p>您所搜索的关键词\"{$this->s_con}\"没有找到结果！</p></div>";
			return $result;
			exit();
		}

		$this->connect_mysql();
		$res=$this->mysqli->query($sql);
		if($res->num_rows>0){
			$is_empty=1;
				while($row=$res->fetch_array()){
					$result.="<tr>";
					$result.="<td>{$row['code']}</td>";
					$result.="<td>{$row['name']}</td>";
					$result.="<td>{$row['dpm']}</td>";
					$result.="<td>{$row['type']}</td>";
					$result.="<td>{$row['time']}分钟</td>";
					$result.="<td><a type=\"button\" class=\"am-btn am-btn-primary am-round am-btn-xs\" href=\"project_detail.php?d={$this->dpm[$row['dpm']]}&id={$row['id']}\" target=\"_blank\">查看详情</a></td>";
					$result.="</tr>";
				}
			}

		if($is_empty==0){
			$result.="<div class=\"am-alert am-alert-danger\" data-am-alert ><p>您所搜索的关键词\"{$this->s_con}\"没有找到结果！</p></div>";
		}
		return $result;
	}

	private function get_module_table(){	/////////获取模块的关键字查询内容
		$this->connect_mysql();
		$sql="select * from `module` where `{$this->field[$this->s_title]}` like '%".$this->mysqli->real_escape_string($this->s_con)."%'";
		$res=$this->mysqli->query($sql);
		if($res->num_rows>0){
			while($row=$res->fetch_array()){
				$result.="<tr>";
				$result.="<td>{$row['number']}</td>";
				$result.="<td>{$row['name']}</td>";
				$result.="<td>{$row['dpm']}</td>";
				$result.="<td>{$row['executor_title']}</td>";
				$result.="<td>{$row['device']}</td>";
				$result.="<td>{$row['appliance']}</td>";
				$result.="<td>{$row['function']}</td>";
				$result.="<td>{$row['service_time']}分钟</td>";
				$result.="<td><a type=\"button\" class=\"am-btn am-btn-primary am-round am-btn-xs\" href=\"module_detail.php?d={$this->dpm[$row['dpm']]}&id={$row['id']}\" target=\"_blank\">查看详情</a></td>";
				$result.="</tr>";
			}
		}else{
			$result.="<div class=\"am-alert am-alert-danger\" data-am-alert ><p>您所搜索的关键词\"{$this->s_con}\"没有找到结果！</p></div>";
		}
		return $result;
	}

	private function get_module_in_project(){	///////////获取项目所包含的模块
		$this->connect_mysql();
		$sql="select * from `module` where `{$this->field[$this->s_title]}` like '%".$this->mysqli->real_escape_string($this->s_con)."%'";
		$res=$this->mysqli->query($sql);
		if($res->num_rows>0){
			while($row=$res->fetch_array()){
				$module_name[]=$row['name'];
			}
		}else{
			$module_name=array();
		}
		
		return array_unique($module_name);
	}
////////////////////////////////////////////关键字查询END///////////////////////////////////////////

///////////////////////////////////////////管理中心模块数据提交页///////////////////////////
	public function sub_module_data(){	//提交模块操作
		$name=$this->get_sub_module_name($_POST['name']);
		$dpm=$_POST['dpm'];
		$code=$this->get_module_number($dpm);
		$room=$_POST['room'];
		$exp=$this->format_val($_POST['exp']);
		$device=$this->format_val($_POST['device']);
		$apl=$this->format_val($_POST['apl']);
		$site=$this->format_val($_POST['site']);
		$fun=$this->format_val($_POST['fun']);
		$idc=$this->format_val($_POST['idc']);
		$ctd=$this->format_val($_POST['ctd']);
		$sex=$_POST['sex'];
		$age_val=$_POST['age_val'];
		$time=$_POST['time'];
		$is_yl=$_POST['is_yl'];
		if($age_val==0){
			$age_b=$_POST['age_b'];
			$age_e=$_POST['age_e'];
		}else{
			$age_b="n";
			$age_e="n";
		}
		$this->connect_mysql();
		$sql="insert into `module` (`number`,`dpm`,`name`,`executor_title`,`service_time`,`device`,`appliance`,`room`,`is_mt`,`site`,`function`,`indication`,`contraindication`,`sex`,`b_age`,`e_age`) values ('{$code}','{$dpm}','{$name}','{$exp}',{$time},'{$device}','{$apl}','{$room}',{$is_yl},'{$site}','{$fun}','{$idc}','{$ctd}',{$sex},'{$age_b}','{$age_e}') ";

		$res=$this->mysqli->query($sql);
		if($this->mysqli->affected_rows>0){
			echo $this->get_dpm_code($dpm);
		}
		//echo $code;

	}

	private function get_sub_module_name($name){	//提交项目时获取项目名称
		$this->connect_mysql();
		$sql="select `name` from `module` where `name` like'%{$name}%' ORDER BY `name` asc";
		$res=$this->mysqli->query($sql);
		if($res->num_rows>0){
			while($row=$res->fetch_array()){
				$last_name=$row['name'];
			}
			if(strstr($last_name,'_')){
				$name_arr=explode("_",$last_name);
				$name_num=$name_arr[1]+1;
				return $name."_".$name_num;
			}else{
				return $name."_1";
			}
		}else{	
			return $name;
		}
	}	

	private function get_module_number($dpm){	//获取模块里应该填入的编号
		$this->connect_mysql();
		$sql="select `code` from `department` where `name` = '{$dpm}'";
		$res=$this->mysqli->query($sql);
		if($res->num_rows>0){
			$row=$res->fetch_array();
			$dpm_code= $row['code'];
		}
		//echo $dpm
		$sql="select `number` from `module` where `number` like '%{$dpm_code}%' ORDER BY `number` asc";
		//echo $sql;
		$res=$this->mysqli->query($sql);
		if($res->num_rows>0){
			while($row=$res->fetch_array()){
				$dpm_last=$row['number'];
			}
			
			$dpm_arr=explode("-",$dpm_last);
			$dpm_code_num=$dpm_arr[1]+1;
			return $dpm_code."-".$dpm_code_num;
			//print($dpm_arr);

		}else{
			return $dpm_code."-1";
		}
			
	}

	private function get_dpm_code($dpm){	//通过部门名称获取编码
		$this->connect_mysql();
		$sql="select `code` from `department` where `name` = '{$dpm}'";
		$res=$this->mysqli->query($sql);
		if($res->num_rows>0){
			$row=$res->fetch_array();
			$dpm= $row['code'];
			return $dpm;
		}

	}

	private function format_val($variable){	//格式化传入的数组
		foreach ($variable as $value) {
			$str.=$value.",";
		}
		$str=rtrim($str,",");
		return $str;
	}
////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////管理中心提交项目////////////////////////////////////////
	public function get_add_project_module(){	//获取项目提交中选择模块的初始内容
		$this->connect_mysql();
		$sql="select * from `module` order by `id` asc";
		$res=$this->mysqli->query($sql);
		if($res->num_rows>0){
			while($row=$res->fetch_array()){
				$result.="<tr>";
				$result.="<td><label class=\"am-checkbox\"><input type=\"checkbox\"  class='m-p-checkbox' data-id=\"{$row['id']}\" value=\"{$row['name']}\"data-am-ucheck></label></td>";
				$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">{$row['number']}</td>";
				$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">{$row['dpm']}</td>";
				$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">{$row['name']}</td>";
				$result.="<td >{$row['executor_title']}</td>";
				$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">{$row['service_time']}分钟</td>";
				$result.="<td>{$row['device']}</td>";
				$result.="<td>{$row['appliance']}</td>";
				$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">{$row['room']}</td>";
				if($row['is_mt']==1){
					$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">是</td>";
				}else{
					$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">否</td>";
				}
				$result.="<td>{$row['site']}</td>";
				$result.="<td>{$row['function']}</td>";
				$result.="<td>{$row['indication']}</td>";
				$result.="<td>{$row['contraindication']}</td>";
				if($row['sex']==0){
					$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">不限制</td>";
				}elseif($row['sex']==1){
					$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">男</td>";
				}elseif($row['sex']==2){
					$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">女</td>";
				}
				if($row['b_age']=='n' && $row['e_age']=='n'){
					$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">不限制</td>";
				}else{
					$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">{$row['b_age']}-{$row['e_age']}</td>";
				}
				$result.="</tr>";
			}
		}
		echo $result;
	}

	public function get_ck_module_con(){	//项目提交中模块选择页面通过条件筛选后的模块内容展现
		$dpm=$_POST['dpm'];
		$field=$_POST['field'];
		$field_con=$_POST['field_con'];
		if($dpm=='all'){
			$where_dpm=1;
		}else{
			$where_dpm="`dpm`='{$dpm}'";
		}

		if($field=='no'){
			$where_field=1;
		}else{
			$where_field="`{$this->field[$field]}` like '%{$field_con}%'";
		}

		$this->connect_mysql();
		$sql="select * from `module` where {$where_dpm} and {$where_field} order by `id` asc";
		$res=$this->mysqli->query($sql);
		if($res->num_rows>0){
			while($row=$res->fetch_array()){
				$result.="<tr>";
				$result.="<td><label class=\"am-checkbox\"><input type=\"checkbox\"  class='m-p-checkbox' value=\"{$row['name']}\"data-am-ucheck></label></td>";
				$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">{$row['number']}</td>";
				$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">{$row['dpm']}</td>";
				$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">{$row['name']}</td>";
				$result.="<td >{$row['executor_title']}</td>";
				$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">{$row['service_time']}分钟</td>";
				$result.="<td>{$row['device']}</td>";
				$result.="<td>{$row['appliance']}</td>";
				$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">{$row['room']}</td>";
				if($row['is_mt']==1){
					$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">是</td>";
				}else{
					$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">否</td>";
				}
				$result.="<td>{$row['site']}</td>";
				$result.="<td>{$row['function']}</td>";
				$result.="<td>{$row['indication']}</td>";
				$result.="<td>{$row['contraindication']}</td>";
				if($row['sex']==0){
					$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">不限制</td>";
				}elseif($row['sex']==1){
					$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">男</td>";
				}elseif($row['sex']==2){
					$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">女</td>";
				}
				if($row['b_age']=='n' && $row['e_age']=='n'){
					$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">不限制</td>";
				}else{
					$result.="<td style=\"word-break: keep-all;white-space:nowrap;\">{$row['b_age']}-{$row['e_age']}</td>";
				}
				$result.="</tr>";
			}
		}else{
			$result="";
		}
		echo $result;
	}

	public function display_add_module(){	//显示已经选取的模块名称
		$m_val=$_POST['m_val'];
		$m_val=ltrim($m_val,",");
		$m_val_arr=explode(",",$m_val);
		foreach($m_val_arr as $val){
			$result.="<option disabled=\"disabled\">{$val}</option>";
		}
		echo $result;
	}

	public function get_project_type(){	//项目提交中通过部门名称获取类别
		$dpm=$_POST['dpm'];
		$this->connect_mysql();
		$sql="select `name` from `classify` where `dpm`='{$dpm}'";
		$res=$this->mysqli->query($sql);
		if($res->num_rows>0){
			while($row=$res->fetch_array()){
				$result.="<option value=\"{$row['name']}\">{$row['name']}</option>";
			}
		}else{
			$result="";
		}
		echo $result;
	}

	public function judge_projectName(){	//判断输入项目名称是否重复
		$p_name=$_POST['project_name'];
		$this->connect_mysql();
		$sql="select * from `project` where `name`='{$p_name}'";
		$res=$this->mysqli->query($sql);
		if($res->num_rows>0){
			echo 1;
		}else{
			echo "";
		}
	}

	public function sub_project_data(){	//提交项目的操作
		$name=$_POST['name'];
		$dpm=$_POST['dpm'];
		$p_type=$_POST['p_type'];
		$mp_p=$_POST['mp_p'];
		$mb_p=$_POST['mb_p'];
		$module=ltrim($_POST['module'],",");
		$describe=$_POST['describe'];
		$time=$_POST['time'];
		$project_num=$this->get_project_num();
		$project_num=$project_num+1;
		$project_code=$this->get_code($dpm,"department")."-".$this->get_code($p_type,"classify")."-".$project_num;
		$sql="insert into `project` (`code`,`name`,`dpm`,`type`,`mk_p`,`mb_p`,`describe`,`module`,`time`) values ('{$project_code}','{$name}','{$dpm}','{$p_type}',{$mp_p},{$mb_p},'{$describe}','{$module}',{$time})";
	
		$this->mysqli->query($sql);
		if($this->mysqli->affected_rows>0){
			echo $this->get_dpm_code($dpm);
		}

	}

	private function get_code($name,$table){	//通过传入的部门名称获取部门编号
		$this->connect_mysql();
		$sql="select `code` from `{$table}` where `name`='{$name}'";
		$res=$this->mysqli->query($sql);
		$row=$res->fetch_array();
		return $row['code'];
	}

	private function get_project_num(){	//获取项目的总条数
		$this->connect_mysql();
		$sql="select count(*) from `project`";
		$res=$this->mysqli->query($sql);
		$row=$res->fetch_array();
		return $row[0];
	}

	public function judge_projectTime(){
		$project_time=$_POST['time'];
		$module=$_POST['module'];
		$module_total_time=$this->get_module_time($module);
		if($project_time<$module_total_time){
			echo $module_total_time;
		}else{
			echo "ok";
		}
	}

	public function get_module_time($module){	//提交项目时的模块总时间。
		$module_arr=explode(",",$module);
		$this->connect_mysql();
		foreach($module_arr as $val){
			$sql="select `service_time` from `module` where `name`='{$val}'";
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				while($row=$res->fetch_array()){
					$total_time+=$row['service_time'];
				}
			}
		}
		return $total_time;
	}
////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////编辑模块/////////////////////////////////////////////
	// public function edit_module_val(){ 	//获取需要修改的模块的相关值
	// 	$id=$_POST['id'];
	// 	$this->connect_mysql();
	// 	$sql="select * from `module` where `id`={$id}";
	// 	$res=$this->mysqli->query($sql);
	// 	$result=$res->fetch_array();
	// 	echo json_encode($result);

	// }


//////////////////////////////////////添加标签///////////////////////////////////////////
	public function get_label_table($name){	//通过传入的标签名获取对应数据表中的数据
		$this->connect_mysql();
		if($name=='label-ry'){
			$sql='select * from `executor_info` order by `id` asc';
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				while($row=$res->fetch_array()){
					$result.="<tr>";
					$result.="<td>{$row['number']}</td>";
					$result.="<td>{$row['dpm']}</td>";
					$result.="<td>{$row['title']}</td>";
					$result.="<td>{$row['name']}</td>";
					$result.="<td>{$row['wage']}</td>";
					$result.="<td><button class=\"am-btn am-btn-danger am-radius  am-btn-sm \"  tablecon='label-ry' tablename='executor_info' tableid='{$row['id']}' type=\"button\">删除</button></td>";
					$result.="</tr>";
				}
			}else{
				$result="";
			}
		}elseif($name=='label-sb'){
			$sql='select * from `device` order by `id` asc';
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				while($row=$res->fetch_array()){
					$result.="<tr>";
					$result.="<td>{$row['code']}</td>";
					$result.="<td>{$row['name']}</td>";
					$result.="<td>{$row['dpm']}</td>";
					$result.="<td>{$row['room']}</td>";
					$result.="<td>{$row['brand']}</td>";
					$result.="<td>{$row['region']}</td>";
					$result.="<td>{$row['price']}</td>";
					$result.="<td>{$row['cost']}</td>";
					$result.="<td>{$row['describe']}</td>";
					$result.="<td><button class=\"am-btn am-btn-danger am-radius  am-btn-sm \"  tablecon='label-sb' tablename='device' tableid='{$row['id']}' type=\"button\">删除</button></td>";
					$result.="</tr>";
				}
			}else{
				$result="";
			}
		}elseif($name=='label-yp'){
			$sql='select * from `appliance` order by `id` asc';
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				while($row=$res->fetch_array()){
					$result.="<tr>";
					$result.="<td>{$row['code']}</td>";
					$result.="<td>{$row['name']}</td>";
					$result.="<td>{$row['dpm']}</td>";
					$result.="<td>{$row['brand']}</td>";
					$result.="<td>{$row['region']}</td>";
					$result.="<td>{$row['price']}</td>";
					$result.="<td>{$row['cost']}</td>";
					$result.="<td>{$row['describe']}</td>";
					$result.="<td><button class=\"am-btn am-btn-danger am-radius  am-btn-sm \"   tablecon='label-yp' tablename='appliance' tableid='{$row['id']}' type=\"button\">删除</button></td>";
					$result.="</tr>";
				}
			}else{
				$result="";
			}
		}elseif($name=='label-bm'){
			$sql='select * from `department` order by `id` asc';
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				while($row=$res->fetch_array()){
					$result.="<tr>";
					$result.="<td>{$row['code']}</td>";
					$result.="<td>{$row['name']}</td>";
					$result.="<td><button class=\"am-btn am-btn-danger am-radius  am-btn-sm \"  tablecon='label-bm' tablename='department' tableid='{$row['id']}' type=\"button\">删除</button></td>";
					$result.="</tr>";
				}
			}else{
				$result="";
			}
		}elseif($name=='label-zs'){
			$sql='select * from `room` order by `id` asc';
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				while($row=$res->fetch_array()){
					$result.="<tr>";
					$result.="<td>{$row['code']}</td>";
					$result.="<td>{$row['dpm']}</td>";
					$result.="<td>{$row['name']}</td>";
					$result.="<td><button class=\"am-btn am-btn-danger am-radius  am-btn-sm \"  tablecon='label-zs' tablename='room' tableid='{$row['id']}' type=\"button\">删除</button></td>";
					$result.="</tr>";
				}
			}else{
				$result="";
			}
		}elseif($name=='label-xmlb'){
			$sql='select * from `classify` order by `id` asc';
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				while($row=$res->fetch_array()){
					$result.="<tr>";
					$result.="<td>{$row['code']}</td>";
					$result.="<td>{$row['dpm']}</td>";
					$result.="<td>{$row['name']}</td>";
					$result.="<td><button class=\"am-btn am-btn-danger am-radius  am-btn-sm \"  tablecon='label-xmlb' tablename='classify' tableid='{$row['id']}' type=\"button\">删除</button></td>";
					$result.="</tr>";
				}
			}else{
				$result="";
			}
		}elseif($name=='label-zybw'){
			$sql='select * from `site` order by `id` asc';
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				while($row=$res->fetch_array()){
					$result.="<tr>";
					$result.="<td>{$row['id']}</td>";
					$result.="<td>{$row['name']}</td>";
					$result.="<td><button class=\"am-btn am-btn-danger am-radius  am-btn-sm \"  tablecon='label-zybw' tablename='site' tableid='{$row['id']}' type=\"button\">删除</button></td>";
					$result.="</tr>";
				}
			}else{
				$result="";
			}
		}elseif($name=='label-zygn'){
			$sql='select * from `function` order by `id` asc';
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				while($row=$res->fetch_array()){
					$result.="<tr>";
					$result.="<td>{$row['id']}</td>";
					$result.="<td>{$row['name']}</td>";
					$result.="<td><button class=\"am-btn am-btn-danger am-radius  am-btn-sm \"  tablecon='label-zygn' tablename='function' tableid='{$row['id']}' type=\"button\">删除</button></td>";
					$result.="</tr>";
				}
			}else{
				$result="";
			}
		}elseif($name=='label-syz'){
			$sql='select * from `indication` order by `id` asc';
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				while($row=$res->fetch_array()){
					$result.="<tr>";
					$result.="<td>{$row['id']}</td>";
					$result.="<td>{$row['name']}</td>";
					$result.="<td><button class=\"am-btn am-btn-danger am-radius  am-btn-sm \"  tablecon='label-syz'  tablename='indication' tableid='{$row['id']}' type=\"button\">删除</button></td>";
					$result.="</tr>";
				}
			}else{
				$result="";
			}
		}elseif($name=='label-jjz'){
			$sql='select * from `contraindication` order by `id` asc';
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				while($row=$res->fetch_array()){
					$result.="<tr>";
					$result.="<td>{$row['id']}</td>";
					$result.="<td>{$row['name']}</td>";
					$result.="<td><button class=\"am-btn am-btn-danger am-radius  am-btn-sm \"  tablecon='label-jjz' tablename='contraindication' tableid='{$row['id']}' type=\"button\">删除</button></td>";
					$result.="</tr>";
				}
			}else{
				$result="";
			}
		}
		echo $result;
	}	

	public function add_label_ry(){		//增加标签----人员
		$this->connect_mysql();
		$dpm=$_POST['dpm'];
		$title=$_POST['title'];
		$name=$_POST['name'];
		$wage=$_POST['wage'];
		$sql="select count(*) from `executor_info`";
		
		$res=$this->mysqli->query($sql);
		$row=$res->fetch_array();
		$number=$row[0]+1;
		$number="E-{$number}";
		$sql="insert into `executor_info` (`number`,`dpm`,`title`,`name`,`wage`) values ('{$number}','{$dpm}','{$title}','{$name}','{$wage}')";
		
		$this->mysqli->query($sql);
		if($this->mysqli->affected_rows>0){
			echo "ok";
		}

	}

	public function add_label_sb(){	//增加标签----设备
		$this->connect_mysql();
		$dpm=$_POST['dpm'];
		$name=$_POST['name'];
		$room=$_POST['room'];
		$code=$_POST['code'];
		$brand=$_POST['brand'];
		$region=$_POST['region'];
		$price=$_POST['price'];
		$cost=$_POST['cost'];
		$describe=$_POST['describe'];
		$sql="insert into `device` (`code`,`dpm`,`name`,`brand`,`describe`,`region`,`room`,`price`,`cost`) values ('{$code}','{$dpm}','{$name}','{$brand}','{$describe}','{$region}','{$room}','{$price}','{$cost}')";
		$this->mysqli->query($sql);
		if($this->mysqli->affected_rows>0){
			echo "ok";
		}
	}


	public function add_label_yp(){	//增加标签----用品
		$this->connect_mysql();
		$dpm=$_POST['dpm'];
		$name=$_POST['name'];
		$brand=$_POST['brand'];
		$region=$_POST['region'];
		$price=$_POST['price'];
		$cost=$_POST['cost'];
		$describe=$_POST['describe'];
		$sql="select count(*) from `appliance`";
		$res=$this->mysqli->query($sql);
		$row=$res->fetch_array();
		$code=$row[0]+1;
		$code="A-{$code}";
		$sql="insert into `appliance` (`code`,`dpm`,`name`,`brand`,`describe`,`region`,`price`,`cost`) values ('{$code}','{$dpm}','{$name}','{$brand}','{$describe}','{$region}','{$price}','{$cost}')";
		$this->mysqli->query($sql);
		if($this->mysqli->affected_rows>0){
			echo "ok";
		}
	}


	public function add_label_bm(){	//增加标签----部门
		$this->connect_mysql();
		$name=$_POST['dpm'];
		$code=$_POST['code'];
		$sql="insert into `department` (`code`,`name`) values ('{$code}','{$name}')";
		$this->mysqli->query($sql);
		if($this->mysqli->affected_rows>0){
			echo "ok";
		}
	}

	public function add_label_zs(){	//增加标签----诊室
		$this->connect_mysql();
		$dpm=$_POST['dpm'];
		$name=$_POST['name'];
		$sql="select count(*) from `room`";
		$res=$this->mysqli->query($sql);
		$row=$res->fetch_array();
		$code=$row[0]+1;
		$code="R-{$code}";
		$sql="insert into `room` (`code`,`name`,`dpm`) values ('{$code}','{$name}','{$dpm}')";
		$this->mysqli->query($sql);
		if($this->mysqli->affected_rows>0){
			echo "ok";
		}
	}


	public function add_label_xmlb(){	//增加标签----项目类别
		$this->connect_mysql();
		$name=$_POST['name'];
		$code=$_POST['code'];
		$dpm=$_POST['dpm'];
		$sql="insert into `classify` (`code`,`name`,`dpm`) values ('{$code}','{$name}','{$dpm}')";
		$this->mysqli->query($sql);
		if($this->mysqli->affected_rows>0){
			echo "ok";
		}
	}

	public function add_label_zybw(){	//增加标签----作用部位
		$this->connect_mysql();
		$name=$_POST['name'];
		$sql="insert into `site` (`name`) values ('{$name}')";
		$this->mysqli->query($sql);
		if($this->mysqli->affected_rows>0){
			echo "ok";
		}
	}

	public function add_label_zygn(){	//增加标签----作用功能
		$this->connect_mysql();
		$name=$_POST['name'];
		$sql="insert into `function` (`name`) values ('{$name}')";
		$this->mysqli->query($sql);
		if($this->mysqli->affected_rows>0){
			echo "ok";
		}
	}

	public function add_label_syz(){	//增加标签----适应症
		$this->connect_mysql();
		$name=$_POST['name'];
		$sql="insert into `indication` (`name`) values ('{$name}')";
		$this->mysqli->query($sql);
		if($this->mysqli->affected_rows>0){
			echo "ok";
		}
	}

	public function add_label_jjz(){	//增加标签----禁忌症
		$this->connect_mysql();
		$name=$_POST['name'];
		$sql="insert into `contraindication` (`name`) values ('{$name}')";
		$this->mysqli->query($sql);
		if($this->mysqli->affected_rows>0){
			echo "ok";
		}
	}

	public function label_del(){	//删除标签
		$id=$_POST['id'];
		$table=$_POST['table'];
		$this->connect_mysql();
		$sql="delete from `{$table}` where `id`={$id}";
		//echo $sql;
		$this->mysqli->query($sql);
		if($this->mysqli->affected_rows>0){
			echo "ok";
		}
	}
}

$a=new ajax();
if($_POST['type']=='keyword'){
	$a->get_keyword_con();
}
if($_POST['type']=='check_sub_module_name'){
	$a->get_sub_module_name();
}
if($_POST['type']=='sub_module'){
	$a->sub_module_data();
}
if($_POST['type']=='del_project'){
	$a->del_project();
}
if($_POST['type']=='del_module'){
	$a->del_module();
}
if($_POST['type']=='get_add_module_con'){
	$a->get_add_project_module();
}
if($_POST['type']=='get_ck_module_con'){
	$a->get_ck_module_con();
}
if($_POST['type']=='display_add_module'){
	$a->display_add_module();
}
if($_POST['type']=='get_project_type'){
	$a->get_project_type();
}
if($_POST['type']=='judge_projectName'){
	$a->judge_projectName();
}
if($_POST['type']=='sub_project'){
	$a->sub_project_data();
}
if($_POST['type']=='judge_projectTime'){
	$a->judge_projectTime();
}
if($_POST['type']=='login'){
	$a->login();
}
if($_POST['type']=='sign_out'){
	$a->logout();
}
if($_POST['type']=='edit_module'){
	$a->edit_module_val();
}
if($_POST['label_type']!=""){
	$a->get_label_table($_POST['label_type']);
}
if($_POST['type']=='add_label_ry'){
	$a->add_label_ry();
}
if($_POST['type']=='add_label_sb'){
	$a->add_label_sb();
}
if($_POST['type']=='add_label_yp'){
	$a->add_label_yp();
}
if($_POST['type']=='add_label_bm'){
	$a->add_label_bm();
}
if($_POST['type']=='add_label_zs'){
	$a->add_label_zs();
}
if($_POST['type']=='add_label_xmlb'){
	$a->add_label_xmlb();
}
if($_POST['type']=='add_label_zybw'){
	$a->add_label_zybw();
}
if($_POST['type']=='add_label_zygn'){
	$a->add_label_zygn();
}
if($_POST['type']=='add_label_syz'){
	$a->add_label_syz();
}
if($_POST['type']=='add_label_jjz'){
	$a->add_label_jjz();
}
if($_POST['type']=='label_del'){
	$a->label_del();
}
//echo $a->get_module_time(',测试项目,测试模块');
?>