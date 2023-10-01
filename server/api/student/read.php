<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/student.php";

$database = new Database();
$db = $database->getConnection();
$student = new Student($db);
 
$stmt = $student->read();
$num = mysqli_num_rows($stmt);

if ($num > 0) {
    
    $students_arr = array();
    $students_arr["records"] = array();

    while ($row = $stmt->fetch_array(MYSQLI_ASSOC)) {
        
        $student_item = array(
            "id" => $row['id'],
            "first_name" => $row['first_name'],
            "last_name" => $row['last_name'],
            "Class_id" => $row['Class_id']
        );
        array_push($students_arr["records"], $student_item);
    }

    http_response_code(200);

    echo json_encode($students_arr);
}
else {
    http_response_code(404);

    echo json_encode(array("message" => "Students not found."), JSON_UNESCAPED_UNICODE);
}