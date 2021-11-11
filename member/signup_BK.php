<?php
/**
 * Created by PhpStorm.
 * User: BK
 * Date: 2021-09-17
 * Time: 오후 10:31
 */
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>회원가입</title>
</head>

<body>
<header class="hd_box">
    <div class="btn_prev"><a href="../login.php"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></a></div>
    <div class="login_text">회원가입</div>
    <div class=""></div>
</header>
<div class="sign_container">
    <div class="signup_sort">
        <form name="frmsign">
            <div class="campus">
                <label for="signid">아이디</label>
                <div class="campus_position">
                    <input type="text" placeholder="아이디" id="signid" name="m_id" class="m_id">
                    <input type="button" id="id_checkBtn" value="중복체크" onclick="idCheckAjax();">
                    <input type="hidden" name="id_check" id="id_check" value="0">
                </div>
            </div>
            <label for="signpwd">비밀번호</label>
            <input type="password" placeholder="비밀번호" id="signpwd" name="m_pw" class="m_pw">
            <label for="signapwd">비밀번호 재확인</label>
            <input type="password" placeholder="비밀번호 재확인" id="signapwd" name="m_rpw" class="m_rpw">
            <label for="signname">이름</label>
            <input type="text" placeholder="이름" id="signname" name="m_name" class="m_name">

            <div class="campus">
                <label for="signcam">소속 대학</label>
                <div class="campus_position">
                    <input type="text" placeholder="소속 대학" id="signcam" name="m_be" class="m_be"><input type="button" value="학교 찾기">
                </div>

            </div>
            <div class="date">
                <label for="signdate">생년월일</label>
                <input type="text" placeholder="년" id="birthYear" name="m_yy" class="m_yy">
                <select name="m_mm" class="m_mm" id="birthMonth">
                    <option value="1월">1월</option>
                    <option value="2월">2월</option>
                    <option value="3월">3월</option>
                    <option value="4월">4월</option>
                    <option value="5월">5월</option>
                    <option value="6월">6월</option>
                    <option value="7월">7월</option>
                    <option value="8월">8월</option>
                    <option value="9월">9월</option>
                    <option value="10월">10월</option>
                    <option value="11월">11월</option>
                    <option value="12월">12월</option>
                </select>
                <input type="text" placeholder="일" name="m_dd" class="m_dd" id="birthDay">
            </div>

            <div class="phone_num">
                <label for="signnum">전화번호</label>
                <select name="m_ph1" id="tel1" class="m_ph1">
                    <option value="010">010</option>
                    <option value="011">011</option>
                    <option value="012">012</option>
                    <option value="013">013</option>
                    <option value="014">014</option>
                    <option value="015">015</option>
                </select>
                - <input type="text" placeholder="전화번호" name="m_ph2" class="m_ph2" id = "tel2">
            </div>

            <div class="category">
                <label>카테고리 설정</label>
                <label for="first">1순위</label>
                <select name="m_cate1" id="first" class="m_cate1">
                    <option value="학업">학업</option>
                    <option value="댄스">댄스</option>
                    <option value="스포츠건강">스포츠건강</option>
                    <option value="악기">악기</option>
                    <option value="국악">국악</option>
                    <option value="미술">미술</option>
                    <option value="음악이론/보컬">음악이론/보컬</option>
                    <option value="외국어">외국어</option>
                    <option value="사진영상">사진영상</option>
                    <option value="실무교육/컴퓨터">실무교육/컴퓨터</option>
                    <option value="실무교육/디자인">실무교육/디자인</option>
                    <option value="실무교육/마케팅">실무교육/마케팅</option>
                    <option value="취업준비">취업준비</option>
                    <option value="시험/자격증">시험/자격증</option>
                    <option value="취미/생활">취미/생활</option>
                </select>
                <label for="second">2순위</label>
                <select name="m_cate2" id="second" class="m_cate2">
                    <option value="학업">학업</option>
                    <option value="댄스">댄스</option>
                    <option value="스포츠건강">스포츠건강</option>
                    <option value="악기">악기</option>
                    <option value="국악">국악</option>
                    <option value="미술">미술</option>
                    <option value="음악이론/보컬">음악이론/보컬</option>
                    <option value="외국어">외국어</option>
                    <option value="사진영상">사진영상</option>
                    <option value="실무교육/컴퓨터">실무교육/컴퓨터</option>
                    <option value="실무교육/디자인">실무교육/디자인</option>
                    <option value="실무교육/마케팅">실무교육/마케팅</option>
                    <option value="취업준비">취업준비</option>
                    <option value="시험/자격증">시험/자격증</option>
                    <option value="취미/생활">취미/생활</option>
                </select>
                <label for="three">3순위</label>
                <select name="m_cate3" id="third" class="m_cate3">
                    <option value="학업">학업</option>
                    <option value="댄스">댄스</option>
                    <option value="스포츠건강">스포츠건강</option>
                    <option value="악기">악기</option>
                    <option value="국악">국악</option>
                    <option value="미술">미술</option>
                    <option value="음악이론/보컬">음악이론/보컬</option>
                    <option value="외국어">외국어</option>
                    <option value="사진영상">사진영상</option>
                    <option value="실무교육/컴퓨터">실무교육/컴퓨터</option>
                    <option value="실무교육/디자인">실무교육/디자인</option>
                    <option value="실무교육/마케팅">실무교육/마케팅</option>
                    <option value="취업준비">취업준비</option>
                    <option value="시험/자격증">시험/자격증</option>
                    <option value="취미/생활">취미/생활</option>
                </select>
            </div>
            <button type="button" class="signup_btn" onclick="onSubmitAjax();">회원가입</button>
        </form>
    </div>
