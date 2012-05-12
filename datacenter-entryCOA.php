<?php
// required file
require 'sysconfig.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/simbio_dbop.inc.php';
include "listdata.php";
include "nav_datacenter.php";

if (isset($_POST['saveNeraca'])) {

    $sql_op = new simbio_dbop($dbs);

	if (isset($_POST['updatenid'])) {
		$idcoa = $_POST['updatenid'];
	}
	$data['idkoperasi']=$_POST['idkoperasi'];
	$data['idperiode']=$_POST['idperiode'];
	$data['c1']=$_POST['c1'];
	$data['c11']=$_POST['c11'];
	$data['c1110']=$_POST['c1110'];
	$data['c1120']=$_POST['c1120'];
	$data['c1121']=$_POST['c1121'];
	$data['c1122']=$_POST['c1122'];
	$data['c1130']=$_POST['c1130'];
	$data['c1140']=$_POST['c1140'];
	$data['c1141']=$_POST['c1141'];
	$data['c1142']=$_POST['c1142'];
	$data['c1143']=$_POST['c1143'];
	$data['c1149']=$_POST['c1149'];
	$data['c1150']=$_POST['c1150'];
	$data['c1141']=$_POST['c1141'];
	$data['c1142']=$_POST['c1142'];
	$data['c1143']=$_POST['c1143'];
	//$data['c1144']=$_POST['c1144'];
	//$data['c1145']=$_POST['c1145'];
	//$data['c1146']=$_POST['c1146'];
	//$data['c1147']=$_POST['c1147'];
	//$data['c1148']=$_POST['c1148'];
	$data['c1149']=$_POST['c1149'];
	$data['c1150']=$_POST['c1150'];
	$data['c1160']=$_POST['c1160'];
	$data['c12']=$_POST['c12'];
	$data['c1210']=$_POST['c1210'];
	$data['c1220']=$_POST['c1220'];
	$data['c1230']=$_POST['c1230'];
	$data['c13']=$_POST['c13'];
	$data['c1310']=$_POST['c1310'];
	$data['c1320']=$_POST['c1320'];
	$data['c1325']=$_POST['c1325'];
	$data['c1330']=$_POST['c1330'];
	$data['c1335']=$_POST['c1335'];
	$data['c1340']=$_POST['c1340'];
	$data['c1345']=$_POST['c1345'];
	$data['c1390']=$_POST['c1390'];
	$data['c14']=$_POST['c14'];
	$data['c1410']=$_POST['c1410'];
	//$data['c1415']=$_POST['c1415'];
	$data['c2']=$_POST['c2'];
	$data['c21']=$_POST['c21'];
	$data['c2110']=$_POST['c2110'];
	$data['c2111']=$_POST['c2111'];
	$data['c2112']=$_POST['c2112'];
	$data['c2120']=$_POST['c2120'];
	$data['c2130']=$_POST['c2130'];
	$data['c2140']=$_POST['c2140'];
	$data['c2150']=$_POST['c2150'];
	$data['c2160']=$_POST['c2160'];
	$data['c22']=$_POST['c22'];
	$data['c2210']=$_POST['c2210'];
	$data['c2220']=$_POST['c2220'];
	$data['c2230']=$_POST['c2230'];
	$data['c2240']=$_POST['c2240'];
	$data['c3']=$_POST['c3'];
	$data['c3110']=$_POST['c3110'];
	$data['c3120']=$_POST['c3120'];
	$data['c3130']=$_POST['c3130'];
	$data['c3140']=$_POST['c3140'];
	$data['c3150']=$_POST['c3150'];
	$data['c3160']=$_POST['c3160'];
	$data['c3161']=$_POST['c3161'];
	$data['c3162']=$_POST['c3162'];
	$data['c3170']=$_POST['c3170'];
	$data['c3180']=$_POST['c3180'];
	$data['c4']=$_POST['c4'];
	$data['c41']=$_POST['c41'];
	$data['c4110']=$_POST['c4110'];
	$data['c4120']=$_POST['c4120'];
	$data['c4130']=$_POST['c4130'];
	$data['c4140']=$_POST['c4140'];
	$data['c42']=$_POST['c42'];
	$data['c4210']=$_POST['c4210'];
	$data['c4220']=$_POST['c4220'];
	$data['c4230']=$_POST['c4230'];
	$data['c4240']=$_POST['c4240'];
	$data['c5']=$_POST['c5'];
	$data['c51']=$_POST['c51'];
	$data['c5110']=$_POST['c5110'];
	$data['c5120']=$_POST['c5120'];
	$data['c52']=$_POST['c52'];
	$data['c5210']=$_POST['c5210'];
	$data['c5220']=$_POST['c5220'];
	$data['c5230']=$_POST['c5230'];
	$data['c5240']=$_POST['c5240'];
	$data['c5250']=$_POST['c5250'];
	$data['c5260']=$_POST['c5260'];
	$data['c6']=$_POST['c6'];
	$data['c61']=$_POST['c61'];
	$data['c6111']=$_POST['c6111'];
	$data['c6112']=$_POST['c6112'];
	$data['c6113']=$_POST['c6113'];
	$data['c6114']=$_POST['c6114'];
	$data['c6115']=$_POST['c6115'];
	$data['c6116']=$_POST['c6116'];
	$data['c6117']=$_POST['c6117'];
	$data['c6118']=$_POST['c6118'];
	$data['c6119']=$_POST['c6119'];
	$data['c6120']=$_POST['c6120'];
	$data['c6121']=$_POST['c6121'];
	$data['c6122']=$_POST['c6122'];
	$data['c6123']=$_POST['c6123'];
	$data['c6124']=$_POST['c6124'];
	$data['c62']=$_POST['c62'];
	$data['c6211']=$_POST['c6211'];
	$data['c6212']=$_POST['c6212'];
	$data['c6213']=$_POST['c6213'];
	$data['c7110']=$_POST['c7110'];
	$data['c8110']=$_POST['c8110'];
	$data['c3181']=$_POST['c3181'];
	$data['c6129']=$_POST['c6129'];
	$data['c3182']=$_POST['c3182'];
	
	if (isset($idcoa) AND $idcoa <> 0) {
		$update = $sql_op->update('coa', $data, 'idcoa ='.$idcoa);
		if ($update) {
			utility::jsAlert('Data Neraca berhasil diperbaiki.');
		} else {
			utility::jsAlert('Data Neraca GAGAL diperbaiki.');
		}
	} else {
		$insert = $sql_op->insert('coa', $data);
		if ($insert) {
			utility::jsAlert('Data Neraca berhasil disimpan.');
		} else {
			utility::jsAlert($sql_op->error.'Data Neraca GAGAL disimpan.');
		}

	}

}

