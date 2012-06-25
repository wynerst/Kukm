<?php
// required file
require 'sysconfig.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/simbio_dbop.inc.php';
include "listdata.php";
include "nav_datacenter.php";

if (isset($_POST['saveHarian'])) {

    $sql_op = new simbio_dbop($dbs);

    if (isset($_POST['updatenid'])) {
        $idday = $_POST['updatenid'];
    }
    $data['idkoperasi']=$_POST['idkoperasi'];
    $data['periode']=$_POST['periode'];
    $data['h1']=$_POST['h1'];
    $data['h2']=$_POST['h2'];
    $data['h3']=$_POST['h3'];
    $data['h4']=$_POST['h4'];
    $data['h5']=$_POST['h5'];
    $data['h6']=$_POST['h6'];
    $data['h7']=$_POST['h7'];
    $data['h8']=$_POST['h8'];
    $data['h9']=$_POST['h9'];
    $data['h10']=(($_POST['h101']+(0.5*$_POST['h102'])+(0.75*$_POST['h103']))/$_POST['h2']);
    $data['h101']=$_POST['h101'];
    $data['h102']=$_POST['h102'];
    $data['h103']=$_POST['h103'];
    $data['iduser']=$_POST['iduser'];
    
    if (isset($idday) AND $idday <> 0) {
        $update = $sql_op->update('harian', $data, 'idday ='.$idday);
        if ($update) {
            $message='Data Harian berhasil diperbaiki.';
        } else {
            $message=$sql_op->error.' Data Harian GAGAL diperbaiki.';
        }
    } else {
        $insert = $sql_op->insert('harian', $data);
        if ($insert) {
            $message='Data Harian berhasil disimpan.';
        } else {
            $message=$sql_op->error.' Data Harian GAGAL disimpan.';
        }
    }
}

