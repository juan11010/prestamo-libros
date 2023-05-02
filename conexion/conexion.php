 <?php
    $servername = "localhost"; // replace with your server name
    $username = "root2"; // replace with your MySQL username
    $dbname = "prestamo_libros"; // replace with your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, "", $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
   
