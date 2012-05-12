<?php
function navigation($nav_active=0) {
	$nav_menu = '<ul class="box">';
	if ($nav_active == 5) { $nav_menu .='<li id="submenu-active">'; } else {$nav_menu .='<li>';}
	$nav_menu .='<a href="datacenter-harian.php?list">Data Harian</a>
				<ul>
					<li><a href="datacenter-harian.php">Entry Data</a></li>
					<li><a href="datacenter-uploaddata-harian.php">Upload Data</a></li>
					<li><a href="datacenter-laporansementara-harian.php">Laporan Harian Sementara</a></li>
				</ul>
			</li>';
	if ($nav_active == 1) { $nav_menu .='<li id="submenu-active">'; } else {$nav_menu .='<li>';}
	if (isset($_SESSION['tipekoperasi']) AND ($_SESSION['tipekoperasi'] == 3 OR $_SESSION['tipekoperasi'] == 5)) {
		$nav_menu .='<a href="datacenter-entrysyariah.php?list">Neraca</a>
				<ul>
					<li><a href="datacenter-entrysyariah.php">Entry Data</a></li>
					<li><a href="datacenter-uploaddata.php">Upload Data</a></li>
					<li><a href="datacenter-laporansementara.php">Laporan Neraca Sementara</a></li>
				</ul>
			</li>';
	} else {
		$nav_menu .='<a href="datacenter-entrydata.php?list">Neraca</a>
				<ul>
					<li><a href="datacenter-entrydata.php">Entry Data</a></li>
					<li><a href="datacenter-uploaddata.php">Upload Data</a></li>
					<li><a href="datacenter-laporansementara.php">Laporan Neraca Sementara</a></li>
				</ul>
			</li>';
	}
	if ($nav_active == 2) { $nav_menu .='<li id="submenu-active">'; } else {$nav_menu .='<li>';}
	if (isset($_SESSION['tipekoperasi']) AND ($_SESSION['tipekoperasi'] == 3 OR $_SESSION['tipekoperasi'] == 5)) {
		$nav_menu .='<a href="datacenter-entrydata-phu-syariah.php?list">Sisa Hasil Usaha KSP</a>
				<ul>
					<li><a href="datacenter-entrydata-phu-syariah.php">Entry Data</a></li>
					<li><a href="datacenter-uploaddata.php">Upload Data</a></li>
					<li><a href="datacenter-laporansementara.php">Laporan Neraca Sementara</a></li>
				</ul>
			</li>';
	} else {
		$nav_menu .= '<a href="datacenter-entrydata-phu.php?list">Sisa Hasil Usaha KSP</a>
				<ul>
					<li><a href="datacenter-entrydata-phu.php">Entry Data</a></li>
					<li><a href="datacenter-uploaddata-phu.php">Upload Data</a></li>
					<li><a href="datacenter-laporansementara-phu.php">Laporan SHU Sementara</a></li>
				</ul>
			</li>';
	}
	if ($nav_active == 3) { $nav_menu .='<li id="submenu-active">'; } else {$nav_menu .='<li>';}
	$nav_menu .= '<a href="datacenter-entrydata-nonfinansial.php?list">Data Pendukung Lain</a>
				<ul>
					<li><a href="datacenter-entrydata-nonfinansial.php">Entry Data</a></li>
					<li><a href="datacenter-uploaddata-nonfinansial.php">Upload Data</a></li>
					<li><a href="datacenter-laporansementara-nonfinansial.php">Laporan Data Non Finansial</a></li>
				</ul>
			</li>';
	if ($nav_active == 4) { $nav_menu .='<li id="submenu-active">'; } else {$nav_menu .='<li>';}
	$nav_menu .= '<a href="frontpage.php">Laporan</a> <!-- Active -->
			</li>
		</ul>';
	return $nav_menu;
}

function menutop($nav_active =0) {
	$top_nav = '';
//	if ($nav_active ==1) { $top_nav .='<li id="menu-active">';} else {$top_nav .='<li>';}
//	$top_nav .= '<a href="frontpage.php"><span>Halaman Depan</span></a></li>';
	if ($nav_active ==2) { $top_nav .='<li id="menu-active">';} else {$top_nav .='<li>';}
	$top_nav .= '<a href="datacenter.php"><span>Data Center</span></a></li>';
	if ($nav_active ==3) { $top_nav .='<li id="menu-active">';} else {$top_nav .='<li>';}
	$top_nav .= '<a href="panel.php"><span>Panel</span></a></li>';
	if ($nav_active ==4) { $top_nav .='<li id="menu-active">';} else {$top_nav .='<li>';}
	$top_nav .= '<a href="laporan.php"><span>Laporan</span></a></li>';

	return $top_nav;

}
?>