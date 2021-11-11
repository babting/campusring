<?php
/**
 * Created by PhpStorm.
 * User: LSJ
 * Date: 2021-09-23
 * Time: 오후 4:00
 */
session_start();
require("../jsonUtil.php");
header("Content-Type: application/json");
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX);

$id=$_SESSION['user_id'];
$title=$_POST['title'];
$big_cate=$_POST['leup_big_cate'];
$small_cate=$_POST['sebu'];
//$sel_pay=$_POST['sel_pay'];
$checkValue = $_POST['edit_write_check'];

$period=$_POST['period'];
if(isset($_POST["period"])){
    $period=implode(', ',$_POST["period"]);
}

$time=$_POST['les_time'];
$place=$_POST['leup_place'];
$day_week=$_POST['week'];
if(isset($_POST["week"])){
    $day_week=implode(', ',$_POST["week"]);
}

//$input_file=$_POST['input_file'];
//$input_video=$_POST['input_video'];
$leup_context=$_POST['leup_context'];
$payment_info=$_POST['payment_info'];

//echo $title."<br>";
//echo $big_cate."<br>";
//echo $small_cate[0]."<br>";
//echo $period."<br>";
//echo $time."<br>";
//echo $place."<br>";
//echo $day_week."<br>";
//echo $payment_info."<br>";
//echo $leup_context."<br>";


//echo(json_encode(array(
//    "title" => $title,
//    "leup_big_cate" => $big_cate,
//    "sebu" => $small_cate,
//    "sel_pay" => $sel_pay,
//    "period" => $period,
//    "les_time" => $time,
//    "leup_place" => $place,
//    "week" => $day_week,
//    "leup_context" => $leup_context,
//    "payment_info" => $payment_info,
//    )
//));
//
//return;

try {
    if($_FILES["input_file"]["name"] != "" or $_FILES["input_video"]["name"] != ""){
        $myfile_save_dir = $_SERVER['DOCUMENT_ROOT']."/asset/uploadImg/thumbnail/";
        if ($_FILES["input_file"]["name"] != "") {
            $name = $_FILES["input_file"]["name"];
            $type = $_FILES["input_file"]["type"];
            $size = $_FILES["input_file"]["size"];
            $tmp_name = $_FILES["input_file"]["tmp_name"];
            $error = $_FILES["input_file"]["error"];
            $photo = "/asset/uploadImg/thumbnail/" . $name;
            $upload_result = move_uploaded_file($tmp_name, $myfile_save_dir . $name);
            if ($upload_result) {
                $sql = "INSERT INTO class (big_cate, small_cate, place, period, time, 
                       day_week, thumbnail, context, keyword, user_id, title) 
                       VALUES ('$big_cate', '$small_cate[0]', '$place', '$sel_pay.$period', '$time','$day_week',
                               '$photo', '$leup_context', 'dd', '$id','$title')";

                if (!$conn->query($sql)){
                    $status = "첨부된 섬네일이 없습니다. 다시 시도해 주세요.";
                    echo(json_encode(array("result" => $status)));
                    return;
                    exit();
                }
            }
        }
        $myfile_save_dir = $_SERVER['DOCUMENT_ROOT']."/asset/uploadImg/video/";
        if($_FILES["input_video"]["name"] != ""){
            $name = $_FILES["input_video"]["name"];
            $type = $_FILES["input_video"]["type"];
            $size = $_FILES["input_video"]["size"];
            $tmp_name = $_FILES["input_video"]["tmp_name"];
            $error = $_FILES["input_video"]["error"];
            $photo = "/asset/uploadImg/video/" . $name;
            $upload_result = move_uploaded_file($tmp_name, $myfile_save_dir . $name);
            if($upload_result){
                $sql = "update class set video='$photo' where user_id='$id' and title='$title' and context='$leup_context'";
                if(!$conn->query($sql)) {
                    $status = "첨부된 영상이 없습니다. 다시 시도해 주세요.";
                    echo(json_encode(array("result" => $status)));
                    return;
                    exit();
                }
            }
        }
    }else{
        if ($checkValue == "0"){
            $sql = "INSERT INTO class (big_cate, small_cate, place, period, time, 
                   day_week, context, keyword, user_id, title) 
                   VALUES ('$big_cate', '$small_cate[0]', '$place', '$period', '$time','$day_week',
                           '$leup_context', 'dd', '$id','$title')";
        }else{
            $sql = "UPDATE class SET big_cate = '$big_cate', small_cate = '$small_cate', place='$place', period = '$period',";
            $sql.= " day_week='$day_week', context = '$leup_context', title = '$title' '";
            $sql.= " WHERE user_id = '$id' ";
        }

        if(!$conn->query($sql)) {
            $status = "강의 등록에 실패했습니다. 다시 시도해 주세요.";
            echo(json_encode(array("result" => $status)));
            return;
            exit();
        }
    }
} catch (mysqli_sql_exception $e) {
    echo $e -> getMessage();
} catch (Exception $e) {
    echo $e -> getMessage();
}

echo(json_encode(array("result" => true)));
mysqli_close($conn);
?>
