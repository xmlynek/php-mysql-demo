<?php
require_once "config.php";

function getAllData()
{
    try {
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
    } catch (Error $err) {
        return null;
    }
}

function getDataById($id)
{
    try {
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
    } catch (Error $err) {
        return null;
    }
}


function createNewData($length, $weight, $height)
{
    try {
        // database connection
        $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        // create statement
        $stmt = $conn->prepare("INSERT INTO `data` (`length`, `weight`, `height`) VALUES (?, ?, ?)");
        $stmt->bind_param("ddd", $length, $weight, $height);

        $stmt->execute();
        $insertedId = $stmt->insert_id;
        $stmt->close();
        $conn->close();
        return getDataById($insertedId);
    } catch (Error $err) {
        return null;
    }
}
