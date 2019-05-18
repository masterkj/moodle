<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once($CFG->dirroot.'/enrol/locallib.php');
$dbclass = new DBClass();
$connection = $dbclass->getConnection();
if(!empty($_POST['group_id']))
    if(!empty($_POST['user_id'])){
        $group_id=$_POST['group_id'];
        $user_id=$_POST['user_id'];
    }
$locallib   =new course_enrolment_manager($modelpage,$course);
$remove_member=$locallib-> remove_user_from_group($group_id, $user_id);