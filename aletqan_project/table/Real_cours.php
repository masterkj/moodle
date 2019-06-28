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
        
                    // query to insert record
        $query = "INSERT INTO
                 " . $this->table_name . "
                SET
                realcours_id=:realcours_id, cours_id=:cours_id, Teacher_id=:Teacher_id, start_date=:start_date, end_date=:end_date, attendance_days=:attendance_days, price=:price";

        // prepare query
        $stmt = $this->connection->prepare($query);

        // sanitize
        // $this->cours_id=htmlspecialchars(strip_tags($this->cours_id));
        $this->realcours_id=htmlspecialchars(strip_tags($this->realcours_id));
        $this->cours_id=htmlspecialchars(strip_tags($this->cours_id));
        //$this->group_id=htmlspecialchars(strip_tags($this->group_id));
        $this->Teacher_id=htmlspecialchars(strip_tags($this->Teacher_id));
        $this->start_date=htmlspecialchars(strip_tags($this->start_date));
        $this->end_date=htmlspecialchars(strip_tags($this->end_date));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->attendance_days=htmlspecialchars(strip_tags($this->attendance_days));

        // bind values
        // $stmt->bindParam(":cours_id", $this->cours_id);
        $stmt->bindParam(":realcours_id", $this->realcours_id);
        $stmt->bindParam(":cours_id", $this->cours_id);
        //$stmt->bindParam(":group_id", $this->group_id);
        $stmt->bindParam(":Teacher_id", $this->Teacher_id);
        $stmt->bindParam(":start_date", $this->start_date);
        $stmt->bindParam(":end_date", $this->end_date);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":attendance_days", $this->attendance_days);


        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }
    //R
    public function readcorsenotfinished(){
        $query = "SELECT realcours_id , cours_id ,Teacher_id , start_date ,end_date,price,attendance_days  FROM " . $this->table_name . " where end_date >= CAST(CURRENT_TIMESTAMP AS DATE)";
        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }



    public function select_group($id_group){
        $query = "SELECT realcours_id , cours_id  ,Teacher_id , start_date ,end_date,price,attendance_days  FROM " . $this->table_name . " where realcours_id = " . $id_group;
        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;

    }



    //U
    public function update(){}
    //D
    public function delete(){}
}