<?php

class Student
{
    private $conn;
    private $table_name = "Students";

    public $id;
    public $first_name;
    public $last_name;
    public $Class_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        
        $result = mysqli_query($this->conn, $query);

        return $result;
    }

    function create()
    {
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                first_name=?, last_name=?, Class_id=?";

        $stmt = $this->conn->prepare($query);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->Class_id = htmlspecialchars(strip_tags($this->Class_id));

        $stmt->bind_param("ssi", $this->first_name, $this->last_name, $this->Class_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function select()
    {
        $params = array();

        $sql = "SELECT * FROM " 
        . $this->table_name
        . " WHERE 1=1 ";

        if ($this->id != 0) {
            $sql = $sql . "AND id = ? ";
            array_push($params, $this->id);
        }
        if ($this->first_name != "") {
            $sql = $sql . "AND first_name = ? ";
            array_push($params, $this->first_name);
        }
        if ($this->last_name != "") {
            $sql = $sql . "AND last_name = ? ";
            array_push($params, $this->last_name);
        }
        if ($this->Class_id != 0) {
            $sql = $sql . "AND Class_id = ? ";
            array_push($params, $this->Class_id);
        }

        $types = '';                        
        foreach($params as $param) {        
            if(is_int($param)) {
                $types .= 'i';
            } elseif (is_float($param)) {
                $types .= 'd';
            } elseif (is_string($param)) {
                $types .= 's';
            } else {
                $types .= 'b';
            }
        }

        array_unshift($params, $types);

        $stmt = $this->conn->prepare($sql);

        call_user_func_array(array($stmt,'bind_param'),$params);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    function update()
    {
        $query = "UPDATE
                " . $this->table_name . "
            SET
                first_name = ?,
                last_name = ?,
                Class_id = ?
            WHERE
                id = ?";

        $stmt = $this->conn->prepare($query);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->Class_id = htmlspecialchars(strip_tags($this->Class_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bind_param("ssii", $this->first_name, $this->last_name, $this->Class_id, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bind_param("i", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}