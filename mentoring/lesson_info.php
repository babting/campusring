<!DOCTYPE html>

<?php
session_start();
$id = $_GET['id'];

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];

//[내가 수강중인]
//[멘토프로필에서]
//[일반 강의 리스트에서]
?>

<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="0"/>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>강의정보</title>

</head>

<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
    <div class="login_text">강의 정보</div>
</header>
<?php
$sql = "SELECT
              (select name from member where user_id = class.user_id) AS name,
              (select sex from member where user_id = class.user_id) AS sex,
              (select level from member where user_id = class.user_id) AS level,
              keyword, title, place, day_week, time, big_cate, small_cate, context, video, thumbnail, user_id,
              IFNULL((select TRUNCATE(AVG(r_star), 0) from review where class_id = class.id), 0) AS REVIEW_POINT, 
              (select count(*) from review where class_id = class.id) AS REVIEW_COUNT
          FROM class
          where id = '$id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) { //if 시작
    $row = mysqli_fetch_array($result);

    $mentoId = $row['user_id'];
    ?>
    <div class="container">
        <div class="les_info_hd">
            <div class="les_in_sort" style="justify-content: space-around">

                <div class="les_img_fill">
                    <?php
                    if($row['thumbnail']){?>
                        <img src="<?= $row['thumbnail'] ?>">
                    <?php }else{ ?>
                        <img src="../img/computer (1).png">
                    <?php } ?>

                </div>

                <div class="les_hd_m">
                    <p class="les_hd_title"><?= $row['title'] ?></p>
                    <div class="review_rating rating_point">
                        <div class="mini rating" style="display:inline;">
                            <div class="mini star <?php if($row['REVIEW_POINT'] >= 1) echo 'clicked' ?>" id="rating1" name="rating">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="mini star <?php if($row['REVIEW_POINT'] >= 2) echo 'clicked' ?>" id="rating2" name="rating">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="mini star <?php if($row['REVIEW_POINT'] >= 3) echo 'clicked' ?>" id="rating3" name="rating">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="mini star <?php if($row['REVIEW_POINT'] >= 4) echo 'clicked' ?>" id="rating4" name="rating">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="mini star <?php if($row['REVIEW_POINT'] == 5) echo 'clicked' ?>" id="rating5" name="rating">
                                <i class="fas fa-star"></i>
                            </div>

                        </div>
                        <span style="font-size: 1.2rem;"><?= $row['REVIEW_POINT'] ?></span>
                        <span style="font-size: 1.2rem; font-weight: bold;">(<span><?= $row['REVIEW_COUNT'] ?></span>)</span>
                    </div>

                    <!--                            <p><i class="fas fa-star i_color"></i></p>-->
                </div>

                <div id="leinfo_mentobtn">  <a href="../member/mentorpf.php?m_id=<?=$row['user_id']?>" >멘토 프로필</a>  </div>



            </div>
            <!--                <div class="les_chat_icon">-->
            <!--                    <i class="far fa-comment-dots fa-2x"></i>-->
            <!--                </div>-->
        </div>

        <div class="les_it_cont_sort">

            <div class="les_it_cont">
                <p>멘토정보</p>
                <div class="ic_cont_img">
                    <img src="../img/user.png">
                    <p><?= $row['name'] ?></p>
                </div>

                <div class="ic_cont_img">
                    <img src="../img/sex.png">
                    <p><?= $row['sex'] ?></p>
                </div>

                <div class="ic_cont_img">
                    <img src="../img/success.png">
                    <p><?= $row['level'] ?></p>
                </div>

                <div class="les_it_cont">
                    <p>선호장소</p>
                    <div class="ic_cont_in">
                        <img src="../img/location-pin.png">
                        <p><?= $row['place'] ?></p>
                    </div>
                </div>

                <div class="les_it_cont">
                    <p>요일, 시간대</p>
                    <div class="ic_cont_in">
                        <img src="../img/clock.png">
                        <p><?= $row['day_week'] ?>, <?= $row['time'] ?></p>
                    </div>
                </div>

                <div class="les_it_cont">
                    <p>대분류 카테고리</p>
                    <p class="les_b_ca"><?= $row['big_cate'] ?></p>
                </div>

                <div class="les_it_cont">
                    <p>세부 카테고리</p>
                    <p class="les_b_ca"><?= $row['small_cate'] ?></p>
                </div>

                <div class="les_it_cont">
                    <p>강의내용</p>
                    <p class="les_b_ca"><?= $row['context'] ?></p>
                </div>

                <!--                    <div class="les_it_cont">-->
                <!--                        <p>가격</p>-->
                <!--                        <div class="pay_select">-->
                <!--                            <p style="font-size: 1.4rem;">초코링</p>-->
                <!--                            <p class="les_b_ca">100개</p>-->
                <!--                        </div>-->
                <!--                    </div>-->

                <div class="les_video_title">
                    <p>샘플영상</p>
                    <?php
                    $video_sql = "SELECT video FROM class WHERE id = '$id'";
                    $video_sql.=" ORDER BY id DESC limit 0,1";
                    $video_result = mysqli_query($conn, $video_sql);
                    $video_row = mysqli_fetch_array($video_result);

                    if (!empty($video_row['video'])) {
                        ?> <div class="les_video_box">
                            <video muted autoplay loop>
                                <source src="<?= $video_row['video'] ?>" type="video/mp4">
                            </video>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div>
                            <p>샘플 영상이 없습니다.</p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <div class="mtb-3"></div>
            <div class="container les_class_btn" onclick="chat_chk()">
                <span style="color: #fff">1:1 채팅하기</span>
            </div>
        </div>
    </div>
    <?php
} else { //if 끝, else 시작
    ?>
    <br><br>
    <p class="result_s">해당 검색 조건에 해당하는 내역이 없습니다.</p>
<?php } //else 끝
mysqli_close($conn); // 디비 접속 닫기
?>

<script>
    function chat_chk() {

        let mentorId = '<?=$mentoId?>';
        let param = {
            id: mentorId,
        }
        $.ajax({
            type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
            url: 'lesson_infoForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
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

</html>