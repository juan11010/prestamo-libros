<?php
    $servername = "sql201.epizy.com"; // replace with your server name
    $username = "epiz_34266889"; // replace with your MySQL username
    $dbname = "epiz_34266889_prestamo_libros"; // replace with your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, "853nxgk0", $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
   
