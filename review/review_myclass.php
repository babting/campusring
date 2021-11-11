<!DOCTYPE html>
<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];

if (!@$_GET['sort']){
    $sort = 'ORDER BY r_date DESC';
}else{
    $sort = "ORDER BY ".$_GET['sort']." DESC" ;
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <title>나에게 달린 리뷰</title>

</head>
<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
    <div class="login_text">나에게 달린 리뷰</div>
    <div class=""></div>
</header>
<div class="container">
    <div class="buy_top">
        <ul>
            <li><a href="../review/review_my.php" target="_self">내가 작성한 리뷰</a></li>
            <li><a href="review_myclass.php" target="_self">나에게 달린 리뷰</a></li>

        </ul>
    </div>
    <div class="review_my_sort">
        <ul>
            <li onclick="location.href='review_myclass.php?sort=r_star'"><span <?php if (@$_GET['sort'] == "r_star") echo
                "style = 'font-color: #f0f'; "; ?> >베스트순</span></li>
            <li><span>|</span></li>
            <li onclick="location.href='review_myclass.php?sort=r_date'"><span <?php if (@$_GET['sort'] == "r_date") echo
                "style = 'font-color: #f0f'; "; ?>>최신순</span></li>
        </ul>
    </div>




    <?php
        $query = "SELECT review.*, (select name from member where member.user_id = review.review_id) as review_name
                    , (select photo from member where user_id = review.review_id) AS photo";
        $query.= " FROM review WHERE mentor_id = '".$_SESSION['user_id']."' " .$sort ;
//        echo $query;
    $result = mysqli_query($conn, $query);
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
                        <?= $row['review_name'] ?>
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
    }else { ?>
        <p class="no_review">나에게 달린 리뷰가 없습니다.</p>
        <?php

    }
    ?>


    <script>
        $('.report_btn').click(function (){
            console.log(1);

            var content1 = $('#content1').val();
            var content2 = $('#content1').val();
            var content3 = $('#content1').val();

        });
    </script>



</div>


</body>

</html>