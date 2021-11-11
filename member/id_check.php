<?php
/**
 * Created by PhpStorm.
 * User: BK
 * Date: 2021-09-17
 * Time: 오후 11:08
 */

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

$id = $_POST['id'];
$query = "SELECT count(*) as cnt FROM member WHERE user_id = '{$id}' ";
$result = mysqli_fetch_array(mysqli_query($conn, $query));
$cnt = $result['cnt'];

echo(json_encode(array("result" => $cnt)));

mysqli_close($conn);

?>