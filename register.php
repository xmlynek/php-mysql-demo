<?php 
require_once "UserService.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$error = null;

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['age'])) {
    // var_dump($_POST);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $age = htmlspecialchars($_POST['age']);
    $email = htmlspecialchars($_POST['email']);
    
    $existingUser = getUserByEmail($email);
    if(!$existingUser) {
        saveUser($username, $email, $password, $age);
    } else {
        $error = true;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        if($error) {
            echo "<p>Pouzivatel s danym emailom uz existuje</p>";
        }
    ?>
    <form action="register.php" method="POST">
        <div>
            <label for="username">Meno</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for='email'>Email</label>
            <input type='email' id='email' name='email' required>
        </div>
        <div>
            <label for="password">Heslo</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="age">Vek</label>
            <input type="number" id="age" name="age" min=0 max=129 step="1" required>
        </div>
        <div>
            <button type="submit">Zaregistrovat</button>
        </div>
    </form>
</body>

</html>