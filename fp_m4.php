<?php
if (isset($_POST['tampilkan'])) {
    $tampilkan = $_POST['pilihan'];
}
$frontpage_content = "<h3>Laporan Bulanan</h3>\n<p align=\"center\">\n";
$frontpage_content .= '<form method="POST"><table><tr>';
$form_sel = '<td align="center"><input type="radio" value="1" name="pilihan"/>&nbsp;Simpanan & Pinjaman</td>';
$form_sel .= '<td align="center"><input type="radio" value="2" name="pilihan"/>&nbsp;Modal Dalam & Modal Luar</td>';
$form_sel .= '<td align="center"><input type="radio" value="3" name="pilihan"/>&nbsp;Volume Usaha, Aset, dan SHU</td>';
$form_sel .= '<td align="center"><input type="radio" value="4" name="pilihan"/>&nbsp;Suku Bunga Simpanan, Pinjaman & NPL</td>';
$form_sel .= '<td align="center"><input type="reset" value="Reset"/>&nbsp;<input type="submit" name="tampilkan" value="Tampilkan"/></td>';

$frontpage_content .= $form_sel.'</td></tr></table></form></p>';

//$frontpage_content .= "<div id=\"slider\">\n<ul>\n";
switch($tampilkan) {
    case 1:
        $frontpage_content .= "<img src=\"simpleplot3m1.php\" >\n";
        break;
    case 2:
        $frontpage_content .= "<img src=\"simpleplot3m2.php\" >\n";
        break;
    case 3:
        $frontpage_content .= "<img src=\"simpleplot3m3.php\" >\n";
        break;
    case 4:
        $frontpage_content .= "<img src=\"simpleplot3m4.php\" >\n";
        break;
    default:
        $frontpage_content .= "<img src=\"simpleplot3m1.php\" >\n";
        break;
}

//$frontpage_content .= "<img src=\"simpleplot4.php\" >\n";
//$frontpage_content .= "<img src=\"simpleplot4b.php\" >\n";
//$frontpage_content .= "<img src=\"simpleplot4c.php\" >\n";
//$frontpage_content .= "<img src=\"simpleplot4d.php\" >\n";
//$frontpage_content .= "<img src=\"simpleplot4e.php\" >\n";
//$frontpage_content .= "<img src=\"simpleplot4f.php\" >\n";
//$frontpage_content .= "</ul>\n</div>\n";
$frontpage_content .= "</p>\n";
?>
