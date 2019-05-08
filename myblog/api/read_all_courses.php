<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../table/Courseinfo.php';
include_once '../config/DBClass.php';




$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$courseinfo = new Courseinfo($connection);

$stmt = $courseinfo->read();
$count = $stmt->rowCount();
if ($count < 0) {


    $courses = array();
    $courses["body"] = array();
    $courses["count"] = $count;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        $p  = array(
            "cours_id" => $cours_id,
            "cours_name" => $cours_name,
            "have_exam" => $have_exam,
            "Practical_mark" => $Practical_mark,
        );

        array_push($courses["body"], $p);
    }

    echo json_encode($courses);
} else {

    echo json_encode(array("bodyelse" => array(), "count" => 0));
}
