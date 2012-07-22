<?php
// create datagrid
$datagrid = new simbio_datagrid_alt();
if (isset($modul) and $modul > 0) {
   $datagrid->setSQLcriteria('k.idkoperasi=' . $modul);
}

// table spec
$table_spec = '`koperasi` as k
RIGHT JOIN harian as h ON h.idkoperasi = k.idkoperasi
LEFT JOIN `tipe_koperasi` as tk ON k.jenis = tk.idtipe_koperasi';
/** LEFT JOIN coa as c ON c.idkoperasi = k.idkoperasi
LEFT JOIN shu as s ON s.idkoperasi = k.idkoperasi 
LEFT JOIN `non_coa` as n ON n.idkoperasi = k.idkoperasi 
**/

$datagrid->setSQLColumn(
	'k.nama AS \'Koperasi\'',
    'h.periode AS \'Periode\'', 'format((h.h1),2) AS \'Simpanan&nbsp;*)\'',
	'format((h.h2),2) AS \'Pinjaman&nbsp;*)\'',
	'format((h.h3),2) AS \'Modal Dalam&nbsp;*)\'',
	'format((h.h4),2) AS \'Modal Luar&nbsp;*)\'',
	'format((h.h5),2) AS \'Volume Usaha&nbsp;*)\'',
	'format((h.h6),2) AS \'Asset&nbsp;*)\'',
	'format((h.h7),2) AS \'SHU&nbsp;*)\'',
	'format((h.h8),2) AS \'Suku Bunga Simpanan (%)\'',
	'format((h.h9),2) AS \'Suku Bunga Pinjaman (%)\'',
	'format((h.h10),2) AS \'NPL (%)\'');

$datagrid->setSQLorder('h.periode DESC, k.nama ASC');
//$datagrid->sql_group_by = 'h.idkoperasi';

// set table and table header attributes
$datagrid->table_attr = 'align="center" id="dataList" cellpadding="5" cellspacing="0"';
$datagrid->table_header_attr = 'style="font-family: calibri; font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
$datagrid->debug = true;
//$datagrid->invisible_fields = array(0);

// put the result into variables
$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 10, false, true);

$head_titile = '<h3>Laporan Bulanan Usaha Simpan Pinjam Koperasi&nbsp;<a href="keterangan.php" target="blank" title="Penjelasan tabel"><img src="images/info.png" /></a></h3>';
$frontpage_content = $head_titile . '<p>' . $filter ;
if ($_SESSION['group'] == 1) {
    $frontpage_content .= $datagrid_result . "\n</p>";
} else {
    $frontpage_content .= "Anda tidak berhak untuk melihat data yang diminta.\n</p>";
}
