<!DOCTYPE html>
<?php session_start(); ?>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>menu</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://kit.fontawesome.com/a9eb1f10be.js" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
<header class="menu_hd_box">
    <div class="menu__text"><img src="../img/logo.png"></div>
    <div class="menu_btn_prev"><i class="fas fa-times fa-3x" onclick="location.href='../index.php';"></i></div>

</header>
<div class="container">
    <div class="menu_sort">

    </div>
    <div class="menu_bar">

        <ul>
            <?php
            if(!isset($_SESSION['user_id'])) {
                echo "<a href='../login.php'><li id='log_c'>로그인</li></a>";
                echo "<a href='signup.php'><li id='sign'>회원가입</li></a>";
            }
            else {
                echo "<a href='mypage.php'><li id='myp'>마이페이지</li></a>";
                echo "<a href='../logout.php'><li id='log_c'>로그아웃</li></a>";
            }
            ?>

        </ul>
    </div>
    <div>
    </div>
    <div class="menu_name">
        <?php
        if(!isset($_SESSION['user_id'])) {
            echo "로그인 해주세요.";
        }
        else {
            $user_id = $_SESSION['user_id'];
            echo "안녕하세요, <span id='m_name'>'$user_id'님</span>!";
        }

        ?>

    </div>

    <div class="menu_info">

        <?php
        if(!isset($_SESSION['user_id'])) {
            echo "<p id='m_id'>로그인 후 서비스를 시작하세요.</p>";
        }
        else {
            $user_id = $_SESSION['user_id'];
            echo "<p id='m_id'>bob0714@naver.com</p>";
            echo "<p id='m_pnum'>010-1234-1234</p>";
        }
        ?>

    </div>

    <div class="my_class">

        <span class="class_icon"><i class="far fa-address-card fa-3x"></i></span>
        <div class="my_class_align">

            <div>내가 수강중인 강좌</div>
            <a href="../mentoring/lesson_now.php">
                <div>
                    <span id="m_class">1개</span><i class="fas fa-chevron-right"></i>
                </div>
            </a>
        </div>

    </div>

    <div class="my_chocoring">
        <div>내 초코링</div>
        <div><a href="../chocoring/buy_ring.php"><span id="m_ring">1개</span><i class="fas fa-chevron-right"></i></a></div>
    </div>
    <div class="my_review">
        <div>내가 작성한 리뷰</div>
        <a href="../review/review.php">
            <div class="me_ri" onclick="review.php">
                <span id="m_rev">3개</span><i class="fas fa-chevron-right"></i>
            </div>
        </a>
    </div>
</div>
</div>
<script>
    // window.onload =
    // 즉시 호출 함수 --> (function() { /* ..내용.. */ })()
    (function() {
        // jquery로 해당 input data 값 가져오기.
        // html tag안에 class, id, name 으로 구분 값을 가져옵니다.
        // class 로 구분해서 값을 가져오려면 $('.class명').val()
        // id 로 구분해서 값을 가져오려면 $('#id명').val()
        // name으로 구분해서 값을 가져오려면 $("태그이름[name='name명']").val() ex) $("input[name='m_id']").val()

        // 데이터 검증
        // alert("Dd");
        // signup.php로 보낼 데이터 포맷 정의
        // var menuData = {
        //     m_id: "babting",
        // }

        $.ajax({
            type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
            url: 'menuForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
            data: {},          // url로 전송할 데이터 정의
            dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.

            success: function(result) {
                // url에서 해당 data를 처리하고 반환된 success 결과에 대해서 로직 처리
                console.log(result);
                var callResult = result.result; //db에서 받아오는 방법
                var callCode = result.code;
                var callData = result.data || {};
                var callErrorReason = result.errorReason || '';

                var email = result.data.email;
                var pNum = result.data.pNum;
                var name = result.data.name;
                var choco = result.data.choco;
                var review_did = result.data.review_did;
                var match_did = result.data.match_did;

                // alert(email+","+pNum+","+name+","+choco+","+review_did+","+match_did);
                $('#m_id').text(email);
                $('#m_pnum').text(pNum);
                $('#m_class').text(match_did+'개');
                $('#m_ring').text(choco+'개');
                $('#m_rev').text(review_did+'개');

            },
            error: function(err) {
                // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
                console.log(err);
            }
        })
    })();
</script>
</body>

</html>
