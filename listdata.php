<?php
require SIMBIO_BASE_DIR.'simbio_GUI/table/simbio_table.inc.php';
require SIMBIO_BASE_DIR.'simbio_GUI/paging/simbio_paging.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/datagrid/simbio_dbgrid.inc.php';

function listNeraca($syariah = false,$sql_criteria = "") {
	global $dbs;
    $criteria = "";
    $koperasi = $_SESSION['koperasi'];
    $group = $_SESSION['group'];
    $jenis = $_SESSION['tipekoperasi'];
	$datagrid = new simbio_datagrid();
	$table_spec = 'coa as c LEFT JOIN koperasi as k ON c.idkoperasi = k.idkoperasi LEFT JOIN periode as p ON c.idperiode = p.idperiode';
    if ($syariah) {
	$datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-entrysyariah.php?nid=\',c.idcoa,\'">Edit</a>\') as \'&nbsp;\'',
		'CONCAT(\'<a href="datacenter-delete.php?nid=\',c.idcoa,\'" class="confirm">Hapus</a>\') as \'&nbsp;\'',
		'k.nama AS \'Koperasi\'', 'DATE(c.dateposting) AS \'Periode Laporan\'', 'IF(c.tahunan > 0, \'Tahunan\', \'Bulanan\') AS \'Jenis\'');
    } else {
	$datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-entrydata.php?nid=\',c.idcoa,\'">Edit</a>\') as \'&nbsp;\'',
		'CONCAT(\'<a href="datacenter-delete.php?nid=\',c.idcoa,\'" class="confirm">Hapus</a>\') as \'&nbsp;\'',
		'k.nama AS \'Koperasi\'', 'DATE(c.dateposting) AS \'Periode Laporan\'', 'IF(c.tahunan > 0, \'Tahunan\', \'Bulanan\') AS \'Jenis\'');
    }
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
	$datagrid->debug = true;
	if ($group == 1 or $group == 3) {
        $criteria = "";
	} else {
        $criteria = "c.idkoperasi =" . $koperasi;
    }

    if (isset($sql_criteria) AND $sql_criteria <> "") {
        if ($criteria <> "") {
            $criteria .= ' AND '. $sql_criteria;
        } else {
            $criteria = $sql_criteria;
        }
    }
    
    if ($criteria <> "") {
        $datagrid->setSQLcriteria($criteria);
    }
	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}

// neraca admin spv
function listNeracaAdmin($syariah = false,$sql_criteria = "") {
	global $dbs;
    $criteria = "";
    $counter = 0;

    $koperasi = $_SESSION['koperasi'];
    $group = $_SESSION['group'];
    $jenis = $_SESSION['tipekoperasi'];
    $sql_text = 'SELECT c.idcoa, k.nama, k.jenis, DATE(c.dateposting) AS periode, ';
    $sql_text .= 'IF(c.tahunan > 0, \'Tahunan\', \'Bulanan\')  AS laporan ';
    $sql_text .= 'FROM coa as c LEFT JOIN koperasi as k ON c.idkoperasi = k.idkoperasi';
    if (isset($sql_criteria) AND $sql_criteria <> "") {
        $sql_text .= ' WHERE ' . $sql_criteria;
    }

    $tmp_neraca = $dbs->query($sql_text);
    $tmp_result = '<table>';

   while ($tmp_rec = $tmp_neraca->fetch_assoc()) {
        $tmp_result .= '<tr>';
        $counter = $counter+1;
        $tmp_result .= '<td align="right">'. $counter . '.</td>';
        if ($tmp_rec['jenis'] == 3 or $tmp_rec['jenis'] == 5) {
            $tmp_result .='<td><a
href="datacenter-entrysyariah.php?nid='.$tmp_rec['idcoa'].'">Edit</a></td><td><a href="datacenter-delete.php?nid='.$tmp_rec['idcoa'].'"  class="confirm">Hapus</a></td>';
        } else {
            $tmp_result .='<td><a
href="datacenter-entrydata.php?nid='.$tmp_rec['idcoa'].'">Edit</a></td><td><a
href="datacenter-delete.php?nid='.$tmp_rec['idcoa'].'" class="confirm">Hapus</a></td>';
        }
        $tmp_result .=
'<td>'.$tmp_rec['nama'].'</td><td>'.$tmp_rec['periode'].'</td><td>'.$tmp_rec['laporan'].'</td></tr>';
    }
    $tmp_result .= '</table>';

        return $tmp_result;
}

