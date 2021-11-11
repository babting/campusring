<!DOCTYPE html>
<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];
$id = @$_GET['id'];

if (!@$_GET['sort']){
    $sort = 'ORDER BY r_date DESC';
}else{
    $sort = "ORDER BY ".$_GET['sort']." DESC" ;
}
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
    <title>리뷰목록페이지</title>

</head>
<!--
    리뷰 목록 페이지
    페이지 담당:
    마지막 업데이트 : 210927 ajax 작업

    -->
<!--
ajax필요사항

(보내기)
삭제하기 누를시 아럴트 ,리뷰아이디
세션 아이디

(php에서 받기)
[멘토프로필에서 넘어올 경우] [마이페이지에서 넘어올 경우]
[작성페이지에서 넘어올 경우]
강의 번호,세션 아이디,
(출력)review 테이블  리뷰단 유저명r_name, 아이디user_id , 별점r_star , 날짜 r_date, 댓글 내용 r_context,
member테이블의 photo프로필사진,
위쪽 평균 별점(강의 에 달린 리뷰들의 모든 r_star 컬럼의 값 비율을 내 주기를 바람....) 각 점수 별 %값 출력
/*
별 5개는 최고
별 4개는 좋음
별 3개는 보통
별 2개는 별로
별 1개는 나쁨
*/

(자바스크립트)
수정하기 누를시 -
삭제하기 누를시 - 사용자의 리뷰 삭제 후 아럴트 , 리디렉션


최신순 누를시 -sql 다시 조회회베스트순.,,,,,
별점 평균도 출력해야함
접기 누를시 평균부분 사라지기



-->
<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
    <div class="login_text">상품 품질평</div>
    <div class=""></div>
</header>

<div class="container">

    <div>
            <div class="review_sort">
                <ul>
                    <li onclick="location.href='./review.php?id=<?php echo $id?>&sort=r_star'"><span <?php if (@$_GET['sort'] == "r_star") echo
                        "style = 'font-color: #f0f'; "; ?> >베스트순</span></li>
                    <li><span>|</span></li>
                    <li onclick="location.href='./review.php?id=<?php echo $id?>&sort=r_date'"><span <?php if (@$_GET['sort'] == "r_date") echo
                        "style = 'font-color: #f0f'; "; ?>>최신순</span></li>
                </ul>
            </div>

            <?php
            $sql = "SELECT r_context, r_star, review_id, mentor_id, r_date 
                    , (select name from member where user_id = review.review_id) AS r_name
                    , (select photo from member where user_id = review.review_id) AS photo
                    FROM review
                    where class_id='$id' " .$sort;
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) { //if 시작

            while ($row = mysqli_fetch_array($result)) { //while 끝
            ?>
            <div class="review_page">
                <div class="user1">
                    <img id="ChnImg" src="<?= $row['photo']?>" alt="기본이미지">
<!--                    <img id="ChnImg" src="../img/soo_img.jpg" alt="기본이미지">-->
                    <!---이미지 태그로 바꿔주세ㅓ용-->
<!--                    <div class="user1_icon" ><i class="fas fa-user fa-3x"></i></div>-->
                </div>

                <div class="review_group">
                    <div class="review_name">
                        <?= $row['r_name'] ?>
                    </div>
                    <div class="review_star_count">
                        <?php
                        for($i = 1; $i <= $row['r_star']; $i++){
                            ?>
                            <i class="fas fa-star fa-1x "></i>
                            <?php
                        }
                        ?>
                        <span class="review_date"><?= $row['r_date'] ?></span>
                    </div>
                    
                    <!--리뷰내용을 보여주는 디브 임의 로 추가했어요-->
                    <div class="review_context"><?= $row['r_context'] ?></div>

                </div>

            </div>
            <?php
            } //while 끝
        } else { ?>
                <p class="no_review">리뷰가 없습니다.</p>
        <?php

            }
    ?>

<!--            <div class="review_btn">-->
<!--                <button><a href="review_my.php">수정하기</button></a>-->
<!--                <button type="button" value="리뷰 아이디값" onclick="return onclickDel(event)">삭제하기</button>-->
<!--                <button><a href="review_ing.php">작성하기</button></a>-->
<!---->
<!--            </div>-->

        </div>
    </div>
</div>


<script>
    // window.onload =
    // 즉시 호출 함수 --> (function() { /* ..내용.. */ })()
    (function() {

        // 데이터 검증
        // alert("Dd");
        // signup.php로 보낼 데이터 포맷 정의
        // var menuData = {
        //     m_id: "babting",
        // }



        $.ajax({
            type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
            url: 'reviewForJson.php', //
            data: {},          // url로 전송할 데이터 정의
            dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.

            success: function(result) {
                // url에서 해당 data를 처리하고 반환된 success 결과에 대해서 로직 처리
                console.log(result);
                var callResult = result.result; //db에서 받아오는 방법
                var callCode = result.code;
                var callData = result.data || {};
                var callErrorReason = result.errorReason || '';

                var r_name = result.data.r_name;  //리뷰단 유저명
                var user_id = result.data.user_id;
                var r_star = result.data.r_star; //별점
                var r_date = result.data.r_date;
                var r_context = result.data.r_context;
                var photo = result.data.photo;




                // alert(email+","+pNum+","+name+","+choco+","+review_did+","+match_did);

                 $('.review_name').text(r_name);
                 $('.review_date').text(r_date);
                $('.review_context').text(r_context);


            },
            error: function(err) {
                // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
                console.log(err);
            }
        })
    })();
</script>
<script>
    function onclickDel(e) {
        e.preventDefault(); // submit은 기본적으로 페이지를 reload 시키기 때문에, 페이지 리로드 현상 방지.


        alert("삭제 하시겠습니까?");
        // class 로 구분해서 값을 가져오려면 $('.class명').val()
        // id 로 구분해서 값을 가져오려면 $('#id명').val()
        // name으로 구분해서 값을 가져오려면 $("태그이름[name='name명']").val()    ex) $("input[name='m_id']").val()

       var re_id= e.target.value; //누른 리스트에서 값 받기기
       var id = re_id; //리뷰 아이디

// 데이터 검증
        // login.php로 보낼 데이터 포맷 정의
        var inputData = {  /*340 번 줄 data 값 */
            user_id : user_id,

        }

        $.ajax({
            type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
            url: 'reviewForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
            data: inputData,          // url로 전송할 데이터 정의, 위에서 정의한 그 객체 변수
            dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
            success: function(result) {
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
                if (!callResult) {  // 로그인에 실패한 경우
                    alert(callErrorReason); // 실패 원인 alert 문구
                }
                if (callResult) {   // 로그인에 성공한 경우
                    alert("삭제 완료") //페이지 이동
                }
            },
            error: function(err) {
                // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
                console.log(err);
            }
        })
    }

</script>



</body>

</html>