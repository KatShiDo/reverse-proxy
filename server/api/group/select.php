<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once "../config/database.php";
include_once "../objects/group.php";

$database = new Database();
$db = $database->getConnection();
$group = new Group($db);

$group->id = isset($_GET['id']) ? $_GET['id'] : 0;
$group->title = isset($_GET['title']) ? $_GET['title'] : "";
$group->course = isset($_GET['course']) ? $_GET['course'] : "";

$stmt = $group->select();
$num = mysqli_num_rows($stmt);

if ($num > 0) {
    
    $groups_arr = array();
    $groups_arr["records"] = array();

    while ($row = $stmt->fetch_array(MYSQLI_ASSOC)) {
        $group_item = array(
            "id" => $row['id'],
            "title" => $row['title'],
            "course" => $row['course']
        );
        array_push($groups_arr["records"], $group_item);
    }

    http_response_code(200);

    echo json_encode($groups_arr);
}
else {
    http_response_code(404);

    echo json_encode(array("message" => "Groups not found."), JSON_UNESCAPED_UNICODE);
}