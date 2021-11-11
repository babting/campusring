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
$way = $_POST['pay_method'];
$amounts = $_POST['amount'];
$cost = $_POST['cost'];
$buyer_email = $_POST['buyer_email'];
$buyer_name = $_POST['buyer_name'];
$buyer_tel = $_POST['buyer_tel'];



$query = "INSERT INTO choco (user_id, type, amounts, who, way, date, cost, buyer_email, buyer_name, buyer_tel) ";
$query .= " VALUES('$id', 'get', $amounts, '$id', '$way', now(), $cost, '$buyer_email', '$buyer_name', '$buyer_tel') ";
$result = mysqli_query($conn, $query);
if($result === false){
    echo(json_encode(array("result" => "DB_ERROR1")));
}else{
    $chocoSql = "UPDATE member SET choco = choco + {$amounts} WHERE user_id = '$id' " ;
    $chocoResult = mysqli_query($conn, $chocoSql);
    if ($chocoResult){
        echo(json_encode(array("result" => "success")));
    }else{
        echo(json_encode(array("result" => "DB_ERROR2")));
    }
}


mysqli_close($conn);
?>