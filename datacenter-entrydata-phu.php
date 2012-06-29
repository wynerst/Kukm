<?php
// required file
require 'sysconfig.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/simbio_dbop.inc.php';
include "listdata.php";
include "nav_datacenter.php";

if (isset($_POST['saveShu'])) {

    $sql_op = new simbio_dbop($dbs);

	if (isset($_POST['updatenid'])) {
		$idshu = $_POST['updatenid'];
	}
	$date['month']=$_POST['month'];
	$date['tahun']=$_POST['tahun'];
    if (isset($_POST['month'])) {
        $date['time'] = $date['tahun']."-".$date['month']."-01";
        $testdate = $dbs->query("SELECT LAST_DAY('".$date['time']."')");
        $resultdate = $testdate->fetch_row();
        $data['dateposting'] = $resultdate[0];
    } else {
        $data['dateposting'] = $date['tahun']."-12-31";
        $data['tahunan'] = 1;
    }

	$data['idkoperasi'] = $_POST['idkoperasi'];
//	$data['idperiode'] = $_POST['idperiode'];
	$data['s1'] = $_POST['s1'];
	$data['s11'] = $_POST['s11'];
	$data['s1101'] = $_POST['s1101'];
	$data['s1102'] = $_POST['s1102'];
	$data['s1103'] = $_POST['s1103'];
	$data['s1104'] = $_POST['s1104'];
	$data['s1199'] = $_POST['s1199'];
	$data['s12'] = $_POST['s12'];
	$data['s1201'] = $_POST['s1201'];
	$data['s1202'] = $_POST['s1202'];
	$data['s1299'] = $_POST['s1299'];
	$data['s1099'] = $_POST['s1099'];
	$data['s2'] = $_POST['s2'];
	$data['s2001'] = $_POST['s2001'];
	$data['s2002'] = $_POST['s2002'];
	$data['s2003'] = $_POST['s2003'];
	$data['s2004'] = $_POST['s2004'];
	$data['s2005'] = $_POST['s2005'];
	$data['s2006'] = $_POST['s2006'];
	$data['s2007'] = $_POST['s2007'];
	$data['s2008'] = $_POST['s2008'];
	$data['s2009'] = $_POST['s2009'];
	$data['s2010'] = $_POST['s2010'];
	$data['s2097'] = $_POST['s2097'];
	$data['s2098'] = $_POST['s2098'];
	$data['s2099'] = $_POST['s2099'];
	$data['s91'] = $_POST['s91'];
	$data['s3'] = $_POST['s3'];
	$data['s31'] = $_POST['s31'];
	$data['s3101'] = $_POST['s3101'];
	$data['s3102'] = $_POST['s3102'];
	$data['s3103'] = $_POST['s3103'];
	$data['s3104'] = $_POST['s3104'];
	$data['s3105'] = $_POST['s3105'];
	$data['s3106'] = $_POST['s3106'];
	$data['s3107'] = $_POST['s3107'];
	$data['s3108'] = $_POST['s3108'];
	$data['s3109'] = $_POST['s3109'];
	$data['s3110'] = $_POST['s3110'];
	$data['s3111'] = $_POST['s3111'];
	$data['s3112'] = $_POST['s3112'];
	$data['s3113'] = $_POST['s3113'];
	$data['s3114'] = $_POST['s3114'];
	$data['s3115'] = $_POST['s3115'];
	$data['s3116'] = $_POST['s3116'];
	$data['s3199'] = $_POST['s3199'];
	$data['s92'] = $_POST['s92'];
	$data['s32'] = $_POST['s32'];
	$data['s3201'] = $_POST['s3201'];
	$data['s3202'] = $_POST['s3202'];
	$data['s3203'] = $_POST['s3203'];
	$data['s3298'] = $_POST['s3298'];
	$data['s3299'] = $_POST['s3299'];
	$data['s93'] = $_POST['s93'];
	$data['s33'] = $_POST['s33'];
	$data['s3301'] = $_POST['s3301'];
	$data['s3302'] = $_POST['s3302'];
	$data['s3399'] = $_POST['s3399'];
	$data['s94'] = $_POST['s94'];
	$data['s34'] = $_POST['s34'];
	$data['s95'] = $_POST['s95'];
	
	if (isset($idshu) AND $idshu <> 0) {
		$update = $sql_op->update('shu', $data, 'idshu ='.$idshu);
		if ($update) {
			$message='Data Sisa Hasil Usaha berhasil diperbaiki.';
		} else {
			$message=$sql_op->error.' -- Data Sisa Hasil Usaha GAGAL diperbaiki.';
		}
	} else {
		$insert = $sql_op->insert('shu', $data);
		if ($insert) {
			$message='Data Sisa Hasil Usaha berhasil disimpan.';
		} else {
			$message=$sql_op->error.' -- Data Sisa Hasil Usaha GAGAL disimpan.';
		}
	}
}

