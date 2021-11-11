<?php
require("jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
header("Content-Type: application/json");   // php에서 json으로 주고 받을 때 header 값 셋팅

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL);    // mysql sql exception을 읽을 수 있도록 한다.

$user_id = $_POST['user_id'];
$pw = $_POST['pw'];

$conn = mysqli_connect("server.waveon.biz", "campusring", "campusring", "campusring", 43307); // db 서버 접속

$sql = "SELECT * FROM member WHERE user_id = '{$user_id}'";

try {
    $result = mysqli_query($conn, $sql); // query 실행 부분

    $row = mysqli_fetch_array($result);

    if ($row == null) {
        // HTTP STATUS CODE 참고 (https://developer.mozilla.org/ko/docs/Web/HTTP/Status) --> 200번대, 400번대 확인하시면 될 것 같아요.

        echo(jsonFailure("존재하지 않은 회원입니다.", 404));       // jsonUtil.php 에 있는 jsonFailure() 메소드 사용. --> message와 code를 동적으로 할당
        return;
    } else {
        $hashedPassword = $row['password'];
        $passwordResult = strcmp($pw, $hashedPassword);
        if ($passwordResult == 0) {
            // 로그인 성공
            // 세션에 id 저장
            session_start();
            $_SESSION['user_id'] = $user_id;
            echo(jsonSuccess());        // jsonUtil.php에 있는 jsonSuccess() 메소드 호출. --> 로그인 성공 후 내려줄 데이터가 없으므로 $data를 채워주지 않고 사용.(default가 null이므로)
        } else {
            echo(jsonFailure("비밀번호가 일치하지 않습니다.", 409)); // jsonUtil.php 에 있는 jsonFailure() 메소드 사용. --> message와 code를 동적으로 할당
        }
    }
} catch (mysqli_sql_exception $e) {
    echo $e -> getMessage();    // query 에 대한 exception throw
} catch (Exception $e) {
    echo $e -> getMessage();    // server error 에 대한 exception throw
}
?>