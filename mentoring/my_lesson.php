<?php

session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';
$user_id = $_SESSION['user_id'];



?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="author" content="carpeDM"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="../css/styles.css">
    <!--  <script src="https://kit.fontawesome.com/a9eb1f10be.js" crossorigin="anonymous"></script>  -->
    <script src="https://kit.fontawesome.com/f45d796544.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>내 강의 리스트</title>
</head>

<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
<!--    <div class="btn_prev"><a href="../member/menu.php"><i class="fas fa-bars fa-2x"></i></a></div>-->
    <div class="login_text">내 강의리스트</div>
    <div class="btn_after"><a href="../matching/matching_input.php"><i class="fas fa-search-plus  fa-2x"></i></a></div>
</header>

<div class="container">
    <?php

    $sql = "select *, (select name from member where user_id = class.user_id) AS name from class where user_id='$user_id'";


    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) { //if 시작

        while ($row = mysqli_fetch_array($result)) { //while 끝
            ?>
            <div class="my_lesson_mtb10">
                <div class="my_lesson_bd">
                    <div class="my_lesson">
                        <?php
                        if($row['thumbnail']){?>
                            <img src="<?= $row['thumbnail'] ?>">
                        <?php }else{ ?>
                            <img src="../img/computer (1).png">
                        <?php } ?>
                    </div>
                    <div class="my_leson_cont">
                        <p id="title"><?= $row['title'] ?></p>
                        <p>멘토 : <span><?= $row['name'] ?></span></p>
                        <p class="my_lesson_ellipsis"><?= $row['context'] ?></p>
                        <div class="my_lesson_tag"># <?= $row['keyword'] ?></div>
                        <div class="my_lesson_btn">
                            <a href="./lessonup.php?id=<?php echo $row['id'] ?>" style="color:#fff;">상세보기</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } //while 끝

    } else { //if 끝, else 시작
        ?>
        <br><br>
        <p class="result_s">해당 검색 조건에 해당하는 내역이 없습니다.</p>
    <?php } //else 끝Œ
    ?>


    <!-- 하단바 -->
    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>

    <!--하단바끝 -->


    <!--  </div> 콘테이너끝 -->

    <script>
        //  var target = document.querySelectorAll(".lesson_a"); // 강의 리스트 에이태그

        //  var targetLength = target.length;

        //for(var i=0; i < targetLength; i++){
        //   target[i].addEventListener("click",onClickli());
        //}

        //    function onClickli(){

        //클릭시에  강의 리스트로 이동하는


        //    console.log("."+this.className+"에 이벤트 추가"); //여러 태그에 이벤트를 추가 합니다

        //document.location.href="../mentoring/lesson_info.php";

        //   }

    </script>

    <script>
        /*백엔드 처리 ,
               ,리스트 하나를 누르면 강의 정보로 이동
               , 카드에 강의 섬네일 (또는 멘토사진) ,  강의 제목 , 멘토 이름 ,강의 내용 , 키워들 를 출력해야 함 (이전 페이지에서 추려진 결과 명)
              (받기) class테이블   id(강의 번호)
                   (가져오기)
                   class테이블 thumbnail ,title,user_id(멘토), context,keyword
                   member 테이블 user_id(멘토) , name
                   (보내기) class테이블   id(강의 번호) ,user_id멘토 아이디
        */

        //            (function() {  // 1.즉시 호출 함수 , 데이터 받기용
        //                var lessonid = "미술";
        //
        //                var inputData = {
        //                    lesson_id: lessonid,
        //                }
        //
        //                $.ajax({
        //                    type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
        //                    url: 'lesson_listForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
        //                    data: inputData,          // url로 전송할 데이터 정의
        //                    dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
        //
        //                    success: function(result) {
        //                        // url에서 해당 data를 처리하고 반환된 success 결과에 대해서 로직 처리
        //                        console.log(result);
        //                        var callResult = result.result; //db에서 받아오는 방법
        //                        var callCode = result.code;
        //                        var callData = result.data || [];   // data가 list일 경우에는 {}가 아니라 []로 쓰면 되요.
        //                        var callErrorReason = result.errorReason || '';
        //
        //                        var str = "";
        //
        //                        /*
        //                                      //  x.length;
        //                                        x=document.getElementsByTagName();
        //                                        x[i].innerHTML = ;
        //
        //
        //
        //                                             <li ><a class="lesson_a" href="../mentoring/lesson_info.php?lesson_id=<?//=""?>//">
        //                <span><img class="le_thumb" width="50px" height="50px" src=""></span>
        //                <h3 class="le_title">전직 간호사와 함께하는 과외<h3>
        //
        //                    <div class="le_context" >
        //                            간호사로 활동한 경험을 바탕으로 간호조무사 자격증 수업을 운영합니다.
        //                    </div>
        //                    <div class="le_mentor">조희정</div>
        //                    <div class="le_keyword">#한국사능력 #역사학과</div><!--키워드 조회하여 php로 2~3개 출력-->
        //
        //*/
        //                        //페이지 출력시 아래 코드로
        //                        // data가 list 라면 (list 체크 한 후 처리)
        //                        if (Array.isArray(callData)) {
        //                            callData.forEach(function (data) {
        //                                console.log(data);
        //                                str += data.title + ", " + data.name + ", " + data.context + ", " + data.keyword + "\n";
        //                            })
        //                        }
        //                        alert(str); // 자바 스크립트에
        //
        //                        //  for (var i = 0; i <lessonid.length; i++) {
        //                        //  console.log('엘레멘트', i, lessonid[i]);
        //                        //  $('.lesson_a').href('../mentoring/lesson_info.php?lesson_id='+lessonid[i]);
        //                        //
        //                        //  };
        //
        //                        //   $('#m_ring').text(choco+'개');
        //                        //    $('#m_rev').text(review_did+'개');
        //
        //                    },
        //                    error: function(err) {
        //                        // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
        //                        console.log(err);
        //                    }
        //                }) //에이작스 end
        //            })(); //함수 구현 END
        //
        //
        //            function onClickli(e) { //2 . 데이터 보내기용 함수
        //                /*
        //
        //                     lesson_a
        //                                le_thumb
        //                                le_title
        //                                le_context
        //                                le_mentor
        //                                le_keyword
        //                 */
        //
        //                //href="../mentoring/lesson_list.php" 로 강의 번호를 보내줍니다 (30행)
        //
        //                e.preventDefault(); // submit은 기본적으로 페이지를 reload 시키기 때문에, 페이지 리로드 현상 방지.
        //
        //                // jquery로 해당 input data 값 가져오기. 현재 클래스 이름을 참조하는 형태
        //                // jquery로 해당 input data 값 가져오기.
        //                // html tag안에 class, id, name 으로 구분 값을 가져옵니다.
        //                // class 로 구분해서 값을 가져오려면 $('.class명').val()
        //                // id 로 구분해서 값을 가져오려면 $('#id명').val()
        //                // name으로 구분해서 값을 가져오려면 $("태그이름[name='name명']").val()    ex) $("input[name='m_id']").val()
        //
        //                var lesson_id = "미술"; //이전 페이지에서 레슨 아이디 30개를 담은 테이블이 보내져야함..
        //
        //
        //
        //                // 데이터 검증
        //                // 데이터 포맷 정의
        //                var inputData = {
        //                    lesson_id: lesson_id,
        //
        //
        //                }
        //                //  alert(lesson_id);
        //
        //                $.ajax({
        //                    type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
        //                    url: 'lesson_listForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
        //                    data: inputData,          // url로 전송할 데이터 정의, 위에서 정의한 그 객체 변수
        //                    dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
        //                    success: function(result) {
        //                        // url에서 해당 data를 처리하고-> 반환된 success 결과에 대해서 로직 처리
        //                        /**
        //                         * RESULT DATA FORMAT
        //                         * code: 404                                // http 상태 코드. (참조: https://developer.mozilla.org/ko/docs/Web/HTTP/Status)
        //                         * data: null                               // 성공할 경우 알맞은 data, 실패할 경우 null
        //                         * errorReason: "존재하지 않은 회원입니다."     // 성공할 경우 ""(빈 값), 실패할 경우 알맞은 실패사유
        //                         * result: false                            // ajax call 성공 여부
        //                         **/
        //
        //                        console.log(result);  //디버깅 용도
        //
        //                        // jsonUtil.php 에 있는 jsonFailure() 메소드 사용. --> message와 code를 동적으로 할당
        //                        var callResult = result.result;
        //                        var callCode = result.code;
        //                        var callData = result.data || {};
        //                        var callErrorReason = result.errorReason || '';
        //
        //                        if (!callResult) {  // 실패한 경우
        //                            alert(callErrorReason); // 실패 원인 alert 문구
        //                        }
        //
        //                        if (callResult) {   // 성공한 경우
        //                            location.href='../lesson_info.php';  //페이지 이동
        //                        }
        //
        //                    },
        //                    error: function(err) {
        //                        // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
        //                        console.log(err);
        //                    }
        //                })
        //            }
        //
        //        </script>

</body>
</html>