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

if (!empty($_REQUEST['id'])) {
    $student->id = $_REQUEST['id'];

    if ($student->delete()) {
        http_response_code(200);
        echo json_encode(array("message" => "Student was deleted"), JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete student"));
    }
}
else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to delete student. Data is incomplete."), JSON_UNESCAPED_UNICODE);
}