<?php
/***********************************************************
* Class:        dataPivot                                  *
* Version:      1.0                                        *
* Date:         April 2012                                 *
* Author:       Andry Zulfikar                             *
* Copyright:    © dP Andry 2012			                   *
* Licence :     Free for non-commercial use                *
*                                                          *
************************************************************
* version 1.0   Added Db Class			                   *
************************************************************/

require_once("config.php");

class Db{
	private $host;
	private $user;
	private $pswd;
	private $dbname;
	private $connect;
	public $debug;
	private $dbtype;
	public $nb_queries;
	public $timer_queries;
	
	
	function db(){
		global $cfg;
		$this->host = $cfg->host;
		$this->user = $cfg->username;
		$this->pswd = $cfg->password;
		$this->dbname = $cfg->dbname;
		$this->dbtype = $cfg->dbtype;
		if(empty($debug)){
			$this->debug = false;
		}else{
			$this->debug = true;
		}
		$this->nb_queries = 0;
		$this->timer_queries = 0;
	}

// timer for execution time query
	function timer(){
		$time = explode(' ', microtime());
		return $time[1]+$time[0];
	}
// handling and debug query
	function query($sql){
		if($this->debug==true){
			$this->nb_queries++;
			$beginning = $this->timer();
			$query = mysql_query($sql,$this->db_connect())or die(mysql_error());
			$this->timer_queries += round($this->timer()-$beginning,6);
			echo '<pre><b>('.$this->dbtype.')</b>: '.$sql.'</pre>';
			$timer_queries += round($this->timer()-$beginning,6).'<hr />';
		}else{
			$query = mysql_query($sql,$this->db_connect())or die(mysql_error());
		}
		return $query;
	}
	
	function free_result($query){
		if(mysql_free_result($query)==false){
			return true;
		}
	}
	
	function db_connect(){
		$this->db_connect = mysql_connect($this->host,$this->user,$this->pswd,false) or die (mysql_error()." ".count(mysql_list_dbs()));
		return $this->db_connect;
	}
	
	function db_close(){
		if($this->db_connect){
			mysql_close($this->db_connect);
		}
	}
	
	function db_select($dbname=''){
		if($this->db_connect()==true){
		}else{
			$this->db_connect();
		}
		
		if(empty($dbname)){
			$db_select = mysql_select_db($this->dbname,$this->db_connect())or die(mysql_error()." ".count(mysql_list_dbs()));
		}else{
			$db_select = mysql_select_db($dbname,$this->db_connect())or die(mysql_error()." ".count(mysql_list_dbs()));
		}
		return $db_select;
	}

/********************** HANDLING TABLE DATABASE ********************/
	
// describe table
//output: Field, Type, Null, Key, Default, Extra
	function tb_describe($tbname,$dbname=''){
		if(empty($dbname)){ $dbname=$this->dbname; }
		$sql = "DESCRIBE {$dbname}.{$tbname}";
		$result = $this->data_fetch_sql($sql,'row',true,$dbname);
		return $result;
	}

/********************** HANDLING DATA FROM DATABASE CRUD (CREATE UPDATE DELETE)*********************/

	function data_fetch_sql($sql,$output='object',$multidata=true,$dbname=''){
		$this->db_select($dbname);
		$query = $this->query($sql);
		switch(strtolower($output)){
			case "array":
				if($multidata==true){
					while($data_array = mysql_fetch_array($query)){
						$data[] = $data_array;
					}
				}else{
					$data_array = mysql_fetch_array($query);
					$data = $data_array;
				}	
			break;
			case "assoc":
				if($multidata==true){
					while($data_array = mysql_fetch_assoc($query)){
						$data[] = $data_array;
					}
				}else{
					$data_array = mysql_fetch_array($query);
					$data = $data_array;
				}	
			break;
			case "row":
				if($multidata==true){
					while($data_row = mysql_fetch_row($query)){
						$data[] = $data_row;
					}
				}else{
					$data_row = mysql_fetch_row($query);
					$data = $data_row;
				}
			break;
			case "object":
				if($multidata==true){
					while($data_object = mysql_fetch_object($query)){
						$data[] = $data_object;
					}
				}else{
					$data_object = mysql_fetch_object($query);
					$data = $data_object;
				}
			break;
		}
		//
		$this->free_result($query);
		$this->db_close();
		return $data;
	}

	function data_distinct($tbname,$fieldname,$dbname=''){
		if(!empty($dbname)){ $this->db_select($dbname); }
		$tb_desc = $this->tb_describe($tbname,$dbname);
		foreach($tb_desc as $desc){
			$descs[] = $desc[0];
		}
		$fieldname_explode = explode(",",$fieldname);
		$count_fieldname = count($fieldname_explode);
		for($i=0;$i<$count_fieldname;$i++){
			if(!in_array($fieldname_explode[$i],$descs)){
				echo "<b>Warning</b>: there's no field name {$fieldname_explode[$i]}...Please check your script";
				$status = "error";
			}
		}
		if(empty($status)){
			$sql = "SELECT DISTINCT({$fieldname}) FROM {$dbname}.{$tbname}";
			$result = $this->data_fetch_sql($sql,'object',true,$dbname);
			return $result;
		}
	}
}
?>