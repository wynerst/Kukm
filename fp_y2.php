<?php
// create datagrid
$datagrid = new simbio_datagrid();

// table spec
$table_spec = 'harian AS h 
LEFT JOIN koperasi AS k ON h.idkoperasi = k.idkoperasi
LEFT JOIN tipe_koperasi as tk ON k.jenis = tk.idtipe_koperasi';

$datagrid->setSQLColumn('k.idkoperasi, h.periode as \'Periode\'',
	'tk.jenis as \'Tipe Koperasi\'',
	'YEAR(h.periode) as \'Tahun\'',
    'format(sum(h.h1)/1000000,2) AS \'Simpanan&nbsp;*)\'',
	'format(sum(h.h2)/1000000,2) AS \'Pinjaman&nbsp;*)\'',
	'format(sum(h.h3)/1000000,2) AS \'Modal Dalam&nbsp;*)\'',
	'format(sum(h.h4)/1000000,2) AS \'Modal Luar&nbsp;*)\'',
	'format(sum(h.h5)/1000000,2) AS \'Volume Usaha&nbsp;*)\'',
	'format(sum(h.h6)/1000000,2) AS \'Asset&nbsp;*)\'',
	'format(sum(h.h7)/1000000,2) AS \'SHU&nbsp;*)\'',
	'format(avg(h.h8),2) AS \'Suku Bunga Simpanan (%)\'',
	'format(avg(h.h9),2) AS \'Suku Bunga Pinjaman (%)\'',
	'format(avg(h.h10),2) AS \'NPL (%)\'');

$datagrid->setSQLorder('tk.jenis ASC, YEAR(h.periode)');
$datagrid->setSQLcriteria('YEAR(h.periode) < YEAR(curdate()) AND YEAR(h.periode) > YEAR(curdate())-6');
$datagrid->sql_group_by = 'tk.jenis ASC, YEAR(h.periode)';

// set table and table header attributes
$datagrid->table_attr = 'align="center" id="dataList" cellpadding="5" cellspacing="0"';
$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
$datagrid->debug = true;
$datagrid->invisible_fields = array(0,1);

// put the result into variables
$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 10, false);

$frontpage_content = '<h3>Laporan Tahunan Berdasar Jenis Koperasi&nbsp;<a href="keterangan.php" target="blank" title="Penjelasan tabel"><img src="images/info.png" /></a></h3><p>';
$frontpage_content .= $datagrid_result . "*) dalam jutaan\n</p>";
