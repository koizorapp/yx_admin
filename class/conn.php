<?php
class connect{
	public $mysqli;

	public function connect_mysql(){ //连接mysql数据库
		//$this->mysqli=new mysqli("127.0.0.1","root","warock85020586","project");
		//$this->mysqli=new mysqli("10.1.7.79","root","iuuiiuoi","project");
		$this->mysqli=new mysqli("10.1.4.250","root","iuuiiuoi","project");
		if(!$this->mysqli->connect_error){
			$this->mysqli->query("set names 'utf8'");
		}else{
			echo $this->mysqli->connect_errno;
			exit;

		}
	}
}
?>