function listNonNeraca() {
	global $dbs;
	$datagrid = new simbio_datagrid();
	$table_spec = 'non_coa as c LEFT JOIN koperasi as k ON c.idkoperasi = k.idkoperasi';
	$datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-entrydata-pendukung.php?nid=\',c.idnon_coa,\'">Edit</a>\') as \'&nbsp;\'',
		'CONCAT(\'<a href="datacenter-delete.php?oid=\',c.idnon_coa,\'" class="confirm">Hapus</a>\') as \'&nbsp;\'',
		'k.nama AS \'Koperasi\'', 'c.periode AS \'Periode Laporan\'');
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
		'CONCAT(\'<a href="datacenter-delete.php?fid=\',h.idday,\'" class="confirm">Hapus</a>\') as \'&nbsp;\'',
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

function listShu($syariah = false,$sql_criteria = "") {
	global $dbs;
	$datagrid = new simbio_datagrid();
    $critera = "";
    $koperasi = $_SESSION['koperasi'];
    $group = $_SESSION['group'];
    $jenis = $_SESSION['tipekoperasi'];
	$table_spec = 'shu as s LEFT JOIN koperasi as k ON s.idkoperasi = k.idkoperasi LEFT JOIN periode as p ON s.idperiode = p.idperiode';
    if ($syariah) {
	$datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-entrydata-phu-syariah.php?nid=\',s.idshu,\'">Edit</a>\') as \'&nbsp;\'',
		'CONCAT(\'<a href="datacenter-delete.php?pid=\',s.idshu,\'" class="confirm">Hapus</a>\') as \'&nbsp;\'',
		'k.nama AS \'Koperasi\'', 'DATE(s.dateposting) AS \'Periode Laporan\'', 'IF(s.tahunan > 0, \'Tahunan\', \'Bulanan\') AS \'Jenis\'');
    } else {
	$datagrid->setSQLColumn('CONCAT(\'<a href="datacenter-entrydata-phu.php?nid=\',s.idshu,\'">Edit</a>\') as \'&nbsp;\'',
		'CONCAT(\'<a href="datacenter-delete.php?pid=\',s.idshu,\'" class="confirm">Hapus</a>\') as \'&nbsp;\'',
		'k.nama AS \'Koperasi\'', 'DATE(s.dateposting) AS \'Periode Laporan\'', 'IF(s.tahunan > 0, \'Tahunan\', \'Bulanan\') AS \'Jenis\'');
    }
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
	if ($group == 1 or $group == 3) {
        $criteria = "";
	} else {
        $criteria = "s.idkoperasi =" . $koperasi;
    }

    if (isset($sql_criteria) AND $sql_criteria <> "") {
        if ($criteria <> "") {
            $criteria .= ' AND '. $sql_criteria;
        } else {
            $criteria = $sql_criteria;
        }
    }
    
    if ($criteria <> "") {
        $datagrid->setSQLcriteria($criteria);
    }
	$datagrid->debug = true;

	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}

