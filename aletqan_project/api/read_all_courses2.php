<?php
header("Content-Type: application/json; charset=UTF-8");
include_once '../table/Courseinfo.php';
include_once '../config/DBClass.php';
include_once '../config/dbclassmoodel.php';

require_once(__DIR__.'/../../config.php');
require_once($CFG->dirroot.'/course/externallib.php');

$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$courseinfo = new Courseinfo($connection);

//$courses = $DB->get_record_sql("SELECT * FROM `mdl_course` ORDER BY `mdl_course`.`id` ASC");
$courses= $DB->get_records('course');

$courses_opject=json_decode ( json_encode($courses),true );

//merge table courseinfo an course moodle
foreach($courses_opject as $c_o){
  $stmt=  $courseinfo->select_id($c_o['id']);
  if( $st= $stmt->fetch()){

    $courseinfo_opject= json_decode(json_encode($st));

    $courses_opject[$c_o['id']]['cours_name']=$courseinfo_opject->cours_name;
    $courses_opject[$c_o['id']]['have_exam']=$courseinfo_opject->have_exam;
    $courses_opject[$c_o['id']]['Practical_mark']=$courseinfo_opject->Practical_mark;
    $courses_opject[$c_o['id']]=json_encode($courses_opject[$c_o['id']]);

  }else{
    unset($courses_opject[$c_o['id']]);
  }

}


print_r( $courses_opject);

//echo(json_encode( $courses_opject));
