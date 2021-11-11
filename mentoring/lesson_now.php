<!DOCTYPE html>

<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];

?>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <!--jquery ajax-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- ajax를 사용하기 위해 jquery cdn으로 불러옴. -->

    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <title>구매내역페이지</title>
</head>
<!--
    초코링 구매 기록 페이지
    페이지 담당:
    마지막 업데이트 : 210928 ajax 작업

    -->
<!--
ajax필요사항

(php에서 받기)
세션 아이디
(출력) choco 테이블  date날짜, cost구매, 잔여rest,수량amounts, 금액 cost,way ,kinds ,


-->
<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x"  onclick="location.href='/index.php'"></i></div>
    <div class="login_text">현재 강좌 조회</div>
    <div class=""></div>
</header>

<!---
(받기 )
"b_h_date 이너
 b_h_purchase 이너
 b_h_ramain 이너
 b_h_price 이너
 buy_count 이너 바꾸기
리스트의 경우 클래스로 바꾸고 하기,
---->
<div class="container">
    <div class="lesson_top">
        <ul>
            <li><a href="lesson_now.php" target="_self">현재 강좌 조회</a></li>
            <li><a href="lesson_past.php" target="_self">과거 강좌 조회</a></li>
            <!--            <li><a href="lesson_info.php" target="_self">상세내역</a></li>-->
        </ul>
    </div>
    <?php
    $sql = "SELECT choco FROM member where user_id='$user_id' ";
    $re = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($re);
    $allchoco = $row['choco'];
    ?>
    <div class="lesson_now">
        <img src="../img/ring.PNG" alt="현재보유 초코링">
        현재 보유한 초코링 <span id="b_h_buy_count" class="buy_count"><?=$allchoco?>개</span>
    </div>
<!--    <div class="lesson_content1">-->
<!--        <p>21.10.01</p>-->
<!--        <p>프론트엔드의 모든것</p>-->
<!--        <p>이화진 멘토</p>-->
<!--    </div>-->
<!---->
<!--    <div class="lesson_content2">-->
<!--        <p>21.09.23</p>-->
<!--        <p>데이터분석하기</p>-->
<!--        <p>이가인 멘토</p>-->
<!--    </div>-->
    <?php

    $sql = "select
                t1.e_date
                , t2.title
                , t2.thumbnail
                , (select name from member where user_id = t2.user_id) AS member_name
                , t2.id
            from
                match_class t1
                , class t2
            where t1.user_id='$user_id' and t1.state=2
            and t1.class_id = t2.id order by t1.e_date DESC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) { //if 시작

        while ($row = mysqli_fetch_array($result)) { //while 시작
            ?>
            <div class="mtb10">
                <div class="lesson_list_bd">
                    <div class="les_img">
                        <img  src="<?=$row['thumbnail']?>">
                    </div>
                    <div  id="les_cont_now" class="les_cont">
                        <p><?= $row['e_date'] ?></p>
                        <p><?= $row['title'] ?></p>
                        <p><?= $row['member_name'] ?></p>
                        <div id="les_list_btn_now" class="les_list_btn">
                            <a href="./lesson_info.php?id=<?php echo $row['id'] ?>" style="color:#fff ;padding 5px;">자세히보기</a>
                            <a style="color:#fff; cursor: pointer;padding 5px;" onclick="finish_matching(<?=$row['id']?>);">매칭종료</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } //while 끝
    } else { //if 끝, else 시작
        ?>
        <br><br>
        <p class="result_s">진행 중인 강좌가 없습니다.</p>
    <?php } //else 끝
    mysqli_close($conn); // 디비 접속 닫기
    ?>

    <script>
        function finish_matching(idzz){
            var Data = {
                class_id: idzz
            }

            $.ajax({
                type: 'POST',
                url: 'lesson_nowForJson.php',
                data: Data,
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);
                    if(result){
                        alert("매칭이 종료되었습니다.");
                    }
                },
                error: function(err) {
                    console.log(err);
                },
            });

        }
    </script>


</div>


</body>

</html>
