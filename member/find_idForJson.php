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
$phone = $_POST['phone'];
$confirm = $_POST['confirm'];

if(strpos($confirm,'ac.kr') === false){
    $status = "이메일 형식이 올바르지 않습니다.";
    echo(json_encode(array("result" => $status)));
    exit();
}

$sql = "SELECT user_id FROM member WHERE pNum = '{$phone}' AND email = '{$confirm}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if($row[0] == 0){
    $status = "일치하는 회원이 존재하지 않습니다.";
    echo(json_encode(array("result" => $status)));
    exit();
}
$user_id = $row['user_id'];

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
    $mail -> addAddress($confirm, $confirm);
// 첨부파일
//    $mail -> addAttachment("./test1.zip");
//
//    $mail -> addAttachment("./test2.jpg");
// 메일 내용
    $mail -> isHTML(true); // HTML 태그 사용 여부는
    $mail -> Subject = "캠퍼스링 아이디 찾기";  // 메일 제목
    $content = "<h2>고객님의 캠퍼스링 아이디는 <span style='color: #7d0000;'>[".$user_id."]</span> 입니다.</h2>";
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