<?php 

if (isset($_GET['id'])) {
    $url = 'http://localhost/phpuvod/data/index.php?id=' . $_GET['id'];
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'DELETE',
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { /* Handle error */
        $err =  "Chyba pri mazani dát";
    }
}

header("Location: homepage.php");


