<!DOCTYPE html>
<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];
if (@$_GET['type'] == "") {
    $mytype = "type1";
} else {
    $mytype = $_GET['type'];
}
?>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta name="author" content="carpeDM"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://kit.fontawesome.com/a9eb1f10be.js" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>견적서 목록</title>
</head>

<header class="hd_box">
    <div class="close_btn">
        <i class="fas fa-times fa-2x" onClick="history.go(-1);"></i>
    </div>
    <div class="login_text">견적서 목록</div>
</header>

<div class="container">
    <div class="tab_wrapper">
<!--        <ul>-->
<!--            <li class="tab --><?php //if ($mytype == "type1") echo "current" ?><!--" onclick="location.href='/estimate/estimate_list.php?type=type1'">받은 견적서-->
<!--            </li>-->
<!--            <li class="tab --><?php //if ($mytype == "type2") echo "current" ?><!--"-->
<!--                onclick="location.href='/estimate/estimate_list.php?type=type2'">작성 견적서-->
<!--            </li>-->
<!---->
<!--        </ul>-->
        <div class="es_list_tab">
            <div class="tab1 <?php if ($mytype == "type1") echo "current" ?>" onclick="location.href='../estimate/estimate_list.php?type=type1'">받은견적서</div>
            <div class="tab <?php if ($mytype == "type2" ) echo "current"?>" onclick="location.href='../estimate/estimate_list.php?type=type2'">작성 견적서</div>
        </div>

        <section class="tab_container">
            <article class="tab_content current">
                <div class="lesson_list">
                    <?php
                    $id = $_SESSION['user_id'];
                    if ($mytype == "type1") {
                        $sql = "SELECT
                                            e_item, e_date, (select name from member where member.user_id=class.user_id) as name, match_class.id, match_class.state_nm
                                        FROM match_class, class
                                        where match_class.user_id = '$id' and match_class.class_id = class.id;";
                    } else if ($mytype == "type2") {
                        $sql = "select
                                                e_item, e_date, (select name from member where member.user_id= t2.user_id) as name, t1.id, t1.state_nm
                                            from
                                                match_class t1,
                                                class t2
                                            where t1.class_id = t2.id
                                            and t2.user_id = '$id';";
                    }

                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) { //if 시작

                        while ($row = mysqli_fetch_array($result)) { //while 끝

                            if ($mytype == "type1") {
                                ?>
                                <div class="est_list_main">
                                    <div class="est_cont_main">
                                        <div class="estli_content_sort">
                                            <p>서비스</p>
                                            <div class="area white-space overflow est_ellipsis"><?= $row['e_item'] ?></div>
                                        </div>
                                        <div class="estli_content_sort">
                                            <p>받은 날짜</p>
                                            <div><?= $row['e_date'] ?></div>
                                        </div>
                                        <div class="estli_content_sort">
                                            <p>보낸 멘토</p>
                                            <div><?= $row['name'] ?></div>
                                        </div>
                                    </div>
                                    <div class="estli_icon_r">
                                        <i class="fas fa-angle-right fa-3x"onclick="location.href='estimate.php?id=<?= $row['id'] ?>&state=<?= $row['state_nm'] ?>'" ></i>
                                    </div>
                                </div>

                                <?php
                            } else if ($mytype == "type2") {
                                ?>
                                <div class="est_list_main">
                                    <div class="est_cont_main">
                                        <div class="estli_content_sort">
                                            <p>서비스</p>
                                            <div class="area white-space overflow est_ellipsis"><?= $row['e_item'] ?></div>
                                        </div>
                                        <div class="estli_content_sort">
                                            <p>받은 날짜</p>
                                            <div><?= $row['e_date'] ?></div>
                                        </div>
                                        <div class="estli_content_sort">
                                            <p>보낸 멘토</p>
                                            <div><?= $row['name'] ?></div>
                                        </div>
                                    </div>
                                    <div class="estli_icon_r">
                                        <i class="fas fa-angle-right fa-3x"onclick="location.href='estimate.php?id=<?= $row['id'] ?>&state=<?= $row['state_nm'] ?>'"></i>
                                    </div>
                                </div>
<!--

                                <?php
                            }
                        } //while 끝

                    } else { //if 끝, else 시작
                        ?>
                        <br><br>
                        <p class="result_s">해당 검색 조건에 해당하는 내역이 없습니다.</p>
                    <?php } //else 끝
                    mysqli_close($conn); // 디비 접속 닫기
                    ?>

                    <!--                                <li><a href="../estimate/estimate.php">-->
                    <!---->
                    <!--                                        <h3>견적서<h3>-->
                    <!---->
                    <!--                                                <div>-->
                    <!--                                                    간호사로 활동한 경험을 바탕으로 간호조무사 자격증 수업을 운영합니다.-->
                    <!--                                                </div>-->
                    <!--                                                <div>조희정</div>-->
                    <!---->
                    <!--                                    </a>-->
                    <!--                                </li>-->


                </div>

            </article>


            <!---->
            <!---->
            <!--            <article class="tab_content">-->
            <!--                <h1>Tab 2</h1>-->
            <!---->
            <!--                            <style>-->
            <!--                                lesson_list li {border:black;}-->
            <!--                            </style>-->
            <!---->
            <!--                                <div class="lesson_list" style="margin: 50px; border: 2px; border-width: 2px; border-color: black;">-->
            <!---->
            <!---->
            <!---->
            <!--                                    <li ><a href="../estimate/estimate.php">-->
            <!--                                            <h3>견적서<h3>-->
            <!---->
            <!--                                                    <div>-->
            <!--                                                        간호사로 활동한 경험을 바탕으로 간호조무사 자격증 수업을 운영합니다.-->
            <!--                                                    </div>-->
            <!--                                                    <div>조희정</div>-->
            <!---->
            <!--                                        </a>-->
            <!--                                    </li>-->
            <!---->
            <!---->
            <!--                                    <li><a href="../estimate/estimate.php">-->
            <!---->
            <!--                                            <h3>견적서<h3>-->
            <!---->
            <!--                                                    <div id="sug_item">-->
            <!--                                                        간호사로 활동한 경험을 바탕으로 간호조무사 자격증 수업을 운영합니다.-->
            <!--                                                    </div>-->
            <!--                                                    <div id="est_date">날짜</div>-->
            <!---->
            <!--                                        </a>-->
            <!--                                    </li>-->
            <!---->
            <!--                                    <li><a href="../estimate/estimate.php">-->
            <!---->
            <!--                                            <h3>견적서<h3>-->
            <!---->
            <!--                                                    <div>-->
            <!--                                                        간호사로 활동한 경험을 바탕으로 간호조무사 자격증 수업을 운영합니다.-->
            <!--                                                    </div>-->
            <!--                                                    <div>조희정</div>-->
            <!---->
            <!--                                        </a>-->
            <!--                                    </li>-->
            <!---->
            <!---->
            <!--                                </div>-->
            <!---->
            <!--            </article>-->
            <!---->
            <!---->
            <!---->
            <!---->
            <!---->
            <!--            <article class="tab_content">-->
            <!--                <h1>Tab 3</h1>-->
            <!--                <p>세번째 탭의 내용입니다.</p>-->
            <!--                <p>사용 언어 : html, css, javascript</p>-->
            <!--            </article>-->
            <!--        </section>-->


    </div>
</div>
<!--  	<script type="text/javascript" src="../js/mentorpf.js"></script>-->
<script type="text/javascript">

    //     (function() {
    //
    //     $.ajax({
    //         type: 'POST',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
    //         url: 'estimate_writeForJson.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
    //         data: {},          // url로 전송할 데이터 정의
    //         dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
    //
    //         success: function(result) {
    //             // url에서 해당 data를 처리하고 반환된 success 결과에 대해서 로직 처리
    //             console.log(result);
    //             var callResult = result.result; //db에서 받아오는 방법
    //             var callCode = result.code;
    //             var callData = result.data || {};
    //             var callErrorReason = result.errorReason || '';
    //
    //             var est_date = result.data.e_date;
    //             var sug_item = result.data.e_item;
    //
    //             $('#est_date').text(est_date);
    //             $('#sug_item').text(sug_item);
    //
    //         },
    //         error: function(err) {
    //             // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
    //             console.log(err);
    //         }
    //     })
    // })();
</script>

</body>
</html>
