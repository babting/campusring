<!DOCTYPE html>
<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];
?>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <!--jquery ajax-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!----
    현재 보유 초코링

   날짜
   과목 키워드ㅡ
   타이틀
   멘토'이름'
   초코 ''개
    --->
    <title>사용내역페이지</title>
</head>
<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onclick="location.href='/index.php'"></i></div>
    <div class="login_text">초코샵</div>
    <div class=""></div>
</header>

<div class="container">

    <div class="buy_top">
        <ul>
            <li><a href="../chocoring/buy_ring.php" target="_self">초코링구매</a></li>
            <li><a href="../chocoring/buy_history.php" target="_self">구매내역</a></li>
            <li><a href="../chocoring/buy_use.php" target="_self">사용내역</a></li>
        </ul>
    </div>
    <?php
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT choco FROM member where user_id='$user_id'";
    $re = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($re);
    $rest = $row['choco'];
    ?>
    <div class="buy_now">
        <img src="../img/ring.PNG" alt="현재보유 초코링">
        현재 보유한 초코링 <span class="buy_count" id="user_ring"><?= $rest?>개</span>
    </div>

<!--    --><?php
//    if (!isset($_SESSION['user_id'])){
//        $id = 'user_id';
//    }else{
//        $id = $_SESSION['user_id'];
//        $sql = "SELECT id FROM choco WHERE user_id = '$id' ";
//        $re = mysqli_query($conn, $sql);
//        $row = mysqli_fetch_array($re);
//        $id = $row[0];
//    }
//    $query = "SELECT * FROM choco WHERE user_id = '$id'";
//    $result = mysqli_query($conn, $query);
//    $row = mysqli_fetch_array($result);
//
//    ?>
<!---->
<!--    --><?php //while($row) {?>
<!---->
<!--    <div class="buy_use">-->
<!--        <p id="date">--><?php //echo $row['date'] ?><!--</p>-->
<!--        <p id="m_cata">--><?php //echo $row['m_cata'] ?><!--</p>-->
<!--        <p id="m_cont">--><?php //echo $row['m_cont'] ?><!--</p>-->
<!--        <p id="meormt">--><?php //echo $row['meormt'] ?><!--</p><span id="use_name">--><?php //echo $row['use_name'] ?><!--</span>-->
<!--        <p id="r_count">--><?php //echo $row['r_count'] ?><!--</p>-->
<!--    </div>-->
<!---->
<!--    --><?php //} ?>

    <?php

    $sql = "select
                t1.*
                , (select t3.title from match_class t2, class t3 where t2.id = t1.way and t2.class_id = t3.id) AS CLASS_TITLE
                , (select t3.keyword from match_class t2, class t3 where t2.id = t1.way and t2.class_id = t3.id) AS CLASS_KEYWORD
            from
                choco t1
            where 1=1
            and t1.user_id='$user_id'
            and t1.type = 'use';";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){ //if 시작

        while ($row = mysqli_fetch_array($result)){ //while 끝
            ?>
            <div class="buy_use">
                <p id="date"><?=$row['date']?></p>
                <p id="m_cata"><?=$row['CLASS_KEYWORD']?></p>
                <p id="m_cont"><?=$row['CLASS_TITLE']?></p>
                <p id="meormt">멘토 아이디 : <span id="use_name"><?=$row['who']?></span></p>
                <p id="r_count">사용 갯수 : <?=$row['amounts']?>개</p>
            </div>
            <?php
        } //while 끝

    }else{ //if 끝, else 시작?>
        <br><br>
        <p class="result_s">사용 내역이 없습니다.</p>
    <?php } //else 끝
   //mysqli_close($conn); // 디비 접속 닫기
    ?>

    <!-- 하단바 -->
    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>

    <!--하단바끝 -->
</div>
<script>
    (function() {  // 1.즉시 호출 함수 , 데이터 받기용

        $.ajax({
            type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
            url: 'buyuseJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
            data: {},          // url로 전송할 데이터 정의
            dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.

            success: function(result) {
                // url에서 해당 data를 처리하고 반환된 success 결과에 대해서 로직 처리
                console.log(result);
                var callResult = result.result; //db에서 받아오는 방법
                var callCode = result.code;
                var callData = result.data || [];   // data가 list일 경우에는 {}가 아니라 []로 쓰면 되요.
                var callErrorReason = result.errorReason || '';

                var user_ring = result.data.user_ring;
                $('#user_ring').text(user_ring+'개');
            },
            error: function(err) {
                // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
                console.log(err);
            }
        }) //에이작스 end
    })(); //함수 구현 END


</script>
</body>
</html>