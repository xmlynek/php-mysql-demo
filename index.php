<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// if (isset($_POST['username']) && isset($_POST['password'])) {
//     $username = $_POST['username'];
//     $password = $_POST['password'];
//     echo $username . "  " . $password;
// }

// if (isset($_GET['id'])) {
//     echo $_GET['id'];
// }

// var_dump($_SERVER);
// var_dump($_GET);
// var_dump($_POST);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title>
</head>

<body>

    <a href="login.php">Prihlasit</a>
    <a href="register.php">Registracia</a>

    <!-- <form action="index.php" method="POST">
        <?php
            echo  "<div>
            <label for='email'>Email</label>
            <input type='email' id='email' name='email'>
            </div>";
        ?>
        <div>
            <label for="username">Meno</label>
            <input type="text" id="username" name="username">
        </div>
        <div>
            <label for="password">Heslo</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <button type="submit">Prihlasit</button>
        </div>
    </form> -->

</body>

</html>