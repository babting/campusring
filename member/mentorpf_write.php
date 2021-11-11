<!DOCTYPE html>
<?php
//phpinfo();
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM member WHERE user_id = '$user_id' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$user_name = $row['name'];


?>
<html lang="ko">

<head>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://kit.fontawesome.com/a9eb1f10be.js" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="0"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>멘토 프로필</title>
</head>

<body>
<header class="hd_box">
    <div class="btn_prev" onclick="history.go(-1);"><i class="fas fa-angle-left fa-3x"></i></div>
    <div class="login_text">멘토 프로필 편집</div>
</header>

<div class="container">
    <form id="view_form" enctype="multipart/form-data" method="post">

        <div class="mepf_sort">
            <label for="user_name">이름</label>
            <input type="text" id="user_name" value="<?= $row['name'] ?>" name="user_name">
        </div>

        <div class="mepf_sort">
            <label for="majors">전공</label>
            <input type="text" id="majors" value="<?= $row['major'] ?>" name="major">
        </div>

        <div class="mepf_sort">
            <label for="user_add">주소</label>
            <input type="text" id="user_add" value="<?= $row['residence'] ?>" name="residence">
        </div>
        <div class="mepf_sort">
            <label for="user_age">나이</label>
            <input type="text" id="user_age" value="<?= $row['age'] ?>" name="age">
        </div>
        <div class="mepf_sort">
            <label for="bk_time">공강시간</label>
            <input type="text" id="bk_time" value="<?= $row['break_time'] ?>" name="break_time">
        </div>
        <div class="mepf_sort">
            <label for="user_ce">경력</label>
            <input type="text" id="user_ce" value="<?= $row['career'] ?>" name="career">
        </div>
        <!--    <div class="pro_addr">학생증</div>-->
        <!--    <div class="pro_addr_val"><input type="file" multiple="std_card" value="-->
        <? //=$row['email']?><!--"></div>-->
        <div class="mepf_sort">
            <p>학생증</p>
            <?php
            $students_sql = "SELECT * FROM certification WHERE user_id = '$user_id' AND type ='학생증'";
            $students_sql.=" ORDER BY id DESC limit 0,1";
            $student_result = mysqli_query($conn, $students_sql);
            $students_row = mysqli_fetch_array($student_result);
            ?>

            <?php
            if (!empty($students_row)) {
                ?>
                <div class="mentor_img_sort">
                    <img id="lessonup_gall" src="<?= $students_row['img'] ?>"/>
                    <!--                    <input type="file" id="leup_thumb" accept="image/*" value="파일 찾기" name="certification">-->
                    <div class="les_simg_labtn">
                        <label class="input-file-button" for="input-file">업로드</label>
                        <input type="file" id="input-file" name="certification" style="display: none;">
                    </div>
                </div>
                <?php
            } else {
                ?>
                <!--                <div class="mentor_img_sort">-->
                <!--                    <input type="file" id="leup_thumb" accept="image/*" value="파일 찾기" name="certification">-->
                <!--                </div>-->
                <div class="les_simg_labtn">
                    <label class="input-file-button" for="input-file">업로드</label>
                    <input type="file" id="input-file" name="certification" style="display: none;">
                </div>
                <?php
            }
            ?>
        </div>
        <div class="mepf_sort_cer">
            <p id="mWrite_cer" >자격증</p>
            <div class="mentor_img_sort" style="position: relative; height:300px;">
                <?php
                $cr_sql = "SELECT * FROM certification WHERE user_id = '$user_id' AND type ='자격증'";
                $cr_result = mysqli_query($conn, $cr_sql);

                $list_cnt = mysqli_num_rows($cr_result);

                if($list_cnt > 0){
                $i = 1;
                while ($cr_row = mysqli_fetch_array($cr_result)) { //while 끝
                    ?>
                    <div class="mentor_img_sort me_cer_img <?php if ($i == $list_cnt) echo 'current' ?>" id="img_<?php echo $i ?>" >
                        <img id="lessonup_gall" src="<?php echo $cr_row['img'] ?>"/>
                    </div>
                    <?php
                    $i++;
                } ?>
                <div class="prev_btn" onclick="imgPrev()"><i class="fas fa-angle-left"></i></div>
                <div class="next_btn" onclick="imgNext()"><i class="fas fa-angle-right"></i></div>
            </div>
            <!--            <div style="text-align: center;">-->
            <!--                <input type="file" id="leup_thumb" accept="image/*" value="파일 찾기" name="certification_cr[]" multiple>-->
            <!--            </div>-->
            <div class="les_simg_labtn">
                <label class="input-file-button ft_bd mtb_1_r" for="input-file">업로드</label>
                <input type="file" id="input-file" name="certification_cr" style="display: none;">
            </div>
            <?php
            } else {
                ?>
                <!--            <div style="text-align: center;">-->
                <!--                <input type="file" id="leup_thumb" accept="image/*" value="파일 찾기" name="certification_cr[]" multiple>-->
                <!--            </div>-->
                <div class="les_simg_labtn">
                    <label class="input-file-button ft_bd mtb_1_r" for="input-file">업로드</label>

                    <input type="file" id="input-file" name="certification_cr" style="display: none;">
                </div>
                <?php
            }
            ?>
        </div>
        <input type="hidden" id="list_length" value="<?php echo $list_cnt ?>" />
        <!--            <input id="q_card" multiple type="file">-->
        <div>
            <!--            <div class="pro_addr">자격증</div>-->

            <!--            --><?php
            //            $cr_sql = "SELECT * FROM certification WHERE user_id = '$user_id' AND type ='자격증'";
            //            $cr_result = mysqli_query($conn, $cr_sql);
            //
            //            if(mysqli_num_rows($cr_result) > 0){
            //                while ($cr_row = mysqli_fetch_array($cr_result)) { //while 끝
            //                ?>
            <!--                    <div>-->
            <!--                        <img id="lessonup_gall" width="250px" height="150px"-->
            <!--                      style="margin:20px 10px 20px 30px; border-width: 6px;border-color: dimgray;object-fit: cover;"-->
            <!--                      src="--><?php //echo $cr_row['img'] ?><!--"/>-->
            <!--                    </div>-->
            <!--                    --><?php
            //                } ?>
            <!---->
            <!--                <div style="position:relative; display: inline-block;  clear: both; vertical-align: center;">-->
            <!--                    <input type="file" style="display: block; margin-bottom: 20px;" id="leup_thumb" accept="image/*"-->
            <!--                           value="파일 찾기" name="certification_cr" multiple>-->
            <!--                </div>-->
            <!--                --><?php
            //            } else {
            //                ?>
            <!--                <div style="position:relative; display: inline-block;  clear: both; vertical-align: center;">-->
            <!--                    <input type="file" style="display: block; margin-bottom: 20px;" id="leup_thumb" accept="image/*"-->
            <!--                           value="파일 찾기" name="certification_cr" multiple>-->
            <!--                </div>-->
            <!--                --><?php
            //            }
            //            ?>
        </div>

        <div class="me_write_btn">

            <button type="button" onclick="mentorpf()">수정하기</button>




        </div>



        <!--    <form onsubmit="return onTest(event);">-->
        <!---->
        <!--        <input type="text" placeholder="테스트" required />-->
        <!--        <button type="submit">서브밋</button>-->
        <!--    </form>-->
    </form>

    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
