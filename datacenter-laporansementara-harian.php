<?php
// required file
require 'sysconfig.inc.php';
include "nav_datacenter.php";

if (isset($_POST['searchHarian'])) {
	$kopnama = $_POST['koperasi'];
	$lapperiod = $_POST['periode'];
	if ($kopnama <>"" AND $lapperiod <>"") {
		$search_limit = ' k.idkoperasi ='. $kopnama . ' AND c.periode = "'.$lapperiod.'"';
		// get record
		$sql_text = "SELECT c.*, i.*, k.nama FROM harian as c ";
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
	<div id="tray" disabled="disabled" class="box">

		<p disabled="disabled" class="f-left box">

			<!-- Switcher -->
			<span disabled="disabled" class="f-left" id="switcher">
				<a href="#" rel="1col" disabled="disabled" class="styleswitch ico-col1" title="Display one column"><img src="design/switcher-1col.gif" alt="1 Column" /></a>
				<a href="#" rel="2col" disabled="disabled" class="styleswitch ico-col2" title="Display two columns"><img src="design/switcher-2col.gif" alt="2 Columns" /></a>
			</span>

			Project: <strong>Kementerian KUKM</strong>

		</p>

		<p disabled="disabled" class="f-right">User: <strong><a href="#"><?php echo isset($_SESSION['userName']) ? $_SESSION['userName'] : "None";?></a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="index.php?login=" id="logout">Log out</a></strong></p>

	</div> <!--  /tray -->

	<hr disabled="disabled" class="noscreen" />

	<!-- Menu -->
	<div id="menu" disabled="disabled" class="box">

		<ul disabled="disabled" class="box f-right">
			<li><a href="#"><span><strong>Visit Site &raquo;</strong></span></a></li>
		</ul>

		<ul disabled="disabled" class="box">
		<?php echo menutop(2); ?>
		</ul>

	</div> <!-- /header -->

	<hr disabled="disabled" class="noscreen" />

	<!-- Columns -->
	<div id="cols" disabled="disabled" class="box">

		<!-- Aside (Left Column) -->
		<div id="aside" disabled="disabled" class="box">

			<div disabled="disabled" class="padding box">

				<!-- Logo (Max. width = 200px) -->
				<p id="logo"><a href="#"><img src="tmp/logo.gif" alt="Our logo" title="Visit Site" /></a></p>

			</div> <!-- /padding -->
<?php
echo navigation(5);
?>
		</div> <!-- /aside -->

		<hr disabled="disabled" class="noscreen" />

		<!-- Content (Right Column) -->
		<div id="content" disabled="disabled" class="box">

			<h1>Data Harian</h1>

			<!-- Form -->
			<h3 disabled="disabled" class="tit">Laporan Harian Sementara</h3>
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
						<td>Periode:</td>
                        <td><input type="text" name="periode" size="40" class="input-text02" /></td>
					</tr>
					<tr>
						<td colspan="2" class="t-right"><input name="searchHarian" type="submit" class="input-submit" value="Lihat Data" /></td>
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
    <td style="width:250px;"><b>Data harian koperasi</b></td>
    <td></td>
  </tr>
  <tr>
    <td>1</td>
    <td>Simpanan</td>
    <td><input type="text" size="40" name="s1" value="<?php echo isset($recHarian['s1']) ? $recHarian['s1'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>2</td>
    <td>Pinjaman</td>
    <td><input type="text" size="40" name="s2" value="<?php echo isset($recHarian['s2']) ? $recHarian['s2'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>3</td>
    <td>Modal dalam</td>
    <td><input type="text" size="40" name="s3" value="<?php echo isset($recHarian['s3']) ? $recHarian['s3'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>4</td>
    <td>Modal luar</td>
    <td><input type="text" size="40" name="s4" value="<?php echo isset($recHarian['s4']) ? $recHarian['s4'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>5</td>
    <td>Volume Usaha</td>
    <td><input type="text" size="40" name="s5" value="<?php echo isset($recHarian['s5']) ? $recHarian['s5'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6</td>
    <td>Asset</td>
    <td><input type="text" size="40" name="s6" value="<?php echo isset($recHarian['s6']) ? $recHarian['s6'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>7</td>
    <td>SHU</td>
    <td><input type="text" size="40" name="s7" value="<?php echo isset($recHarian['s7']) ? $recHarian['s7'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>8</td>
    <td>Suku Bunga simpanan</td>
    <td><input type="text" size="40" name="s8" value="<?php echo isset($recHarian['s8']) ? $recHarian['s8'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>9</td>
    <td>Suku bunga pinjaman</td>
    <td><input type="text" size="40" name="s9" value="<?php echo isset($recHarian['s9']) ? $recHarian['s9'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #999">
    <td style="width:5px;">10</td>
    <td style="width:250px;"><b>NPL/Non Performing Loan</b></td>
    <td></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Pinjaman Kurang Lancar/PKL</td>
    <td><input type="text" size="40" name="s10" value="<?php echo isset($recHarian['s101']) ? $recHarian['s101'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Pinjaman Diragukan</td>
    <td><input type="text" size="40" name="s10" value="<?php echo isset($recHarian['s102']) ? $recHarian['s102'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Pinjaman Macet</td>
    <td><input type="text" size="40" name="s10" value="<?php echo isset($recHarian['s103']) ? $recHarian['s103'] : "0"; ?>" class="input-text" /></td>
  </tr>
<?php
    if (isset($recHarian['s2']) AND $recHarian['s2'] > 0) {
        $npl = ($recHarian['s103'] + (0.75*$recHarian['s102']) + (0.5*$recHarian['s101']) ) / $recHarian['s2'];
        if ($npl > 0) {
            $npl = $npl * 100;
            echo '<npltr><td>&nbsp;</td><td>NPL</td><td><input type="text" size="40" name="s10" value="'.$npl.'%" class="input-text" /></td></tr>';
        }
    }
?>
<!--  <tr>
	<td colspan="4" class="t-right"><input type="submit" name="saveHarian" class="input-submit" value="Submit" /></td>
  </tr>
-->
</table>
			</fieldset>

		</div> <!-- /content -->

	</div> <!-- /cols -->

	<hr disabled="disabled" class="noscreen" />

	<!-- Footer -->
	<div id="footer" disabled="disabled" class="box">

		<p disabled="disabled" class="f-left">&copy; 2012 <a href="#">PT. Artistika Prasetia</a>, All Rights Reserved &reg;</p>

		<p disabled="disabled" class="f-right">Templates by <a href="http://www.adminizio.com/">Adminizio</a></p>

	</div> <!-- /footer -->

</div> <!-- /main -->

</body>
</html>
<?php
// main content grab
$main_content = ob_get_clean();

echo $main_content;
