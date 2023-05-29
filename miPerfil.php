<?php
session_start();

$user = $_SESSION['username'];

if (!isset($user)) {
    header("location: loginForm.php");
    exit();
}
?>

<?php
require_once "conexion/conexion.php";

// Obtener el estado del checkbox
$mostrarSoloDisponibles = isset($_POST['mostrar_solo_disponibles']) ? true : false;

// Obtener los libros de la base de datos
$sql = "SELECT * FROM libros";
if ($mostrarSoloDisponibles) {
    $sql .= " WHERE estatus = 1";
}

$result = $conn->query($sql);

// Obtener los prestamos de la base de datos
$sql2 = "SELECT * FROM prestamorel";
$result2 = $conn->query($sql2);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Prestamo de libros</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/estilo.css" rel="stylesheet">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 20px;
    }

    h1 {
        color: #333;
    }

    a {
        color: #007bff;
        text-decoration: none;
        margin-right: 10px;
    }

    form {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    input[type="checkbox"] {
        margin-right: 5px;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
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
</style>

<body>
        <h1>Hola <?php echo $user; ?></h1>
    <a href="nuevoLibro.php">Prestar libro</a>
    <a href="misLibros.php">Mis Libros</a>
    <a href="logout.php">Salir</a>
    <br>
    <!-- Inicio de zona para mostrar libros -->
    <div>
        <!--  si fechaPrestamo es dentro de 7 dias, mostrar un echo que diga que el libro esta proximo a vencer -->
        
        <h1>Libros disponibles:</h1>
        <form method="POST">
            <label for="mostrar_solo_disponibles">Mostrar solo disponibles:</label>
            <input type="checkbox" id="mostrar_solo_disponibles" name="mostrar_solo_disponibles" <?php echo $mostrarSoloDisponibles ? 'checked' : ''; ?>>
            <input type="submit" value="Filtrar">
        </form>

        <table>
            <tr>
                <th>ISBN</th>
                <th>Nombre</th>
                <th>Autor</th>
                <th>Descripción</th>
                <th>Foto</th>
                <th>Acción</th>
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
                    <td>
                        <?php if ($row['estatus'] == 1) :
                            echo  '<a href="solicitarlibro.php?idLibro=' . $row['idLibros'] . '">Solicitar</a>';
                        ?>

                        <?php else : ?>
                            <button type="button" class="button" disabled>No disponible</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

    </div>
</body>


</html>
