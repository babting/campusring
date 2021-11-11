
<!DOCTYPE html>
<?php
session_start();
$m_id = @$_GET['m_id'];

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';
$return_url = @$_GET['returnurl'];
$user_id = $_SESSION['user_id'];

?>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>멘토프로필페이지</title>
</head>

<body>
<header class="hd_box">
    <div class="btn_prev">
        <?php if ($return_url != ""){
        ?>
        <i class="fas fa-angle-left fa-3x" onClick="location.href= '<?=$return_url?>'">
        <?php
        } else{ ?>
            <i class="fas fa-angle-left fa-3x" onClick="history.go(-1);">
        <?php } ?>
        </i></i></div>
    <div class="login_text">멘토프로필</div>
    <div class=""></div>
</header>



<div class="container">
    <!-- 첫 번째 네모 영역 -->
    <?php

    $sql = "SELECT 
                user_id, major, residence, break_time, career, photo
            FROM member
            where user_id = '{$m_id}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
        ?>
    <!--큰 네모 왼쪽 프로필 영역 -->
    <div class="mentor_p_group1">
        <div class="mentor_p_main_img">
            <img src="<?= $row['photo'] ?>" id="user_img">
        </div>
        

        <div class="nickname_area">
            <p id="user_id"><?= $row['user_id'] ?> </p>
        </div>

        <div class="pf_msgicon">

<!--            <i class="far fa-comment-dots" onclick="location.href='../chatting/chat_list.php'"></i>-->
            <i class="far fa-comment-dots" onclick="chat_chk()"></i>
        </div>



        <div class="pf_group1">
            <p id="mentor_dpt" class="pf_major">전공 : <?= $row['major'] ?></p>
            <p id="mentor_add" class="pf_add">주소 : <?= $row['residence'] ?></p>
            <!--            <ul>-->
            <!--                <li id="hashtag_1">#컴퓨터</li>-->
            <!--                <li id="hashtag_2">#요리</li>-->
            <!--                <li id="hashtag_3">#미술</li>-->
            <!--                <li id="hashtag_4">#수학</li>-->
            <!--            </ul>-->
            <p id="mentor_between_class" class="pf_between">공강시간 : <?= $row['break_time'] ?></p>
            <p id="mentor_career" class="pf_career">경력 : <?= $row['career'] ?></p>
        </div>

    </div>

    <!--닉네임 영역 -->
    <div>
        <div class="pf_card">

            <p id="student_card">학생증</p>
            <?php
            $students_sql = "SELECT * FROM certification WHERE user_id = '$m_id' AND type ='학생증'";
            $students_sql.=" ORDER BY id DESC limit 0,1";
            $student_result = mysqli_query($conn, $students_sql);
            $students_row = mysqli_fetch_array($student_result);
            ?>

            <?php
            if (!empty($students_row)) {
            ?>
            <img id="lessonup_gall"
                 src="<?= $students_row['img'] ?>"/>
                <?php
            } else {
            ?>
                <img id="lessonup_gall" src="/asset/uploadImg/profile/default.png"/>
            <?php }?>
        </div>



        <hr>
        <div class="mepf_sort_cer">
            <p>자격증</p>
            <div class="mentor_img_sort" style="position: relative; height:300px;">
                <?php
                $cr_sql = "SELECT * FROM certification WHERE user_id = '$m_id' AND type ='자격증'";
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
                <div class="prev_btn" onclick="imgPrev()"><i class="fas fa-angle-left fa-3x"></i></div>
                <div class="next_btn" onclick="imgNext()"><i class="fas fa-angle-right fa-3x"></i></div>
            </div>
            <!--            <div style="text-align: center;">-->
            <!--                <input type="file" id="leup_thumb" accept="image/*" value="파일 찾기" name="certification_cr[]" multiple>-->
            <!--            </div>-->
