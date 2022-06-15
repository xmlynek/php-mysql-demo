<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

require_once "../DataService.php";


if($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id'])) {
    $data = getDataById(htmlspecialchars($_GET['id']));
    if($data) {
        echo json_encode($data);
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "NOT FOUND";
    }
} else if($_SERVER['REQUEST_METHOD'] === "GET") {
    $dataList = getAllData();
    echo json_encode($dataList);
} else if ($_SERVER['REQUEST_METHOD'] === "POST") {
    echo "kebab POST";
}
else if ($_SERVER['REQUEST_METHOD'] === "PUT") {
    echo "kebab UPDATE";
}
else if ($_SERVER['REQUEST_METHOD'] === "DELETE") {
    echo "kebab DELETE";
}