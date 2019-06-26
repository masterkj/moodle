
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . '/../../config.php';
require_once $CFG->dirroot . '/group/lib.php';
require_once $CFG->dirroot . '/lib/grouplib.php';
include_once '../table/Real_cours.php';
include_once '../config/DBClass.php';

$stmt = groups_get_members($_POST['group_id'], "u.id");
$Number_of_students_in_Grouping = count($stmt);

$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$realcours = new Real_cours($connection);

$stmt = $realcours->select_group($_POST['group_id']);

if( $st= $stmt->fetch()){
    $realcours_opject = json_decode(json_encode($st));


    if ($Number_of_students_in_Grouping > 10) {
        $Teacher_fees_from_course = $realcours_opject->price * $Number_of_students_in_Grouping * 50 / 100;
    } else {
        $Teacher_fees_from_course = $realcours_opject->price * $Number_of_students_in_Grouping * 40 / 100;
    }

    echo json_encode($Teacher_fees_from_course);

}else{    echo json_encode("There is no such group");
}

