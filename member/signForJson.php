<?php
/**
* Created by PhpStorm.
* User: Babting
* Date: 2021-09-22
* Time: 오후 11:33
**/

require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
header("Content-Type: application/json");   // php에서 json으로 주고 받을 때 header 값 셋팅

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL);    // mysql sql exception을 읽을 수 있도록 한다.

$id=$_POST['m_id'];
$passwd=$_POST['m_pw'];
$name=$_POST['m_name'];
$univ=$_POST['m_be'];

$year=$_POST['m_yy'];
$month=$_POST['m_mm'];
$date=$_POST['m_dd'];


$pNum1=$_POST['m_ph1'];
$pNum2=$_POST['m_ph2'];

$cate1=$_POST['m_cate1'];
$cate2=$_POST['m_cate2'];
$cate3=$_POST['m_cate3'];

$gender=$_POST['gender'];

/* 메일 인증하기 */
$to = trim($_POST['email_chk']); // 받는사람 메일주소
$subject = '메일 인증';
$message = '메일 인증되셨습니다! 로그인 후 서비스를 이용해주시길 바랍니다.';

$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=utf-8';

$headers[] = 'From: webmaster<받는사람@학교이름.ac.kr>';


$conn = mysqli_connect("server.waveon.biz", "campusring", "campusring", "campusring", 43307); // db 서버 접속

$birth=$year.$month.$date;
$pNum=$pNum1.$pNum2;

/* 메일 인증하기 */
mail($to, $subject, $message, implode("\r\n", $headers));
echo "편지를 보냈습니다.";
echo "<script language=javascript> alert('메일인증성공!'); location.replace('http://localhost:80'); </script>";

try {
    $sql = "insert into member (id, password, birthday, pNum, name, sex, cate1, cate2, cate3)";
    $sql = $sql."values('$id','$passwd','$birth','$pNum','$name','$gender','$cate1','$cate2','$cate3')";
    if($conn->query($sql)){
        echo(jsonSuccess());
    }
} catch (mysqli_sql_exception $e) {
    echo $e -> getMessage();
} catch (Exception $e) {
    echo $e -> getMessage();
}

?>