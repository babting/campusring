<?php
/**
 * Created by PhpStorm.
 * User: BK
 * Date: 2021-09-17
 * Time: 오후 11:08
 */

require("../jsonUtil.php");    // json으로 보낼 때 코드가 길어져서 jsonUtil.php로 뺌.
header("Content-Type: application/json");   // php에서 json으로 주고 받을 때 header 값 셋팅
include_once $_SERVER['DOCUMENT_ROOT'].'/DB/dbconn.php';

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX);

// 원래 백단에서도 NULL Check는 한번 더 하는게 좋습니다.

$id = $_POST['m_id'];
$passwd = $_POST['m_pw'];
$name = $_POST['m_name'];
$univ = $_POST['m_be'];
$year = $_POST['m_yy'];
$month = $_POST['m_mm'];
$date = $_POST['m_dd'];
$pNum1 = $_POST['m_ph1'];
$pNum2 = $_POST['m_ph2'];
$cate1 = $_POST['m_cate1'];
$cate2 = $_POST['m_cate2'];
$cate3 = $_POST['m_cate3'];
$email = $_POST['m_be'];

$gender=$_POST['gender'];

$birth = $year."-".$month."-".$date;
$pNum = $pNum1.$pNum2;


//$query = "insert into member (id, password, birthday, pNum, name, sex, cate1, cate2, cate3)";
//$query = $query."values('$id','$passwd','$birth','$pNum','$name','$gender','$cate1','$cate2','$cate3')";

//$query = "INSERT INTO member (user_id, sort, password, photo, birthday, pNum, name, sex, residence, cate1, cate2, cate3, choco, ment, email, major,  age, break_time, career, level, regdate) ";
//$query .= " VALUES('$id', 'sort','$passwd','photo','$birth','$pNum','$name','여','residence','$cate1','$cate2','$cate3', 0, 0,'$email', 'major', 20,'2021-08-02 21:17:57','career', 1, now() ) ";

//$query = "INSERT INTO member (user_id, password, photo, birthday, pNum, name, sex, residence, cate1, cate2, cate3, choco, ment, email, major,  age, break_time, career, level, regdate) ";
//$query .= " VALUES('$id', '$passwd','','$birth','$pNum','$name', $gender,'','$cate1','$cate2','$cate3', '', '','$email', '', '','','', '', now() ) ";

//echo $query;

try {
    $query = "insert into member (user_id, password, birthday, pNum, name, sex, cate1, cate2, cate3, email)";
    $query = $query."values('$id','$passwd','$birth','$pNum','$name','$gender','$cate1','$cate2','$cate3','$email')";

    if ($conn-> query($query)) {
        echo(jsonSuccess());
    }

} catch (mysqli_sql_exception $e) {
    echo $e -> getMessage();
} catch (Exception $e) {
    echo $e -> getMessage();
}

//$result = mysqli_query($conn, $query);

//echo $query;
//exit;

//if($result === false){
//    echo(json_encode(array("result" => "DB_ERROR")));
//}else{
//    echo(json_encode(array("result" => "success")));
//}


mysqli_close($conn);
?>