<?php

require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
header("Content-Type: application/json");   // php에서 json으로 주고 받을 때 header 값 셋팅

// mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL);

$big_cate=$_POST['big_cate']; //현재는 실무교육/컴퓨터 (computer) 만 작동하도록 해놨습니다


$conn = mysqli_connect("server.waveon.biz", "campusring", "campusring", "campusring", 43307); // db 서버 접속


$sql = "select sebu_kr, i from category where big_kr = '{$big_cate}'";

try {
    $result = mysqli_query($conn, $sql); //결과를 담기
    $arr = array();
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $sub_category = array(
            "sebu" => $row['sebu_kr'],
            "idx" => $row['i']
        );
        array_push($arr, $sub_category);
    }

    //$row = mysqli_fetch_array($result);

    echo(jsonSuccess($arr));
    return;
} catch(mysqli_sql_exception $e) {
    echo $e -> getMessage();
} catch(Exception $e) {
    echo $e -> getMessage();
}

//if($conn->query($sql)){
//    echo(jsonSuccess()); //셀렉트문으로 가져온 값은 어떻게 출력하나용
//} else {
//    echo(jsonFailure("조회 실패하였습니다.", 409, mysqli_error($conn))); // jsonUtil.php 에 있는 jsonFailure() 메소드 사용. --> message와 code를 동적으로 할당
//}


?>