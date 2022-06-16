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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
    <title>Demo</title>
</head>

<body>
    <header class="text-center">
        <h1>Landing page</h1>
    </header>

    <nav class="text-center">
        <div>
            <a href="login.php">Prihlásiť sa</a>
        </div>
        <div>
            <a href="register.php">Zaregistrovať sa</a>

        </div>
    </nav>

</body>

</html>