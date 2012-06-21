<?php
function navigation($nav_active=0) {
	$nav_menu = '<ul class="box">';
	if ($nav_active == 1) { $nav_menu .='<li id="submenu-active">'; } else {$nav_menu .='<li>';}
	$nav_menu .='<a href="'.KUKM_WEB_ROOT_DIR.'panel.php">Panel</a>
					<ul>';
    if ($_SESSION['group'] == 1) {
        $nav_menu .='<li><a href="'.KUKM_WEB_ROOT_DIR.'panel-tambahlembaga.php">Daftar Lembaga Baru</a></li>
        <li><a href="'.KUKM_WEB_ROOT_DIR.'panel-tambahuser.php">Tambah User Baru</a></li>
        <li><a href="'.KUKM_WEB_ROOT_DIR.'panel-tambahgroup.php">Buat Grup Baru</a></li>
        <li><a href="'.KUKM_WEB_ROOT_DIR.'panel-daftarlembaga.php">Daftar Lembaga</a></li>
        <li><a href="'.KUKM_WEB_ROOT_DIR.'panel-daftaruser.php">Daftar User</a></li>
        <li><a href="'.KUKM_WEB_ROOT_DIR.'panel-daftargroup.php">Daftar Grup</a></li>';
    } else {
        $nav_menu .='<li><a href="'.KUKM_WEB_ROOT_DIR.'panel-tambahuser.php">Tambah User Baru</a></li>
        <li><a href="'.KUKM_WEB_ROOT_DIR.'panel-daftarlembaga.php">Daftar Lembaga</a></li>
        <li><a href="'.KUKM_WEB_ROOT_DIR.'panel-daftaruser.php">Daftar User</a></li>';
    }
	$nav_menu .='</ul>
			</li>';
	if ($nav_active == 2) { $nav_menu .='<li id="submenu-active">'; } else {$nav_menu .='<li>';}
	$nav_menu .='<a href="'.KUKM_WEB_ROOT_DIR.'panel.php">Administrasi</a>
					<ul>
<!--						<li><a href="'.KUKM_WEB_ROOT_DIR.'laporan/harian.php">Stat. Laporan Harian</a></li>
-->
						<li><a href="'.KUKM_WEB_ROOT_DIR.'laporan/bulanan.php">Stat. Laporan Bulanan</a></li>
						<li><a href="'.KUKM_WEB_ROOT_DIR.'laporan/tahunan.php">Stat. Laporan Tahunan</a></li>
					</ul>
			</li>';
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