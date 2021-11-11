<!DOCTYPE html>
<?php
session_start();
header("Cache-Control: no-cache");

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

if (!isset($_SESSION['user_id'])){
    echo "<script>alert('로그인이 필요한 서비스입니다.'); location.href = '/login.php';</script>";
    exit;
}
if ($_POST['big_cate'] == ""){
    echo "<script>alert('먼저 매칭설정을 해주세요.'); location.href = '/matching/matching_input.php';</script>";
    exit;
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM member WHERE user_id = '$user_id' ";
$re = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($re);
$user_name = $row['name'];

//print_r($_POST);

//매칭조건에서 입력된 값을 포스트로 받음
$big_cate = $_POST['big_cate'];
$small_cate_num = count($_POST["small_cate"]);
$small_cate_array = $_POST["small_cate"];
$period_array = $_POST["period"];
$period_num = count($_POST["period"]); //체크박스 다중 선택값을 받아오는 방법
$ground = $_POST['ground'];
$sex = $_POST['sex'];
$time = $_POST['time'];
$period_value = "";
$small_cate_value = "";

if ($period_num > 0 ) {
    for($i =0 ;  $i < $period_num; $i++){
        $period_value = $period_value.$_POST["period"][$i];
        if ($period_num -1 > $i) {
            $period_value = $period_value.'|';
        }
    }
}

if ($small_cate_num > 0) {
    for($j = 0; $j < $small_cate_num; $j++) {
        $small_cate_value = $small_cate_value.$_POST["small_cate"][$j];
        if ($small_cate_num-1 > $j) {
            $small_cate_value = $small_cate_value.'|';
        }
    }
}
?>
<html lang="ko" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="author" content="carpeDM"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 스타일시트 -->
    <link rel="stylesheet" href="/css/hj/base.css">
    <link rel="stylesheet" type="text/css" href="/css/hj/demo.css"/>
    <link rel="stylesheet" type="text/css" href="/css/hj/custom.css"/>
    <link rel="stylesheet" href="/css/styles.css">
    <!-- 자습 -->
    <script type="text/javascript" src="/js/modernizr.custom.79639.js"></script>
    <!--jquery ajax-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- 아이콘 -->
    <link rel="shortcut icon" href="../favicon.ico">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="https://kit.fontawesome.com/f45d796544.js" crossorigin="anonymous"></script>

    <title>캠퍼스링 멘토 매칭</title>
</head>

<body>
<header class="hd_box"  style="  border: solid 3px black;
    border-color: #D9D9D9;
    border-top-color: white;
    bolder-top: none;
    border-left: none;
    border-right: none;">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
    <div class="login_text">매칭 결과</div>

    <div class=""></div>
</header>

<!-- 상단바 end -->
<div class="container"
     style=" height:100%;  background-size:cover; background-position:center center;">
   
    <section class="main">


        <!--a태그 사이의 아이콘 이미지 모두 바꿔야 함
         m_id 는 멘토 아이디--->
        <div class="baraja-demo">
            <ul id="baraja-el" class="baraja-container">
                <?php
                $sql = " select A.* from (";
                $sql = $sql." select t1.* ";

                // 대분류
                $sql = $sql.", IF(t1.big_cate='".$big_cate."', @MATCH := @MATCH+31, @MATCH := @MATCH) AS MATCH_BIG_CATE ";

                // 기간
                if ($period_num > 0) {
                    $sql = $sql.", IF(t1.period regexp '".$period_value."', @MATCH := @MATCH+17, @MATCH := @MATCH) AS MATCH_PERIOD ";
                } else {
                    $sql = $sql.", (@MATCH := @MATCH + 17) AS MATCH_PERIOD ";
                }

                // 시간
                if ($time != '무관') {
                    $sql = $sql.", IF(t1.time='".$time."', @MATCH := @MATCH + 3, @MATCH := @MATCH) AS MATCH_TIME ";
                } else {
                    $sql = $sql.", (@MATCH := @MATCH + 3) AS MATCH_TIME ";
                }

                // 성별
                if ($sex != '무관') {
                    $sql = $sql.", IF((select sex from member t2 where t2.user_id = t1.user_id)='".$sex."', @MATCH := @MATCH + 29, @MATCH := @MATCH) AS MATCH_SEX ";
                } else {
                    $sql = $sql.", (@MATCH := @MATCH + 29) AS MATCH_SEX ";
                }

                // 세부
                if ($small_cate_num > 0) {
                    $sql = $sql.", IF(t1.small_cate regexp '".$small_cate_value."', @MATCH := @MATCH + 19, @MATCH := @MATCH ) AS MATCH_SMALL_CATE ";
                } else {
                    $sql = $sql.", (@MATCH := @MATCH + 19) AS MATCH_SMALL_CATE ";
                }

                $sql = $sql.", @MATCH AS MATCH_RATE ";
                $sql = $sql.", @MATCH := 1 AS MATCH_DEFAULT ";
                $sql = $sql." from class t1, (SELECT @MATCH := 1) M ";
                $sql = $sql." ) A order by A.MATCH_RATE desc LIMIT 5 ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0){ //if 시작
                    while ($row = mysqli_fetch_array($result)){
                        ?>
                        <li>
                            <img class="matching_mento" style="object-fit: cover; " width="200px" height="130px"  src="<?=$row['thumbnail']?>" alt="image1"/><h4><?=$row['user_id']?></h4>
                            <p style="font-weight: 900; color: black;  overflow:hidden;
                                        text-overflow:ellipsis; white-space: nowrap;"><?=$row['title']?></p>
                            <p style="height: 80px; width:100%;
                                        display:-webkit-box;
                                        -webkit-line-clamp:3;
                                        -webkit-box-orient:vertical;


                                        line-height:20px;
                                        overflow:hidden;
                                        text-overflow:ellipsis;

"><?=$row['context']?></p>
                            <p style="position:absolute; top:88%; bottom:12%;left:2%; color: #565454">#<?=$row['keyword']?></p>
                            <a href="../member/mentorpf.php?m_id=<?=$row['user_id']?>" >
                                <i class="fas fa-info-circle fa-1x" style="position:absolute; top:90%; bottom:10%;right:5%; float: right; margin:3px;"></i></a>
                        </li>
                        <?php
                    }
                }else{ //if 끝, else 시작
                    echo "테이블에 데이터가 없습니다.";
                } //else


                ?>


                <li><img class="matching_mento" style="object-fit: cover; " width="100%" height="80%" src="../img/gummy-bears-pk.jpg" alt="image3"/>
                    <h4>광고 이미지</h4></li>



            </ul>
        </div>

    </section>
    <nav class="actions light">




        <style>


            .card_btn{
            //width: 100%;
                margin: 10px;
                padding: 15px;
                border-radius: 5px;
                border: none;
                background: #ff65a7;
                color: #fff;
                font-size: 20px;

            }


            #mat_btn_table td{


                height: 40px;


            }

            #mat_btn_table {
                width: 50%;
            }

            .container .nav {
                z-index: 200000;}

            /*아이폰 6/7/8*/
            /*미디어 쿼리*/
            @media screen and (max-width: 376px){
                #mat_btn_table{
                    width: 80%;
                    padding: 0px;
                    border-radius: 5px;
                    border: none;
                    background: #ff65a7;
                    color: #fff;
                    font-size: 18px
                    font-weight: bold;

                }

                #allresult_btn{
                    font-size:18px;
                    padding: 0px;
                    margin:0px;
                    font-weight: bold;
                }

            }



        </style>

        <div id="card_menu" style="transition: all 0.5s; margin-top:120px">
            <!-- 	<nav class="actions"> -->







            <table id="mat_btn_table" style="margin: 0 auto;      z-index: 19000;">
                <colgroup >
                    <col width="3.3333%">
                    <col width="3.3333%">
                    <col width="3.3333%">
                    <col width="3.3333%">



                </colgroup>

                <tr>
                    <td style="">
                        <button id="nav-prev" type="button" style=" display: inline;float: left; "   class="card_btn"> < </button>
                    </td>

                    <td colspan="2" style=" position:relative;text-align: center;align: center; ">


                        <!--     <div style="align-content: center; margin:10px;">-->
                        <button id="allresult_btn"  style="line-height: inherit; display:inline; position:absolute; top:10PX; bottom:10px; left: 0px; width:100%;right: 0px; margin:0px;align-content:center; align-items: center; text-align: center;"
                                class="card_btn" onclick="document.getElementById('for_listform').submit();" type="button">
                            모든 결과
                        </button>
                        <!-- </div>-->
                    </td>


                    <td>
                        <button id="nav-next" style=" display: inline;float: right; "   class="card_btn" type="button"> > </button>
                    </td>

                </tr>

                <tr>

                    <td colspan="2">
                        <button id="close" style=" display: inline; float: left;width:90%;"  class="card_btn" type="button">모으기</button>
                    </td>


                    <td colspan="2">
                        <button id="nav-fan4" style=" display: inline; float: right; width: 90%;"  class="card_btn" type="button">펼치기</button>
                    </td>
                </tr>
        </div>

        </table><!--카드버튼 -->

        <form method="post"  id="for_listform" name="for_listform" action="../mentoring/lesson_list.php" style="display: none">


            <input type="radio" checked class="sex" id="signid1" NAME="sex" value="<?php echo $sex;?>">성별

            <select  id="best_place" name="ground">
                <option selected value="<?php echo $ground;?>">선호장소</option>
            </select>

            <select  id="time" name="time">

                <option selected value="<?php echo $time;?>">시간대</option>
            </select>

            <select  id="big_cate"  name="big_cate" style="width: 100%;" onclick="return sebuclick(this)">
                <option selected value="<?php echo $big_cate;?>">대분류</option>
            </select>


            <!--복수 선택가능 체크박스-->
            <input type="checkbox" class ="period" NAME="period[]" value="단기">단기
            <input type="checkbox" class ="period"  NAME="period[]" value="주단위">주단위
            <input type="checkbox" class ="period"  NAME="period[]" value="월단위">월단위



            <?php      if ($period_num > 0 ) {   //선택값이 있으면  ?>

                <script>
                    var periodarray = <?php echo json_encode($period_array)?>;
                    var here = document.for_listform.getElementsByClassName("period");

                    console.log(periodarray.length);
                    for (var i = 0; i < periodarray.length; i++) {

                        for (var j = 0; j < here.length; j++) {
                            if (here[j].value == periodarray[i]) {
                                here[j].checked = true;
                                console.log("체크 부여  ");
                            }
                        }


                    }


                </script>

            <?php  }?>


            <div id="sebudiv">

            </div>
            <?php if ($small_cate_num > 0 ) {   //선택값이 있으면  ?>
                <script>
                    //반복하며 밸루값을 받은 체크 박스를 생성하기

                    var smallarray = <?php echo json_encode($small_cate_array)?>; //밸루값 배열
                    var make= "";
                    let herein = document.getElementById("sebudiv");
                    //  var herein = document.for_listform.sebudiv;
                    console.log(herein);


                    for (var i = 0; i < smallarray.length; i++) {
                        //밸루 하나  smallarray[]
                        console.log("세부 반복"+i);
                        make +=' <input type="checkbox" checked class="small_cate" NAME="small_cate[]" value="' +smallarray[i]+
                            '"/> ';
                    }
                    console.log(make);
                    herein.innerHTML=make;

                </script>
            <?php  } ?>
        </form>
    </nav> <!--액션라이트 네브 end -->
    <!-- 하단바 -->
    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>

    <!--하단바끝 -->
