<?php
class Real_cours{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "real_cours";

    // table columns
    public $realcours_id;
    public $cours_id;
    public $group_id;
    public $Teacher_id;
    public $start_date;
    public $end_date;
    public $price;
    public $attendance_days;

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create(){
    }
    //R
    public function readcorsenotfinished(){
        $query = "SELECT realcours_id , cours_id ,group_id ,Teacher_id , start_date ,end_date,price,attendance_days  FROM " . $this->table_name . " where end_date >= CAST(CURRENT_TIMESTAMP AS DATE)";
        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }
    //U
    public function update(){}
    //D
    public function delete(){}
}