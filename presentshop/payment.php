<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/change.js"></script>
    <title>결제</title>

</head>

<body>
<form action="">
    <header class="hd_box">
        <div class="btn_prev"><a href="../login.php"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></a>
        </div>
        <div class="login_text">결제</div>
        <div class=""></div>
    </header>
    <div class="container">
        <div class="container_bg">
            <div class="select">
                <div class="payment_icon">
                    <div class="payment_infomation">강의 정보</div>
                </div>
                <div class="payment_info">
                    <p>강의</p>
                    <div>프로그래밍 맛보기</div>
                </div>
            </div>
            <div class="mentor_person">
                <span>멘토 정보</span>
                <div class="mentor_person_info">
                    <div>이화진</div>
                    <div>010-6533-9833</div>
                </div>
            </div>
            <div class="mentee_person">
                <span>멘티 정보</span>
                <div class="mentee_person_info">
                    <div>안수철</div>
                    <div>010-8131-2689</div>
                </div>
            </div>
            <div class="mentee_person">
                <span>가격</span>
                <div class="mentee_person_info">
                    <div>10,000원</div>

                </div>
            </div>
            <div class="choose_payment">
                <div class="choose_payment_quoin">
                    <div class="choose_payment_header">
                        <div class="choose_payment_sort">
                            <div class="choose_payment_title">결제 수단 선택</div>
                            <div id="ch_pay">결제수단</div>
                        </div>
                        <p>은행 점검시간인 23:00~00:30 까지 이용 불가한 계좌이체 결제수단이 포함되어 있습니다.</p>
                    </div>

                    <div class="payment_sort">
                        <div class="naverpay">
                            <input type="radio" id="n_pay" name="pay_chk">
                            <img src="../img/naver.png" alt="네이버페이"> 네이버페이
                        </div>
                        <div class="kakaopay">
                            <input type="radio" name="pay_chk" id="k_pay">
                            <img src="../img/kakao.png" alt="카카오페이"></i>카카오페이
                        </div>
                        <div class="cardpay">
                            <input type="radio" name="pay_chk" id="card">
                            <img src="../img/card.png" alt=""> 카드
                        </div>
                        <div class="accountpay">
                            <input type="radio" name="pay_chk" id="account">
                            <img src="../img/account.png" alt=""> 계좌이체
                        </div>
                        <div class="chocoringpay">
                            <input type="radio" name="pay_chk" id="ch_ring">
                            <img src="../img/ring.PNG" alt="초코링">초코링
                        </div>
                    </div>

                </div>
                <button type="submit">결제하기</button>
            </div>
        </div>
    </div>
</form>
</body>
<script>

    $(document).ready(function(){
        $("input:radio[id='n_pay']").click(function()
        {
            $('#ch_pay').html(' <div id="ch_pay">네이버페이</div>');
        })
        $("input:radio[id='k_pay']").click(function()
        {
            $('#ch_pay').html(' <div id="ch_pay">카카오페이</div>');
        })
        $("input:radio[id='card']").click(function()
        {
            $('#ch_pay').html(' <div id="ch_pay">카드</div>');
        })
        $("input:radio[id='account']").click(function()
        {
            $('#ch_pay').html(' <div id="ch_pay">계좌이체</div>');
        })
        $("input:radio[id='ch_ring']").click(function()
        {
            $('#ch_pay').html(' <div id="ch_pay">초코링</div>');
        })

    })

</script>
</html>