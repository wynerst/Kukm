<?php
# PHPlot Demo
# 2009-12-01 ljb
# For more information see http://sourceforge.net/projects/phplot/

# Load the PHPlot class library:
require 'sysconfig.inc.php';
require_once 'phplot/phplot.php';

$sql_text = 'SELECT
h.periode as \'1\',
CONCAT(MONTHNAME(h.periode),\' \',YEAR(h.periode)) as \'2\',
avg(h.h8) AS \'10\',
avg(h.h9) AS \'11\',
avg(h.h10) AS \'12\',
count(*) AS \'99\'
FROM koperasi as k
RIGHT JOIN harian as h ON h.idkoperasi = k.idkoperasi
WHERE YEAR(h.periode) = YEAR(curdate())
GROUP BY MONTH(h.periode)
ORDER BY h.periode ASC';

$xdata = array();
$xlegend = array();
$arrseries = array();
$arrlegend = array();

$arrseries['0'][]='Bunga Simpanan';
$arrseries['1'][]='Bunga Pinjaman';
$arrseries['2'][]='NPL';
 
$set_yearly = $dbs->query($sql_text);
while ($rec = $set_yearly->fetch_assoc()) {
 $arrlegend[] = $rec['2']. ' (Kop: '.$rec['99'].')';
 $arrseries['0'][]=$rec['10'];
 $arrseries['1'][]=$rec['11'];
 $arrseries['2'][]=$rec['12'];
 }

 $xdata = $arrseries;

# Create a PHPlot object which will make an 800x400 pixel image:
$p = new PHPlot(900, 400);

# Use TrueType fonts:
//$p->SetDefaultTTFont('./arial.ttf');

# Set the main plot title:
$p->SetTitle('Data Bulanan Koperasi Indonesia');

# Select the data array representation and store the data:
$p->SetDataType('text-data');
$p->SetDataValues($xdata);

# Select the plot type - bar chart:
$p->SetPlotType('bars');

# Define the data range. PHPlot can do this automatically, but not as well.
//$p->SetPlotAreaWorld(0, 0, 9, 100);

# Select an overall image background color and another color under the plot:
$p->SetBackgroundColor('#ffffcc');
$p->SetDrawPlotAreaBackground(True);
$p->SetPlotBgColor('#ffffff');

# Draw lines on all 4 sides of the plot:
$p->SetPlotBorderType('full');

# Set a 3 line legend, and position it in the upper left corner:
$p->SetLegend($arrlegend);
//$p->SetLegendWorld(0.1, 95);

# Turn data labels on, and all ticks and tick labels off:
//$p->SetDrawXGrid(true);
$p->SetXDataLabelPos('plotdown');
//$p->SetXTickPos('none');
$p->SetXTickLabelPos('none');
//$p->SetYTickPos('none');
$p->SetYTickLabelPos('yaxis');
$p->SetYTitle('Satuan dalam persen');

# Force bottom to Y=0 and set reasonable tick interval:
//$p->SetPlotAreaWorld(NULL, 0, NULL, NULL);
$p->SetYTickIncrement(1);
# Format the Y tick labels as numerics to get thousands separators:
$p->SetYLabelType('data');
$p->SetPrecisionY(0);

# Generate and output the graph now:
$p->DrawGraph();
