<!DOCTYPE html>

<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];

?>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <!--jquery ajax-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> <!-- ajax를 사용하기 위해 jquery cdn으로 불러옴. -->

    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <title>구매내역페이지</title>
</head>
<!--
    초코링 구매 기록 페이지
    페이지 담당:
    마지막 업데이트 : 210928 ajax 작업

    -->
<!--
ajax필요사항

(php에서 받기)
세션 아이디
(출력) choco 테이블  date날짜, cost구매, 잔여rest,수량amounts, 금액 cost,way ,kinds ,


-->
<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
    <div class="login_text">과거 강좌 조회</div>
    <div class=""></div>
</header>

<!---

(받기 )

"b_h_date 이너
   b_h_purchase 이너
       b_h_ramain 이너
      b_h_price 이너
buy_count 이너 바꾸기


리스트의 경우 클래스로 바꾸고 하기,
---->
<div class="container">
    <div class="past_top">
        <ul>
            <li><a href="lesson_now.php" target="_self">현재 강좌 조회</a></li>
            <li><a href="lesson_past.php" target="_self">과거 강좌 조회</a></li>
            <!--            <li><a href="lesson_info.php" target="_self">상세내역</a></li>-->
        </ul>
    </div>
    <?php
    $sql = "SELECT choco FROM member where user_id='$user_id' ";
    $re = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($re);
    $allchoco = $row['choco'];
    ?>
    <div class="past_now">
        <img src="../img/ring.PNG" alt="현재보유 초코링">
        현재 보유한 초코링 <span id="b_h_buy_count" class="buy_count"><?=$allchoco?>개</span>

    </div>


    <?php

    $sql = "select
                t1.e_date
                , t2.title
                , t2.thumbnail
                , (select name from member where user_id = t2.user_id) AS member_name
                , t2.id
            from
                match_class t1
                , class t2
            where t1.user_id='$user_id' and t1.state=4
            and t1.class_id = t2.id order by t1.e_date DESC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) { //if 시작

        while ($row = mysqli_fetch_array($result)) { //while 시작
            ?>
            <div class="mtb10">
                <div class="lesson_list_bd">
                    <div class="les_img">
                        <img src="<?=$row['thumbnail']?>">
                    </div>
                    <div id="les_cont_now" class="les_cont">
                        <p><?= $row['e_date'] ?></p>
                        <p><?= $row['title'] ?></p>
                        <p><?= $row['member_name'] ?></p>
                        <div id="les_list_btn_now" class="les_list_btn">
                            <a href="./lesson_info.php?id=<?php echo $row['id'] ?>" style="color:#fff;">자세히보기</a>
                            <a href="../review/review_ing.php?id=<?php echo $row['id'] ?>" style="color:#fff;">리뷰작성</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } //while 끝

    } else { //if 끝, else 시작
        ?>
        <br><br>
        <p class="result_s">진행 중인 강좌가 없습니다.</p>
    <?php } //else 끝
    mysqli_close($conn); // 디비 접속 닫기
    ?>
    <!---->
    <!--    <div class="history_content2">-->
    <!--        <p>21.07.23</p>-->
    <!--        <p>구매 49개</p>-->
    <!--        <p>잔여 16개</p>-->
    <!--        <p>금액 5,900원(Card)</p>-->
    <!--    </div>-->
    <!---->
    <!--    <div class="history_content3">-->
    <!--        <p>21.07.13</p>-->
    <!--        <p>구매 10개</p>-->
    <!--        <p>잔여 16개</p>-->
    <!--        <p>금액 1,200원(Android)</p>-->
    <!--    </div>-->
    <!---->
    <!--    <div class="history_content4">-->
    <!--        <p>21.07.03</p>-->
    <!--        <p>구매 100개</p>-->
    <!--        <p>잔여 16개</p>-->
    <!--        <p>금액 12,000원(iOS)</p>-->
    <!--    </div>-->
    <!---->
    <!--    <div class="history_content5">-->
    <!--        <p>21.06.27</p>-->
    <!--        <p>구매 10개</p>-->
    <!--        <p>잔여 16개</p>-->
    <!--        <p>금액 1,200원(KaKao)</p>-->
    <!--    </div>-->
    <!---->
    <!--    <div class="history_content6">-->
    <!--        <p>21.06.22</p>-->
    <!--        <p>구매 10개</p>-->
    <!--        <p>잔여 16개</p>-->
    <!--        <p>금액 1,200원(gifticon)</p>-->
    <!--    </div>-->
    <!---->
    <!--    <div class="history_content7">-->
    <!--        <p>21.06.13</p>-->
    <!--        <p>구매 10개</p>-->
    <!--        <p>잔여 16개</p>-->
    <!--        <p>금액 1,200원(iOS)</p>-->
    <!--    </div>-->
    <!---->
    <!--    <div class="history_content8">-->
    <!--        <p>21.05.08</p>-->
    <!--        <p>구매 10개</p>-->
    <!--        <p>잔여 16개</p>-->
    <!--        <p>금액 1,200원(엄카)</p>-->
    <!--    </div>-->



