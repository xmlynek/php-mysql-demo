<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

// get request body
$requestBodyJSON = file_get_contents('php://input');
$requestBody = json_decode($requestBodyJSON, TRUE); //convert JSON into array

require_once "../DataService.php";


if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id'])) {
    $data = getDataById(htmlspecialchars($_GET['id']));
    if ($data) {
        echo json_encode($data);
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "NOT FOUND";
    }
} else if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $dataList = getAllData();
    echo json_encode($dataList);
} else if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($requestBody['length']) && isset($requestBody['weight']) && isset($requestBody['height']) 
    && is_numeric($requestBody['length']) && is_numeric($requestBody['weight']) && is_numeric($requestBody['height'])) {
        // create new data
        $createdObject = createNewData($requestBody['length'], $requestBody['weight'], $requestBody['height']);
        if ($createdObject) {
            // return created data
            echo json_encode($createdObject);
            header("HTTP/1.0 201 Created");
        } else {
            // if error, return status code 500
            header("HTTP/1.0 500 Internal Server Error");
        }
    } else {
        // if wrong request body args -> return status code 400
        header("HTTP/1.0 400 Bad Request");
    }
} else if ($_SERVER['REQUEST_METHOD'] === "PUT") {
    echo "kebab UPDATE";
} else if ($_SERVER['REQUEST_METHOD'] === "DELETE" && isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $data = getDataById($id);
    if ($data) {
        $wasDeleted = deleteDataById($id);
        if($wasDeleted) {
            header("HTTP/1.0 204 No Content");
        } else {
            header("HTTP/1.0 500 Internal Server Error");
        }
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "NOT FOUND";
    }
}
