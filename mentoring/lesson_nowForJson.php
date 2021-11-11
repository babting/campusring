<?php

session_start();
//require("../jsonUtil.php");
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

//mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX);
$class_id=$_POST['class_id'];
$photo = "/asset/uploadImg/profile/";

//try {
    $sql = "update match_class set state = '4', state_nm = '매칭종료' where class_id = '$class_id'";
    $result = mysqli_query($conn, $sql);
//} catch (mysqli_sql_exception $e) {
//    echo $e -> getMessage();
//} catch (Exception $e) {
//    echo $e -> getMessage();
//}
if ($result)
    echo(json_encode(array("result" => true)));
else
    echo(json_encode(array("result" => false)));
mysqli_close($conn);
?>