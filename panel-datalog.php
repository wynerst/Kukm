<?php
// required file
require 'sysconfig.inc.php';
include "listdata.php";
include "nav_panel.php";

if (isset($_GET['filterOn'])) {
	$filter_txt = "";
    
    IF (isset($_GET['kop']) AND $_GET['kop'] <> "") {
        $filter_txt .= ' k.nama LIKE \'%'. $_GET['kop'].'%\'';
    }
    IF (isset($_GET['cat']) AND $_GET['cat'] <> "") {
        if ($filter_txt <> "") {
            $filter_txt .= ' AND l.notes LIKE \'%'. $_GET['cat'].'%\'';
        } else {
            $filter_txt .= ' l.notes LIKE \'%'. $_GET['cat'].'%\'';
        }
    }
    IF (isset($_GET['ip']) AND $_GET['ip'] <> "") {
        if ($filter_txt <> "") {
            $filter_txt .= ' AND l.ipid LIKE \'%'. $_GET['ip'].'%';
        } else {
            $filter_txt .= ' l.ipid LIKE \'%'. $_GET['ip'].'%\'';
        }
    }
    IF (isset($_GET['tgl']) AND $_GET['tgl'] <> "") {
        if ($filter_txt <> "") {
            $filter_txt .= ' AND l.recorded LIKE \''. $_GET['tgl'].'%\'';
        } else {
            $filter_txt .= ' l.recorded LIKE \''. $_GET['tgl'].'%\'';
        }
    }
    IF (isset($_GET['user']) AND $_GET['user'] <> "") {
        if ($filter_txt <> "") {
            $filter_txt .= ' AND u.nama LIKE \'%'. $_GET['user'].'%\'';
        } else {
            $filter_txt .= ' u.nama LIKE \'%'. $_GET['user'].'%\'';
        }
    }
    IF (isset($_GET['mod']) AND $_GET['mod'] <> "") {
        if ($filter_txt <> "") {
            $filter_txt .= ' AND l.parts = \''. $_GET['mod'].'\'';
        } else {
            $filter_txt .= ' l.parts = \''. $_GET['mod'].'\'';
        }
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
			<h3 class="tit">Data Log Aktifitas</h2>
<?php
    echo '<table class="nostyle"><form method="get">';
    if (isset($_SESSION['group']) AND $_SESSION['group'] == 1) {
        echo '<tr>';
        echo '<td>Koperasi</td><td><input type="text" name="kop"></td>';
        echo '<td>User</td><td><input type="text" name="user"></td>';
        echo '<td>Kode IP</td><td><input type="text" name="ip"></td>';
        echo '<td>&nbsp;</td>';
        echo '</tr>';

    }
    echo '<tr>';
    echo '<td>Modul</td><td><input type="text" name="mod"></td>';
    echo '<td>Catatan</td><td><input type="text" name="cat"></td>';
    echo '<td>Waktu</td><td><input type="text" name="tgl"></td>';
    echo '<td><input type="reset" value="Reset">&nbsp;';
    echo '<input type="submit" name="filterOn" value="Filter"></td>';
    echo '</tr>';
    echo '</form></table><br />';
    
    echo $filter_txt == "" ? logsdata() : logsdata($filter_txt);
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
