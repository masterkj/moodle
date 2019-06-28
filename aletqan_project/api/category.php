<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once(__DIR__ . '/../../config.php'); 
require_once($CFG->dirroot.'/course/externallib.php');
include_once '../config/DBClass.php';
/*
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
echo json_encode($create_category);*/
$categories = new stdclass();
$categories->$name='ph';
$categories->$idnumber=4;
$categories->$description='';
$categories->$descriptionforma=1;
$categories->$parent=0;
$categories->$sortorder=20000;
$categories->$coursecount=0;
$categories->$visible=1;
$categories->$visibleold=1;
$categories->$depth=1;
$category = \tool_dataprivacy\api::create_category($categories);
echo json_encode($category_opject );

//$create_category= json_encode($category_opject );
