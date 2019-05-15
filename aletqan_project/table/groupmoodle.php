<?php
class Groupmoodle{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "mdl_groups";

    			

    // table columns
    public $id;
    public $courseid;
    public $idnumber;
    public $name;
    public $description;
    public $descriptionformat;
    public $enrolmentkey;
    public $picture;
    public $hidepicture;
    public $timecreated;
    public $timemodified;

    public function __construct(){
    }

    //C
    public function create(){
    }
    //R
    public function read(){
    }
    //U
    public function update(){}
    //D
    public function delete(){}
}