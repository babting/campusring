<?php
/**
 * Created by PhpStorm.
 * User: bk
 * Date: 9/22/21
 * Time: 4:27 PM
 */
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

$email = $_POST['email'];
$authNum = $_POST['authNum'];

$query = "SELECT count(*) as cnt FROM authcheck WHERE authId = '$email' AND authNum = '$authNum' ";
$result = mysqli_fetch_array(mysqli_query($conn, $query));
$cnt = $result['cnt'];
if ($cnt == '1'){
    $del_query = "DELETE FROM authcheck WHERE authId = '$email' AND authNum = '$authNum'";
    $result = mysqli_query($conn, $del_query);
    if ($result){
        $status = "SUCCESS";
    }else{
        $status = "DB_FAIL";
    }
}else{
    $status = "NO_DATA";
}

echo(json_encode(array("result" => $status)));

mysqli_close($conn);

?>