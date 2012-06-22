<?php
// required file
require '../sysconfig.inc.php';
include "../nav_panel.php";
if (isset($_POST['searchCoa'])) {
	$kopnama = $_POST['koperasi'];
	$search_limit = ' c.tahunan = 1';
	if ($kopnama <>"") {
        $search_limit .= ' AND k.idkoperasi ='. $kopnama;
    }
    
    // get record
    $sql_text = "SELECT c.*, k.nama FROM coa as c ";
    $sql_text .= " LEFT JOIN koperasi as k ON c.idkoperasi = k.idkoperasi ";
    if (isset($search_limit)) {
        $sql_text .= "WHERE ". $search_limit;
    }
    $q_neraca = $dbs->query($sql_text);
    if ($recNeraca = $q_neraca->fetch_assoc()) {
    };
}

$table = "";
$row = 0;
// get koperasi name
$sql1 = "SELECT DISTINCT idkoperasi, nama FROM koperasi WHERE idkoperasi <>". $sysconf['idKukm'];
if (isset($kopnama) and $kopnama <> "") {
    $sql1 .=' AND idkoperasi ='. $kopnama;
}
$sql2 = "SELECT YEAR(dateposting) as tahun, count(idcoa) as jumlah FROM coa";

if (isset($_GET['nid']) AND int($_GET['nid']) == 0) {
    $rs_koperasi = $dbs->query($sql1. " WHERE idkoperasi = ".$_GET['nid']);
} else {
    $rs_koperasi = $dbs->query($sql1);
}

while ($rec_koperasi = $rs_koperasi->fetch_assoc()) {
    for ($i=$tahun-4; $i<=$tahun; $i++) {
        $lap_month[$i] = 0;
    }
    $lap_month = array(1=>0,2=>0,3=>0,4=>0,5=>0);
    $sqllaporan = $sql2. " WHERE idkoperasi=".$rec_koperasi['idkoperasi'] .' AND tahunan = 1';
    if (isset($kopnama)) {
        $sqllaporan .= " GROUP BY YEAR(dateposting) ORDER BY YEAR(dateposting)";
    } else {
        $sqllaporan .= " AND (YEAR(dateposting)>YEAR(now())-5 OR YEAR(dateposting)<=YEAR(now())) GROUP BY YEAR(dateposting) ORDER BY YEAR(dateposting)";
    }
//    die($sqllaporan);
    $rs_Laporan = $dbs->query($sqllaporan);
    $table .="<TR>\n";
    $tahun = date('Y');
    if ($rs_Laporan) {
        while ($rec_lap = $rs_Laporan->fetch_assoc()) {
            for ($i=$tahun-4; $i<=$tahun; $i++) {
                if ($rec_lap['tahun'] == $i) {
                    $lap_month[$i] = $rec_lap['jumlah'];
                }
            }

        }
        $row = $row +1;
        $table .="<TD>".$row."</TD>\n";
        $table .="<TD>".$rec_koperasi['nama']."</TD>\n";
        for ($i=$tahun-4; $i<=$tahun; $i++) {
            $table .="<TD>". $lap_month[$i] ."</TD>\n";
        }
        unset($lap_month);
    } else {
        $row = $row +1;
        $table .="<TD>".$row."</TD>\n";
        $table .="<TD>".$rec_koperasi['nama']."</TD>\n";
        $table .="<TD colspan=12>Laporan Tahunan Tidak Ditemukan!</TD>\n</TR>\n";
    }

}

// start the output buffering for main content
ob_start();

session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en" />
	<meta name="robots" content="noindex,nofollow" />
	<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/reset.css" /> <!-- RESET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/main.css" /> <!-- MAIN STYLE SHEET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/2col.css" title="2col" /> <!-- DEFAULT: 2 COLUMNS -->
	<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="../css/1col.css" title="1col" /> <!-- ALTERNATE: 1 COLUMN -->
	<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="../css/main-ie6.css" /><![endif]--> <!-- MSIE6 -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/style.css" /> <!-- GRAPHIC THEME -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/mystyle.css" /> <!-- WRITE YOUR CSS CODE HERE -->
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/switcher.js"></script>
	<script type="text/javascript" src="../js/toggle.js"></script>
	<script type="text/javascript" src="../js/ui.core.js"></script>
	<script type="text/javascript" src="../js/ui.tabs.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs > ul").tabs();
	});
	</script>
	<title>Kementerian KUKM - JKUK</title>
</head>

<body>