if (isset($_GET['nid']) AND $_GET['nid'] <> "") {
	// get record
	$idcoa = $_GET['nid'];
	$sql_text = "SELECT c.*, p.periode, k.nama FROM coa as c
		LEFT JOIN periode as p ON c.idperiode = p.idperiode
		LEFT JOIN koperasi as k ON c.idkoperasi = k.idkoperasi
		WHERE c.idcoa =". $idcoa;
	$q_neraca = $dbs->query($sql_text);
	$recNeraca = $q_neraca->fetch_assoc();
}

// start the output buffering for main content
ob_start();

session_start();
?>

<?xml version="1.0"?>
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

		<p class="f-right">User: <strong><a href="#"><?php echo isset($_SESSION['userName']) ? $_SESSION['userName'] : "None";?></a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="index.php?login=" id="logout">Log out</a></strong></p>

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
echo navigation(1);
?>


		</div> <!-- /aside -->

		<hr class="noscreen" />

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>Neraca</h1>
			<?php
			if (isset($_GET['list'])) {
				echo "<fieldset>\n<legend>Data Neraca Tersedia</legend>";
				echo listNeraca();
				echo '<form action="datacenter-entrydata.php" method="link"><table class="nostyle">';
				echo '<div style="text-align:right";><input type="submit" class="input-submit" value="Data Baru" /></div></form>';
				echo "</fieldset>\n";
				//echo listNonNeraca()."<br />";
				$main_content = ob_get_clean();
				die($main_content);
			}
			?>

			<!-- Form -->
			<form id=neracaForm method=post>
			<h3 class="tit">Entry Data</h3>
			<fieldset>
				<legend>Informasi Entry Data</legend>
				<table class="nostyle">
					<tr>
						<td style="width:180px;">Koperasi:</td>
