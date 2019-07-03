<?php
require_once __DIR__ . '/../../config.php';
require_once $CFG->dirroot . '/lib/grouplib.php'; //groups_is_member//groups_group_exists
require_once $CFG->dirroot . '/lib/enrollib.php'; //is_enrolled,

include_once '../config/DBClass.php';
include_once '../table/Student_payment.php';
include_once '../table/Real_cours.php';

//api add first payment to student
function first_payment($student_id, $group_id, $payment)
{

    $dbclass = new DBClass();
    $connection = $dbclass->getConnection();
    $student_payment = new Student_payment($connection);
    $student_payment->student_id = $student_id;
    $student_payment->realcours_id = $group_id;
    $student_payment->date = date('Y-m-d');
    $student_payment->amount = $payment;

    if ($student_payment->create()) {
        return true;
    } else {
        echo "payment not created";
        return false;
    }

}

//if user enrolled in course
function is_enroll($course_id, $user_id)
{
    $coursecontext = context_course::instance($course_id);
    $user = new stdClass();
    $user->id = $user_id;
    if (is_enrolled($coursecontext, $user)) {
        return true;
    } else {
        return false;
    }

}

function course_have_group($course_id, $group_id)
{
    global $DB;
    return ($DB->get_record('groups', ['courseid' => $course_id, 'id' => $group_id])) != null;
}

function user_in_moodle($user_id)
{
    global $DB;
    return ($DB->get_record('user', ['id' => $user_id])) != null;
}

function first_payment_condition($group_id, $payment)
{
    if ($realcours_object = select_real_course($group_id)) {
        $percent = $realcours_object->price * 40 / 100;
        if ($payment >= $percent) {

            if ($payment <= $realcours_object->price) {
                return true;
            } else {
                echo json_encode(array("message" => "The quantity is larger than the price of the course " . $realcours_object->price));
                return false;
            }
        } else {
            echo json_encode(array("message" => "Quantity less than 40% of course price (" . $percent . ") "));
            return false;
        }
    } else {
        echo json_encode(array("message" => "There is not realcouse"));
        return false;
    }
}

//api add payment
function add_payment($student_id, $group_id, $course_id, $payment)
{
    if (is_enroll($course_id, $student_id)) {
        if (groups_is_member($group_id, $student_id)) {
            $realcours_object = select_real_course($group_id);
            $Remaining_amount = $realcours_object->price - sum_payment_student_in_group($group_id, $student_id);
            if ($payment <= $Remaining_amount) {
                if ($payment > 0) {
                    $dbclass = new DBClass();
                    $connection = $dbclass->getConnection();
                    $student_payment = new Student_payment($connection);
                    $student_payment->student_id = $student_id;
                    $student_payment->realcours_id = $group_id;
                    $student_payment->date = date('Y-m-d');
                    $student_payment->amount = $payment;

                    if ($student_payment->create()) {
                        http_response_code(200);
                        echo json_encode(array("message" => "payment was created."));
                        return true;
                    } else {
                        http_response_code(503);
                        echo json_encode(array("message" => "payment not created."));
                        return false;
                    }
                } else {
                    http_response_code(405);
                    echo json_encode(array("message" => 'Quantity is not acceptable where remaining amount= ' . $Remaining_amount));
                    return false;
                }
            } else {
                http_response_code(405);
                echo json_encode(array("message" => 'The quantity is greater than the remaining amount  = ' . $Remaining_amount));
                return false;
            }
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "student not exist in group."));
            return false;
        }
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "student not enroll."));
        return false;
    }
}

//return apject json to realcourse
function select_real_course($group_id)
{

    $dbclass = new DBClass();
    $connection = $dbclass->getConnection();
    $realcours = new Real_cours($connection);
    $stmt = $realcours->select_group($group_id);
    if ($st = $stmt->fetch(2)) {
        $realcours_object = json_decode(json_encode($st));
        return $realcours_object;
    }
    return false;
}

//return int to  sum  payment student in realcourse'group'
function sum_payment_student_in_group($group_id, $student_id)
{
    $dbclass = new DBClass();
    $connection = $dbclass->getConnection();
    $payment = new Student_payment($connection);
    $stmt = $payment->sum_payment_student_in_group($group_id, $student_id);
    $st = $stmt->fetch(3);
    return $st[0];
}

function max_min_pyment($group_id)
{

    $dbclass = new DBClass();
    $connection = $dbclass->getConnection();
    $realcours = new Real_cours($connection);
    $stmt = $realcours->max_min_payment($group_id);
    if ($st = $stmt->fetch(2)) {
        $price_course = json_decode(json_encode($st));
        $max_min = array();
        $max_min['min_payment']=($price_course->price * 40 / 100);
        $max_min['max_payment']=$price_course->price;
        return $max_min;

    }
    else{return false;}

}
