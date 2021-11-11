<?php
session_start();
$user_id = $_SESSION['user_id'];

if(!$_GET['date'])
{
    //처음 채팅방에 들어왔을때 기간 설정
    $timestamp = strtotime("-1 week");
    $_GET['date'] = date("Y-m-d H:i:s", $timestamp)."<br/>";

}
$db = new mysqli('114.201.140.12', 'campusring', 'campusring', 'campusring', '43307');
$db->query('SET NAMES utf8');
$db->query('UPDATE chatlist set readYN = "Y" WHERE sendto = "'.$user_id .'" AND board = "' . $_GET['board'] . '"');
$res = $db->query('SELECT *,(select photo from member where member.user_id = chatlist.name limit 0, 1) as myPhoto,
  (select photo from member where member.user_id = chatlist.name limit 0, 1) as youPhoto FROM chatlist WHERE date > "' . $_GET['date'] . '" AND board = "' . $_GET['board'] . '"');
$data = array();
$date = $_GET['date'];

while($v = $res->fetch_array(MYSQLI_ASSOC))
{
    $data[] = $v;
    $date = $v['date'];
}

echo json_encode(array('date' => $date, 'data' => $data));
?>