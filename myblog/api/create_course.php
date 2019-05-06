<?php

header("Content-Type: application/json; charset=UTF-8");
//require_once($CFG->dirroot.'/lib/grouplib.php');
require_once(__DIR__.'/../../config.php');


require_once($CFG->dirroot.'/course/lib.php');
include_once '../table/Coursemoodle.php';

$course_moodle = new Coursemoodle();

$course_moodle->category =2;
$course_moodle->fullname ='HTML';
$course_moodle->shortname ='html';
$course_moodle->summary ='course supject';
$course_moodle->idnumber =5;


$coursm = create_course($course_moodle);
//$count = $stmt->rowCount();
echo json_encode($coursm);
