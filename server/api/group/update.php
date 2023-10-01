<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";
include_once "../objects/group.php";

$database = new Database();
$db = $database->getConnection();
$group = new Group($db);

if (
    !empty($_REQUEST['id']) &&
    !empty($_REQUEST['title']) &&
    !empty($_REQUEST['course'])
) {
    $group->id = $_REQUEST['id'];
    $group->title = $_REQUEST['title'];
    $group->course = $_REQUEST['course'];

    if ($group->update()) {
        http_response_code(200);
        echo json_encode(array("message" => "Group was updated"), JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update group"), JSON_UNESCAPED_UNICODE);
    }
}
else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to update group. Data is incomplete."), JSON_UNESCAPED_UNICODE);
}