<script>
    $('.btn-menu').click(function () {
        $('.ui.sidebar').sidebar('setting', 'transition', 'overlay')
            .sidebar('toggle');
    })
</script>
<div style="margin: 7rem"></div>
<nav class="container nav">
    <ul class="nav__list">
        <li class="nav_btn">
            <a class="nav__link" href="/index.php"><img class="home" src="/img/c_home.PNG" alt="home"></a>
        </li>
        <a class="nav__link" href="/chatBk/chat_list.php">
            <?php
            if (@$_SESSION['user_id'] != ""){
                $user_id = $_SESSION['user_id'];
                $sqlChat = "SELECT * FROM chatlist WHERE sendto = '$user_id' AND readYN = 'N' ";
                $resultChat = mysqli_query($conn, $sqlChat);
                $rowChat = mysqli_num_rows($resultChat);
                if ($rowChat > 0){
                    ?>
                    <span class="nav__notification badge"><?=$rowChat?></span>
                    <?php
                }}
            ?>
            <i class="far fa-comment fa-2x"></i></a>
        <li class="nav_btn"><a class="nav__link" href="/estimate/estimate_list.php"><i class="far fa-sticky-note fa-2x"></i></a></li>
        <li class="nav_btn"><a class="nav__link" href="/member/mypage.php"><i class="far fa-user fa-2x"></i></a></li>
        <li class="nav_btn"><a class="nav__link" href="/map/map_select.php"><i class="fas fa-map-marker-alt fa-2x"></i></a></li>
    </ul>
</nav>