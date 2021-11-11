
<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="../js/main.js"></script>
    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>

    <!--jquery ajax-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> <!-- ajax를 사용하기 위해 jquery cdn으로 불러옴. -->
    <!-- iamport.payment.js -->
    <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.2.0.js"></script>
    <title>초코링 구매페이지</title>
</head>

<body>
<header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onclick="location.href='/index.php'"></i></div>
    <div class="login_text">초코샵</div>
    <div class=""></div>
</header>

<div class="container">

    <div class="buy_top">
        <ul>
            <li><span><a>초코링구매</a></span></li>
            <li><a href="../chocoring/buy_history.php" target="_self">구매내역</a></li>
            <li><a href="../chocoring/buy_use.php" target="_self">사용내역</a></li>
        </ul>
    </div>
    <?php
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT choco FROM member where user_id='$user_id'";
    $re = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($re);
    ?>
    <div class="buy_now">
        <img src="../img/ring.PNG" alt="현재보유 초코링">
        현재 보유한 초코링 <span class="buy_count"><?= $row['choco']?>개</span>

    </div>
    <div class="ring_text">
        <div class="buy_first" data-chocoamount="10" data-chococost="1200">
            <img src="../img/ring.PNG" alt="초코"><span>초코 10개</span>
            <button type="submit">&#8361;1,200</button>
        </div>

        <div class="buy_first" data-chocoamount = "49" data-chococost = "5900">
            <img src="../img/ring.PNG" alt="초코"><span>초코 49개</span>
            <button type="submit">&#8361;5,900</button>
        </div>

        <div class="buy_first" data-chocoamount = "100" data-chococost = "12000">
            <img src="../img/ring.PNG" alt="초코"><span>초코 100개</span>
            <button onclick="javascript:btn()" type="submit">&#8361;12,000</button>
        </div>

        <div class="buy_first" data-chocoamount = "175" data-chococost = "21000">
            <img src="../img/ring.PNG" alt="초코"><span>초코 175개</span>
            <button type="submit">&#8361;21,000</button>
        </div>

        <div class="buy_first" data-chocoamount = "250" data-chococost = "30000">
            <img src="../img/ring.PNG" alt="초코"><span>초코 250개</span>
            <button type="submit">&#8361;30,000</button>
        </div>

        <div class="buy_first" data-chocoamount = "325" data-chococost = "39000">
            <img src="../img/ring.PNG" alt="초코"><span>초코 325개</span>
            <button type="submit">&#8361;39,000</button>
        </div>
        <div class="buy_first2">
            <button type="button" style="position: relative;" onclick="requestPay();">초코링 구매하기</button>
        </div>
    </div>
    <form name="chocoPay" method="post">
        <input type="hidden" name="chocoamount" id="chocoamount" value="">
        <input type="hidden" name="chococost" id="chococost" value="">
        <?php
        $memberQuery = "SELECT * FROM member WHERE user_id = '$user_id' ";
        $memberResult = mysqli_query($conn,$memberQuery);
        $memberRow = mysqli_fetch_array($memberResult);
        ?>
        <input type="hidden" name="member_email" id="member_email" value="<?=$memberRow['email']?>">
        <input type="hidden" name="member_name" id="member_name" value="<?=$memberRow['name']?>">
        <input type="hidden" name="member_tel" id="member_tel" value="<?=$memberRow['pNum']?>">
    </form>
    <!-- 하단바 -->
    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>

    <!--하단바끝 -->
</div>
</body>
<script>
    const IMP = window.IMP; // 생략 가능
    IMP.init("imp38726180"); // Example: imp00000000

    function requestPay() {
        let chocoCost = $('#chococost').val();
        let chocoAmount = $('#chocoamount').val();
        let productName = "초코 " + chocoAmount + "개";
        let member_email = $('#member_email').val();
        let member_name = $('#member_name').val();
        let member_tel = $('#member_tel').val();

        
        if (chocoCost == "" || chocoAmount == ""){
            alert("구매할 수량을 선택하세요");
        }else{
            // IMP.request_pay(param, callback) 결제창 호출
            IMP.request_pay({
                pg : 'html5_inicis',
                pay_method : 'card',
                merchant_uid: '<?=$user_id?>' +  new Date().getTime(), //상점에서 생성한 고유 주문번호
                name : '주문명:' + productName,
                amount : chocoCost,
                buyer_email : member_email,
                buyer_name : member_name,
                buyer_tel : member_tel,
                buyer_addr : '인터넷결제',
                buyer_postcode : '123-456',
            }, function(rsp) {
                if ( rsp.success ) {
                    var chocoData = {
                        user_id : '<?=$user_id?>',
                        pay_method : 'card',
                        amount : chocoAmount,
                        cost : chocoCost,
                        buyer_email : member_email,
                        buyer_name : member_name,
                        buyer_tel : member_tel,
                    }
                    $.ajax({
                        type: 'post',           // http type 정의 ["GET", "POST"] --> <form> 태그의 method attribute 맞습니다.
                        dataType: 'json',           // 응답받을 데이터 타입 json으로 정의 --> ("html", "xml", "json", "text", "jsonp") 등이 있습니다.
                        url: '/chocoring/chocoringBuy.php', // 샘플상으로 loginForJson.php 만들어서 했습니다. ajax로 동적 데이터 처리할 때 참고하시면 될것같습니다.
                        data: chocoData,          // url로 전송할 데이터 정의
                        success: function(data) {
                            if (data.result == "success"){
                                alert("결제 완료되었습니다.");
                                location.href='/chocoring/buy_history.php';
                            }else {
                                alert("문제가 발생했습니다. \n Error CODE: " + data.result );
                            }
                        },
                        error: function (request, status, error) {
                            console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
                        }
                    });
                }else{
                    //결제 시작 페이지로 리디렉션되기 전에 오류가 난 경우
                    var msg = '오류로 인하여 결제가 시작되지 못하였습니다.';
                    msg += '에러내용 : ' + rsp.error_msg;
                }
            });
        }
    }
    $('.buy_first').click(function (){
       let amount = $(this).data('chocoamount');
       let cost = $(this).data('chococost');
       $('#chocoamount').val(amount);
       $('#chococost').val(cost);
       $('.buy_first').css('background-color', '#fff');
       $(this).css('background-color', 'rgba(255, 255, 128, .5)');
    });

</script>

</html>