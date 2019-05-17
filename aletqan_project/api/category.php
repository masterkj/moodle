<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once(__DIR__ . '/../../../config.php'); 
require_once($CFG->dirroot.'/course/externallib.php');
$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$external   =new core_course_external();
$create_category=$external->create_categories($categories);
//$courses_opject=json_decode ( json_encode($create_category) );

