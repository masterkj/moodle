<?php
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: GET");

include_once '../table/Real_cours.php';
include_once '../config/DBClass.php';




$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$realcours = new Real_cours($connection);

$stmt = $realcours->readcorsenotfinished();
$count = $stmt->rowCount();
if ($count > 0) {


    $courses_not_finished = array();
    $courses_not_finished["body"] = array();
    $courses_not_finished["count"] = $count;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        $p  = array(
            "realcours_id" => $realcours_id,
            "cours_id" => $cours_id,
            "Teacher_id" => $Teacher_id,
            "start_date" => $start_date,
            "end_date" => $end_date,
            "price" => $price,
            "attendance_days" => $attendance_days,
        );

        array_push($courses_not_finished["body"], $p);
    }

    echo json_encode($courses_not_finished);
} else {

    echo json_encode(array("bodyelse" => array(), "count" => 0));
}
