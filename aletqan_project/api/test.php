<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../table/Courseinfo.php';
include_once '../config/DBClass.php';
include_once '../table/Coursemoodle.php';
include_once '../table/groupmoodle.php';

include_once '../table/Courseinfo.php';
include_once '../config/DBClass.php';
include_once '../lib/enrollib.php';

require_once(__DIR__.'/../../config.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/group/lib.php');
require_once($CFG->dirroot.'/course/externallib.php');
//echo date('d-m-Y');
first_payment(1,10,60);
//defined('MOODLE_INTERNAL') || die();
//global $DB;

/*$group = new stdClass();
    $group->courseid =8;
    $group->idnumber ="";
    $group->name ='compilar ';
    $group->description ='klklklk';
    $group->descriptionformat ='';
    $group->enrolmentkey ='';
    $group->picture ='';
    $group->hidepicture ='';
 echo groups_create_group($group );*/

//$increment = $DB->get_record_sql("SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'moodle' AND   TABLE_NAME   = 'mdl_course';");
//$external   =new core_course_external();
 /*  
$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$courseinfo = new Courseinfo($connection);
$stmt= $courseinfo->select_id(6);
*/


//$courses= $external->get_courses();

//$course= course_get_format(2);

//$course=json_decode ( json_encode($courses) );
  //  echo ($stmt->rowCount());
 /* $courseinfo_opject= json_decode(json_encode($stmt->fetch(PDO::FETCH_ASSOC)));

  echo   json_encode($courseinfo_opject->cours_name);
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));*/


