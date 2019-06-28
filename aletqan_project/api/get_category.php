<?php
header("Content-Type: application/json; charset=UTF-8");

require_once(__DIR__.'/../../config.php');

require_once($CFG->dirroot.'/course/lib.php');

$categories= $DB->get_records('course_categories');

echo json_encode($categories);
