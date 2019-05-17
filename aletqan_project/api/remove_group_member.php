<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once(__DIR__ . '/../../../config.php'); 
require_once($CFG->dirroot.'/enrol/locallib.php');
$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$locallib   =new course_enrolment_manager($modelpage,$course);
$remove_member=$locallib-> remove_user_from_group($group, $user);
//$remove_member_opject=json_decode ( json_encode($remove_member) );
//$remove_member= json_encode($remove_member_opject );

