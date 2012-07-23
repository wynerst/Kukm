<?php
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
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/bootstrap.css" /> <!-- RESET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/bootstrap.min.css" /> <!-- RESET -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/switcher.js"></script>
	<script type="text/javascript" src="js/toggle.js"></script>
	<script type="text/javascript" src="js/ui.core.js"></script>
	<script type="text/javascript" src="js/ui.tabs.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs > ul").tabs();
	});
	</script>
	<script type="text/javascript" src="js/easySlider1.7.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: true, 
				continuous: true
			});
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

		<p class="f-right">User: <strong><a href="#"><?php echo isset($_SESSION['userName']) ? $_SESSION['userName'] : "None";?></a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="index.php?login" id="logout">Log out</a></strong></p>

	</div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->
	<div id="menu" class="box">

		<ul class="box f-right">
			<li><a href="javascript:window.close();"><span><strong>Tutup</strong></span></a></li>
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

			<h1>Definisi Istilah</h1>

	<p><ul>
 	<li><h4>Kode warna laporan</h4></li>
	<blockquote>Usia laporan yang masuk ke dalam sistem pelaporan ditandai dengan warna:<br />
    <div align="center" style="background-color: #AFFB62; line-height: 40px; font-size: 12pt; ">Usia laporan 1 - 3 bulan yang lalu</div>
    <div align="center" style="background-color: yellow; line-height: 40px;font-size: 12pt;  ">Usia laporan 4 - 6 bulan yang lalu</div>
    <div align="center" style="background-color: #FB5F00; line-height: 40px; font-size: 12pt; ">Usia laporan 7 - 9 bulan yang lalu</div>
    <div align="center" style="background-color: #aaa; line-height: 40px; font-size: 12pt; ">Usia laporan lebih dari 10 bulan yang lalu</div>
    </blockquote>
    <li><h4>Simpanan</h4></li>
	<blockquote>adalah dana yang dipercayakan oleh anggota, calon anggota, koperasi lain, dan atau anggotanya kepada KSP dan atau USP dalam bentuk tabungan, dan simpanan koperasi berjangka. (Pengertian dalam monitoring disini adalah <i>out standing</i> simpanan pada saat pelaporan)</blockquote>
	<li><h4>Pinjaman</h4></li>
	<blockquote>adalah penyediaan uang atau tagihan yang dapat dipersamakan dengan itu, berdasarkan persetujuan atau kesepakatan pinjam meminjam antara KSP dan atau USP dengan pihak lain yang mewajibkan pihak peminjam untuk melunasi hutangnya setelah jangka waktu tertentu disertai dengan pembayaran sejumlah imbalan. (Pengertian dalam monitoring disini adalah <i>out standing</i> pinjaman pada saat pelaporan)</blockquote>
	<li><h4>Modal dalam</h4></li>
	<blockquote>adalah jumlah dari simpanan pokok, simpanan wajib dan simpanan lain yang memiliki karakteristik sama dengan simpanan wajib, hibah, cadangan yang disisihkan dari Sisa Hasil Usaha</blockquote>
	<li><h4>Modal luar</h4></li>
	<blockquote>adalah modal yang dipinjam koperasi yang berasal dari anggota, koperasi lainnya dan/atau anggotanya, bank/lembaga keuangan lainnya, penerbitan obligasi/surat hutang lainnnya dan sumber-yang sah</blockquote>
	<li><h4>Volume usaha/omzet</h4></li>
	<blockquote>adalah total nilai penjualan/ penyaluran kredit/ pembiayaan oleh koperasi yang bersangkutan</blockquote>
	<li><h4>Aset</h4></li>
	<blockquote>Total asset adalah total kekayaan KSP atau USP sebesar total aktiva KSP atau USP yang bersangkutan. Asset KSP dan USP antara lain berupa:
	<ol>
	<li>Dana/uang dalam bentuk tunai yang disimpan sebagai kas.</li>
	<li>Dana/uang yang disimpan di bank dalam bentuk giro, simpanan, dan simpanan berjangka.</li>
	<li>Dana yang disimpan di KSP/USP dalambentuk TAB KOP dan SIJAKOP.</li>
	<li>Penanaman dalam bentuk surat berharga.</li>
	<li>Penanaman dana dalam bentuk pinjaman yang[1]diberikan.</li>
	<li>Penanaman dalam bentuk penyertaan pada badan usaha lain.</li>
	<li>Penanaman dalam bentuk aktiva tetap seperti gedung dan peralatannya, alat transportasi dan sebagainya.</li>
</ol>
</blockquote>
	<li><h4>SHU - Sisa Hasil Usaha</h4></li>
	<blockquote>Sisa Hasil Usaha Koperasi merupakan pendapatan Koperasi yang diperoleh dalam satu tahun buku dikurangi dengan biaya, penyusutan, dan kewajiban lainnya termasuk pajak dalam tahun buku yang bersangkutan</blockquote>
	<li><h4>Suku Bunga Simpanan</h4></li>
	<blockquote>KSP/USP Koperasi melakukan penghimpunan dana dari anggota dan calon anggota; KSP/USP Koperasi dapat menyalurkan dananya kepada koperasi lain dan  anggotanya apabila memiliki kapasitas lebih dan mendapat persetujuan dari rapat anggota; Penghimpunan dana KSP/USP Koperasi dapat berupa tabungan, simpanan  berjangka dan penyertaan</blockquote>
	<li><h4>Suku Bunga Pinjaman</h4></li>
	<blockquote>Tingkat suku bunga pinjaman adalah tingkat suku bunga yang diberikan koperasi kepada anggotanya</blockquote>
	<li><h4>NPL - <i>Non Performing Loan</i></h4></li>
	<blockquote>Rasio kredit bermasalah terhadap total kredit. Dikenal juga dengan instilah Rasio Risiko Pinjaman Bermasalah Terhadap Pinjaman. Disajikan untuk memperoleh rasio antara risiko pinjaman bermasalah terhadap pinjaman yang diberikan yang ditetapkan sebagai berikut :
	<ul>
	<li>Menghitung perkiraan besarnya risiko pinjaman bermasalah (RPM) sebagai berikut:
		<ul>
		<li>50% dari pinjaman diberikan yang kurang lancar (PKL)</li>
		<li>75% dari pinjaman diberikan yang diragukan (PDR)</li>
		<li>100% dari pinjaman diberikan yang macet (PM)</li>
		</ul>
	<li>Hasil penjumlahan tersebut dibagi dengan pinjaman yang disalurkan.</li><br/>
		RPM = [ (50% x PKL) + (75% x PDR) + (100 x PM) ] / Pinjaman yang diberikan</blockquote>
	</ul>	
	</p>
			
		</div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
	<div id="footer" class="box">

		<p class="f-left">&copy; 2009 <a href="#">PT. Artistika Prasetia</a>, All Rights Reserved &reg;</p>

		<p class="f-right">Templates by <a href="http://www.adminizio.com/">Adminizio</a></p>

	</div> <!-- /footer -->

</div> <!-- /main -->

</body>
</html>
<?php
// main content grab
$main_content = ob_get_clean();

echo $main_content;
