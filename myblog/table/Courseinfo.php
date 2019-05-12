<?php
class Courseinfo{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "Courseinfo";

    // table columns
    public $cours_id;
    public $cours_name;
    public $have_exam;
    public $Practical_mark;

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create(){

            // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                    SET
                    cours_name=:cours_name, have_exam=:have_exam, Practical_mark=:Practical_mark";

        // prepare query
        $stmt = $this->connection->prepare($query);

        // sanitize
    // $this->cours_id=htmlspecialchars(strip_tags($this->cours_id));
        $this->cours_name=htmlspecialchars(strip_tags($this->cours_name));
        $this->have_exam=htmlspecialchars(strip_tags($this->have_exam));
        $this->Practical_mark=htmlspecialchars(strip_tags($this->Practical_mark));

        // bind values
    // $stmt->bindParam(":cours_id", $this->cours_id);
        $stmt->bindParam(":cours_name", $this->cours_name);
        $stmt->bindParam(":have_exam", $this->have_exam);
        $stmt->bindParam(":Practical_mark", $this->Practical_mark);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
    //R
    public function select_id($id){


        $query = "SELECT cours_id , cours_name ,have_exam ,Practical_mark FROM " . $this->table_name . " where cours_id = " .$id  ;
        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read(){


        $query = "SELECT cours_id , cours_name ,have_exam ,Practical_mark FROM " . $this->table_name ;
        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }
    //U
    public function update(){}
    //D
    public function delete(){}
}