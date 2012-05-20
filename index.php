<?php
// required file
require 'sysconfig.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/simbio_dbop.inc.php';
require 'lib/authenticate.php';

// start the output buffering for main content
ob_start();

session_start();

if (isset($_GET['login']) and $_GET['login'] =="") {
	session_unset();
}
// if there is login action
if (isset($_POST['logMeIn'])) {
    $username = strip_tags($_POST['userName']);
    $password = strip_tags($_POST['passWord']);
    if (!$username OR !$password) {
        $messages= '<script type="text/javascript">alert(\'Lengkapi Username dan Password dengan benar!\');</script>';
    } else {
        if (authenticate($username, $password)) {
            $messages= '<script type="text/javascript">';
            $messages.= 'alert(\'Selamat datang di KUKM, '.$_SESSION['userName'].'\');';
            #echo 'location.href = \'admin/index.php\';';
            $messages.= 'location.href = \'datacenter.php\';';
            $messages.= '</script>';
        } else {
            $messages= '<script type="text/javascript">alert(\'Username dan Password tidak cocok!\');</script>';
        }
	}
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

		<p class="f-right">User: <strong><a href="#"><?php echo isset($_SESSION['userName']) ? $_SESSION['userName'] : "Guest";?></a></strong></p>

	</div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->
	<div id="menu" class="box">

		<ul class="box f-right">
			<li><a href="#"><span><strong>Visit Site &raquo;</strong></span></a></li>
		</ul>

		<ul class="box">
			<li><a href="index.php"><span>Login</span></a></li> <!-- Active -->
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

		</div> <!-- /aside -->

		<hr class="noscreen" />

		<!-- Content (Right Column) -->
		<div id="content" class="box">

		<h1>Sistem Informasi Koperasi Bidang Usaha Simpan Pinjam</h1>
			<div class="col50">
			
				<p class="t-justify"><fieldset>
				<legend>Login</legend>
				<form method="post"><table width="100%" class="nostyle">
					<tr>
						<td style="width:120px;">Username:</td>
						<td><input type="text" size="15" name="userName" class="input-text-02" /></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" size="15" name="passWord" class="input-text-02" /></td>
					</tr>
					<tr>
						<td class="t-right" colspan= "2"><input name="logMeIn" type="submit" class="input-submit" value="Login" /></td>
					</tr>
					<tr>
						<td class="t-right" colspan= "2">Belum terdaftar? <a href="registrasi.php">KLIK DISINI </a> untuk Registrasi</td>
					</tr>
</table></form>
			</fieldset></p>
				
			</div> <!-- /col50 -->

			<div class="col50 f-right">
			
				<p class="t-justify">Melihat perkembangan koperasi khususnya bidang usaha simpan pinjam dan jasa keuangan, maka dibutuhkan suatu sistem monitoring dan evaluasi.<br />

Monitoring dan evaluasi merupakan bagian terpenting dalam suatu siklus pengelolaan program. seperti planning, actuating, dan organizing. Tujuan monev adalah untuk mengetahui tingkat pencapaian dan kesesuaian antara rencana yang telah ditetapkan dalam perencaan program dengan hasil yang dicapai melalui kegiatan dan/atau program secara berkala. Apabila dalam pelaksanaan Monev ditemukan masalah atau penyimpangan, maka secara langsung dapat dilakukan bimbingan, saran-saran dan cara mengatasinya serta melaporkannya secara berkala kepada pemangku kepentingan (stakeholders). <br />

Dengan demikian Monitoring dan Evaluasi laporan keuangan koperasi ini diharapkan dapat membantu:
<ul><li>Mengetahui proses dan hasil terhadap penyelenggaraan program</li>
<li>Alat manajemen untuk proses belajar dari pengalaman (belajar dari keberhasilan dan kegagalan)</li>
<li>Membuat perencanaan dan melaksanakan rencana dengan lebih baik di masa mendatang.</li>
<li>Mengetahui hal-hal terkait dengan tingkat pencapaian tujuan (keberhasilan), ketidakberhasilan, hambatan, tantangan, dan ancaman tertentu dalam mengelola program</li>
<li>Sebagai alat untuk mengukur kemajuan dan pencapaian proyek/program.</li></ul></p>
				
			</div> <!-- /col50 -->

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