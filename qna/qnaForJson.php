<?php
/**
 * Created by PhpStorm.
 * User: Lsj
 * Date: 2021-09-24
 * Time: 오후 6:45
 */

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

session_start();

require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
header("Content-Type: application/json");   // php에서 json으로 주고 받을 때 header 값 셋팅

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX);    // mysql sql exception을 읽을 수 있도록 한다.

$id=$_SESSION['user_id'];

$sql = "SELECT * FROM qna where user_id='$id'";


try {
    $result=mysqli_query($conn, $sql);

    $dataList = array();

    while($row= mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        array_push($dataList, array(
            "qna_title" => $row["qna_title"],
            "qna_ask"=> $row["qna_ask"],
            "qna_answer" => $row["qna_answer"],));
    }

//if($conn->query($select_member_query)){
    echo(jsonSuccess($dataList));
//} else {
//    echo(jsonFailure("정보를 가져오는데 실패하였습니다.", 409, mysqli_error($conn))); // jsonUtil.php 에 있는 jsonFailure() 메소드 사용. --> message와 code를 동적으로 할당
//}
} catch (mysqli_sql_exception $e) {
    echo $e -> getMessage();
} catch(Exception $e) {
    //echo $e -> getMessage();
}

mysqli_close($conn);
?>