</div>

<script>
    function mentorpf() {
        //e.preventDefault(); // submit은 기본적으로 페이지를 reload 시키기 때문에, 페이지 리로드 현상 방지.

        // jquery로 해당 input data 값 가져오기.
        // var user_img = $('#user_img').val();
        // var user_name = $('#user_name').val();
        // var majors = $('#majors').val();
        // var user_add = $('#user_add').val();
        // var user_age = $('#user_age').val();
        // var bk_time = $('#bk_time').val();
        // var user_ce = $('#user_ce').val();
        // var std_card = $('#std_card').val();
        // var q_card = $('#q_card').val();

        var view_form = $('#view_form')[0];
        var formData = new FormData(view_form);

        // var mentorpfData = {
        //     user_img: user_img,
        //     user_name: user_name,
        //     majors: majors,
        //     user_add: user_add,
        //     user_age: user_age,
        //     bk_time: bk_time,
        //     user_ce: user_ce,
        //     std_card: std_card,
        //     q_card: q_card,
        // }

        $.ajax({
            type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
            url: 'mentorpf_writeForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
            data: formData,          // url로 전송할 데이터 정의
            dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
            success: function (result) {

                alert("성공");

            },
            error: function (err) {
                // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
                console.log(err);
            },
            cache: false,
            contentType: false,
            processData: false
        })
    }

    function imgNext() {
        let $listCnt = $('#list_length').val();
        let $current = $('.current')[0];
        let idx = $current.id.split('_')[1];

        $(`#img_${idx}`).toggleClass('current');

        if (idx == $listCnt) {
            idx = 1;
            $(`#img_${idx}`).toggleClass('current');
            return;
        }

        idx++;
        $(`#img_${idx}`).toggleClass('current');
    }

    function imgPrev() {

        let $listCnt = $('#list_length').val();
        let $current = $('.current')[0];
        let idx = $current.id.split('_')[1];

        $(`#img_${idx}`).toggleClass('current');

        if (idx == 1) {
            idx = $listCnt;
            $(`#img_${idx}`).toggleClass('current');
            return;
        }

        idx--;
        $(`#img_${idx}`).toggleClass('current');
    }
    // function onTest(e) {
    //     e.preventDefault();
    //     alert(1);
    // }

</script>

</body>

</html>