
<?php
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: GET");

include_once 'config/dbclassmoodel.php';
include_once '../lib/grouplib.php';
include_once '../../moodle/lib/grouplib.php';

require_once($CFG->dirroot.'../group/lib.php');
require_once($CFG->dirroot.'../../moodle/lib/grouplib.php');


 
$stmt = groups_get_members(1);

 

//$dbclass = new DBClassmoodle();
//$connection = $dbclass->getConnection();
//$query = "SELECT  * FROM  mdl_groups_members";
//$stmt = $connection->prepare($query);
//$stmt->execute();


//$stmt = $realcours->readcorsenotfinished();
$count = $stmt->rowCount();
echo json_encode($count);
