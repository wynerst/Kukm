<?php
// required file
require 'sysconfig.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/simbio_dbop.inc.php';
require SIMBIO_BASE_DIR.'simbio_GUI/table/simbio_table.inc.php';
require SIMBIO_BASE_DIR.'simbio_GUI/paging/simbio_paging.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/datagrid/simbio_dbgrid.inc.php';
require SIMBIO_BASE_DIR.'simbio_GUI/form_maker/simbio_form_table_AJAX.inc.php';
include "nav_datacenter.php";

// start the output buffering for main content
ob_start();

session_start();

// create datagrid
$datagrid = new simbio_datagrid();
$jeniskop = new simbio_datagrid();

// table spec
$table_spec = '`koperasi` as k
LEFT JOIN `non_coa` as n ON n.idkoperasi = k.idkoperasi 
LEFT JOIN coa as c ON c.idkoperasi = k.idkoperasi
LEFT JOIN shu as s ON s.idkoperasi = k.idkoperasi 
LEFT JOIN periode as p ON n.idperiode = p.idperiode 
LEFT JOIN periode as p2 ON c.idperiode = p2.idperiode
LEFT JOIN periode as p3 ON s.idperiode = p3.idperiode 
LEFT JOIN `tipe_koperasi` as tk ON k.jenis = tk.idtipe_koperasi';

$datagrid->setSQLColumn('k.idkoperasi, p.periode as \'Periode\'',
	'k.nama as \'Koperasi\'',
	'format(n.akumulasi_simpanan/1000,2) AS \'Simpanan&nbsp;*)\'',
	'format(n.akumulasi_pinjaman/1000,2) AS \'Pinjaman&nbsp;*)\'',
	'format((c.c3110+c.c3120)/1000,2) AS \'Modal Dalam&nbsp;*)\'',
	'format((c.c3130+c.c3140)/1000,2) AS \'Modal Luar&nbsp;*)\'',
	'format(n.vol_usaha/1000,2) AS \'Volume Usaha&nbsp;*)\'',
	'format((c.c11+c.c12+c.c13+c.c14)/1000,2) AS \'Asset&nbsp;*)\'',
	'format((c.c3170+c.c3180)/1000,2) AS \'SHU&nbsp;*)\'',
	'format(n.sb_simpanan,2) AS \'Suku Bunga Simpanan (%)\'',
	'format(n.sb_pinjaman,2) AS \'Suku Bunga Pinjaman (%)\'',
	'format((n.piutangmacet/n.akumulasi_pinjaman)*100,2) AS \'NPL (%)\'');

$datagrid->setSQLorder('k.nama ASC, p.periode DESC');
$datagrid->setSQLcriteria('YEAR(p.finaldate) = 2010 or YEAR(p2.finaldate) = 2010 or YEAR(p3.finaldate) = 2010');
$datagrid->sql_group_by = 'c.idkoperasi';

$jeniskop->setSQLColumn('k.idkoperasi, p.periode as \'Periode\'',
	'tk.jenis as \'Tipe Koperasi\'',
	'format(sum(n.akumulasi_simpanan)/1000,2) AS \'Simpanan&nbsp;*)\'',
	'format(sum(n.akumulasi_pinjaman)/1000,2) AS \'Pinjaman&nbsp;*)\'',
	'format(sum((c.c3110+c.c3120))/1000,2) AS \'Modal Dalam&nbsp;*)\'',
	'format(sum((c.c3130+c.c3140))/1000,2) AS \'Modal Luar&nbsp;*)\'',
	'format(sum(n.vol_usaha)/1000,2) AS \'Volume Usaha&nbsp;*)\'',
	'format(sum((c.c11+c.c12+c.c13+c.c14))/1000,2) AS \'Asset&nbsp;*)\'',
	'format(sum((c.c3170+c.c3180))/1000,2) AS \'SHU&nbsp;*)\'',
	'format(avg(n.sb_simpanan),2) AS \'Suku Bunga Simpanan (%)\'',
	'format(avg(n.sb_pinjaman),2) AS \'Suku Bunga Pinjaman (%)\'',
	'format(avg((n.piutangmacet/n.akumulasi_pinjaman))*100,2) AS \'NPL (%)\'');

$jeniskop->setSQLorder('tk.jenis ASC');
$jeniskop->setSQLcriteria('YEAR(p.finaldate) = 2010 or YEAR(p2.finaldate) = 2010 or YEAR(p3.finaldate) = 2010');
$jeniskop->sql_group_by = 'tk.jenis';

// set group by
//$datagrid->sql_group_by = 'index.biblio_id';

// set criteria
//$datagrid->setSQLcriteria('('.$criteria['sql_criteria'].')');

// set table and table header attributes
//$datagrid->table_attr = 'align="center" id="dataList" cellpadding="5" cellspacing="0"';
$datagrid->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
// set delete proccess URL
//$datagrid->chbox_form_URL = $_SERVER['PHP_SELF'];
$datagrid->debug = true;
$datagrid->invisible_fields = array(0,1);

$jeniskop->table_header_attr = 'style="font-weight: bold; color:rgb(255,255,255); background-color:cyan; vertical-align:middle;"';
$jeniskop->debug = true;
$jeniskop->invisible_fields = array(0,1);

// put the result into variables
$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 10, false);
$jeniskop_result = $jeniskop->createDataGrid($dbs, $table_spec, 10, false);

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
			<li><a href="#"><span><strong>Visit Site &raquo;</strong></span></a></li>
		</ul>

		<ul class="box">
		<?php echo menutop(1); ?>
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

			<h1>Selamat Datang</h1>

			<h2>Dashboard</h2>
			<div id="slider">
				<ul>
					<li><img src="tmp/piechart.png" width="300px"></li>
					<li><img src="tmp/linechart.png" width="500px"></li>
					<li><img src="tmp/barchart.png"></li>
				</ul>
			</div>

			<h3>Koperasi 10 Urutan Teratas</h3>
			<p>
			<?php
			echo $datagrid_result;
			echo "*) dalam jutaan";
			?>
			</p>
			
			<h3>Koperasi Berdasarkan Jenis Koperasi</h3>
			<p>
			<?php
			echo $jeniskop_result;
			echo "*) dalam jutaan";
			?>
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
