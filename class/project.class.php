<?php
include("./class/public.class.php");
class project extends common{

////////////////////////获取project_list页面下的列表信息
	public function get_project_list(){
		$this->connect_mysql();
		$sql="select * from `project` where `dpm`='{$this->d}' order by `id` asc";
		$res=$this->mysqli->query($sql);
		if($res->num_rows>0){
			while($row=$res->fetch_array()){
				echo "<tr>";
				echo "<td>{$row['code']}</td>";
				echo "<td>{$row['name']}</td>";
				echo "<td>{$row['type']}</td>";
				echo "<td>{$row['time']}分钟</td>";
				echo "<td><a type=\"button\" class=\"am-btn am-btn-primary am-round am-btn-xs\" href=\"project_detail.php?d={$_GET['d']}&id={$row['id']}\">查看详情</a></td>";
				echo "</tr>";
			}
		} 
	}

///////////////////////////////////获得project_detail页面面包屑产品名称///////////////////////
	public function get_project_p_name(){
		$id=$_GET['id'];
		if($id!=""){
			$this->connect_mysql();
			$sql="select `name` from `project` where `id`='{$id}'";
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				$row=$res->fetch_array();
				echo $row['name'];
			}
		}
	}

////////////////////////////////////获取project_detail页面内容/////////////////////////////////////////////
	public function get_project_detail_content(){
		$id=$_GET['id'];
		if($id!=""){
			$this->connect_mysql();
			$sql="select * from `project` where `id`='{$id}' and `dpm`='{$this->d}'";
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				$row=$res->fetch_array();
				$result= <<<EOT
				<tr class="p-table-top">
                                    <th >所属中心</th>
                                    <td>{$row['dpm']}</td>
                                    <th class="p-table-left">项目编号</th>
                                    <td>{$row['code']}</td>
                                    <th class="p-table-left">项目时间</th>
                                    <td>{$row['time']}分钟</td>
                                </tr>
                                 <tr >
                                    <th >项目名称</th>
                                    <td>{$row['name']}</td>
                                    <th class="p-table-left">市场价格</th>
                                    <td>{$row['mk_p']}RMB/次</td>
                                    <th class="p-table-left">年龄限制</th>
                                    <td>{$this->get_age($id)}</td>
                                </tr>
                               <tr >
                                    <th >项目类别</th>
                                    <td>{$row['type']}</td>
                                    <th class="p-table-left">会员价格</th>
                                    <td>{$row['mb_p']}RMB/次</td>
                                    <th class="p-table-left">性别限制</th>
                                    <td>{$this->get_sex($id)}</td>
                                </tr>
                                <tr class="p-table-top">
                                    <th>项目描述</th>
                                    <td colspan="5">{$row['describe']}</td>
                                </tr>
                                <tr class="p-table-top">
                                    <th >作用部位</th>
                                    <td colspan="5">{$this->get_module_field($id,"site")}</td>
                                </tr>
                                 <tr >
                                    <th>作用功能</th>
                                    <td colspan="5">{$this->get_module_field($id,"function")}</td>
                                </tr>
                                <tr class="p-table-top">
                                    <th >执行人</th>
                                    <td colspan="5">{$this->get_people($id)}</td>
                                </tr>
                                 <tr class="p-table-top">
                                    <th class="p-table-top">设备</th>
                                    <td colspan="5">{$this->get_module_field($id,"device")}</td>
                                </tr>
                                <tr class="p-table-top">
                                    <th class="p-table-top">用品</th>
                                    <td colspan="5">
                                     <span>{$this->get_module_field($id,"appliance")}</span>
                                    </td>
                                </tr>
                               {$this->get_executor_process($id)}
                                <tr class="p-table-top">
                                    <th>适应症</th>
                                    <td colspan="5">{$this->get_module_field($id,"indication")}</td>
                                </tr>
                                <tr >
                                    <th>禁忌症</th>
                                    <td colspan="5">{$this->get_module_field($id,"contraindication")}</td>
                                </tr>
                                <tr class="p-table-top">
                                    <th>项目成本</th>
                                    <td colspan="5"></td>
                                </tr>
EOT;
		echo $result;
			}
		}
	}

//////////////////////////////返回项目所包含模块的数组，返回一纬或二维数组/////////////////////////////////////////////
	public function get_project_module($id){
		$this->connect_mysql();
		$sql="select `module` from `project` where `id`='{$id}'";
		$res=$this->mysqli->query($sql);
        $m_res = [];
		if($res->num_rows>0){
			$row=$res->fetch_array();

            if(strstr($row['module'],"#")){
				$m_arr=explode("#",$row['module']);
				foreach($m_arr as $val){
					$m_res[]=explode(",", $val);
				}
			}else{
				if(strstr($row['module'],",")){
					$raw=explode(",",$row['module']);
					foreach ($raw as $key => $value){
                        if(strstr($value,"|")){
                            $peers = explode("|",$value);
                            foreach ($peers as $k => $v){
                                $m_res[($key+1) . '_' . ($k+1)] = $v;
                            }
                        }else{
                            $m_res[$key+1] = $value;
                        }
                    }
				}else{
					$m_res[1]=$row['module'];
				}
				
			}
			return $m_res;
		}
	}
