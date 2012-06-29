<?php
require SIMBIO_BASE_DIR.'simbio_GUI/table/simbio_table.inc.php';
require SIMBIO_BASE_DIR.'simbio_GUI/paging/simbio_paging.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/datagrid/simbio_dbgrid.inc.php';

function listNeraca($syariah = false) {
	global $dbs;
    $criteria = "";
    $koperasi = $_SESSION['koperasi'];
    $group = $_SESSION['group'];
    $jenis = $_SESSION['tipekoperasi'];
	$datagrid = new simbio_datagrid();
	$table_spec = 'coa as c LEFT JOIN koperasi as k ON c.idkoperasi = k.idkoperasi LEFT JOIN periode as p ON c.idperiode = p.idperiode';
    if ($syariah) {
	$datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-entrysyariah.php?nid=\',c.idcoa,\'">Edit</a>\') as \'&nbsp;\'',
		'CONCAT(\'<a href="datacenter-delete.php?nid=\',c.idcoa,\'">Hapus</a>\') as \'&nbsp;\'',
		'k.nama AS \'Koperasi\'', 'DATE(c.dateposting) AS \'Periode Laporan\'');
    } else {
	$datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-entrydata.php?nid=\',c.idcoa,\'">Edit</a>\') as \'&nbsp;\'',
		'CONCAT(\'<a href="datacenter-delete.php?nid=\',c.idcoa,\'">Hapus</a>\') as \'&nbsp;\'',
		'k.nama AS \'Koperasi\'', 'DATE(c.dateposting) AS \'Periode Laporan\'');
    }
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
	$datagrid->debug = true;
	if ($group == 1 or $group == 3) {
        $criteria = "";
	} else {
        $criteria = "c.idkoperasi =" . $koperasi;
    }

    if ($criteria <> "") {
        $datagrid->setSQLcriteria($criteria);
    }
	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}

function listNonNeraca() {
	global $dbs;
	$datagrid = new simbio_datagrid();
	$table_spec = 'non_coa as c LEFT JOIN koperasi as k ON c.idkoperasi = k.idkoperasi LEFT JOIN periode as p ON c.idperiode = p.idperiode';
	$datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-entrydata-pendukung.php?nid=\',c.idnon_coa,\'">Edit</a>\') as \'&nbsp;\'',
		'CONCAT(\'<a href="datacenter-delete.php?oid=\',c.idnon_coa,\'">Hapus</a>\') as \'&nbsp;\'',
		'k.nama AS \'Koperasi\'', 'p.periode AS \'Periode Laporan\'');
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
	$datagrid->debug = true;

	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}

function listFinasial() {
    global $dbs;
    $koperasi = $_SESSION['koperasi'];
    $group = $_SESSION['group'];
	$datagrid = new simbio_datagrid();
	$table_spec = 'harian as h LEFT JOIN koperasi as k ON h.idkoperasi = k.idkoperasi LEFT JOIN tipe_koperasi as t ON k.jenis = t.idtipe_koperasi';
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
    $datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-entrydata-finansial.php?nid=\',h.idday,\'">Edit</a>\') as \'&nbsp;\'',
		'CONCAT(\'<a href="datacenter-delete.php?fid=\',h.idday,\'">Hapus</a>\') as \'&nbsp;\'',
        'k.nama AS \'Koperasi\'', 'k.sandilembaga AS \'Sandi Lembaga\'',
        't.jenis AS \'Tipe Koperasi\'', 'h.periode AS \'Periode Lap\'');
    if ($group ==2 ) {
        $datagrid->setSQLcriteria("h.idkoperasi = ".$koperasi);
    }
	$datagrid->debug = true;

	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}

function listShu($syariah = false) {
	global $dbs;
	$datagrid = new simbio_datagrid();
    $critera = "";
    $koperasi = $_SESSION['koperasi'];
    $group = $_SESSION['group'];
    $jenis = $_SESSION['tipekoperasi'];
	$table_spec = 'shu as s LEFT JOIN koperasi as k ON s.idkoperasi = k.idkoperasi LEFT JOIN periode as p ON s.idperiode = p.idperiode';
    if ($syariah) {
	$datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-entrydata-phu-syariah.php?nid=\',s.idshu,\'">Edit</a>\') as \'&nbsp;\'',
		'CONCAT(\'<a href="datacenter-delete.php?pid=\',s.idshu,\'">Hapus</a>\') as \'&nbsp;\'',
		'k.nama AS \'Koperasi\'', 'DATE(s.dateposting) AS \'Periode Laporan\'');
    } else {
	$datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-entrydata-phu.php?nid=\',s.idshu,\'">Edit</a>\') as \'&nbsp;\'',
		'CONCAT(\'<a href="datacenter-delete.php?pid=\',s.idshu,\'">Hapus</a>\') as \'&nbsp;\'',
		'k.nama AS \'Koperasi\'', 'DATE(s.dateposting) AS \'Periode Laporan\'');
    }
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
	if ($group == 1 or $group == 3) {
        $criteria = "";
	} else {
        $criteria = "s.idkoperasi =" . $koperasi;
    }

    if ($criteria <> "") {
        $datagrid->setSQLcriteria($criteria);
    }
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
		'k.nama AS \'Koperasi\'', 'k.sandilembaga AS \'Sandi Lembaga\'',
		't.jenis AS \'Tipe Koperasi\'');
