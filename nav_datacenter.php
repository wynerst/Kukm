<?php
function navigation($nav_active=0) {
	$nav_menu = '<ul class="box">';

/**	if ($nav_active == 5) { $nav_menu .='<li id="submenu-active">'; } else {$nav_menu .='<li>';}
	$nav_menu .='<a href="'.KUKM_WEB_ROOT_DIR.'datacenter-harian.php?list">Data Harian</a>
				<ul>
					<li><a href="'.KUKM_WEB_ROOT_DIR.'datacenter-harian.php">Entry Data</a></li>
					<li><a href="'.KUKM_WEB_ROOT_DIR.'import/harian.php">Upload Data</a></li>
					<li><a href="'.KUKM_WEB_ROOT_DIR.'datacenter-laporansementara-harian.php">Laporan Harian Sementara</a></li>
				</ul>
			</li>';
**/

            if ($nav_active == 1) { $nav_menu .='<li id="submenu-active">'; } else {$nav_menu .='<li>';}
	if (isset($_SESSION['tipekoperasi']) AND ($_SESSION['tipekoperasi'] == 3 OR $_SESSION['tipekoperasi'] == 5)) {
		$nav_menu .='<a href="'.KUKM_WEB_ROOT_DIR.'datacenter-entrysyariah.php?list">Neraca</a>
				<ul>
					<li><a href="'.KUKM_WEB_ROOT_DIR.'datacenter-entrysyariah.php">Entry Data</a></li>
					<li><a href="#">Upload Data</a></li>
					<li><a href="'.KUKM_WEB_ROOT_DIR.'datacenter-laporansementara.php">Laporan Neraca Sementara</a></li>
				</ul>
			</li>';
				/**	<li><a href="'.KUKM_WEB_ROOT_DIR.'import/neraca.php">Upload Data</a></li> **/
	} else {
		$nav_menu .='<a href="'.KUKM_WEB_ROOT_DIR.'datacenter-entrydata.php?list">Neraca</a>
				<ul>
					<li><a href="'.KUKM_WEB_ROOT_DIR.'datacenter-entrydata.php">Entry Data</a></li>
					<li><a href="#">Upload Data</a></li>
					<li><a href="'.KUKM_WEB_ROOT_DIR.'datacenter-laporansementara.php">Laporan Neraca Sementara</a></li>
				</ul>
			</li>';
				/**	<li><a href="'.KUKM_WEB_ROOT_DIR.'import/neraca.php">Upload Data</a></li> **/
	}
	if ($nav_active == 2) { $nav_menu .='<li id="submenu-active">'; } else {$nav_menu .='<li>';}
	if (isset($_SESSION['tipekoperasi']) AND ($_SESSION['tipekoperasi'] == 3 OR $_SESSION['tipekoperasi'] == 5)) {
		$nav_menu .='<a href="'.KUKM_WEB_ROOT_DIR.'datacenter-entrydata-phu-syariah.php?list">Sisa Hasil Usaha KSP</a>
				<ul>
					<li><a href="'.KUKM_WEB_ROOT_DIR.'datacenter-entrydata-phu-syariah.php">Entry Data</a></li>
					<li><a href="#">Upload Data</a></li>
					<li><a href="'.KUKM_WEB_ROOT_DIR.'datacenter-laporansementara-phu.php">Laporan SHU Sementara</a></li>
				</ul>
			</li>';
				/**	<li><a href="'.KUKM_WEB_ROOT_DIR.'import/phu.php">Upload Data</a></li> **/
	} else {
		$nav_menu .= '<a href="'.KUKM_WEB_ROOT_DIR.'datacenter-entrydata-phu.php?list">SHU Simpan Pinjam</a>
				<ul>
					<li><a href="'.KUKM_WEB_ROOT_DIR.'datacenter-entrydata-phu.php">Entry Data</a></li>
					<li><a href="#">Upload Data</a></li>
					<li><a href="'.KUKM_WEB_ROOT_DIR.'datacenter-laporansementara-phu.php">Laporan SHU Sementara</a></li>
				</ul>
			</li>';
				/**	<li><a href="'.KUKM_WEB_ROOT_DIR.'import/phu.php">Upload Data</a></li> **/
	}
	if ($nav_active == 3) { $nav_menu .='<li id="submenu-active">'; } else {$nav_menu .='<li>';}
	$nav_menu .= '<a href="'.KUKM_WEB_ROOT_DIR.'datacenter-entrydata-finansial.php?list">Data Pendukung Lain</a>
				<ul>
					<li><a href="'.KUKM_WEB_ROOT_DIR.'datacenter-entrydata-finansial.php">Entry Data Finansial</a></li>
					<li><a href="'.KUKM_WEB_ROOT_DIR.'datacenter-entrydata-pendukung.php">Entry Data Pendukung  Lain</a></li>
					<li><a href="#">Upload Data</a></li>
					<!-- <li><a href="'.KUKM_WEB_ROOT_DIR.'datacenter-laporansementara-harian.php">Lap. Pedukung Finansial Lain</a></li>
					<li><a href="'.KUKM_WEB_ROOT_DIR.'datacenter-laporansementara-nonfinansial.php">Lap. Data Pendukung Lain</a></li> -->
				</ul>
			</li>';
				/**	<li><a href="'.KUKM_WEB_ROOT_DIR.'import/nonfinansial.php">Upload Data</a></li> **/
	if ($nav_active == 4) { $nav_menu .='<li id="submenu-active">'; } else {$nav_menu .='<li>';}
	$nav_menu .= '<a href="'.KUKM_WEB_ROOT_DIR.'frontpage.php">Laporan</a> <!-- Active -->
			</li>
			</li>';
	$nav_menu .= '<li>';
	$nav_menu .= '<a href="'.KUKM_WEB_ROOT_DIR.'panduan-jkuk.pdf">Panduan Data Entri</a> <!-- Active -->
			</li>
		</ul>';
	return $nav_menu;
}

function menutop($nav_active =0) {
	$top_nav = '';
//	if ($nav_active ==1) { $top_nav .='<li id="menu-active">';} else {$top_nav .='<li>';}
//	$top_nav .= '<a href="'.KUKM_WEB_ROOT_DIR.'frontpage.php"><span>Halaman Depan</span></a></li>';
	if ($nav_active ==2) { $top_nav .='<li id="menu-active">';} else {$top_nav .='<li>';}
	$top_nav .= '<a href="'.KUKM_WEB_ROOT_DIR.'datacenter.php"><span>Data Center</span></a></li>';
	if ($nav_active ==3) { $top_nav .='<li id="menu-active">';} else {$top_nav .='<li>';}
	$top_nav .= '<a href="'.KUKM_WEB_ROOT_DIR.'panel.php"><span>Panel</span></a></li>';
	if ($nav_active ==4) { $top_nav .='<li id="menu-active">';} else {$top_nav .='<li>';}
	$top_nav .= '<a href="'.KUKM_WEB_ROOT_DIR.'laporan.php"><span>Laporan</span></a></li>';

	return $top_nav;

}
?>
