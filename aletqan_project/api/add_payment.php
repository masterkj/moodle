<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../lib/enrollib.php';
require_once __DIR__ . '/../../config.php';
require_once $CFG->dirroot . '/course/externallib.php';

if (
    !($user_id = empty($_POST['user_id'])) &&
    !($group_id = empty($_POST['group_id'])) &&
    !($course_id = empty($_POST['course_id'])) &&
    !($payment = empty($_POST['payment']))

) {
    $user_id = $_POST['user_id'];
    $group_id = $_POST['group_id'];
    $course_id = $_POST['course_id'];
    $payment = $_POST['payment'];
    add_payment($user_id, $group_id, $course_id, $payment);

} else {
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to create enroled. Data is incomplete."));

}
