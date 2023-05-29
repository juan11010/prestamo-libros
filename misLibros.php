<?php
session_start();

$user = $_SESSION['username'];
$userID = $_SESSION['id'];

if (!isset($user)) {
    header("location: loginForm.php");
    exit();
}
?>

<?php
require_once "conexion/conexion.php";


// Obtener los libros de la base de datos
$sql = "SELECT * FROM libros WHERE idUsuario = $userID";
$sql1 = "SELECT p.*, l.* FROM prestamoRel p JOIN libros l ON p.idLibros = l.idLibros WHERE p.idUsuario = $userID";


$result = $conn->query($sql);
$result1 = $conn->query($sql1);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/estilos.css" rel="stylesheet">
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    h1 {
        color: #333;
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ccc;
    }

    .book-image {
        max-width: 100px;
        max-height: 100px;
    }
</style></head>

<body>

    <div>
        <h1>Libros Prestados:</h1>
        <table>
            <tr>
                <th>ISBN</th>
                <th>Nombre</th>
                <th>Autor</th>
                <th>Descripción</th>
                <th>Foto</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['ISBN']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['autor']; ?></td>
                    <td><?php echo $row['descripcion']; ?></td>
                    <td>
                        <?php if (!empty($row['foto'])) : ?>
                            <img src="uploads/<?php echo $row['foto']; ?>" alt="Foto del libro" class="book-image">
                        <?php else : ?>
                            No disponible
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div>
        <h1>Libros Tomados:</h1>
        <table>
            <tr>
                <th>Fecha prestamo</th>
                <th>Fecha entrega</th>
                <th>ISBN</th>
                <th>Nombre</th>
                <th>Autor</th>
                <th>Descripción</th>
                <th>Foto</th>
                <th>Accion</th>
            </tr>
            <?php while ($row1 = $result1->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row1['fechaPrestamo']; ?></td>
                    <td><?php echo $row1['fechaEntrega']; ?></td>
                    <td><?php echo $row1['ISBN']; ?></td>
                    <td><?php echo $row1['nombre']; ?></td>
                    <td><?php echo $row1['autor']; ?></td>
                    <td><?php echo $row1['descripcion']; ?></td>
                    <td>
                        <?php if (!empty($row1['foto'])) : ?>
                            <img src="uploads/<?php echo $row1['foto']; ?>" alt="Foto del libro" class="book-image">
                        <?php else : ?>
                            No disponible
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php 
                            echo  '<a href="devolver.php?idLibros=' . $row1['idLibros'] . '">Devolver</a>';
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>

</html>

