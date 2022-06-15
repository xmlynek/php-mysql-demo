<?php
session_start();
require_once "DataService.php";

$user;
if (isset($_SESSION['user'])) {
    // var_dump($_SESSION['user']);
    $user = $_SESSION['user'];
} else {
    header("Location: login.php");
}

// $dataList = getAllData();
$dataListResponse = file_get_contents('http://localhost/phpuvod/data/index.php');
$dataList = json_decode($dataListResponse);

// var_dump($dataList);
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

    <section>
        <h2>User info</h2>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>age</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    echo "<td>{$user['id']}</td>
                    <td>{$user['name']}</td>
                    <td>{$user['email']}</td>
                    <td>{$user['age']}</td>"
                    ?>
                </tr>
            </tbody>
        </table>
    </section>

    <section>
        <h2>Data</h2>
        <form method="POST">
            <div>
                <label for="length">Length</label>
                <input type="number" id="length" name="length" step="0.001" required>
            </div>
            <div>
                <label for="weight">Weight</label>
                <input type="number" id="weight" name="weight" step="0.001" required>
            </div>
            <div>
                <label for="height">Height</label>
                <input type="number" id="height" name="height" step="0.001" required>
            </div>
            <div>
                <button type="submit">Pridat data</button>
            </div>
        </form>

        <?php if (!$dataList || sizeof($dataList) === 0) {
            echo "<p>Zoznam dát je prázdny</p>";
        } else {
            echo "
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>length</th>
                    <th>weight</th>
                    <th>height</th>
                </tr>
            </thead>
            <tbody>";
            foreach ($dataList as $data) {
                echo "<tr>
                <td>{$data->id}</td>
                <td>{$data->length}</td>
                <td>{$data->weight}</td>
                <td>{$data->height}</td>
                </tr>";
            }
            echo  "</tbody></table>";
        } ?>

        <div id="data-table">
        </div>
    </section>


    <a href='logout.php'>Odhlasit</a>

    <script>
        // let dataList = [];

        // const dataTable = document.getElementById("data-table");

        // fetch("http://localhost/phpuvod/data/index.php")
        //     .then(res => res.json())
        //     .then(data => {
        //         console.log(data);
        //         for (const key in data) {
        //             console.log(data[key]);
        //             dataTable.textContent = JSON.stringify(data[key]);
        //         }
        //     })
        //     .catch(console.log);
    </script>
</body>

</html>