<?php
require_once("db.php");
class Pivot extends Db{
	public function construct(){
		parent::__construct();
	}
	
	function data_pivot($tbname,$fieldname,$pivot_field,$sum_of_field,$sum_type='sum',$order_type='',$dbname='',$data_customs=''){
		if(!empty($dbname)){ $this->db_select($dbname); }
		if(empty($sum_type)){ $plus = "SUM"; $else = "0"; }
		switch(strtoupper($order_type)){
			case "ASC":
				$order_type = "ASC";
			break;
			case "DESC":
				$order_type = "DESC";
			break;
		}
		$distinct = $this->data_distinct($tbname,$pivot_field,$dbname);
		foreach($distinct as $data_in_fields){
			$data_in_field[] = $data_in_fields->$pivot_field;
		}
		$count_data_in_field = count($data_in_field);
		switch(strtoupper($sum_type)){
			case "SUM":
				$plus = "SUM";
				$else = "0";
			break;
			case "COUNT":
				$plus = "COUNT";
				$else = "NULL";
			break;
		}
		for($i=0;$i<$count_data_in_field;$i++){
			$data_in_field[$i] = addslashes($data_in_field[$i]);
			if(!empty($data_customs)){
				$data_custom = explode(":",$data_customs);
				switch(strtoupper($data_custom[0])){
					case "LEFT":
						$as = substr($data_in_field[$i],0,$data_custom[1]);
						$sum_field[] = "{$plus}(IF(LEFT({$pivot_field}, '".$data_custom[1]."') = '".$as."', {$sum_of_field}, {$else})) AS '{$as}'";
					break;
					case "RIGHT":
						$as = substr($data_in_field[$i],-$data_custom[1]);
						$sum_field[] = "{$plus}(IF(RIGHT({$pivot_field}, '".$data_custom[1]."') = '".$as."', {$sum_of_field}, {$else})) AS '{$as}'";
					break;
					case "SUBSTR":
						$as = substr($data_in_field[$i],$data_custom[1]-1,$data_custom[2]);
						$sum_field[] = "{$plus}(IF(SUBSTRING({$pivot_field}, '".$data_custom[1]."', '".$data_custom[2]."') = '".$as."', {$sum_of_field}, {$else})) AS '{$as}'";
					break;
				}
			}else{
				$sum_field[] = "{$plus}(IF({$pivot_field} = '{$data_in_field[$i]}', {$sum_of_field}, {$else})) AS '{$data_in_field[$i]}'";
			}
		}
		$sum_field = implode(", ",$sum_field);
		$sql = "SELECT {$fieldname}, {$sum_field} FROM {$dbname}.{$tbname} GROUP BY {$fieldname} {$order_type}";
		$result = $this->data_fetch_sql($sql,'assoc',true,$dbname);
		reset($result);	
		while(list($key,$value) = each($result)){
			$cvalue[] = $value;
		}
		return $cvalue;
	}	
}
?>