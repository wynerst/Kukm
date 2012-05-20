<?php
// create datagrid
$datagrid = new simbio_datagrid();

// table spec
$table_spec = '`koperasi` as k
LEFT JOIN `non_coa` as n ON n.idkoperasi = k.idkoperasi 
LEFT JOIN coa as c ON c.idkoperasi = k.idkoperasi
LEFT JOIN shu as s ON s.idkoperasi = k.idkoperasi 
LEFT JOIN periode as p ON n.idperiode = p.idperiode 
LEFT JOIN periode as p2 ON c.idperiode = p2.idperiode
LEFT JOIN periode as p3 ON s.idperiode = p3.idperiode 
LEFT JOIN `tipe_koperasi` as tk ON k.jenis = tk.idtipe_koperasi';

$setSQLColumn = 'k.idkoperasi, p.periode as \'Periode\','.
	'k.nama as \'Koperasi\','.
	'format((c.c2110+c.c2210+c.c3110+c.c3120)/1000,2) AS \'Simpanan&nbsp;*)\','.
	'format(c.c1140/1000,2) AS \'Pinjaman&nbsp;*)\','.
	'format((c.c3110+c.c3120)/1000,2) AS \'Modal Dalam&nbsp;*)\','.
	'format((c.c3130+c.c3140)/1000,2) AS \'Modal Luar&nbsp;*)\','.
	'format(n.vol_usaha/1000,2) AS \'Volume Usaha&nbsp;*)\','.
	'format((c.c11+c.c12+c.c13+c.c14)/1000,2) AS \'Asset&nbsp;*)\','.
	'format((c.c3170+c.c3180)/1000,2) AS \'SHU&nbsp;*)\','.
	'format(n.sb_simpanan,2) AS \'Suku Bunga Simpanan (%)\','.
	'format(n.sb_pinjaman,2) AS \'Suku Bunga Pinjaman (%)\','.
	'format((n.piutangmacet/n.akumulasi_pinjaman)*100,2) AS \'NPL (%)\'';

$setSQLorder = 'k.nama ASC, p.periode DESC';
$setSQLcriteria = 'YEAR(p.finaldate) = 2010 or YEAR(p2.finaldate) = 2010 or YEAR(p3.finaldate) = 2010';
$sql_group_by = 'c.idkoperasi';

$rsTab = $dbs->query('SELECT '.$setSQLColumn.' FROM '.$table_spec.' WHERE '.$setSQLcriteria.' Group By '.$sql_group_by.' Order By '. $setSQLorder);

$datagrid_result = '<p><TABLE BORDER="1">';

While ($record = $rsTab->fetch_array()) {
    $datagrid_result .= '<TR>';
    $datagrid_result .= '<TD>'.$record[0].'</TD><TD>'.$record[1].'</TD><TD>'.$record[2].'</TD><TD>'.$record[3].'</TD><TD>'.$record[4].'</TD><TD>'.$record[5].'</TD><TD>'.$record[6].'</TD><TD>'.$record[7].'</TD><TD>'.$record[8].'</TD><TD>'.$record[9].'</TD><TD>'.$record[10].'</TD><TD>'.$record[11].'</TD></TR>';
}

$datagrid_result .= '</TABLE>';

$frontpage_content = '<h3>Laporan Harian Usaha Simpan Pinjam Koperasi&nbsp;<a href="keterangan.php" target="blank" title="Penjelasan tabel"><img src="images/info.png" /></a></h3><p>';
$frontpage_content .= $datagrid_result . "<br />*) dalam ribuan\n</p>";
