<?php
/**
 * Created by PhpStorm.
 * User: LSJ
 * Date: 2021-09-23
 * Time: 오후 4:00
 */

require("../jsonUtil.php");

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
session_start();

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX);

$password=$_POST['password'];
$id=$_SESSION['user_id'];


$sql = "SELECT 
            password
        FROM member
        where user_id = '{$id}'";

try {
    $result=mysqli_query($conn, $sql);

    $row= mysqli_fetch_array($result, MYSQLI_ASSOC);

    $pw= $row['password'];

    $member = array(
        'password'=>$pw,
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


mysqli_close($conn);
?>
