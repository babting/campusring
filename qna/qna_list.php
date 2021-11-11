<!DOCTYPE html>
<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];
?>
<html lang="ko">
<head>
    <script src="https://kit.fontawesome.com/a9eb1f10be.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/styles.css"
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1:1문의</title>
</head>

<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
    <div class="login_text">1:1문의하기</div>
</header>
<div class="container">

    <?php
    $sql = "SELECT * FROM qna where user_id='$user_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) { //if 시작

        while ($row = mysqli_fetch_array($result)) { //while 끝
            ?>
                
                <!--관리자페이지가 없기떄문에 답변 미완료는 없음, 
                    DB 리뷰 작성 날짜 컬럼이 생기면 좋을듯-->

            <div class="qna_list_sort">
                <div class="qna_ask_bor">
                    <div class="ask_sort">
                        <div class="qna_one" id="qna_ask_q">Q</div>
                        <p id="answ_ornot">작성한 질문</p>
                    </div>

                    <div class="con_print">
                        <p id="title_prt" style="font-weight: bold"><?= $row['qna_title'] ?></p>
                        <p id="cont_prt"><?= $row['qna_ask'] ?></p>
                    </div>

                </div>
                <div class="qna_asko_bor">
                    <div class="ask_sort">
                        <div class="qna_one" id="qna_ask_a">A</div>
                        <p id="ad_answ_ornot">답변 완료</p>
                    </div>

                    <div class="con_print">
                        <p id="ad_cont_prt"><?= $row['qna_answer'] ?></p>
                    </div>
                </div>

            </div>


            <?php
        } //while 끝

    } else { //if 끝, else 시작
        ?>
        <br><br>
        <p class="result_s">해당 검색 조건에 해당하는 내역이 없습니다.</p>
    <?php } //else 끝

    mysqli_close($conn); // 디비 접속 닫기
    ?>

  <!--  <div class="qna_list_sort">-->
<!--            <div class="qna_ask_bor">-->
<!--                <div class="ask_sort">-->
<!--                    <div class="qna_one" id="qna_ask_q">Q</div>-->
<!--                    <p id="answ_ornot">답변 완료</p>-->
<!--                </div>-->
<!--    -->
<!--                <div class="con_print">-->
<!--                    <p id="title_prt">제목출력</p>-->
<!--                    <p id="cont_prt">내용출력</p>-->
<!--                </div>-->
<!--    -->
<!--            </div>-->


<!--        <div class="qna_asko_bor">-->
<!--            <div class="ask_sort">-->
<!--                <div class="qna_one" id="qna_ask_a">A</div>-->
<!--                <p id="ad_answ_ornot">답변 완료</p>-->
<!--            </div>-->
<!---->
<!--            <div class="con_print">-->
<!--                <p id="ad_cont_prt">내용출력</p>-->
<!--            </div>-->
<!--        </div>-->

  <!--  </div>-->
    <!-- 작업: 박준경 start -->
    <div style="margin: 7rem;"></div>
    <div class="container fix-test" onclick="location.href='qna_1to1.php';" id="qna_send">
        <!-- <button id="qna_send" class="fix-btn" onclick="location.href='../qna/qna_1to1.php'">1:1 문의하기</button> -->
        <span>1:1 문의하기</span>
    </div>
    <!-- 작업: 박준경 end -->




</div>
<script>
    // 즉시 호출 함수 --> (function() { /* ..내용.. */ })()
    (function () {

        $.ajax({
            type: 'POST', // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
            url: 'qnaForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
            data: {}, // url로 전송할 데이터 정의
            dataType: 'json', // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.

            success: function (result) {
                // url에서 해당 data를 처리하고 반환된 success 결과에 대해서 로직 처리
                console.log(result);
                var callResult = result.result; //db에서 받아오는 방법
                var callCode = result.code;
                var callData = result.data || {};
                var callErrorReason = result.errorReason || '';

                var str = "";

                if (Array.isArray(callData)) {
                    callData.forEach(function (data) {
                        console.log(data);
                        str += data.qna_title + ", " + data.qna_ask + ", " + data.qna_answer + "\n";
                    })
                }
                alert(str);
            },
            error: function (err) {
                // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
                console.log(err);
            }
        })
    })();
</script>
</body>

</html>