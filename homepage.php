<?php
session_start();

$user;
if (isset($_SESSION['user'])) {
    // var_dump($_SESSION['user']);
    $user = $_SESSION['user'];
} else {
    header("Location: login.php");
}

$apiErr = false;

if (isset($_POST['length']) && isset($_POST['weight']) && isset($_POST['height'])) {
    $url = 'http://localhost/phpuvod/data/index.php';
    $requestBody = array('length' => $_POST['length'], 'weight' => $_POST['weight'], 'height' => $_POST['height']);

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($requestBody)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { /* Handle error */
        $apiErr = "Chyba pri vytvorení nových dát!";
    }
    // var_dump($result);
}

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="styles.css" rel="stylesheet">
    <title>Homepage</title>
</head>

<body>
    <header class="text-center">
        <h1>Homepage</h1>
        <a href='logout.php' class="btn btn-primary btn-size">Logout</a>
    </header>

    <section class="card lg mt-5">
        <h2>User info</h2>
        <table class="table">
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

    <section class="card lg mt-4">
        <h2>Data</h2>

        <?php if (!$dataList || sizeof($dataList) === 0) {
            echo "<p>List of data is empty</p>";
        } else {
            echo "
        <table class='table table-striped table-hover'>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Length</th>
                    <th>Weight</th>
                    <th>Height</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>";
            foreach ($dataList as $data) {
                echo "<tr>
                <td>{$data->id}</td>
                <td>{$data->length}</td>
                <td>{$data->weight}</td>
                <td>{$data->height}</td>
                <td>
                    <button id='deleteBtn' data-id='{$data->id}' class='btn btn-danger deleteBtn' data-toggle='modal' data-target='#deleteModal' >Delete</button>
                    <a href='http://localhost/phpuvod/updateData.php?id={$data->id}' class='btn btn-warning'>Update</a>
                </td>
                </tr>";
            }
            echo  "</tbody></table>";
        } ?>
    </section>

    <section class="mt-4 card lg mb-5">
        <h2>Data insertion</h2>
        <?php
        if ($apiErr) {
            echo "<div class='mt-1 text-center text-error'>
            <p class='error'>$apiErr</p>
            </div>";
        }
        ?>
        <form method="POST" id="addForm" action="homepage.php">
            <div class="mb-3">
                <label for="length" class="form-label">Length</label>
                <input type="number" class="form-control" id="length" name="length" step="0.001" required>
            </div>
            <div class="mb-3">
                <label for="weight" class="form-label">Weight</label>
                <input type="number" class="form-control" id="weight" name="weight" step="0.001" required>
            </div>
            <div class="mb-3">
                <label for="height" class="form-label">Height</label>
                <input type="number" class="form-control" id="height" name="height" step="0.001" required>
            </div>
            <div class="btn-center">
                <button type="submit" class="btn btn-primary btn-size">Insert data</button>
            </div>
        </form>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to delete this data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" href="#" id="confirmDeleteBtn" class="btn btn-danger" data-id="">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const deleteBtn = document.getElementsByClassName('deleteBtn');

        for(let index = 0; index < deleteBtn.length; index++) {
            deleteBtn[index].addEventListener('click', function(e) {
            confirmDeleteBtn.setAttribute("data-id", e.target.getAttribute("data-id"));
        });
        }

        confirmDeleteBtn.addEventListener('click', async function(e){
            confirmDeleteBtn.href="http://localhost/phpuvod/deleteItem.php?id=" + e.target.getAttribute("data-id");
        });

        // const deleteDataHandler = async (id) => {
        //     await fetch("http://localhost/phpuvod/data/index.php?id=" + id, {
        //         method: 'DELETE',
        //         headers: {
        //             "Content-Type": "application/json"
        //         }
        //     });
        //     location.assign('http://localhost/phpuvod/homepage.php');
        // }

        // const addForm = document.getElementById("addForm");
        // const lengthInput = document.getElementById('length');
        // const weightInput = document.getElementById('weight');
        // const heightInput = document.getElementById('height');

        // addForm.addEventListener('submit', function(e) {
        //     const body = {
        //         length: lengthInput.value,
        //         weight: weightInput.value,
        //         height: heightInput.value
        //     }
        //     console.log(body);
        //     fetch("http://localhost/phpuvod/data/index.php", {
        //             method: 'POST',
        //             body: JSON.stringify(body),
        //             headers: {
        //                 "Content-Type": "application/json"
        //             }
        //         }).then(data => {
        //             console.log(data);
        //             for (const key in data) {
        //                 console.log(data[key]);
        //             }
        //         })
        //         .catch(console.log);
        // })

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