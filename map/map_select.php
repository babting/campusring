<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/loginconn.php';

$user_id = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://kit.fontawesome.com/a9eb1f10be.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>카테고리별 장소 검색하기</title>
</head>

<body>
<div class="container">
    <header class="hd_box">
        <div class="btn_prev"><i class="fas fa-angle-left fa-3x" onClick="history.go(-1);"></i></div>
        <div class="login_text">멘토 선택</div>
        <div class=""></div>
    </header>
    <div>
        <div class="map_sel_hd">
            <!-- <p>지도에 보일 멘토를 선택해주세요.</p> -->
            <input type="checkbox" id="chk_all">
            <label for="chk_all">모두선택</label>
        </div>
        <form method="post" name="mapSelectForm" action="./map.php" >
            <?php
            $sql = "SELECT location.latitude, location.longitude, member.name, member.photo, location.user_id";
            $sql.= " FROM location JOIN member ON location.user_id = member.user_id";
            $sql.= " WHERE location.user_id = (select user_id from match_class where match_class.state_nm  = '매칭수락' AND match_class.user_id = member.user_id limit 0,1) ORDER BY FIELD(member.user_id, '$user_id') DESC";

//            echo $sql;
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                //수철이 안나오게 하려고 아래줄 추가함 (시연영상)
                if ($row['user_id']=="qwe0714"){continue;}
                ?>
                <div class="map_sel_chb">
                    <div class="map_sel_chk_sort">
                        <input type="checkbox"  name="checkRow[]" value="<?=$row['user_id']?>" onclick="clickChkBox(this)">
                        <div class="map_sel_img_sort">
                            <?php
                            if ($row['photo'] != ""){
                                echo "<img src=".$row['photo'].">";
                            }
                            ?>
                        </div>
                        <div class="map_sel_me_cont">
                            <label for="map_me_name"><?=$row['name']?></label>
                            <p>MENTO</p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </form>
    </div>
    <div class="map_sel_btn">
        <button onclick="map_btn();">선택</button>
        <button onClick="history.go(-1);">취소</button>
    </div>
    <!-- 하단바 -->
    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>

    <!--하단바끝 -->
</div>

<script>
    /*checkbox 전체선택*/
    $(document).ready(function () {
        $("#chk_all").click(function () {
            if ($("#chk_all").is(':checked')) {
                $("input[name='checkRow[]']").prop("checked", true);
            } else {
                $("input[name='checkRow[]']").prop("checked", false);
            }
        });

    });

    function map_btn() {
        var chkArray = new Array();

        $("input[name='checkRow[]']:checked").each(function () {
            var tmpVal = $(this).val();
            chkArray.push(tmpVal);
        });

        if (chkArray.length < 1) {
            alert("멘토를 선택해주세요.");
            return false;
        }else {
            $("form:first").submit();
        }
    }


    function clickChkBox() {
        let $checkRow = $('input:checkbox[name="checkRow[]"]');
        let $checkedRow = $('input:checkbox[name="checkRow[]"]:checked');

        if ($checkRow.length === $checkedRow.length) {
            $("#chk_all").prop("checked", true);
        } else {
            $("#chk_all").prop("checked", false);
        }
    }


</script>
</body>

</html>