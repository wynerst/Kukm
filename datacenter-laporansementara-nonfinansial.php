<?php
// required file
require 'sysconfig.inc.php';
include "nav_datacenter.php";

if (isset($_POST['searchCoa'])) {
	$kopnama = $_POST['koperasi'];
	$lapperiod = $_POST['periode'];
	if ($kopnama <>"" AND $lapperiod <>"") {
		$search_limit = ' k.idkoperasi ='. $kopnama . ' AND p.periode = "'.$lapperiod.'"';
		// get record
		$sql_text = "SELECT c.*, i.*, k.nama FROM non_coa as c LEFT JOIN periode as p ON p.idperiode = c.idperiode ";
		$sql_text .= " LEFT JOIN koperasi as k ON c.idkoperasi = k.idkoperasi ";
		if (isset($search_limit)) {
			$sql_text .= "WHERE ". $search_limit;
		}
		$q_neraca = $dbs->query($sql_text);
        if ($q_neraca) {
            $recNon = $q_neraca->fetch_assoc();
        } else {
            $message = 'Tidak ada data yang ditemukan.';
        }
	} else {
		$message = 'Nama koperasi dan periode tidak boleh kosong.';
	}
}

// start the output buffering for main content
ob_start();

session_start();
if (!isset($_SESSION['access']) AND !$_SESSION['access']) {
    echo '<script type="text/javascript">alert(\'Anda tidak berhak mengakses laman!\');';
    echo 'location.href = \'index.php\';</script>';
    die();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en" />
	<meta name="robots" content="noindex,nofollow" />
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/reset.css" /> <!-- RESET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/main.css" /> <!-- MAIN STYLE SHEET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/2col.css" title="2col" /> <!-- DEFAULT: 2 COLUMNS -->
	<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="css/1col.css" title="1col" /> <!-- ALTERNATE: 1 COLUMN -->
	<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="css/main-ie6.css" /><![endif]--> <!-- MSIE6 -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/style.css" /> <!-- GRAPHIC THEME -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/mystyle.css" /> <!-- WRITE YOUR CSS CODE HERE -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/switcher.js"></script>
	<script type="text/javascript" src="js/toggle.js"></script>
	<script type="text/javascript" src="js/ui.core.js"></script>
	<script type="text/javascript" src="js/ui.tabs.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs > ul").tabs();
	});
	</script>
	<title>Kementerian KUKM - JKUK</title>
</head>

<body>
<?php if (isset($message)) {
    utility::jsAlert($message);
}
?>
<div id="main">

	<!-- Tray -->
	<div id="tray" class="box">

		<p class="f-left box">

			<!-- Switcher -->
			<span class="f-left" id="switcher">
				<a href="#" rel="1col" class="styleswitch ico-col1" title="Display one column"><img src="design/switcher-1col.gif" alt="1 Column" /></a>
				<a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns"><img src="design/switcher-2col.gif" alt="2 Columns" /></a>
			</span>

			Project: <strong>Kementerian KUKM</strong>

		</p>

		<p disabled="disabled" class="f-right">User: <strong><a href="#"><?php echo isset($_SESSION['userName']) ? $_SESSION['userName'] : "None";?></a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="index.php?login=" id="logout">Log out</a></strong></p>

	</div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->
	<div id="menu" class="box">

		<ul class="box f-right">
			<li><a href="#"><span><strong>Visit Site &raquo;</strong></span></a></li>
		</ul>

		<ul class="box">
		<?php echo menutop(2); ?>
		</ul>

	</div> <!-- /header -->

	<hr class="noscreen" />

	<!-- Columns -->
	<div id="cols" class="box">

		<!-- Aside (Left Column) -->
		<div id="aside" class="box">

			<div class="padding box">

				<!-- Logo (Max. width = 200px) -->
				<p id="logo"><a href="#"><img src="tmp/logo.gif" alt="Our logo" title="Visit Site" /></a></p>

			</div> <!-- /padding -->