<!--            <div class="les_simg_labtn">-->
<!--                <label class="input-file-button ft_bd mtb_1_r" for="input-file">업로드</label>-->
<!--                <input type="file" id="input-file" name="input_file" style="display: none;">-->
<!--            </div>-->
            <?php
            } else {
                ?>
                <!--            <div style="text-align: center;">-->
                <!--                <input type="file" id="leup_thumb" accept="image/*" value="파일 찾기" name="certification_cr[]" multiple>-->
                <!--            </div>-->
<!--                <div class="les_simg_labtn">-->
<!--                    <label class="input-file-button ft_bd mtb_1_r" for="input-file">업로드</label>-->
<!--                    <input type="file" id="input-file" name="input_file" style="display: none;">-->
<!--                </div>-->
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

</div>


    <!--    <div class="mentorpf_top">-->
    <!--        <ul>-->
    <!--            <li><a href="../mentoring/lesson_list.php">강의목록</a></li>-->
    <!--            <li><a href="../member/mentorpf.php" target="_self">멘토정보</a></li>-->
    <!--            <li><a href="../review/review.php" target="_self">멘티후기</a></li>-->
    <!--        </ul>-->
    <!--    </div>-->

    <!-- 내용부분 영역 1 -->

    <!-- 하단바 -->
    <!--    <div style="margin: 7rem"></div>-->
    <!--    <nav class="container nav" style="    z-index: 2000;">-->
    <!--        <ul class="nav__list">-->
    <!--            <li class="nav_btn">-->
    <!--                <a class="nav__link" href="index.php"><img class="home" src="../img/c_home.PNG" alt="home"></a>-->
    <!--            </li>-->
    <!--            <li class="nav_btn">-->
    <!--                <a class="nav__link" href="chatting/chat.php"><span class="nav__notification badge">1</span><i class="far fa-comment fa-2x"></i></a>-->
    <!--            </li>-->
    <!--            <li class="nav_btn"><a class="nav__link" href="estimate/estimate.php"><i class="far fa-sticky-note fa-2x"></i></a></li>-->
    <!--            <li class="nav_btn"><a class="nav__link" href="member/mypage.php"><i class="far fa-user fa-2x"></i></a></li>-->
    <!--            <li class="nav_btn"><a class="nav__link" href="map/map_select.php"><i class="fas fa-gift fa-2x"></i></a></li>-->
    <!--        </ul>-->
    <!--    </nav>-->
    <script>
        $('.btn-menu').click(function () {
            $('.ui.sidebar').sidebar('setting', 'transition', 'overlay')
                .sidebar('toggle');
        })

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
    </script>
    <div style="margin: 7rem"></div>
    <nav class="container nav">
        <ul class="nav__list">
            <li class="nav_btn">
                <a class="nav__link" href="/index.php"><img class="home" src="/img/c_home.PNG" alt="home"></a>
            </li>
            <a class="nav__link" href="/chatBk/chat_list.php">
                <i class="far fa-comment fa-2x"></i></a>
            <li class="nav_btn"><a class="nav__link" href="/estimate/estimate_list.php"><i class="far fa-sticky-note fa-2x"></i></a></li>
            <li class="nav_btn"><a class="nav__link" href="/member/mypage.php"><i class="far fa-user fa-2x"></i></a></li>
            <li class="nav_btn"><a class="nav__link" href="/map/map_select.php"><i class="fas fa-map-marker-alt fa-2x"></i></a></li>
        </ul>
    </nav>






    <!--하단바끝 -->
</div>
<script>

    // (function() {
    //
    //     console.log(1);
    //     $.ajax({
    //         type: 'POST',           // http type 정의 ["GET", "POST"]
    //         url: 'mentorpfJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
    //         data: {},          // url로 전송할 데이터 정의
    //         dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
    //         success: function(result) {
    //             // url에서 해당 data를 처리하고 반환된 success 결과에 대해서 로직 처리
    //             console.log(result);
    //             var callResult = result.result; //db에서 받아오는 방법
    //             var callCode = result.code;
    //             var callData = result.data || {};
    //             var callErrorReason = result.errorReason || '';
    //
    //             var user_id = result.data.user_id;
    //             var mentor_dpt = result.data.mentor_dpt;
    //             var mentor_add = result.data.mentor_add;
    //             var mentor_between_class = result.data.mentor_between_class;
    //             var student_card = result.data.student_card;
    //             var license_card = result.data.license_card;
    //             var user_img = result.data.user_img;
    //
    //             alert(user_id+","+mentor_dpt+","+mentor_add+","+mentor_between_class+","+student_card+","+license_card+","+user_img);
    //
    //             $('#user_id').text(user_id);
    //             $('#mentor_dpt').text(mentor_dpt);
    //             $('#mentor_add').text(mentor_add);
    //             $('#mentor_between_class').text(mentor_between_class);
    //             $('#student_card').text(student_card);
    //             $('#license_card').text(license_card);
    //             $('#user_img').text(user_img);
    //
    //
    //         },
    //         error: function(err) {
    //             // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
    //             console.log(err);
    //         }
    //     })
    // })();
</script>
<script>

    function chat_chk() {

        let mentorId = '<?=$m_id?>';
        let param = {
            id: mentorId,
        }
        $.ajax({
            type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
            url: '/mentoring/lesson_infoForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
            data: param,          // url로 전송할 데이터 정의, 위에서 정의한 그 객체 변수
            dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
            success: function (result) {
                if (result.result != "ERROR"){
                    location.href = "/chatBk/index.php?board=" + result.result;
                }else{
                    alert("오류가 발생했습니다.");
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

</html><script>
    (function() {
        var ws = new WebSocket('ws://' + window.location.host + '/jb-server-page?reloadServiceClientId=349');
        ws.onmessage = function (msg) {
            if (msg.data === 'reload') {
                window.location.reload();
            }
            if (msg.data.startsWith('update-css ')) {
                var messageId = msg.data.substring(11);
                var links = document.getElementsByTagName('link');
                for (var i = 0; i < links.length; i++) {
                    var link = links[i];
                    if (link.rel !== 'stylesheet') continue;
                    var clonedLink = link.cloneNode(true);
                    var newHref = link.href.replace(/(&|\?)jbUpdateLinksId=\d+/, "$1jbUpdateLinksId=" + messageId);
                    if (newHref !== link.href) {
                        clonedLink.href = newHref;
                    }
                    else {
                        var indexOfQuest = newHref.indexOf('?');
                        if (indexOfQuest >= 0) {
                            // to support ?foo#hash
                            clonedLink.href = newHref.substring(0, indexOfQuest + 1) + 'jbUpdateLinksId=' + messageId + '&' +
                                newHref.substring(indexOfQuest + 1);
                        }
                        else {
                            clonedLink.href += '?' + 'jbUpdateLinksId=' + messageId;
                        }
                    }
                    link.replaceWith(clonedLink);
                }
            }
        };
    })();
</script>