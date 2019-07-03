<?php
class payment_teacher
{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "payment_teacher";

    // table columns
    public $payment_teacher_id;
    public $realcours_id;
    public $date;
    public $amount;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    //C
    public function create()
    {
        $query = "INSERT INTO
        " . $this->table_name . "
       SET
       realcours_id=:realcours_id, date=:date , amount=:amount ";

        // prepare query
        $stmt = $this->connection->prepare($query);

        // sanitize
        // $this->cours_id=htmlspecialchars(strip_tags($this->cours_id));
        $this->realcours_id = htmlspecialchars(strip_tags($this->realcours_id));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->amount = htmlspecialchars(strip_tags($this->amount));

        // bind values
        // $stmt->bindParam(":cours_id", $this->cours_id);
        $stmt->bindParam(":realcours_id", $this->realcours_id);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":amount", $this->amount);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function select_realcours_id($realcours_id)
    {
        $query = "SELECT realcours_id FROM `payment_teacher` where realcours_id =" . $realcours_id;

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;

    }

}
