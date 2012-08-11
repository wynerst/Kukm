<?php
// required file
require 'sysconfig.inc.php';
include "nav_datacenter.php";

if (isset($_POST['searchCoa'])) {
	$kopnama = $_POST['koperasi'];
	$lapperiod = $_POST['periode'];
	if ($kopnama <>"" AND $lapperiod <>"") {
		$search_limit = ' k.idkoperasi ='. $kopnama . ' AND c.dateposting like "'.$lapperiod.'%"';
		// get record
		$sql_text = "SELECT c.*, k.nama FROM coa as c";
		$sql_text .= " LEFT JOIN koperasi as k ON c.idkoperasi = k.idkoperasi ";
		if (isset($search_limit)) {
			$sql_text .= "WHERE ". $search_limit;
		}
		$q_neraca = $dbs->query($sql_text);
		$recNeraca = $q_neraca->fetch_assoc();
	} else {
		$error = 'Nama koperasi dan periode tidak boleh kosong.';
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
<?php
if (isset($error)) {
    utility::jsAlert($error);
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
echo navigation(1);
?>
		</div> <!-- /aside -->

		<hr disabled="disabled" class="noscreen" />

		<!-- Content (Right Column) -->
		<div id="content" disabled="disabled" class="box">

			<h1>Neraca</h1>

			<!-- Form -->
			<h3 disabled="disabled" class="tit">Laporan Neraca Sementara</h3>
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
    	echo '<td><select id="idkoperasi" name="koperasi" class="input-text-02">';
    } else {
    	echo '<td><input type="hidden" name="koperasi" value="'.$_SESSION['koperasi'].'">';
        echo '<select id="idkoperasi" name="koperasi" class="input-text-02" disabled>';
    }
	echo '<option value="0">--- Pilih nama ---</option>';
	while ($choice = $option->fetch_assoc()) {
		if ((isset($kopnama) and $kopnama == $choice['idkoperasi']) OR $choice['idkoperasi'] == $_SESSION['koperasi']) {
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
						<td colspan="2" disabled="disabled" class="t-right">
                        <input name="searchCoa" type="submit" class="input-submit" value="Lihat Data" /></td>
					</tr>
				</table>
				</form>
			</fieldset>

<fieldset>
				<legend>Data
<?php
	if (isset($recNeraca['nama']) and $recNeraca['nama']<>"") {
		echo '&nbsp;'. $recNeraca['nama'];
	}
	if (isset($recNeraca['periode']) and $recNeraca['periode']<>"") {
		echo '&nbsp;untuk&nbsp;'. $recNeraca['periode'];
	}
?>
</legend>
<table disabled="disabled" class="nostyle">
  <tr style="background: #999">
    <td style="width:5px;">1</td>
    <td style="width:5px;"></td>
    <td style="width:250px;">AKTIVA</td>
    <td><input type="text" size="40" name="c1" value="<?php isset($recNeraca['c1']) ? $v=$recNeraca['c1']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr style="background: #CCC">
    <td>11</td>
    <td></td>
    <td>AKTIVA LANCAR</td>
    <td><input type="text" size="40" name="c11" value="<?php isset($recNeraca['c11']) ? $v=$recNeraca['c11']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>1110</td>
    <td></td>
    <td>Kas</td>
    <td><input type="text" size="40" name="c1110" value="<?php isset($recNeraca['c1110']) ? $v=$recNeraca['c1110']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>1120</td>
    <td></td>
    <td>Bank</td>
    <td><input type="text" size="40" name="c1120" value="<?php isset($recNeraca['c1120']) ? $v=$recNeraca['c1120'] : $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1121</td>
    <td>Giro</td>
    <td><input type="text" size="40" name="c1121" value="<?php isset($recNeraca['c1121']) ? $v=$recNeraca['c1121']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1122</td>
    <td>Sertifikat Deposito</td>
    <td><input type="text" size="40" name="c1122" value="<?php isset($recNeraca['c1122']) ? $v=$recNeraca['c1122']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>1130</td>
    <td></td>
    <td>Surat Berharga/Investasi Jangka Pendek</td>
    <td><input type="text" size="40" name="c1130" value="<?php isset($recNeraca['c1130']) ? $v=$recNeraca['c1130']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>1140</td>
    <td></td>
    <td>Piutang</td>
    <td><input type="text" size="40" name="c1140" value="<?php isset($recNeraca['c1140']) ? $v=$recNeraca['c1140']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1141</td>
    <td>Piutang Pinjaman Anggota</td>
    <td><input type="text" size="40" name="c1141" value="<?php isset($recNeraca['c1141']) ? $v=$recNeraca['c1141']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1142</td>
    <td>Piutang Pinjaman Non Anggota / Calon Anggota</td>
    <td><input type="text" size="40" name="c1142" value="<?php isset($recNeraca['c1142']) ? $v=$recNeraca['c1142']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1143</td>
    <td>Piutang Pinjaman pada Koperasi Lain</td>
    <td><input type="text" size="40" name="c1143" value="<?php isset($recNeraca['c1143']) ? $v=$recNeraca['c1143']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1149</td>
    <td>Penyisihan Piutang Tak tertagih</td>
    <td><input type="text" size="40" name="c1149" value="<?php isset($recNeraca['c1149']) ? $v=$recNeraca['c1149']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>1150</td>
    <td></td>
    <td>Beban Dibayar Dimuka</td>
    <td><input type="text" size="40" name="c1150" value="<?php isset($recNeraca['c1150']) ? $v=$recNeraca['c1150']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>1160</td>
    <td></td>
    <td>Pendapatan Akan Diterima</td>
    <td><input type="text" size="40" name="c1160" value="<?php isset($recNeraca['c1160']) ? $v=$recNeraca['c1160']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr style="background: #CCC">
    <td>12</td>
    <td></td>
    <td>INVESTASI JANGKA PANJANG</td>
    <td><input type="text" size="40" name="c12" value="<?php isset($recNeraca['c12']) ? $v=$recNeraca['c12']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>1210</td>
    <td></td>
    <td>Penyertaan Pada Koperasi Sekundair / Lainnya</td>
    <td><input type="text" size="40" name="c1210" value="<?php isset($recNeraca['c1210']) ? $v=$recNeraca['c1210']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>1220</td>
    <td></td>
    <td>Investasi Pada Surat Berharga</td>
    <td><input type="text" size="40" name="c1220" value="<?php isset($recNeraca['c1220']) ? $v=$recNeraca['c1220']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>1230</td>
    <td></td>
    <td>Investasi Jangka Panjang Lain</td>
    <td><input type="text" size="40" name="c1230" value="<?php isset($recNeraca['c1230']) ? $v=$recNeraca['c1230']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr style="background: #CCC">
    <td>13</td>
    <td></td>
    <td>AKTIVA TETAP</td>
    <td><input type="text" size="40" name="c13" value="<?php isset($recNeraca['c13']) ? $v=$recNeraca['c13']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>1310</td>
    <td></td>
    <td>Tanah</td>
    <td><input type="text" size="40" name="c1310" value="<?php isset($recNeraca['c1310']) ? $v=$recNeraca['c1310']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>1320</td>
    <td></td>
    <td>Bangunan / Gedung</td>
    <td><input type="text" size="40" name="c1320" value="<?php isset($recNeraca['c1320']) ? $v=$recNeraca['c1320']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1325</td>
    <td>Akumulasi Penyusutan Bangunan / Gedung</td>
    <td><input type="text" size="40" name="c1325" value="<?php isset($recNeraca['c1325']) ? $v=$recNeraca['c1325']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>1330</td>
    <td></td>
    <td>Kendaraan</td>
    <td><input type="text" size="40" name="c1330" value="<?php isset($recNeraca['c1330']) ? $v=$recNeraca['c1330']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1335</td>
    <td>Akumulasi Penyusutan Kendaraan</td>
    <td><input type="text" size="40" name="c1335" value="<?php isset($recNeraca['c1335']) ? $v=$recNeraca['c1335']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>1340</td>
    <td></td>
    <td>Inventaris</td>
    <td><input type="text" size="40" name="c1340" value="<?php isset($recNeraca['c1340']) ? $v=$recNeraca['c1340']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1345</td>
    <td>Akumulasi Penyusutan Inventaris</td>
    <td><input type="text" size="40" name="c1345" value="<?php isset($recNeraca['c1345']) ? $v=$recNeraca['c1345']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr style="background: #CCC">
    <td>14</td>
    <td></td>
    <td>AKTIVA LAIN - LAIN</td>
    <td><input type="text" size="40" name="c14" value="<?php isset($recNeraca['c14']) ? $v=$recNeraca['c14']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>1410</td>
    <td></td>
    <td>Beban Ditangguhkan</td>
    <td><input type="text" size="40" name="c1410" value="<?php isset($recNeraca['c1410']) ? $v=$recNeraca['c1410']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>1415</td>
    <td></td>
    <td>Amortisasi Beban Ditangguhkan*</td>
    <td><input type="text" size="40" name="" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr style="background: #999">
    <td>2</td>
    <td></td>
    <td>KEWAJIBAN</td>
    <td><input type="text" size="40" name="c2" value="<?php isset($recNeraca['c2']) ? $v=$recNeraca['c2']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
    <td></td>
  </tr>
  <tr style="background: #CCC">
    <td>21</td>
    <td></td>
    <td>KEWAJIBAN LANCAR</td>
    <td><input type="text" size="40" name="c21" value="<?php isset($recNeraca['c21']) ? $v=$recNeraca['c21']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>2110</td>
    <td></td>
    <td>Simpanan</td>
    <td><input type="text" size="40" name="c2110" value="<?php isset($recNeraca['c2110']) ? $v=$recNeraca['c2110']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>2111</td>
    <td>Simpanan Sukarela / Tabungan</td>
    <td><input type="text" size="40" name="c2111" value="<?php isset($recNeraca['c2111']) ? $v=$recNeraca['c2111']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>2112</td>
    <td>Simpanan Berjangka (kurang 1 tahun)</td>
    <td><input type="text" size="40" name="c2112" value="<?php isset($recNeraca['c2112']) ? $v=$recNeraca['c2112']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>2120</td>
    <td></td>
    <td>Dana Bagian SHU</td>
    <td><input type="text" size="40" name="c2120" value="<?php isset($recNeraca['c2120']) ? $v=$recNeraca['c2120']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>2130</td>
    <td></td>
    <td>Beban Yang Masih Harus Dibayar</td>
    <td><input type="text" size="40" name="c2130" value="<?php isset($recNeraca['c2130']) ? $v=$recNeraca['c2130']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>2140</td>
    <td></td>
    <td>Pendapatan Diterima Dimuka</td>
    <td><input type="text" size="40" name="c2140" value="<?php isset($recNeraca['c2140']) ? $v=$recNeraca['c2140']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>2150</td>
    <td></td>
    <td>Hutang Bank (Bagian jatuh tempo kurang 1 tahun)</td>
    <td><input type="text" size="40" name="c2150" value="<?php isset($recNeraca['c2150']) ? $v=$recNeraca['c2150']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>2160</td>
    <td></td>
    <td>Kewajiban Lain-lain (Bagian jatuh tempo kurang 1 tahun)</td>
    <td><input type="text" size="40" name="c2160" value="<?php isset($recNeraca['c2160']) ? $v=$recNeraca['c2160']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr style="background: #CCC">
    <td>22</td>
    <td></td>
    <td>KEWAJIBAN JANGKA PANJANG</td>
    <td><input type="text" size="40" name="c22" value="<?php isset($recNeraca['c22']) ? $v=$recNeraca['c22']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>2210</td>
    <td></td>
    <td>Simpanan Berjangka (lebih 1 tahun)</td>
    <td><input type="text" size="40" name="c2210" value="<?php isset($recNeraca['c2210']) ? $v=$recNeraca['c2210']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>2220</td>
    <td></td>
    <td>Hutang Bank</td>
    <td><input type="text" size="40" name="c2220" value="<?php isset($recNeraca['c2220']) ? $v=$recNeraca['c2220']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>2230</td>
    <td></td>
    <td>Hutang ke LPDB</td>
    <td><input type="text" size="40" name="c2230" value="<?php isset($recNeraca['c2230']) ? $v=$recNeraca['c2230']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>2240</td>
    <td></td>
    <td>Hutang Jangka Panjang Lain</td>
    <td><input type="text" size="40" name="c2240" value="<?php isset($recNeraca['c2240']) ? $v=$recNeraca['c2240']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr style="background: #999">
    <td>3</td>
    <td></td>
    <td>EKUITAS</td>
    <td><input type="text" size="40" name="c3" value="<?php isset($recNeraca['c3']) ? $v=$recNeraca['c3']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>3110</td>
    <td></td>
    <td>Simpanan Pokok/Modal Disetor</td>
    <td><input type="text" size="40" name="c3110" value="<?php isset($recNeraca['c3110']) ? $v=$recNeraca['c3110']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>3120</td>
    <td></td>
    <td>Simpanan Wajib/Tambahan Modal Disetor</td>
    <td><input type="text" size="40" name="c3120" value="<?php isset($recNeraca['c3120']) ? $v=$recNeraca['c3120']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>3130</td>
    <td></td>
    <td>Modal Penyetaraan</td>
    <td><input type="text" size="40" name="c3130" value="<?php isset($recNeraca['c3130']) ? $v=$recNeraca['c3130']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>3140</td>
    <td></td>
    <td>Modal Penyertaan</td>
    <td><input type="text" size="40" name="c3140" value="<?php isset($recNeraca['c3140']) ? $v=$recNeraca['c3140']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>3150</td>
    <td></td>
    <td>Hibah / Donasi</td>
    <td><input type="text" size="40" name="c3150" value="<?php isset($recNeraca['c3150']) ? $v=$recNeraca['c3150']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>3160</td>
    <td></td>
    <td>Cadangan</td>
    <td><input type="text" size="40" name="c3160" value="<?php isset($recNeraca['c3160']) ? $v=$recNeraca['c3160']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>3161</td>
    <td>Cadangan Umum</td>
    <td><input type="text" size="40" name="c3161" value="<?php isset($recNeraca['c3161']) ? $v=$recNeraca['c3161']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>3162</td>
    <td>Cadangan Resiko</td>
    <td><input type="text" size="40" name="c3162" value="<?php isset($recNeraca['c3162']) ? $v=$recNeraca['c3162']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>3170</td>
    <td></td>
    <td>SHU Tahun Lalu Belum Dibagi</td>
    <td><input type="text" size="40" name="c3170" value="<?php isset($recNeraca['c3170']) ? $v=$recNeraca['c3170']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
  <tr>
    <td>3180</td>
    <td></td>
    <td>SHU Tahun Berjalan</td>
    <td><input type="text" size="40" name="c3180" value="<?php isset($recNeraca['c3180']) ? $v=$recNeraca['c3180']: $v=""; echo number_format($v,2,',','.'); ?>" disabled="disabled" class="input-text" /></td>
  </tr>
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
