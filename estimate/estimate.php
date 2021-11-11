<!DOCTYPE html>
<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];

//견적서 아이디 조회 후 스테이트 값 받기 
$state = $_GET['state'];
$id = $_GET['id'];


/*
 * 
 * 1 매칭요청
 * 2 매칭수락
 * 3 매칭거절
 * 4 매칭종료
 */

?>

<!--견적서 리스트 , 견적서 보내는 페이지에서 견적서 아이디나 상태값을 보내줘야 합니당-->
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/main.js"></script>

    <!--jquery ajax-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- ajax를 사용하기 위해 jquery cdn으로 불러옴. -->

    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <title>견적서페이지</title>
</head>
<body>


<!----
(받아서
출력하기 )
sebu_kr
[match_class 테이블]
제안금액 e_money
받은 날짜 출력 e-date
//멘토 - class_id -> 견적 보낸 근원 유저
유저 아이디 user_id
제안 항목 e_item
(보내기)
클래스 아이디
받은 강의의 match class 테이블 스테잍, 4 로 수정해주세요
날짜
아이템(제안항목)
가격
---->
<header class="em_hd_box">

    <div class="em_login_text">온라인 견적서</div>
    <div class="em_btn_prev"><i class="fas fa-times fa-2x" onClick="history.go(-1);"></i></div>
    <div class=""></div>
</header>

<?php
$sql = "select
        t1.*
         , (select t2.name from member t2 where t2.user_id = t1.user_id) as user_name
        from
            match_class t1
        where 1=1
        and t1.id = '$id';";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) { //if 시작
    $row = mysqli_fetch_array($result)
    ?>
    <div class="container">
        <div class="content">
            <p class="name" id="esti_name"><?= $row['user_name'] ?></p><br>
            <p class="estimemate_date" id="esti_date"><?= $row['e_date'] ?><br>
                견적서입니다.</p>
        </div>

        <div class="content1">
            <p class="service">서비스<span class="subject" id="subject"><?= $row['e_item'] ?></span></p><br>
            <div class="price_align">
                <p class="price">제안금액
                <div class="ring">
                    <img src="../img/ring.PNG"><span id="esti_price"><?= $row['e_money'] ?></span></p>
                </div>
            </div>
        </div>
        <div class="content2">
            <p class="warring"><i class="fas fa-exclamation-circle red_color"></i>유의사항</p><br>
            <p class="show">- 서로 직접적인 연락처 공유보다는<br>
                &nbsp; 어플 내 채팅을 이용해주세요.</p>
        </div>


        <div class="mento_btn">

        <script>
            var esti_id = <?= $row['id'] ?> //강의번호 받기
        </script>
        
        <?php
                if ($state =="매칭요청"){ ?>
                        
                            <button type="button" class="mento_btn" value="yes" onclick="return onClickbt(event)">승인</button>
                            <button type="button" style="color: #000; background: #fff; border: 1px solid #ff65a7;" class="mento_btn" value="no" onclick="return onClickbt(event)">거절</button>
                        
                <?php }else if($state =="매칭수락"){  ?>
<!--                    <button type="button" class="mento_btn" value="cancel" onclick="return onClickbtCancel(event)">취소하기</button>-->

                    <button type="button" class="mento_btn" style="color: #fff; background: #ff65a7;" value="end" onclick="return onClickbt(event)">매칭 종료</button>

                <?php }else if($state =="매칭거절"){   ?>

                <?php }else{  //종료인경우

                   echo "
<br/>
<br/>
<p style='color:#000; '>
종료된 매칭 입니다
                    </p>";
                            
                        }?>
        </div>
    </div>
    <?php
    //while 끝

} else { //if 끝, else 시작
    ?>
    <!--    <br><br>-->
    <!--    <p class="result_s">구매 내역이 없습니다.</p>-->
<?php } //else 끝
mysqli_close($conn); // 디비 접속 닫기
?>

