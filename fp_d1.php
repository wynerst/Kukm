<?php
// create datagrid
$datagrid = new simbio_datagrid_alt();

// table spec
$table_spec = '`koperasi` as k
LEFT JOIN coa as c ON c.idkoperasi = k.idkoperasi
LEFT JOIN shu as s ON s.idkoperasi = k.idkoperasi 
LEFT JOIN harian as h ON h.idkoperasi = k.idkoperasi
LEFT JOIN `non_coa` as n ON n.idkoperasi = k.idkoperasi 
LEFT JOIN `tipe_koperasi` as tk ON k.jenis = tk.idtipe_koperasi';

/**
$datagrid->setSQLColumn(
    'TIMESTAMPDIFF(MONTH,c.dateposting,curdate()), k.idkoperasi, c.dateposting as \'Periode\'',
	'k.nama as \'Koperasi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\'',
	'format((c.c2110+c.c2210+c.c3110+c.c3120),2) AS \'Simpanan&nbsp;*)\'',
	'format(c.c1140,2) AS \'Pinjaman&nbsp;*)\'',
	'format((c.c3110+c.c3120),2) AS \'Modal Dalam&nbsp;*)\'',
	'format((c.c3130+c.c3140),2) AS \'Modal Luar&nbsp;*)\'',
	'format(n.vol_usaha,2) AS \'Volume Usaha&nbsp;*)\'',
	'format((c.c11+c.c12+c.c13+c.c14),2) AS \'Asset&nbsp;*)\'',
	'format((c.c3170+c.c3180),2) AS \'SHU&nbsp;*)\'',
	'format(n.sb_simpanan,2) AS \'Suku Bunga Simpanan (%)\'',
	'format(n.sb_pinjaman,2) AS \'Suku Bunga Pinjaman (%)\'',
	'format((n.piutangmacet/n.akumulasi_pinjaman),2) AS \'NPL (%)\'');
$datagrid->sql_group_by = 'c.idkoperasi, YEAR(c.dateposting)';

$datagrid->setSQLColumn(
    'MIN(TIMESTAMPDIFF(MONTH,c.dateposting,curdate())), k.idkoperasi, c.dateposting as \'Periode\'',
	'k.nama as \'Koperasi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\'',
	'format((c.c2110+c.c2210+c.c3110+c.c3120),2) AS \'Simpanan&nbsp;*)\'',
	'format(c.c1140,2) AS \'Pinjaman&nbsp;*)\'',
	'format((c.c3110+c.c3120),2) AS \'Modal Dalam&nbsp;*)\'',
	'format((c.c3130+c.c3140),2) AS \'Modal Luar&nbsp;*)\'',
	'format(n.vol_usaha,2) AS \'Volume Usaha&nbsp;*)\'',
	'format((c.c11+c.c12+c.c13+c.c14),2) AS \'Asset&nbsp;*)\'',
	'format((c.c3170+c.c3180),2) AS \'SHU&nbsp;*)\'',
	'format(n.sb_simpanan,2) AS \'Suku Bunga Simpanan (%)\'',
	'format(n.sb_pinjaman,2) AS \'Suku Bunga Pinjaman (%)\'',
	'format((n.piutangmacet/n.akumulasi_pinjaman),2) AS \'NPL (%)\'');
**/

$datagrid->setSQLColumn(
    'MIN(TIMESTAMPDIFF(MONTH,c.dateposting,curdate())), k.idkoperasi, c.dateposting as \'Periode\'',
	'k.nama as \'Koperasi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\'',
	'format((h.h1),2) AS \'Simpanan&nbsp;*)\'',
	'format((h.h2),2) AS \'Pinjaman&nbsp;*)\'',
	'format((h.h3),2) AS \'Modal Dalam&nbsp;*)\'',
	'format((h.h4),2) AS \'Modal Luar&nbsp;*)\'',
	'format((h.h5),2) AS \'Volume Usaha&nbsp;*)\'',
	'format((h.h6),2) AS \'Asset&nbsp;*)\'',
	'format((h.h7),2) AS \'SHU&nbsp;*)\'',
	'format((h.h8),2) AS \'Suku Bunga Simpanan (%)\'',
	'format((h.h9),2) AS \'Suku Bunga Pinjaman (%)\'',
	'format((h.h10),2) AS \'NPL (%)\'');

$datagrid->setSQLorder('MIN(TIMESTAMPDIFF(MONTH,c.dateposting,curdate())) ASC, c.dateposting DESC, c.createdate DESC, k.nama ASC');
//$datagrid->setSQLcriteria('YEAR(p.finaldate) = 2010 or YEAR(p2.finaldate) = 2010 or YEAR(p3.finaldate) = 2010');
$datagrid->sql_group_by = 'c.idkoperasi';

// set table and table header attributes
$datagrid->table_attr = 'align="center" id="dataList" cellpadding="5" cellspacing="0"';
$datagrid->table_header_attr = 'style="font-family: calibri; font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
$datagrid->debug = true;
$datagrid->invisible_fields = array(0,1,2);

// put the result into variables
$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 10, false, true);

$frontpage_content = '<h3>Laporan Bulanan Usaha Simpan Pinjam Koperasi&nbsp;<a href="keterangan.php" target="blank" title="Penjelasan tabel"><img src="images/info.png" /></a></h3><p>';
if ($_SESSION['group'] == 1) {
    $frontpage_content .= $datagrid_result . "\n</p>";
} else {
    $frontpage_content .= "Anda tidak berhak untuk melihat data yang diminta.\n</p>";
}
