<?php
// create datagrid
$agr_tahun = new simbio_datagrid();

/** SELECT YEAR( h.periode ) AS 'Tahun', count(*) as 'Jml.Kop.', h.periode, sum(h.h1) AS '1', sum(h.h2) AS '2',sum(h.h3) AS '3', sum(h.h4) AS '4', sum(h.h5) AS '5', sum(h.h6) AS '6', sum(h.h7) AS '7', avg(h.h8) AS '8', avg(h.h9) AS '9', avg(h.h10) AS '10'
FROM harian AS h 
LEFT JOIN koperasi AS k ON h.idkoperasi = k.idkoperasi
WHERE YEAR( h.periode ) < YEAR(curdate())
GROUP BY YEAR(h.periode)
**/
 
// table spec
$table_agr = 'harian AS h 
LEFT JOIN koperasi AS k ON h.idkoperasi = k.idkoperasi';

$agr_tahun->setSQLColumn('h.periode as \'Periode\'',
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

$agr_tahun->setSQLcriteria('YEAR(h.periode) < YEAR(curdate())');
$agr_tahun->setSQLorder('h.periode DESC');
$agr_tahun->sql_group_by = 'YEAR(h.periode)';

// set table and table header attributes
$agr_tahun->table_attr = 'align="center" id="dataList" cellpadding="5" cellspacing="0"';
$agr_tahun->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
$agr_tahun->debug = true;
$agr_tahun->invisible_fields = array(0);

// put the result into variables
$agr_tahun_result = $agr_tahun->createDataGrid($dbs, $table_agr, 5, false);

$frontpage_content = '<h3>Rekap data koperasi pertahun&nbsp;<a href="keterangan.php" target="blank" title="Penjelasan tabel"><img src="images/info.png" /></a></h3><p>';
$frontpage_content .= $agr_tahun_result . "*) dalam jutaan\n</p>";
