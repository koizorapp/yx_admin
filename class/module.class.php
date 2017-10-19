<?php
include("./class/public.class.php");
class module extends common{
	
	private $page;

	public function __construct(){
		parent::__construct();
		
	}

////////////////////////////////获取模块列表页数据////////////////////////////////////////
	public function get_module_list(){	
		
		$this->page=isset($_GET['page']) ? $_GET['page'] : '';
		if($this->page!=""){
			$limit=$this->page*10-10;
		}else{
			$limit=0;
		}
		
		
		$this->connect_mysql();
		$sql="select * from `module` where `dpm`='{$this->d}' limit {$limit},10";
		//echo $sql;
		 $res=$this->mysqli->query($sql);
		 if($res->num_rows>0){
			 	while($row=$res->fetch_array()){
			 	echo "<tr>";
			 	echo "<td>{$row['number']}</td>";
			 	echo "<td>{$row['name']}</td>";
			 	echo "<td>{$row['executor_title']}</td>";
			 	echo "<td>{$row['device']}</td>";
			 	echo "<td>{$row['appliance']}</td>";
			 	echo "<td>{$row['function']}</td>";
			 	echo "<td>{$row['service_time']}分钟</td>";
			 	echo "<td><a type=\"button\" class=\"am-btn am-btn-primary am-round am-btn-xs\" href=\"module_detail.php?d={$_GET['d']}&id={$row['id']}\">查看详情</a></td>";
			 	echo "</tr>";
			 }
		 }
		 
	}


///////////////////////////////////////获取分页的总数量/////////////////////////////////
	public function page_total(){	
		$this->connect_mysql();
		$sql="select count(*) from `module` where `dpm`='{$this->d}' ";
		$res=$this->mysqli->query($sql);
		$row=$res->fetch_array();
		echo ceil($row[0]/10);
	}
///////////////////////////////////////获取module_detail 详情页面包屑产品名称/////////////////////////////////
	public function get_module_p_name(){
		$id=$_GET['id'];
		if($id!=""){
			$this->connect_mysql();
			$sql="select `name` from `module` where `id`={$id}";
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				$row=$res->fetch_array();
				echo $row['name'];
			}
		}
	}

//////////////////////////////////获取module_detail 详情页的数据//////////////////////////
	public function get_module_detail(){	
		$id=$_GET['id'];
		if($id!=""){
			$this->connect_mysql();
			$sql="select * from `module` where `id`={$id}";
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				$row=$res->fetch_array();
				if($row['sex']==0){
					$sex="无";
				}elseif($row['sex']==1){
					$sex="男";
				}elseif($row['sex']==2){
					$sex="女";
				}

				if($row['b_age']=="n" && $row['e_age']=="n"){
					$age="无限制";
				}else{
					$age=$row['b_age']."-".$row['e_age'];
				}
					
				if($row['is_mt']==0){
					$is_mt="否";
				}else{
					$is_mt="是";
				}

				$executor=explode(",", $row['executor_title']);
				if(count($executor)>1){
					foreach ($executor as  $value) {
						//$executor_res.="<button type=\"button\" class=\"am-btn am-btn-default am-radius am-btn-xs\" data-am-popover=\"{theme: 'success sm',content: '{$this->get_executor_name($value)}', trigger: 'hover focus'}\" style=\"margin-right:10px;\">{$value}</button>";
						$executor_res.="<span  style=\"margin-right:10px;\"><select multiple data-am-selected=\"{btnWidth: 'auto', btnSize: 'xs', btnStyle: 'success'}\" placeholder=\"{$value}\">{$this->get_executor_name($value)}</select></span>";
					}
				}else{
					//$executor_res.="<button type=\"button\" class=\"am-btn am-btn-default am-radius am-btn-xs\" data-am-popover=\"{theme: 'success sm',content: '{$this->get_executor_name($row['executor_title'])}', trigger: 'hover focus'}\" style=\"margin-right:10px;\">{$row['executor_title']}</button>";
					$executor_res.="<select multiple data-am-selected=\"{btnWidth: 'auto', btnSize: 'xs', btnStyle: 'primary'}\" placeholder=\"{$row['executor_title']}\">{$this->get_executor_name($row['executor_title'])}</select>";
				}

				$device=explode(",", $row['device']);
				if(count($device)>1){
					foreach($device as $value){
						$device_res.="<span class=\"m-table-span\">{$value}</span>";
					}
					
				}else{
					$device_res="<span class=\"m-table-span\">{$row['device']}</span>";
				}

				$appliance=explode(",", $row['appliance']);
				if(count($appliance)>1){
					foreach($appliance as $value){
						$appliance_res.="<span class=\"m-table-span\">{$value}</span>";
					}
					
				}else{
					$appliance_res="<span class=\"m-table-span\">{$row['appliance']}</span>";
				}
				 $table_con=<<<EOT
				 <tbody>
                                <tr style="border-top:10px solid #EEEEEE;">
                                    <th>所属中心</th>
                                    <td colspan="5">{$row['dpm']}</td>
                                </tr>
                                <tr >
                                    <th>模块编号</th>
                                    <td>{$row['number']}</td>
                                    <th>模块时间</th>
                                    <td>{$row['service_time']}分钟</td>
                                    <th>性别限制</th>
                                    <td>{$sex}</td>
                                </tr>
                                <tr >
                                    <th>模块名称</th>
                                    <td>{$row['name']}</td>
                                    <th>模块成本</th>
                                    <td></td>
                                    <th>年龄限制</th>
                                    <td>{$age}</td>
                                </tr>
                                <tr style="border-top:10px solid #EEEEEE;">
                                    <th>作用部位</th>
                                    <td colspan="5">{$row['site']}</td>
                                </tr>
                                <tr>
                                    <th>作用功能</th>
                                    <td colspan="5">{$row['function']}</td>
                                </tr>
                                  <tr>
                                    <th>是否医疗</th>
                                    <td colspan="5">{$is_mt}</td>
                                </tr>
                                <tr style="border-top:10px solid #EEEEEE;">
                                    <th>执行人</th>
                                    <td colspan="5">{$executor_res}</td>
                                </tr>
                                <tr>
                                    <th>设备</th>
                                    <td colspan="5">{$device_res}</td>
                                </tr>
                                 <tr>
                                    <th>用品</th>
                                    <td colspan="5">{$appliance_res}</td>
                                </tr>
                                <tr>
                                    <th>诊室</th>
                                    <td colspan="5">{$row['room']}</td>
                                </tr>
                                <tr style="border-top:10px solid #EEEEEE;">
                                    <th>适应症</th>
                                    <td colspan="5">{$row['indication']}</td>
                                </tr>
                                <tr style="border-bottom:10px solid #EEEEEE;">
                                    <th>禁忌症</th>
                                    <td colspan="5">{$row['contraindication']}</td>
                                </tr>
                                <tr>
                               
                                </tr>
                            </tbody>
EOT;
		echo $table_con;
			}
		}
	}

	public function del_module(){
		$id=$_GET['del'];
		if(!empty($id)){
			$this->connect_mysql();
			$sql="delete from `module` where `id`='{$id}'";
			$res=$this->mysqli->query($sql);
			if($this->mysqli->affected_rows>0){
				
			}
		}
	}
}
?>