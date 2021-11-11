<?php

if(isset($_GET['id'])) { //레슨 정보에서 1대1채팅 누른 경우
    $id = $_GET['id'];
}
echo $id;
    ?>



    <!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>

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


                <div class="chat_msg_sort">
                    <div class="chat_profile">
                        <img src="../img/hwajin.png" alt="이화진멘토">
                    </div>
                    <div class="chat_size">
                        <div class="chat_main_left">
                            <a href="../estimate/estimate.php"><p>견적서</p></a>
                            <button type="button">수락</button>
                            <button type="button">취소</button>
                        </div>
                    </div>
                </div>

                <!-- 첫번째 대화 -->
                <div class="chat_msg_sort">
                    <div class="chat_profile">
                        <img src="../img/soo_img.jpg" alt="안수철멘티">
                    </div>
                    <div class="chat_size">
                        <div class="chat_main_left">
                            <p>안녕하세요~ 이화진멘토님 맞으신가요?</p>
                        </div>
                    </div>

                </div>
                <!-- 첫번째 대화 끝 -->

                <!-- 두 번째 대화 -->
                <div class="chat_sort">
                    <div class="chat_profile">
                        <img src="../img/hwajin.png" alt="이화진멘토">
                    </div>
                    <div class="chat_size">
                        <div class="chat_main_left">
                            <p>네 맞아요:)</p>
                        </div>
                    </div>


                </div>
                <!-- 두 번째 대화 끝-->

                <!-- 세 번째 대화 -->
                <div class="chat_msg_sort">
                    <div class="chat_profile">
                        <img src="../img/soo_img.jpg" alt="안수철멘티">
                    </div>
                    <div class="chat_size">
                        <div class="chat_main_left">
                            <p>프로그래밍 웹 프론트 강의 수강 신청했습니다!!</p>
                        </div>
                    </div>
                </div>
                <!-- 세 번째 대화 끝 -->

                <!-- 네 번째 대화  -->
               <div class="chat_sort">
                   <div class="chat_profile">
                       <img src="../img/hwajin.png" alt="이화진멘토">
                   </div>
                    <div class="chat_size">
                        <div class="chat_main_left">
                            <p>아 네! 수철학생 수강신청 된거 확인했어요 :)</p>
                        </div>
                    </div>

                </div>
                <!-- 네 번째 대화  끝  -->

                <!-- 다섯번째 대화 -->
                <div class="chat_msg_sort">
                    <div class="chat_profile">
                        <img src="../img/soo_img.jpg" alt="안수철멘티">
                    </div>
                    <div class="chat_size">
                        <div class="chat_main_left">
                            <p>17일 오후 다섯시 8호관 2층 맞나요?</p>
                        </div>
                    </div>
                </div>
                <!-- 다섯번째 대화 끝 -->

                <!-- 6 대화 -->
                <div class="chat_sort">
                    <div class="chat_profile">
                        <img src="../img/hwajin.png" alt="이화진멘토">
                    </div>
                    <div class="chat_size">
                        <div class="chat_main_left">
                            <p>네 맞아용 그럼 그때 봬용!!</p>
                        </div>
                    </div>

                </div>
                <!-- 6 끝 -->

                <!-- 7 대화 -->
                <div class="chat_msg_sort">
                    <div class="chat_profile">
                        <img src="../img/soo_img.jpg" alt="안수철멘티">
                    </div>
                    <div class="chat_size">
                        <div class="chat_main_left">
                            <p>네 알겠습니다 감사합니다 멘토님!!</p>
                        </div>
                    </div>
                </div>
                <!-- 7 대화 끝 -->


                <!-- 8 대화  -->
                <!--챗 솔트 왼쪽 메시지 -->
                <!--  챗 솔트는 오른쪽 메시지 -->
                <div class="chat_sort"> <!--테두리나 그림자 넣기 -->
                    <div class="chat_profile">
                        <img src="../img/hwajin.png" alt="이화진멘토">
                    </div>
                    <div class="chat_size">
                        <div class="chat_main_left">
                            <p>네 ^^~</p>
                        </div>
                    </div>


                </div> <!--대화창 디브 end -->
                <!-- 8 대화 끝 -->

                <div style="border-top-color: aliceblue; border: solid 3px ;border-color: #D9D9D9; border-left: none; border-right: none; position:fixed; left:0px; right:0px; bottom: 0px; background: white;
           width: 100%;
    max-width: 750px;
    margin: 0 auto;
    text-align: center;
   ">
                    <div id="chat_ui" style="height: 10px;width:100%; //background:lavenderblush  ">
                    </div>
                    <div style="background: //lavenderblush;">

                        <textarea placeholder="Enter Your Message"
                                  style="border-radius: 7px;   padding:6px;width: 80%; height: 22px; margin-bottom: 10px; margin-left: 9px; margin-right: 4px;"></textarea>

                        <img style="width: 7%; height: 28px; margin: 10px; margin-bottom: 15px;"
                             src="data:image/svg+xml;base64,PHN2ZyBpZD0iQ2FwYV8xIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA1MTIuMDA1IDUxMi4wMDUiIGhlaWdodD0iNTEyIiB2aWV3Qm94PSIwIDAgNTEyLjAwNSA1MTIuMDA1IiB3aWR0aD0iNTEyIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxnPjxwYXRoIGQ9Im01MTEuNjU4IDUxLjY3NWMyLjQ5Ni0xMS42MTktOC44OTUtMjEuNDE2LTIwLjAwNy0xNy4xNzZsLTQ4MiAxODRjLTUuODAxIDIuMjE1LTkuNjM4IDcuNzc1LTkuNjUgMTMuOTg0LS4wMTIgNi4yMSAzLjgwMyAxMS43ODUgOS41OTYgMTQuMDIybDEzNS40MDMgNTIuMjk1djE2NC43MTNjMCA2Ljk0OCA0Ljc3MSAxMi45ODYgMTEuNTMxIDE0LjU5MyA2LjcxNSAxLjU5NyAxMy43MTctMS41OTggMTYuODY1LTcuODQzbDU2LjAwMS0xMTEuMTI4IDEzNi42NjQgMTAxLjQyM2M4LjMxMyA2LjE3IDIwLjI2MiAyLjI0NiAyMy4yODctNy42NjkgMTI3LjU5OS00MTguMzU3IDEyMi4wODMtNDAwLjE2MyAxMjIuMzEtNDAxLjIxNHptLTExOC45ODEgNTIuNzE4LTIzNC44MDMgMTY3LjIxOS0xMDEuMDI4LTM5LjAxOHptLTIxNy42NzcgMTkxLjg1MiAyMDQuNjY4LTE0NS43NTdjLTE3Ni4xMTQgMTg1Ljc5LTE2Ni45MTYgMTc2LjAxMS0xNjcuNjg0IDE3Ny4wNDUtMS4xNDEgMS41MzUgMS45ODUtNC40NDgtMzYuOTg0IDcyLjg4MnptMTkxLjg1OCAxMjcuNTQ2LTEyMC4yOTYtODkuMjc2IDIxNy41MTEtMjI5LjQ2MnoiLz48L2c+PC9zdmc+"/>
                    </div>

                    <!-- position: fixed; left:0px; right:0px; bottom: 0%--->


                </div>


            </div>  <!--채팅 박스 end-->
        </div>


    </div> <!--전체 채팅창 스크린 end -->
</div>  <!--콘테이너 end-->

</body>

</html>