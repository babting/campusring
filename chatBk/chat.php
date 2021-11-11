<?php
/**
 * Created by PhpStorm.
 * User: bk
 * Date: 10/2/21
 * Time: 3:47 PM
 */
session_start();
if (@$_GET['board'] == ""){
    echo "<script>alert('존재하지 않는 채팅방입니다.'); history.go(-1); </script>";
    exit;
}

?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="chat.js"></script>
    <title>채팅화면</title>
</head>

<body>


<div class="container">
    <header class="hd_box" style="position:fixed;top:0%; background: white;     border: solid 3px black;
    border-color: #D9D9D9;
    bolder-top: none;
    border-left: none;
    border-right: none;">
        <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
        <div class="chat_dot"><i class="fas fa-ellipsis-v fa-2x"></i></div><!--어떤 이벤트를 넣을지 생각해보기-->
        <div class="login_text" style="transform: translate(-85%, -50%);">이화진 | 멘토</div>
        <!-- <div class="chat_time">2시간 전 접속</div>-->
        <div class=""></div>
    </header>
    <div class="chat_screen" style="//background: #fac7d4;"> <!--전체 채팅창 박스 -->
        <style>
            .chat_msg_sort {
                back
            }
            .chat_mento img {
            / / margin-right: 30 px;
                margin-right: 5px;

            }
            .chat_sort {
            / / margin-right: 5 px;
            }
        </style>
        <div>
            <div class="chat_line"></div>

            <div class="chat_date">
                <p>2021.8.6 금요일</p>
            </div>
            <div class="chat_box">


                <div class="chat_sort">
                    <div class="chat_size">
                        <div class="chat_main_right">
                            <p>네 맞아요:)</p>
                        </div>
                    </div>
                    <div class="chat_mento">
                        <img src="../img/hwajin.png" alt="이화진멘토">
                    </div>
                </div>

                <form onsubmit="chatManager.write(this); return false;">
                    <input name="name" id="name" type="hidden" value="<?=@$_SESSION['user_id']?>" readonly>
                    <input name="board" id="board" type="hidden" value="<?=@$_GET['board']?>"/>
                    <div style="border-top-color: aliceblue; border: solid 3px ;border-color: #D9D9D9; border-left: none; border-right: none; position:fixed; left:0px; right:0px; bottom: 0px; background: white;
           width: 100%;
    max-width: 750px;
    margin: 0 auto;
    text-align: center;
   ">
                        <div id="chat_ui" style="height: 10px;width:100%; //background:lavenderblush  ">
                        </div>
                        <div style="background: //lavenderblush;">
                            <input name="msg" id="msg" type="text"
                                   style="border-radius: 7px;   padding:6px;width: 80%; height: 22px; margin-bottom: 10px; margin-left: 9px; margin-right: 4px;"/>
                            <input name="btn" id="btn" type="submit" value="입력" />
                        </div>
                    </div>
                </form>
            </div>  <!--채팅 박스 end-->
        </div>


    </div> <!--전체 채팅창 스크린 end -->
</div>  <!--콘테이너 end-->

</body>

</html>
