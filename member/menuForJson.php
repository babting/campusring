<?php
/**
 * Created by PhpStorm.
 * User: lsj
 * Date: 2021-09-18
 * Time: 오후 3:20
 */

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
header("Content-Type: application/json");   // php에서 json으로 주고 받을 때 header 값 셋팅

session_start();

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX);

$id=$_SESSION['user_id'];

//$sql = "SELECT
//            t1.email, t1.pNum, t1.name
//            , (select rest from choco where user_id = '{$id}' order by date desc limit 1) AS choco
//            , (select count(*) from review where user_id = '{$id}') AS review_cnt
//            , (select count(*) from match_class where user_id = '${id}') AS match_class_cnt
//        FROM member t1
//        where user_id = '{$id}'";        // member 정보

$sql = "SELECT 
            t1.email, t1.pNum, t1.name
            , t1.choco
            , (select count(*) from review where review_id = '{$id}') AS review_cnt
            , (select count(*) from match_class where user_id = '${id}' and state = '2') AS match_class_cnt
        FROM member t1
        where user_id = '{$id}'";

try {
    $result=mysqli_query($conn, $sql);

    $row= mysqli_fetch_array($result, MYSQLI_ASSOC);

    $pNum= $row['pNum'];
    $name= $row['name'];
    $choco= $row['choco'];
    $email = $row['email'];
    $review_cnt = $row['review_cnt'];
    $match_class_cnt = $row['match_class_cnt'];

    $member = array(
        'email'=>$email,
        'pNum'=>$pNum,
        'name'=>$name,
        'choco'=>$choco,
        'review_did'=>$review_cnt,
        'match_did'=>$match_class_cnt
    );


//if($conn->query($select_member_query)){
    echo(jsonSuccess($member));
//} else {
//    echo(jsonFailure("정보를 가져오는데 실패하였습니다.", 409, mysqli_error($conn))); // jsonUtil.php 에 있는 jsonFailure() 메소드 사용. --> message와 code를 동적으로 할당
//}
} catch (mysqli_sql_exception $e) {
    echo $e -> getMessage();
} catch(Exception $e) {
    //echo $e -> getMessage();
}
?>