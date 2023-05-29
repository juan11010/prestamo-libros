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
$mostrarSoloAdmins = isset($_POST['mostrar_solo_disponibles']) ? true : false;

// Obtener los libros de la base de datos
$sql = "SELECT * FROM usuarios";
if ($mostrarSoloAdmins) {
    $sql .= " WHERE estatus = 1";
}

$result = $conn->query($sql);
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
    table {
        border-collapse: collapse;
        width: 100%;
        font-family: Arial, Helvetica, sans-serif;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .button-container {
        margin-top: 10px;
    }

    .book-image {
        max-height: 150px;
    }
</style>

<body>
        <h1>Hola <?php echo $user; ?></h1>
<!--     <a href="nuevoLibro.php">Prestar libro</a>
    <a href="librosTomados.php">Libros tomados</a>
    <a href="librosPrestados.php">Libros prestados</a>
 -->    <a href="logout.php">Salir</a>
    <br>
    <!-- Inicio de zona para mostrar libros -->
    <div>
        <h1>Usuarios:</h1>
        <form method="POST">
            <label for="mostrar_solo_disponibles">Mostrar solo administradores:</label>
            <input type="checkbox" id="mostrar_solo_disponibles" name="mostrar_solo_disponibles" <?php echo $mostrarSoloAdmins ? 'checked' : ''; ?>>
            <input type="submit" value="Filtrar">
        </form>

       <table>
            <tr>
                <th>Nombre</th>
                <th>Username</th>
                <th>Tipo</th>
                <th>Libros tomados</th>
                <th>Libros prestados</th>
                <th>Acción</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td>
                        <?php if ($row['tipo'] == 1) :
                            echo 'Administrador';
                        ?>

                        <?php else : ?>
                            <?php echo 'Usuario'; ?>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $row['librosTomados']; ?></td>
                    <td><?php echo $row['librosPrestados']; ?></td>
                    <td>
                        <?php 
                            echo  '<a href="eliminarUsuario.php?idUsuario=' . $row['idUsuario'] . '">Eliminar</a>';
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        
        <!-- TABLA USUARIOS -->
        <table>
            <tr>
                <th>Nombre</th>
                <th>Username</th>
                <th>Tipo</th>
                <th>Libros tomados</th>
                <th>Libros prestados</th>
                <th>Acción</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td>
                        <?php if ($row['tipo'] == 1) :
                            echo 'Administrador';
                        ?>

                        <?php else : ?>
                            <?php echo 'Usuario'; ?>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $row['librosTomados']; ?></td>
                    <td><?php echo $row['librosPrestados']; ?></td>
                    <td>
                        <?php 
                            echo  '<a href="eliminarUsuario.php?idUsuario=' . $row['idUsuario'] . '">Eliminar</a>';
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

    </div>
</body>


</html>