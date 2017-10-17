<?php
include("./class/public.class.php");
class manage extends common{

	public function get_select($table,$field,$str){
		$this->connect_mysql();
		$sql="select `{$field}` from `{$table}` {$str}";
		$res=$this->mysqli->query($sql);
		while($row=$res->fetch_array()){
			echo "<option value='{$row[$field]}'>{$row[$field]}</option>";
		}
	}

///////////////////////////////////////edit_module.php////////////////////////////////////////
	
}
?>