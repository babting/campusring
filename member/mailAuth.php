<?php
/**
 * Created by PhpStorm.
 * User: bk
 * Date: 9/22/21
 * Time: 1:38 PM
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'].'/libraries/PHPMailer-master/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'].'/libraries/PHPMailer-master/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/libraries/PHPMailer-master/src/SMTP.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

$authType = 'email';
$authId = $_POST['email'];

//메일 중복체크
$query = "SELECT count(*) as cnt FROM member WHERE email = '{$authId}' ";
$result = mysqli_fetch_array(mysqli_query($conn, $query));
if ($result['cnt'] == '1'){
    $status = "중복된 이메일입니다.";
}else{
    $fname = '캠퍼스링';
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 8 ; $i++) {
        $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
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
        $mail -> addAddress($authId, $authId);

// 첨부파일
//    $mail -> addAttachment("./test1.zip");
//
//    $mail -> addAttachment("./test2.jpg");
// 메일 내용
        $mail -> isHTML(true); // HTML 태그 사용 여부
        $mail -> Subject = "캠퍼스링 이메일 인증번호 인증";  // 메일 제목
        $content = "<h2>캠퍼스링 인증번호는 <span style='color: #7d0000;'>[".$randomString."]</span> 입니다.</h2>";
        $mail -> Body = $content;     // 메일 내용
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
        $query = "INSERT INTO authcheck(authType, authId, authNum, regDate) VALUES ('$authType', '$authId', '$randomString', now())";
        $result = mysqli_query($conn, $query);
//    echo "Message has been sent";
        $status = "SUCCESS";
    } catch (Exception $e) {
        $status =  "Message could not be sent. Mailer Error : ". $mail -> ErrorInfo;
    }
}

echo(json_encode(array("result" => $status)));

/* gmail 계정 > 보안 > 보안 수준이 낮은 앱의 엑세스 사용으로 변경 필요 */

?>
