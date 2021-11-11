<?php

require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
$myfile_save_dir = $_SERVER['DOCUMENT_ROOT']."/asset/uploadImg/certification/";

session_start();
$id=$_SESSION['user_id'];

$sql = "SELECT user_id, photo, major, residence, age, break_time, career, from member";   // member 정보

try {
    $result=mysqli_query($conn, $sql);

    $row= mysqli_fetch_array($result, MYSQLI_ASSOC);

    $user_id=$_POST['user_id'];
    $major=$_POST['mentor_dpt'];
    $residence=$_POST['mentor_add'];

    $age=$_POST['user_gender'];
    $break_time=$_POST['mentor_between_class'];
    $career=$_POST['career'];

    // 학생증, 자격증 보류
    $student_card=$_POST['student_card'];
    $license_card=$_POST['license_card'];

    $photo = "/asset/uploadImg/profile/";

    if ($_FILES["certification"]["name"] != "") {
        $query = "SELECT count(*) as cnt FROM certification WHERE user_id = '$user_id' ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        $name = $_FILES["certification"]["name"];
        $type = $_FILES["certification"]["type"];
        $size = $_FILES["certification"]["size"];
        $tmp_name = $_FILES["certification"]["tmp_name"];
        $error = $_FILES["certification"]["error"];
        $photo = "/asset/uploadImg/certification/" . $name;  //범기한테 물어보기
        //서버에 임시로 저장된 파일은 스크립트가 종료되면 사라지므로 파일을 이동해야함.
        $upload_result = move_uploaded_file($tmp_name, $myfile_save_dir . $name);
        if($upload_result){
            if ($row['cnt'] == 0){
                $sql = "INSERT INTO certification (user_id, type, img) VALUES ('$id','학생증', '$photo')";
            }else{
                $sql = "update certification set user_id='$id', type='학생증', img='$photo'";
            }
        }
    }
    if ($_FILES["certification_cr"]["name"] != "") {
        $query = "SELECT count(*) as cnt FROM certification WHERE user_id = '$id' ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        $name = $_FILES["certification_cr"]["name"];
        $type = $_FILES["certification_cr"]["type"];
        $size = $_FILES["certification_cr"]["size"];
        $tmp_name = $_FILES["certification_cr"]["tmp_name"];
        $error = $_FILES["certification_cr"]["error"];
        $photo = "/asset/uploadImg/certification/" . $name;  //범기한테 물어보기
        //서버에 임시로 저장된 파일은 스크립트가 종료되면 사라지므로 파일을 이동해야함.
        $upload_result = move_uploaded_file($tmp_name, $myfile_save_dir . $name);
        if($upload_result){
            $sql = "INSERT INTO certification (user_id, type, img) VALUES ('$id','자격증', '$photo')";
        }
    }

    $member = array(
        'user_id'=>$user_id,
        'mentor_dpt'=>$major,
        'mentor_add'=>$residence,
        'user_gender'=>$age,
        'mentor_between_class'=>$break_time,
        'career'=>$career,
        'photo'=>$photo
    );

    echo(jsonSuccess($member));

} catch (mysqli_sql_exception $e) {
    echo $e -> getMessage();
} catch(Exception $e) {
    //echo $e -> getMessage();
}
?>