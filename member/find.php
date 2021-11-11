<!DOCTYPE html>
<html lang="ko">

<head>
  <link rel="stylesheet" href="../css/styles.css">
  <script src="https://kit.fontawesome.com/a9eb1f10be.js" crossorigin="anonymous"></script>
  <link rel="icon" type="image/png" href="http://example.com/myicon.png">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/content.js"></script>
  <script>
    function fn_location(obj) {
        location.href = "../mentoring/lesson_list.php"+"?search="+obj.value;
    }
    </script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>main</title>
</head>

<body>
  <div class="container">
    <header class="alt-header">
      <div class="alt-header__column"><a></a><i class="fas fa-angle-left fa-2x" onClick="history.go(-1);"></i></div>
      <div class="alt-header__column"><img src="../img/logo.png" alt="logo" class="logo"></div>
      <div class="alt-header__column"><i class="fas fa-search fa-2x"></i></div>
    </header>
      <form method="get" action="../mentoring/lesson_list.php">
        <div class="search">
            <input type="text" id="ca_find" placeholder="카테고리를 검색해주세요." name="search"> <button type="submit">검색</button>
        </div>
      </form>
        <div class="popularity_find">
            <p>인기 카테고리</p>
        </div>
        <div class="popularity_page">
            <input type="submit" id="f_cate" value="학업" onclick="fn_location(this)">
            <input type="submit" id="s_cate" value="댄스" onclick="fn_location(this)">
            <input type="submit" id="th_cate" value="스포츠/건강" onclick="fn_location(this)">
            <input type="submit" id="fo_cate" value="악기" onclick="fn_location(this)">

            <input type="submit" id="fi_cate" value="외국어" onclick="fn_location(this)">
            <input type="submit" id="si_cate" value="미술" onclick="fn_location(this)">
            <input type="submit" id="se_cate" value="외국어시험" onclick="fn_location(this)">
            <input type="submit" id="ei_cate" value="컴퓨터" onclick="fn_location(this)">
         
            <input type="submit" id="ni_cate" value="음악이론/보컬" onclick="fn_location(this)">
            <input type="submit" id="ten_cate" value="디자인" onclick="fn_location(this)">
            <input type="submit" id="ele_cate" value="자격증" onclick="fn_location(this)">
            <input type="submit" id="tw_cate" value="코딩" onclick="fn_location(this)">
            <input type="submit" id="tht_cate" value="사진/영상" onclick="fn_location(this)">
        </div>

      <!-- 하단바 -->
      <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>

      <!--하단바끝 -->

  </div>

</body>
<script>
    // function onSubmit(e) {
    //     e.preventDefault(); // submit은 기본적으로 페이지를 reload 시키기 때문에, 페이지 리로드 현상 방지.
    //
    //     // jquery로 해당 input data 값 가져오기.
    //     // html tag안에 class, id, name 으로 구분 값을 가져옵니다.
    //     // class 로 구분해서 값을 가져오려면 $('.class명').val()
    //     // id 로 구분해서 값을 가져오려면 $('#id명').val()
    //     // name으로 구분해서 값을 가져오려면 $("태그이름[name='name명']").val() ex) $("input[name='m_id']").val()
    //     // var ca_find = $('.ca_find').val().replace(/ /g, '');
    //
    //     var ca_find = $('#ca_find').val().trim();
    //
    //     // 데이터 검증
    //     // signup.php로 보낼 데이터 포맷 정의
    //     var findData = {
    //         ca_find: ca_find,
    //     }
    //
    //     console.log(findData);
    //     $.ajax({
    //         type: 'GET',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
    //         url: 'lesson_list.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
    //         data: findData,          // url로 전송할 데이터 정의
    //         dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
    //         success: function(result) {
    //             // url에서 해당 data를 처리하고 반환된 success 결과에 대해서 로직 처리
    //             /**
    //              * RESULT DATA FORMAT
    //              * code: 404                                // http 상태 코드. (참조: https://developer.mozilla.org/ko/docs/Web/HTTP/Status)
    //              * data: null                               // 성공할 경우 알맞은 data, 실패할 경우 null
    //              * errorReason: "존재하지 않은 회원입니다."     // 성공할 경우 ""(빈 값), 실패할 경우 알맞은 실패사유
    //              * result: false                            // ajax call 성공 여부
    //              **/
    //             console.log(result);
    //             var callResult = result.result;
    //             var callCode = result.code;
    //             var callData = result.data || {};
    //             var callErrorReason = result.errorReason || '';
    //         },
    //         error: function(err) {
    //             // 서버 에러 (예: db 접속 불량, php(서버) 코드 불량 ..)
    //             console.log(err);
    //         }
    //     })
    // }
</script>

</html>
