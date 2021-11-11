<!DOCTYPE html>
<?php
session_start();

$big_cate="";
if (@$_GET["big"] != "") {
    $getBig= $_GET["big"];
    $big_cate = str_replace ("'", "", $getBig);
}
?>

<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <style type="text/css">

        input[type="checkbox"] {
            size: 5em;
            -ms-transform: scale(1.5); /* IE */
            -moz-transform: scale(1.5); /* FF */
            -webkit-transform: scale(1.5); /* Safari and Chrome */
            -o-transform: scale(1.5); /* Opera */
        }

        input[type="radio"] {
            -ms-transform: scale(1.5); /* IE */
            -moz-transform: scale(1.5); /* FF */
            -webkit-transform: scale(1.5); /* Safari and Chrome */
            -o-transform: scale(1.5); /* Opera */
        }

        label {
            /*padding-bottom: 60px;*/
        }

        body {
            /*font-size: 35px;*/
        }

        matchbtn:hover {

        }
    </style>
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="https://kit.fontawesome.com/f45d796544.js" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>맞춤형 멘토 찾기</title>
</head>
<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
    <div class="login_text">맞춤 멘토 찾기</div>
    <div class=""></div>
</header>

<div class="sign_container">
    <div class="">
        <!-- <form action="matching.html" style="padding:40px ;  font-size: 20px; "> -->
        <form method="post" name="matching_form" action="matching.php">
            <div class="ma_in_sort">
                <label for="" class="match_info_title label_blk">선호성별</label>
                <div class="gender_sort">
                    <div class="group_box">
                        <input type="radio" class="sex" id="signid1" NAME="sex" value="남">
                        <label for="signid1">남</label>
                    </div>
                    <div class="group_box">
                        <input type="radio" class="sex" id="signid2" NAME="sex" value="여">
                        <label for="signid2">여</label>
                    </div>
                    <div class="group_box">
                        <input type="radio" class="sex" id="signid3" NAME="sex" value="무관">
                        <label for="signid3">무관</label>
                    </div>

                </div>
            </div>

            <div class="pre_place">
                <label for="signpwd" class="match_info_title label_blk">선호장소</label>
                <select id="best_place" name="ground">
                    <option>선택</option>
                    <option value="학교 휴게실">학교 휴게실</option>
                    <option value="도서관">도서관</option>
                    <option value="스터디룸">스터디룸</option>
                    <option value="강당">강당</option>
                    <option value="식당">식당</option>
                    <option value="잔디광장">잔디 광장</option>
                    <option value="무관">무관</option>
                </select>
            </div>

            <div class="ma_in_sort el_chbox">
                <label for="signid" class="match_info_title label_blk">강의 기간</label>
                <div class="gender_sort">
                    <div class="group_box">
                        <input type="checkbox" id="short-term" class="period" NAME="period[]" value="단기">
                        <label for="short-term">단기</label>
                    </div>
                    <div class="group_box">
                        <input type="checkbox" id="weekly" class="period" NAME="period[]" value="주단위">
                        <label for="weekly">주단위</label>
                    </div>
                    <div class="group_box">
                        <input type="checkbox" id="monthly" class="period" NAME="period[]" value="월단위">
                        <label for="monthly">월단위</label>
                    </div>
                </div>
            </div>

            <div class="pre_place">
                <label for="signpwd" class="match_info_title label_blk">시간대</label>
                <select id="time" name="time">
                    <option>선택</option>
                    <option value="AM">오전</option>
                    <option value="PM">오후</option>
                    <option value="AAM">심야</option>
                    <option value="무관">무관</option>
                </select>
            </div>

            <div class="pre_place">
                <label for="signcate" class="match_info_title label_blk">카테고리 대분류</label>
                <select id="big_cate" name="big_cate" onchange="return sebuclick(this)">
                    <option value="선택">선택</option>
                    <option value="실무교육/컴퓨터" <?php if ($big_cate =="실무교육/컴퓨터") echo "selected";?>>실무교육/컴퓨터</option>
                    <option value="학업" <?php if ($big_cate =="학업") echo "selected";?>>학업</option>
                    <option value="댄스" <?php if ($big_cate =="댄스") echo "selected";?>>댄스</option>
                    <option value="스포츠/건강" <?php if ($big_cate =="스포츠/건강") echo "selected";?>>스포츠/건강</option>
                    <option value="악기" <?php if ($big_cate =="악기") echo "selected";?>>악기</option>
                    <option value="국악" <?php if ($big_cate =="국악") echo "selected";?>>국악</option>
                    <option value="미술" <?php if ($big_cate =="미술") echo "selected";?>>미술</option>
                    <option value="음악이론/보컬" <?php if ($big_cate =="음악이론/보컬") echo "selected";?>>음악이론/보컬</option>
                    <option value="외국어" <?php if ($big_cate =="외국어") echo "selected";?>>외국어</option>
                    <option value="사진/영상" <?php if ($big_cate =="사진/영상") echo "selected";?>>사진/영상</option>
                    <option value="실무교육/디자인" <?php if ($big_cate =="실무교육/디자인") echo "selected";?>>실무교육/디자인</option>
                    <option value="실무교육/마케팅" <?php if ($big_cate =="실무교육/마케팅") echo "selected";?>>실무교육/마케팅</option>
                    <option value="취업준비" <?php if ($big_cate =="취업준비") echo "selected";?>>취업준비</option>
                    <option value="시험/자격증" <?php if ($big_cate =="시험/자격증") echo "selected";?>>시험/자격증</option>
                    <option value="취미/생활" <?php if ($big_cate =="취미/생활") echo "selected";?>>취미/생활</option>
                </select>
            </div>

            <div class="pre_place el_chbox">
                <label for="signcate" class="match_info_title label_blk">카테고리 세분류</label>
                <div class="subu_carte_sort" id="sebutable">
                </div>
            </div>
            <!--            <div class="pre_place">-->
            <!--                <label for="signcam" class="match_info_title label_blk">강의 세분류</label>-->
            <!--            </div>-->
            <!--            <table id="sebutable"></table>-->

    </div>
    <div class="mtb-3"></div>
    <div class="container fix-test" style="cursor:pointer" id="qna_send" onclick="return onSubmitform()">

        <span id="matchbtn" style="font-size: 1.7rem; cursor:pointer;" class="signup_btn" ">매칭</span>
    </div>
    <!--    <button id="matchbtn" style="width: 50%; " type="submit" class="signup_btn">매칭</button>-->
    <!---페이지에서 보내는 데이터 =  .성별, .기간, #선호장소, #시간대,#큰카테, .세부카테 --->
    </form>
    <!-- 하단바 -->
    <?php //include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
    <!--하단바끝 -->
