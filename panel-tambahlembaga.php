<?php
// required file
require 'sysconfig.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/simbio_dbop.inc.php';
require SIMBIO_BASE_DIR.'simbio_GUI/table/simbio_table.inc.php';
require SIMBIO_BASE_DIR.'simbio_GUI/paging/simbio_paging.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/datagrid/simbio_dbgrid.inc.php';
require SIMBIO_BASE_DIR.'simbio_GUI/form_maker/simbio_form_table_AJAX.inc.php';
include 'nav_panel.php';

if (isset($_POST['saveKoperasi'])) {

    $sql_op = new simbio_dbop($dbs);

	if (isset($_POST['updatenid'])) {
		$idkoperasi = $_POST['updatenid'];
	}

	$data['nama'] = $_POST['nama'];
	$data['alamat'] = $_POST['alamat'];
	$data['propinsi'] = $_POST['propinsi'];
	$data['kabupaten'] = $_POST['kabupaten'];
	$data['kecamatan'] = $_POST['kecamatan'];
	$data['kelurahan'] = $_POST['kelurahan'];
	$data['kodepos'] = $_POST['kodepos'];
	$data['pimpinan'] = $_POST['pimpinan'];
	$data['telp'] = $_POST['telp'];
	$data['fax'] = $_POST['fax'];
	$data['telex'] = $_POST['telex'];
	$data['email'] = $_POST['email'];
	$data['sandilembaga'] = $_POST['sandilembaga'];
	$data['dasar_hukum'] = $_POST['dasar_hukum'];
	$data['tgl_berdiri'] = $_POST['tgl_berdiri'];
	$data['grouplevel'] = $_POST['grouplevel'];
	$data['jenis'] = $_POST['jenis'];

	if (isset($idkoperasi) AND $idkoperasi <> 0) {
		$update = $sql_op->update('koperasi', $data, 'idkoperasi ='.$idkoperasi);
		if ($update) {
			utility::jsAlert('Data Koperasi berhasil diperbaiki.');
		} else {
			utility::jsAlert('Data Koperasi GAGAL diperbaiki.');
		}
	} else {
		$insert = $sql_op->insert('koperasi', $data);
		if ($insert) {
			utility::jsAlert('Data Koperasi berhasil disimpan.');
		} else {
			utility::jsAlert($sql_op->error.'Data Koperasi GAGAL disimpan.');
		}
	}

}

