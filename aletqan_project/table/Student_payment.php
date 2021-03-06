<?php
class Student_payment{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "Student_payment";

    // table columns
    public $payment_id;
    public $student_id;
    public $realcours_id;
    public $date;
    public $amount;
    
    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create(){
        $query = "INSERT INTO
        " . $this->table_name . "
       SET
       realcours_id=:realcours_id, student_id=:student_id , date=:date , amount=:amount ";

        // prepare query
        $stmt = $this->connection->prepare($query);

        // sanitize
        // $this->cours_id=htmlspecialchars(strip_tags($this->cours_id));
        $this->realcours_id=htmlspecialchars(strip_tags($this->realcours_id));
        $this->student_id=htmlspecialchars(strip_tags($this->student_id));
        $this->date=htmlspecialchars(strip_tags($this->date));
        $this->amount=htmlspecialchars(strip_tags($this->amount));
        
        // bind values
        // $stmt->bindParam(":cours_id", $this->cours_id);
        $stmt->bindParam(":realcours_id", $this->realcours_id);
        $stmt->bindParam(":student_id", $this->student_id);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":amount", $this->amount);
       

        // execute query
        if($stmt->execute()){
        return true;
        }

        return false;


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