<?php
/**
 * Created by PhpStorm.
 * User: BK
 * Date: 2021-09-17
 * Time: 오후 11:08
 */

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

// 원래 백단에서도 NULL Check는 한번 더 하는게 좋습니다.

$id = $_POST['user_id'];
$la = $_POST['locationY'];
$lo = $_POST['locationX'];

$checkquery = "SELECT count(*) as cnt from location where user_id = '$id' ";
$checkresult = mysqli_query($conn, $checkquery);
$checkrow = mysqli_fetch_array($checkresult);

if ($checkrow['cnt'] > 0){
    $query = "UPDATE location SET latitude = '$la', longitude = '$lo' WHERE user_id = '$id' ";
}else{
    $query = "INSERT INTO location (user_id, latitude, longitude)  ";
    $query .= " VALUES('$id', '$la','$lo') ";
}

$result = mysqli_query($conn, $query);
if($result === false){
    echo(json_encode(array("result" => "DB_ERROR1")));
}else{
        echo(json_encode(array("result" => "success")));
}


mysqli_close($conn);
?>