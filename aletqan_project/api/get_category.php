<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");include_once '../table/Student_payment.php';


require_once(__DIR__.'/../../config.php');

require_once($CFG->dirroot.'/course/lib.php');

$categories= $DB->get_records('course_categories');

echo json_encode($categories);