if (isset($_GET['nid']) AND $_GET['nid'] <> "") {
	// get record
	$idkoperasi = $_GET['nid'];
	$sql_text = "SELECT * FROM koperasi 
		WHERE idkoperasi =". $idkoperasi;
	$q_koperasi = $dbs->query($sql_text);
	$recKop = $q_koperasi->fetch_assoc();
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

		<p class="f-right">User: <strong><a href="#"><?php echo isset($_SESSION['userName']) ? $_SESSION['userName'] : "None";?></a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="index.php?login" id="logout">Log out</a></strong></p>

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
			<h3 class="tit">Daftar Lembaga Baru</h2>
			<fieldset>
				<form id="formKoperasi" method="POST">
				<legend>Profil Lembaga</legend>
				<table class="nostyle">
					<tr>
						<td style="width:200px;">Nama Lembaga:</td>
    <td><input type="text" size="40" name="nama" value="<?php isset($recKop['nama']) ? $v=$recKop['nama']: $v=""; echo $v; ?>" class="input-text-02" /></td>
					</tr>
					<tr>
						<td>Alamat:</td>
    <td><textarea style="width:100%;" rows="2" name="alamat"><?php isset($recKop['alamat']) ? $v=$recKop['alamat']: $v=""; echo $v; ?></textarea></td>
					</tr>
					<tr>
						<td>Provinsi:</td>
						<td><select id="propinsi" name="propinsi" class="input-text-02">
						<option value=""> - Pilih propinsi - </option>
						<option value="Sumatera Utara">Sumatera Utara</option>
						<option value="Sumatera Barat">Sumatera Barat</option>
						<option value="Riau">Riau</option>
						<option value="Jambi">Jambi</option>
						<option value="Sumatera Selatan">Sumatera Selatan</option>
						<option value="Bengkulu">Bengkulu</option>
						<option value="Lampung">Lampung</option>
						<option value="Kep. Bangka Belitung">Kep. Bangka Belitung</option>
						<option value="Kep. Riau">Kep. Riau</option>
						<option value="DKI Jakarta">DKI Jakarta</option>
						<option value="Jawa Barat">Jawa Barat</option>
						<option value="Jawa Tengah">Jawa Tengah</option>
						<option value="Banten">Banten</option>
						<option value="Jawa Timur">Jawa Timur</option>
						<option value="Yogyakarta">Yogyakarta</option>
						<option value="Bali">Bali</option>
						<option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
						<option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
						<option value="Kalimantan Barat">Kalimantan Barat</option>
						<option value="Kalimantan Tengah">Kalimantan Tengah</option>
						<option value="Kalimantan Selatan">Kalimantan Selatan</option>
						<option value="Kalimantan Timur">Kalimantan Timur</option>
						<option value="Sulawesi Utara">Sulawesi Utara</option>
						<option value="Sulawesi Tengah">Sulawesi Tengah</option>
						<option value="Sulawesi Selatan">Sulawesi Selatan</option>
						<option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
						<option value="Gorontalo">Gorontalo</option>
						<option value="Sulawesi Barat">Sulawesi Barat</option>
						<option value="Maluku">Maluku</option>
						<option value="Maluku Utara">Maluku Utara</option>
						<option value="Papua">Papua</option>
						<option value="Papua Barat">Papua Barat</option>
						</select>&nbsp;<input type="text" name="propinsi" class="input-text-02" value="<?php isset($recKop['propinsi']) ? $v=$recKop['propinsi']: $v=""; echo $v; ?>" disabled="disabled"/></td>
					</tr>
					<tr>
						<td>Kabupaten/Kota:</td>
						<td><select id="kabupaten" name="kabupaten" class="input-text-02" disabled="disabled">
						<option value="Jakarta Selatan">Jakarta Selatan</option>
						<option value="Jakarta Timur">Jakarta Timur</option>
						<option value="Jakarta Utara">Jakarta Utara</option>
						<option value="Jakarta Barat">Jakarta Barat</option>
						<option value="Jember">Jember</option>
						<option value="Ambarawa">Ambarawa</option>
						<option value="Tangerang">Tangerang</option>
						</select>&nbsp;<input type="text" name="kabupaten" class="input-text-02" value="<?php isset($recKop['kabupaten']) ? $v=$recKop['kabupaten']: $v=""; echo $v; ?>" /></td>
					</tr>
					<tr>
						<td>Kecamatan:</td>
						<td><select id="kecamatan" name="kecamatan" class="input-text-02" disabled="disabled">
						<option value="Kebayoran Baru">Kebayoran Baru</option>
						<option value="Cilandak">Cilandak</option>
						<option value="Pasar Minggu">Pasar Minggu</option>
						<option value="Winong">Winong</option>
						</select>&nbsp;<input type="text" name="kecamatan" class="input-text-02" value="<?php isset($recKop['kecamatan']) ? $v=$recKop['kecamatan']: $v=""; echo $v; ?>" /></td>
					</tr>
					<tr>
						<td>Kelurahan:</td>
						<td><select id="kelurahan" name="kelurahan" class="input-text-02" disabled="disabled">
						<option value="Kramat Pela">Kramat Pela</option>
						<option value="Melawai">Melawai</option>
						<option value="Senayan">Senayan</option>
						</select>&nbsp;<input type="text" name="kelurahan" class="input-text-02" value="<?php isset($recKop['kelurahan']) ? $v=$recKop['kelurahan']: $v=""; echo $v; ?>" /></td>
					</tr>
					<tr>
						<td>Kodepos:</td>
    <td><input type="text" size="40" name="kodepos" value="<?php isset($recKop['kodepos']) ? $v=$recKop['kodepos']: $v=""; echo $v; ?>" class="input-text-02" /></td>
					</tr>
					<tr>
						<td>Nama Pimpinan/Ketua:</td>
    <td><input type="text" size="40" name="pimpinan" value="<?php isset($recKop['pimpinan']) ? $v=$recKop['pimpinan']: $v=""; echo $v; ?>" class="input-text-02" /></td>
					</tr>
					<tr>
						<td>Nomor Telepon:</td>
    <td><input type="text" size="20" name="telp" value="<?php isset($recKop['telp']) ? $v=$recKop['telp']: $v=""; echo $v; ?>" class="input-text-02" /></td>
					</tr>
					<tr>
						<td>Nomor Fax:</td>
    <td><input type="text" size="20" name="fax" value="<?php isset($recKop['fax']) ? $v=$recKop['fax']: $v=""; echo $v; ?>" class="input-text-02" /></td>
					</tr>
					<tr>
						<td>Nomor Telex:</td>
    <td><input type="text" size="20" name="telex" value="<?php isset($recKop['telex']) ? $v=$recKop['telex']: $v=""; echo $v; ?>" class="input-text-02" /></td>
					</tr>
					<tr>
						<td>Alamat Email:</td>
    <td><input type="text" size="40" name="email" value="<?php isset($recKop['email']) ? $v=$recKop['email']: $v=""; echo $v; ?>" class="input-text-02" /></td>
					</tr>
			</table>
			</fieldset>
			<fieldset>
			<table class="nostyle">
					<legend>Informasi Lembaga</legend>
					<tr>
						<td style="width:200px;">Sandi Lembaga:</td>
    <td><input type="text" size="40" name="sandilembaga" value="<?php isset($recKop['sandilembaga']) ? $v=$recKop['sandilembaga']: $v=""; echo $v; ?>" class="input-text-02" /></td>
					</tr>
					<tr>
					<td>Nomor Badan Hukum:</td>
    <td><input type="text" size="40" name="dasar_hukum" value="<?php isset($recKop['dasar_hukum']) ? $v=$recKop['dasar_hukum']: $v=""; echo $v; ?>" class="input-text-02" /></td>
					</tr>
					<tr>
						<td>Tanggal Badan Hukum:</td>
    <td><input type="text" size="40" name="tgl_berdiri" value="<?php isset($recKop['tgl_berdiri']) ? $v=$recKop['tgl_berdiri']: $v=date('Y-m-d');
; echo $v; ?>" class="input-text-02" /></td>
					</tr>
					<tr>
						<td>Grup Level:</td>
    <td><input type="text" size="40" name="grouplevel" value="<?php isset($recKop['grouplevel']) ? $v=$recKop['grouplevel']: $v=""; echo $v; ?>" class="input-text-02" /></td>
					</tr>
					<tr>
						<td>Jenis Lembaga:</td>
						<td><select id="jenis" name="jenis" class="input-text-02">
<?php
	$sql_text = "SELECT idtipe_koperasi, jenis FROM tipe_koperasi ORDER by idtipe_koperasi";
	$rsSelect = $dbs->query($sql_text);
	while ($recSel = $rsSelect->fetch_assoc()) {
		if (isset($recKop['jenis']) and $recKop['jenis'] == $recSel['idtipe_koperasi']) {
			echo '<option value="'.$recSel['idtipe_koperasi'].'" SELECTED >'.$recSel['jenis'].'</option>';
		} else {
			echo '<option value="'.$recSel['idtipe_koperasi'].'">'.$recSel['jenis'].'</option>';
		}
	}
?>
						</select></td>
					</tr>
			</table>
			</fieldset>
			<fieldset>
			<table class="nostyle">
					<legend>Penanggung Jawab</legend>
					<tr>
						<td style="width:200px;">Nama Penanggung Jawab:</td>
						<td><input type="text" size="40" name="" class="input-text" disabled="disabled" /></td>
					</tr>
					<tr>
						<td>Divisi/Bagian:</td>
						<td><input type="text" size="40" name="" class="input-text" disabled="disabled"/></td>
					</tr>
					<tr>
						<td>Nomor Telepon:</td>
						<td><input type="text" size="5" name="" class="input-text" disabled="disabled"/> - <input type="text" size="20" name="" class="input-text" disabled="disabled"/></td>
					</tr>
					<tr>
						<td>Nomor Fax:</td>
						<td><input type="text" size="5" name="" class="input-text" disabled="disabled"/> - <input type="text" size="20" name="" class="input-text" disabled="disabled"/></td>
					</tr>
					<tr>
						<td colspan="2" class="t-right"><input type="submit" name="saveKoperasi" class="input-submit" value="Submit" /></td>
					</tr>
			</table>
			</fieldset>
<?php
if (isset($idkoperasi)) {
    echo '<input type="hidden" name="updatenid" value="'.$idkoperasi.'"/>';
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
<?php
// main content grab
$main_content = ob_get_clean();

echo $main_content;
