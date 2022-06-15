<?php
require_once "config.php";

function getAllData()
{
    // database connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
    // create statement
    $sql = "SELECT * FROM data";
    $result = $conn->query($sql);

    $dataArr = [];

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            array_push($dataArr, $row);
        }
    }

    $conn->close();
    return $dataArr;
}

function getDataById($id)
{
    // database connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
    // create statement
    $stmt = $conn->prepare("SELECT * FROM data WHERE id=?");
    $stmt->bind_param("i", $id);

    $stmt->execute();

    $result = $stmt->get_result(); // get the mysqli result
    $data = $result->fetch_assoc(); // fetch data 

    $stmt->close();
    $conn->close();
    return $data;
}
