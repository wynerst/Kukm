<?php
// required file
require 'sysconfig.inc.php';
include "nav_datacenter.php";

if (isset($_POST['searchShu'])) {
	$kopnama = $_POST['idkoperasi'];
	$lapperiod = $_POST['idperiode'];
    //die($_POST['idkoperasi']." - " .$_POST['idperiode']);
	if ($kopnama <>"" AND $lapperiod <>"") {
		$search_limit = ' k.idkoperasi ='. $kopnama . ' AND s.dateposting = "'.$lapperiod.'"';
		// get record
		$sql_text = "SELECT s.*, k.nama FROM shu as s ";
		$sql_text .= " LEFT JOIN koperasi as k ON s.idkoperasi = k.idkoperasi ";
		if (isset($search_limit)) {
			$sql_text .= "WHERE ". $search_limit;
		}
		$q_neraca = $dbs->query($sql_text);
		$recShu = $q_neraca->fetch_assoc();
	} else {
		utility::jsAlert('Nama koperasi dan periode tidak boleh kosong.');
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
echo navigation(2);
?>
		</div> <!-- /aside -->

		<hr class="noscreen" />

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>Perhitungan Hasil Usaha</h1>

			<!-- Form -->
			<h3 class="tit">Laporan SHU Sementara</h3>
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
    	echo '<td><select id="jenis" name="idkoperasi" class="input-text-02">';
    } else {
    	echo '<td><input type="hidden" name="idkoperasi" value="'.$_SESSION['koperasi'].'" />';
        echo '<select id="jenis" name="idkoperasi" class="input-text-02" disabled>';
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
	$sql_text = "SELECT DISTINCT substring(dateposting,1,10) as idperiode from coa";
    if ($_SESSION['group'] == 2) {
        $sql_text .= " WHERE idkoperasi=".$_SESSION['koperasi'];
    }
    $sql_text .= " ORDER BY dateposting DESC";
	$option = $dbs->query($sql_text);
	echo '<td><select id="periode" name="idperiode" class="input-text-2">"';
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
						<td colspan="2" disabled="disabled" class="t-right"><input name="searchShu" type="submit" class="input-submit" value="Lihat Data" /></td>
					</tr>
				</table>
			</fieldset>

<fieldset>
				<legend>Data
<?php
	if (isset($recShu['nama']) and $recShu['nama']<>"") {
		echo '&nbsp;'. $recShu['nama'];
	}
	if (isset($recShu['periode']) and $recShu['periode']<>"") {
		echo '&nbsp;untuk&nbsp;'. $recShu['periode'];
	}
?>
				</legend>
				<table class="nostyle">
 <tr>
 <td style="width:5px;"></td>
 <td style="width:5px;"></td>
 <td style="width:250px;"></td>
 <td></td>
 </tr>
 <tr style="background: #999">
 <td colspan="3" >I. PARTISIPASI ANGGOTA</td>
    <td><input type="text" size="40" name="s1" value="<?php isset($recShu['s1']) ? $v=$recShu['s1']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">A. Partisipasi Bruto Anggota:</td>
    <td><input type="text" size="40" name="s11" value="<?php isset($recShu['s11']) ? $v=$recShu['s11']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">1</td>
 <td>Pendapatan Jasa Pinjaman</td>
    <td><input type="text" size="40" name="s1101" value="<?php isset($recShu['s1101']) ? $v=$recShu['s1101']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">2</td>
 <td>Pendapatan Administrasi</td>
    <td><input type="text" size="40" name="s1102" value="<?php isset($recShu['s1102']) ? $v=$recShu['s1102']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">3</td>
 <td>Pendapatan Provisi</td>
    <td><input type="text" size="40" name="s1103" value="<?php isset($recShu['s1103']) ? $v=$recShu['s1103']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">4</td>
 <td>Jasa Pelayanan</td>
    <td><input type="text" size="40" name="s1104" value="<?php isset($recShu['s1104']) ? $v=$recShu['s1104']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td colspan="2">Jumlah Partisipasi Bruto Anggota (1+2+3+4)</td>
    <td><input type="text" size="40" name="s1199" value="<?php isset($recShu['s1199']) ? $v=$recShu['s1199']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">B. Beban Pokok:</td>
    <td><input type="text" size="40" name="s12" value="<?php isset($recShu['s12']) ? $v=$recShu['s12']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">5</td>
 <td>Jasa Simpanan/Tabungan dari Anggota</td>
    <td><input type="text" size="40" name="s1201" value="<?php isset($recShu['s1201']) ? $v=$recShu['s1201']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">6</td>
 <td>Jasa Simpanan Berjangka dari Anggota</td>
    <td><input type="text" size="40" name="s1202" value="<?php isset($recShu['s1202']) ? $v=$recShu['s1202']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td colspan="2">Jumlah Beban Pokok</td>
    <td><input type="text" size="40" name="s1299" value="<?php isset($recShu['s1299']) ? $v=$recShu['s1299']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td></td>
 <td>PARTISIPASI NETO ANGGOTA (A-B)</td>
    <td><input type="text" size="40" name="s1099" value="<?php isset($recShu['s1099']) ? $v=$recShu['s1099']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr style="background: #999">
 <td colspan="3">II. PENDAPATAN DAN BEBAN DARI NON ANGGOTA</td>
    <td><input type="text" size="40" name="s2" value="<?php isset($recShu['s2']) ? $v=$recShu['s2']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">7</td>
 <td>Pendapatan Jasa Pinjaman</td>
    <td><input type="text" size="40" name="s2001" value="<?php isset($recShu['s2001']) ? $v=$recShu['s2001']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">8</td>
 <td>Pendapatan Administrasi</td>
    <td><input type="text" size="40" name="s2002" value="<?php isset($recShu['s2002']) ? $v=$recShu['s2002']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">9</td>
 <td>Pendapatan Provisi</td>
    <td><input type="text" size="40" name="s2003" value="<?php isset($recShu['s2003']) ? $v=$recShu['s2003']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">10</td>
 <td>Jasa Pelayanan Non Anggota</td>
    <td><input type="text" size="40" name="s2004" value="<?php isset($recShu['s2004']) ? $v=$recShu['s2004']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">Sub Total Pendapatan non Anggota</td>
    <td><input type="text" size="40" name="s2098" value="<?php isset($recShu['s2098']) ? $v=$recShu['s2098']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">11</td>
 <td>Beban Jasa Simpanan/Tabungan dari Non Anggota</td>
    <td><input type="text" size="40" name="s2005" value="<?php isset($recShu['s2005']) ? $v=$recShu['s2005']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">12</td>
 <td>Beban Jasa Simpanan Berjangka dari Non Anggota</td>
    <td><input type="text" size="40" name="s2006" value="<?php isset($recShu['s2006']) ? $v=$recShu['s2006']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">13</td>
 <td>Beban Jasa Hutang Bank</td>
    <td><input type="text" size="40" name="s2007" value="<?php isset($recShu['s2007']) ? $v=$recShu['s2007']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">14</td>
 <td>Beban Jasa Pinjaman Pihak ke III</td>
    <td><input type="text" size="40" name="s2008" value="<?php isset($recShu['s2008']) ? $v=$recShu['s2008']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">15</td>
 <td>Beban Jasa Pinjaman LPDB</td>
    <td><input type="text" size="40" name="s2009" value="<?php isset($recShu['s2009']) ? $v=$recShu['s2009']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">16</td>
 <td>Beban Jasa Modal Penyertaan</td>
    <td><input type="text" size="40" name="s2010" value="<?php isset($recShu['s2010']) ? $v=$recShu['s2010']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">Sub Total Beban non Anggota</td>
    <td><input type="text" size="40" name="s2097" value="<?php isset($recShu['s2097']) ? $v=$recShu['s2097']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td colspan="2">Laba Rugi Kotor dengan Non Anggota (7+8+...+16)</td>
    <td><input type="text" size="40" name="s2099" value="<?php isset($recShu['s2099']) ? $v=$recShu['s2099']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td></td>
 <td>SISA HASIL USAHA KOTOR</td>
    <td><input type="text" size="40" name="s91" value="<?php isset($recShu['s91']) ? $v=$recShu['s91']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr style="background: #999">
 <td colspan="3">III. BEBAN OPERASI</td>
    <td><input type="text" size="40" name="s3" value="<?php isset($recShu['s3']) ? $v=$recShu['s3']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">C. Beban Usaha</td>
    <td><input type="text" size="40" name="s31" value="<?php isset($recShu['s31']) ? $v=$recShu['s31']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">17</td>
 <td>Beban Gaji dan Honor</td>
    <td><input type="text" size="40" name="s3101" value="<?php isset($recShu['s3101']) ? $v=$recShu['s3101']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">18</td>
 <td>Beban Lembur</td>
    <td><input type="text" size="40" name="s3102" value="<?php isset($recShu['s3102']) ? $v=$recShu['s3102']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">19</td>
 <td>Beban THR</td>
    <td><input type="text" size="40" name="s3103" value="<?php isset($recShu['s3103']) ? $v=$recShu['s3103']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">20</td>
 <td>Beban Perjalanan dalam rangka operasional Simpan  Pinjam</td>
    <td><input type="text" size="40" name="s3104" value="<?php isset($recShu['s3104']) ? $v=$recShu['s3104']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">21</td>
 <td>Beban Fotocopy dan ATK</td>
    <td><input type="text" size="40" name="s3105" value="<?php isset($recShu['s3105']) ? $v=$recShu['s3105']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">22</td>
 <td>Beban Listrik / PAM</td>
    <td><input type="text" size="40" name="s3106" value="<?php isset($recShu['s3106']) ? $v=$recShu['s3106']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">23</td>
 <td>Beban Telepon</td>
    <td><input type="text" size="40" name="s3107" value="<?php isset($recShu['s3107']) ? $v=$recShu['s3107']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">24</td>
 <td>Beban Administrasi dan Umum</td>
    <td><input type="text" size="40" name="s3108" value="<?php isset($recShu['s3108']) ? $v=$recShu['s3108']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">25</td>
 <td>Beban Rapat - rapat Komite Pinjaman</td>
    <td><input type="text" size="40" name="s3109" value="<?php isset($recShu['s3109']) ? $v=$recShu['s3109']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">26</td>
 <td>Beban Pemasaran</td>
    <td><input type="text" size="40" name="s3110" value="<?php isset($recShu['s3110']) ? $v=$recShu['s3110']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">27</td>
 <td>Beban Sewa tahun berjalan</td>
    <td><input type="text" size="40" name="s3111" value="<?php isset($recShu['s3111']) ? $v=$recShu['s3111']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">28</td>
 <td>Beban Pemeliharaan Aktiva tetap dan peralatan kantor</td>
    <td><input type="text" size="40" name="s3112" value="<?php isset($recShu['s3112']) ? $v=$recShu['s3112']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">29</td>
 <td>Beban Penyusutan Aktiva Tetap</td>
    <td><input type="text" size="40" name="s3113" value="<?php isset($recShu['s3113']) ? $v=$recShu['s3113']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">30</td>
 <td>Beban Penyisihan Penghapusan Piutang</td>
    <td><input type="text" size="40" name="s3114" value="<?php isset($recShu['s3114']) ? $v=$recShu['s3114']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">31</td>
 <td>Beban Pendidikan dan latihan Karyawan</td>
    <td><input type="text" size="40" name="s3115" value="<?php isset($recShu['s3115']) ? $v=$recShu['s3115']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">32</td>
 <td>Beban Operasional lain dalam rangka operasional Simpan Pinjam</td>
    <td><input type="text" size="40" name="s3116" value="<?php isset($recShu['s3116']) ? $v=$recShu['s3116']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td colspan="2">Jumlah Beban Usaha (16+17+18+.......+32)</td>
    <td><input type="text" size="40" name="s3199" value="<?php isset($recShu['s3199']) ? $v=$recShu['s3199']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td></td>
 <td>SISA HASIL USAHA SEBELUM BEBAN PERKOPERASIAN</td>
    <td><input type="text" size="40" name="s92" value="<?php isset($recShu['s92']) ? $v=$recShu['s92']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">D. Beban Perkoperasian</td>
    <td><input type="text" size="40" name="s32" value="<?php isset($recShu['s32']) ? $v=$recShu['s32']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">33</td>
 <td>Beban Pengawas dan pengurus koperasi</td>
    <td><input type="text" size="40" name="s3201" value="<?php isset($recShu['s3201']) ? $v=$recShu['s3201']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">34</td>
 <td>Beban Pembinaan, Pendidikan dan Pelatihan perkoperasian</td>
    <td><input type="text" size="40" name="s3202" value="<?php isset($recShu['s3202']) ? $v=$recShu['s3202']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">35</td>
 <td>Beban RAT</td>
    <td><input type="text" size="40" name="s3203" value="<?php isset($recShu['s3203']) ? $v=$recShu['s3203']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">Beban Perkoperasian Lain</td>
    <td><input type="text" size="40" name="s3298" value="<?php isset($recShu['s3298']) ? $v=$recShu['s3289']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td colspan="2">Jumlah Beban Perkoperasian</td>
    <td><input type="text" size="40" name="s3299" value="<?php isset($recShu['s3299']) ? $v=$recShu['s3299']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td></td>
 <td>SISA HASIL USAHA SETELAH BEBAN PERKOPERASIAN</td>
    <td><input type="text" size="40" name="s93" value="<?php isset($recShu['s93']) ? $v=$recShu['s93']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">E. Pendapatan dan Beban Lain - lain (yang berasal dari luar usaha simpan pinjam)</td>
    <td><input type="text" size="40" name="s33" value="<?php isset($recShu['s33']) ? $v=$recShu['s33']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">36</td>
 <td>Pendapatan Lain - lain</td>
    <td><input type="text" size="40" name="s3301" value="<?php isset($recShu['s3301']) ? $v=$recShu['s3301']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">37</td>
 <td>Beban Lain - lain</td>
    <td><input type="text" size="40" name="s3302" value="<?php isset($recShu['s3302']) ? $v=$recShu['s3302']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td colspan="2">Jumlah Pendapatan dan Beban Lain - lain</td>
    <td><input type="text" size="40" name="s3399" value="<?php isset($recShu['s3399']) ? $v=$recShu['s3399']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td></td>
 <td>SISA HASIL USAHA SEBELUM PAJAK</td>
    <td><input type="text" size="40" name="s94" value="<?php isset($recShu['s94']) ? $v=$recShu['s94']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">F. Pajak Penghasilan Badan</td>
    <td><input type="text" size="40" name="s34" value="<?php isset($recShu['s34']) ? $v=$recShu['s34']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>SISA HASIL USAHA SETELAH PAJAK</td>
    <td><input type="text" size="40" name="s95" value="<?php isset($recShu['s95']) ? $v=$recShu['s95']: $v="0"; echo number_format($v,2,',','.'); ?>" class="input-text" disabled /></td>
 </tr>
 <!--
    <tr>
        <td colspan="4" class="t-right"><input type="submit" name="saveShu" class="input-submit" value="Simpan" /></td>
    </tr>
-->
				</table>
			</fieldset>
		</div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
	<div id="footer" class="box">

		<p class="f-left">&copy; 2012 <a href="#">Kementerian Koperasi dan UKM</a>, All Rights Reserved &reg;</p>

		<p class="f-right">Templates by <a href="http://www.adminizio.com/">Adminizio</a></p>

	</div> <!-- /footer -->

</div> <!-- /main -->

</body>
</html>
<?php
// main content grab
$main_content = ob_get_clean();

echo $main_content;
