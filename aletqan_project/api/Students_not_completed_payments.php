<?php
header("Content-Type: application/json; charset=UTF-8");
include_once '../table/Student_payment.php';
include_once '../config/DBClass.php';
require_once __DIR__ . '/../../config.php';
require_once $CFG->dirroot . '/course/externallib.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$student_payment = new Student_payment($connection);
$stmt = $student_payment->not_completed_payment_query();
$st = $stmt->fetchall(2);
$student_opject = json_decode(json_encode($st));
$user = $DB->get_record_sql("SELECT `firstname`,`lastname`,`email`,`username`,`phone1`,`phone2`,`city` FROM `mdl_user` WHERE `id`= 1 ");
$i = 0;
while ($i < sizeof($student_opject)) {
    $user = $DB->get_record_sql("SELECT `firstname`,`lastname`,`email`,`username`,`phone1`,`phone2`,`city` FROM `mdl_user` WHERE `id`= " . $student_opject[$i]->student_id);
    $student_opject[$i]->firstname = $user->firstname;
    $student_opject[$i]->lastname = $user->lastname;
    $student_opject[$i]->email = $user->email;
    $student_opject[$i]->username = $user->username;
    $student_opject[$i]->phone1 = $user->phone1;
    $student_opject[$i]->phone2 = $user->phone2;
    $student_opject[$i]->city = $user->city;

    $i = $i + 1;

}
$student_not_payment = json_encode($student_opject);
echo $student_not_payment;
