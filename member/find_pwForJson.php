<?php
require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'].'/libraries/PHPMailer-master/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'].'/libraries/PHPMailer-master/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/libraries/PHPMailer-master/src/SMTP.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

$authType = 'email';
$id = $_POST['id'];
$email = $_POST['email'];


$sql = "SELECT count(*) FROM member WHERE user_id = '{$id}' AND email = '{$email}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if($row[0] == 0){
    $status = "일치하는 회원이 존재하지 않습니다.";
    echo(json_encode(array("result" => $status)));
    exit();
}
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < 8 ; $i++) {
    $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
}
$sql = "update member set password = '$randomString' where user_id='$id'";
$result = mysqli_query($conn, $sql);
if(!$result){
    $status = "DB 업데이트에 실패하였습니다.";
    echo(json_encode(array("result" => $status)));
    exit();
}
$mail = new PHPMailer(true);
try {
// 서버세팅
//디버깅 설정을 0 으로 하면 아무런 메시지가 출력되지 않습니다
    $mail -> SMTPDebug = 0; // 디버깅 설정
    $mail -> isSMTP(); // SMTP 사용 설정
    $mail -> Host = "smtp.gmail.com";               // 네이버의 smtp 서버
    $mail -> SMTPAuth = true;                         // SMTP 인증을 사용함
    $mail -> Username = "campusring1@gmail.com";    // 메일 계정 (지메일일경우 지메일 계정)
    $mail -> Password = "bptcfnrxiwfrufhg";                  // 메일 비밀번호
    $mail -> SMTPSecure = "ssl";                       // SSL을 사용함
    $mail -> Port = 465;                                  // email 보낼때 사용할 포트를 지정
    $mail -> CharSet = "utf-8"; // 문자셋 인코딩
// 보내는 메일
    $mail -> setFrom("campusring1@gmail.com", "캠퍼스링");
// 받는 메일
    $mail -> addAddress($email, $email);
// 첨부파일
//    $mail -> addAttachment("./test1.zip");
//
//    $mail -> addAttachment("./test2.jpg");
// 메일 내용
    $mail -> isHTML(true); // HTML 태그 사용 여부는
    $mail -> Subject = "캠퍼스링 비밀번호 찾기";  // 메일 제목
    $content = "<h2>고객님의 초기화된 캠퍼스링 비밀번호는 <span style='color: #7d0000;'>[".$randomString."]</span> 입니다.</h2>";
    $mail -> Body = $content;     // 메일 내용내용
// Gmail로 메일을 발송하기 위해서는 CA인증이 필요하다.
// CA 인증을 받지 못한 경우에는 아래 설정하여 인증체크를 해지하여야 한다.
    $mail -> SMTPOptions = array(
        "ssl" => array(
            "verify_peer" => false
        , "verify_peer_name" => false
        , "allow_self_signed" => true
        )
    );
// 메일 전송
    $mail -> send();
    if ($mail)
        $status = "SUCCESS";
} catch (Exception $e) {
    $status =  "Message could not be sent. Mailer Error : ". $mail -> ErrorInfo;
}


echo(json_encode(array("result" => $status)));



?>