<!--<script>-->
<!--    (function() { //데이터 받기-->
<!--        // jquery로 해당 input data 값 가져오기.-->
<!--        // html tag안에 class, id, name 으로 구분 값을 가져옵니다.-->
<!--        // class 로 구분해서 값을 가져오려면 $('.class명').val()-->
<!--        // id 로 구분해서 값을 가져오려면 $('#id명').val()-->
<!--        // name으로 구분해서 값을 가져오려면 $("태그이름[name='name명']").val() ex) $("input[name='m_id']").val()-->
<!---->
<!--        // 데이터 검증-->
<!--        // alert("Dd");-->
<!--        // signup.php로 보낼 데이터 포맷 정의-->
<!---->
<!---->
<!---->
<!--        var inputData = {-->
<!---->
<!--        }-->
<!---->
<!--        $.ajax({-->
<!--            type: 'POST',           // http type 정의 ["GET", "POST"] --> <!--<form> 태그의 method attribute 맞습니다.-->
<!--            url: 'estimateR_ForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.-->
<!--            data: {},          // url로 전송할 데이터 정의-->
<!--            dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 -->
<!--("html", "xml", "json", "text", "jsonp") 등이 있습니다.-->
<!---->
<!--            success: function(result) {-->
<!--                // url에서 해당 data를 처리하고 반환된 success 결과에 대해서 로직 처리-->
<!--                console.log(result);-->
<!--                var callResult = result.result; //db에서 받아오는 방법-->
<!--                var callCode = result.code;-->
<!--                var callData = result.data || {};-->
<!--                var callErrorReason = result.errorReason || '';-->
<!---->
<!--                var e_money = result.data. e_money;-->
<!--                var e_date = result.data.e_date;-->
<!--                //var mentor = result.data.mentor; //class_id 로 검색하여 강의의 주인 아이디 받아오기-->
<!--                var user_name = result.data.user_name; //-->
<!--                var e_item = result.data.e_item;-->
<!---->
<!---->
<!--              //  alert(date+","+cost+","+rest+","+amounts+","+way+","+kinds);-->
<!---->
<!--                $('#esti_name').text(user_name+'님!');-->
<!--                $('#esti_date').text(e_date);-->
<!--                $('#subject').text(e_item);-->
<!--                $('#esti_price').text(e_money);-->
<!---->
<!---->
<!---->
<!--             },-->
<!--            error: function(err) {-->
<!--                // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)-->
<!--                console.log(err);-->
<!--            }-->
<!--        })-->
<!--    })();-->
<!-- </script> -->
<script>
    function onClickbt(e) { //수락 버튼 이벤트
      

        e.preventDefault(); // submit은 기본적으로 페이지를 reload 시키기 때문에, 페이지 리로드 현상 방지.

        // jquery로 해당 input data 값 가져오기. 현재 클래스 이름을 참조하는 형태
        // jquery로 해당 input data 값 가져오기.
        // html tag안에 class, id, name 으로 구분 값을 가져옵니다.
        // class 로 구분해서 값을 가져오려면 $('.class명').val()
        // id 로 구분해서 값을 가져오려면 $('#id명').val()
        // name으로 구분해서 값을 가져오려면 $("태그이름[name='name명']").val()    ex) $("input[name='m_id']").val()


   if (e.target.value=='yes'){
       console.log('yesyes');

       var answer = "yes";

   }else if(e.target.value=='no'){

       console.log('nope');
       var answer = "no";


   }else if(e.target.value=='end') {

        console.log('enddddddd');
        var answer = "end";

    }

        // 데이터 검증
        // 데이터 포맷 정의
        var inputData = {

            esti_id: esti_id,   //견적서 번호  이 견적의 state 컬럼 값을 수정해주세요
            answer: answer,      //answer 값에 따른 스테이트 처리 해주세요



        }
        //  alert(esti_id);

        $.ajax({
            type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
            url: 'estimateForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
            data: inputData,          // url로 전송할 데이터 정의, 위에서 정의한 그 객체 변수
            dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
            success: function (result) {
                // url에서 해당 data를 처리하고-> 반환된 success 결과에 대해서 로직 처리
                /**
                 * RESULT DATA FORMAT
                 * code: 404                                // http 상태 코드. (참조: https://developer.mozilla.org/ko/docs/Web/HTTP/Status)
                 * data: null                               // 성공할 경우 알맞은 data, 실패할 경우 null
                 * errorReason: "존재하지 않은 회원입니다."     // 성공할 경우 ""(빈 값), 실패할 경우 알맞은 실패사유
                 * result: false                            // ajax call 성공 여부
                 **/

                console.log(result);  //디버깅 용도

                // jsonUtil.php 에 있는 jsonFailure() 메소드 사용. --> message와 code를 동적으로 할당
                var callResult = result.result;
                var callCode = result.code;
                var callData = result.data || {};
                var callErrorReason = result.errorReason || '';

                if (!callResult) {  // 실패한 경우
                    alert(callErrorReason); // 실패 원인 alert 문구
                }

                if (callResult) {   // 성공한 경우


                    switch (answer){
                        case "yes" :
                            alert("견적서를 수락했습니다");
                            location.href = "../estimate/estimate_list.php";
                            break;
                        case "no" :
                            alert("견적서를 거절했습니다");
                            location.href = "../estimate/estimate_list.php";
                            break;
                        case "end" :
                            alert("캠퍼스링 매칭이 종료되었습니다");
                            location.href = "../estimate/estimate_list.php";
                            break;
                        // case "cancel" :
                        //     var really = confirm("견적수락을 취소 하시겠습니까?");
                        //
                        //     if (really==true) { //다시 스테이트를 1로 만들어주세요
                        //
                        //     }

                    }


                    
                }

            },
            error: function (err) {
                // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
                console.log(err);
            }
        })
    }
</script>


</body>
</html>