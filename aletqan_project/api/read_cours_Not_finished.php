<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once __DIR__ . '/../../config.php';

include_once '../table/Real_cours.php';
include_once '../table/payment_teacher.php';
include_once '../config/DBClass.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$realcours = new Real_cours($connection);

$stmt = $realcours->readcorsenotfinished();
$count = $stmt->rowCount();
if ($count > 0) {


    $courses_not_finished = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);
        $cours_name = $DB->get_record_sql("SELECT `name` FROM `mdl_groups` WHERE `id`= " . $realcours_id);
        $subject_name = $DB->get_record_sql("SELECT `fullname` FROM `mdl_course` WHERE `id`= " . $cours_id);
        $payment_teacher = new payment_teacher($connection);
        $stmt = $payment_teacher->select_realcours_id($realcours_id);
        if ($st = $stmt->fetch(2)) {
            $payment_teacher = true;
        } else {
            $payment_teacher = false;
        }
        $p  = array(
            "cours_name" => $cours_name->name,
            "subject_name" => $subject_name->fullname,            
            "realcours_id" => $realcours_id,
            "cours_id" => $cours_id,
            "Teacher_id" => $Teacher_id,
            "start_date" => $start_date,
            "end_date" => $end_date,
            "price" => $price,
            "attendance_days" => $attendance_days,
            "payment_teacher" => $payment_teacher,
            
        );

        array_push($courses_not_finished, $p);
    }

    echo json_encode($courses_not_finished);
} else {

    echo json_encode(array("bodyelse" => array()));
}
