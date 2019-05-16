
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
require_once(__DIR__.'/../../config.php');
require_once($CFG->dirroot.'/group/lib.php');
require_once($CFG->dirroot.'/lib/grouplib.php');
include_once '../table/groupmoodle.php';
include_once '../table/Real_cours.php';
include_once '../config/DBClass.php';


 
$stmt = groups_get_members($_POST['group_id'],"u.id,u.username,u.firstname,u.lastname,u.email,u.phone1");

 

//$dbclass = new DBClassmoodle();
//$connection = $dbclass->getConnection();
//$query = "SELECT  * FROM  mdl_groups_members";
//$stmt = $connection->prepare($query);
//$stmt->execute();


//$stmt = $realcours->readcorsenotfinished();
//$count = $stmt->rowCount();
echo json_encode($stmt);
