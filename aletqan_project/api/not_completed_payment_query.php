<?php
require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . 'aletqan_project/table/Student_payment.php');
$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$payment = new Student_payment($connection);
return $payment->not_completed_payment_query();