<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../table/Courseinfo.php';
include_once '../config/DBClass.php';
include_once '../table/Coursemoodle.php';

include_once '../table/Courseinfo.php';
include_once '../config/DBClass.php';

require_once(__DIR__.'/../../config.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/course/externallib.php');
$external   =new core_course_external();

   
$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$courseinfo = new Courseinfo($connection);
$stmt= $courseinfo->select_id(6);

//$courses= $external->get_courses();

//$course= course_get_format(2);

//$course=json_decode ( json_encode($courses) );
  //  echo ($stmt->rowCount());
  $courseinfo_opject= json_decode(json_encode($stmt->fetch(PDO::FETCH_ASSOC)));

  echo   json_encode($courseinfo_opject->cours_name);
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
