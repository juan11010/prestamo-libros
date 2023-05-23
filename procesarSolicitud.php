<?php
require_once "conexion/conexion.php";

// Obtener el id del libro seleccionado
$idLibro = $_GET['idLibro'];

// Obtener la fecha de préstamo y fecha de entrega del formulario
$fechaPrestamo = $_POST['fechaPrestamo'];
$fechaEntrega = $_POST['fechaEntrega'];

// Obtener el número de teléfono del solicitante del formulario
$telefonoSolicitante = $_POST['telefonoSolicitante'];

// ID del usuario (temporalmente establecido como 8)
$idUsuario = 8;

// Actualizar el registro en la tabla prestamoRel
$sql = "INSERT INTO prestamoRel (idLibros, idUsuario, fechaPrestamo, fechaEntrega, estatus)
        VALUES ('$idLibro', '$idUsuario', '$fechaPrestamo', '$fechaEntrega', 1)";

if ($conn->query($sql) === TRUE) {
    // Actualizar el valor de librosTomados en la tabla usuarios
    $sql = "UPDATE usuarios SET librosTomados = librosTomados + 1 WHERE idUsuario = $idUsuario";
    $conn->query($sql);

    // Actualizar el valor de estatus en la tabla libros
    $sql = "UPDATE libros SET estatus = 0 WHERE idLibros = $idLibro";
    $conn->query($sql);

    echo '<h2>Solicitud de libro exitosa</h2>';
    echo '<p>Libro solicitado correctamente.</p>';
    echo '<div class="button-container">';
    echo '<a href="index.php"><button type="button" class="adopt-button">Salir</button></a>';
    echo '</div>';
} else {
    echo 'Error al solicitar el libro: ' . $conn->error;
}

$conn->close();
?>