</div>

<script>
    // (function() {
    //     // jquery로 해당 input data 값 가져오기.
    //     // html tag안에 class, id, name 으로 구분 값을 가져옵니다.
    //     // class 로 구분해서 값을 가져오려면 $('.class명').val()
    //     // id 로 구분해서 값을 가져오려면 $('#id명').val()
    //     // name으로 구분해서 값을 가져오려면 $("태그이름[name='name명']").val() ex) $("input[name='m_id']").val()
    //
    //     // 데이터 검증
    //     // alert("Dd");
    //     // signup.php로 보낼 데이터 포맷 정의
    //     var chocoid = "1";
    //
    //     var inputData = {
    //         choco_id: chocoid,
    //     }
    //
    //     $.ajax({
    //         type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
    //         url: 'buy_historyForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
    //         data: inputData,          // url로 전송할 데이터 정의
    //         dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
    //
    //         success: function(result) {
    //             // url에서 해당 data를 처리하고 반환된 success 결과에 대해서 로직 처리
    //             console.log(result);
    //             var callResult = result.result; //db에서 받아오는 방법
    //             var callCode = result.code;
    //             var callData = result.data || {};
    //             var callErrorReason = result.errorReason || '';
    //
    //             // var date = result.data.date;
    //             // var cost = result.data.cost;
    //             // var rest = result.data.rest;
    //             // var amounts = result.data.amounts;
    //             // var way = result.data.way;
    //             // var kinds = result.data.kinds;
    //
    //             // alert(date+","+cost+","+rest+","+amounts+","+way+","+kinds);
    //
    //             // $('#buy_count').text(count+'개');
    //             //
    //             // //반복문 필요 아래
    //             // $('#b_h_date').text(date);
    //             // $('#b_h_purchase').text('구매 '+amounts+'개');
    //             // $('#b_h_remain').text('잔여 '+rest+'개');
    //             // $('#b_h_price').text('금액 '+cost+'원');
    //             var str = "";
    //
    //             if (Array.isArray(callData)) {
    //                 callData.forEach(function (data) {
    //                     console.log(data);
    //                     str += data.date + ", " + data.amounts + ", " + data.rest + ", " + data.cost + data.way + "\n";
    //                 })
    //             }
    //             alert(str); // 자바 스크립트에
    //
    //             /*     var b_h_date = $('#b_h_date').val();
    //                  var b_h_purchase = $('#certimg').val();
    //                  var b_h_ramain = $('#certimg').val();
    //                  var b_h_price = $('#certimg').val();
    //                  var buy_count = $('#certimg').val();
    //  */          },
    //         error: function(err) {
    //             // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
    //             console.log(err);
    //         }
    //     })
    // })();





</script>


</body>

</html>
