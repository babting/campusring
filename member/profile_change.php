<!DOCTYPE html>
<?php
//phpinfo();
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM member WHERE user_id = '$user_id' ";
$re = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($re);
$user_name = $row['name'];


?>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>프로필편집</title>
    <!--jquery ajax-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> <!-- ajax를 사용하기 위해 jquery cdn으로 불러옴. -->
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://kit.fontawesome.com/a9eb1f10be.js" crossorigin="anonymous"></script>
    <!--    <script src="./js/img_change.js"></script>-->
</head>

<body>
<header class="hd_box">
    <div class="close_btn"><i class="fas fa-times fa-2x" onClick="history.go(-1);"></i>
    </div>
    <div class="login_text">프로필편집</div>
</header>

<div class="container">
    <form id="view_form" enctype="multipart/form-data" method="post" class="profile_final_form">
        <div class="main_profile_sort">
            <div class="main_profile">
                <img id="ChnImg" src="<?=$row['photo']?>" alt="기본이미지">
            </div>
            <div class="profile_inf_choice">
                <label for="test_file">사진변경</label>
                <input type="file" name="profile" id="test_file">

            </div>
            <!-- <input type="button" id="button1" onclick="ChnImg()" value="프로필변경하기"> -->
            <!-- <div onclick="ChnImg()">프로필변경</div> -->
        </div>

        <div class="pro_name"><?=$row['name']?></div>
        <div id="pro_change" class="dpt_op">
            <p class="pc_password">비밀번호</p>
            <input type="text" id="password" name="password" class="pro_confirm" placeholder="비밀번호를 인증해주세요">
            <input type="button" value="인증" id="pwd_confirm">
        </div>

        <div id="pro_hid" style="display: none;">
            <div class="profile_email_sort">
                <div class="profile_email">이메일</div>
                <input type="text" id="email" name="email" placeholder="이메일 입력" value="<?=$row['email']?>">
                <input type="submit" value="변경">
            </div>


            <div class="pw_check" id="pw_check" name="pw_check">
                <div class="profile_pw_change">비밀번호</div>
                <input type="text" id="ch_pw" name="ch_pw" placeholder="비밀번호 입력" value="<?=$row['password']?>">
            </div>
            <div class="pw_check1" id="pw_check1" name="pw_check1">
                <div class="profile_pw_change">비밀번호 재입력</div>
                <input type="text" id="ch_pw1" name="ch_pw1" placeholder="비밀번호 재입력"  value="<?=$row['password']?>">

            </div>
            <div class="cate_op">
                <p class="pc_cate">카테고리 설정</p>
            </div>
            <label for="category1">1순위</label>
            <div class="pc_cate1">
                <select name="category1" id="category1">
                    <option value="학업" <?php if ($row['cate1'] =="학업") echo "selected"?>>학업</option>
                    <option value="댄스" <?php if ($row['cate1'] =="댄스") echo "selected"?>>댄스</option>
                    <option value="스포츠건강" <?php if ($row['cate1'] =="스포츠건강") echo "selected"?>>스포츠건강</option>
                    <option value="악기" <?php if ($row['cate1'] =="악기") echo "selected"?>>악기</option>
                    <option value="국악" <?php if ($row['cate1'] =="국악") echo "selected"?>>국악</option>
                    <option value="미술" <?php if ($row['cate1'] =="미술") echo "selected"?>>미술</option>
                    <option value="음악이론/보컬" <?php if ($row['cate1'] =="음악이론/보컬") echo "selected"?>>음악이론/보컬</option>
                    <option value="외국어" <?php if ($row['cate1'] =="외국어") echo "selected"?>>외국어</option>
                    <option value="사진영상" <?php if ($row['cate1'] =="사진영상") echo "selected"?>>사진영상</option>
                    <option value="실무교육/컴퓨터" <?php if ($row['cate1'] =="실무교육/컴퓨터") echo "selected"?>>실무교육/컴퓨터</option>
                    <option value="실무교육/디자인" <?php if ($row['cate1'] =="실무교육/디자인") echo "selected"?>>실무교육/디자인</option>
                    <option value="실무교육/마케팅" <?php if ($row['cate1'] =="실무교육/마케팅") echo "selected"?>>실무교육/마케팅</option>
                    <option value="취업준비" <?php if ($row['cate1'] =="취업준비") echo "selected"?>>취업준비</option>
                    <option value="시험/자격증" <?php if ($row['cate1'] =="시험/자격증") echo "selected"?>>시험/자격증</option>
                    <option value="취미/생활" <?php if ($row['cate1'] =="취미/생활") echo "selected"?>>취미/생활</option>
                </select>
            </div>

            <label for="second_category">2순위</label>
            <div class="pc_cate2">
                <select name="second_category" id="second_category">
                    <option value="학업" <?php if ($row['cate2'] =="학업") echo "selected"?>>학업</option>
                    <option value="댄스" <?php if ($row['cate2'] =="댄스") echo "selected"?>>댄스</option>
                    <option value="스포츠건강" <?php if ($row['cate2'] =="스포츠건강") echo "selected"?>>스포츠건강</option>
                    <option value="악기" <?php if ($row['cate2'] =="악기") echo "selected"?>>악기</option>
                    <option value="국악" <?php if ($row['cate2'] =="국악") echo "selected"?>>국악</option>
                    <option value="미술" <?php if ($row['cate2'] =="미술") echo "selected"?>>미술</option>
                    <option value="음악이론/보컬" <?php if ($row['cate2'] =="음악이론/보컬") echo "selected"?>>음악이론/보컬</option>
                    <option value="외국어" <?php if ($row['cate2'] =="외국어") echo "selected"?>>외국어</option>
                    <option value="사진영상" <?php if ($row['cate2'] =="사진영상") echo "selected"?>>사진영상</option>
                    <option value="실무교육/컴퓨터" <?php if ($row['cate2'] =="실무교육/컴퓨터") echo "selected"?>>실무교육/컴퓨터</option>
                    <option value="실무교육/디자인" <?php if ($row['cate2'] =="실무교육/디자인") echo "selected"?>>실무교육/디자인</option>
                    <option value="실무교육/마케팅" <?php if ($row['cate2'] =="실무교육/마케팅") echo "selected"?>>실무교육/마케팅</option>
                    <option value="취업준비" <?php if ($row['cate2'] =="취업준비") echo "selected"?>>취업준비</option>
                    <option value="시험/자격증" <?php if ($row['cate2'] =="시험/자격증") echo "selected"?>>시험/자격증</option>
                    <option value="취미/생활" <?php if ($row['cate2'] =="취미/생활") echo "selected"?>>취미/생활</option>
                </select>
            </div>

            <div>
                <label for="third_category">3순위</label>
                <div class="pc_cate3">
                    <select name="third_category" id="third_category">
                        <option value="학업" <?php if ($row['cate3'] =="학업") echo "selected"?>>학업</option>
                        <option value="댄스" <?php if ($row['cate3'] =="댄스") echo "selected"?>>댄스</option>
                        <option value="스포츠건강"<?php if ($row['cate3'] =="스포츠건강") echo "selected"?>>스포츠건강</option>
                        <option value="악기"<?php if ($row['cate3'] =="악기") echo "selected"?>>악기</option>
                        <option value="국악"<?php if ($row['cate3'] =="국악") echo "selected"?>>국악</option>
                        <option value="미술"<?php if ($row['cate3'] =="미술") echo "selected"?>>미술</option>
                        <option value="음악이론/보컬"<?php if ($row['cate3'] =="음악이론/보컬") echo "selected"?>>음악이론/보컬</option>
                        <option value="외국어"<?php if ($row['cate3'] =="외국어") echo "selected"?>>외국어</option>
                        <option value="사진영상"<?php if ($row['cate3'] =="사진영상") echo "selected"?>>사진영상</option>
                        <option value="실무교육/컴퓨터"<?php if ($row['cate3'] =="실무교육/컴퓨터") echo "selected"?>>실무교육/컴퓨터</option>
                        <option value="실무교육/디자인"<?php if ($row['cate3'] =="실무교육/디자인") echo "selected"?>>실무교육/디자인</option>
                        <option value="실무교육/마케팅"<?php if ($row['cate3'] =="실무교육/마케팅") echo "selected"?>>실무교육/마케팅</option>
                        <option value="취업준비" <?php if ($row['cate3'] =="취업준비") echo "selected"?>>취업준비</option>
                        <option value="시험/자격증" <?php if ($row['cate3'] =="시험/자격증") echo "selected"?>>시험/자격증</option>
                        <option value="취미/생활" <?php if ($row['cate3'] =="취미/생활") echo "selected"?>>취미/생활</option>
                    </select>
                </div>
                <div class="profile_btn">
                    <button type="button" id="btn_save">수정하기</button>
                </div>
            </div>


    </form>
