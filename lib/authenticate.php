<?php

function authenticate($name="guest", $pass="guest")
{    
global $dbs;
    
    $sql = "SELECT * from user as u LEFT JOIN koperasi as k
        ON u.koperasi_idkoperasi = k.idkoperasi
        WHERE login = '$name' and password = '$pass'";
    $rs_user = $dbs->query($sql);
    //$numrec = $rs_user->affected_rows;
    //if ($numrec > 0) {
    while ($rec_user =$rs_user->fetch_assoc()) {
        $_SESSION['userName']=$rec_user['nama'];
        $_SESSION['koperasi']= $rec_user['koperasi_idkoperasi'];
        $_SESSION['group']= $rec_user['group_idgroup'];
        $_SESSION['tipekoperasi']= $rec_user['jenis'];
        $_SESSION['email']= $rec_user['email'];
        return true;
    }
    //} else {
        //return false;
    //}
}
?>