<div id="main">

	<!-- Tray -->
	<div id="tray" disabled="disabled" class="box">

		<p disabled="disabled" class="f-left box">

			<!-- Switcher -->
			<span disabled="disabled" class="f-left" id="switcher">
				<a href="#" rel="1col" disabled="disabled" class="styleswitch ico-col1" title="Display one column"><img src="../design/switcher-1col.gif" alt="1 Column" /></a>
				<a href="#" rel="2col" disabled="disabled" class="styleswitch ico-col2" title="Display two columns"><img src="../design/switcher-2col.gif" alt="2 Columns" /></a>
			</span>

			Project: <strong>Kementerian KUKM</strong>

		</p>

		<p disabled="disabled" class="f-right">User: <strong><a href="#"><?php echo isset($_SESSION['userName']) ? $_SESSION['userName'] : "None";?></a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="../index.php?login=" id="logout">Log out</a></strong></p>

	</div> <!--  /tray -->

	<hr disabled="disabled" class="noscreen" />

	<!-- Menu -->
	<div id="menu" disabled="disabled" class="box">

		<ul disabled="disabled" class="box f-right">
			<li><a href="../#"><span><strong>Visit Site &raquo;</strong></span></a></li>
		</ul>

		<ul disabled="disabled" class="box">
		<?php echo menutop(3); ?>
		</ul>

	</div> <!-- /header -->

	<hr disabled="disabled" class="noscreen" />

	<!-- Columns -->
	<div id="cols" disabled="disabled" class="box">

		<!-- Aside (Left Column) -->
		<div id="aside" disabled="disabled" class="box">

			<div disabled="disabled" class="padding box">

				<!-- Logo (Max. width = 200px) -->
				<p id="logo"><a href="#"><img src="../tmp/logo.gif" alt="Our logo" title="Visit Site" /></a></p>

			</div> <!-- /padding -->
<?php
echo navigation(2);
?>
		</div> <!-- /aside -->

		<hr disabled="disabled" class="noscreen" />

		<!-- Content (Right Column) -->
		<div id="content" disabled="disabled" class="box">

			<h1>Neraca</h1>

			<!-- Form -->
			<h3 disabled="disabled" class="tit">Laporan Bulanan</h3>
			<fieldset>
				<legend>Pilih Data</legend>
				<form id=searchPost method=post>
				<table disabled="disabled" class="nostyle" width="100%">
					<tr>
						<td style="width:180px;">Koperasi:</td>
<?php
	$sql_text = "SELECT idkoperasi, nama from koperasi ORDER BY nama";
	$option = $dbs->query($sql_text);
	echo '<td><select id="jenis" name="koperasi" class="input-text-2">"';
	echo '<option value="">--- Pilih nama ---</option>';
	while ($choice = $option->fetch_assoc()) {
		if (isset($kopnama) and $kopnama == $choice['idkoperasi']) {
			echo '<option value="'.$choice['idkoperasi'].'" SELECTED >'.$choice['nama'].'</option>';
		} else {
		echo '<option value="'.$choice['idkoperasi'].'">'.$choice['nama'].'</option>';
		}
	}
	echo '</select></td>';
?>
					</tr>
					<tr>
						<td colspan="2" disabled="disabled" class="t-right"><input name="searchCoa" type="submit" class="input-submit" value="Lihat Data" /></td>
					</tr>
				</table>
				</form>
			</fieldset>

<fieldset>
				<legend>Data
<?php
	if (isset($recNeraca['nama']) and $recNeraca['nama']<>"") {
		echo $recNeraca['nama'];
	}
?>
</legend>
<!-- Main table -->
<table border="1">
<tr><th rowspan="2">&nbsp;</th><th rowspan="2" align="middle">Koperasi</th><th colspan="5" align="center">Jumlah Laporan</tr>
<?php
$tahun = date('Y');
echo '<tr>';
for ($i=$tahun-4; $i<=$tahun; $i++) {
    echo '<th>'.$i.'</th>';
}
echo '</tr>';

 echo $table; ?>
</table>
			</fieldset>

		</div> <!-- /content -->

	</div> <!-- /cols -->

	<hr disabled="disabled" class="noscreen" />

	<!-- Footer -->
	<div id="footer" disabled="disabled" class="box">

		<p disabled="disabled" class="f-left">&copy; 2012 <a href="#">Kementerian Koperasi dan UKM</a>, All Rights Reserved &reg;</p>

		<p disabled="disabled" class="f-right">Templates by <a href="http://www.adminizio.com/">Adminizio</a></p>

	</div> <!-- /footer -->

</div> <!-- /main -->

</body>
</html>
<?php
// main content grab
$main_content = ob_get_clean();

echo $main_content;
