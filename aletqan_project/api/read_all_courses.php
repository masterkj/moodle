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

require_once(__DIR__.'/../../config.php');
require_once($CFG->dirroot.'/course/externallib.php');

$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$courseinfo = new Courseinfo($connection);
//$stmt = $courseinfo->read();
//$count = $stmt->rowCount();

$external   =new core_course_external();
$courses= $external->get_courses();
$courses_opject=json_decode ( json_encode($courses) );

//merge table courseinfo an course moodle
$i=0;
while($i <sizeof($courses_opject)){
  $stmt=  $courseinfo->select_id($courses_opject[$i]->id);
  if( $st= $stmt->fetch()){
    $courseinfo_opject= json_decode(json_encode($st));
    $courses_opject[$i]->cours_name=$courseinfo_opject->cours_name;
    $courses_opject[$i]->have_exam=$courseinfo_opject->have_exam;
    $courses_opject[$i]->Practical_mark=$courseinfo_opject->Practical_mark;
    

  }else{
   // unset($courses_opject[$i]);
  }
  $i=$i+1;

}


$courses= json_encode($courses_opject );

echo $courses;
