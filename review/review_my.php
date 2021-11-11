<!DOCTYPE html>
<?php

session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];

if (!@$_GET['sort']){
    $sort = 'ORDER BY r_date DESC';
}else{
    $sort = "ORDER BY ".$_GET['sort']." DESC" ;
}
?>

<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <title>내가 작성한 리뷰</title>
    <style>
        .my_review_head {
            font-size: 20px;
        }
    </style>

</head>

<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
    <div class="login_text">내가 작성한 리뷰</div>

</header>

<div class="container">
    <div class="my_review_head"></div>

    <div class="buy_top">
        <ul>
            <li><a href="../review/review_my.php" target="_self">내가 작성한 리뷰</a></li>
            <li><a href="review_myclass.php" target="_self">나에게 달린 리뷰</a></li>
        </ul>
    </div>
    <div class="review_my_sort">
        <ul>
            <li onclick="location.href='review_my.php?sort=r_star'"><span <?php if (@$_GET['sort'] == "r_star") echo
                "style = 'font-color: #f0f'; "; ?> >베스트순</span></li>
            <li><span>|</span></li>
            <li onclick="location.href='review_my.php?sort=r_date'"><span <?php if (@$_GET['sort'] == "r_date") echo
                "style = 'font-color: #f0f'; "; ?>>최신순</span></li>
        </ul>
    </div>


    <?php
    $sql = "SELECT r_context, r_star, review_id, mentor_id, r_date 
                    , (select name from member where user_id = '{$user_id}') AS r_name
                    , (select photo from member where user_id = '{$user_id}') AS photo
                    FROM review
                    where review_id='$user_id' " .$sort;
//    $sql = "SELECT big_cate, title
//                    , (select name from member where user_id = '{$user_id}' ORDER BY idx DESC limit 0,1) AS r_name
//                    , (select e_date from match_class where user_id = '{$user_id}' ORDER BY id DESC limit 0,1) AS r_date
//                    , (select e_money from match_class where user_id = '{$user_id}' ORDER BY id DESC limit 0,1) AS choco
//                    FROM class
//                    where user_id='$user_id'";
//    $sql = "SELECT r_date
//                    , (select name from member where user_id = '{$user_id}') AS r_name
//                    , (select e_date from match_class where user_id = '{$user_id}') AS r_date
//                    , (select e_money from match_class where user_id = '{$user_id}') AS choco
//                    FROM review
//                    where review_id='$user_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) { //if 시작

    while ($row = mysqli_fetch_array($result)) { //while 끝
    ?>
        <div class="review_page">
            <div class="user1">
                <img id="ChnImg" src="<?= $row['photo']?>" alt="기본이미지">
                <!--                    <img id="ChnImg" src="../img/soo_img.jpg" alt="기본이미지">-->
                <!---이미지 태그로 바꿔주세ㅓ용-->
                <!--                    <div class="user1_icon" ><i class="fas fa-user fa-3x"></i></div>-->
            </div>

            <div class="review_group">
                <div class="review_name">
                    <?= $row['r_name'] ?>
                </div>
                <div class="review_star_count">
                    <?php
                    for($i = 1; $i <= $row['r_star']; $i++){
                        ?>
                        <i class="fas fa-star fa-1x "></i>
                        <?php
                    }
                    ?>
                    <span class="review_date"><?= $row['r_date'] ?></span>
                </div>

                <!--리뷰내용을 보여주는 디브 임의 로 추가했어요-->
                <div class="review_context"><?= $row['r_context'] ?></div>

            </div>

        </div>
        <?php
        } //while 끝
    }
    ?>
<!--        <div class="review_use">-->
<!--            <div class="review_my_content1">-->
<!--                <p>21.08.03</p>-->
<!--                <p>안드로이드</p>-->
<!--                <p>앱 개발 정복반</p>-->
<!--                <p>멘토 이순종</p>-->
<!--                <p>평생소장 초코 70개</p>-->
<!--            </div>-->
<!--            <div class="review_use_update">-->
<!--                <button class="my_btn">수정하기</button>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--        <hr>-->
<!--        <div class="review_use">-->
<!--            <div class="review_my_content1">-->
<!--                <p>21.08.03</p>-->
<!--                <p>프로그래밍</p>-->
<!--                <p>CSS 문법뿌시기</p>-->
<!--                <p>멘토 안수철</p>-->
<!--                <p>평생소장 초코 60개</p>-->
<!--            </div>-->
<!--            <div class="review_use_update">-->
<!--                <button class="my_btn">수정하기</button>-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--        <hr>-->
<!---->
<!--        <div class="review_use">-->
<!--            <div class="review_my_content1">-->
<!--                <p>21.08.03</p>-->
<!--                <p>프로그래밍</p>-->
<!--                <p>AI 정복반</p>-->
<!--                <p>멘토 고희주</p>-->
<!--                <p>평생소장 초코 100개</p>-->
<!---->
<!--            </div>-->
<!--            <div class="review_use_update">-->
<!--                <button class="my_btn">수정하기</button>-->
<!--            </div>-->
<!--        </div>-->
<!--        <hr>-->
<!--        <div class="review_use">-->
<!--            <div class="review_my_content1">-->
<!--                <p>21.08.03</p>-->
<!--                <p>프로그래밍</p>-->
<!--                <p>유니티의 모든것</p>-->
<!--                <p>멘토 이가인</p>-->
<!--                <p>평생소장 초코 90개</p>-->
<!--            </div>-->
<!--            <div class="review_use_update">-->
<!--                <button class="my_btn">수정하기</button>-->
<!--            </div>-->
<!--        </div-->
<!--        <hr>-->
<!--    </div>-->
</div>
</body>

</html>





