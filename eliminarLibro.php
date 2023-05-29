<?php
session_start();

$user = $_SESSION['username'];

if (!isset($user)) {
    header("location: loginForm.php");
    exit();
}

if (isset($_GET['idLibro'])) {
    $idLibro = $_GET['idLibro'];

    // Realizar el proceso de eliminación del libro con el ID proporcionado
    require_once "conexion/conexion.php";

    // Verificar si el libro existe antes de eliminarlo
    $sql = "SELECT * FROM libros WHERE idLibros = $idLibro";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El libro existe, proceder con la eliminación
        $sqlDelete = "DELETE FROM libros WHERE idLibros = $idLibro";
        if ($conn->query($sqlDelete) === true) {
            // Eliminación exitosa, redirigir al perfil
            header("Location: admin.php");
            exit();
        } else {
            // Error al eliminar el libro, mostrar mensaje de error
            echo "Error al eliminar el libro: " . $conn->error;
        }
    } else {
        // El libro no existe, mostrar mensaje de error
        echo "El libro no existe.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se proporcionó un ID de libro válido, redirigir al perfil
    header("Location: miPerfil.php");
    exit();
}
?>