<?php
	$sql_text = "SELECT idkoperasi, nama from koperasi ORDER BY nama";
	$option = $dbs->query($sql_text);
	echo '<td><select id="jenis" name="idkoperasi" class="input-text-2">"';
	echo '<option value="">--- Pilih nama ---</option>';
	while ($choice = $option->fetch_assoc()) {
		if ($choice['idkoperasi'] == $recNeraca['idkoperasi']) {
			echo '<option value="'.$choice['idkoperasi'].'" SELECTED >'.$choice['nama'].'</option>';
		} else {
			echo '<option value="'.$choice['idkoperasi'].'">'.$choice['nama'].'</option>';
		}
	}
	unset ($choice);
	echo '</select></td>';
?>
					</tr>
					<tr>
						<td>Periode:</td>
<?php
	$sql_text = "SELECT idperiode, periode from periode ORDER BY finaldate DESC";
	$option = $dbs->query($sql_text);
	echo '<td><select id="periode" name="idperiode" class="input-text-2">"';
	echo '<option value="">--- Periode pelaporan ---</option>';
	while ($choice = $option->fetch_assoc()) {
		if ($choice['idperiode'] == $recNeraca['idperiode']) {
			echo '<option value="'.$choice['idperiode'].'" SELECTED >'.$choice['periode'].'</option>';
		} else {
			echo '<option value="'.$choice['idperiode'].'">'.$choice['periode'].'</option>';
		}
	}
	echo '</select></td>';
?>
					</tr>
				</table>
			</fieldset>

			<fieldset>
				<legend>Data</legend>
