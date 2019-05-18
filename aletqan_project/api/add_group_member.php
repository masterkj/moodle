<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once(__DIR__ . '/../../../config.php'); 
require_once($CFG->dirroot.'/enrol/locallib.php');
include_once '../table/groupmoodle.php';
include_once '../table/Real_cours.php';
include_once '../config/DBClass.php';
$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$locallib   =new course_enrolment_manager($modelpage,$course);
$add_user_to_group=$locallib-> add_user_to_group($user, $groupid);
$add_user_to_group_opject=json_decode ( json_encode($add_user_to_group) );
//$remove_member= json_encode($add_user_to_groupr_opject );
