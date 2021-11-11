<!doctype html>
<html lang="ko">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- ajax를 사용하기 위해 jquery cdn으로 불러옴. -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <!--jquery ajax-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> <!-- ajax를 사용하기 위해 jquery cdn으로 불러옴. -->


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <title>아이디찾기</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/reset-css@5.0.1/reset.css">
    <link rel="stylesheet" href="../css/find_id.css">
    <link rel="stylesheet" href="../css/login.css">

</head>
<body>
<!DOCTYPE html>
<html lang="ko">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <title>아이디찾기</title>
</head>

<body>
<header class="hd_box">
    <div class="btn_prev"><a href="../login.php"><i class="fas fa-angle-left fa-3x" onclick="history.go(-1);"></i></a>
    </div>
    <div class="login_text">비밀번호찾기</div>
    <div class=""></div>
</header>

<div class="container">
    <div class="id_box">
        <input type="text" class="f_id" placeholder="아이디를 입력하세요">


    </div>
    <div class="pw_box">
        <input type="text" class="email" placeholder="이메일을 입력하세요" style="border: none">
    </div>


    <div class="find_btn">
        <button type="submit" class="btn">비밀번호 찾기</button>
    </div>


</div>
</div>
<footer></footer>

<script>
    $('.btn').click(function () {
        console.log('1');
        //e.preventDefault();

        var id = $('.id').val();
        var email = $('.email').val();

        var inputData = {
            id: id,
            email: email,
        }

        $.ajax({
            url: 'find_pwForJson.php',
            type: 'POST',
            dataType: 'json',
            data: inputData,
            success: function (result) {

                if (result.result == 'SUCCESS') {   // 로그인에 성공한 경우
                    alert("고객님의 비밀번호를 이메일로 전송했습니다.");
                    location.href = '/login.php';
                }else{
                    alert(result.result);
                }
            },
            error: function (err) {
                // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
                console.log(err);
            }
        });
    })

</script>

</body>

</html>

</body>

</html>