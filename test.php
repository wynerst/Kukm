<?php
require 'sysconfig.inc.php';
require 'lib/authenticate.php';
echo "here";


$nama = 'srihadi';
$kunci = '12345';

if (authenticate($nama,$kunci)) {
    echo '<script type="text/javascript">';
    echo 'alert(\'Selamat datang di KUKM, '.$_SESSION['userName'].'\');';
    #echo 'location.href = \'admin/index.php\';';
    #echo 'location.href = \'frontpage.php\';';
    echo '</script>';
    echo "HELLO-World";
} else {
    echo '<script type="text/javascript">alert(\'Username dan Password tidak cocok!\');</script>';
    echo "No-World";    
}
