<?php
require_once "conexion/conexion.php";

// Obtener el id del libro seleccionado
$idLibro = $_GET['idLibro'];

// Consultar información del libro seleccionado
$sql = "SELECT * FROM libros WHERE idLibros = $idLibro";
$result = $conn->query($sql);
$libro = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Solicitar Libro</title>
</head>
<body>
    <h1>Solicitar Libro</h1>
    <form action="procesarSolicitud.php?idLibro=<?php echo $idLibro; ?>" method="post">
        <label for="fechaPrestamo">Fecha de Préstamo:</label>
        <input type="date" id="fechaPrestamo" name="fechaPrestamo" required><br><br>
        
        <label for="fechaEntrega">Fecha de Entrega:</label>
        <input type="date" id="fechaEntrega" name="fechaEntrega" required><br><br>
        
        <label for="telefonoSolicitante">Teléfono del Solicitante:</label>
        <input type="tel" id="telefonoSolicitante" name="telefonoSolicitante" required><br><br>
        
        <input type="submit" name="solicitar" value="Solicitar">
    </form>
</body>
</html>