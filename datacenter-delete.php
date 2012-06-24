<?php
// required file
require 'sysconfig.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/simbio_dbop.inc.php';
include "nav_datacenter.php";

$sql_op = new simbio_dbop($dbs);

// start the output buffering for main content
ob_start();

session_start();
if (!isset($_SESSION['access']) AND !$_SESSION['access']) {
    echo '<script type="text/javascript">alert(\'Anda tidak berhak mengakses laman!\');';
    echo 'location.href = \'index.php\';</script>';
    die();
}

// check if neraca id exist and delete it
if (isset($_GET['nid']) AND $_GET['nid'] > 0) {

    $nid=$_GET['nid'];
    $idkoperasi=$_SESSION['koperasi'];
    if ($_SESSION['group']== 1) {
    	$delete = $sql_op->delete('coa', 'idcoa ='.$nid);
    } else {
        $delete = $sql_op->delete('coa', 'idcoa ='.$nid. ' AND idkoperasi ='.$idkoperasi);
    }

    if ($delete) {
        // recLogs("Delete success", "Neraca");
        $messages= '<script type="text/javascript">';
        $messages.= 'alert(\'Data Neraca BERHASIL dihapus.\');';
        $messages.= 'location.href = \'datacenter-entrydata.php?list\';';
        $messages.= '</script>';
    } else {
        //recLogs("Delete failed", "Neraca");
        $messages= '<script type="text/javascript">alert(\'Data tidak berhasil dihapus atau anda tidak berhak menghapus data dimasksud!\');';
        $messages.= 'location.href = \'datacenter-entrydata.php?list\';';
        $messages.= '</script>';
    }
}// -> End delete neraca

// check if shu/phu id exist and delete it
if (isset($_GET['pid']) AND $_GET['pid'] > 0) {

    $pid=$_GET['pid'];
    $idkoperasi=$_SESSION['koperasi'];
    if ($_SESSION['group']== 1) {
    	$delete = $sql_op->delete('shu', 'idshu ='.$pid);
    } else {
        $delete = $sql_op->delete('shu', 'idshu ='.$pid. ' AND idkoperasi ='.$idkoperasi);
    }

    if ($delete) {
        // recLogs("Delete success", "PHU/SHU");
        $messages= '<script type="text/javascript">';
        $messages.= 'alert(\'Data PHU/SHU BERHASIL dihapus.\');';
        $messages.= 'location.href = \'datacenter-entrydata-phu.php?list\';';
        $messages.= '</script>';
    } else {
        //recLogs("Delete failed", "PHU/SHU");
        $messages= '<script type="text/javascript">alert(\'Data tidak berhasil dihapus atau anda tidak berhak menghapus data dimasksud!\');';
        $messages.= 'location.href = \'datacenter-entrydata-phu.php?list\';';
        $messages.= '</script>';
    }
}// -> End delete SHU/PHU
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
<?php if (isset($messages)) { echo $messages; } ?>
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
