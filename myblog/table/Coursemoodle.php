<?php
class Coursemoodle{

    // Connection instance

    // table name
    private $table_name = "mdl_course";

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

 















    public function __construct(){
    }

    //C
    public function create(){
    }
    //R
    public function read(){
        $query = "SELECT c.name as family_name, p.id, p.sku, p.barcode, p.name, p.price, p.unit, p.quantity , p.minquantity, p.createdAt, p.updatedAt FROM" . $this->table_name . " p LEFT JOIN Family c ON p.family_id = c.id ORDER BY p.createdAt DESC";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }
    //U
    public function update(){}
    //D
    public function delete(){}
}