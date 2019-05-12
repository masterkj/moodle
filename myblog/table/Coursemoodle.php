<?php
class Coursemoodle{

    // Connection instance

    // table name
    private $table_name = "mdl_course";
    private $connection;

    // table columns
    public $category;
    public $sortorder;
    public $fullname;
    public $shortname;
    public $idnumber;
    public $summary;
    public $summaryformat;
    public $format;
    public $showgrades;
    public $newsitems;
    public $startdate;
    public $enddate	;
    public $marker;
    public $maxbytes;
    public $legacyfiles;
    public $showreports;
    public $visible;
    public $visibleold;
    public $groupmode;
    public $groupmodeforce;
    public $defaultgroupingid;
    public $lang;
    public $calendartype;
    public $theme;
    public $timecreated;
    public $timemodified;
    public $requested;
    public $enablecompletion;
    public $completionnotify;
    public $cachere;

 
    /*public function __construct($connection){
        $this->connection = $connection;
    }*/
    public function __construct(){
    }
    //C
    public function create(){
    }
    //R
    public function read(){
        $query = "SELECT category ,fullname ,shortname ,idnumber ,summary ,format  FROM " . $this->table_name ;
        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }
    //U
    public function update(){}
    //D
    public function delete(){}
}