<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';


$bid="";
$time="";
$place="";
$id="";
$sebu=""; //세부
$periodarray=[];  // 기간
$dayarray=[]; //요일


//var_dump( $dayarray);

//요일은 데이터 어떻게 넣는지
//기간 세분류 요일

if(@$_GET['id'] != ""){ //수정하로 온 멘토 아이디
    $id = $_GET['id'];
    $sql = "select * from class where id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $big=$row['big_cate'];
    $time=$row['time'];
    $place=$row['place'];

    $sebu=$row['small_cate']; //세부
    $periodarray=  explode(",",str_replace(" ", "", $row['period']));// 기간
    $dayarray = explode(",",str_replace(" ", "", $row['day_week'])); ; //요일



// echo $sebu;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="author" content="carpeDM"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="0"/>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>


    <!-- 아이콘 -->
    <!--  <script src="https://kit.fontawesome.com/a9eb1f10be.js" crossorigin="anonymous"></script>  -->
    <script src="https://kit.fontawesome.com/f45d796544.js" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>멘토 매칭</title>
</head>


<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
    <div class="login_text">강의 <?php if($id != "") echo "수정"; else echo "등록";?></div>
</header>
<!-- 콘테이너   -->
<div class="container">
    <form id="view_form" enctype="multipart/form-data" method="post">
        <input type="hidden" name="edit_write_check" value="<?php if ($id != "") echo "1"; else echo "0";?>">
        <!--    onsubmit="return onSubmitCert(event);-->
        <div class="lesup_sort">
            <div class="leup_ele_content">

                <label for="class_title">강의제목</label>



                <input id="class_title" type="text" placeholder="강의제목을 입력해주세요." name="title" value="<?php if(isset($_GET['id'])){ echo $row['title']; }; ?>"/>



            </div>
            <div class="leup_ele_content">
                <label for="leup_big_cate">카테고리 대분류</label>
                <select id="leup_big_cate" name="leup_big_cate" onchange="return sebuclick(this)">
                    <option value="선택">선택</option>
                    <option value="실무교육/컴퓨터" <?php if ($id != "" && $big =="실무교육/컴퓨터") echo "selected";?>>실무교육/컴퓨터</option>
                    <option value="학업" <?php if ($id != "" && $big =="학업") echo "selected";?>>학업</option>
                    <option value="댄스" <?php if ($id != "" && $big =="댄스") echo "selected";?>>댄스</option>
                    <option value="스포츠/건강" <?php if ($id != "" && $big =="스포츠/건강") echo "selected";?>>스포츠/건강</option>
                    <option value="악기" <?php if ($id != "" && $big =="악기") echo "selected";?>>악기</option>
                    <option value="국악" <?php if ($id != "" && $big =="국악") echo "selected";?>>국악</option>
                    <option value="미술" <?php if ($id != "" && $big =="미술") echo "selected";?>>미술</option>
                    <option value="음악이론/보컬" <?php if ($id != "" && $big =="음악이론/보컬") echo "selected";?>>음악이론/보컬</option>
                    <option value="외국어" <?php if ($id != "" && $big =="외국어") echo "selected";?>>외국어</option>
                    <option value="사진/영상" <?php if ($id != "" && $big =="사진/영상") echo "selected";?>>사진/영상</option>
                    <option value="실무교육/디자인" <?php if ($id != "" && $big =="실무교육/디자인") echo "selected";?>>실무교육/디자인</option>
                    <option value="실무교육/마케팅" <?php if ($id != "" && $big =="실무교육/마케팅") echo "selected";?>>실무교육/마케팅</option>
                    <option value="취업준비" <?php if ($id != "" && $big =="취업준비") echo "selected";?>>취업준비</option>
                    <option value="시험/자격증" <?php if ($id != "" && $big =="시험/자격증") echo "selected";?>>시험/자격증</option>
                    <option value="취미/생활" <?php if ($id != "" && $big =="취미/생활") echo "selected";?>>취미/생활</option>
                </select>
            </div>




            <div class="leup_ele_content">
                <label>강의 세분류</label>
                <table id="cate_table" name="sebu">
                </table>
            </div>
            <script>
                function sebuclick(w){
                    if(w.selectedIndex !=0){
                        var big_cate = w.options[w.selectedIndex].value; //big_cate는 셀렉트박스 아이디랑 네임 값
                        var cateData = {
                            big_cate: big_cate,
                        }

                        $.ajax({
                            type: 'POST', //
                            url:'../category/bigcateForJson.php',
                            data: cateData,
                            dataType:'json',
                            success:function(result){
                                var str = '';+-
                                    console.log(result);
                                console.log(result.data);
                                for(var idx in result.data){
                                    console.log(idx%2);
                                    if(idx%2==0 || result.length== idx){ str +='<tr>';   } //짝수번이면,또는 데이터의 마지막 이면
                                    str += '<td><input type="radio"  class="leup_sebu" name="sebu[]"  value=\"'+result.data[idx].sebu+'\">'+result.data[idx].sebu+'</td>';
                                    if(idx%2==1){ str +='</tr>';   }
                                }
                                console.log(str);
                                $('#cate_table').html(str);
                            }
                        })
                    }
                }
            </script>

            <div class="leup_ele_content">
                <label for="leup_place">선호장소</label>
                <select id="leup_place" name="leup_place">
                    <option value="학교 휴게실">학교 휴게실</option>
                    <option value="도서관">도서관</option>
                    <option value="스터디룸">스터디룸</option>
                    <option value="강당">강당</option>
                    <option value="식당">식당</option>
                    <option value="1호관">1호관</option>
                    <option value="2호관">3호관</option>
                    <option value="3호관">3호관</option>
                    <option value="잔디광장">잔디 광장</option>
                </select>
            </div>
            <div class="leup_ele_content">
                <label>기간</label>
                <input type="checkbox" name="period[]" value="단기" <?php if (in_array("단기", $periodarray)) echo "checked";?>>단기
                <input type="checkbox" name="period[]" value="주단위" <?php if (in_array("주단위", $periodarray)) echo "checked";?>>주단위
                <input type="checkbox" name="period[]" value="월단위"위 <?php if (in_array("월단위", $periodarray)) echo "checked";?>>월단위
                <input type="checkbox" name="period[]" value="협의"위 <?php if (in_array("협의", $periodarray)) echo "checked";?>>협의
            </div>

            <!--시간대-->
            <div class="leup_ele_content">
                <label for="les_time">시간대</label>
                <select name="les_time" id="les_time" class="select-normal">
                    <option value="협의 가능">협의 가능</option>
                    <option value="오전">오전</option>
                    <option value="오후">오후</option>
                    <option value="심야">심야</option>
                </select>
            </div>

            <div class="leup_ele_content">
                <label>요일</label>
                <table id="cate_table2">
                    <tr>
                        <td>
                            <input type="checkbox" id="" name="week[]" value="월">월
                        </td>
                        <td>
                            <input type="checkbox" id="" name="week[]" value="화">화
                        </td>
                        <td>
                            <input type="checkbox" id="" name="week[]" value="수">수
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="" name="week[]" value="목">목
                        </td>
                        <td>
                            <input type="checkbox" id="" name="week[]" value="금">금
                        </td>
                        <td>
                            <input type="checkbox" id="" name="week[]" value="토">토
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="" name="week[]" value="일">일
                        </td>
                        <!--                        <td colspan="2">-->
                        <!--                            <input type="checkbox" id="" name="week[]" value="상관 없음">상관 없음-->
                        <!--                        </td>-->
                    </tr>
                </table>
            </div>

            <?php if( isset($_GET['id'])) { ?>
                <script>
                    //빅 , 타임 , 플레이스
                    var big ="<?php echo $big; ?>";
                    var time ="<?php echo $time; ?>";
                    var place ="<?php echo $place; ?>";

                    console.log(place);
                    console.log(time);
                    console.log(big);
                    if (!big == "") { //대분류 미리 지정
                        a("leup_big_cate",big);
                        a("les_time",time);
                        a("leup_place",place);
                        // console.log(thisis);

                    }
                    function a(tag, data){
                        var big_cate = $('#leup_big_cate :selected').val();
                        //big_cate는 셀렉트박스 아이디랑 네임 값
                        var cateData = {
                            big_cate: big_cate,
                        }
                        $.ajax({
                            type: 'POST', //
                            url:'../category/bigcateForJson.php',
                            data: cateData,
                            dataType:'json',
                            success:function(result){
                                var str = '';+-
                                    console.log(result);
                                console.log(result.data);
                                for(var idx in result.data){
                                    console.log(idx%2);
                                    if(idx%2==0 || result.length== idx){ str +='<tr>';   } //짝수번이면,또는 데이터의 마지막 이면
                                    if ("<?=$sebu?>" == String(result.data[idx].sebu)){
                                        str += '<td><input type="radio"  class="leup_sebu" name="sebu[]"  value=\"'+result.data[idx].sebu+'\" checked>'+result.data[idx].sebu+'</td>';
                                    }else{
                                        str += '<td><input type="radio"  class="leup_sebu" name="sebu[]"  value=\"'+result.data[idx].sebu+'\">'+result.data[idx].sebu+'</td>';
                                    }
                                    if(idx%2==1){ str +='</tr>';   }
                                }
                                console.log(str);
                                $('#cate_table').html(str);
                            }
                        })
                    }
                </script>
            <?php  }  ?>

            <div class="leup_img_content">
                <p>강의 섬네일 업로드</p>
                <div class="lesup_img_area">
                    <div>

                        <img id="lessonup_gall" alt="섬네일" src="<?php if(isset($_GET['id'])){ echo $row['thumbnail']; } else echo "../img/photos.png"; ?>"/>
                    </div>
                    <div class="les_simg_labtn">
                        <label class="input-file-button" for="input-file">업로드</label>
                        <input type="file" id="input-file" name="input_file" style="display: none;">
                    </div>
                </div>
            </div>

            <div class="leup_ele_content">
                <label for="leup_context">수업내용</label>
                <textarea id="leup_context" cols="40" rows="10" name="leup_context">
                    <?php if(isset($_GET['id'])){ echo $row['context']; } ?>
                </textarea>
            </div>

            <div class="leup_ele_content">
                <label>키워드</label>
                <input type="text" id="payment_info" name="payment_info" value="<?php if(isset($_GET['id'])){ echo $row['keyword']; }?>"/>
            </div>

            <div class="leup_ele_content">
                <p>샘플 강의 소개영상 업로드</p>
                <!--                <div class="video_content">영상크기는 500mb로 제한되며 파일형식은 mp4 가능합니다</div>-->
                <div class="les_video_title">
                    <video controls loop>
                        <source src="<?php if(isset($_GET['id'])){ echo $row['video']; } ?>" id="leup_video" type="video/mp4">
                    </video>

                    <div class="les_simg_labtn">
                        <label class="input-file-button" for="input-video">업로드</label>

                        <input type="file" id="input-video" name="input_video" style="display: none;">
                    </div>
                </div>
            </div>
        </div>
        <div class="mtb-3"></div>

        <div class="container fix-test" id="qna_send" onclick="bamki();">
            <span>강의 <?php if($id != "") echo "수정"; else echo "등록";?></span>
        </div>

        <!--        <div class="container fix-test" id="qna_send">-->
        <!--            <button type="button" onclick="bamki();">강의 등록</button>-->
        <!--        </div>-->
    </form>
</div>
<!-- 콘테이너끝 -->

<!-- html 처리 필요
강의 세분류 는 한가지만 선택 가능하도록 바꾸기
-->
<!--백엔드 처리 필요
                , 지우기 버튼 시 사진, 영상 없애기
               , 자격증 인증 페이지는 폼 전부 완성 시에만 넘어가기

-->
<!-- (받기) class테이블   id(강의 번호)
     (가져오기)
         class테이블 thumbnail ,title, small_cate,user_id(멘토), id(강의 번호), context,keyword
         member 테이블 user_id(멘토) , name

     (보내기) class테이블  강의 제목title , 대분류 big_cate, 소분류small_cate , 기간 period[], 유저 아이디 id
     시간대 time,선호 장소place, 요일 여럿 선택day_week[] , 이미지 파일thumbnail, 비디오 파일video,콘텍스트context , keyword강의 키워드는,...?

            키워드 컬럼에 저장해야 할것은  - "세부카테고리" +" "유저전공"
-  -->

<script>
    function bamki() {
        var BKdata = new FormData($('#view_form')[0]);

        $.ajax({
            type: 'post',
            url: '/mentoring/lessonupForJson.php',
            data: BKdata,
            dataType: 'JSON',
            success: function(result) {
                // console.log(result);
                if(result){
                    alert("강의 등록이 완료되었습니다.");
                    location.href='../index.php';
                }
            },
            error: function(err) {
                console.log(err);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }



</script>


</body>
</html>
