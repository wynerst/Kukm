<?php
require SIMBIO_BASE_DIR.'simbio_GUI/table/simbio_table.inc.php';
require SIMBIO_BASE_DIR.'simbio_GUI/paging/simbio_paging.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/datagrid/simbio_dbgrid.inc.php';

function listNeraca($tipe = "all") {
	global $dbs;
	$datagrid = new simbio_datagrid();
	$table_spec = 'coa as c LEFT JOIN koperasi as k ON c.idkoperasi = k.idkoperasi LEFT JOIN periode as p ON c.idperiode = p.idperiode';
	$datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-entrydata.php?nid=\',c.idcoa,\'">Edit</a>\') as \'&nbsp;\'',
		'k.nama AS \'Koperasi\'', 'p.periode AS \'Periode Laporan\'');
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
	$datagrid->debug = true;
	if ($tipe == "all") {
	} else {
	$datagrid->setSQLcriteria("k.jenis = 3 OR k.jenis = 5");
	}

	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}

function listNonNeraca() {
	global $dbs;
	$datagrid = new simbio_datagrid();
	$table_spec = 'non_coa as c LEFT JOIN koperasi as k ON c.idkoperasi = k.idkoperasi LEFT JOIN periode as p ON c.idperiode = p.idperiode';
	$datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-entrydata-nonfinansial.php?nid=\',c.idnon_coa,\'">Edit</a>\') as \'&nbsp;\'',
		'k.nama AS \'Koperasi\'', 'p.periode AS \'Periode Laporan\'');
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
	$datagrid->debug = true;

	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}

function listShu() {
	global $dbs;
	$datagrid = new simbio_datagrid();
	$table_spec = 'shu as s LEFT JOIN koperasi as k ON s.idkoperasi = k.idkoperasi LEFT JOIN periode as p ON s.idperiode = p.idperiode';
	$datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-entrydata-phu.php?nid=\',s.idshu,\'">Edit</a>\') as \'&nbsp;\'',
		'k.nama AS \'Koperasi\'', 'p.periode AS \'Periode Laporan\'');
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
	$datagrid->debug = true;

	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}

function listKoperasi() {
	global $dbs;
	$datagrid = new simbio_datagrid();
	$table_spec = 'koperasi as k LEFT JOIN tipe_koperasi as t ON k.jenis = t.idtipe_koperasi';
	$datagrid->setSQLColumn('CONCAT(\'<a href="panel-tambahlembaga.php?nid=\',k.idkoperasi,\'">Edit</a>\') as \'&nbsp;\'',
		'CONCAT(\'<a href="panel-tambahlembaga.php">Hapus</a>\') as \'&nbsp;\'',
		'k.nama AS \'Koperasi\'', 'k.sandilembaga AS \'Sandi Lembaga\'',
		't.jenis AS \'Tipe Koperasi\'');
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
	$datagrid->debug = true;

	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}

function listHarian() {
	global $dbs;
	$datagrid = new simbio_datagrid();
	$table_spec = 'koperasi as k LEFT JOIN tipe_koperasi as t ON k.jenis = t.idtipe_koperasi';
	$datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-harian.php?nid=\',k.idkoperasi,\'">Edit</a>\') as \'&nbsp;\'',
		'CONCAT(\'<a href="datacenter_harian.php">Hapus</a>\') as \'&nbsp;\'',
		'k.nama AS \'Koperasi\'', 'k.sandilembaga AS \'Sandi Lembaga\'',
		't.jenis AS \'Tipe Koperasi\'');
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
	$datagrid->debug = true;

	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}

function listUser() {
	global $dbs;
	$datagrid = new simbio_datagrid();
	$table_spec = 'user as u LEFT JOIN koperasi as k ON u.koperasi_idkoperasi = k.idkoperasi
	  LEFT JOIN tipe_koperasi as t ON k.jenis = t.idtipe_koperasi
	  LEFT JOIN `group` as g ON g.idgroup = u.group_idgroup';
	$datagrid->setSQLColumn('CONCAT(\'<a href="panel-tambahuser.php?nid=\',u.iduser,\'">Edit</a>\') as \'&nbsp;\'',
		'CONCAT(\'<a href="panel-tambahuser.php">Hapus</a>\') as \'&nbsp;\'',
		'u.nama AS \'Nama\'', 'k.nama AS \'Koperasi\'',
		't.jenis AS \'Tipe Koperasi\'', 'g.group AS \'Kelompok user\'');
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
	$datagrid->debug = true;

	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}

function listGroup() {
	global $dbs;
	$datagrid = new simbio_datagrid();
	$table_spec = '`group` as g';
	$datagrid->setSQLColumn('CONCAT(\'<a href="panel-tambahgroup.php?nid=\',g.idgroup,\'">Edit</a>\') as \'&nbsp;\'',
		'CONCAT(\'<a href="panel-tambahgroup.php">Hapus</a>\') as \'&nbsp;\'',
		'g.group AS \'Group\'');
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
	$datagrid->debug = true;

	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}
?>
