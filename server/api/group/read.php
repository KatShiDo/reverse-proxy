<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/group.php";

$database = new Database();
$db = $database->getConnection();
$group = new Group($db);
 
$stmt = $group->read();
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