if (isset($_GET['nid']) AND $_GET['nid'] <> "") {
    // get record
    $idday = $_GET['nid'];
    $sql_text = "SELECT h.*, k.nama FROM harian as h
        LEFT JOIN koperasi as k ON h.idkoperasi = k.idkoperasi
        WHERE h.idday =". $idday;
    $q_harian = $dbs->query($sql_text);
    if ($q_harian) {
        $recHarian = $q_harian->fetch_assoc();
    } else {
        $message = "Data tidak ditemukan.";
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

            <h1>Data Pendukung Finansial Lain</h1>
            <?php
            if (isset($_GET['list'])) {
                echo "<fieldset>\n<legend>Data Pendukung Finansial Tersedia</legend>";
                //echo listHarian();
                echo listFinasial();
				echo '<div id="menu" class="box">';
				echo '<ul class="box f-right">';
				echo '	<li><a href="datacenter-entrydata-pendukung.php?list"><span><strong>Data Pendukung Lain</strong></span></a></li>';
				echo '	<li><a href="datacenter-entrydata-finansial.php"><span><strong>Data Baru</strong></span></a></li>';
				echo '</ul>';
				echo '</div>';
/**
                echo '<form action="datacenter-entrydata-finansial.php" method="link"><table class="nostyle">';
                echo '<div style="text-align:right";><input type="submit" class="input-submit" value="Data Baru" /></div></form>';
**/
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
    if ($_SESSION['group'] == 1) {
        echo '<td><select id="jenis" name="idkoperasi" class="input-text-02">';
    } else {
        echo '<td><select id="jenis" name="idkoperasi" class="input-text-02" disabled>';
    }
    echo '<option value="0">--- Pilih nama ---</option>';
    while ($choice = $option->fetch_assoc()) {
        if ($choice['idkoperasi'] == $recHarian['idkoperasi'] OR $choice['idkoperasi'] == $_SESSION['koperasi']) {
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
    $sql_text = "SELECT DISTINCT substring(dateposting,1,10) as idperiode from coa";
    if ($_SESSION['group'] == 2) {
        $sql_text .= " WHERE idkoperasi=".$_SESSION['koperasi'];
    }
    $sql_text .= " ORDER BY dateposting DESC";
    $option = $dbs->query($sql_text);
    echo '<td><select id="periode" name="periode" class="input-text-2">"';
    echo '<option value="">--- Periode pelaporan ---</option>';
    while ($choice = $option->fetch_assoc()) {
        if (isset($recHarian['periode']) and  $recHarian['periode'] == $choice['idperiode']) {
            echo '<option value="'.$choice['idperiode'].'" SELECTED >'.$choice['idperiode'].'</option>';
        } else {
            echo '<option value="'.$choice['idperiode'].'">'.$choice['idperiode'].'</option>';
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
    <td style="width:5px;"><b>No.</b></td>
    <td style="width:250px;"><b>Data pendukung finansial koperasi</b></td>
    <td></td>
  </tr>
  <tr>
    <td>1</td>
    <td>Total Penerimaan Simpanan</td>
    <td><input type="text" size="40" name="h1" value="<?php echo isset($recHarian['h1']) ? $recHarian['h1'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>2</td>
    <td>Total Pemberian Pinjaman</td>
    <td><input type="text" size="40" name="h2" value="<?php echo isset($recHarian['h2']) ? $recHarian['h2'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>3</td>
    <td>Modal dalam</td>
    <td><input type="text" size="40" name="h3" value="<?php echo isset($recHarian['h3']) ? $recHarian['h3'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>4</td>
    <td>Modal luar</td>
    <td><input type="text" size="40" name="h4" value="<?php echo isset($recHarian['h4']) ? $recHarian['h4'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>5</td>
    <td>Volume Usaha</td>
    <td><input type="text" size="40" name="h5" value="<?php echo isset($recHarian['h5']) ? $recHarian['h5'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>6</td>
    <td>Asset</td>
    <td><input type="text" size="40" name="h6" value="<?php echo isset($recHarian['h6']) ? $recHarian['h6'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>7</td>
    <td>SHU</td>
    <td><input type="text" size="40" name="h7" value="<?php echo isset($recHarian['h7']) ? $recHarian['h7'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>8</td>
    <td>Suku Bunga simpanan</td>
    <td><input type="text" size="40" name="h8" value="<?php echo isset($recHarian['h8']) ? $recHarian['h8'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>9</td>
    <td>Suku bunga pinjaman</td>
    <td><input type="text" size="40" name="h9" value="<?php echo isset($recHarian['h9']) ? $recHarian['h9'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr style="background: #999">
    <td style="width:5px;">10</td>
    <td style="width:250px;"><b>NPL/Non Performing Loan</b></td>
    <td></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Pinjaman Kurang Lancar/PKL</td>
    <td><input type="text" size="40" name="h102" value="<?php echo isset($recHarian['h102']) ? $recHarian['h102'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Pinjaman Diragukan</td>
    <td><input type="text" size="40" name="h103" value="<?php echo isset($recHarian['h103']) ? $recHarian['h103'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Pinjaman Macet</td>
    <td><input type="text" size="40" name="h101" value="<?php echo isset($recHarian['h101']) ? $recHarian['h101'] : "0"; ?>" class="input-text" /></td>
  </tr>
  <tr>
    <td colspan="4" class="t-right"><input type="submit" name="saveHarian" class="input-submit" value="Submit" /></td>
  </tr>
</table>
            </fieldset>
<?php
if (isset($idday)) {
    echo '<input type="hidden" name="updatenid" value="'.$idday.'"/>';
}
    echo '<input type="hidden" name="iduser" value="'.$_SESSION['userID'].'"/>';
?>
</form>
        </div> <!-- /content -->

    </div> <!-- /cols -->

    <hr class="noscreen" />

    <!-- Footer -->
    <div id="footer" class="box">

        <p class="f-left">&copy; 2012 <a href="#">Departemen Koperasi dan UKM</a>, All Rights Reserved &reg;</p>

        <p class="f-right">Templates by <a href="http://www.adminizio.com/">Adminizio</a></p>

    </div> <!-- /footer -->

</div> <!-- /main -->

</body>
</html>
<?php
// main content grab
$main_content = ob_get_clean();

echo $main_content;
