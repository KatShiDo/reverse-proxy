<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";
include_once "../objects/student.php";

$database = new Database();
$db = $database->getConnection();
$student = new Student($db);

if (
    !empty($_REQUEST['id']) &&
    !empty($_REQUEST['first_name']) &&
    !empty($_REQUEST['last_name']) &&
    !empty($_REQUEST['Class_id'])
) {
    $student->id = $_REQUEST['id'];
    $student->first_name = $_REQUEST['first_name'];
    $student->last_name = $_REQUEST['last_name'];
    $student->Class_id = $_REQUEST['Class_id'];

    if ($student->update()) {
        http_response_code(200);
        echo json_encode(array("message" => "Student was updated"), JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update student"), JSON_UNESCAPED_UNICODE);
    }
}
else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to update student. Data is incomplete."), JSON_UNESCAPED_UNICODE);
}