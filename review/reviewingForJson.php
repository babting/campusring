<?php
/**
* Created by PhpStorm.
* User: Babting
* Date: 2021-10-05
* Time: 오후 20:37
*/
// 순싹... help me.......

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

session_start();

require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
header("Content-Type: application/json");   // php에서 json으로 주고 받을 때 header 값 셋팅

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL);    // mysql sql exception을 읽을 수 있도록 한다.

$review_id = $_SESSION['user_id'];

$class_id = $_POST['class_id'];
$mentor_id = $_POST['mentor_id'];
$r_star=$_POST['rating'];
$r_context=$_POST['rev_cont'];

//$conn = mysqli_connect("server.waveon.biz", "campusring", "campusring", "campusring", 43307); // db 서버 접속

try {
    $sql = "insert into review (review_id, mentor_id, r_star, r_context, class_id)";
    $sql = $sql."values('$review_id', '$mentor_id', '$r_star','$r_context', '$class_id')";
    if($conn->query($sql)){
        echo(jsonSuccess());
    }
} catch (mysqli_sql_exception $e) {
    echo $e -> getMessage();
} catch (Exception $e) {
    echo $e -> getMessage();
}
?>
