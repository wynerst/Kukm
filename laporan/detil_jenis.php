<?php
// create datagrid
$datagrid = new simbio_datagrid_alt();
if (isset($modul) and $modul > 0) {
   $datagrid->setSQLcriteria('k.jenis=' . $modul);
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
	'tk.jenis AS \'Tipe Koperasi\'',
    'h.periode AS \'Periode\'', 'format((h.h1),2) AS \'Simpanan&nbsp;*)\'',
	'format((sum(h.h2)),2) AS \'Pinjaman&nbsp;*)\'',
	'format(sum((h.h3)),2) AS \'Modal Dalam&nbsp;*)\'',
	'format(sum((h.h4)),2) AS \'Modal Luar&nbsp;*)\'',
	'format(sum((h.h5)),2) AS \'Volume Usaha&nbsp;*)\'',
	'format(sum((h.h6)),2) AS \'Asset&nbsp;*)\'',
	'format(sum((h.h7)),2) AS \'SHU&nbsp;*)\'',
	'format(avg((h.h8)),2) AS \'Suku Bunga Simpanan (%)\'',
	'format(avg((h.h9)),2) AS \'Suku Bunga Pinjaman (%)\'',
	'format(avg((h.h10)),2) AS \'NPL (%)\'');

$datagrid->setSQLorder('h.periode DESC');
$datagrid->sql_group_by = 'k.jenis, h.periode';

// set table and table header attributes
$datagrid->table_attr = 'align="center" id="dataList" cellpadding="5" cellspacing="0"';
$datagrid->table_header_attr = 'style="font-family: calibri; font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
$datagrid->debug = true;
$datagrid->invisible_fields = array(0);

// put the result into variables
$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 10, false, true);

$head_titile = '<h3>Laporan Bulanan Usaha Simpan Pinjam Koperasi &nbsp;<a href="keterangan.php" target="blank" title="Penjelasan tabel"><img src="images/info.png" /></a></h3>';
$frontpage_content = $head_titile . '<p>' . $filter ;
if ($_SESSION['group'] == 1) {
    $frontpage_content .= $datagrid_result . "\n</p>";
} else {
    $frontpage_content .= "Anda tidak berhak untuk melihat data yang diminta.\n</p>";
}
