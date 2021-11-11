<?php
/**
 * Created by PhpStorm.
 * User: Lsj
 * Date: 2021-09-23
 * Time: 오후 3:08
 */

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';
session_start();

require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
header("Content-Type: application/json");   // php에서 json으로 주고 받을 때 header 값 셋팅

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX);    // mysql sql exception을 읽을 수 있도록 한다.

$id=$_SESSION['user_id'];

$sql = "SELECT 
            e_item, e_date
        FROM match_class
        where user_id = '{$id}'";

try {

    $result=mysqli_query($conn, $sql);

    $row= mysqli_fetch_array($result, MYSQLI_ASSOC);

    $e_item= $row['e_item'];
    $e_date= $row['e_date'];

    $estimate = array(
        'e_item'=>$e_item,
        'e_date'=>$e_date
    );

    echo(jsonSuccess($estimate));

} catch (mysqli_sql_exception $e) {
    echo $e -> getMessage();
} catch (Exception $e) {
    echo $e -> getMessage();
}

mysqli_close($conn);
?>
