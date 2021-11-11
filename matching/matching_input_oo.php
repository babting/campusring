<!DOCTYPE html>
<?php
session_start();
// $id = $_GET['id'];

$big_cate="";
if (isset($_GET["big"])) {
    $big_cate= $_GET["big"];
}
?>

<!--성별, 선호장소, 기간, 시간대, 카테고리 대분류, 세분류를 다음으로 보내기 --->

<!---미선택시 자바 아럴트 띄우기 이벤트 추가하기--->
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 스타일시트 -->
    <link rel="stylesheet" href="../css/hj/matching_input.css">
    <link rel="stylesheet" href="../css/hj/base.css">
    <link rel="stylesheet" href="../css/hj/styles.css">

    <style type="text/css">

    </style>

    <!-- 자습 -->
    <!-- 아이콘 -->
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="https://kit.fontawesome.com/f45d796544.js" crossorigin="anonymous"></script>
    <!--jquery ajax-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> <!-- ajax를 사용하기 위해 jquery cdn으로 불러옴. -->
    <title>맞춤형 멘토 찾기</title>
</head>
<body >
<!--
    매칭 조건 입력 페이지
    페이지 담당:khj
    마지막 업데이트 : 210912
    css 미 완료
    -->
<header class="hd_box" style="background-color:rgb(250, 237, 255);">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
    <div class="login_text">CR</div>
    <div class=""></div>
</header>
<center  style="font-weight: 800; font-size:40px; padding-top: 80px;">맞춤 멘토 찾기</center>
<div class="sign_container">
    <div class="signup_sort">
        <!-- <form action="matching.html" style="padding:40px ;  font-size: 20px; "> -->
        <form method="post" action="matching.php" style="padding:40px ;  font-size: 20px; ">
            <label for="signid" style="font-weight: 900;">성별</label>
            <input type="radio" class="sex" id="signid1" NAME="sex" value="남">
            <label for="signid1" style="display: inline">남</label>
            <input type="radio" class="sex" id="signid2" NAME="sex" value="여">
            <label for="signid2" style="display: inline">여</label>
            <input type="radio" class="sex" id="signid3" NAME="sex" value="무관">
            <label for="signid3" style="display: inline">무관</label>


            <label for="signpwd" style="font-weight: 900;">선호장소</label>
            <select  id="best_place" name="ground">
                <option >선택</option>
                <option value="학교 휴게실">학교 휴게실</option>
                <option value="도서관">도서관</option>
                <option value="스터디룸">스터디룸</option>
                <option value="강당">강당</option>
                <option value="식당">식당</option>
                <option value="잔디광장">잔디 광장</option>
                <option value="무관">무관</option>
            </select>

            <label for="signid" style="font-weight: 900;">기간</label>
            <!--복수 선택가능 체크박스-->
            <input type="checkbox" class ="period" NAME="period[]" value="단기">단기
            <input type="checkbox" class ="period"  NAME="period[]" value="주단위">주단위
            <input type="checkbox" class ="period"  NAME="period[]" value="월단위">월단위

            <label for="signpwd" style="font-weight: 900;">시간대</label>
            <select  id="time" name="time">
                <option >선택</option>

                <option value="AM">오전</option>
                <option value="PM">오후</option>
                <option value="AAM">심야</option>
                <option value="무관">무관</option>
                <!--                <option value="09:00 ~ 10:00">09:00 ~ 10:00</option>-->
                <!--                <option value="10:00 ~ 11:00">10:00 ~ 11:00</option>-->
                <!--                <option value="11:00 ~ 12:00">11:00 ~ 12:00</option>-->
                <!--                <option value="12:00 ~ 13:00">12:00 ~ 13:00</option>-->
                <!--                <option value="13:00 ~ 14:00">13:00 ~ 14:00</option>-->
                <!--                <option value="14:00 ~ 15:00">14:00 ~ 15:00</option>-->
                <!--                <option value="15:00 ~ 16:00">15:00 ~ 16:00</option>-->
                <!--                <option value="16:00 ~ 17:00">16:00 ~ 17:00</option>-->
                <!--                <option value="17:00 ~ 18:00">17:00 ~ 18:00</option>-->
                <!--                <option value="18:00 ~ 19:00">18:00 ~ 19:00</option>-->
                <!--                <option value="19:00 ~ 20:00">19:00 ~ 20:00</option>-->
                <!--                <option value="20:00 ~ 21:00">20:00 ~ 21:00</option>-->
                <!--                <option value="21:00 ~ 22:00">21:00 ~ 22:00</option>-->
                <!--                <option value="22:00 ~ 23:00">22:00 ~ 23:00 </option>-->
            </select>

            <center>
                <table>
                    <div class="category">
                        <label for="signcate" style="font-weight: 900;">카테고리 대분류</label>
                        <select  id="big_cate"  name="big_cate" style="width: 100%;" onclick="return sebuclick(this)">
                            <option value="미선택">선택</option>
                            <option value="실무교육/컴퓨터">실무교육/컴퓨터</option>
                            <option value="학업">학업</option>
                            <option value="댄스">댄스</option>
                            <option value="스포츠/건강">스포츠/건강</option>
                            <option value="악기">악기</option>
                            <option value="국악">국악</option>
                            <option value="미술">미술</option>
                            <option value="음악이론/보컬">음악이론/보컬</option>
                            <option value="외국어">외국어</option>
                            <option value="사진/영상">사진/영상</option>
                            <option value="실무교육/디자인">실무교육/디자인</option>
                            <option value="실무교육/마케팅">실무교육/마케팅</option>
                            <option value="취업준비">취업준비</option>
                            <option value="시험/자격증">시험/자격증</option>
                            <option value="취미/생활">취미/생활</option>
                        </select>
                    </div>

                    <style>
                        #sebutable {margin-top:50px;}
                        #sebutable td {padding:8px; width: 50%; font-size: 20px;}
                        #sebutable td input{margin-right: 9px;}
                    </style>
                    <div class="campus" style="font-weight: 900;">
                        <label for="signcam">강의 세분류</label>

                    </div>

                    <table id="sebutable">
                        <!--
                                 <tr>
                                   <td>
                                     <input type="checkbox" class="small_cate" NAME=""value="프로그래밍/코딩">프로그래밍/코딩
                                   </td>
                                   <td>
                                     <input type="checkbox" class="small_cate"  NAME="" valu="주단위">정보 보안 레슨
                                   </td>
                                 </tr>r
                     -->
                    </table>

                    <script>

                        var big= <?php echo $big_cate ?>;
                        if (!big=="") { //대분류 아이콘에서 넘어오면 대분류 미리 지정

                            thisis = document.getElementsByName("big_cate");
                            console.log(thisis);
                            console.log(big);

                            for (var j = 1; j < 16; j++) {

                                console.log(thisis[0].options[j].value);
                                if (thisis[0].options[j].value == big) {

                                    thisis[0].options[j].selected = true;
                                }
                            }
                        }
                    </script>

    </div>

    <style>#matchbtn { cursor:pointer;}</style>
    <center style="padding-bottom: 200px;"><button id="matchbtn" style="width: 50%; "  type="submit" class="signup_btn">매칭</button></center>
    <!---페이지에서 보내는 데이터 =  .성별, .기간, #선호장소, #시간대,#큰카테, .세부카테 --->
    </form>


    <!-- 하단바 -->
    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>


    <!--하단바끝 -->
