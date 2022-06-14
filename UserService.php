<?php 
require_once "config.php";

// // Create connection
// $conn = new mysqli($servername, $username, $password);
// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

function getUserByEmail($email) {
    // database connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
    // create statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result(); // get the mysqli result
    $user = $result->fetch_assoc(); // fetch data 
    
    $stmt->close();
    $conn->close();
    return $user;
}

function saveUser($name, $email, $password, $age) {
    // database connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
    // create statement
    $stmt = $conn->prepare("INSERT INTO users (`name`, `email`, `password`, `age`) VALUES(?,?,?,?)");
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt->bind_param("sssi", $name, $email, $hashed_password, $age);
    $stmt->execute();
    
    $stmt->close();
    $conn->close();
}