//////////////////////////////通过传入的字段名获取项目所包含模块的相关字段值//////////////////////////////////
	private function get_module_field($id,$field){
		$module_name=$this->get_project_module($id);
		$this->connect_mysql();
		foreach($module_name as $val){
			if(is_array($val)){
				foreach ($val as $value) {
					$new_array[]=$value;	
				}
			}else{
				$new_array[]=$val;
			}
		}
		foreach($new_array as $value){
			$sql="select `{$field}` from `module` where `name`='{$value}'";
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				while($row=$res->fetch_array()){
					$assemblage[]=$row[$field];
				}
				
			}
		}
        $result = '';
		$assemblage=array_unique($assemblage);
		$assemblage = implode(',',$assemblage);
		$assemblage = explode(',',$assemblage);
		$assemblage = array_unique($assemblage);
		foreach ($assemblage as $value) {
			$result.=$value."、";
		}
//        return trim(str_replace(",","、",$result),"、");
        return trim($result,"、");
	}
//////////////////////////////获取项目所包含模块的年龄范围/////////////////////////////////////////////
	private function get_age($id){
		$module_name=$this->get_project_module($id);
		$this->connect_mysql();
		foreach($module_name as $val){
			if(is_array($val)){
				foreach ($val as $value) {
					$new_array[]=$value;	
				}
			}else{
				$new_array[]=$val;
			}
		}

		foreach ($new_array as $value) {
			$sql="select `b_age`,`e_age` from `module` where `name`='{$value}'";
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				$row=$res->fetch_array();
					if($row['b_age']!="n"){
						$b_age[]=$row['b_age'];
						}

					if($row['e_age']!="n"){
						$e_age[]=$row['e_age'];
						}
					}
		}

		if(count($b_age)>0){
			$min_age=array_search(min($b_age), $b_age);
			}
			if(count($e_age)>0){
				$max_age=array_search(max($e_age), $e_age);
			}

			if($b_age[$min_age]!="" and $e_age[$max_age]!=""){
				return $b_age[$min_age]."-".$e_age[$max_age];
			}else{
				return "无限制";
			}	
	}

///////////////////////////获取项目所包含模块的性别限制////////////////////////////////////
	private function get_sex($id){
		$sex_assemblage=array(0,1,2);
		$module_name=$this->get_project_module($id);
		$this->connect_mysql();
		foreach($module_name as $val){
			if(is_array($val)){
				foreach ($val as $value) {
					$new_array[]=$value;	
				}
			}else{
				$new_array[]=$val;
			}
		}
		foreach($new_array as $val){
			$sql="select `sex` from `module` where `name`='{$val}'";
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				while($row=$res->fetch_array()){
					$sex_array[]=$row['sex'];
				}
			}
			
		}
		$intersection=array_intersect($sex_assemblage,$sex_array);
		if(count($intersection)>1){
			return "参照模块";
		}else{
			if(current($intersection)==0){
				return "无限制";
			}elseif(current($intersection)==1){
				return "限男";
			}elseif(current($intersection)==2){
				return "限女";
			}
		}

	}
///////////////////////////获取项目所包含模块的执行人title及title所包含人员信息////////////////////////////////////
	private function get_people($id){
		$title=array();
		$module_name=$this->get_project_module($id);
		$this->connect_mysql();
		foreach($module_name as $val){
			if(is_array($val)){
				foreach ($val as $value) {
					$new_array[]=$value;	
				}
			}else{
				$new_array[]=$val;
			}
		}

		foreach($new_array as $value){
			$sql="select `executor_title` from `module` where `name`='{$value}'";
			$res=$this->mysqli->query($sql);
			if($res->num_rows>0){
				while($row=$res->fetch_array()){
					if(strstr($row['executor_title'],",")){
						$title_str=explode(",", $row['executor_title']);
						foreach ($title_str as $value) {
							array_push($title, $value);
						}
						

					}else{
						$title[]=$row['executor_title'];
					}
				}
				
			}
			
		}

		$title=array_unique($title);
		foreach($title as $val){
			//$result.="<button type=\"button\" class=\"am-btn am-btn-default am-radius am-btn-xs\" data-am-popover=\"{theme: 'success sm',content: '{$this->get_executor_name($val)}', trigger: 'hover focus'}\" style=\"margin-right:10px;\">{$val}</button>";
			$result.="<span  style=\"margin-right:10px;\"><select multiple data-am-selected=\"{btnWidth: '100', btnSize: 'xs', btnStyle: 'success'}\" placeholder=\"{$val}\" >{$this->get_executor_name($val)}</select></span>";
		}
		return $result;
		
	}
