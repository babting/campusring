<?php
/**
 * Created by PhpStorm.
 * User: Lsj
 * Date: 2021-09-29
 * Time: 오전 11:45
 */

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

session_start();

require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
header("Content-Type: application/json");   // php에서 json으로 주고 받을 때 header 값 셋팅

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX);    // mysql sql exception을 읽을 수 있도록 한다.

$id=$_SESSION['user_id'];

//$conn = mysqli_connect("server.waveon.biz", "campusring", "campusring", "campusring", 43307); // db 서버 접속

$sql = "SELECT date, amounts, rest, cost, way FROM choco where user_id='$id' and kinds='pay' order by date DESC";

try {
    $result=mysqli_query($conn, $sql);

    $dataList = array();

    while($row= mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        array_push($dataList, array(
            "date" => $row["date"],
            "cost"=> $row["cost"],
            "rest"=> $row["rest"],
            "amounts"=> $row["amounts"],
            "way"=> $row["way"],));
    }
    echo(jsonSuccess($dataList));

} catch (mysqli_sql_exception $e) {
    echo $e -> getMessage();
} catch(Exception $e) {
}

mysqli_close($conn);
?>