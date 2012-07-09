<?php
// required file
require 'sysconfig.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/simbio_dbop.inc.php';
include "listdata.php";
include "nav_panel.php";

if (isset($_POST['saveUser'])) {

    $sql_op = new simbio_dbop($dbs);

	if (isset($_POST['updatenid'])) {
		$iduser = $_POST['updatenid'];
	} else {
        $data['group_idgroup']=$_POST['group_idgroup'];
    }
	$data['nama'] = $_POST['nama'];
	$data['koperasi_idkoperasi'] = $_POST['koperasi_idkoperasi'];
	$data['divisi']=$_POST['divisi'];
	$data['telp']=$_POST['telp'];
	$data['email']=$_POST['email'];
	$data['fax']=$_POST['fax'];
    $data['login']=$_POST['login'];
    $data['validasi']=$_POST['validasi'];

    if ($_POST['password'] <> "") {
        $data['password']=$_POST['password'];
    }

	if (isset($iduser) AND $iduser <> 0) {
		$update = $sql_op->update('user', $data, 'iduser ='.$iduser);
//		print_r($data);
//		die();
		if ($update) {
			$message = 'Data User berhasil diperbaiki.';
		} else {
			$message = 'Data User GAGAL diperbaiki. '.$update->error;
		}
	}

}

if (isset($_GET['nid']) AND $_GET['nid'] <> "") {
	// get record
	$iduser = $_GET['nid'];
	$sql_text = "SELECT * FROM user WHERE iduser =". $iduser;
	$q_user = $dbs->query($sql_text);
	$recNon = $q_user->fetch_assoc();
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
if (isset($message) AND $message<>"") {
    echo '<script type="text/javascript">alert(\''.$message.'\');';
    echo 'location.href = \'panel-daftaruser.php?list\';</script>';
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

<?php
echo menutop(3);
?>
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

			<h1>Panel</h1>

			<!-- Headings -->
<?php
    if (isset($iduser) AND $iduser <> 0) {

		echo '<h3 class="tit">Edit User</h2>';

?>
<form id='form_user' action="panel-daftaruser.php" method="post">

<table class="nostyle">
  <tr>
    <td>Kode Login</td>
    <td><input type="text" size="40" name="login" value="<?php echo isset($recNon['login']) ? $recNon['login'] : ""; ?>" class="input-text-02" <?php echo isset($iduser)? "disabled" : ""; ?> /></td>
  </tr>
  <tr>
    <td>Nama</td>
    <td><input type="text" size="40" name="nama" value="<?php echo isset($recNon['nama']) ? $recNon['nama'] : ""; ?>" class="input-text-02" /></td>
  </tr>
  <tr>
    <td>Koperasi</td>
<?php
	$sql_text = "SELECT idkoperasi, nama from koperasi ORDER BY nama";
	$option = $dbs->query($sql_text);
	echo '<td><select id="jenis" name="koperasi_idkoperasi" class="input-text-02">"';
	echo '<option value="0">--- Pilih Koperasi ---</option>';
	while ($choice = $option->fetch_assoc()) {
		if ($choice['idkoperasi'] == $recNon['koperasi_idkoperasi']) {
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
    <td>Email</td>
    <td><input type="text" size="40" name="email" value="<?php echo isset($recNon['email']) ? $recNon['email'] : ""; ?>" class="input-text-02" /></td>
  </tr>
  <tr>
    <td>Divisi / Bagian</td>
    <td><input type="text" size="40" name="divisi" value="<?php echo isset($recNon['divisi']) ? $recNon['divisi'] : ""; ?>" class="input-text-02" /></td>
  </tr>
  <tr>
    <td>Telpon</td>
    <td><input type="text" size="40" name="telp" value="<?php echo isset($recNon['telp']) ? $recNon['telp'] : ""; ?>" class="input-text-02" /></td>
  </tr>
  <tr>
    <td>Fax</td>
    <td><input type="text" size="40" name="fax" value="<?php echo isset($recNon['fax']) ? $recNon['fax'] : ""; ?>" class="input-text-02" /></td>
  </tr>
<?php
if ($_SESSION['userID'] = $iduser) {
?>

  <tr>
    <td>Passowrd</td>
    <td><input type="password" size="40" name="password" value="" class="input-text-02" pattern="^.{8}.*$" /> * minimal 8 karakter</td>
  </tr>
  <tr>
    <td>Verifikasi Password</td>
    <td><input type="password" size="40" name="new_confirm" value="" class="input-text-02" /></td>
  </tr>

<?php
if ($_SESSION['group'] == 1) {
?>
  <tr>
    <td>Group</td>

<?php
	$sql_text = "SELECT * from `group` ORDER BY `idgroup`";
	$option = $dbs->query($sql_text);
	echo '<td><select id="group" name="group_idgroup" class="input-text-02">"';
	echo '<option value="">--- Pilih Group ---</option>';
	while ($choice = $option->fetch_assoc()) {
		if ($choice['idgroup'] == $recNon['group_idgroup']) {
			echo '<option value="'.$choice['idgroup'].'" SELECTED >'.$choice['group'].'</option>';
		} else {
			echo '<option value="'.$choice['idgroup'].'">'.$choice['group'].'</option>';
		}
	}
	unset ($choice);
	echo '</select></td>';
  
}
?>
  </tr>
  <tr>
	<td colspan="2" class="t-right"><input type="submit" name="saveUser" class="input-submit" value="Update" /></td>
  </tr>
</table>
			</fieldset>

<?php
}
if (isset($iduser)) {
    echo '<input type="hidden" name="updatenid" value="'.$iduser.'"/>';
    $v = isset($recNon['login']) ? $recNon['login'] : '';
    echo '<input type="hidden" name="login" value="'.$v .'"/>';
}
?>
</form>

<?php
    } else {
		echo '<h3 class="tit">Daftar User</h2>';
		echo listUser();
    }
?>

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
