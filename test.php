<?php
require 'sysconfig.inc.php';
require 'lib/authenticate.php';
echo "here";


$nama = 'srihadi';
$kunci = '12345';

if (authenticate($nama,$kunci)) {
    echo '<html><script type="text/javascript">';
    echo 'alert(\'Selamat datang di KUKM, '.$_SESSION['userName'].'\');';
    #echo 'location.href = \'admin/index.php\';';
    #echo 'location.href = \'frontpage.php\';';
    echo '</script>';
    echo "HELLO-World";
} else {
    echo '<script type="text/javascript">alert(\'Username dan Password tidak cocok!\');</script>';
    echo "No-World";    
}

$sql_text("INSERT INTO `logs` (`userID`,`parts`,`notes`,`recorded`,`ipid`) VALUES ('0', 'Login', 'Login failed', '2012-05-27 21:05:49', '127.0.0.1')");
echo "<br />".$sql_text;
$test = $dbs->query($sql_text);
if (!$test) {
    $test->error;
}
echo "<br />Result:".$test->affected_rows."<br />".$test->insert_id;

echo "</html>";