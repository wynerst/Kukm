<?php
// required file
require 'sysconfig.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/simbio_dbop.inc.php';
include "listdata.php";
include "nav_datacenter.php";
require 'lib/logs.php';

$display = true;
$err_jml = '<font color="red">&nbsp;Jumlah direvisi.</font>';
$galat = array();

// start the output buffering for main content
ob_start();

session_start();

if (isset($_POST['saveNeraca'])) {

    $sql_op = new simbio_dbop($dbs);
    $submit = $_POST['ner'];

	if (isset($_POST['updatenid'])) {
		$idcoa = $_POST['updatenid'];
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

    foreach ($submit as $key=>$value) {
        $temp = preg_replace("/[^0-9,\-]/","",$value);
        $data[$key] = preg_replace("/[^0-9\-]/",".",$temp);
    }

	$data['idkoperasi']=$_POST['idkoperasi'];

    // c1120 - Bank
    if ($data['c1120'] > 0) {
        if ($data['c1120'] <> ($data['c1121'] + $data['c1122'])) {
            $galat[3] = $err_jml;
        } else {
            $galat[3] = "";
        }
    } else {
        $data['c1120'] = $data['c1121'] + $data['c1122'];
        $galat[3] = "";
    }

    // c1140 - Piutang
    if ($data['c1140'] > 0) {
        if ($data['c1140'] <> ($data['c1141'] + $data['c1142'] + $data['c1143'] + $data['c1144'] + $data['c1145'] + $data['c1146'] + $data['c1147'] + $data['c1148'] + $data['c1149'])) {
            $data['c1140'] = $data['c1141'] + $data['c1142'] + $data['c1143'] + $data['c1144'] + $data['c1145'] + $data['c1146'] + $data['c1147'] + $data['c1148'] + $data['c1149'];
            $galat[4] = $err_jml;
        } else {
            $galat[4] = "";
        }
    } else {
        $data['c1140'] = $data['c1141'] + $data['c1142'] + $data['c1143'] + $data['c1144'] + $data['c1145'] + $data['c1146'] + $data['c1147'] + $data['c1148'] + $data['c1149'];
        $galat[4] = "";
    }

    // c11 - Aktiva lancar
    if ($data['c11'] > 0) {
        if ($data['c11'] <> ($data['c1110'] + $data['c1120'] + $data['c1130'] + $data['c1140'] + $data['c1150'] + $data['c1160'] + $data['c1190'])) {
            $galat[2] = $err_jml;
        } else {
            $galat[2] = "";
        }
    } else {
        $data['c11'] = $data['c1110'] + $data['c1120'] + $data['c1130'] + $data['c1140'] + $data['c1150'] + $data['c1160'] + $data['c1190'];
        $galat[2] = "";
    }

    // c12 - Investasi Jangka Panjang
    if ($data['c12'] > 0) {
        if ($data['c12'] <> ($data['c1210'] + $data['c1220'] + $data['c1230'])) {
            $galat[5] = $err_jml;
        } else {
            $galat[5] = "";
        }
    } else {
        $data['c12'] = $data['c1210'] + $data['c1220'] + $data['c1230'];
        $galat[5] = "";
    }
    
    // c13 - Aktiva Tetap
    if ($data['c13'] > 0) {
        if ($data['c13'] <> ($data['c1310'] + $data['c1320'] + $data['c1325'] + $data['c1330'] + $data['c1335'] + $data['c1340'] + $data['c1345'] + $data['c1390'] + $data['c1395'])) {
            $galat[6] = $err_jml;
        } else {
            $galat[6] = "";
        }
    } else {
        $data['c13'] = $data['c1310'] + $data['c1320'] + $data['c1325'] + $data['c1330'] + $data['c1335'] + $data['c1340'] + $data['c1345'] + $data['c1390'] + $data['c1395'];
        $galat[6] = "";
    }

    // c14 - Aktiva lain-lain
    if ($data['c14'] > 0) {
        if ($data['c14'] <> ($data['c1410'] + $data['c1415'])) {
            $galat[7] = $err_jml;
        } else {
            $galat[7] = "";
        }
    } else {
        $data['c14'] = $data['c1410'] + $data['c1415'];
        $galat[7] = "";
    }

    // c1 - AKTIVA
    if ($data['c1'] > 0) {
        if ($data['c1'] <> ($data['c11'] + $data['c12'] + $data['c13'] + $data['c14'])) {
            $galat[1] = $err_jml;
        } else {
            $galat[1] = "";
        }
    } else {
        $data['c1'] = $data['c11'] + $data['c12'] + $data['c13'] + $data['c14'];
        $galat[1] = "";
    }

    // c2110 - Simpanan
    if ($data['c2110'] > 0) {
        if ($data['c2110'] <> ($data['c2111'] + $data['c2112'])) {
            $galat[10] = $err_jml;
        } else {
            $galat[10] = "";
        }
    } else {
        $data['c2110'] = $data['c2111'] + $data['c2112'];
        $galat[10] = "";
    }

    // c21 - Kewajiban Lancar
    if ($data['c21'] > 0) {
        if ($data['c21'] <> ($data['c2110'] + $data['c2120'] + $data['c2130'] + $data['c2140'] + $data['c2150'] + $data['c2160'])) {
            $galat[9] = $err_jml;
        } else {
            $galat[9] = "";
        }
    } else {
        $data['c21'] = $data['c2110'] + $data['c2120'] + $data['c2130'] + $data['c2140'] + $data['c2150'] + $data['c2160'];
        $galat[9] = "";
    }

    // c22 - Kewajiban Jangka Panjang
    if ($data['c22'] > 0) {
        if ($data['c22'] <> ($data['c2210'] + $data['c2220'] + $data['c2230'] + $data['c2240'] + $data['c2250'])) {
            $galat[11] = $err_jml;
        } else {
            $galat[11] = "";
        }
    } else {
        $data['c22'] = $data['c2210'] + $data['c2220'] + $data['c2230'] + $data['c2240'] + $data['c2250'];
        $galat[11] = "";
    }
    
    // c3160 - Cadangan
    if ($data['c3160'] > 0) {
        if ($data['c3160'] <> ($data['c3161'] + $data['c3162'])) {
            $galat[13] = $err_jml;
        } else {
            $galat[13] = "";
        }
    } else {
        $data['c3160'] = $data['c3161'] + $data['c3162'];
        $galat[13] = "";
    }
    
    // c3 - Ekuitas
    if ($data['c3'] > 0) {
        if ($data['c3'] <> ($data['c3110'] + $data['c3120'] + $data['c3130'] + $data['c3140'] + $data['c3150'] + $data['c3160'] + $data['c3170'] + $data['c3180'])) {
            $galat[12] = $err_jml;
        } else {
            $galat[12] = "";
        }
    } else {
        $data['c3'] = $data['c3110'] + $data['c3120'] + $data['c3130'] + $data['c3140'] + $data['c3150'] + $data['c3160'] + $data['c3170'] + $data['c3180'];
        $galat[12] = "";
    }
	
    // c2 - Pasiva / Kewajiban dan Ekuitas
    if ($data['c2'] > 0) {
        if ($data['c2'] <> ($data['c21'] + $data['c22'] + $data['c3'])) {
            $galat[8] = $err_jml;
        } else {
            $galat[8] = "";
        }
    } else {
        $data['c2'] = $data['c21'] + $data['c22'] + $data['c3'];
        $galat[8] = "";
    }

    $recNeraca = $data;
    for ($i=1; $i<=13; $i++) {
        if ($galat[$i] <> "") {
            $kesalahan = true;
            break;
        } else {
            next;
        }
    }
    
/** Calculting Balance
 
    $balance = $data[c1] - $data[c2];
    if ($balance <> 0) {
        $kesalahan = true;
    }
**/
    
    if ($kesalahan) {
        $message=" Ada revisi perhitungan Data Neraca, perbaiki lebih dulu sebelum menyimpan kembali. (Balance = ".number_format($balance,2,',','.')." ).";
        $display = true;
    } else {
        if (isset($idcoa) AND $idcoa <> 0) {
            $update = $sql_op->update('coa', $data, 'idcoa ='.$idcoa);
            if ($update) {
                $message='Data Neraca berhasil diperbaiki.';
                recLogs("Neraca diubah - ".$idcoa, "Neraca");
                $display = false;
            } else {
                $message=$sql_op->error.' Data Neraca GAGAL diperbaiki.';
                $display = true;
            }
        } else {
            $insert = $sql_op->insert('coa', $data);
            if ($insert) {
                $message='Data Neraca berhasil disimpan.';
				$idcoa = $sql_op->insert_id;
                recLogs("Neraca ditambah - ".$idcoa, "Neraca");
                $display = false;
            } else {
                $message=$sql_op->error.' Data Neraca GAGAL disimpan.';
                $display = true;
            }
        }
    }

} else {

    if (isset($_GET['nid']) AND $_GET['nid'] <> "") {
        // get record
        $idcoa = $_GET['nid'];
        $sql_text = "SELECT c.*, k.nama FROM coa as c
            LEFT JOIN koperasi as k ON c.idkoperasi = k.idkoperasi
            WHERE c.idcoa =". $idcoa;
        $q_neraca = $dbs->query($sql_text);
        $recNeraca = $q_neraca->fetch_assoc();
    }
}

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
	<!-- required plugins -->
	<script type="text/javascript" src="js/date.js"></script>
	<!--[if IE]><script type="text/javascript" src="scripts/jquery.bgiframe.min.js"></script><![endif]-->
	
	<!-- jquery.datePicker.js -->
	<script type="text/javascript" src="js/jquery.datePicker.js"></script>
	
	<!-- datePicker required styles -->
	<link rel="stylesheet" type="text/css" media="screen" href="css/datePicker.css">
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

	$(function()
	{
		$('.date-pick').datePicker({clickInput:true})
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
				if($_SESSION['group']==1){
					echo listNeracaAdmin();
				}else{
					echo listNeraca(true);
				}
				echo '<form action="datacenter-entrysyariah.php" method="link"><table class="nostyle">';
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
	$sql_text = "SELECT idkoperasi, nama from koperasi WHERE (jenis = 3 or jenis = 5) ORDER BY nama";
	$option = $dbs->query($sql_text);
    if ($_SESSION['group'] == 1) {
    	echo '<td><select id="idkoperasi" name="idkoperasi" class="input-text-02">';
    } else {
    	echo '<td><input type="hidden" name="idkoperasi" value="'.$_SESSION['koperasi'].'" />';
    	echo '<select id="idkoperasi" name="idkoperasi" class="input-text-02" disabled>';
    }
	echo '<option value="0">--- Pilih nama ---</option>';
	while ($choice = $option->fetch_assoc()) {
		if ($choice['idkoperasi'] == $recNeraca['idkoperasi'] OR $choice['idkoperasi'] == $_SESSION['koperasi']) {
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
    if(isset($recNeraca['tahunan']) AND $recNeraca['tahunan'] > 0) {
        $tahunan = true;
        echo '<td><input id="enable" name="enable" type="checkbox" value="1" />&nbsp;Bulanan<br />';
    } else {
        $tahunan = false;
        echo '<td><input id="enable" name="enable" type="checkbox" value="1" checked="" />&nbsp;Bulanan<br />';
    }
    for ($i=0; $i<12; $i++) {
        echo '<input type="radio" name="month" id="m1" value="'. sprintf("%02d",$i+1).'" ';
        if (isset($recNeraca['dateposting'])) {
            $m = -1+substr($recNeraca['dateposting'],5,2);
            if ($i == $m) {
                echo ' checked';
            }
        }
        if ($tahunan) {
            echo ' disabled ';
        }
        echo '/ > '.$sysconf['months'][$i].'&nbsp;&nbsp;';
    }
    $t = date("Y");
    echo '<select id="year" name="tahun">';
    for ($i=$t; $i>$t-5; $i--) {
        echo '<option value="'.$i.'"';
        if (isset($recNeraca['dateposting'])) {
            $y = 0+substr($recNeraca['dateposting'],0,4);
            if ($i == $y) {
                echo ' selected';
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
<?php
if ($display) {
    $disabled = '" class="input-text" />';
} else {
    $disabled = '" class="input-text" disabled />';
	echo '<div id="menu" class="box"><ul class="box f-right"><li><a href="?nid='.$idcoa.'"><span><strong>Edit</strong></span></a></li></ul></div>';
}
?>

			<fieldset>
				<legend>Data</legend>
<table class="nostyle">
  <tr style="background: #999">
    <td style="width:5px;">1</td>
    <td style="width:5px;"></td>
    <td style="width:250px;">AKTIVA</td>
    <td><input type="text" size="40" name="ner[c1]" value="<?php isset($recNeraca['c1']) ? $v=$recNeraca['c1']: $v="0"; echo number_format($v,2,',','.').'" class="input-text" disabled />'.$galat[1]; ?></td>
  </tr>
  <tr style="background: #CCC">
    <td>11</td>
    <td></td>
    <td>AKTIVA LANCAR</td>
    <td><input type="text" size="40" name="ner[c11]" value="<?php isset($recNeraca['c11']) ? $v=$recNeraca['c11']: $v="0"; echo number_format($v,2,',','.').'" class="input-text" disabled />'.$galat[2]; ?></td>
  </tr>
  <tr>
    <td>1110</td>
    <td></td>
    <td>Kas</td>
    <td><input type="text" size="40" name="ner[c1110]" value="<?php isset($recNeraca['c1110']) ? $v=$recNeraca['c1110']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1120</td>
    <td></td>
    <td>Bank</td>
    <td><input type="text" size="40" name="ner[c1120]" value="<?php isset($recNeraca['c1120']) ? $v=$recNeraca['c1120'] : $v="0"; echo number_format($v,2,',','.').'" class="input-text" disabled />'.$galat[3]; ?></td>
  </tr>
  <tr>
    <td></td>
    <td>1121</td>
    <td>Giro</td>
    <td><input type="text" size="40" name="ner[c1121]" value="<?php isset($recNeraca['c1121']) ? $v=$recNeraca['c1121']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td></td>
    <td>1122</td>
    <td>Sertifikat Deposito</td>
    <td><input type="text" size="40" name="ner[c1122]" value="<?php isset($recNeraca['c1122']) ? $v=$recNeraca['c1122']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1130</td>
    <td></td>
    <td>Surat Berharga/Investasi Jangka Pendek</td>
    <td><input type="text" size="40" name="ner[c1130]" value="<?php isset($recNeraca['c1130']) ? $v=$recNeraca['c1130']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1140</td>
    <td></td>
    <td>Piutang</td>
    <td><input type="text" size="40" name="ner[c1140]" value="<?php isset($recNeraca['c1140']) ? $v=$recNeraca['c1140']: $v="0"; echo number_format($v,2,',','.').'" class="input-text" disabled />'.$galat[4]; ?></td>
  </tr>
  <tr>
    <td></td>
    <td>1141</td>
    <td>Pembiayaan Murabahah</td>
    <td><input type="text" size="40" name="ner[c1141]" value="<?php isset($recNeraca['c1141']) ? $v=$recNeraca['c1141']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td></td>
    <td>1142</td>
    <td>Pembiayaan Mudharabah</td>
    <td><input type="text" size="40" name="ner[c1142]" value="<?php isset($recNeraca['c1142']) ? $v=$recNeraca['c1142']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td></td>
    <td>1143</td>
    <td>Pembiayaan Musyarakah</td>
    <td><input type="text" size="40" name="ner[c1143]" value="<?php isset($recNeraca['c1143']) ? $v=$recNeraca['c1143']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td></td>
    <td>1144</td>
    <td>Pembiayaan Qodul hasan</td>
    <td><input type="text" size="40" name="ner[c1144]" value="<?php isset($recNeraca['c1144']) ? $v=$recNeraca['c1144']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td></td>
    <td>1145</td>
    <td>Pembiayaan Salam</td>
    <td><input type="text" size="40" name="ner[c1145]" value="<?php isset($recNeraca['c1145']) ? $v=$recNeraca['c1145']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td></td>
    <td>1146</td>
    <td>Pembiayaan Istishna</td>
    <td><input type="text" size="40" name="ner[c1146]" value="<?php isset($recNeraca['c1146']) ? $v=$recNeraca['c1146']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td></td>
    <td>1147</td>
    <td>Pembiayaan Ijarah</td>
    <td><input type="text" size="40" name="ner[c1147]" value="<?php isset($recNeraca['c1147']) ? $v=$recNeraca['c1147']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td></td>
    <td>1148</td>
    <td>Pembiayaan Syariah lainnya</td>
    <td><input type="text" size="40" name="ner[c1148]" value="<?php isset($recNeraca['c1148']) ? $v=$recNeraca['c1148']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td></td>
    <td>1149</td>
    <td>Penyisihan Piutang Tak tertagih</td>
    <td><input type="text" size="40" name="ner[c1149]" value="<?php isset($recNeraca['c1149']) ? $v=$recNeraca['c1149']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1150</td>
    <td></td>
    <td>Beban Dibayar Dimuka</td>
    <td><input type="text" size="40" name="ner[c1150]" value="<?php isset($recNeraca['c1150']) ? $v=$recNeraca['c1150']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1160</td>
    <td></td>
    <td>Pendapatan Akan Diterima</td>
    <td><input type="text" size="40" name="ner[c1160]" value="<?php isset($recNeraca['c1160']) ? $v=$recNeraca['c1160']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1190</td>
    <td></td>
    <td>Aktiva Lancar lainnya</td>
    <td><input type="text" size="40" name="ner[c1190]" value="<?php isset($recNeraca['c1190']) ? $v=$recNeraca['c1190']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr style="background: #CCC">
    <td>12</td>
    <td></td>
    <td>INVESTASI JANGKA PANJANG</td>
    <td><input type="text" size="40" name="ner[c12]" value="<?php isset($recNeraca['c12']) ? $v=$recNeraca['c12']: $v="0"; echo number_format($v,2,',','.').'" class="input-text" disabled />'.$galat[5]; ?></td>
  </tr>
  <tr>
    <td>1210</td>
    <td></td>
    <td>Penyertaan Pada Koperasi Sekundair / Lainnya</td>
    <td><input type="text" size="40" name="ner[c1210]" value="<?php isset($recNeraca['c1210']) ? $v=$recNeraca['c1210']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1220</td>
    <td></td>
    <td>Investasi Pada Surat Berharga</td>
    <td><input type="text" size="40" name="ner[c1220]" value="<?php isset($recNeraca['c1220']) ? $v=$recNeraca['c1220']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1230</td>
    <td></td>
    <td>Investasi Jangka Panjang Lain</td>
    <td><input type="text" size="40" name="ner[c1230]" value="<?php isset($recNeraca['c1230']) ? $v=$recNeraca['c1230']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr style="background: #CCC">
    <td>13</td>
    <td></td>
    <td>AKTIVA TETAP</td>
    <td><input type="text" size="40" name="ner[c13]" value="<?php isset($recNeraca['c13']) ? $v=$recNeraca['c13']: $v="0"; echo number_format($v,2,',','.').'" class="input-text" disabled />'.$galat[6]; ?></td>
  </tr>
  <tr>
    <td>1310</td>
    <td></td>
    <td>Tanah</td>
    <td><input type="text" size="40" name="ner[c1310]" value="<?php isset($recNeraca['c1310']) ? $v=$recNeraca['c1310']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1320</td>
    <td></td>
    <td>Bangunan / Gedung</td>
    <td><input type="text" size="40" name="ner[c1320]" value="<?php isset($recNeraca['c1320']) ? $v=$recNeraca['c1320']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1325</td>
    <td></td>
    <td>Akumulasi Penyusutan Bangunan / Gedung</td>
    <td><input type="text" size="40" name="ner[c1325]" value="<?php isset($recNeraca['c1325']) ? $v=$recNeraca['c1325']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1330</td>
    <td></td>
    <td>Kendaraan</td>
    <td><input type="text" size="40" name="ner[c1330]" value="<?php isset($recNeraca['c1330']) ? $v=$recNeraca['c1330']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1335</td>
    <td></td>
    <td>Akumulasi Penyusutan Kendaraan</td>
    <td><input type="text" size="40" name="ner[c1335]" value="<?php isset($recNeraca['c1335']) ? $v=$recNeraca['c1335']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1340</td>
    <td></td>
    <td>Inventaris</td>
    <td><input type="text" size="40" name="ner[c1340]" value="<?php isset($recNeraca['c1340']) ? $v=$recNeraca['c1340']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1345</td>
    <td></td>
    <td>Akumulasi Penyusutan Inventaris</td>
    <td><input type="text" size="40" name="ner[c1345]" value="<?php isset($recNeraca['c1345']) ? $v=$recNeraca['c1345']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1390</td>
    <td></td>
    <td>Aktiva Tetap Lain</td>
    <td><input type="text" size="40" name="ner[c1390]" value="<?php isset($recNeraca['c1390']) ? $v=$recNeraca['c1390']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1395</td>
    <td></td>
    <td>Akumulasi Penyusutan Lain-lain</td>
    <td><input type="text" size="40" name="ner[c1395]" value="<?php isset($recNeraca['c1395']) ? $v=$recNeraca['c1395']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr style="background: #CCC">
    <td>14</td>
    <td></td>
    <td>AKTIVA LAIN - LAIN</td>
    <td><input type="text" size="40" name="ner[c14]" value="<?php isset($recNeraca['c14']) ? $v=$recNeraca['c14']: $v="0"; echo number_format($v,2,',','.').'" class="input-text" disabled />'.$galat[7]; ?></td>
  </tr>
  <tr>
    <td>1410</td>
    <td></td>
    <td>Beban Ditangguhkan</td>
    <td><input type="text" size="40" name="ner[c1410]" value="<?php isset($recNeraca['c1410']) ? $v=$recNeraca['c1410']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>1415</td>
    <td></td>
    <td>Amortisasi Beban Ditangguhkan*</td>
    <td><input type="text" size="40" name="ner[c1415]" value="<?php isset($recNeraca['c1415']) ? $v=$recNeraca['c1415']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr style="background: #999">
    <td>2</td>
    <td></td>
    <td>KEWAJIBAN</td>
    <td><input type="text" size="40" name="ner[c2]" value="<?php isset($recNeraca['c2']) ? $v=$recNeraca['c2']: $v="0"; echo number_format($v,2,',','.').'" class="input-text" disabled />'.$galat[8]; ?></td>
    <td></td>
  </tr>
  <tr style="background: #CCC">
    <td>21</td>
    <td></td>
    <td>KEWAJIBAN LANCAR</td>
    <td><input type="text" size="40" name="ner[c21]" value="<?php isset($recNeraca['c21']) ? $v=$recNeraca['c21']: $v="0"; echo number_format($v,2,',','.').'" class="input-text" disabled />'.$galat[9]; ?></td>
  </tr>
  <tr>
    <td>2110</td>
    <td></td>
    <td>Simpanan</td>
    <td><input type="text" size="40" name="ner[c2110]" value="<?php isset($recNeraca['c2110']) ? $v=$recNeraca['c2110']: $v="0"; echo number_format($v,2,',','.').'" class="input-text" disabled />'.$galat[10]; ?></td>
  </tr>
  <tr>
    <td></td>
    <td>2111</td>
    <td>Simpanan Wadiah</td>
    <td><input type="text" size="40" name="ner[c2111]" value="<?php isset($recNeraca['c2111']) ? $v=$recNeraca['c2111']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td></td>
    <td>2112</td>
    <td>Simpanan Mudharabah Berjangka (kurang 1 tahun)</td>
    <td><input type="text" size="40" name="ner[c2112]" value="<?php isset($recNeraca['c2112']) ? $v=$recNeraca['c2112']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>2120</td>
    <td></td>
    <td>Titipan Dana Bagian Zis</td>
    <td><input type="text" size="40" name="ner[c2120]" value="<?php isset($recNeraca['c2120']) ? $v=$recNeraca['c2120']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>2130</td>
    <td></td>
    <td>Beban Yang Masih Harus Dibayar</td>
    <td><input type="text" size="40" name="ner[c2130]" value="<?php isset($recNeraca['c2130']) ? $v=$recNeraca['c2130']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>2140</td>
    <td></td>
    <td>Pendapatan Diterima Dimuka</td>
    <td><input type="text" size="40" name="ner[c2140]" value="<?php isset($recNeraca['c2140']) ? $v=$recNeraca['c2140']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>2150</td>
    <td></td>
    <td>Hutang Bank (Bagian jatuh tempo kurang 1 tahun)</td>
    <td><input type="text" size="40" name="ner[c2150]" value="<?php isset($recNeraca['c2150']) ? $v=$recNeraca['c2150']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>2160</td>
    <td></td>
    <td>Kewajiban Lain-lain (Bagian jatuh tempo kurang 1 tahun)</td>
    <td><input type="text" size="40" name="ner[c2160]" value="<?php isset($recNeraca['c2160']) ? $v=$recNeraca['c2160']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr style="background: #CCC">
    <td>22</td>
    <td></td>
    <td>KEWAJIBAN JANGKA PANJANG</td>
    <td><input type="text" size="40" name="ner[c22]" value="<?php isset($recNeraca['c22']) ? $v=$recNeraca['c22']: $v="0"; echo number_format($v,2,',','.').'" class="input-text" disabled />'.$galat[11]; ?></td>
  </tr>
  <tr>
    <td>2210</td>
    <td></td>
    <td>Simpanan Berjangka (lebih 1 tahun)</td>
    <td><input type="text" size="40" name="ner[c2210]" value="<?php isset($recNeraca['c2210']) ? $v=$recNeraca['c2210']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>2220</td>
    <td></td>
    <td>Hutang Bank</td>
    <td><input type="text" size="40" name="ner[c2220]" value="<?php isset($recNeraca['c2220']) ? $v=$recNeraca['c2220']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>2230</td>
    <td></td>
    <td>Hutang ke LPDB</td>
    <td><input type="text" size="40" name="ner[c2230]" value="<?php isset($recNeraca['c2230']) ? $v=$recNeraca['c2230']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>2240</td>
    <td></td>
    <td>Hutang Jangka Panjang Lain</td>
    <td><input type="text" size="40" name="ner[c2240]" value="<?php isset($recNeraca['c2240']) ? $v=$recNeraca['c2240']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>2250</td>
    <td></td>
    <td>Pembiayaan Syariah lainnya (lebih 1 tahun)</td>
    <td><input type="text" size="40" name="ner[c2250]" value="<?php isset($recNeraca['c2250']) ? $v=$recNeraca['c2250']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr style="background: #999">
    <td>3</td>
    <td></td>
    <td>EKUITAS</td>
    <td><input type="text" size="40" name="ner[c3]" value="<?php isset($recNeraca['c3']) ? $v=$recNeraca['c3']: $v="0"; echo number_format($v,2,',','.').'" class="input-text" disabled />'.$galat[12]; ?></td>
  </tr>
  <tr>
    <td>3110</td>
    <td></td>
    <td>Simpanan Pokok/Modal Disetor</td>
    <td><input type="text" size="40" name="ner[c3110]" value="<?php isset($recNeraca['c3110']) ? $v=$recNeraca['c3110']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>3120</td>
    <td></td>
    <td>Simpanan Wajib/Tambahan Modal Disetor</td>
    <td><input type="text" size="40" name="ner[c3120]" value="<?php isset($recNeraca['c3120']) ? $v=$recNeraca['c3120']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>3130</td>
    <td></td>
    <td>Modal Penyetaraan</td>
    <td><input type="text" size="40" name="ner[c3130]" value="<?php isset($recNeraca['c3130']) ? $v=$recNeraca['c3130']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>3140</td>
    <td></td>
    <td>Modal Penyertaan</td>
    <td><input type="text" size="40" name="ner[c3140]" value="<?php isset($recNeraca['c3140']) ? $v=$recNeraca['c3140']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>3150</td>
    <td></td>
    <td>Hibah / Donasi</td>
    <td><input type="text" size="40" name="ner[c3150]" value="<?php isset($recNeraca['c3150']) ? $v=$recNeraca['c3150']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>3160</td>
    <td></td>
    <td>Cadangan</td>
    <td><input type="text" size="40" name="ner[c3160]" value="<?php isset($recNeraca['c3160']) ? $v=$recNeraca['c3160']: $v="0"; echo number_format($v,2,',','.').'" class="input-text" disabled />'.$galat[13]; ?></td>
  </tr>
  <tr>
    <td></td>
    <td>3161</td>
    <td>Cadangan Umum</td>
    <td><input type="text" size="40" name="ner[c3161]" value="<?php isset($recNeraca['c3161']) ? $v=$recNeraca['c3161']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td></td>
    <td>3162</td>
    <td>Cadangan Resiko</td>
    <td><input type="text" size="40" name="ner[c3162]" value="<?php isset($recNeraca['c3162']) ? $v=$recNeraca['c3162']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>3170</td>
    <td></td>
    <td>SHU Tahun Lalu Belum Dibagi</td>
    <td><input type="text" size="40" name="ner[c3170]" value="<?php isset($recNeraca['c3170']) ? $v=$recNeraca['c3170']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
  <tr>
    <td>3180</td>
    <td></td>
    <td>SHU Tahun Berjalan</td>
    <td><input type="text" size="40" name="ner[c3180]" value="<?php isset($recNeraca['c3180']) ? $v=$recNeraca['c3180']: $v="0"; echo number_format($v,2,',','.').$disabled; ?></td>
  </tr>
<?php
if ($display) {
echo '    <tr>
        <td colspan="4" class="t-right"><input type="submit" name="saveNeraca" class="input-submit" value="Submit" /></td>
    </tr>';
} else {
echo '&nbsp;';
}
?>
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
