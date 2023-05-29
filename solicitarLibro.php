<?php
session_start();

// aqui puedes agregar mas variables de session
$user = $_SESSION['username'];

if (!isset($user)) {
    header("location: loginForm.php");
    exit();
}
?>

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
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
    <h2>Solicitar Libro</h2>
    <form action="procesarSolicitud.php?idLibro=<?php echo $idLibro; ?>" method="post" class="form-example">
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
