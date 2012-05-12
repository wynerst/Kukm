<?php
require 'phplot/phplot.php';
$plot = new PHPlot();
$data = array(array('', 0, 0), array('Data', 1, 9), array('Barang', 1, 6.5));
$plot->SetDataValues($data);
$plot->SetDataType('data-data');
$plot->DrawGraph();