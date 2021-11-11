<?php
require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
header("Content-Type: application/json");   // php에서 json으로 주고 받을 때 header 값 셋팅

session_start();

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX);

$id=$_SESSION['user_id'];

$conn = mysqli_connect("server.waveon.biz", "campusring", "campusring", "campusring", 43307); // db 서버 접속

$sql = "SELECT 
                t1.email, t1.name, t1.choco, t1.photo
                , (select count(*) from review where user_id = '{$id}') AS review_cnt
                , (select count(*) from match_class where user_id = '${id}') AS match_class_cnt
            FROM member t1
            where user_id = '{$id}'";   // member 정보

try {
    $result=mysqli_query($conn, $sql);

    $row= mysqli_fetch_array($result, MYSQLI_ASSOC);

    $name= $row['name'];
    $choco= $row['choco'];
    $email = $row['email'];
    $photo = $row['photo'];
    $review_cnt= $row['review_cnt'];
    $match_class_cnt = $row['match_class_cnt'];

    $member = array(
        'name'=>$name,
        'email'=>$email,
        'choco'=>$choco,
        'img_ch'=>$photo,
        'match_enro'=>$match_class_cnt,
        'review_did'=>$review_cnt,
    );

    echo(jsonSuccess($member));

} catch (mysqli_sql_exception $e) {
    echo $e -> getMessage();
} catch(Exception $e) {
    //echo $e -> getMessage();
}
?>