//////////////////////////////////////////获取执行流程的内容///////////////////////////////////////////////
	public function get_executor_process($id){
        $new_array=$this->get_project_module($id);
		$this->connect_mysql();
//		foreach($module_name as $val){
//			if(is_array($val)){
//				foreach ($val as $value) {
//					$new_array[]=$value;
//				}
//			}else{
//				$new_array[]=$val;
//			}
//		}
		//print_r($module_name);
		$i=1;
		foreach($new_array as $key => $val){
			$sql="select * from `module` where `name`='{$val}'";
			$res=$this->mysqli->query($sql);
			$row=$res->fetch_array();
			if($i==1){
				$result.= "<tr class=\"p-table-top\"><th class=\"p-table-top\" >执行流程</th><td colspan=\"5\" >";
			}else{
				$result.=  "<tr ><th ></th><td colspan=\"5\" >";
			}

			$result.=  "<div><span class=\"am-badge  am-round\">{$key}</span> {$row['name']}</div>";
			if(strstr($row['device'],",")){
				$device_arr=explode(",", $row['device']);
				//$result.=  "<div ><a data-am-collapse=\"{target: '.collapse-nav{$i}'}\">{$device_arr[0]}</a><a class=\"am-nav am-collapse collapse-nav{$i}\">";
				  $result.="<div ><select multiple data-am-selected=\"{btnWidth: '100', btnSize: 'xs'}\" placeholder=\"{$device_arr[0]}\" >";	
				array_shift($device_arr);
				foreach($device_arr as $val){
					$result.=  "<option value=\"{$val}\" disabled='disabled'>{$val}</option>";
				}
				$result.=  "</select></div>";
			}else{
				$result.=  "<div>{$row['device']}</div>";
			}
			if(strstr($row['appliance'],",")){
				$appliance_arr=explode(",", $row['appliance']);
				//$result.=  "<div ><a data-am-collapse=\"{target: '.collapse-nav{$i}'}\">{$appliance_arr[0]}</a><a class=\"am-nav am-collapse collapse-nav{$i}\">";
				$result.="<div ><select multiple data-am-selected=\"{btnWidth: '100', btnSize: 'xs'}\" placeholder=\"{$appliance_arr[0]}\" >";
				array_shift($appliance_arr);
				foreach($appliance_arr as $val){
					$result.=  "<option value=\"{$val}\" disabled='disabled'>{$val}</option>";
				}
				$result.=  "</select></div>";
			}else{
				$result.=  "<div>{$row['appliance']}</div>";
			}

                                    $result.= "<div>{$row['service_time']}分钟</div>";
                                    $result.= "<div>{$row['room']}</div>";
                                    $result.="<div>";
                                    if(strstr($row['executor_title'],",")){
                                    	$executor_title_arr=explode(",", $row['executor_title']);
                                    	foreach ($executor_title_arr as $val) {
                                    		//$result.="<button type=\"button\" class=\"am-btn am-btn-default am-radius am-btn-xs\" data-am-popover=\"{theme: 'success sm',content: '{$this->get_executor_name($val)}', trigger: 'hover focus'}\" style=\"margin:5px 10px 5px 0px;\">{$val}</button>";
                                    		$result.="<span  style=\"margin-right:10px;\"><select multiple data-am-selected=\"{btnWidth: '100', btnSize: 'xs', btnStyle: 'default'}\" placeholder=\"{$val}\" >{$this->get_executor_name($val)}</select></span>";
                                    	}
                                    }else{
                                    	//$result.="<button type=\"button\" class=\"am-btn am-btn-default am-radius am-btn-xs\" data-am-popover=\"{theme: 'success sm',content: '{$this->get_executor_name($row['executor_title'])}', trigger: 'hover focus'}\" style=\"margin:5px 10px 5px 0px;;\">{$row['executor_title']}</button>";
                                    	$result.="<span  style=\"margin-right:10px;\"><select multiple data-am-selected=\"{btnWidth: '100', btnSize: 'xs', btnStyle: 'success'}\" placeholder=\"{$row['executor_title']}\" >{$this->get_executor_name($row['executor_title'])}</select></span>";
                                    }

                                    $result.= "</div></td>";
                                    $result.= "</tr>";
                                $i++;
		}	
		return $result;
		
	}


}
?>