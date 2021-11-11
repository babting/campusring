<!DOCTYPE html>
<?php
session_start();
$id = $_GET['id'];

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT 
                title
                , (select name from member where user_id = class.user_id) AS name
                , (select member.user_id from member where user_id = class.user_id) AS mentor_id
            FROM class
            where id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>

<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>리뷰작성페이지</title>
</head>

<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
    <div class="login_text">리뷰작성하기</div>
    <div class=""></div>
</header>

<body>
<input type="hidden" value="<?php echo $id?>" id="class_id" />
<input type="hidden" value="<?php echo $row['mentor_id']?>" id="mentor_id" />
<div class="container">
    <div class="wrap">
<!--        <div class="buy_top">-->
<!--            <ul>-->
<!--                <li><a href="../review/review_my.php" target="_self">내가 작성한 리뷰</a></li>-->
<!--                <li><a href="review_myclass.php" target="_self">나에게 달린 리뷰</a></li>-->
<!--                <li><a href="../review/review.php" target="_self">리뷰 목록</a></li>-->
<!--            </ul>-->
<!--        </div>-->

            <p class="review_ing_title"><?= $row['title'] ?> - 멘토:<?= $row['name'] ?></p>
            <div class="review_rating rating_point">
                <div class="rating">
                    <div class="star" id="rating1" name="rating">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="star" id="rating2" name="rating">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="star" id="rating3" name="rating">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="star" id="rating4" name="rating">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="star" id="rating5" name="rating">
                        <i class="fas fa-star"></i>
                    </div>

                </div>
            </div>
            <div class="review_contents">
                <textarea cols="100"rows="20" id="rev_cont" class="review_textarea" placeholder="리뷰를 써 주세요(10자 이상)" ></textarea>
            </div>

            <div class="mtb-3"></div>
            <div class="container les_class_btn" id="save" name="save" onclick="">
                <span style="color: #fff">등록하기</span>
            </div>


        </form>
    </div>
</div>
<script>
    (function() {
        $("div[name='rating']").click(function () {
            let length = this.id.length;
            let idx = this.id.slice(length - 1, length);
            checkIdx(idx);
        })
    })()

    function checkIdx(idx) {
        for (let i = 1; i <= 5; i++) {
            if (i <= idx) {
                document.getElementById(`rating${i}`).classList.add('clicked');
            } else {
                document.getElementById(`rating${i}`).classList.remove('clicked');
            }
        }
    }

    $("#save").click(function(){
        alert("리뷰를 등록하였습니다.");
        location.href='../review/review_my.php';

        let $clicked = $('.clicked');

        // 0 : falsy 값
        if (!$clicked.length) {
            alert("점수를 매겨주세요!");
            return;
        }

        var rev_cont = $('#rev_cont').val();


        if (rev_cont == ""){
            alert("내용을 입력해주세요.");
            rev_cont.focus();
            return false;
        }

        var rewingData = {
            class_id: $('#class_id').val(),
            mentor_id: $('#mentor_id').val(),
            rating: $clicked.length,
            rev_cont: rev_cont,
        }
        console.log(rewingData);

        $.ajax({
            type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
            url: 'reviewingForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
            data: rewingData,          // url로 전송할 데이터 정의
            dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
            success: function(result) {

                var callResult = result.result;
                var callCode = result.code;
                var callData = result.data || {};
                var callErrorReason = result.errorReason || '';
                // var user_name =  result.data.user_name;

            },
            error: function(err) {
                // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
            }
        })

    });
</script>

</body>
</html>






