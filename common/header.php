<!DOCTYPE html>

<?php
/**
 * Created by PhpStorm.
 * User: bk
 * Date: 9/26/21
 * Time: 7:28 PM
 */
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
$user_id = @$_SESSION['user_id'];
?>
<html lang="ko">
<head>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://kit.fontawesome.com/a9eb1f10be.js" crossorigin="anonymous"></script>
    <script src="/js/change.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/semantic/dist/semantic.min.css">
    <script src="/semantic/dist/semantic.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>campusring</title>
</head>
<style>
    a:link {/*!important;*/ text-decoration: none; color: #000;}
    a:visited {text-decoration: none; color: #000;}
    a:active {text-decoration: none; color: #000;}
    a:hover {text-decoration: none; color: #000;}
    a { color: #000;}
    
</style>
<body>

<div class="ui sidebar inverted vertical menu">
    <?php

    if($user_id == ""){
        ?>
        <a href="/login.php" class="item">
            로그인
        </a>
        <a href="/member/signup.php" class="item">
            회원가입
        </a>
    <?php }else{ ?>
        <a href="/logout.php" class="item">
            로그아웃
        </a>
    <?php } ?>
    <a href="/chatBk/chat_list.php" class="item">
        채팅리스트
    </a>
    <a href="/member/mypage.php" class="item">
        마이페이지
    </a>
    <a href="/mentoring/lesson_now.php" class="item">
        수강중인 강좌
    </a>
    <a href="/chocoring/buy_ring.php" class="item">
        초코링
    </a>
    <a href="/review/review.php" class="item">
        내가 작성한 리뷰
    </a>

</div>