//shu admin spv
function listShuAdmin($syariah = false, $sql_criteria = "") {
	global $dbs;
    $criteria = "";
    $counter = 0;

    $koperasi = $_SESSION['koperasi'];
    $group = $_SESSION['group'];
    $jenis = $_SESSION['tipekoperasi'];
    $sql_text = 'SELECT s.idshu, k.nama, k.jenis, DATE(s.dateposting) AS periode, ';
    $sql_text .= 'IF(s.tahunan > 0, \'Tahunan\', \'Bulanan\') AS laporan ';
    $sql_text .= 'FROM shu as s LEFT JOIN koperasi as k ON s.idkoperasi = k.idkoperasi';
    if (isset($sql_criteria) AND $sql_criteria <> "") {
        $sql_text .= ' WHERE ' . $sql_criteria;
    }
	  
    $tmp_neraca = $dbs->query($sql_text);
    $tmp_result = '<table>';

   while ($tmp_rec = $tmp_neraca->fetch_assoc()) {
        $tmp_result .= '<tr>';
        $counter = $counter+1;
        $tmp_result .= '<td align="right">'. $counter . '.</td>';
        if ($tmp_rec['jenis'] == 3 or $tmp_rec['jenis'] == 5) {
            $tmp_result .='<td><a
href="datacenter-entrydata-phu-syariah.php?nid='.$tmp_rec['idshu'].'">Edit</a></td><td><a href="datacenter-delete.php?pid='.$tmp_rec['idshu'].'" class="confirm">Hapus</a></td>';
        } else {
            $tmp_result .='<td><a
href="datacenter-entrydata-phu.php?nid='.$tmp_rec['idshu'].'">Edit</a></td><td><a
href="datacenter-delete.php?pid='.$tmp_rec['idshu'].'" class="confirm">Hapus</a></td>';
        }
        $tmp_result .=
'<td>'.$tmp_rec['nama'].'</td><td>'.$tmp_rec['periode'].'</td><td>'.$tmp_rec['laporan'].'</td></tr>';
    }
    $tmp_result .= '</table>';

        return $tmp_result;
}

function listKoperasi() {
	global $dbs;
	$datagrid = new simbio_datagrid();
	$table_spec = 'koperasi as k LEFT JOIN tipe_koperasi as t ON k.jenis = t.idtipe_koperasi';
	$datagrid->setSQLColumn('CONCAT(\'<a href="panel-tambahlembaga.php?nid=\',k.idkoperasi,\'">Edit</a>\') as \'&nbsp;\'',
		'k.nama AS \'Koperasi\'', 'k.propinsi AS \'Propinsi\'', 'k.sandilembaga AS \'Sandi Lembaga\'',
		't.jenis AS \'Tipe Koperasi\'',
        'IF(k.primkop = 1,\'Nasional\',IF(k.primkop = 2,\'Propinsi\',IF(k.primkop = 3,\'Kabupaten\',\'&nbsp\'))) AS \'Primer Koperasi\'');
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

function logsdata($filter) {
	global $dbs;
    $koperasi = $_SESSION['koperasi'];
    $group = $_SESSION['group'];
	$datagrid = new simbio_datagrid();
	$table_spec = 'logs as l LEFT JOIN user as u ON u.iduser=l.userID LEFT JOIN koperasi as k ON k.idkoperasi = u.koperasi_Idkoperasi';
	$datagrid->setSQLColumn('k.nama AS \'Koperasi\'', 'k.propinsi AS \'Propinsi\'', 'u.nama AS \'Nama User\'', 
		'l.parts AS \'Modul\'', 'l.notes AS \'Catatan\'', 'l.recorded AS \'Waktu\'', 'l.Ipid AS \'Alamat IP\'');
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
    if ($group == 2) {
        if ($filter <> "") {
            $datagrid->setSQLcriteria("u.koperasi_idkoperasi = ".$koperasi . " AND ". $filter);
        } else {
            $datagrid->setSQLcriteria("u.koperasi_idkoperasi = ".$koperasi);
        }
    } else {
        if ($filter <> "") {
            $datagrid->setSQLcriteria($filter);
        }
    }
	$datagrid->debug = true;

	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}

function statdatakoperasi() {
	global $dbs;
	$datagrid = new simbio_datagrid();
	$table_spec = 'koperasi as k ';
	$datagrid->setSQLColumn('if(k.primkop = 1, \'Nasional\', if(k.primkop = 2, \'Propinsi\', if(k.primkop = 3, \'Kabupaten\', \'Tidak Jelas\'))) AS \'Primer Koperasi\'', 'count(*) AS \'Jumlah\'');
    $datagrid->sql_group_by = 'k.primkop';
	$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
	$datagrid->debug = true;

	// put the result into variables
	$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 50, false);
	return $datagrid_result;

}

?>