<table class="nostyle">
  <tr style="background: #999">
    <td style="width:5px;">1</td>
    <td style="width:5px;"></td>
    <td style="width:250px;">AKTIVA</td>
    <td><input type="text" size="40" name="c1" value="<?php isset($recNeraca['c1']) ? $v=$recNeraca['c1']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #CCC">
    <td>11</td>
    <td></td>
    <td>AKTIVA LANCAR</td>
    <td><input type="text" size="40" name="c11" value="<?php isset($recNeraca['c11']) ? $v=$recNeraca['c11']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>1110</td>
    <td></td>
    <td>Kas</td>
    <td><input type="text" size="40" name="c1110" value="<?php isset($recNeraca['c1110']) ? $v=$recNeraca['c1110']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>1120</td>
    <td></td>
    <td>Bank</td>
    <td><input type="text" size="40" name="c1120" value="<?php isset($recNeraca['c1120']) ? $v=$recNeraca['c1120'] : $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1121</td>
    <td>Giro</td>
    <td><input type="text" size="40" name="c1121" value="<?php isset($recNeraca['c1121']) ? $v=$recNeraca['c1121']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1122</td>
    <td>Sertifikat Deposito</td>
    <td><input type="text" size="40" name="c1122" value="<?php isset($recNeraca['c1122']) ? $v=$recNeraca['c1122']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>1130</td>
    <td></td>
    <td>Surat Berharga/Investasi Jangka Pendek</td>
    <td><input type="text" size="40" name="c1130" value="<?php isset($recNeraca['c1130']) ? $v=$recNeraca['c1130']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>1140</td>
    <td></td>
    <td>Piutang</td>
    <td><input type="text" size="40" name="c1140" value="<?php isset($recNeraca['c1140']) ? $v=$recNeraca['c1140']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1141</td>
    <td>Piutang Pinjaman Anggota</td>
    <td><input type="text" size="40" name="c1141" value="<?php isset($recNeraca['c1141']) ? $v=$recNeraca['c1141']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1142</td>
    <td>Piutang Pinjaman Non Anggota / Calon Anggota</td>
    <td><input type="text" size="40" name="c1142" value="<?php isset($recNeraca['c1142']) ? $v=$recNeraca['c1142']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1143</td>
    <td>Piutang Pinjaman pada Koperasi Lain</td>
    <td><input type="text" size="40" name="c1143" value="<?php isset($recNeraca['c1143']) ? $v=$recNeraca['c1143']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1149</td>
    <td>Penyisihan Piutang Tak tertagih</td>
    <td><input type="text" size="40" name="c1149" value="<?php isset($recNeraca['c1149']) ? $v=$recNeraca['c1149']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>1150</td>
    <td></td>
    <td>Beban Dibayar Dimuka</td>
    <td><input type="text" size="40" name="c1150" value="<?php isset($recNeraca['c1150']) ? $v=$recNeraca['c1150']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>1160</td>
    <td></td>
    <td>Pendapatan Akan Diterima</td>
    <td><input type="text" size="40" name="c1160" value="<?php isset($recNeraca['c1160']) ? $v=$recNeraca['c1160']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #CCC">
    <td>12</td>
    <td></td>
    <td>INVESTASI JANGKA PANJANG</td>
    <td><input type="text" size="40" name="c12" value="<?php isset($recNeraca['c12']) ? $v=$recNeraca['c12']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>1210</td>
    <td></td>
    <td>Penyertaan Pada Koperasi Sekundair / Lainnya</td>
    <td><input type="text" size="40" name="c1210" value="<?php isset($recNeraca['c1210']) ? $v=$recNeraca['c1210']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>1220</td>
    <td></td>
    <td>Investasi Pada Surat Berharga</td>
    <td><input type="text" size="40" name="c1220" value="<?php isset($recNeraca['c1220']) ? $v=$recNeraca['c1220']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>1230</td>
    <td></td>
    <td>Investasi Jangka Panjang Lain</td>
    <td><input type="text" size="40" name="c1230" value="<?php isset($recNeraca['c1230']) ? $v=$recNeraca['c1230']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #CCC">
    <td>13</td>
    <td></td>
    <td>AKTIVA TETAP</td>
    <td><input type="text" size="40" name="c13" value="<?php isset($recNeraca['c13']) ? $v=$recNeraca['c13']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>1310</td>
    <td></td>
    <td>Tanah</td>
    <td><input type="text" size="40" name="c1310" value="<?php isset($recNeraca['c1310']) ? $v=$recNeraca['c1310']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>1320</td>
    <td></td>
    <td>Bangunan / Gedung</td>
    <td><input type="text" size="40" name="c1320" value="<?php isset($recNeraca['c1320']) ? $v=$recNeraca['c1320']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1325</td>
    <td>Akumulasi Penyusutan Bangunan / Gedung</td>
    <td><input type="text" size="40" name="c1325" value="<?php isset($recNeraca['c1325']) ? $v=$recNeraca['c1325']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>1330</td>
    <td></td>
    <td>Kendaraan</td>
    <td><input type="text" size="40" name="c1330" value="<?php isset($recNeraca['c1330']) ? $v=$recNeraca['c1330']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1335</td>
    <td>Akumulasi Penyusutan Kendaraan</td>
    <td><input type="text" size="40" name="c1335" value="<?php isset($recNeraca['c1335']) ? $v=$recNeraca['c1335']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>1340</td>
    <td></td>
    <td>Inventaris</td>
    <td><input type="text" size="40" name="c1340" value="<?php isset($recNeraca['c1340']) ? $v=$recNeraca['c1340']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>1345</td>
    <td>Akumulasi Penyusutan Inventaris</td>
    <td><input type="text" size="40" name="c1345" value="<?php isset($recNeraca['c1345']) ? $v=$recNeraca['c1345']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>1390</td>
    <td></td>
    <td>Akumulasi Seluruh Penyusutan</td>
    <td><input type="text" size="40" name="c1390" value="<?php isset($recNeraca['c1390']) ? $v=$recNeraca['c1390']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #CCC">
    <td>14</td>
    <td></td>
    <td>AKTIVA LAIN - LAIN</td>
    <td><input type="text" size="40" name="c14" value="<?php isset($recNeraca['c14']) ? $v=$recNeraca['c14']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>1410</td>
    <td></td>
    <td>Beban Ditangguhkan</td>
    <td><input type="text" size="40" name="c1410" value="<?php isset($recNeraca['c1410']) ? $v=$recNeraca['c1410']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>1415</td>
    <td></td>
    <td>Amortisasi Beban Ditangguhkan*</td>
    <td><input type="text" size="40" name="" class="input-text" /></td>
  </tr>
  <tr style="background: #999">
    <td>2</td>
    <td></td>
    <td>KEWAJIBAN</td>
    <td><input type="text" size="40" name="c2" value="<?php isset($recNeraca['c2']) ? $v=$recNeraca['c2']: $v="0"; echo $v; ?>" class="input-text" /></td>
    <td></td>
  </tr>
  <tr style="background: #CCC">
    <td>21</td>
    <td></td>
    <td>KEWAJIBAN LANCAR</td>
    <td><input type="text" size="40" name="c21" value="<?php isset($recNeraca['c21']) ? $v=$recNeraca['c21']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>2110</td>
    <td></td>
    <td>Simpanan</td>
    <td><input type="text" size="40" name="c2110" value="<?php isset($recNeraca['c2110']) ? $v=$recNeraca['c2110']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>2111</td>
    <td>Simpanan Sukarela / Tabungan</td>
    <td><input type="text" size="40" name="c2111" value="<?php isset($recNeraca['c2111']) ? $v=$recNeraca['c2111']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>2112</td>
    <td>Simpanan Berjangka (kurang 1 tahun)</td>
    <td><input type="text" size="40" name="c2112" value="<?php isset($recNeraca['c2112']) ? $v=$recNeraca['c2112']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>2120</td>
    <td></td>
    <td>Dana Bagian SHU</td>
    <td><input type="text" size="40" name="c2120" value="<?php isset($recNeraca['c2120']) ? $v=$recNeraca['c2120']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>2130</td>
    <td></td>
    <td>Beban Yang Masih Harus Dibayar</td>
    <td><input type="text" size="40" name="c2130" value="<?php isset($recNeraca['c2130']) ? $v=$recNeraca['c2130']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>2140</td>
    <td></td>
    <td>Pendapatan Diterima Dimuka</td>
    <td><input type="text" size="40" name="c2140" value="<?php isset($recNeraca['c2140']) ? $v=$recNeraca['c2140']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>2150</td>
    <td></td>
    <td>Hutang Bank (Bagian jatuh tempo kurang 1 tahun)</td>
    <td><input type="text" size="40" name="c2150" value="<?php isset($recNeraca['c2150']) ? $v=$recNeraca['c2150']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>2160</td>
    <td></td>
    <td>Kewajiban Lain-lain (Bagian jatuh tempo kurang 1 tahun)</td>
    <td><input type="text" size="40" name="c2160" value="<?php isset($recNeraca['c2160']) ? $v=$recNeraca['c2160']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #CCC">
    <td>22</td>
    <td></td>
    <td>KEWAJIBAN JANGKA PANJANG</td>
    <td><input type="text" size="40" name="c22" value="<?php isset($recNeraca['c22']) ? $v=$recNeraca['c22']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>2210</td>
    <td></td>
    <td>Simpanan Berjangka (lebih 1 tahun)</td>
    <td><input type="text" size="40" name="c2210" value="<?php isset($recNeraca['c2210']) ? $v=$recNeraca['c2210']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>2220</td>
    <td></td>
    <td>Hutang Bank</td>
    <td><input type="text" size="40" name="c2220" value="<?php isset($recNeraca['c2220']) ? $v=$recNeraca['c2220']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>2230</td>
    <td></td>
    <td>Hutang ke LPDB</td>
    <td><input type="text" size="40" name="c2230" value="<?php isset($recNeraca['c2230']) ? $v=$recNeraca['c2230']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>2240</td>
    <td></td>
    <td>Hutang Jangka Panjang Lain</td>
    <td><input type="text" size="40" name="c2240" value="<?php isset($recNeraca['c2240']) ? $v=$recNeraca['c2240']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #999">
    <td>3</td>
    <td></td>
    <td>EKUITAS</td>
    <td><input type="text" size="40" name="c3" value="<?php isset($recNeraca['c3']) ? $v=$recNeraca['c3']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>3110</td>
    <td></td>
    <td>Simpanan Pokok/Modal Disetor</td>
    <td><input type="text" size="40" name="c3110" value="<?php isset($recNeraca['c3110']) ? $v=$recNeraca['c3110']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>3120</td>
    <td></td>
    <td>Simpanan Wajib/Tambahan Modal Disetor</td>
    <td><input type="text" size="40" name="c3120" value="<?php isset($recNeraca['c3120']) ? $v=$recNeraca['c3120']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>3130</td>
    <td></td>
    <td>Modal Penyetaraan</td>
    <td><input type="text" size="40" name="c3130" value="<?php isset($recNeraca['c3130']) ? $v=$recNeraca['c3130']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>3140</td>
    <td></td>
    <td>Modal Penyertaan</td>
    <td><input type="text" size="40" name="c3140" value="<?php isset($recNeraca['c3140']) ? $v=$recNeraca['c3140']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>3150</td>
    <td></td>
    <td>Hibah / Donasi</td>
    <td><input type="text" size="40" name="c3150" value="<?php isset($recNeraca['c3150']) ? $v=$recNeraca['c3150']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>3160</td>
    <td></td>
    <td>Cadangan</td>
    <td><input type="text" size="40" name="c3160" value="<?php isset($recNeraca['c3160']) ? $v=$recNeraca['c3160']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>3161</td>
    <td>Cadangan Umum</td>
    <td><input type="text" size="40" name="c3161" value="<?php isset($recNeraca['c3161']) ? $v=$recNeraca['c3161']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td></td>
    <td>3162</td>
    <td>Cadangan Resiko</td>
    <td><input type="text" size="40" name="c3162" value="<?php isset($recNeraca['c3162']) ? $v=$recNeraca['c3162']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>3170</td>
    <td></td>
    <td>SHU Tahun Lalu Belum Dibagi</td>
    <td><input type="text" size="40" name="c3170" value="<?php isset($recNeraca['c3170']) ? $v=$recNeraca['c3170']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>3180</td>
    <td></td>
    <td>SHU Tahun Berjalan</td>
    <td><input type="text" size="40" name="c3180" value="<?php isset($recNeraca['c3180']) ? $v=$recNeraca['c3180']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #999">
    <td>4</td>
    <td></td>
    <td>PENDAPATAN</td>
    <td><input type="text" size="40" name="c4" value="<?php isset($recNeraca['c4']) ? $v=$recNeraca['c4']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #CCC">
    <td>41</td>
    <td></td>
    <td>PARTISIPASI BRUTO</td>
    <td><input type="text" size="40" name="c41" value="<?php isset($recNeraca['c41']) ? $v=$recNeraca['c41']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>4110</td>
    <td></td>
    <td>Pendapatan Jasa Pinjaman Anggota</td>
    <td><input type="text" size="40" name="c4110" value="<?php isset($recNeraca['c4110']) ? $v=$recNeraca['c4110']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>4120</td>
    <td></td>
    <td>Pendapatan Administrasi Anggota</td>
    <td><input type="text" size="40" name="c4120" value="<?php isset($recNeraca['c4120']) ? $v=$recNeraca['c4120']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>4130</td>
    <td></td>
    <td>Pendapatan Provisi Anggota</td>
    <td><input type="text" size="40" name="c4130" value="<?php isset($recNeraca['c4130']) ? $v=$recNeraca['c4130']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>4140</td>
    <td></td>
    <td>Pendapatan Jasa Pelayanan Lainnya Anggota</td>
    <td><input type="text" size="40" name="c4140" value="<?php isset($recNeraca['c4140']) ? $v=$recNeraca['c4140']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #CCC">
    <td>42</td>
    <td></td>
    <td>PARTISIPASI NON ANGGOTA</td>
    <td><input type="text" size="40" name="c42" value="<?php isset($recNeraca['c42']) ? $v=$recNeraca['c42']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>4210</td>
    <td></td>
    <td>Pendapatan Jasa Pinjaman Non Anggota</td>
    <td><input type="text" size="40" name="c4210" value="<?php isset($recNeraca['c4210']) ? $v=$recNeraca['c4210']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>4220</td>
    <td></td>
    <td>Pendapatan Administrasi Non Anggota</td>
    <td><input type="text" size="40" name="c4220" value="<?php isset($recNeraca['c4220']) ? $v=$recNeraca['c4220']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>4230</td>
    <td></td>
    <td>Pendapatan Provisi Non Anggota</td>
    <td><input type="text" size="40" name="c4230" value="<?php isset($recNeraca['c4230']) ? $v=$recNeraca['c4230']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>4240</td>
    <td></td>
    <td>Pendapatan Jasa Pelayanan Non Anggota</td>
    <td><input type="text" size="40" name="c4240" value="<?php isset($recNeraca['c4240']) ? $v=$recNeraca['c4240']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #999">
    <td>5</td>
    <td></td>
    <td>BEBAN POKOK</td>
    <td><input type="text" size="40" name="c5" value="<?php isset($recNeraca['c5']) ? $v=$recNeraca['c5']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #CCC">
    <td>51</td>
    <td></td>
    <td>PARTISIPASI ANGGOTA</td>
    <td><input type="text" size="40" name="c51" value="<?php isset($recNeraca['c51']) ? $v=$recNeraca['c51']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>5110</td>
    <td></td>
    <td>Beban Jasa Simpanan Sukarela / Tabungan dari Anggota</td>
    <td><input type="text" size="40" name="c5110" value="<?php isset($recNeraca['c5110']) ? $v=$recNeraca['c5110']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>5120</td>
    <td></td>
    <td>Beban Jasa Simpanan Berjangka dari Anggota</td>
    <td><input type="text" size="40" name="c5120" value="<?php isset($recNeraca['c5120']) ? $v=$recNeraca['c5120']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #CCC">
    <td>52</td>
    <td></td>
    <td>PARTISIPASI NON ANGGOTA</td>
    <td><input type="text" size="40" name="c52" value="<?php isset($recNeraca['c52']) ? $v=$recNeraca['c52']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>5210</td>
    <td></td>
    <td>Beban Jasa Simpanan / Tabungan dari Non Anggota</td>
    <td><input type="text" size="40" name="c5210" value="<?php isset($recNeraca['c5210']) ? $v=$recNeraca['c5210']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>5220</td>
    <td></td>
    <td>Beban Jasa Simpanan Berjangka dari Non Anggota</td>
    <td><input type="text" size="40" name="c5220" value="<?php isset($recNeraca['c5220']) ? $v=$recNeraca['c5220']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>5230</td>
    <td></td>
    <td>Beban Jasa Hutang Bank</td>
    <td><input type="text" size="40" name="c5230" value="<?php isset($recNeraca['c5230']) ? $v=$recNeraca['c5230']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>5240</td>
    <td></td>
    <td>Beban Jasa Pinjaman LPDB</td>
    <td><input type="text" size="40" name="c5240" value="<?php isset($recNeraca['c5240']) ? $v=$recNeraca['c5240']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>5250</td>
    <td></td>
    <td>Beban Jasa Modal Penyertaan</td>
    <td><input type="text" size="40" name="c5250" value="<?php isset($recNeraca['c5250']) ? $v=$recNeraca['c5250']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>5260</td>
    <td></td>
    <td>Beban Jasa Pinjaman Pihak ke III</td>
    <td><input type="text" size="40" name="c5260" value="<?php isset($recNeraca['c5260']) ? $v=$recNeraca['c5260']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #999">
    <td>6</td>
    <td></td>
    <td>BEBAN OPERASIONAL</td>
    <td><input type="text" size="40" name="c6" value="<?php isset($recNeraca['c6']) ? $v=$recNeraca['c6']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #CCC">
    <td>61</td>
    <td></td>
    <td>BEBAN USAHA</td>
    <td><input type="text" size="40" name="c61" value="<?php isset($recNeraca['c61']) ? $v=$recNeraca['c61']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6111</td>
    <td></td>
    <td>Beban Tenaga Kerja</td>
    <td><input type="text" size="40" name="c6111" value="<?php isset($recNeraca['c6111']) ? $v=$recNeraca['c6111']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6112</td>
    <td></td>
    <td>Beban Perjalanan dalam rangka operasional Simpan Pinjam</td>
    <td><input type="text" size="40" name="c6112" value="<?php isset($recNeraca['c6112']) ? $v=$recNeraca['c6112']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6113</td>
    <td></td>
    <td>Beban Listrik/PAM</td>
    <td><input type="text" size="40" name="c6113" value="<?php isset($recNeraca['c6113']) ? $v=$recNeraca['c6113']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6114</td>
    <td></td>
    <td>Beban Telepon</td>
    <td><input type="text" size="40" name="c6114" value="<?php isset($recNeraca['c6114']) ? $v=$recNeraca['c6114']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6115</td>
    <td></td>
    <td>Beban Administrasi dan Umum</td>
    <td><input type="text" size="40" name="c6115" value="<?php isset($recNeraca['c6115']) ? $v=$recNeraca['c6115']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6116</td>
    <td></td>
    <td>Beban Rapat - rapat Komite Pinjaman</td>
    <td><input type="text" size="40" name="c6116" value="<?php isset($recNeraca['c6116']) ? $v=$recNeraca['c6116']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6117</td>
    <td></td>
    <td>Beban Pendidikan dan latihan Karyawan</td>
    <td><input type="text" size="40" name="c6117" value="<?php isset($recNeraca['c6117']) ? $v=$recNeraca['c6117']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6118</td>
    <td></td>
    <td>Beban Pajak (tidak termasuk pajak penghasilan)</td>
    <td><input type="text" size="40" name="c6118" value="<?php isset($recNeraca['c6118']) ? $v=$recNeraca['c6118']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6119</td>
    <td></td>
    <td>Beban Pemasaran</td>
    <td><input type="text" size="40" name="c6119" value="<?php isset($recNeraca['c6119']) ? $v=$recNeraca['c6119']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6120</td>
    <td></td>
    <td>Beban Sewa tahun berjalan</td>
    <td><input type="text" size="40" name="c6120" value="<?php isset($recNeraca['c6120']) ? $v=$recNeraca['c6120']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6121</td>
    <td></td>
    <td>Beban Pemeliharaan Aktiva Tetap</td>
    <td><input type="text" size="40" name="c6121" value="<?php isset($recNeraca['c6121']) ? $v=$recNeraca['c6121']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6122</td>
    <td></td>
    <td>Beban Penyusutan Aktiva Tetap</td>
    <td><input type="text" size="40" name="c6122" value="<?php isset($recNeraca['c6122']) ? $v=$recNeraca['c6122']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6123</td>
    <td></td>
    <td>Beban Penyisihan Penghapusan Piutang</td>
    <td><input type="text" size="40" name="c6123" value="<?php isset($recNeraca['c6123']) ? $v=$recNeraca['c6123']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6124</td>
    <td></td>
    <td>Beban Operasional lain dalam rangka operasional Simpan Pinjam</td>
    <td><input type="text" size="40" name="c6124" value="<?php isset($recNeraca['c6124']) ? $v=$recNeraca['c6124']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #CCC">
    <td>62</td>
    <td></td>
    <td>BEBAN PERKOPERASIAN</td>
    <td><input type="text" size="40" name="c62" value="<?php isset($recNeraca['c62']) ? $v=$recNeraca['c62']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6211</td>
    <td></td>
    <td>Beban Pengawas dan pengurus koperasi</td>
    <td><input type="text" size="40" name="c6211" value="<?php isset($recNeraca['c6211']) ? $v=$recNeraca['c6211']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6212</td>
    <td></td>
    <td>Beban Pembinaan, Pendidikan dan Pelatihan perkoperasian</td>
    <td><input type="text" size="40" name="c6212" value="<?php isset($recNeraca['c6212']) ? $v=$recNeraca['c6212']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6213</td>
    <td></td>
    <td>Beban Rapat Anggota (RAT dll)</td>
    <td><input type="text" size="40" name="c6213" value="<?php isset($recNeraca['c6213']) ? $v=$recNeraca['c6213']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>7110</td>
    <td></td>
    <td>Pendapatan Non Operasional</td>
    <td><input type="text" size="40" name="c7110" value="<?php isset($recNeraca['c7110']) ? $v=$recNeraca['c7110']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>8110</td>
    <td></td>
    <td>Beban Non Operasional</td>
    <td><input type="text" size="40" name="c8110" value="<?php isset($recNeraca['c8110']) ? $v=$recNeraca['c8110']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>3180</td>
    <td></td>
    <td>SHU Sebelum Pajak</td>
    <td><input type="text" size="40" name="c3181" value="<?php isset($recNeraca['c3181']) ? $v=$recNeraca['c3181']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6129</td>
    <td></td>
    <td>Taksiran Pajak Penghasilan</td>
    <td><input type="text" size="40" name="c6129" value="<?php isset($recNeraca['c6129']) ? $v=$recNeraca['c6129']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>3180</td>
    <td></td>
    <td>SHU Setelah Pajak</td>
    <td><input type="text" size="40" name="c3182" value="<?php isset($recNeraca['c3182']) ? $v=$recNeraca['c3182']: $v="0"; echo $v; ?>" class="input-text" /></td>
  </tr>
					<tr>
						<td colspan="4" class="t-right"><input type="submit" name="saveNeraca" class="input-submit" value="Submit" /></td>
					</tr>
</table>
			</fieldset>
<?php
if (isset($idcoa)) {
    echo '<input type="hidden" name="updatenid" value="'.$idcoa.'"/>';
}
?>
</form>
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
