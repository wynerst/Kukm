<?php
// required file
require '../sysconfig.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/simbio_dbop.inc.php';
include "Quick_CSV_import.php";
include "../nav_datacenter.php";

$csv = new Quick_CSV_import();

//$arr_encodings = $csv->get_encodings(); //take possible encodings list
$arr_encodings["default"] = "[default database encoding]"; //set a default (when the default database encoding should be used)

if(!isset($_POST["encoding"]))
  $_POST["encoding"] = "default"; //set default encoding for the first page show (no POST vars)

if(isset($_POST["Go"]) && ""!=$_POST["Go"]) //form was submitted
{
  $csv->file_name = $_FILES['datafile']['tmp_name'];
  
  //optional parameters
  $csv->use_csv_header = isset($_POST["use_csv_header"]);
  $csv->field_separate_char = $_POST["field_separate_char"][0];
  $csv->field_enclose_char = $_POST["field_enclose_char"][0];
  $csv->field_escape_char = $_POST["field_escape_char"][0];
  $csv->encoding = $_POST["encoding"];
  $csv->table_name = "non_coa";
  $csv->table_exists = true;
  
  //start import now
    if ($csv->import()) {
        $messages= '<script type="text/javascript">';
        $messages.= 'alert(\'Data pendukung lain berhasil diunggah.\');';
        $messages.= 'location.href = \'../datacenter.php\';';
        $messages.= '</script>';
    } else {
        $messages= '<script type="text/javascript">alert(\'GAGAL mengunggah file data!\');</script>';
    }
}
//else
//  $_POST["use_csv_header"] = 1;
//}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en" />
	<meta name="robots" content="noindex,nofollow" />
	<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/reset.css" /> <!-- RESET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/main.css" /> <!-- MAIN STYLE SHEET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/2col.css" title="2col" /> <!-- DEFAULT: 2 COLUMNS -->
	<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="../css/1col.css" title="1col" /> <!-- ALTERNATE: 1 COLUMN -->
	<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="../css/main-ie6.css" /><![endif]--> <!-- MSIE6 -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/style.css" /> <!-- GRAPHIC THEME -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/mystyle.css" /> <!-- WRITE YOUR CSS CODE HERE -->
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/switcher.js"></script>
	<script type="text/javascript" src="../js/toggle.js"></script>
	<script type="text/javascript" src="../js/ui.core.js"></script>
	<script type="text/javascript" src="../js/ui.tabs.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs > ul").tabs();
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
				<a href="#" rel="1col" class="styleswitch ico-col1" title="Display one column"><img src="../design/switcher-1col.gif" alt="1 Column" /></a>
				<a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns"><img src="../design/switcher-2col.gif" alt="2 Columns" /></a>
			</span>

			Project: <strong>Kementerian KUKM</strong>

		</p>

		<p class="f-right">User: <strong><a href="#"><?php echo isset($_SESSION['userName']) ? $_SESSION['userName'] : "None";?></a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="index.php?login" id="logout">Log out</a></strong></p>

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
				<p id="logo"><a href="#"><img src="../tmp/logo.gif" alt="Our logo" title="Visit Site" /></a></p>

			</div> <!-- /padding -->
<?php
echo navigation(1);
?>
		</div> <!-- /aside -->

		<hr class="noscreen" />

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>Data Pendukung Lain</h1>

			<!-- Form -->
			<h3 class="tit">Upload Data</h3>
			<fieldset>
				<legend>Informasi Upload Data</legend>
                <form method="post" enctype="multipart/form-data">
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
						<td>Waktu Data:</td>
						<td><input type="text" size="15" name="" class="input-text" value="2006-12-30" disabled="disabled" /></td>
					</tr>
					<tr>
						<td>Delimiter:</td>
						<td><select id="delimiter" name="field_separate_char" class="input-text">
							<option value=",">, (koma)</option>
							<option value=";">; (titik koma)</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>File yang akan di-upload:</td>
						<td><input type="file" id="datafile" name="datafile" size="40" value="<?php echo isset($_POST['datafile']) ? $_POST['datafile'] : ""; ?>"></td>
					</tr>
					<tr>
						<td colspan="2" class="t-right"><input type="submit" name="Go" class="input-submit" value="Submit" onclick=" var s = document.getElementById('datafile'); if(null != s && '' == s.value) {alert('Pilih berkas CSV untuk diunggah.'); s.focus(); return false;}"></td>
					</tr>
				</table>
                <input type="hidden" name="use_csv_header" value=1>
                <input type="hidden" name="field_enclose_char" value="&quot;">
                <input type="hidden" name="field_escape_char" value="\">
                <input type="hidden" name="encoding" value="default">
      </tr>
                </form>
			</fieldset>

		</div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
	<div id="footer" class="box">

		<p class="f-left">&copy; 2012 <a href="#">PT. Artistika Prasetia</a>, All Rights Reserved &reg;</p>

		<p class="f-right">Templates by <a href="http://www.adminizio.com/">Adminizio</a></p>

	</div> <!-- /footer -->

</div> <!-- /main -->
<?php echo (!empty($csv->error) ? "<hr/>Errors: ".$csv->error : ""); ?>

</body>
</html>
<?php
// main content grab
$main_content = ob_get_clean();

echo $main_content;