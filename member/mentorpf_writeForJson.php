<?php
/*
* Created by PhpStorm.
* User: Babting
* Date: 2021-09-27
* Time: 오후 4:40
*/
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

session_start();

require("../jsonUtil.php");
$myfile_save_dir = $_SERVER['DOCUMENT_ROOT']."/asset/uploadImg/certification/";

$id=$_SESSION['user_id'];
$residence=$_POST['residence'];
$major=$_POST['major'];
$age=$_POST['age'];
$break_time=$_POST['break_time'];
$career=$_POST['career'];


if ($_FILES["certification"]["name"] != "") {
    $query = "SELECT count(*) as cnt FROM certification WHERE user_id = '$id' ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    $name = $_FILES["certification"]["name"];
    $type = $_FILES["certification"]["type"];
    $size = $_FILES["certification"]["size"];
    $tmp_name = $_FILES["certification"]["tmp_name"];
    $error = $_FILES["certification"]["error"];
    $photo = "/asset/uploadImg/certification/" . $name;
    //서버에 임시로 저장된 파일은 스크립트가 종료되면 사라지므로 파일을 이동해야함.
    $upload_result = move_uploaded_file($tmp_name, $myfile_save_dir . $name);
    if($upload_result){
        if ($row['cnt'] == 0){
            $sql = "INSERT INTO certification (user_id, type, img) VALUES ('$id','학생증', '$photo')";
        }else{
            $sql = "update certification set user_id='$id', type='학생증', img='$photo'";
        }
        if(!$conn->query($sql))
            $status = "DB_Fail";
        $status = "첨부된 파일이 없습니다. 다시 시도해 주세요.";
    }
}
if ($_FILES["certification_cr"]["name"] != "") {
    foreach ($_FILES['certification_cr']['name'] as $f => $name) {
        if ($_FILES["certification_cr"]["name"] != "") {
            $name = $_FILES["certification_cr"]["name"][$f];
            $type = $_FILES["certification_cr"]["type"][$f];
            $size = $_FILES["certification_cr"]["size"][$f];
            $tmp_name = $_FILES["certification_cr"]["tmp_name"][$f];
            $error = $_FILES["certification_cr"]["error"][$f];
            $photo = "/asset/uploadImg/certification/" . $name;
            //서버에 임시로 저장된 파일은 스크립트가 종료되면 사라지므로 파일을 이동해야함.
            $upload_result = move_uploaded_file($tmp_name, $myfile_save_dir . $name);
            if ($upload_result) {
                $sql = "INSERT INTO certification (user_id, type, img) VALUES ('$id','자격증', '$photo')";

                if (!$conn->query($sql))
                    $status = "DB_Fail";
                $status = "첨부된 파일이 없습니다. 다시 시도해 주세요.";
            }
        }
    }
}

try {
    $sql = "update member set residence='$residence', major='$major', age='$age', break_time='$break_time', career='$career'
            where user_id = '{$id}'";

    if($conn->query($sql)){
        echo(jsonSuccess());
    }
} catch (mysqli_sql_exception $e) {
    echo $e -> getMessage();
} catch (Exception $e) {
    echo $e -> getMessage();
}



?>
