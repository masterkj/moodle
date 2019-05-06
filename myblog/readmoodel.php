<?php
header("Content-Type: application/json; charset=UTF-8");
//require_once($CFG->dirroot.'/lib/grouplib.php');
require_once(__DIR__.'/../config.php');

require_once($CFG->dirroot.'/lib/grouplib.php');

$stmt =groups_get_members(1);


//$count = $stmt->rowCount();
echo json_encode($stmt);
