<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: loginForm.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <h1>Bienvenido</h1>
    </body>
</html>
