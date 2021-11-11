<?php
require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
session_start();

$esti_id = $_POST['esti_id'];
$answer = $_POST['answer'];

$data = array(
    "esti_id" =>$esti_id,
    "answer"=>$esti_id,
);

if($answer=='yes'){
    $state = 2;
    $state_nm = '매칭수락';
}else if($answer=='no'){
    $state = 3;
    $state_nm = '매칭거절';
}else if($answer=='end'){
    $state = 4;
    $state_nm = '매칭종료';
}

$sql = "update match_class set state='$state', state_nm='$state_nm' where id='$esti_id'";
if($conn->query($sql)){
    echo(jsonSuccess($data));
} else {
    echo(jsonFailure("실패하였습니다.", 409, mysqli_error($conn))); // jsonUtil.php 에 있는 jsonFailure() 메소드 사용. --> message와 code를 동적으로 할당
}
//
//echo jsonSuccess($data);
/*ex) HELLOWORLD를 입력하게되면 서버에 갔다 다시 msg라는 REQUEST에 저장됨*/
/*json_encode 형태의 배열형태로 저장되며 텍스트형식으로 찍음*/
?>