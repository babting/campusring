<?php
/**
 * Created by PhpStorm.
 * User: lsj
 * Date: 2021-09-23
 * Time: 오후 6:00
 */

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
header("Content-Type: application/json");   // php에서 json으로 주고 받을 때 header 값 셋팅

session_start();

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX);

$id=$_SESSION['user_id'];

$sql = "SELECT 
            name, password, email, cate1, cate2, cate3
        FROM member
        where user_id = '{$id}'";        // member 정보

try {
    $result=mysqli_query($conn, $sql);

    $row= mysqli_fetch_array($result, MYSQLI_ASSOC);

    $name= $row['name'];
    $password= $row['password'];
    $email= $row['email'];
    $cate1 = $row['cate1'];
    $cate2 = $row['cate2'];
    $cate3 = $row['cate3'];

    $member = array(
        'name'=>$name,
        'password'=>$password,
        'email'=>$email,
        'cate1'=>$cate1,
        'cate2'=>$cate2,
        'cate3'=>$cate3
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
