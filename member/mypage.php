<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT 
                t1.email, t1.name, t1.choco, t1.photo, t1.major
                , (select count(*) from review where review_id = '{$user_id}') AS review_cnt
                , (select count(*) from class where user_id = '{$user_id}') AS match_class_cnt
            FROM member t1
            where user_id = '{$user_id}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="KO">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>마이페이지</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://kit.fontawesome.com/a9eb1f10be.js" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- <style>
      ul{font-size:0;}
      li{border:1px solid #000;}
      li+li{border-left:none;}
      li:nth-of-type(3n+1){border-left:1px solid #000;}
      li:nth-of-child(-n+2){border-bottom:none;}
    </style> -->
    <table style="border-collapse: collapse; border-radius: 10px;">
    </table>
</head>

<body>
<header class="hd_box">
    <div class="close_btn"><i class="fas fa-times fa-2x" onClick="history.go(-1);"></i>
    </div>
    <div class="login_text">마이페이지</div>
</header>
<div class="container">
    <div class="mypage_profile">
        <div class="mypage_profile_img">
            <img src="<?= $row['photo'] ?>" alt="soo" id="img_ch">
        </div>
        <div class="mypage_info">
            <?php
            if(!isset($_SESSION['user_id'])) {
                echo "<p id='my_email'>로그인해주세요.</p>";
            }
            ?>
            <p id="my_name"><?= $row['name'] ?></p>
            <p id="my_email"><?= $row['email'] ?></p>
        </div>
    </div>
    <table class="mypage_submenu">
        <colgroup>
            <col width="33.3333%">
            <col width="33.3333%">
            <col width="33.3333%">
        </colgroup>
        <thead>
        <tr>
            <th><a href="../review/review_my.php">작성한 리뷰</a></th>
            <th><a href="../mentoring/my_lesson.php">등록한 강의</a></th>
            <th><a href="../chocoring/buy_ring.php">초코링</a></th>
        </tr>

        </thead>
        <tbody>
        <tr>
            <td id="re_cnt"><?= $row['review_cnt'] ?>개</td>
            <td id="cl_cnt"><?= $row['match_class_cnt'] ?>개</td>
            <td id="ring_cnt"><?= $row['choco'] ?>개</td>
        </tr>
        </tbody>

    </table>
    <div class="table_bwn_interval"></div>

    <table class="mypage_menu">
        <colgroup>
            <col width="33.3333%">
            <col width="33.3333%">
            <col width="33.3333%">
        </colgroup>
        <tr>
            <td><a href="../member/profile_change.php"><i class="far fa-user fa-2x"></i>프로필 관리</a></td>
            <td><a href="../chocoring/buy_ring.php"><i class="far fa-credit-card fa-2x"></i>초코링 구매</a></td>
            <td><a href="../qna/qna_list.php"><i class="far fa-question-circle fa-2x"></i>Q&A</a></td>
        </tr>

        <tr>
            <td><a href="../member/mentorpf_write.php"><i class="far fa-id-badge fa-2x"></i>멘토 프로필</a></td>
            <td><a href="../map/mapWrite.php"><i class="fas fa-map-marker-alt fa-2x"></i>내 위치등록</a></td>
            <?php
                if($row['major']){
                ?>
                    <td><a href="../mentoring/lessonup.php"><i class="far fa-bookmark fa-2x"></i>강좌 등록</a></td>
                <?php
                }else{
                ?>
                    <td onclick="non_lessonup()"><i class="far fa-bookmark fa-2x"></i>강좌 등록</td>
                <?php
                }
            ?>
        </tr>

    </table>

    <!-- 하단바 -->
    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>

    <!--하단바끝 -->

</div> <!--container 닫음-->
</body>
<script>
    function non_lessonup(){
        alert("멘토 프로필 작성 후 이용이 가능합니다.");
    }
    // window.onload =
    // (function() {
    //     // e.preventDefault(); // submit은 기본적으로 페이지를 reload 시키기 때문에, 페이지 리로드 현상 방지.
    //
    //     // jquery로 해당 input data 값 가져오기.
    //     // html tag안에 class, id, name 으로 구분 값을 가져옵니다.
    //     // class 로 구분해서 값을 가져오려면 $('.class명').val()
    //     // id 로 구분해서 값을 가져오려면 $('#id명').val()
    //     // name으로 구분해서 값을 가져오려면 $("태그이름[name='name명']").val() ex) $("input[name='m_id']").val()
    //     // var m_id = $('#m_id').val(); // 아이디
    //     //
    //     // // 데이터 검증
    //     // var mypageData = {
    //     //     m_id: "m_id",
    //     // }
    //
    //     $.ajax({
    //         type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
    //         url: 'mypageForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
    //         data: {},          // url로 전송할 데이터 정의
    //         dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
    //
    //         success: function(result) {
    //             // url에서 해당 data를 처리하고 반환된 success 결과에 대해서 로직 처리
    //             console.log(result);
    //             var callResult = result.result; //db에서 받아오는 방법
    //             var callCode = result.code;
    //             var callData = result.data || {};
    //             var callErrorReason = result.errorReason || '';
    //
    //             var name = result.data.name;
    //             var email = result.data.email;
    //             var choco = result.data.choco;
    //             var match_enro = result.data.match_enro;
    //             var img_ch = result.data.img_ch;
    //             var review_did = result.data.review_did;
    //
    //             // alert(email+","+name+","+choco+","+review_did+","+match_enro+","+img_ch);
    //             $('#my_name').text(name);
    //             $('#my_email').text(email);
    //             $('#re_cnt').text(match_enro+'개');
    //             $('#cl_cnt').text(review_did+'개');
    //             $('#ring_cnt').text(choco+'개');
    //
    //         },
    //         error: function(err) {
    //             // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
    //             console.log(err);
    //         }
    //     })
    // })();
</script>
</html>