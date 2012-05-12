<?php
# PHPlot Demo
# 2009-12-01 ljb
# For more information see http://sourceforge.net/projects/phplot/

# Load the PHPlot class library:
require 'sysconfig.inc.php';
require_once 'phplot/phplot.php';

$sql_text = 'SELECT
	tk.jenis as \'1\',
	(sum(c.c2110)+sum(c.c2210)+sum(c.c3110)+sum(c.c3120)) AS \'3\',
	sum(c.c1140) AS \'4\',
	(sum(c.c3110)+sum(c.c3120)) AS \'5\',
	(sum(c.c3130)+sum(c.c3140)) AS \'6\',
	format(n.vol_usaha/1000,2) AS \'7\',
	(sum(c.c11)+sum(c.c12)+sum(c.c13)+sum(c.c14)) AS \'8\',
	(sum(c.c3170)+sum(c.c3180)) AS \'9\',
	format(n.sb_simpanan,2) AS \'10\',
	format(n.sb_pinjaman,2) AS \'11\',
	format((n.piutangmacet/n.akumulasi_pinjaman)*100,2) AS \'12\'
FROM koperasi as k
LEFT JOIN `non_coa` as n ON n.idkoperasi = k.idkoperasi 
LEFT JOIN coa as c ON c.idkoperasi = k.idkoperasi
LEFT JOIN shu as s ON s.idkoperasi = k.idkoperasi
LEFT JOIN tipe_koperasi as tk ON k.jenis = tk.idtipe_koperasi 
GROUP BY tk.jenis
ORDER BY tk.jenis ASC';

$xdata = array();
$xlegend = array();

$set_yearly = $dbs->query($sql_text);
while ($rec = $set_yearly->fetch_assoc()) {
 $xdata[] = array($rec['1'], $rec['3'], $rec['4'], $rec['5'], $rec['6'], $rec['8'], $rec['9']);
}

# Create a PHPlot object which will make an 800x400 pixel image:
$p = new PHPlot(900, 400);

# Use TrueType fonts:
//$p->SetDefaultTTFont('./arial.ttf');

# Set the main plot title:
$p->SetTitle('Data Koperasi Indonesia berdasarkan jenis koperasi');

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
$p->SetLegend(array('Simpanan', 'Pinjaman', 'Modal Dalam', 'Modal Luar', 'Asset', 'SHU'));
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
