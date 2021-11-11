<!DOCTYPE html>
<?php session_start();?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">



    <!--jquery ajax-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> <!-- ajax를 사용하기 위해 jquery cdn으로 불러옴. -->



    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <title>자격증 인증페이지</title>

</head>

<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
    <div class="login_text">자격증 인증하기</div>
    <div class=""></div>
</header>

<div class="container">
    <section>
        <FORM enctype="multipart/form-data"   onsubmit="return onSubmit(event);" style="margin: 10%; margin-top: 5%;margin-bottom: 30%;">


            <!---
            (백엔드 처리)






            가져오기:
            보내기:   사진 보내기
            자격증 번호
            --->
            <!--action="lesson_info.php"-->
            <div>
                <h1 class="cert">자격증 사진 업로드</h1>
                <span width="70%" style="float: left;clear: both;">자격증 사진을 업로드해주세요
            <br/>
            <br/>
            *JPG,PNG 형식만 가능합니다.
          </span>
                <div>
                    <img id="certimg" src="data:image/svg+xml;base64,PHN2ZyBpZD0iQ2FwYV8xIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA1MTIgNTEyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHdpZHRoPSI1MTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGc+PGc+PGNpcmNsZSBjeD0iMjU2IiBjeT0iMjcwLjY1NSIgZmlsbD0iI2ZmYmRiYyIgcj0iMTAwLjg3OCIvPjwvZz48ZyBmaWxsPSIjMDIwMjg4Ij48cGF0aCBkPSJtMjMzLjM0NyAzMjAuNzE0YzIuNzYxIDEuNTI3IDUuODEzIDIuMjg2IDguODYgMi4yODYgMy4zODQgMCA2Ljc2My0uOTM3IDkuNzMxLTIuNzk5bDU0LjI1NC0zNC4wMzljNS4zNzEtMy4zNyA4LjU3OC05LjE2NyA4LjU3OC0xNS41MDhzLTMuMjA3LTEyLjEzOS04LjU3OC0xNS41MDhsLTU0LjI1NC0zNC4wMzljLTUuNjQyLTMuNTM5LTEyLjc2Ni0zLjczNS0xOC41OTItLjUxMS01LjgyNyAzLjIyMy05LjQ0NiA5LjM2MS05LjQ0NiAxNi4wMnY2OC4wNzdjMCA2LjY2IDMuNjIgMTIuNzk4IDkuNDQ3IDE2LjAyMXptMTAuNTUzLTgxLjAzOSA0OS4zNzkgMzAuOTgtNDkuMzc5IDMwLjk4eiIvPjxwYXRoIGQ9Im0xMzAuNjk4IDQyMS40ODloMjUwLjYwNGM1LjUyMiAwIDEwLTQuNDc3IDEwLTEwcy00LjQ3OC0xMC0xMC0xMGgtMjUwLjYwNGMtNS41MjMgMC0xMCA0LjQ3Ny0xMCAxMHM0LjQ3NyAxMCAxMCAxMHoiLz48cGF0aCBkPSJtNDgwLjcyOSA0My45ODloLTQ0OS40NThjLTE3LjI0MyAwLTMxLjI3MSAxNC4wMjktMzEuMjcxIDMxLjI3MnYzNjEuNDc5YzAgMTcuMjQzIDE0LjAyOCAzMS4yNzEgMzEuMjcxIDMxLjI3MWg0NDkuNDU3YzE3LjI0MyAwIDMxLjI3MS0xNC4wMjggMzEuMjcxLTMxLjI3MXYtMzYxLjQ3OWMuMDAxLTE3LjI0My0xNC4wMjctMzEuMjcyLTMxLjI3LTMxLjI3MnptLTQ2MC43MjkgMzEuMjcyYzAtNi4yMTUgNS4wNTYtMTEuMjcxIDExLjI3MS0xMS4yNzFoNDQ5LjQ1N2M2LjIxNSAwIDExLjI3MSA1LjA1NiAxMS4yNzEgMTEuMjcxdjQyLjk5NWgtNDcxLjk5OXptNDcyIDM2MS40NzhjMCA2LjIxNS01LjA1NyAxMS4yNzEtMTEuMjcxIDExLjI3MWgtNDQ5LjQ1OGMtNi4yMTUgMC0xMS4yNzEtNS4wNTYtMTEuMjcxLTExLjI3MXYtMjk4LjQ4NGg0NzJ6Ii8+PHBhdGggZD0ibTE3MS4yNDUgODEuMTIzaC0xMTYuOTc5Yy01LjUyMyAwLTEwIDQuNDc3LTEwIDEwczQuNDc3IDEwIDEwIDEwaDExNi45NzljNS41MjMgMCAxMC00LjQ3NyAxMC0xMHMtNC40NzctMTAtMTAtMTB6Ii8+PHBhdGggZD0ibTQwOS4yMDIgODEuMTIzaC0xMC42NTljLTUuNTIyIDAtMTAgNC40NzctMTAgMTBzNC40NzggMTAgMTAgMTBoMTAuNjU5YzUuNTIyIDAgMTAtNC40NzcgMTAtMTBzLTQuNDc3LTEwLTEwLTEweiIvPjxwYXRoIGQ9Im0zNjAuNjcgODEuMTIzaC0xMC42NTljLTUuNTIyIDAtMTAgNC40NzctMTAgMTBzNC40NzggMTAgMTAgMTBoMTAuNjU5YzUuNTIyIDAgMTAtNC40NzcgMTAtMTBzLTQuNDc4LTEwLTEwLTEweiIvPjxwYXRoIGQ9Im00NTcuNzM0IDgxLjEyM2gtMTAuNjZjLTUuNTIyIDAtMTAgNC40NzctMTAgMTBzNC40NzggMTAgMTAgMTBoMTAuNjZjNS41MjIgMCAxMC00LjQ3NyAxMC0xMHMtNC40NzctMTAtMTAtMTB6Ii8+PC9nPjwvZz48L3N2Zz4=" />
                </div>
            </div>
            <div>
                자격증번호 : <input id="certnum" type="input" value=""><button>인증하기</button>
            </div>
            <div>
                <input type="file" accept="video/*" value="">
            </div>

               <button type="submit">등록하기</button> <!--우리 핑크로 !-->

        </FORM>
    </section>
</div>




<script>
    function onSubmit(e) {
        e.preventDefault(); // submit은 기본적으로 페이지를 reload 시키기 때문에, 페이지 리로드 현상 방지.
        // jquery로 해당 input data 값 가져오기. 현재 클래스 이름을 참조하는 형태
        // jquery로 해당 input data 값 가져오기.
        // html tag안에 class, id, name 으로 구분 값을 가져옵니다.
        // class 로 구분해서 값을 가져오려면 $('.class명').val()
        // id 로 구분해서 값을 가져오려면 $('#id명').val()
        // name으로 구분해서 값을 가져오려면 $("태그이름[name='name명']").val()    ex) $("input[name='m_id']").val()




        var certimg = $('#certimg').val();
        var certnum = $('#certnum').val();

// 데이터 검증
        // login.php로 보낼 데이터 포맷 정의
        var inputData = {  /*340 번 줄 data 값 */
            certimg: certimg,

            certnum: certnum,
        }

        $.ajax({
            type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
            url: 'mento_certForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
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
                if (!callResult) {  // 실패한 경우
                    alert(callErrorReason); // 실패 원인 alert 문구
                }
                if (callResult) {   // 성공한 경우
                    location.href='../matching.php';  //페이지 이동
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