// 'CONCAT(\'<a href="panel-tambahlembaga.php">Hapus</a>\') as \'&nbsp;\'',        
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
	$datagrid->debug = true;

	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}

function listHarian($idlap) {
	global $dbs;
    $koperasi = $_SESSION['koperasi'];
    $group = $_SESSION['group'];
	$datagrid = new simbio_datagrid();
	$table_spec = 'harian as h LEFT JOIN koperasi as k ON h.idkoperasi = k.idkoperasi LEFT JOIN tipe_koperasi as t ON k.jenis = t.idtipe_koperasi';
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
    if ($idlap <> 0) {
        $datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-harian.php?nid=\',h.idday,\'">Edit</a>\') as \'&nbsp;\'',
            'k.nama AS \'Koperasi\'', 'k.sandilembaga AS \'Sandi Lembaga\'',
            't.jenis AS \'Tipe Koperasi\'', 'h.periode AS \'Periode Lap\'');
        $datagrid->setSQLcriteria('h.idkoperasi =' . $idlap);
    } else {
        $datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-harian.php?kid=\',k.idkoperasi,\'&list">Tampilkan</a>\') as \'&nbsp;\'',
            'k.nama AS \'Koperasi\'', 'k.sandilembaga AS \'Sandi Lembaga\'',
            't.jenis AS \'Tipe Koperasi\'', 'count(h.idday) AS \'Jumlah Laporan\'');
        $datagrid->sql_group_by = "h.idkoperasi";
    }
    if ($group ==2 ) {
    $datagrid->setSQLcriteria("h.idkoperasi = ".$koperasi);
    }
	$datagrid->debug = true;

	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}

function listUser() {
	global $dbs;
    $koperasi = $_SESSION['koperasi'];
    $group = $_SESSION['group'];
	$datagrid = new simbio_datagrid();
	$table_spec = 'user as u LEFT JOIN koperasi as k ON u.koperasi_idkoperasi = k.idkoperasi
	  LEFT JOIN tipe_koperasi as t ON k.jenis = t.idtipe_koperasi
	  LEFT JOIN `group` as g ON g.idgroup = u.group_idgroup';
	$datagrid->setSQLColumn('CONCAT(\'<a href="panel-daftaruser.php?nid=\',u.iduser,\'">Edit</a>\') as \'&nbsp;\'',
		'u.nama AS \'Nama\'', 'k.nama AS \'Koperasi\'',
		't.jenis AS \'Tipe Koperasi\'', 'g.group AS \'Kelompok user\'');
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
    if ($group == 2) {
    $datagrid->setSQLcriteria("u.koperasi_idkoperasi = ".$koperasi);
    }
	$datagrid->debug = true;

	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}

function userKoperasi($kid) {
	global $dbs;
    if (!$kid) {
        return "";
    } else {
        $datagrid = new simbio_datagrid();
        $table_spec = 'user as u LEFT JOIN koperasi as k ON u.koperasi_idkoperasi = k.idkoperasi
          LEFT JOIN tipe_koperasi as t ON k.jenis = t.idtipe_koperasi
          LEFT JOIN `group` as g ON g.idgroup = u.group_idgroup';
        $datagrid->setSQLColumn('CONCAT(\'<a href="panel-daftaruser.php?nid=\',u.iduser,\'">Edit</a>\') as \'&nbsp;\'',
            'u.nama AS \'Nama\'', 'k.nama AS \'Koperasi\'',
            't.jenis AS \'Tipe Koperasi\'', 'g.group AS \'Kelompok user\'');
        $datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
        $datagrid->setSQLcriteria("u.koperasi_idkoperasi = ".$kid);
        $datagrid->debug = true;

        // put the result into variables
        $datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
        return $datagrid_result;
    }
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
