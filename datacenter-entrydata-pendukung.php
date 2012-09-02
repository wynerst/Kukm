<?php
// required file
require 'sysconfig.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/simbio_dbop.inc.php';
include "listdata.php";
include "nav_datacenter.php";
require 'lib/logs.php';

// start the output buffering for main content
ob_start();

session_start();

if (isset($_POST['saveNon'])) {

    $sql_op = new simbio_dbop($dbs);
    $submit = $_POST['non'];

    if (isset($_POST['updatenid'])) {
        $idncoa = $_POST['updatenid'];
    }
    $data['idkoperasi'] = $_POST['idkoperasi'];
    $data['periode'] = $_POST['periode'];
    foreach ($submit as $key=>$value) {
        $temp = preg_replace("/[^0-9,]/","",$value);
        $data[$key] = preg_replace("/[^0-9]/",".",$temp);
    }

    // Error Handling
    $isError = false;
    $date1 = new datetime("now");
    $date2 = date_create($data['dateposting']);
    if ($date1 < $date2) {
        $isError = true;
        $message = 'Periode pelaporan tidak mungkin lebih besar dari hari ini.';
    }
    
    if (!$isError) {

        if (isset($idncoa) AND $idncoa <> 0) {
            $update = $sql_op->update('non_coa', $data, 'idnon_coa ='.$idncoa);
            if ($update) {
                $message = 'Data Non-Neraca berhasil diperbaiki.';
                recLogs("Pengukung diubah - ".$idncoa, "Pendukung");
            } else {
                $message = $sql_op->error.' -- Data Non-Neraca GAGAL diperbaiki.';
            }
        } else {
            $insert = $sql_op->insert('non_coa', $data);
            if ($insert) {
                $message = 'Data Non-Neraca berhasil disimpan.';
                $idncoa = $sql_op->insert_id;
                recLogs("Pendukung ditambah - ".$idncoa, "Pendukung");
            } else {
                $message = $sql_op->error.' -- Data Non-Neraca GAGAL disimpan.';
            }
        }
    }

}

if (isset($_GET['nid']) AND $_GET['nid'] <> "") {
    // get record
    $idncoa = $_GET['nid'];
    $sql_text = "SELECT n.*, k.* FROM non_coa as n
        LEFT JOIN koperasi as k ON n.idkoperasi = k.idkoperasi
        WHERE n.idnon_coa =". $idncoa;
    $q_ncoa = $dbs->query($sql_text);
    $recNon = $q_ncoa->fetch_assoc();
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
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/jquery.easy-confirm-dialog.js"></script>
	<link type="text/css" rel="stylesheet" href="css/jquery-ui.css" />
    <script type="text/javascript">
    $(document).ready(function(){
        $(".tabs > ul").tabs();
   		$(".confirm").easyconfirm();
		$("#alert").click(function() {
			alert("You approved the action");
		});
    });
    </script>
   	<style type="text/css">
	.ui-dialog { font-size: 11px; }
	</style>
    <title>Kementerian KUKM - JKUK</title>
</head>

<body>
<?php
    if (isset($message)) {
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
echo navigation(3);
?>

        </div> <!-- /aside -->

        <hr class="noscreen" />

        <!-- Content (Right Column) -->
        <div id="content" class="box">

            <h1>Data Pendukung Lain</h1>
            <?php
            if (isset($_GET['list'])) {
                echo "<fieldset>\n<legend>Data Pendukung Lain</legend>";
                echo '<div id="menu" class="box">
                    <ul class="box f-right">
                        <li><a href="datacenter-entrydata-finansial.php?list"><span><strong>Data pendukung finansial</strong></span></a></li>
                    </ul>
                    </div><br/>';
                echo listNonNeraca();
                   echo '<div id="menu" class="box">';
                echo '<ul class="box f-right">';
                echo '    <li><a href="datacenter-entrydata-finansial.php?list"><span><strong>Data Pendukung Finansial</strong></span></a></li>';
                echo '    <li><a href="datacenter-entrydata-pendukung.php"><span><strong>Data Baru</strong></span></a></li>';
                echo '</ul>';
                echo '</div>';

/**
                  echo '<form action="datacenter-entrydata-pendukung.php" method="link"><table class="nostyle">';
                echo '<div style="text-align:right";><input type="submit" class="input-submit" value="Data Baru" /></div></form>';
                echo "</fieldset>\n";
**/                //echo listNonNeraca()."<br />";
                $main_content = ob_get_clean();
                die($main_content);
            }
            ?>

            <!-- Form -->
            <form id=nonForm method=post>
            <h3 class="tit">Entry Data</h3>
            <fieldset>
                <legend>Informasi Entry Data</legend>
                <table class="nostyle">
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
        if ($choice['idkoperasi'] == $recNon['idkoperasi'] OR $choice['idkoperasi'] == $_SESSION['koperasi']) {
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
/**
    $sql_text = "SELECT idperiode, periode from periode ORDER BY finaldate DESC";
    $option = $dbs->query($sql_text);
    echo '<td><select id="periode" name="idperiode" class="input-text-2">"';
    echo '<option value="">--- Periode pelaporan ---</option>';
    while ($choice = $option->fetch_assoc()) {
        if ($choice['idperiode'] == $recNon['idperiode']) {
            echo '<option value="'.$choice['idperiode'].'" SELECTED >'.$choice['periode'].'</option>';
        } else {
            echo '<option value="'.$choice['idperiode'].'">'.$choice['periode'].'</option>';
        }
    }
    echo '</select></td>';
**/
?>
                    <td><input id="periode" name="periode" class="input-text-2" value="<?php echo isset($recNon['periode']) ? $recNon['periode'] : "Gunakan format YYYY-MM-DD"; ?>" /></td>
                    </tr>
                </table>
            </fieldset>

            <fieldset>
                <legend>Data</legend>
<table class="nostyle">
  <tr style="background: #999">
    <td style="width:5px;"><b>No.</b></td>
    <td style="width:250px;"><b>Data Pendukung Non Finansial</b></td>
    <td></td>
  </tr>
  <tr>
    <td>1</td>
    <td>Jumlah Penasehat/Pengawas</td>
    <td><input type="text" size="40" name="non[pengawas]" value="<?php echo isset($recNon['pengawas']) ? $recNon['pengawas'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>2</td>
    <td>Jumlah Pengurus</td>
    <td><input type="text" size="40" name="non[pengurus]" value="<?php echo isset($recNon['pengurus']) ? $recNon['pengurus'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>3</td>
    <td>Jumlah Karyawan</td>
    <td><input type="text" size="40" name="non[karyawan]" value="<?php echo isset($recNon['karyawan']) ? $recNon['karyawan'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>4</td>
    <td>Jumlah Anggota</td>
    <td><input type="text" size="40" name="non[anggota]" value="<?php echo isset($recNon['anggota']) ? $recNon['anggota'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>5</td>
    <td>Jumlah Calon Anggota/Anggota tidak tetap</td>
    <td><input type="text" size="40" name="non[calon_anggota]" value="<?php echo isset($recNon['calon_anggota']) ? $recNon['calon_anggota'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td colspan="4" class="t-right"><input type="submit" name="saveNon" class="input-submit" value="Submit" /></td>
  </tr>
</table>
            </fieldset>

            <?php
if (isset($idncoa)) {
    echo '<input type="hidden" name="updatenid" value="'.$idncoa.'"/>';
}
echo '<input type="hidden" name="iduser" value="'.$_SESSION['userID'].'"/>';
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
