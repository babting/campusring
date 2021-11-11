<!DOCTYPE html>
<html lang="kr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/styles.css">
  <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
  <script src="../js/main.js"></script>
  <title>초코링 구매페이지</title>
</head>

<body>
  <header class="hd_box">
    <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
    <div class="login_text">초코샵</div>
    <div class=""></div>
  </header>

  <div class="container">

    <div class="buy_top">
      <ul>
        <li><span><a href="buy_ring_backup20210923.php" target="_self">초코링구매</a></span></li>
        <li><a href="../chocoring/buy_history.php" target="_self">구매내역</a></li>
        <li><a href="../chocoring/buy_use.php" target="_self">사용내역</a></li>
      </ul>
    </div>

    <div class="buy_now">
      <img src="../img/ring.PNG" alt="현재보유 초코링">
      현재 보유한 초코링 <span class="buy_count">6개</span>

    </div>
    <div class="ring_text">
      <div class="buy_first">
        <img src="../img/ring.PNG" alt="초코"><span>초코 10개</span>
        <button type="submit">&#8361;1,200</button>
      </div>

      <div class="buy_first2">
        <img src="../img/ring.PNG" alt="초코"><span>초코 49개</span>
        <button type="submit">&#8361;5,900</button>
      </div>

      <div class="buy_first3">
        <img src="../img/ring.PNG" alt="초코"><span>초코 100개</span>
        <button onclick="javascript:btn()" type="submit">&#8361;12,000</button>
      </div>

      <div class="buy_first4">
        <img src="../img/ring.PNG" alt="초코"><span>초코 175개</span>
        <button type="submit">&#8361;21,000</button>
      </div>

      <div class="buy_first5">
        <img src="../img/ring.PNG" alt="초코"><span>초코 250개</span>
        <button type="submit">&#8361;30,000</button>
      </div>

      <div class="buy_first6">
        <img src="../img/ring.PNG" alt="초코"><span>초코 325개</span>
        <button type="submit">&#8361;39,000</button>
      </div>
    </div>
  </div>
</body>

</html>