<?php
/**
* Created by PhpStorm.
* User: Lsj
* Date: 2021-09-22
* Time: 오후 6:25
*/

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

session_start();

require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
header("Content-Type: application/json");   // php에서 json으로 주고 받을 때 header 값 셋팅

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL);    // mysql sql exception을 읽을 수 있도록 한다.

$id=$_SESSION['user_id'];
//$user_id=$_POST['user_id'];
$qna_title=$_POST['qna_title'];
$qna_ask=$_POST['qna_contents'];


try {
    $sql = "insert into qna (user_id, qna_title, qna_ask, qna_answer)";
    $sql = $sql."values('$id','$qna_title','$qna_ask','응답')";
    if($conn->query($sql)){
        echo(jsonSuccess());
    }
} catch (mysqli_sql_exception $e) {
    echo $e -> getMessage();
} catch (Exception $e) {
    echo $e -> getMessage();
}

mysqli_close($conn);
?>