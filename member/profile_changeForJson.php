<?php
/**
 * Created by PhpStorm.
 * User: LSJ
 * Date: 2021-09-23
 * Time: 오후 4:00
 */

require("../jsonUtil.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
session_start();

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX);
$myfile_save_dir = $_SERVER['DOCUMENT_ROOT']."/asset/uploadImg/profile/";
//email: $email,
//            category1: category1,
//            second_category: second_category,
//            third_category: third_category,
//            ch_pw: ch_pw,

//print_r($_FILES);

$id=$_SESSION['user_id'];
$password=$_POST['ch_pw'];
$email=$_POST['email'];
$one_category=$_POST['category1'];
$second_category=$_POST['second_category'];
$third_category=$_POST['third_category'];
$ch_pw=$_POST['ch_pw'];


if ($_FILES["profile"]["name"] != "") {
    $name = $_FILES["profile"]["name"];
    $type = $_FILES["profile"]["type"];
    $size = $_FILES["profile"]["size"];
    $tmp_name = $_FILES["profile"]["tmp_name"];
    $error = $_FILES["profile"]["error"];
    $photo = "/asset/uploadImg/profile/" . $name;  //범기한테 물어보기
    //서버에 임시로 저장된 파일은 스크립트가 종료되면 사라지므로 파일을 이동해야함.
    $upload_result = move_uploaded_file($tmp_name, $myfile_save_dir . $name);
    if($upload_result){
        $sql = "update member set photo='$photo',  password='$password', cate1='$one_category', cate2='$second_category', cate3='$third_category', email='$email' where user_id='$id'";
        if(!$conn->query($sql))
            $status = "DB_Fail";
        $status = "첨부된 파일이 없습니다. 다시 시도해 주세요.";
    }
}else{
    $sql = "update member set password='$password', cate1='$one_category', cate2='$second_category', cate3='$third_category', email='$email' where user_id='$id'";
    if(!$conn->query($sql))
        $status = "DB_Fail";
    $status = "첨부된 파일이 없습니다. 다시 시도해 주세요.";
}

echo(json_encode(array("result" => $status)));
mysqli_close($conn);
?>
