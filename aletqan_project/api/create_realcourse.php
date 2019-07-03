<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . '/../../config.php';
require_once $CFG->dirroot . '/group/lib.php';
include_once '../table/Real_cours.php';
include_once '../config/DBClass.php';

// get posted data
//if($_SERVER['REQUEST_METHOD']=="POST"){
//   $data = json_decode(file_get_contents('php://input'));
//   echo $data;

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

// make sure data is not empty
if (
    !empty($_POST['cours_id']) &&
    !empty($_POST['Teacher_id']) &&
    !empty($_POST['start_date']) &&
    !empty($_POST['end_date']) &&
    !empty($_POST['attendance_days']) &&
    !empty($_POST['price']) &&
    !empty($_POST['description'])
) {
    $subject_name = $DB->get_record_sql("SELECT `fullname` FROM `mdl_course` WHERE `id`= " . $_POST['cours_id']);

    $increment_id_course = $DB->get_record_sql("SELECT count(*) as count  FROM `mdl_groups`  GROUP BY 	courseid HAVING courseid = " . $_POST['cours_id']);
    $group = new stdClass();
    $group->courseid = $_POST['cours_id'];
    if ($increment_id_course) {$group->name = $subject_name->fullname . " -" . $increment_id_course->count;
    } else { $group->name = $subject_name->fullname . " -1";
    }
    $group->idnumber = "";
    $group->description = $_POST['description'];
    $group->descriptionformat = '';
    $group->enrolmentkey = '';
    $group->picture = '';
    $group->hidepicture = '';

    // create the product
    if (($id_group = groups_create_group($group))) {
        $data = new stdclass();
        $data->courseid = $_POST['cours_id'];
        if ($increment_id_course) {$data->name = $subject_name->fullname . " -" . $increment_id_course->count;
        } else { $data->name = $subject_name->fullname . " -1";
        }
        $data->description = $_POST['description'];
        $grouping_id = groups_create_grouping($data);

        groups_assign_grouping($grouping_id, $id_group);

        $real_course = new Real_cours($connection);
        $real_course->realcours_id = $id_group;
        $real_course->cours_id = $_POST['cours_id'];
        $real_course->group_id = $id_group;
        $real_course->Teacher_id = $_POST['Teacher_id'];
        $real_course->start_date = $_POST['start_date'];
        $real_course->end_date = $_POST['end_date'];
        $real_course->price = $_POST['price'];
        $real_course->attendance_days = $_POST['attendance_days'];

        if ($real_course->create()) {

            // set response code - 201 created
            http_response_code(201);
            // tell the user
            echo json_encode(array("message" => "group was created."));}
    }

    // if unable to create the product, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create course."));
    }
}

// tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
