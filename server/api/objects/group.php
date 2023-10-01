<?php

class Group
{
    private $conn;
    private $table_name = "Classes";

    public $id;
    public $title;
    public $course;

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
                title=?, course=?";

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->course = htmlspecialchars(strip_tags($this->course));

        $stmt->bind_param("si", $this->title, $this->course);

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
        if ($this->title != "") {
            $sql = $sql . "AND title = ? ";
            array_push($params, $this->title);
        }
        if ($this->course != "") {
            $sql = $sql . "AND course = ? ";
            array_push($params, $this->course);
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
                title = ?,
                course = ?
            WHERE
                id = ?";

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->course = htmlspecialchars(strip_tags($this->course));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bind_param("sii", $this->title, $this->course, $this->id);

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