<?php
require_once "conexion/conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Registro de usuario</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/estilos.css" rel="stylesheet">
</head>

<body>
    <form action="nuevoUsuario.php" method="post">
        <h2>Registro de nuevo usuario</h2>
        <label for="name">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="usuario">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="pwd">Password:</label>
        <input type="password" id="pwd" name="pwd" required>

        <input type="submit" name="registro" value="Registrarse">
    </form>
    <?php
    if (isset($_POST['registro'])) {

        $nombre = $_REQUEST['nombre'];
        $username = $_REQUEST['username'];
        $password = $_REQUEST['pwd'];
        $sql = "INSERT INTO usuarios (nombre, username, password, tipo, librosTomados, librosPrestados) 
                 VALUES ('".$nombre."', '".$username."', '".$password."', 1, 0, 0);";

        if ($conn->query($sql) === TRUE) {
            echo '<h2>Registro Exitoso</h2><br><br>';
            echo '<div class="button-container">';
            echo '<a href="index.php"><button type="button" class="adopt-button">Salir</button><a>';
            echo '</div>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    ?>
</body>

</html>