</div>

</div>
<!--container 닫음-->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script charset="UTF-8">
    $('#btn_save').click(function (e) {
        var ch_pw = $('#ch_pw').val();
        var ch_pw1 = $('#ch_pw1').val();
        var view_form = $('#view_form')[0];
        var formData = new FormData(view_form);
        var pwChkResult = pwChk(ch_pw, ch_pw1);
        if (!pwChkResult) {
            alert("비밀번호가 맞지 않습니다.");
            return;
        }
        // 백엔드로 전송
        $.ajax({
            type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
            url: 'profile_changeForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
            data: formData,
            dataType: 'JSON',
            success: function (data) {

                if (data.result == "success") {
                    alert("프로필 변경이 완료 되었습니다");
                    location.href="/member/mypage.php";
                    //마이 페이지로 이동
                }else{
                    alert(result.result);
                }

            },
            error: function (err) {
                // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
                console.log(err);
            },
            cache: false,
            contentType: false,
            processData: false

        })
    })

    $('#pwd_confirm').click(function (e) {

        var password = $('#password').val();

        // 데이터 포맷 정의
        var pro_changeData = {
            password: password,
        }

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'pro_changeForJson.php',
            data: pro_changeData,
            success: function (result) {
                console.log(result);
                var callResult = result.result;
                var callCode = result.code;
                var callData = result.data || {};
                var callErrorReason = result.errorReason || '';
                var re_password = result.data.password;

                if (password == re_password) {
                    alert("회원정보 수정이 가능합니다");
                    var $proHid = document.getElementById('pro_hid');
                    var $pro_change = document.getElementById('pro_change');
                    // var $pwd_hi = document.getElementById('pwd_hi');

                    $proHid.style.display = 'block';
                    $pro_change.style.display='none';

                } else {
                    alert("회원 비밀번호가 일치하지 않습니다.");
                }
            },
            error: function (request, status, error) {
                //console.log('code: ' + request.status + "\n" + 'message: ' + request.responseText + "\n" + 'error: ' + error);
            }
        });
    })


    function pwChk(pw1, pw2) {
        return pw1 === pw2;
    }
</script>

</body>

</html>