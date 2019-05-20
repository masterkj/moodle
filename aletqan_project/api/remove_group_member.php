<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once __DIR__ . '/../../config.php';
require_once $CFG->dirroot . '/group/lib.php';

if (!empty($_POST['group_id']) &&
    !empty($_POST['user_id'])
) {
    $group_id = $_POST['group_id'];
    $user_id = $_POST['user_id'];

    if(groups_remove_member( $group_id , $user_id )){
        http_response_code(200);
        echo json_encode(array("message" => "true"));

    }else{
        http_response_code(404);
        echo json_encode(array("message" => "false"));
    }
}

