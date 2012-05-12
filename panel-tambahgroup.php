<?php
// required file
require 'sysconfig.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/simbio_dbop.inc.php';
include "nav_panel.php";

if (isset($_POST['searchData'])) {
	$kopnama = $_POST['koperasi'];
	$lapperiod = $_POST['periode'];
	if ($kopnama <>"" AND $lapperiod <>"") {
		$search_limit = ' k.idkoperasi ='. $kopnama . ' AND p.idperiode = "'.$lapperiod.'"';
		// get record
		$sql_text = "SELECT p.periode, k.nama FROM periode as p ";
		$sql_text .= " LEFT JOIN koperasi as k ON c.idkoperasi = k.idkoperasi ";
		if (isset($search_limit)) {
			$sql_text .= "WHERE ". $search_limit;
		}
		$q_koperasi = $dbs->query($sql_text);
		$reckoperasi = $q_koperasi->fetch_assoc();
	} else {
		utility::jsAlert('Nama koperasi dan periode tidak boleh kosong.');
	}
}

if (isset($_POST['saveGroup'])) {

    $sql_op = new simbio_dbop($dbs);

	if (isset($_POST['updatenid'])) {
		$idgroup = $_POST['updatenid'];
	}
	$data['group'] = $_POST['group'];

	if (isset($idgroup) AND $idgroup <> 0) {
		$update = $sql_op->update('group', $data, 'idgroup ='.$idgroup);
//		print_r($data);
//		die();
		if ($update) {
			utility::jsAlert('Data Group berhasil diperbaiki.');
		} else {
			utility::jsAlert('Data Group GAGAL diperbaiki.');
		}
	} else {
		$insert = $sql_op->insert('group', $data);
		if ($insert) {
			utility::jsAlert('Data Group berhasil disimpan.');
		} else {
			utility::jsAlert('Data Group GAGAL disimpan.');
		}
	}

}

if (isset($_GET['nid']) AND $_GET['nid'] <> "") {
	// get record
	$idgroup = $_GET['nid'];
	$sql_text = "SELECT * FROM `group` WHERE idgroup =". $idgroup;
	$q_user = $dbs->query($sql_text);
	$recNon = $q_user->fetch_assoc();
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
			<h3 class="tit"><?php echo isset($idgroup)? "Edit" : "Tambah"; ?> Group</h2>
<form id='form_user' method=post>

<table class="nostyle">
  <tr>
    <td>Nama group</td>
    <td><input type="text" size="40" name="group" value="<?php echo isset($recNon['group']) ? $recNon['group'] : ""; ?>" class="input-text-02" /></td>
  </tr>
  <tr>
	<td colspan="2" class="t-right"><input type="submit" name="saveGroup" class="input-submit" value="Submit" /></td>
  </tr>
</table>
			</fieldset>

			<?php
if (isset($iduser)) {
    echo '<input type="hidden" name="updatenid" value="'.$iduser.'"/>';
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