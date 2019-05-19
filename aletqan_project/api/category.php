<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once(__DIR__ . '/../../config.php'); 
require_once($CFG->dirroot.'/course/externallib.php');
$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$external   =new core_course_external();
$categories->$id=$id;
$categories->$name=$name;
$categories->$idnumber=$idnumber;
$categories->$description=$description;
$categories->$descriptionforma=$descriptionforma;
$categories->$parent=$parent;
$categories->$sortorder=$sortorder;
$categories->$coursecount=$coursecount;
$categories->$visible=$visible;
$categories->$visibleold=$visibleold;
$categories->$timemodified=$timemodified;
$categories->$depth=$depth;
$categories->$path=$path;
$categories->$theme=$theme;
$create_category=$external->create_categories($categories);
$category_opject=json_decode ( json_encode($create_category) );
//$create_category= json_encode($category_opject );
