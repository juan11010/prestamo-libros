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
        echo '<p style="color: red; font-weight: bold; font-family: Arial, sans-serif;">Nombre de usuario o contraseña incorrectos</p>';
        echo '<br>';
        echo '<a href="loginForm.php" style="display: inline-block; background-color: #007bff; color: #fff; border: none; padding: 5px 10px; text-decoration: none; cursor: pointer; font-family: Arial, sans-serif;">Salir</a>';
    
    
    }
}

ob_end_flush();
?>
