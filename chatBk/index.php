<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

if (@$_GET['board'] == "") {
    echo "<script>alert('존재하지 않는 채팅방입니다.'); history.go(-1); </script>";
    exit;
}
$uid = @$_SESSION['user_id'];

$sql = "SELECT (select name from member where member.user_id = chatroomlist.user_id )as uname FROM chatroomlist where user_id != '$uid' AND board = '{$_GET['board']}' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <title>채팅화면</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="chat.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
</head>


<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
    <div class="login_text" style="display: inline-block;font-size: 30px;margin-top: 10px;"><?=$row['uname']?> | 멘토</div>
</header>

<div class="container">


    <div class="chat_screen" style="height: 100vh; width: 100%;">
        <div id="margintop" >
            <div class="chat_line"></div>
            <div class="chat_box" id="list">
                <div class="bottom-input-form">
                    <div id="chat_ui" style="height: 10px;width:100%;">
                    </div>
                    <div>
                        <form onsubmit="chatManager.write(this); return false;">
                            <input name="name" id="name" type="text" value="<?= @$_SESSION['user_id'] ?>" readonly style="display: none;">
                            <input name="msg" id="msg" type="text" />

                            <input name="board" id="board" type="hidden" value="<?= @$_GET['board'] ?>"/>
                            <input name="btn" id="btn" type="submit" value="입력"/>
                        </form>
                    </div>
                </div>
            </div>  <!--채팅 박스 end-->
        </div>


        <div id="blan" style="height:200px;">


        </div>


    </div> <!--전체 채팅창 스크린 end -->
</div>  <!--콘테이너 end-->


</body>
</html>