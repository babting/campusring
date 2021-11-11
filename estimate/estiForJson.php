<?php
    require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
    header("Content-Type: application/json");

    session_start();

    $class_id = $_POST['class_id'];
    $class_id_b = explode(",", $class_id);
    $id=$_SESSION['user_id'];
    $e_date = $_POST['e_date'];
//    $e_item = $_POST['e_item'];
    $e_money =$_POST['e_money'];

    $conn = mysqli_connect("server.waveon.biz", "campusring", "campusring", "campusring", 43307); // db 서버 접속

    $data = array(
        "class_id" =>$class_id,
        "Id"=>$id,
        "e_date"=>$e_date,
//        "e_item"=>$e_item,
        "e_money"=>$e_money
    );

    $sql = "insert into match_class (class_id, user_id, e_date, e_item, e_money, state, state_nm)";
    $sql = $sql."values('$class_id_b[0]', '$id','$e_date','$class_id_b[1]','$e_money','1','매칭요청')";
    if($conn->query($sql)){
        echo(json_encode(array("result" => "ture")));
    } else {
        echo(jsonFailure("실패하였습니다.", 409, mysqli_error($conn))); // jsonUtil.php 에 있는 jsonFailure() 메소드 사용. --> message와 code를 동적으로 할당
    }

//    echo jsonSuccess($data);
    /*ex) HELLOWORLD를 입력하게되면 서버에 갔다 다시 msg라는 REQUEST에 저장됨*/
    /*json_encode 형태의 배열형태로 저장되며 텍스트형식으로 찍음*/
?>