</div>
<?php if($big_cate != "") { ?>
    <script>

        var big ="<?php echo $big_cate; ?>";
        aa(big);

        function aa(data){
            var big_cate = $('#big_cate :selected').val();
            //big_cate는 셀렉트박스 아이디랑 네임 값
            var cateData = {
                big_cate: big_cate,
            }
            $.ajax({
                type: 'POST', //
                url: '../category/bigcateForJson.php',
                data: cateData,
                dataType: 'json',
                success: function (result) {
                    var str = '';
                    console.log(result);
                    console.log(result.data);
                    for (var idx in result.data) {
                        // alert(result.data[idx]);
                        str += '<div class="subu_carte_pd">' +
                            '<input type="checkbox" id="short-term-sel ' + result.data[idx].idx + '" class="period" NAME="small_cate[]" value="' + result.data[idx].sebu + '">' +
                            '<label for="short-term-sel ' + result.data[idx].idx + '">' + result.data[idx].sebu + '</label>' +
                            '</div>';
                    }
                    $('#sebutable').html(str); //아이디를 가진 태그 안에 str 출력
                }
            })
        }


    </script>
<?php  }  ?>

<script>
    //체크 박스용 AJAX
    function sebuclick(w) { // w는 big_cate 셀렉트 박스입니다
        if (w.selectedIndex != 0) {
            var big_cate = w.options[w.selectedIndex].value; //big_cate는 셀렉트박스 아이디랑 네임 값
            var cateData = {
                big_cate: big_cate,
            }
            $.ajax({
                type: 'POST', //
                url: '../category/bigcateForJson.php',
                /*
                $small_cate = ["Asia/Seoul", "America/New_York"] '
                echo json_encode($small_cate);
              위 페이지에서 이렇게 반환이 되어야 함
                 */
                data: cateData,
                dataType: 'json',
                success: function (result) {
                    var str = '';
                    console.log(result);
                    console.log(result.data);
                    for (var idx in result.data) {
                        // alert(result.data[idx]);
                        str += '<div class="subu_carte_pd">' +
                            '<input type="checkbox" id="short-term-sel ' + result.data[idx].idx + '" class="period" NAME="small_cate[]" value="' + result.data[idx].sebu + '">' +
                            '<label for="short-term-sel ' + result.data[idx].idx + '">' + result.data[idx].sebu + '</label>' +
                            '</div>';
                    }
                    console.log(str);
                    $('#sebutable').html(str); //아이디를 가진 태그 안에 str 출력
                }
            })
        }
    }

    function onSubmitform() {
        //폼 자체에 maxlength 필요, 아이디정규식 스크립트로 1차 체크해야함


        var chk_radio = document.getElementsByName('sex');   //라디오
        let m_place = $('#best_place');                       //셀박
        var arr_Season = document.getElementsByName("period[]");  //체크박스

        let m_time = $('#time');                    // 셀박
        let m_cate = $('#big_cate');                       //셀박
        let m_sebu = $('#small_cate');                     // 체크박스


        console.log( m_time.val());
        console.log( m_cate.val());
        console.log( m_sebu.val());

        //라디오 버튼 검사

        var sel_type = null;

        for(var i=0;i<chk_radio.length;i++){

            if(chk_radio[i].checked == true){
                sel_type = chk_radio[i].value;
            }
        }

        if(sel_type == null){
            alert("선호 성별을 선택하세요.");
            return false;

        }
        //


        if (m_place.val() == "선택") {
            alert("선호 장소를 입력해주세요.");
            //    m_sex.focus();
            return false;
        }


        //체크박스 체크여부 확인 [동일 이름을 가진 체크박스 여러개일 경우]
        var isSeasonChk = false;

        for(var i=0;i<arr_Season.length;i++){
            if(arr_Season[i].checked == true) {
                isSeasonChk = true;
                break;
            }
        }

        if(!isSeasonChk){
            alert("강의 기간을 선택해주세요.");
            return false;
        }


        //


        if (m_time.val() == "선택") {
            alert("시간대를 입력해주세요.");
            //  m_time.focus();
            return false;
        } else if (m_cate.val() == "선택") {
            alert("대분류를 선택해주세요");
            // $('#best_place').focus();
            return false;
        }else{

            //체크박스 체크여부 확인 [동일 이름을 가진 체크박스 여러개일 경우]
            var issebuChk = false;
            var arr_sebu = document.getElementsByName("small_cate[]");  //체크박스


            for(var i=0;i<arr_sebu.length;i++){
                if(arr_sebu[i].checked == true) {
                    issebuChk = true;
                    break;
                }
            }

            if(!issebuChk){
                alert("세분류를 하나 이상 선택해주세요.");
                return false;
            } else {
                matching_form.submit();
            }


        }




    }
</script>
</body>
</html>