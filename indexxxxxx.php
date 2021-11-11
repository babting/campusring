
<?php
/**
 * Created by PhpStorm.
 * User: bk
 * Date: 9/26/21
 * Time: 7:28 PM
 */
include_once $_SERVER['DOCUMENT_ROOT']. '/common/header.php';

?>

<div class="container">
    <header class="alt-header">
        <div class="alt-header__column btn-menu"><a><i class="fas fa-bars fa-2x"></i></a></div>
        <div class="alt-header__column"><img src="/img/logo.png" alt="logo" class="logo"></div>
        <div class="alt-header__column"><a href="member/find.php"><i class="fas fa-search fa-2x"></i></a></div>
    </header>


    <!--하단바끝 -->
    <section>
        <a href="mentoring/lesson_list.php"><div class="slideshow-container">
                <!-- Full-width images with number and caption text -->
                <div class="mySlides fade img1">
                    <div class="mtest">캠퍼스링</div>
                    <div class="text">
                        어떤 수업들이 있는지 궁금해?
                        <p>지금 알려줄게!!</p>
                    </div>

                </div></a>

        <a href="mentoring/lesson_list.php"><div class="mySlides fade img2">
                <div class="mtest">캠퍼스링</div>
                <div class="text">
                    카테고리를 정하지 못했어?<br>
                    들어가서 둘러봐!!
                </div>
            </div></a>
        <!-- Next and previous buttons -->
        <!-- <a class="prev" onclick="moveSlides(-1)">&#10094;</a> -->
        <a class="next" onclick="moveSlides(1)">
            <div class="circle">&#10095;</div>
        </a>
</div>
<br />
<!-- The dots/circles -->
<div style="text-align:center">
    <span class="dot" onclick="currentSlide(0)"></span>
    <span class="dot" onclick="currentSlide(1)"></span>
</div>
</section>

<div class="popular">
    <label for="popular_ca">카테고리</label><i id="popular_ca" class="fas fa-chevron-right"></i>
</div>

<!--취업준비 , 실무교육/마케팅 카테고리 없음, 작곡과 주식 카테고리가 추가된것으로 보임 --->
<div class="main_icons">
    <a href="matching/matching_input.php?big='학업'">
        <div class="main_icon_align">
            <img src="img/education (1).png" id="study" alt="학업">
            <div class="text_align"><label for="study">학업</label></div>
        </div>
    </a>
    <a href="matching/matching_input.php?big='댄스'">
        <div class="main_icon_align">
            <img src="img/dancer (1).png" alt="댄스" id="dancer">
            <div class="text_align"><label for="dancer">댄스</label></div>
        </div>
    </a>
    <a href="matching/matching_input.php?big='취미/생활'">
        <div class="main_icon_align">
            <img src="img/videoconsole.png" alt="취미/생활" id="hobby">
            <div class="text_align"><label for="hobby">취미/생활</label></div>
        </div>
    </a>
    <a href="matching/matching_input.php?big='악기'">
        <div class="main_icon_align">
            <img src="img/electric-guitar.png" alt="악기" id="instrument">
            <div class="text_align"><label for="instrument">악기</label></div>
        </div>
    </a>
</div>

<div class="main_categories">
    <a href="estimate/estimate_ing.php"><div class="details_categories" id="estimate_next">견적서 작성<label for="estimate_next"><i
                    class="fas fa-chevron-right"></i></label></div></a>

    <a href="estimate/estimate_list.php"> <div class="details_categories" id="list_next">견적서 목록<label for="list_next"><i
                    class="fas fa-chevron-right"></i></label></div></a>
    <a href="chocoring/buy_ring.php"><div class="details_categories" id="ring_next">초코링 구매<label for="ring_next"><i
                    class="fas fa-chevron-right"></i></label></i></div></a>
    <a href="presentshop/presentshop.php"><div class="details_categories" id="gift_next">선물하기<label for="gift_next"><i
                    class="fas fa-chevron-right"></i></label></div></a>
    <a href="qna/qna_list.php"><div class="details_categories" id="qa_next">Q&A<label for="qa_next"><i class="fas fa-chevron-right"></i></label>
        </div></a>
</div>
<!-- 하단바 -->
<?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
</div>

<footer class="footer" >
    <div class="screen_footer">
        <div class="footer_text">
            <span>고객센터</span>
            <p>02-1234-1234</p>
            <span>09:00 ~ 18:00 (점심시간 12:00 ~ 13:00 / 주말, 공휴일 제외)</span>

        </div>
        <div class="dropdown">
            <button id="toggle_id" onclick="info_click()">CAMPUS RING 사업자 정보<label for="dropdown_btn"><i
                        class="fas fa-chevron-down" id="dropdown_btn"></i></label></button>
            <div id="admin_id" class="dropdown-content">
                <p>캠퍼스링 대표 : CarpeDM</p>
                <p>주소 : 서울 구로구 디지털로 243 지하이시티 501호~502호</p>
                <p>사업자등록번호 : 111-22-333[사업자확인]</p>
                <p>통신판매업신고 : 제2017-서울구로-12344678호</p>
                <p>이메일 : CarpeDM@campusring.co.kr</p>
                <p>TEL : 02-1234-1234 FAX: 02-1234-5678</p>
                <p>개인정보관리책임자 : 홍길동</p>
            </div>
        </div>
        <button onclick="location.href='../qna/qna_1to1.php'">1:1문의하기</button>
    </div>
    <div class="footer_align">
        <ul>
            <li>이용약관</li>
            <li>개인정보처리방침</li>
            <li>이용안내</li>
            <li>회사소개</li>
        </ul>
    </div>
    <p class="copyright">Copyright&#169;campusring.All rights reserved</p>
</footer>
</body>

</html>