<?php

if (!isset($_GET['id'])) {
    header("Location: homepage.php");
}

$apiErr = false;
$wasUpdated = false;

if (isset($_POST['length']) && isset($_POST['weight']) && isset($_POST['height'])) {
    $url = 'http://localhost/phpuvod/data/index.php?id=' . $_GET['id'];
    $requestBody = array('length' => $_POST['length'], 'weight' => $_POST['weight'], 'height' => $_POST['height']);

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'PUT',
            'content' => json_encode($requestBody)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { /* Handle error */
        $apiErr = "Error updating data!";
    } else {
        $wasUpdated = true;
    }
    // var_dump($result);
}

$dataResponse = file_get_contents('http://localhost/phpuvod/data/index.php?id=' . htmlspecialchars($_GET['id']));
$data = json_decode($dataResponse);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
    <title>Update data</title>
</head>

<body>
    <div class="text-center mt-5">
        <a href="homepage.php" class="btn btn-primary">Homepage</a>
    </div>
    <section class="card lg mt-5">
        <h2>Update data</h2>
        <?php 
          if (!$data) {
            echo "Data with id {$_GET['id']} not found";
        } else if ($wasUpdated) {
            echo "<p class='text-center success'>Data was successfully updated!</p>";
        }
        if ($apiErr) {
           
            echo "<div class='mt-1 text-center text-error'>
            <p class='error'>$apiErr</p>
            </div>";
        } ?>
        <form method="POST" action="updateData.php?id=<?php echo $_GET['id']; ?>" <?php echo $data ? "" : "hidden";?> >
            <div class="mb-3">
                <label for="length" class="form-label">Length</label>
                <input type="number" class="form-control" id="length" name="length" step="0.001" required value="<?php echo $data->length; ?>">
            </div>
            <div class="mb-3">
                <label for="weight" class="form-label">Weight</label>
                <input type="number" class="form-control" id="weight" name="weight" step="0.001" required value="<?php echo $data->weight; ?>">
            </div>
            <div class="mb-3">
                <label for="height" class="form-label">Height</label>
                <input type="number" class="form-control" id="height" name="height" step="0.001" required value="<?php echo $data->height; ?>">
            </div>
            <div class="btn-center">
                <button type="submit" class="btn btn-primary btn-size">Update</button>
            </div>
        </form>

    </section>
</body>

</html>