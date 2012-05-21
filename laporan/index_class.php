<?php
require_once("class/pivot.php");

// example

$y = new Pivot();
$y->debug = true;
$start_time = $y->timer();

// ******************************* CREATE PIVOT TABLE *******************************//
//$resultx = $y->data_pivot('data_pivot','city_name','year_months','city_name','count','asc','dss','left:4');
//data_pivot($tbname,$fieldname,$pivot_field,$sum_of_field,$sum_type='sum',$order_type='',$dbname='',$data_customs='')
$resultx = $y->data_pivot('pivot_harian','idkoperasi','Bulan','Laporan','sum','asc','kukm','');
foreach($resultx as $rows){
	foreach($rows as $key=>$value){
		$val[] = $value;
	}
}
$array_row = array_keys($rows);
$row = count($rows);

echo '<table border="1"><tr>';
for($j=0;$j<count($array_row);$j++){
	echo "<td>".$array_row[$j]."</td>";
}
	echo "</tr>";
for($i = 0; $i < count($val); $i++){
    echo '<td>' . $val[$i] . '</td>';
    if(($i + 1) % $row == 0){
        echo '</tr><tr>';
    }
}
echo '</tr></table>';
//
//
/*
$resulty = $y->data_pivot('data_pivot','left(year_months,4)','city_name','city_name','count','asc','dss');
foreach($resulty as $rows1){
	#foreach($rows1 as $key=>$value){
	#	$val1[] = $value;
	#}
	while(list($key,$value1) = each($rows1)){
		$val1[] = $value1;
	}
}
$array_row1 = array_keys($rows1);
$row1 = count($rows1);

echo '<table border="1"><tr>';
for($j=0;$j<count($array_row1);$j++){
	echo "<td>".$array_row1[$j]."</td>";
}
	echo "</tr>";
for($i = 0; $i < count($val1); $i++){
    echo '<td>' . $val1[$i] . '</td>';
    if(($i + 1) % $row1 == 0){
        echo '</tr><tr>';
    }
}
echo '</tr></table>';
/*
$resultz = $y->data_pivot('data_excel_3','left(bln_thn,4)','nm_kota','pnghsln/12','','asc','dss');
foreach($resultz as $rows2){
	while(list($key,$value2) = each($rows2)){
		$val2[] = $value2;
	}
}
$array_row2 = array_keys($rows2);
$row2 = count($rows2);

echo '<table border="1"><tr>';
for($j=0;$j<count($array_row2);$j++){
	echo "<td>".$array_row2[$j]."</td>";
}
	echo "</tr>";
for($i = 0; $i < count($val2); $i++){
    echo '<td>' . $val2[$i] . '</td>';
    if(($i + 1) % $row2 == 0){
        echo '</tr><tr>';
    }
}
echo '</tr></table>';
*/
// ******************************* END OF PIVOT TABLE ********************************//




if($y->debug==true){
	echo $x->nb_queries.' mysql queries executed in '.$x->timer_queries.' seconds<br />';
}
$end_time = $y->timer();
echo "start timer: ".$start_time."<br />";
echo "end timer: ".$end_time."<br />";
$total_time = ($end_time - $start_time);
echo 'Total execution: '.$total_time.' seconds <br />';
?>