<?php
session_start();
$user_id = $_SESSION['user_id'];
$db = new mysqli('114.201.140.12', 'campusring', 'campusring', 'campusring', '43307');
$query = "SELECT user_id FROM chatroomlist WHERE user_id != '$user_id' AND board = '".$_POST['board']."' ";
$res = $db->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$to = $row['user_id'];
$db->query('SET NAMES utf8');
$db->query('
	INSERT INTO chatlist(name, msg, sendto, board, date)
	VALUES(
		"' . $db->real_escape_string($_POST['name']) . '",
		"' . $db->real_escape_string($_POST['msg']) . '",
		"' . $to . '",
		"' . $db->real_escape_string($_POST['board']) . '",
		NOW()
	)
');
?>