</div><!-- 콘테이너끝 -->
<!---아래는 카드 애니메이션 용 --->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery.baraja.js"></script>
<script type="text/javascript">
    $(function () {
        var $el = $('#baraja-el'),
            baraja = $el.baraja();

        baraja.fan({
            speed: 500,
            easing: 'ease-out',
            range: 90,
            direction: 'left',
            origin: {minX: 20, maxX: 80, y: 100},
            center: true,
            translation: 60
        });


        // navigation 이전,다음 화살표
        $('#nav-prev').on('click', function (event) {

            let $cardMenu = $('#card_menu');

            $cardMenu[0].style['margin-top'] = '60px';

            baraja.previous();

        });

        $('#nav-next').on('click', function (event) {
            let $cardMenu = $('#card_menu');
            $cardMenu[0].style['margin-top'] = '60px';
            baraja.next();
        });
        // simple fan
        $('#nav-fan').on('click', function (event) {
            baraja.fan({
                speed: 500,
                easing: 'ease-out',
                range: 90,
                direction: 'right',
                origin: {x: 25, y: 100},
                center: true
            });

        });


        $('#nav-fan4').on('click', function (event) {

            let $cardMenu = $('#card_menu');

            $cardMenu[0].style['margin-top'] = '120px';

            baraja.fan({
                speed: 500,
                easing: 'ease-out',
                range: 90,
                direction: 'left',
                origin: {minX: 20, maxX: 80, y: 100},
                center: true,
                translation: 60
            });
        });


        // close the baraja
        $('#close').on('click', function (event) {

            let $cardMenu = $('#card_menu');

            $cardMenu[0].style['margin-top'] = '60px';

            baraja.close();

        });

        // // example of how to add more items
        // $('#add').on('click', function (event) {
        //
        //     if ($(this).hasClass('disabled')) {
        //         return false;
        //     }
        //
        //     $(this).addClass('disabled');
        //
        //     baraja.add($('<li><img src="../img/6.jpg" alt="image6"/><h4>Serenity</h4><p>Truffaut wes anderson hoodie 3 wolf moon labore, fugiat lomo iphone eiusmod vegan.</p></li><li><img src="../img/7.jpg" alt="image7"/><h4>Dark Honor</h4><p>Chillwave mustache pinterest, marfa seitan umami id farm-to-table iphone.</p></li><li><img src="../img/8.jpg" alt="image8"/><h4>Nested Happiness</h4><p>Minim post-ironic banksy american apparel iphone wayfarers.</p></li><li><img src="../img/9.jpg" alt="image9"/><h4>Cherry Country</h4><p>Sint vinyl Austin street art odd future id trust fund, terry richardson cray.</p></li>'));
        //
        // });

    });
</script>


</body>
</html>

