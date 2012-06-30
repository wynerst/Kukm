<?php
// create datagrid
$agr_tahun = new simbio_datagrid();

// table spec
$table_agr = 'periode as p
LEFT JOIN `non_coa` as n ON n.idperiode = p.idperiode 
LEFT JOIN coa as c ON c.idperiode = p.idperiode
LEFT JOIN shu as s ON s.idperiode = p.idperiode';

$agr_tahun->setSQLColumn('p.periode as \'Periode\'',
	'YEAR(p.finaldate) as \'Tahun\'',
	'format((sum(c.c2110)+sum(c.c2210)+sum(c.c3110)+sum(c.c3120))/1000,2) AS \'Simpanan&nbsp;*)\'',
	'format(sum(c.c1140)/1000,2) AS \'Pinjaman&nbsp;*)\'',
	'format((sum(c.c3110)+sum(c.c3120))/1000,2) AS \'Modal Dalam&nbsp;*)\'',
	'format((sum(c.c3130)+sum(c.c3140))/1000,2) AS \'Modal Luar&nbsp;*)\'',
	'format(n.vol_usaha/1000,2) AS \'Volume Usaha&nbsp;*)\'',
	'format((sum(c.c11)+sum(c.c12)+sum(c.c13)+sum(c.c14))/1000,2) AS \'Asset&nbsp;*)\'',
	'format((sum(c.c3170)+sum(c.c3180))/1000,2) AS \'SHU&nbsp;*)\'',
	'format(n.sb_simpanan,2) AS \'Suku Bunga Simpanan (%)\'',
	'format(n.sb_pinjaman,2) AS \'Suku Bunga Pinjaman (%)\'',
	'format((n.piutangmacet/n.akumulasi_pinjaman)*100,2) AS \'NPL (%)\'');

$agr_tahun->setSQLorder('p.finaldate DESC');
$agr_tahun->sql_group_by = 'YEAR(p.finaldate)';

// set table and table header attributes
$agr_tahun->table_attr = 'align="center" id="dataList" cellpadding="5" cellspacing="0"';
$agr_tahun->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
$agr_tahun->debug = true;
$agr_tahun->invisible_fields = array(0);

// put the result into variables
$agr_tahun_result = $agr_tahun->createDataGrid($dbs, $table_agr, 10, false);

$frontpage_content = '<h3>Rekap data koperasi pertahun&nbsp;<a href="keterangan.php" target="blank" title="Penjelasan tabel"><img src="images/info.png" /></a></h3><p>';
$frontpage_content .= $agr_tahun_result . "*) dalam jutaan\n</p>";
