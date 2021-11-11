<!DOCTYPE html>
<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';
$user_id = $_SESSION['user_id'];
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <!--jquery ajax-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- ajax를 사용하기 위해 jquery cdn으로 불러옴. -->

    <!--견적서 작성 페이지
      페이지 담당:
      마지막 업데이트 : 210923 -VOL1
      css 미 완료
      ajax 보내기 코드 완료
      -->

    <title>견적서 작성</title>
</head>

<body>
<header class="em_hd_box">
    <div class="em_login_text">견적서작성</div>
    <div class="em_btn_prev"><i class="fas fa-times fa-2x"onClick="history.go(-1);"></i></div>
</header>
<div class="container">

    <!-- 하단바 -->


    <!--하단바끝 -->

    <!--    <nav class="container nav">-->
    <!--        <ul class="nav__list">-->
    <!--            <li class="nav_btn">-->
    <!--                <a class="nav__link" href="index.php"><img class="home" src="../img/c_home.PNG" alt="home"></a>-->
    <!--            </li>-->
    <!--            <li class="nav_btn">-->
    <!--                <a class="nav__link" href="chatting/chat.php"><span class="nav__notification badge">1</span><i-->
    <!--                            class="far fa-comment fa-2x"></i></a>-->
    <!--            </li>-->
    <!--            <li class="nav_btn"><a class="nav__link" href="estimate/estimate.php"><i-->
    <!--                            class="far fa-sticky-note fa-2x"></i></a></li>-->
    <!--            <li class="nav_btn"><a class="nav__link" href="member/mypage.php"><i class="far fa-user fa-2x"></i></a></li>-->
    <!--            <li class="nav_btn"><a class="nav__link" href="map/map.php"><i class="fas fa-gift fa-2x"></i></a></li>-->
    <!--        </ul>-->
    <!--    </nav>-->

    <div id="result"></div>

    <div class="em_input_sort">
        <p>멘티 아이디</p>
        <input type="text" id="id" />
    </div>

    <div class="em_input_sort">
        <p>날짜</p>
        <input type="date" id="e_date" /> <!-- 누가 작성했는지?-->
    </div>


    <div class="em_input_sort">
        <p>서비스</p>
            <select id="service" name="service" style="">
                <option value="미선택">선택</option>
                <?php

                $sql = "select * from class where user_id='$user_id'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) { //if 시작

                    while ($row = mysqli_fetch_array($result)) { //while 끝
                        ?>
                        <option value="<?= $row['id'].','.$row['title']  ?>"><?= $row['title'] ?></option>
                        <?php
                    } //while 끝

                } else { //if 끝, else 시작
                    ?>
                    <option value="">해당 검색 조건에 해당하는 내역이 없습니다.</option>
                <?php } //else 끝
              //  mysqli_close($conn); // 디비 접속 닫기


                ?>
            </select>
    </div>





    <div class="em_input_sort ft-si1">
        <p>제안항목</p>
        <input type="radio" id="e_change" name="e_item" value="교환"/>교환
        <input type="radio" id="e_cho" name="e_item" value="초코링"/>초코링
        <input type="radio" id="e_dal" name="e_item" value="돈"/>돈
    </div>

    <div class="em_input_sort">
        <p>제안금액</p>
        <input type="text" id="e_money" /> <!-- 누가 작성했는지?-->
    </div>

    <div class="em_input_sort">
        <button type="submit" id="getResult">작성완료</button>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
    <script>
        $('#getResult').click(function () {
            $('#result').html(''); /*21번째 줄 result 사용 .html 공백으로 비워둠 사용장가 입력했을때 값을 지워주는 역할*/

            // e.preventDefault(); // submit은 기본적으로 페이지를 reload 시키기 때문에, 페이지 리로드 현상 방지.

            //보내주는 값의 변수값은 아무거나 줘도 상관없다.
            var data = {
                // msg: $('#msg').val(),
                class_id: $('#class_id').val(),
                id: $('#id').val(),
                e_date: $('#e_date').val(), //날짜 타입
                e_item:  $('input[name="e_item"]:checked').val(), //라디오 값
                e_money: $('#e_money').val(),
                class_id: $('#service').val(),
            }

            console.log(data);

            $.ajax({
                url: 'estiForJson.php',
                dataType: 'json',
                /*json,url/html/xml 다양함*/
                type: 'POST',
                data: data,
                /*만약 데이터가 여러개면 , 키:값 형태로 나열*/
                success: function (result) {
                    /*ajax와 통신이 성공하면 지정한 function이 호출됨 (서버에서 return해준 데이터가 들어오게됨*/
                    console.log(result);
                    // if (result['result'] == true) {
                    //     $('#result').html(result['msg']);
                    // }

                    // jsonUtil.php 에 있는 jsonFailure() 메소드 사용. --> message와 code를 동적으로 할당
                    var callResult = result.result;
                    var callCode = result.code;
                    var callData = result.data || {};
                    var callErrorReason = result.errorReason || '';

                    if (!callResult) { // 실패한 경우
                        alert(callErrorReason); // 실패 원인 alert 문구
                    }

                    if (callResult) { // 성공한 경우

                        alert("견적서를 보냈습니다");
                       location.href = '../index.php'; //페이지 이동
                    }

                },
                error: function (err) {
                    // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
                    console.log(err);
                }
            })

        });
    </script>
</div>
</body>

</html>