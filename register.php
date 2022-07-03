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
    if (!$existingUser) {
        try {
            saveUser($username, $email, $password, $age);
            header("Location: login.php");
        } catch(Error $err) {
            echo "something went wrong";
        }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
</head>

<body>


    <section class="mt-4 card lg">
        <h2>Registration form</h2>
        <form action="register.php" method="POST">
            <?php
            if ($error) {
                echo "<div class='mt-1 text-center text-error'>
                <p class='error'>User with given email already exists!</p>
                </div>";
            }
            ?>
            <div class="mb-3">
                <label for="username" class="form-label">Name</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for='email' class="form-label">Email</label>
                <input type='email' class="form-control" id='email' name='email' required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" min=0 max=129 step="1" required>
            </div>
            <div class="btn-center">
                <button type="submit" class="btn btn-primary btn-size">Register</button>
            </div>
        </form>
        <div class="mt-3 text-center">
            <a href="login.php">Already have an account? Log in!</a>
        </div>
    </section>
</body>

</html>