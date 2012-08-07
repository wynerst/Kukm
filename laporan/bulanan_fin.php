<?php
// required file
require '../sysconfig.inc.php';
include "../nav_panel.php";
if (isset($_POST['searchCoa'])) {
	$kopnama = $_POST['koperasi'];
	$lapperiod = $_POST['periode'];
	$search_limit = ' c.tahunan = 0';
	if ($kopnama <>"") {
        $search_limit .= ' AND k.idkoperasi ='. $kopnama;
    }
    if ($lapperiod <>"") {
        $search_limit .= ' AND YEAR(c.dateposting) = '.$lapperiod;
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
$sql2 = "SELECT MONTH(periode) as bulan, count(idday) as jumlah FROM harian";

//if (isset($_GET['nid']) AND int($_GET['nid']) == 0) {
//    $rs_koperasi = $dbs->query($sql1. " WHERE idkoperasi = ".$_GET['nid']);
//} else {
    $rs_koperasi = $dbs->query($sql1);
//}

while ($rec_koperasi = $rs_koperasi->fetch_assoc()) {
    $lap_month = array('January'=>0,'February'=>0,'March'=>0,'April'=>0,'May'=>0,'June'=>0,'July'=>0,'August'=>0,'September'=>0,'October'=>0,'November'=>0,'December'=>0);
    $sqllaporan = $sql2. " WHERE idkoperasi=".$rec_koperasi['idkoperasi']; // .' AND tahunan = 0';
    if (isset($lapperiod) and $lapperiod > 0) {
        $sqllaporan .= " AND YEAR(periode)=".$lapperiod." GROUP BY MONTH(periode) ORDER BY MONTH(periode)";
    } else {
        $sqllaporan .= " AND YEAR(periode)=YEAR(now()) GROUP BY MONTH(periode) ORDER BY MONTH(periode)";
    }
//    die($sqllaporan);
    $rs_Laporan = $dbs->query($sqllaporan);
    $table .="<TR>\n";
    if ($rs_Laporan) {
        while ($rec_lap = $rs_Laporan->fetch_assoc()) {
            //echo $rec_koperasi['idkoperasi']. ' ' . $rec_koperasi['nama'] . ' ' . $rec_lap['bulan'] . " " . $rec_lap['jumlah'] . "<br />";
            switch ($rec_lap['bulan']){
                case 1:
                    $lap_month['January'] = $rec_lap['jumlah'];
                    break;
                case 2:
                    $lap_month['February'] = $rec_lap['jumlah'];
                    break;
                case 3:
                    $lap_month['March'] = $rec_lap['jumlah'];
                    break;
                case 4:
                    $lap_month['April'] = $rec_lap['jumlah'];
                    break;
                case 5:
                    $lap_month['May'] = $rec_lap['jumlah'];
                    break;
                case 6:
                    $lap_month['June'] = $rec_lap['jumlah'];
                    break;
                case 7:
                    $lap_month['July'] = $rec_lap['jumlah'];
                    break;
                case 8:
                    $lap_month['August'] = $rec_lap['jumlah'];
                    break;
                case 9:
                    $lap_month['September'] = $rec_lap['jumlah'];
                    break;
                case 10:
                    $lap_month['October'] = $rec_lap['jumlah'];
                    break;
                case 11:
                    $lap_month['November'] = $rec_lap['jumlah'];
                    break;
                case 12:
                    $lap_month['December'] = $rec_lap['jumlah'];
                    break;
            }
        }
        $row = $row +1;
        $table .="<TD>".$row."</TD>\n";
        $table .="<TD>".$rec_koperasi['nama']."</TD>\n";
        $table .="<TD>". $lap_month['January'] ."</TD>\n";
        $table .="<TD>". $lap_month['February'] ."</TD>\n";
        $table .="<TD>". $lap_month['March']. "</TD>\n";
        $table .="<TD>". $lap_month['April']. "</TD>\n";
        $table .="<TD>". $lap_month['May']. "</TD>\n";
        $table .="<TD>". $lap_month['June']. "</TD>\n";
        $table .="<TD>". $lap_month['July']. "</TD>\n";
        $table .="<TD>". $lap_month['August']. "</TD>\n";
        $table .="<TD>". $lap_month['September']. "</TD>\n";
        $table .="<TD>". $lap_month['October']. "</TD>\n";
        $table .="<TD>". $lap_month['November']. "</TD>\n";
        $table .="<TD>". $lap_month['December']. "</TD>\n";
        $table .="</TR>\n";
        unset($lap_month);
    } else {
        $row = $row +1;
        $table .="<TD>".$row."</TD>\n";
        $table .="<TD>".$rec_koperasi['nama']."</TD>\n";
        $table .="<TD colspan=12>Laporan Bulanan Tidak Ditemukan!</TD>\n</TR>\n";
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

			<h1>Data Finansial</h1>

			<!-- Form -->

			<h3 disabled="disabled" class="tit">Laporan Bulanan Data Finansial</h3>
			<fieldset>
            <div id="menu" disabled="disabled" class="box">
                <ul disabled="disabled" class="box f-right">
                    <li><a href="bulanan_coa.php"><span><strong>Neraca</strong></span></a></li>
                    <li><a href="bulanan_shu.php"><span><strong>PHU/SHU</strong></span></a></li>
                </ul>
            </div>
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
						<td>Periode:</td>
<?php
	$sql_text = "SELECT DISTINCT YEAR(dateposting) as idperiode FROM coa ORDER BY YEAR(dateposting) DESC";
	$option = $dbs->query($sql_text);
	echo '<td><select id="periode" name="periode" class="input-text-2">"';
	echo '<option value="">--- Periode pelaporan ---</option>';
	while ($choice = $option->fetch_assoc()) {
		if (isset($lapperiod) and  $lapperiod == $choice['idperiode']) {
			echo '<option value="'.$choice['idperiode'].'" SELECTED >'.$choice['idperiode'].'</option>';
		} else {
			echo '<option value="'.$choice['idperiode'].'">'.$choice['idperiode'].'</option>';
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
		// echo $recNeraca['nama'];
	}
	if (isset($lapperiod)) {
		echo '&nbsp;untuk&nbsp;'. $lapperiod;
	} else {
		echo '&nbsp;untuk&nbsp;'. date("Y");
    }
?>
</legend>
<!-- Main table -->
<table border="1">
<tr><th rowspan="2">&nbsp;</th><th rowspan="2" align="middle">Koperasi</th><th colspan="12" align="center">Jumlah Laporan</tr>
<tr><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>Mei</th><th>Jun</th><th>Jul</th><th>Ags</th><th>Sep</th><th>Okt</th><th>Nov</th><th>Des</th></tr>
<?php echo $table; ?>
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