<?php
echo navigation(3);
?>

		</div> <!-- /aside -->

		<hr class="noscreen" />

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>Data Pendukung Lain</h1>

			<!-- Form -->
			<h3 class="tit">Laporan Data Pendukung Sementara</h3>
			<fieldset>
				<legend>Pilih Data</legend>
				<form id=searchPost method=post>
				<table disabled="disabled" class="nostyle" width="100%">
					<tr>
						<td style="width:180px;">Koperasi:</td>
<?php
	$sql_text = "SELECT idkoperasi, nama from koperasi ORDER BY nama";
	$option = $dbs->query($sql_text);
    if ($_SESSION['group'] == 1) {
    	echo '<td><select id="jenis" name="koperasi" class="input-text-02">';
    } else {
    	echo '<td><select id="jenis" name="koperasi_idkoperasi" class="input-text-02" disabled>';
    }
	echo '<option value="0">--- Pilih nama ---</option>';
	while ($choice = $option->fetch_assoc()) {
		if (isset($kopnama) and $kopnama == $choice['idkoperasi'] OR $choice['idkoperasi'] == $_SESSION['koperasi']) {
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
	$sql_text = "SELECT DISTINCT periode from non_coa ORDER BY periode DESC";
	$option = $dbs->query($sql_text);
	echo '<td><select id="periode" name="periode" class="input-text-2">"';
	echo '<option value="">--- Periode pelaporan ---</option>';
	while ($choice = $option->fetch_assoc()) {
		echo '<option value="'.$choice['periode'].'">'.$choice['periode'].'</option>';
	}
	echo '</select></td>';
?>
					</tr>
					<tr>
						<td colspan="2" class="t-right"><input name="searchCoa" type="submit" class="input-submit" value="Lihat Data" /></td>
					</tr>
				</table>
				</form>
			</fieldset>

			<fieldset>
				<legend>Data
<?php
	if (isset($recNon['nama']) and $recNon['nama']<>"") {
		echo '&nbsp;'. $recNon['nama'];
	}
	if (isset($recNon['periode']) and $recNon['periode']<>"") {
		echo '&nbsp;untuk&nbsp;'. $recNon['periode'];
	}
?>
</legend>
<table class="nostyle">
  <tr style="background: #999">
    <td style="width:5px;"><b>No.</b></td>
    <td style="width:250px;"><b>Data Pendukung Lain</b></td>
    <td></td>
  </tr>
  <tr>
    <td>1</td>
    <td>Jumlah Penasehat/Pengawas</td>
    <td><input type="text" size="40" name="pengawas" value="<?php echo isset($recNon['pengurus']) ? $recNon['pengurus'] : "0"; ?>" class="input-text" disabled /></td>
  </tr>
  <tr>
    <td>2</td>
    <td>Jumlah Pengurus</td>
    <td><input type="text" size="40" name="pengurus" value="<?php echo isset($recNon['pengurus']) ? $recNon['pengurus'] : "0"; ?>" class="input-text" disabled /></td>
  </tr>
  <tr>
    <td>3</td>
    <td>Jumlah Karyawan</td>
    <td><input type="text" size="40" name="karyawan" value="<?php echo isset($recNon['karyawan']) ? $recNon['karyawan'] : "0"; ?>" class="input-text" disabled /></td>
  </tr>
  <tr>
    <td>4</td>
    <td>Jumlah Anggota</td>
    <td><input type="text" size="40" name="anggota" value="<?php echo isset($recNon['anggota']) ? $recNon['anggota'] : "0"; ?>" class="input-text" disabled /></td>
  </tr>
  <tr>
    <td>5</td>
    <td>Jumlah Calon Anggota/Anggota tidak tetap</td>
    <td><input type="text" size="40" name="calon_anggota" value="<?php echo isset($recNon['calon_anggota']) ? $recNon['calon_anggota'] : "0"; ?>" class="input-text" disabled /></td>
  </tr>
</table>
			</fieldset>
		</div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
	<div id="footer" class="box">

		<p class="f-left">&copy; 2012 <a href="#">PT. Artistika Prasetia</a>, All Rights Reserved &reg;</p>

		<p class="f-right">Templates by <a href="http://www.adminizio.com/">Adminizio</a></p>

	</div> <!-- /footer -->

</div> <!-- /main -->

</body>
</html>
<?php
// main content grab
$main_content = ob_get_clean();

echo $main_content;
