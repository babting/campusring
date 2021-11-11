<?php

session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
// mysql sql exception을 읽을 수 있도록 한다.

$user_id=$_SESSION['user_id'];
$mentoId=$_POST['id'];

$date = date("Y-m-d H:i:s");
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < 8 ; $i++) {
    $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
}
$board = "";
$sql = "select board from chatroomlist where user_id = '$user_id' ";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
if ($count > 0){
    while ($row = mysqli_fetch_array($result)){
        $mentorCheckSQL = "SELECT * FROM chatroomlist WHERE board = '{$row['board']}'  AND user_id = '$mentoId' ";
        $mentorCheckResult = mysqli_query($conn, $mentorCheckSQL);
        $mentorCount = mysqli_num_rows($mentorCheckResult);
        if ($mentorCount > 0 ){
               $board = $row['board'];
            }
        }
}
if ($board == ""){
    $board = $randomString;
    $newChatroomSQL1 = "INSERT INTO chatroomlist (board, user_id, room_name, regdate) VALUES ('$board', '$user_id', 'CampusRoom', '$date' ) ";
    $newChatroomSQL2 = "INSERT INTO chatroomlist (board, user_id, room_name, regdate) VALUES ('$board', '$mentoId', 'CampusRoom', '$date' ) ";
    $newresult1 = mysqli_query($conn, $newChatroomSQL1);
    $newresult2 = mysqli_query($conn, $newChatroomSQL2);
    if (!$newresult1 || !$newresult2){
        $board = "ERROR";
    }
}

echo(json_encode(array("result" => $board)));


?>