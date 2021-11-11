<?php
/**
 * Created by PhpStorm.
 * User: bk
 * Date: 9/26/21
 * Time: 7:28 PM
 */
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://kit.fontawesome.com/a9eb1f10be.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>채팅리스트</title>
</head>

<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onclick="location.href='/index.php'"></i></div>
    <div class="login_text">채팅</div>
</header>
<div class="container">
    <?php

    $query = "SELECT board FROM chatroomlist WHERE user_id = '$user_id' ORDER BY idx desc ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $lastchatQuery = "SELECT (select name from member where member.user_id = chatlist.name limit 0,1) as lastname, ";
            $lastchatQuery .= "name, msg, sendto, date FROM chatlist WHERE board = '" . $row['board'] . "' ORDER BY idx DESC limit 0,1";
            $lastchatResult = mysqli_query($conn, $lastchatQuery);
            $lastchatRow = mysqli_fetch_array($lastchatResult);
            $SendQuery = "SELECT member.photo as Uphoto, member.name as Uname FROM member JOIN chatroomlist ON member.user_id = chatroomlist.user_id WHERE chatroomlist.user_id != '$user_id' ";
            $SendQuery .= "AND chatroomlist.board = '{$row['board']}' ";
            $SendResult = mysqli_query($conn, $SendQuery);
            $SendRow = mysqli_fetch_array($SendResult);
            ?>
            <div class="list_sort" onclick="location.href='/chatBk/index.php?board=<?= $row['board'] ?>'">
                <div class="list_content">
                    <?php
                    if ($SendRow['Uphoto'] != "") {
                        ?>
                        <div class="map_sel_img_sort">
                            <img src="<?= $SendRow['Uphoto'] ?>">
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="chat_icon">
                            <i class="fas fa-user fa-3x"></i>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="chat_cont">
                        <p id="mentoring_name"><?= $SendRow['Uname'] ?></p>
                        <p id="mentoring_cont"><?= $lastchatRow['lastname'] ?> : <?= $lastchatRow['msg'] ?></p>
                    </div>
                    <div class="list__cont_time">
                        <p><input type="time" id="chat_time" value="<?= substr($lastchatRow['date'], 11, 8) ?>"></p>
                        <?php
                        $myquery = "SELECT count(*) as cnt FROM chatlist WHERE sendto = '$user_id'  AND board = '{$row['board']}' AND readYN != 'Y' ";
                        $myresult = mysqli_query($conn, $myquery);
                        $myrow = mysqli_fetch_array($myresult);
                        if ($myrow['cnt'] > 0) {
                            ?>
                            <div class="badge el_rg" id="caht_cnt"><?= $myrow['cnt'] ?></div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }else {
        ?>
        <div class="chat_list_no">채팅이 없습니다.</div>
        <?php
    }
    include "../footer.php"; ?>
</div>


</body>

</html>
