<!DOCTYPE html>
<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/common/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];
?>

<html lang="ko">
<head>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://kit.fontawesome.com/a9eb1f10be.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=de  vice-width, initial-scale=1.0">
    <title>선물하기</title>
</head>

<body>
<div class="container">
    <header class="alt-header">
        <div class="alt-header__column btn-menu"><a><i class="fas fa-bars fa-2x"></i></a></div>
        <div class="alt-header__column"><img src="../img/logo.png" alt="logo" class="logo" onclick="location.href='../index.php'"></div>
        <div class="alt-header__column"><a href="../member/find.php"><i class="fas fa-search fa-2x"></i></a></div>
    </header>

    <?php
    $sql = "SELECT choco FROM member where user_id='$user_id' ";
    $re = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($re);
    $allchoco = $row['choco'];
    ?>

    <p class="presentshop_title">STORE</p>
    <div class="presentshop_count">
        <img src="../img/ring.PNG" alt="현재보유 초코링">
        현재 보유한 초코링 <span class="presentshop_my_ring"><?= $allchoco ?>개</span>
    </div>

    <div class="present_coffee">
        <img src="../img/coffee-cup.png">
        <div class="present_coffee1">
            <p class="pre_menu1">STARBUCKS</p>
            <div class="presen_chprice">
                <div>6600원</div>
                <span class="final_span">/</span>
                <img src="../img/ring.PNG" alt="현재보유 초코링">
                <div class="pre_ch_count">5개</div>
            </div>
            <div class="prsh_poab el_chbox ">
                <input type="checkbox" style="width: 25px; height: 25px;">
            </div>

        </div>
    </div>

    <div class="present_coffee">
        <img src="../img/donut.png">
        <div class="present_coffee1">
            <p class="pre_menu1">DONUTS</p>
            <div class="presen_chprice">
                <div>1700원</div>
                <span class="final_span">/</span>
                <img src="../img/ring.PNG" alt="현재보유 초코링">
                <div class="pre_ch_count">3개</div>
            </div>
            <div class="prsh_poab el_chbox ">
                <input type="checkbox" style="width: 25px; height: 25px;">
            </div>

        </div>
    </div>

    <div class="present_coffee">
        <img src="../img/milk.png">
        <div class="present_coffee1">
            <p class="pre_menu1">MILK</p>
            <div class="presen_chprice">
                <div>1100원</div>
                <span class="final_span">/</span>
                <img src="../img/ring.PNG" alt="현재보유 초코링">
                <div class="pre_ch_count">2개</div>
            </div>
            <div class="prsh_poab el_chbox ">
                <input type="checkbox" style="width: 25px; height: 25px;">
            </div>

        </div>
    </div>

    <div class="present_coffee">
        <img src="../img/bread.png">
        <div class="present_coffee1">
            <p class="pre_menu1">BREAD</p>
            <div class="presen_chprice">
                <div>2700원</div>
                <span class="final_span">/</span>
                <img src="../img/ring.PNG" alt="현재보유 초코링">
                <div class="pre_ch_count">4개</div>
            </div>
            <div class="prsh_poab el_chbox ">
                <input type="checkbox" style="width: 25px; height: 25px;">
            </div>

        </div>
    </div>

    <div class="present_coffee">
        <img src="../img/fried-chicken.png">
        <div class="present_coffee1">
            <p class="pre_menu1">CHICKEN</p>
            <div class="presen_chprice">
                <div>9900원</div>
                <span class="final_span">/</span>
                <img src="../img/ring.PNG" alt="현재보유 초코링">
                <div class="pre_ch_count">9개</div>
            </div>
            <div class="prsh_poab el_chbox ">
                <input type="checkbox" style="width: 25px; height: 25px;">
            </div>

        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
</div>
</body>

</html>