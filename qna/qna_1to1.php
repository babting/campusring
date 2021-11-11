<?php
session_start();
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>문의하기</title>
</head>

<body>
<header class="hd_box">
    <!--    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>-->
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onclick="history.go(-1);"></i></div>
    <div class="login_text">1:1문의하기</div>
</header>

<div class="container">
    <div class="qna_mg">
        <form action="" onsubmit="return onSubmit(event);">
            <div class="qna_con_sort">
                <p>내용</p>
                <div class="qna_contents">
                    <input type="text" id="qna_title" name="qtitle" placeholder="제목을 입력해주세요.">
                    <textarea name="" id="qna_contents" name="qcontents" cols="30" rows="20" placeholder="내용을 입력해주세요."></textarea>
                </div>
            </div>

            <div class="qna_btn">
                <button type="button" onclick="location.href='/index.php'">취소하기</button>
                <button type="submit" id="qna_click">등록하기</button>
            </div>
        </form>
    </div>
</div>

<script>


    function onSubmit(e) {
        e.preventDefault(); // submit은 기본적으로 페이지를 reload 시키기 때문에, 페이지 리로드 현상 방지.

        // jquery로 해당 input data 값 가져오기.
        // html tag안에 class, id, name 으로 구분 값을 가져옵니다.
        // class 로 구분해서 값을 가져오려면 $('.class명').val()
        // id 로 구분해서 값을 가져오려면 $('#id명').val()
        // name으로 구분해서 값을 가져오려면 $("태그이름[name='name명']").val() ex) $("input[name='m_id']").val()
        // var id = $('#id').val();

        var user_id = "<?php $user_id?>";
        var qna_title = $('#qna_title').val();
        qna_title.trim();
        if (qna_title==""){
            alert("제목을 입력하세요");
            document.getElementById("qna_title").focus();
            return false;
        }


        var qna_contents = $('#qna_contents').val();
        qna_contents.trim();
        if (qna_contents==""){

            alert("내용을 입력하세요");
            document.getElementById("qna_contents").focus();
            return false;
        }



        // 데이터 포맷 정의
        var qnaaskData = {
            // id: id,
            user_id: user_id,
            qna_title: qna_title,
            qna_contents: qna_contents,
        }

        $.ajax({
            type: 'POST', // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
            url: 'qna_1to1ForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
            data: qnaaskData, // url로 전송할 데이터 정의
            dataType: 'json', // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
            success: function (result) {
                // url에서 해당 data를 처리하고 반환된 success 결과에 대해서 로직 처리
                /**
                 * RESULT DATA FORMAT
                 * code: 404                                // http 상태 코드. (참조: https://developer.mozilla.org/ko/docs/Web/HTTP/Status)
                 * data:                                    // 성공할 경우 알맞은 data, 실패할 경우 null
                 * errorReason: "존재하지 않은 회원입니다."     // 성공할 경우 ""(빈 값), 실패할 경우 알맞은 실패사유
                 * result: false                            // ajax call 성공 여부
                 **/
                console.log(result);
                var callResult = result.result;
                var callCode = result.code;
                var callData = result.data || {};
                var callErrorReason = result.errorReason || '';



                if (result.result) {
                    alert("문의 등록이 완료되었습니다.");
                    location.href='../index.php';
                }

                if (!result.result) {
                    alert("문제가 발생했습니다. \n Error CODE: " + result.message );
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