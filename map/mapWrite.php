
<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
if (!isset($_SESSION['user_id'])){
    echo "<script>alert('로그인이 필요한 서비스입니다.'); location.href = '/login.php';</script>";
    exit;
}
$user_id = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://kit.fontawesome.com/a9eb1f10be.js" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
    <!--jquery ajax-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> <!-- ajax를 사용하기 위해 jquery cdn으로 불러옴. -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>카테고리별 장소 검색하기</title>
    <style>
        .map_wrap, .map_wrap * {margin:0; padding:0;font-family:'Malgun Gothic',dotum,'돋움',sans-serif;font-size:12px;}
        .map_wrap {position:relative;width:100%;height:780px;}
        #category {position:absolute;top:10px;left:10px;border-radius: 5px; border:1px solid #909090;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.4);background: #fff;overflow: hidden;z-index: 2;}
        #category li {float:left;list-style: none;width:50px;px;border-right:1px solid #acacac;padding:6px 0;text-align: center; cursor: pointer;}
        #category li.on {background: #eee;}
        #category li:hover {background: #ffe6e6;border-left:1px solid #acacac;margin-left: -1px;}
        #category li:last-child{margin-right:0;border-right:0;}
        #category li span {display: block;margin:0 auto 3px;width:27px;height: 28px;}
        #category li .category_bg {background:url(https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/places_category.png) no-repeat;}
        #category li .bank {background-position: -10px 0;}
        #category li .mart {background-position: -10px -36px;}
        #category li .pharmacy {background-position: -10px -72px;}
        #category li .oil {background-position: -10px -108px;}
        #category li .cafe {background-position: -10px -144px;}
        #category li .store {background-position: -10px -180px;}
        #category li.on .category_bg {background-position-x:-46px;}
        .placeinfo_wrap {position:absolute;bottom:28px;left:-150px;width:300px;}
        .placeinfo {position:relative;width:100%;border-radius:6px;border: 1px solid #ccc;border-bottom:2px solid #ddd;padding-bottom: 10px;background: #fff;}
        .placeinfo:nth-of-type(n) {border:0; box-shadow:0px 1px 2px #888;}
        .placeinfo_wrap .after {content:'';position:relative;margin-left:-12px;left:50%;width:22px;height:12px;background:url('https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/vertex_white.png')}
        .placeinfo a, .placeinfo a:hover, .placeinfo a:active{color:#fff;text-decoration: none;}
        .placeinfo a, .placeinfo span {display: block;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;}
        .placeinfo span {margin:5px 5px 0 5px;cursor: default;font-size:13px;}
        .placeinfo .title {font-weight: bold; font-size:14px;border-radius: 6px 6px 0 0;margin: -1px -1px 0 -1px;padding:10px; color: #fff;background: #d95050;background: #d95050 url(https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/arrow_white.png) no-repeat right 14px center;}
        .placeinfo .tel {color:#0f7833;}
        .placeinfo .jibun {color:#999;font-size:11px;margin-top:0;}
    </style>
</head>

<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
    <div class="login_text">위치 선택하기</div>
    <div class=""></div>
</header>
<div class="container">

    <div class="mapw_sort">
        <input type="text" id="sample5_address" class="map_add_input" placeholder="주소검색을 클릭하세요" readonly>
       <div class="map_write_btn">
           <input type="button" class="map_search" onclick="sample5_execDaumPostcode()" value="주소 검색">
           <input type="button" class="map_enrollment" value="위치 등록" onclick="writelocation();">
       </div>

    </div>

    <div id="includedContent"></div>

<!--    <nav class="container nav">-->
<!--        <ul class="nav__list">-->
<!--            <li class="nav_btn">-->
<!--                <a class="nav__link" href="index.php"><img class="home" src="../img/c_home.PNG" alt="home"></a>-->
<!--            </li>-->
<!--            <li class="nav_btn">-->
<!--                <a class="nav__link" href="chatting/chat.php"><span class="nav__notification badge">1</span><i class="far fa-comment fa-2x"></i></a>-->
<!--            </li>-->
<!--            <li class="nav_btn"><a class="nav__link" href="estimate/estimate_list.php"><i class="far fa-sticky-note fa-2x"></i></a></li>-->
<!--            <li class="nav_btn"><a class="nav__link" href="member/mypage.php"><i class="far fa-user fa-2x"></i></a></li>-->
<!--            <li class="nav_btn"><a class="nav__link" href="map/map.php"><i class="fas fa-gift fa-2x"></i></a></li>-->
<!--        </ul>-->
<!--    </nav>-->
    <section>
        <div class="map_wrap">
            <div id="map" style="width:100%;height:80%;position:relative;overflow:hidden;display:none"></div>
            <input type="hidden" name="latitude" id="latitude" value="">
            <input type="hidden" name="longitude" id="longitude" value="">
        </div>
    </section>
    <!-- 하단바 -->
    <?php include "../footer.php"; ?>

    <!--하단바끝 -->
</body>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=7718078d915941a5687af59e0679a104&libraries=services"></script>
<script>
    var mapContainer = document.getElementById('map'), // 지도를 표시할 div
        mapOption = {
            center: new daum.maps.LatLng(37.537187, 127.005476), // 지도의 중심좌표
            level: 5 // 지도의 확대 레벨
        };

    //지도를 미리 생성
    var map = new daum.maps.Map(mapContainer, mapOption);
    //주소-좌표 변환 객체를 생성
    var geocoder = new daum.maps.services.Geocoder();
    //마커를 미리 생성
    var marker = new daum.maps.Marker({
        position: new daum.maps.LatLng(37.537187, 127.005476),
        map: map
    });


    function sample5_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                var addr = data.address; // 최종 주소 변수
                var la = document.getElementById('latitude');
                var lo = document.getElementById('longitude');


                // 주소 정보를 해당 필드에 넣는다.
                document.getElementById("sample5_address").value = addr;
                // 주소로 상세 정보를 검색
                geocoder.addressSearch(data.address, function(results, status) {
                    // 정상적으로 검색이 완료됐으면
                    if (status === daum.maps.services.Status.OK) {

                        var result = results[0]; //첫번째 결과의 값을 활용
                        // 해당 주소에 대한 좌표를 받아서
                        var coords = new daum.maps.LatLng(result.y, result.x);
                        la.value = result.y;
                        lo.value = result.x;

                        // 지도를 보여준다.
                        mapContainer.style.display = "block";
                        map.relayout();
                        // 지도 중심을 변경한다.
                        map.setCenter(coords);
                        // 마커를 결과값으로 받은 위치로 옮긴다.
                        marker.setPosition(coords)
                    }
                });
            }
        }).open();
    }

    function writelocation() {

        var la = $('#latitude').val();
        var lo = $('#longitude').val();

        if (la == "" || lo == ""){
            alert("주소를 먼저 검색해주세요");
        } else{
            var chocoData = {
                user_id : '<?=$user_id?>',
                locationY : la,
                locationX : lo
            };

            $.ajax({
                type: 'post',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
                dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
                url: './mamWrite_ok.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
                data: chocoData,          // url로 전송할 데이터 정의
                success: function(data) {
                    if (data.result == "success"){
                        alert("등록되었습니다.");
                        location.href='/index.php';
                    }else {
                        alert("문제가 발생했습니다. \n Error CODE: " + data.result );
                    }
                },
                error: function (request, status, error) {
                    console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
                }
            });
        }

    }
</script>