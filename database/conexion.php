<?php
    $servername = "localhost";
    $username = "root";
    $password = "rootpassword";
    $dbname = "carserv";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    echo "Conexión exitosa";
?>
