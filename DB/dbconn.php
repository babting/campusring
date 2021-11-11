<?php
/**
 * Created by PhpStorm.
 * User: BK
 * Date: 2021-09-17
 * Time: 오후 11:16
 */

$dPconfig['dbtype'] = 'mysql';
$dPconfig['querytype'] = 'mysql';
$dPconfig['dbhost'] = '114.201.140.12';
$dPconfig['dbname'] = 'campusring';
$dPconfig['dbuser'] = 'campusring';
$dPconfig['dbpass'] = 'campusring';


$db_host    = $dPconfig['dbhost'];
$db_user    = $dPconfig['dbuser'];
$db_pass    = $dPconfig['dbpass'];
$db_name    = $dPconfig['dbname'];
$portNumeber = "43307";

$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name,$portNumeber);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
mysqli_query($conn, "set names utf8");
?>