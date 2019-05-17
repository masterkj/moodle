<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../table/Coursemoodle.php';
include_once '../table/Courseinfo.php';
include_once '../config/DBClass.php';
include_once '../config/dbclassmoodel.php';

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/course/externallib.php');


if (
    !($srudent_id = empty($_POST['student_id'])) &&
    !($group_id = empty($_POST['group_id'])) &&
    !($course_id = empty($_POST['course_id'])) 
){ 
    if(!is_enroll($course_id, $group_id)){
        
    }else {
        //the user may existed in the course but he want to re-enroll in it
    }
}
