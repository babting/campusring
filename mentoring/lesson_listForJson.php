<?php
/**
 * Created by PhpStorm.
 * User: lsj
 * Date: 2021-09-23
 * Time: 오후 6:00
 */

include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
header("Content-Type: application/json");   // php에서 json으로 주고 받을 때 header 값 셋팅


mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX);

$cate=$_POST['lesson_id'];

$sql = "SELECT 
            title, context, keyword, (select name from member where user_id = class.user_id) AS name, id
        FROM class
        where big_cate LIKE '%$cate%' or small_cate LIKE '%$cate%'";        // member 정보

try {
    $result=mysqli_query($conn, $sql);

    $dataList = array();

    while($row= mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        array_push($dataList, array(
            "name" => $row["name"],
            "title"=> $row["title"],
            "context" => $row["context"],
            "keyword" => $row["keyword"],
            "id" => $row['id']
            ));
    }

//if($conn->query($select_member_query)){
    echo(jsonSuccess($dataList));
//} else {
//    echo(jsonFailure("정보를 가져오는데 실패하였습니다.", 409, mysqli_error($conn))); // jsonUtil.php 에 있는 jsonFailure() 메소드 사용. --> message와 code를 동적으로 할당
//}
} catch (mysqli_sql_exception $e) {
    echo $e -> getMessage();
} catch(Exception $e) {
    //echo $e -> getMessage();
}
?>
