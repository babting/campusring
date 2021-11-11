<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">

    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> <!-- ajax를 사용하기 위해 jquery cdn으로 불러옴. -->
    <title>로그인</title>
</head>
<body>
<!--    <form name="frmLogin" method="post" action="login.php">-->
<form name="frmLogin" onsubmit="return onSubmit(event);">
    <header class="hd_box">
        <div class="btn_prev" onclick="window.history.back();"><i class="fas fa-angle-left fa-3x"></i></div>
        <div class="login_text">로그인</div>
        <div class=""></div>
    </header>
    <div class="container">
        <div class="bg_circle">
            <div id="circle"></div>
        </div>
        <div class="id_box">
            <input type="text" class="id" placeholder="아이디" name="id">
            <span class="icon_id_box">
                    <i class="fas fa-user"></i>
                </span>
        </div>
        <div class="pw_box">
            <input type="password" class="pw" placeholder="비밀번호" name="pw">
            <span class="icon_pw_box">
                    <i class="fas fa-lock"></i>
                </span>
        </div>
        <span class="save_id">
                <input type="checkbox" id="idSaveCheck"/>
                <label for="idSaveCheck">아이디 저장</label>
            </span>

        <div class="login_btn" id="login_b">
            <!--                <button type="submit" class="login_btn" onclick="mainPage()">로그인</button>-->
            <button class="login_btn">로그인</button>
        </div>
        <nav class="nav_under">
            <ul>
                <li><a href="member/find_id.php">아이디 찾기</a></li>
                <li><a href="member/find_pw.php">비밀번호 찾기</a></li>
                <li><a href="member/signup.php">회원가입</a></li>
            </ul>
        </nav>
    </div>
</form>



<footer></footer>


<script>
    $(document).ready(function(){
        var userInputId = getCookie("userInputId");//저장된 쿠기값 가져오기
        $("input[name='id']").val(userInputId);

        if($("input[name='id']").val() != ""){ // 그 전에 ID를 저장해서 처음 페이지 로딩
            // 아이디 저장하기 체크되어있을 시,
            $("#idSaveCheck").attr("checked", true); // ID 저장하기를 체크 상태로 두기.
        }

        $("#idSaveCheck").change(function(){ // 체크박스에 변화가 발생시
            if($("#idSaveCheck").is(":checked")){ // ID 저장하기 체크했을 때,
                var userInputId = $("input[name='id']").val();
                setCookie("userInputId", userInputId, 7); // 7일 동안 쿠키 보관
            }else{ // ID 저장하기 체크 해제 시,
                deleteCookie("userInputId");
            }
        });

        // ID 저장하기를 체크한 상태에서 ID를 입력하는 경우, 이럴 때도 쿠키 저장.
        $("input[name='id']").keyup(function(){ // ID 입력 칸에 ID를 입력할 때,
            if($("#idSaveCheck").is(":checked")){ // ID 저장하기를 체크한 상태라면,
                var userInputId = $("input[name='id']").val();
                setCookie("userInputId", userInputId, 7); // 7일 동안 쿠키 보관
            }
        });
    });

    function setCookie(cookieName, value, exdays){
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + exdays);
        var cookieValue = escape(value) + ((exdays==null) ? "" : "; expires=" + exdate.toGMTString());
        document.cookie = cookieName + "=" + cookieValue;
    }

    function deleteCookie(cookieName){
        var expireDate = new Date();
        expireDate.setDate(expireDate.getDate() - 1);
        document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString();
    }

    function getCookie(cookieName) {
        cookieName = cookieName + '=';
        var cookieData = document.cookie;
        var start = cookieData.indexOf(cookieName);
        var cookieValue = '';
        if(start != -1){
            start += cookieName.length;
            var end = cookieData.indexOf(';', start);
            if(end == -1)end = cookieData.length;
            cookieValue = cookieData.substring(start, end);
        }
        return unescape(cookieValue);
    }

    function onSubmit(e) {
        e.preventDefault(); // submit은 기본적으로 페이지를 reload 시키기 때문에, 페이지 리로드 현상 방지.
        // jquery로 해당 input data 값 가져오기.
        var id = $('.id').val();
        var pw = $('.pw').val();
        // login.php로 보낼 데이터 포맷 정의
        var loginData = {
            user_id: id,
            pw: pw,
        }
        $.ajax({
            type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
            url: 'loginForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
            data: loginData,          // url로 전송할 데이터 정의
            dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
            success: function(result) {
                // url에서 해당 data를 처리하고 반환된 success 결과에 대해서 로직 처리
                /**
                 * RESULT DATA FORMAT
                 * code: 404                                // http 상태 코드. (참조: https://developer.mozilla.org/ko/docs/Web/HTTP/Status)
                 * data: null                               // 성공할 경우 알맞은 data, 실패할 경우 null
                 * errorReason: "존재하지 않은 회원입니다."     // 성공할 경우 ""(빈 값), 실패할 경우 알맞은 실패사유
                 * result: false                            // ajax call 성공 여부
                 **/
                console.log(result)
                var callResult = result.result;
                var callCode = result.code;
                var callData = result.data || {};
                var callErrorReason = result.errorReason || '';
                if (!callResult) {  // 로그인에 실패한 경우
                    alert(callErrorReason); // 실패 원인 alert
                }
                if (callResult) {   // 로그인에 성공한 경우
                    location.href='index.php';
                }
            },
            error: function(err) {
                // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
                console.log('err!!');
                console.log(err);
            }
        })
    }
</script>
</body>
</html>