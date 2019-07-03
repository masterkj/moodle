<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../table/Courseinfo.php';
include_once '../config/DBClass.php';
include_once '../lib/enrollib.php';
require_once __DIR__ . '/../../config.php';
require_once $CFG->dirroot . '/group/lib.php';
require_once $CFG->dirroot . '/lib/grouplib.php';
require_once $CFG->dirroot . '/course/externallib.php';

if (
    !($username = empty($_POST['username'])) &&
    !($group_id = empty($_POST['group_id'])) &&
    !($course_id = empty($_POST['course_id'])) &&
    !($payment = empty($_POST['payment']))

) {
    $username = $_POST['username'];
    $user_id = $DB->get_record_sql(" SELECT `id`  FROM `mdl_user` WHERE `username` = " . "'" . $username . "'");
    if ($user_id) {
        $user_id = $user_id->id;
    }else{$user_id=-1;}

    // $user_id = $_POST['user_id'];
    $group_id = $_POST['group_id'];
    $course_id = $_POST['course_id'];
    $payment = $_POST['payment'];
    if (user_in_moodle($user_id)) {

        if (course_have_group($course_id, $group_id)) {

            if (!groups_is_member($group_id, $user_id)) {

                if (first_payment_condition($group_id, $payment)) {

                    //If the student is not already enrolled in the session add to the enroll and continue without continuing without Enrol
                    if (!is_enroll($course_id, $user_id)) {

                        if (enrol_try_internal_enrol($course_id, $user_id)) {

                            if (groups_add_member($group_id, $user_id) && first_payment($user_id, $group_id, $payment)) {
                                http_response_code(200);
                                echo json_encode(array("message" => "add student sucssfuly."));
                            } else {
                                http_response_code(206);
                                echo json_encode(array("message" => "Unable to create payment and group."));
                            }
                        } else {
                            http_response_code(206);
                            echo json_encode(array("message" => "Unable to enrol ."));
                        }

                    } else {
                        //the user may existed in the course but he want to re-enroll in it
                        if (groups_add_member($group_id, $user_id) && first_payment($user_id, $group_id, $payment)) {
                            http_response_code(200);
                            echo json_encode(array("message" => "add student sucssfuly."));
                        } else {
                            http_response_code(206);
                            echo json_encode(array("message" => "Unable to create payment and group."));
                        }
                    }

                } else {
                    http_response_code(206);
                    echo json_encode(array("message" => "This payment is not accepted  ."));
                }

            } else {
                http_response_code(206);
                echo json_encode(array("message" => "This student is already in the course  ."));
            }

        } else {
            http_response_code(206);
            echo json_encode(array("message" => "not found group in course ."));
        }

    } else {
        http_response_code(206);
        // tell the user
        echo json_encode(array("message" => " user not found."));
    }

} else {
    // set response code - 400 bad request
    http_response_code(206);
    // tell the user
    echo json_encode(array("message" => "Unable to create enroled. Data is incomplete."));

}
