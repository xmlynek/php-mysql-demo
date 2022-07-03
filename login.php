<?php
require_once "UserService.php";
require_once "config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$error = null;;

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $user = getUserByEmail($email);
    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user'] = $user;
        header('Location: homepage.php');
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
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
</head>

<body >
    <section class="mt-4 card lg">
        <h2>Login form</h2>
        <form action="login.php" method="POST">
        <?php
            if ($error) {
                echo "<div class='mt-1 text-center text-error'>
                <p class='error'>Incorrect email or password!</p>
                </div>";
            }
            ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Heslo</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="btn-center">
                <button type="submit" class="btn btn-primary btn-size">Login</button>
            </div>
        </form>
        <div class="mt-3 text-center">
            <a href="register.php">Create new account (Registration)</a>
        </div>
    </section>
</body>

</html>