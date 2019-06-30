<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../lib/enrollib.php';

if (
    !($group_id = empty($_POST['group_id']))
) {

    $group_id = $_POST['group_id'];
    $min_max=array();
    $min_max = max_min_pyment($group_id);
    echo json_encode($min_max);

} else {
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to create enroled. Data is incomplete."));

}