</div>
<footer></footer>
<script>
    function onSubmitAjax() {
        //폼 자체에 maxlength 필요, 아이디정규식 스크립트로 1차 체크해야함
        //학교찾기 버튼의 의미를 모르겠음
        let m_id = $('#signid');                        //아이디
        let m_pw = $('#signpwd');                       //패스워드
        let m_rpw = $('#signapwd');                     //패스워드 확인
        let m_name = $('#signname');                    // 이름
        let m_be = $('#signcam');                       // 소속학교
        let m_yy = $('#birthYear');                     // 생년
        let m_mm = $('#birthMonth option:selected');    //생월
        let m_dd = $('#birthDay');                      //생일
        let m_ph1 = $('#tel1 option:selected');         //전화번호 1
        let m_ph2 = $('#tel2');                         //전화번호 2
        let m_cate1 = $('#first');                      //카테고리 순위 1
        let m_cate2 = $('#second');                     //카테고리 순위 2
        let m_cate3 = $('#third');                      //카테고리 순위 3

        let id_check = $('#id_check');                  //중복확인


        if (m_id.val() == ""){
            alert("아이디를 입력해주세요.");
            m_id.focus();
            return false;
        } else if (id_check.val() != "1"){
            alert("아이디 중복체크를 해주세요.");
            $('#id_checkBtn').focus();
            return false;
        }else if (m_pw.val() == ""){
            alert("비밀번호를 입력해주세요.");
            m_pw.focus();
            return false;
        } else if (m_rpw.val() == ""){
            alert("비밀번호 재확인을 입력해주세요.");
            m_rpw.focus();
            return false;
        }else if (m_pw.val() != m_rpw.val()){
            alert("비밀번호와 비밀번호 재확인의 값은 같아야합니다.");
            m_pw.focus();
            return false;
        }else if (m_name.val() == ""){
            alert("이름을 입력해주세요.");
            m_name.focus();
            return false;
        }else if (m_be.val() == ""){
            alert("소속대학을 입력해주세요.");
            m_be.focus();
            return false;
        }else if (m_yy.val() == "" || m_mm.val() == "" || m_dd.val() =="" ){
            alert("생년월일을 입력해주세요.");
            m_yy.focus();
            return false;
        }else if (m_ph2.val() == ""){
            alert("전화번호를 입력해주세요.");
            m_pw.focus();
            return false;
        }else{
            //var signData = $('frmsign').serialize();
            var signData = {
                m_id: m_id.val(),
                m_pw: m_pw.val(),
                m_rpw: m_rpw.val(),
                m_name: m_name.val(),
                m_be: m_be.val(),
                m_yy: m_yy.val(),
                m_mm: m_mm.val(),
                m_dd: m_dd.val(),
                m_ph1: m_ph1.val(),
                m_ph2: m_ph2.val(),
                m_cate1: m_cate1.val(),
                m_cate2: m_cate2.val(),
                m_cate3: m_cate3.val(),
            }

            $.ajax({
                type: 'post',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
                dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
                url: './signupOk_BK.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
                data: signData,          // url로 전송할 데이터 정의
                success: function(data) {
                    // if (data.result == "success"){
                    //     alert("회원가입이 완료되었습니다. \n 로그인 후 캠퍼스링 서비스를 이용해주세요.");
                    //     location.href='../login.php';
                    // }else {
                    //
                    //     alert("문제가 발생했습니다. \n Error CODE: " + data.result );
                    // }
                    console.log(data);
                    if (data.result) {
                        alert("회원가입이 완료되었습니다. \n 로그인 후 캠퍼스링 서비스를 이용해주세요.");
                        location.href='../login.php';
                    }

                    if (!data.result) {
                        alert("문제가 발생했습니다. \n Error CODE: " + data.message );
                    }
                },
                error: function (request, status, error) {
                    console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
                }
            });
        }
    }

    function idCheckAjax() {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: './id_check.php',
            data: { id: $('#signid').val() },
            success: function (data) {
                console.log(data);
                if (data.result == "0"){
                    //중복되는 아이디가 0개
                    alert("사용가능한 아이디입니다.");
                    $('#id_check').val('1');
                } else{
                    alert("중복된 아이디입니다.");
                }
            },
            error: function (request, status, error) {
                console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
            }
        });
    }
</script>
</body>

</html>


