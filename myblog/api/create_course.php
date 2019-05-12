<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
require_once(__DIR__.'/../../config.php');
require_once($CFG->dirroot.'/course/lib.php');
include_once '../table/Coursemoodle.php';

include_once '../table/Courseinfo.php';
include_once '../config/DBClass.php';




// get posted data
//if($_SERVER['REQUEST_METHOD']=="POST"){
    $data = json_decode(file_get_contents('php://input'));
    echo $data;
    
$dbclass = new DBClass();
$connection = $dbclass->getConnection();


// make sure data is not empty
if(
    !empty($_POST['fullname']) &&
    !empty($_POST['shortname']) &&
    !empty($_POST['summary']) &&
    !empty($_POST['marker']) &&
    !empty($_POST['have_exam']) &&
    !empty($_POST['Practical_mark']) 
){
 
    $courseinfo = new Courseinfo($connection);
    $courseinfo->cours_name=$_POST['fullname'];
    $courseinfo->have_exam=$_POST['have_exam'];
    $courseinfo->Practical_mark=$_POST['Practical_mark'];

    $st= $courseinfo->read();
    $count_course = $st->rowCount();
    $jcourseinfo= json_decode(json_encode($st->fetchAll(PDO::FETCH_ASSOC)));

    $course_moodle = new Coursemoodle();
    $course_moodle->category =1;
    $course_moodle->fullname =$_POST['fullname'];
    $course_moodle->shortname =$_POST['shortname'];
    $course_moodle->summary =$_POST['summary'];
    $course_moodle->idnumber =($jcourseinfo[$count_course-1]->cours_id)+1;
    $course_moodle->summaryformat =1;
    $course_moodle->format ='topics';
    $course_moodle->showgrades =1;
    $course_moodle->newsitems =5;
    $course_moodle->startdate =1557262800;
    $course_moodle->enddate =1588626000;
    $course_moodle->marker =$_POST['marker'];
    $course_moodle->maxbytes =0;
    $course_moodle->legacyfiles =0;
    $course_moodle->showreports =0;
    $course_moodle->groupmode =0;
    $course_moodle->groupmodeforce =0;
    $course_moodle->defaultgroupingid =0;
    $course_moodle->lang ='';
    $course_moodle->calendartype ='';
    $course_moodle->theme ='';
    $course_moodle->requested =0;
    $course_moodle->enablecompletion =1;
    $course_moodle->completionnotify =0;
    $course_moodle->enablecompletion =1;

    // create the product
    if( ($coursm = create_course($course_moodle)) &&  $courseinfo->create())
    {
 
        // set response code - 201 created
        http_response_code(201);
        
        // tell the user
        echo json_encode($coursm);

        echo json_encode(array("message" => "course was created."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create course."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>