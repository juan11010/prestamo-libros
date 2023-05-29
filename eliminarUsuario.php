<?php
session_start();

$user = $_SESSION['username'];

if (!isset($user)) {
    header("location: loginForm.php");
    exit();
}

if (isset($_GET['idUsuario'])) {
    $idUsuario = $_GET['idUsuario'];

    // Realizar el proceso de eliminación del usuario con el ID proporcionado
    require_once "conexion/conexion.php";

    // Verificar si el usuario existe antes de eliminarlo
    $sql = "SELECT * FROM usuarios WHERE idUsuario = $idUsuario";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El usuario existe, proceder con la eliminación
        $sqlDelete = "DELETE FROM usuarios WHERE idUsuario = $idUsuario";
        if ($conn->query($sqlDelete) === true) {
            // Eliminación exitosa, redirigir al perfil
            header("Location: admin.php");
            exit();
        } else {
            // Error al eliminar el usuario, mostrar mensaje de error
            echo "Error al eliminar el usuario: " . $conn->error;
        }
    } else {
        // El usuario no existe, mostrar mensaje de error
        echo "El usuario no existe.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se proporcionó un ID de usuario válido, redirigir al perfil
    header("Location: miPerfil.php");
    exit();
}
?>
