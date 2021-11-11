<!DOCTYPE html>
<?php session_start(); ?>
<html lang="ko">

<head>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/a9eb1f10be.js" crossorigin="anonymous"></script>
    <script src="js/change.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인</title>
</head>

<body>
<div class="container">
    <header class="alt-header">
        <div class="alt-header__column"><a href="member/menu.php"><i class="fas fa-bars fa-2x"></i></a></div>


        <div class="alt-header__column"><img src="./img/logo.PNG" alt="logo" class="logo"></div>
        <div class="alt-header__column"><a href="member/find.php"><i class="fas fa-search fa-2x"></i></a></div>
    </header>

    <!---네브메뉴-->
    <div id="includedContent"></div>

    <!-- 하단바 -->
    <?php include "footer.php"; ?>

    <!--하단바끝 -->

    <section>
        <div class="slideshow-container">
            <!-- Full-width images with number and caption text -->
            <div class="mySlides fade img1">
                <div class="mtest">코딩</div>
                <div class="text">
                    코딩 어떻게 하는 거냐고?<p>지금 알려줄게!!</p>
                </div>

            </div>

            <div class="mySlides fade img2">
                <div class="mtest">디자인</div>
                <div class="text">
                    디자인 어떻게 하는 거냐고?<br>
                    지금 알려줄게!!
                </div>
            </div>
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
        <label for="popular_ca">인기 카테고리</label><i id="popular_ca" class="fas fa-chevron-right"></i>
    </div>


    <div class="main_icons">
        <a href="mentoring/lesson_list.php">
            <div class="main_icon_align">
                <img src="img/education (1).png" id="study" alt="학업">
                <div class="text_align"><label for="study">학업</label></div>
            </div>
        </a>

        <a href="mentoring/lesson_list.php">
            <div class="main_icon_align">
                <img src="img/dancer (1).png" alt="댄스" id="dancer">
                <div class="text_align"><label for="dancer">댄스</label></div>
            </div>
        </a>

        <a href="mentoring/lesson_list.php">
            <div class="main_icon_align">
                <img src="img/videoconsole.png" alt="스포츠/건강" id="running">
                <div class="text_align"><label for="running">스포츠/건강</label></div>
            </div>
        </a>

        <a href="mentoring/lesson_list.php">
            <div class="main_icon_align">
                <img src="img/electric-guitar.png" alt="악기" id="instrument">
                <div class="text_align"><label for="instrument">악기</label></div>
            </div>
        </a>

    </div>


    <div class="main_icons">
        <a href="mentoring/lesson_list.php">
            <div class="main_icon_align">
                <img src="img/pallete (1).png" alt="미술" id="computer">
                <div class="text_align"><label for="computer">미술</label></div>
            </div>
        </a>

        <a href="mentoring/lesson_list.php">
            <div class="main_icon_align">
                <img src="img/music-notes.png" alt=음악이론/보컬 id="design">
                <div class="text_align"><label for="design">음악이론/보컬</label></div>
            </div>
        </a>

        <a href="mentoring/lesson_list.php">
            <div class="main_icon_align">
                <img src="img/abc.png" alt="외국어" id="certificate">
                <div class="text_align"><label for="certificate">외국어</label></div>
            </div>
        </a>

        <a href="mentoring/lesson_list.php">
            <div class="main_icon_align">
                <img src="img/test.png" alt="외국어시험" id="hobby">
                <div class="text_align"><label for="hobby">외국어시험</label></div>
            </div>
        </a>
    </div>


    <div class="main_icons">

        <a href="mentoring/lesson_list.php">
            <div class="main_icon_align">
                <img src="img/coding.png" alt="실무교육/컴퓨터" id="computer">
                <div class="text_align"><label for="computer">컴퓨터</label></div>
            </div>
        </a>

        <a href="mentoring/lesson_list.php">
            <div class="main_icon_align">
                <img src="img/pencil-and-ruler.png" alt=디자인 id="design">
                <div class="text_align"><label for="design">디자인</label></div>
            </div>
        </a>

        <a href="mentoring/lesson_list.php">
            <div class="main_icon_align">
                <img src="img/certificate.png" alt="시험/자격증" id="certificate">
                <div class="text_align"><label for="certificate">시험/자격증</label></div>
            </div>
        </a>

        <a href="mentoring/lesson_list.php">
            <div class="main_icon_align">
                <img src="img/janggu.png" alt="시험/자격증" id="certificate">
                <div class="text_align"><label for="certificate">취미생활</label></div>
            </div>
        </a>

    </div>
    <div class="main_categories">
        <a href="estimate/estimate_up.php"><div class="details_categories" id="estimate_next">견적서 등록<label for="estimate_next"><i
                        class="fas fa-chevron-right"></i></label></div></a>

        <a href="estimate/estimate.php"> <div class="details_categories" id="list_next">견적서 목록<label for="list_next"><i
                        class="fas fa-chevron-right"></i></label></div></a>
        <a href="chocoring/buy_ring.php"><div class="details_categories" id="ring_next">초코링 구매<label for="ring_next"><i
                        class="fas fa-chevron-right"></i></label></i></div></a>
        <a href="presentshop/presentshop.php"><div class="details_categories" id="gift_next">선물하기<label for="gift_next"><i
                        class="fas fa-chevron-right"></i></label></div></a>
        <a href="qna/qna_list.php"><div class="details_categories" id="qa_next">Q&A<label for="qa_next"><i class="fas fa-chevron-right"></i></label>
            </div></a>
    </div>

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
        <button>1:1문의하기</button>
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