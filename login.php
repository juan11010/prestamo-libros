<?php
ob_start();

session_start();
require_once "conexion/conexion.php";


if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $id = $row['idUsuario'];
    $nombre = $row['nombre'];
    $tipo = $row['tipo'];

    if($result->num_rows == 1) {

        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['tipo'] = $tipo;

        if($tipo == 1) {
            header("Location: miPerfil.php");
        } else {
            header("Location: admin.php");
        }
    } else {
        echo "Nombre de usuario o contrasena incorrectos";
        echo "<br>";
        echo '<a href="loginForm.php"><button type="button" class="adopt-button">Salir</button><a>';
    }
}

ob_end_flush();
?>