</div>

</div>

<script>

    //체크 박스용 AJAX
    function sebuclick(w){ // w는 big_cate 셀렉트 박스입니다
        if(w.selectedIndex !=0){
            var big_cate = w.options[w.selectedIndex].value; //big_cate는 셀렉트박스 아이디랑 네임 값campusring
            var cateData = {
                big_cate: big_cate,
            }
            $.ajax({
                type: 'POST', //
                url:'../category/bigcateForJson.php',
                /*
                $small_cate = ["Asia/Seoul", "America/New_York"] '
                echo json_encode($small_cate);
              위 페이지에서 이렇게 반환이 되어야 함
                 */
                data: cateData,
                dataType:'json',
                success:function(result){
                    var str = '';+-
                        console.log(result);
                    console.log(result.data);
                    for(var idx in result.data){
                        console.log(idx%2);
                        if(idx%2==0 || result.length== idx){ str +='<tr>';   } //짝수번이면,또는 데이터의 마지막 이면



                        str += '<td><input type="checkbox"  class="small_cate" name="small_cate[]"  value=\"'+result.data[idx].sebu+'\">'+result.data[idx].sebu+'</td>';
                        if(idx%2==1){ str +='</tr>';   }//홀수번이면
                        //if(idx%2==0 || result.length== idx){ str +='<tr>';   } //짝수번이면,또는 데이터의 마지막 이면
//중복선택 가능한 체크박스는 네임을 땡땡[] 로 지으며 받는쪽에서 땡떙으로 받은 후 땡땡[인덱스] 로 참조한다
                    }
                    console.log(str);
                    $('#sebutable').html(str); //아이디를 가진 태그 안에 str 출력
                }
            })
        }
    }
</script>
</body>
</html>
