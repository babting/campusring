<?php
    require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
    header("Content-Type: application/json");   // php에서 json으로 주고 받을 때 header 값 셋팅


try {
    $conn = mysqli_connect("server.waveon.biz", "campusring", "campusring", "campusring", 43307); // db 서버 접속

    // 아래 여러 테이블을 합치는 쿼리입니다. 각 테이블에 중복되는 컬럼 명이 있으면 테이블.컬럼으로 쓰고 별칭을 줘야 합니다.
 //   $stmt = $conn->prepare("SELECT A.sex
  //  FROM A
 //   LEFT OUTER JOIN B
  //  ON A.sex = B.sex
  //   "); // 왼쪽에 먼저 쓴 테이블을 기준으로 ON 컬럼 으로 줄을 맞춥니다.
  //  $stmt->execute();

    $sex=$_POST['sex'];
    $place=$_POST['best_place'];
   // $period=$_POST['period'][0];
    $time=$_POST['time'];
    $big_cate=$_POST['big_cate'];

    $sql = "insert into class (class_id,id, title, big_cate, small_cate, place, period, time, day_week, thumbnail, context, video)";
    $sql = $sql."values(1,'id', 'title','$big_cate','small_cate','$place','22','$time','day_week','thumbnail','context','video')";
    if($conn->query($sql)){
        echo(jsonSuccess());
    } else {
        echo(jsonFailure("맞춤 멘토를 찾을 수 없습니다.", 409, mysqli_error($conn))); // jsonUtil.php 에 있는 jsonFailure() 메소드 사용. --> message와 code를 동적으로 할당
    }


} catch (mysqli_sql_exception $e) {
    echo $e -> getMessage();
} catch (Exception $e) {
    echo $e -> getMessage();
}

?>