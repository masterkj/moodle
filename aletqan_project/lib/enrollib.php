<?php
require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/lib/grouplib.php'); //groups_is_member//groups_group_exists
require_once($CFG->dirroot . '/lib/enrollib.php'); //is_enrolled,

include_once '../config/DBClass.php';
include_once '../table/Student_payment.php';
include_once '../table/Real_cours.php';

//api add first payment to student
function first_payment($student_id, $group_id, $payment)
{

    $dbclass = new DBClass();
    $connection = $dbclass->getConnection();
    $realcours = new Real_cours($connection);
    $stmt =    $realcours->select_group($group_id);
    if ($st = $stmt->fetch()) {
        $realcours_object = json_decode(json_encode($st));
        $percent = $realcours_object->price * 40 / 100;
        if ($payment >= $percent) {

            if ($payment < $realcours_object->price) {

                $student_payment = new Student_payment($connection);
                $student_payment->student_id = $student_id;
                $student_payment->realcours_id = $realcours_object->realcours_id;
                $student_payment->date = date('Y-m-d');
                $student_payment->amount = $payment;

                if ($student_payment->create()) {
                    echo "payment was created";
                    return true;
                } else {
                    echo "payment not created";
                    return false;
                }
            } else {
                echo "The quantity is larger than the price of the course " . $realcours_object->price;
                return false;
            }
        } else {
            echo "Quantity less than 40% of course price (" . $percent . ") ";
            return false;
        }
    } else {
        echo "There is not realcouse";
        return false;
    }
}

//api if user enrolled in course
function is_enroll($course_id, $user_id)
{
    $coursecontext = context_course::instance($course_id);
    $user = new stdClass();
    $user->id = $user_id;
    if (is_enrolled($coursecontext, $user))
        return true;
    else
        return false;
}

function user_in_moodle($user_id)
{
    global $DB;
    return ($DB->get_record('user', ['id' => $user_id])) != null;
}

function first_payment_condition($group_id, $payment)
{
    $dbclass = new DBClass();
    $connection = $dbclass->getConnection();
    $realcours = new Real_cours($connection);
    $stmt =    $realcours->select_group($group_id);
    if ($st = $stmt->fetch()) {
        $realcours_object = json_decode(json_encode($st));
        $percent = $realcours_object->price * 40 / 100;
        if ($payment >= $percent && $payment < $realcours_object->price)
            return true;
    }
    return false;
}

//api add payment 
function  add_payment($student_id, $group_id, $course_id, $payment)
{
    if (is_enroll($course_id, $student_id)) {
        if (groups_is_member($group_id, $student_id)) {
            $realcours_object =    select_real_course($group_id);
            $Remaining_amount =    $realcours_object->price - sum_payment_student_in_group($group_id, $student_id);
            if ($payment < $Remaining_amount) {
                if ($payment > 0) {
                    $dbclass = new DBClass();
                    $connection = $dbclass->getConnection();
                    $student_payment = new Student_payment($connection);
                    $student_payment->student_id = $student_id;
                    $student_payment->realcours_id = $group_id;
                    $student_payment->date = date('Y-m-d');
                    $student_payment->amount = $payment;

                    if ($student_payment->create()) {
                        echo "payment was created";
                        return true;
                    } else {
                        echo "payment not created";
                        return false;
                    }
                } else {
                    echo 'Quantity is not acceptable where remaining amount= ' . $Remaining_amount;
                    return false;
                }
            } else {
                echo 'The quantity is greater than the remaining amount  = ' . $Remaining_amount;
                return false;
            }
        } else {
            echo 'student not exist in group';
            return false;
        }
    } else {
        echo 'student not enroll';
        return false;
    }
}

//return apject json to realcourse 
function select_real_course($group_id)
{

    $dbclass = new DBClass();
    $connection = $dbclass->getConnection();
    $realcours = new Real_cours($connection);
    $stmt =    $realcours->select_group($group_id);
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
