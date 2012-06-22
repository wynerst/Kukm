<?php
// required file
require 'sysconfig.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/simbio_dbop.inc.php';
include "nav_datacenter.php";

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

		<p class="f-right">User: <strong><a href="#">Administrator</a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="#" id="logout">Log out</a></strong></p>

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
echo navigation(4);
?>

		</div> <!-- /aside -->

		<hr class="noscreen" />

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>Laporan</h1>

			<!-- Form -->
			<h3 class="tit">Tampilkan Data</h3>
			<fieldset>
				<legend>Pilih Data</legend>
				<table class="nostyle">
					<tr>
						<td style="width:180px;">Sandi Koperasi:</td>
						<td><input type="text" size="9" name="" class="input-text" value="020100001" disabled="disabled" /> - <input type="text" size="3" name="" class="input-text" value="001" disabled="disabled" /></td>
					</tr>
					<tr>
						<td>Nama Koperasi:</td>
						<td><input type="text" size="15" name="" class="input-text" value="KSP NASARI" disabled="disabled" /></td>
					</tr>
					<tr>
						<td>Bulan Laporan:</td>
						<td><input type="checkbox" value="1" />Januari
						<input type="checkbox" value="2" />Februari
						<input type="checkbox" value="3" />Maret
						<input type="checkbox" value="4" />April
						<input type="checkbox" value="5" />Mei
						<input type="checkbox" value="6" />Juni
						<input type="checkbox" value="7" />Juli
						<input type="checkbox" value="8" />Agustus
						<input type="checkbox" value="9" />September
						<input type="checkbox" value="10" />Oktober
						<input type="checkbox" value="11" />November
						<input type="checkbox" value="12" />Desember</td>
					</tr>
					<tr>
						<td>Tahun Laporan (Awal-Akhir):</td>
						<td><input type="text" size="10" name="" class="input-text" value="2011" /> <input type="text" size="10" name="" class="input-text" value="2012" /></td>
					</tr>
					<tr>
						<td>Output Laporan:</td>
						<td><select id="output" name="output" class="input-text">
							<option value="pdf">PDF</option>
							</select></td>
					</tr>
					<tr>
						<td>Laporan:</td>
						<td><a href="tmp/neraca.pdf">Neraca</a> <a href="tmp/phu.pdf">Perhitungan Hasil Usaha</a></td>
					</tr>
				</table>
			</fieldset>

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