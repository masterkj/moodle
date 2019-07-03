<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../table/Student_payment.php';
include_once '../config/DBClass.php';
require_once __DIR__ . '/../../config.php';
require_once $CFG->dirroot . '/course/externallib.php';



$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$student_payment = new Student_payment($connection);
$stmt = $student_payment->Remaining_Student_Amount($_POST['student_id'] , $_POST['realcours_id']);
$st = $stmt->fetchall(2);

$Remaining_Student_Amount = json_encode($st);
echo $Remaining_Student_Amount;
