<?php 
session_start();

$isLoggedIn = false;

if(isset($_SESSION['user'])) {
    var_dump($_SESSION['user']);
    $isLoggedIn = true;
} else {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <header>
        <h1>Homepage</h1>
    </header>
    
    <?php 
        if($isLoggedIn) {
            echo "<a href='logout.php'>Odhlasit</a>";
        }
    ?>
    
</body>
</html>