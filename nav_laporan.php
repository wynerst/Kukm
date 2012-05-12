<?php
function navigation($nav_active=0) {
	$nav_menu = '<ul class="box">';
	if ($nav_active == 1) { $nav_menu .='<li id="submenu-active">'; } else {$nav_menu .='<li>';}
	$nav_menu .='<a href="#">Laporan</a>
                <ul>
                    <li><a href="frontpage.php">Dashboard</a></li>
                    <li><a href="#">User Grup</a></li>
                    <li><a href="#">Chart of Account</a></li>
                </ul>
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