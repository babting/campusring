<!DOCTYPE html>
<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];
if (@$_GET['sort'] == "" || @$_GET['sort'] == "r_star"){
    $sort = "ORDER BY r_star DESC" ;
}else{
    $sort = 'ORDER BY r_date DESC';
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

    <div class="review_my_sort">
        <ul>
            <li onclick="location.href='./reivew_myclass.php?sort=r_star'"><span <?php if (@$_GET['sort'] == "r_star" || @$_GET['sort'] == "") echo
                "style = 'background: #f0f'; "; ?> >베스트순</span></li>
            <li><span>|</span></li>
            <li onclick="location.href='./reivew_myclass.php?sort=r_date'"><span <?php if (@$_GET['sort'] == "r_date") echo
                "style = 'background: #f0f'; "; ?>>최신순</span></li>
        </ul>
    </div>

<!--    <div class="" id="review_information">강의정보 :</div>-->
<!--    <div class="" id="review_class">강의 :</div>-->
<!--    <div class=""id="reivew_program">프로그래밍 맛보기 :</div>-->
<!--    <div class=""id="review_mentor_information">멘토정보 :</div>-->
<!--    <div class="" id="review_price">가격 :</div>-->

    <?php
        $query = "SELECT review.*, (select name from member where member.user_id = review.review_id) as review_name";
        $query.= " FROM review WHERE mentor_id = '".$_SESSION['user_id']."' " .$sort ;
//        echo $query;
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="review_my_page">
                <div class="my_user1">
                    <div class="user1_icon"><i class="fas fa-user fa-3x"></i></div>
                </div>
                <div class="review_my_group">
                    <div class="review_my_name">
                        <?=$row['review_name']?>
                    </div>
                    <div class="review_my_star_count">
                        <?php
                        for ($i = 1; $i <= $row['r_star']; $i++) {
                            ?>
                            <i class="fas fa-star fa-1x "></i>
                            <?php
                        }
                        ?>
                        <span class="review_date"><?=$row['r_date']?></span>
                    </div>
                </div>
                <div class="review_my_content" id="content1">
                    <?=$row['r_context']?>
                </div>
                <div class="review_my_btn" id="review_report_btn">
                    <button class="report_btn">신고하기</button>
                </div>
            </div>
            <?php
        }
    ?>

    <script>
        $('.report_btn').click(function (){
            console.log(1);

            var content1 = $('#content1').val();
            var content2 = $('#content1').val();
            var content3 = $('#content1').val();

        }

    </script>



</div>


</body>

</html>