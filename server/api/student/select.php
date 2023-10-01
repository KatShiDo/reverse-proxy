<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once "../config/database.php";
include_once "../objects/student.php";

$database = new Database();
$db = $database->getConnection();
$student = new Student($db);

$student->id = isset($_GET['id']) ? $_GET['id'] : 0;
$student->first_name = isset($_GET['first_name']) ? $_GET['first_name'] : "";
$student->last_name = isset($_GET['last_name']) ? $_GET['last_name'] : "";
$student->Class_id = isset($_GET['Class_id']) ? $_GET['Class_id'] : 0;

$stmt = $student->select();
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