if (isset($_GET['nid']) AND $_GET['nid'] <> "") {
	// get record
	$idshu = $_GET['nid'];
	$sql_text = "SELECT s.*, p.*, k.* FROM shu as s
		LEFT JOIN periode as p ON s.idperiode = p.idperiode
		LEFT JOIN koperasi as k ON s.idkoperasi = k.idkoperasi
		WHERE s.idshu =". $idshu;
	$q_shu = $dbs->query($sql_text);
	$recShu = $q_shu->fetch_assoc();
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
        $("#enable").click(function() {
               if ($(this).is(':checked')) {
                    $('input:radio').attr("disabled", false);
               } else if ($(this).not(':checked')) {
                    $('input:radio').attr("disabled", true);
               }
        });
	});
	</script>
	<title>Kementerian KUKM - JKUK</title>
</head>

<body>
<?php
if (isset($message) AND $message <> "") {
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
echo navigation(2);
?>

		</div> <!-- /aside -->

		<hr class="noscreen" />

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>Perhitungan Hasil Usaha</h1>
			<?php
			if (isset($_GET['list'])) {
				echo "<fieldset>\n<legend>Data PHU/SHU Tersedia</legend>";
				echo listShu();
				echo '<form action="datacenter-entrydata.php" method="link"><table class="nostyle">';
				echo '<div style="text-align:right";><input type="submit" class="input-submit" value="Data Baru" /></div></form>';
				echo "</fieldset>\n";
				//echo listNonNeraca()."<br />";
				$main_content = ob_get_clean();
				die($main_content);
			}
			?>

			<!-- Form -->
			<h3 class="tit">Entry Data</h3>
			<fieldset>
				<legend>Informasi Entry Data</legend>
				<table class="nostyle">
				<form id=shuForm method=post>
				<table disabled="disabled" class="nostyle" width="100%">
					<tr>
						<td style="width:180px;">Koperasi:</td>
<?php
	$sql_text = "SELECT idkoperasi, nama from koperasi ORDER BY nama";
	$option = $dbs->query($sql_text);
    if ($_SESSION['group'] == 1) {
        echo '<td><select id="idkoperasi" name="idkoperasi" class="input-text-02">';
    } else {
    	echo '<td><input type="hidden" name="idkoperasi" value="'.$_SESSION['koperasi'].'" />';
        echo '<select id="idkoperasi" name="idkoperasi" class="input-text-02" disabled>';
    }
    echo '<option value="0">--- Pilih nama ---</option>';
	while ($choice = $option->fetch_assoc()) {
        if ($_SESSION['group'] == 1 AND $choice['idkoperasi'] == $recShu['idkoperasi']) {
            echo '<option value="'.$choice['idkoperasi'].'" SELECTED >'.$choice['nama'].'</option>';
        } else {
            if ($_SESSION['group'] <> 1 AND $choice['idkoperasi'] == $_SESSION['koperasi']) {
                echo '<option value="'.$choice['idkoperasi'].'" SELECTED >'.$choice['nama'].'</option>';
            } else {
                echo '<option value="'.$choice['idkoperasi'].'">'.$choice['nama'].'</option>';
            }
        }
	}
	unset ($choice);
	echo '</select></td>';
?>
					</tr>
					<tr>
						<td>Periode:</td>
                        <td><input id="enable" name="enable" type="checkbox" value="1" checked="" />&nbsp;Bulanan<br />
<?php
    for ($i=0; $i<12; $i++) {
        echo '<input type="radio" name="month" id="m1" value="'. sprintf("%02d",$i+1).'" ';
        if (isset($recShu['dateposting'])) {
            $m = -1+substr($recShu['dateposting'],5,2);
            if ($i == $m) {
                echo ' checked';
            }
        }
        echo '/ > '.$sysconf['months'][$i].'&nbsp;&nbsp;';
    }
    $t = date("Y");
    echo '<select id="year" name="tahun">';
    for ($i=$t; $i>$t-5; $i--) {
        echo '<option value="'.$i.'"';
        if (isset($recShu['dateposting'])) {
            $y = 0+substr($recShu['dateposting'],0,4);
            if ($i == $y) {
                echo ' SELECTED';
            }
        }
        echo ' >'.$i.'</option>';
    }
    echo '</select>';
?>
                        </td>
                    </tr>
				</table>
			</fieldset>

			<fieldset>
				<legend>Data</legend>
				<table class="nostyle">
 <tr>
 <td style="width:5px;"></td>
 <td style="width:5px;"></td>
 <td style="width:250px;"></td>
 <td></td>
 </tr>
 <tr style="background: #999">
 <td colspan="3" >I. PARTISIPASI ANGGOTA</td>
    <td><input type="text" size="40" name="s1" value="<?php isset($recShu['s1']) ? $v=$recShu['s1']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">A. Partisipasi Bruto Anggota:</td>
    <td><input type="text" size="40" name="s11" value="<?php isset($recShu['s11']) ? $v=$recShu['s11']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">1</td>
 <td>Pendapatan Jasa Pinjaman</td>
    <td><input type="text" size="40" name="s1101" value="<?php isset($recShu['s1101']) ? $v=$recShu['s1101']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">2</td>
 <td>Pendapatan Administrasi</td>
    <td><input type="text" size="40" name="s1102" value="<?php isset($recShu['s1102']) ? $v=$recShu['s1102']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">3</td>
 <td>Pendapatan Provisi</td>
    <td><input type="text" size="40" name="s1103" value="<?php isset($recShu['s1103']) ? $v=$recShu['s1103']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">4</td>
 <td>Jasa Pelayanan</td>
    <td><input type="text" size="40" name="s1104" value="<?php isset($recShu['s1104']) ? $v=$recShu['s1104']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td colspan="2">Jumlah Partisipasi Bruto Anggota (1+2+3+4)</td>
    <td><input type="text" size="40" name="s1199" value="<?php isset($recShu['s1199']) ? $v=$recShu['s1199']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">B. Beban Pokok:</td>
    <td><input type="text" size="40" name="s12" value="<?php isset($recShu['s12']) ? $v=$recShu['s12']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">5</td>
 <td>Jasa Simpanan/Tabungan dari Anggota</td>
    <td><input type="text" size="40" name="s1201" value="<?php isset($recShu['s1201']) ? $v=$recShu['s1201']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">6</td>
 <td>Jasa Simpanan Berjangka dari Anggota</td>
    <td><input type="text" size="40" name="s1202" value="<?php isset($recShu['s1202']) ? $v=$recShu['s1202']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td colspan="2">Jumlah Beban Pokok</td>
    <td><input type="text" size="40" name="s1299" value="<?php isset($recShu['s1299']) ? $v=$recShu['s1299']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td></td>
 <td>PARTISIPASI NETO ANGGOTA (A-B)</td>
    <td><input type="text" size="40" name="s1099" value="<?php isset($recShu['s1099']) ? $v=$recShu['s1099']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr style="background: #999">
 <td colspan="3">II. PENDAPATAN DAN BEBAN DARI NON ANGGOTA</td>
    <td><input type="text" size="40" name="s2" value="<?php isset($recShu['s2']) ? $v=$recShu['s2']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">7</td>
 <td>Pendapatan Jasa Pinjaman</td>
    <td><input type="text" size="40" name="s2001" value="<?php isset($recShu['s2001']) ? $v=$recShu['s2001']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">8</td>
 <td>Pendapatan Administrasi</td>
    <td><input type="text" size="40" name="s2002" value="<?php isset($recShu['s2002']) ? $v=$recShu['s2002']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">9</td>
 <td>Pendapatan Provisi</td>
    <td><input type="text" size="40" name="s2003" value="<?php isset($recShu['s2003']) ? $v=$recShu['s2003']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">10</td>
 <td>Jasa Pelayanan Non Anggota</td>
    <td><input type="text" size="40" name="s2004" value="<?php isset($recShu['s2004']) ? $v=$recShu['s2004']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">Sub Total Pendapatan non Anggota</td>
    <td><input type="text" size="40" name="s2098" value="<?php isset($recShu['s2098']) ? $v=$recShu['s2098']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">11</td>
 <td>Beban Jasa Simpanan/Tabungan dari Non Anggota</td>
    <td><input type="text" size="40" name="s2005" value="<?php isset($recShu['s2005']) ? $v=$recShu['s2005']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">12</td>
 <td>Beban Jasa Simpanan Berjangka dari Non Anggota</td>
    <td><input type="text" size="40" name="s2006" value="<?php isset($recShu['s2006']) ? $v=$recShu['s2006']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">13</td>
 <td>Beban Jasa Hutang Bank</td>
    <td><input type="text" size="40" name="s2007" value="<?php isset($recShu['s2007']) ? $v=$recShu['s2007']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">14</td>
 <td>Beban Jasa Pinjaman Pihak ke III</td>
    <td><input type="text" size="40" name="s2008" value="<?php isset($recShu['s2008']) ? $v=$recShu['s2008']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">15</td>
 <td>Beban Jasa Pinjaman LPDB</td>
    <td><input type="text" size="40" name="s2009" value="<?php isset($recShu['s2009']) ? $v=$recShu['s2009']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">16</td>
 <td>Beban Jasa Modal Penyertaan</td>
    <td><input type="text" size="40" name="s2010" value="<?php isset($recShu['s2010']) ? $v=$recShu['s2010']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">Sub Total Beban non Anggota</td>
    <td><input type="text" size="40" name="s2097" value="<?php isset($recShu['s2097']) ? $v=$recShu['s2097']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td colspan="2">Laba Rugi Kotor dengan Non Anggota (7+8+...+16)</td>
    <td><input type="text" size="40" name="s2099" value="<?php isset($recShu['s2099']) ? $v=$recShu['s2099']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td></td>
 <td>SISA HASIL USAHA KOTOR</td>
    <td><input type="text" size="40" name="s91" value="<?php isset($recShu['s91']) ? $v=$recShu['s91']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr style="background: #999">
 <td colspan="3">III. BEBAN OPERASI</td>
    <td><input type="text" size="40" name="s3" value="<?php isset($recShu['s3']) ? $v=$recShu['s3']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">C. Beban Usaha</td>
    <td><input type="text" size="40" name="s31" value="<?php isset($recShu['s31']) ? $v=$recShu['s31']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">17</td>
 <td>Beban Gaji dan Honor</td>
    <td><input type="text" size="40" name="s3101" value="<?php isset($recShu['s3101']) ? $v=$recShu['s3101']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">18</td>
 <td>Beban Lembur</td>
    <td><input type="text" size="40" name="s3102" value="<?php isset($recShu['s3102']) ? $v=$recShu['s3102']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">19</td>
 <td>Beban THR</td>
    <td><input type="text" size="40" name="s3103" value="<?php isset($recShu['s3103']) ? $v=$recShu['s3103']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">20</td>
 <td>Beban Perjalanan dalam rangka operasional Simpan  Pinjam</td>
    <td><input type="text" size="40" name="s3104" value="<?php isset($recShu['s3104']) ? $v=$recShu['s3104']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">21</td>
 <td>Beban Fotocopy dan ATK</td>
    <td><input type="text" size="40" name="s3105" value="<?php isset($recShu['s3105']) ? $v=$recShu['s3105']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">22</td>
 <td>Beban Listrik / PAM</td>
    <td><input type="text" size="40" name="s3106" value="<?php isset($recShu['s3106']) ? $v=$recShu['s3106']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">23</td>
 <td>Beban Telepon</td>
    <td><input type="text" size="40" name="s3107" value="<?php isset($recShu['s3107']) ? $v=$recShu['s3107']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">24</td>
 <td>Beban Administrasi dan Umum</td>
    <td><input type="text" size="40" name="s3108" value="<?php isset($recShu['s3108']) ? $v=$recShu['s3108']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">25</td>
 <td>Beban Rapat - rapat Komite Pinjaman</td>
    <td><input type="text" size="40" name="s3109" value="<?php isset($recShu['s3109']) ? $v=$recShu['s3109']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">26</td>
 <td>Beban Pemasaran</td>
    <td><input type="text" size="40" name="s3110" value="<?php isset($recShu['s3110']) ? $v=$recShu['s3110']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">27</td>
 <td>Beban Sewa tahun berjalan</td>
    <td><input type="text" size="40" name="s3111" value="<?php isset($recShu['s3111']) ? $v=$recShu['s3111']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">28</td>
 <td>Beban Pemeliharaan Aktiva tetap dan peralatan kantor</td>
    <td><input type="text" size="40" name="s3112" value="<?php isset($recShu['s3112']) ? $v=$recShu['s3112']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">29</td>
 <td>Beban Penyusutan Aktiva Tetap</td>
    <td><input type="text" size="40" name="s3113" value="<?php isset($recShu['s3113']) ? $v=$recShu['s3113']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">30</td>
 <td>Beban Penyisihan Penghapusan Piutang</td>
    <td><input type="text" size="40" name="s3114" value="<?php isset($recShu['s3114']) ? $v=$recShu['s3114']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">31</td>
 <td>Beban Pendidikan dan latihan Karyawan</td>
    <td><input type="text" size="40" name="s3115" value="<?php isset($recShu['s3115']) ? $v=$recShu['s3115']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">32</td>
 <td>Beban Operasional lain dalam rangka operasional Simpan Pinjam</td>
    <td><input type="text" size="40" name="s3116" value="<?php isset($recShu['s3116']) ? $v=$recShu['s3116']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td colspan="2">Jumlah Beban Usaha (16+17+18+.......+32)</td>
    <td><input type="text" size="40" name="s3199" value="<?php isset($recShu['s3199']) ? $v=$recShu['s3199']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td></td>
 <td>SISA HASIL USAHA SEBELUM BEBAN PERKOPERASIAN</td>
    <td><input type="text" size="40" name="s92" value="<?php isset($recShu['s92']) ? $v=$recShu['s92']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">D. Beban Perkoperasian</td>
    <td><input type="text" size="40" name="s32" value="<?php isset($recShu['s32']) ? $v=$recShu['s32']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">33</td>
 <td>Beban Pengawas dan pengurus koperasi</td>
    <td><input type="text" size="40" name="s3201" value="<?php isset($recShu['s3201']) ? $v=$recShu['s3201']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">34</td>
 <td>Beban Pembinaan, Pendidikan dan Pelatihan perkoperasian</td>
    <td><input type="text" size="40" name="s3202" value="<?php isset($recShu['s3202']) ? $v=$recShu['s3202']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">35</td>
 <td>Beban RAT</td>
    <td><input type="text" size="40" name="s3203" value="<?php isset($recShu['s3203']) ? $v=$recShu['s3203']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">Beban Perkoperasian Lain</td>
    <td><input type="text" size="40" name="s3298" value="<?php isset($recShu['s3298']) ? $v=$recShu['s3289']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td colspan="2">Jumlah Beban Perkoperasian</td>
    <td><input type="text" size="40" name="s3299" value="<?php isset($recShu['s3299']) ? $v=$recShu['s3299']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td></td>
 <td>SISA HASIL USAHA SETELAH BEBAN PERKOPERASIAN</td>
    <td><input type="text" size="40" name="s93" value="<?php isset($recShu['s93']) ? $v=$recShu['s93']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">E. Pendapatan dan Beban Lain - lain (yang berasal dari luar usaha simpan pinjam)</td>
    <td><input type="text" size="40" name="s33" value="<?php isset($recShu['s33']) ? $v=$recShu['s33']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">36</td>
 <td>Pendapatan Lain - lain</td>
    <td><input type="text" size="40" name="s3301" value="<?php isset($recShu['s3301']) ? $v=$recShu['s3301']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td align="right">37</td>
 <td>Beban Lain - lain</td>
    <td><input type="text" size="40" name="s3302" value="<?php isset($recShu['s3302']) ? $v=$recShu['s3302']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td colspan="2">Jumlah Pendapatan dan Beban Lain - lain</td>
    <td><input type="text" size="40" name="s3399" value="<?php isset($recShu['s3399']) ? $v=$recShu['s3399']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td></td>
 <td>SISA HASIL USAHA SEBELUM PAJAK</td>
    <td><input type="text" size="40" name="s94" value="<?php isset($recShu['s94']) ? $v=$recShu['s94']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr style="background: #CCC">
 <td>&nbsp;</td>
 <td colspan="2">F. Pajak Penghasilan Badan</td>
    <td><input type="text" size="40" name="s34" value="<?php isset($recShu['s34']) ? $v=$recShu['s34']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>SISA HASIL USAHA SETELAH PAJAK</td>
    <td><input type="text" size="40" name="s95" value="<?php isset($recShu['s95']) ? $v=$recShu['s95']: $v="0"; echo $v; ?>" class="input-text" /></td>
 </tr>
					<tr>
						<td colspan="4" class="t-right"><input type="submit" name="saveShu" class="input-submit" value="Simpan" /></td>
					</tr>
				</table>
			</fieldset>
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
