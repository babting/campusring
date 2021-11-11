<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
header("Content-Type: application/json");   // php에서 json으로 주고 받을 때 header 값 셋팅

session_start();

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX);

$id=$_SESSION['user_id'];

//$conn = mysqli_connect("server.waveon.biz", "campusring", "campusring", "campusring", 43307); // db 서버 접속

$sql = "SELECT r_context, r_star, r_date, review_id, mentor_id
                    , (select name from member where user_id = '{$id}') AS r_name
                    , (select photo from member where user_id = '{$id}') AS photo
                    FROM review
                    where review_id='$id'";

try {
    $result=mysqli_query($conn, $sql);

    $dataList = array();

    while($row= mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        array_push($dataList, array(
            "r_name" => $row["r_name"],
            "user_id"=> $row["user_id"],
            "r_star"=> $row["r_star"],
            "r_date"=> $row["r_date"],
            "photo"=> $row["photo"],));
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