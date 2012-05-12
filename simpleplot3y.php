<?php
# PHPlot Demo
# 2009-12-01 ljb
# For more information see http://sourceforge.net/projects/phplot/

# Load the PHPlot class library:
require 'sysconfig.inc.php';
require_once 'phplot/phplot.php';

$sql_text = 'SELECT
	p.periode as \'1\',
	YEAR(p.finaldate) as \'2\',
	sum(c.c11) AS \'3\',
	sum(c.c12) AS \'4\',
	sum(c.c13) AS \'5\',
	sum(c.c14) AS \'6\',
	sum(c.c21) AS \'7\',
	sum(c.c22) AS \'8\',
	sum(c.c3) AS \'9\'
FROM periode as p
LEFT JOIN `non_coa` as n ON n.idperiode = p.idperiode 
LEFT JOIN coa as c ON c.idperiode = p.idperiode
LEFT JOIN shu as s ON s.idperiode = p.idperiode
GROUP BY YEAR(p.finaldate)
ORDER BY p.finaldate ASC';

$xdata = array();
$xlegend = array();
$arrseries = array();
$arrlegend = array();

$arrseries['0'][]='Aktiva Lancar';
$arrseries['1'][]='Inv. Jangka Panjang';
$arrseries['2'][]='Aktiva Tetap';
$arrseries['3'][]='Aktiva Lain';
$arrseries['4'][]='Kewajiban Lancar';
$arrseries['5'][]='Kewajiban Jangka Panjang';
$arrseries['6'][]='Ekuitas';

$set_yearly = $dbs->query($sql_text);
while ($rec = $set_yearly->fetch_assoc()) {
 $arrlegend[] = $rec['2'];
 $arrseries['0'][]=$rec['3'];
 $arrseries['1'][]=$rec['4'];
 $arrseries['2'][]=$rec['5'];
 $arrseries['3'][]=$rec['6'];
 $arrseries['4'][]=$rec['7'];
 $arrseries['5'][]=$rec['8'];
 $arrseries['6'][]=$rec['9'];
}

 $xdata = $arrseries;
# Create a PHPlot object which will make an 800x400 pixel image:
$p = new PHPlot(900, 400);

# Use TrueType fonts:
//$p->SetDefaultTTFont('./arial.ttf');

# Set the main plot title:
$p->SetTitle('Data Tahunan Koperasi Indonesia');

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
$p->SetDrawXGrid(True);
$p->SetXDataLabelPos('plotdown');
//$p->SetXTickPos('none');
$p->SetXTickLabelPos('none');
//$p->SetYTickPos('none');
$p->SetYTickLabelPos('none');
# Generate and output the graph now:
$p->DrawGraph();
