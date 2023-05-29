<?php
session_start();

$user = $_SESSION['username'];

if (!isset($user)) {
    header("location: loginForm.php");
    exit();
}
//si el usuario es de tipo 1, redirigir al perfil
if ($_SESSION['tipo'] == 1) {
    header("location: miPerfil.php");
    exit();
}
?>

<?php
require_once "conexion/conexion.php";

// Obtener el estado del checkbox 
$mostrarSoloAdmins = isset($_POST['mostrar_solo_disponibles']) ? true : false;

// Obtener los usuarios de la base de datos
$sql = "SELECT * FROM usuarios";
if ($mostrarSoloAdmins) {
    $sql .= " WHERE estatus = 1";
}

$result = $conn->query($sql);

//obtener los libros de la base de datos
$sql2 = "SELECT * FROM libros";
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
    }

    h1 {
        color: #333;
        margin-top: 20px;
    }

    a {
        margin-right: 10px;
        text-decoration: none;
        color: #007bff;
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
</style>


<body>
    <h1>Hola <?php echo $user; ?></h1>
    <a href="nuevoLibro.php">Prestar libro</a>
    <a href="librosTomados.php">Libros tomados</a>
    <a href="librosPrestados.php">Libros prestados</a>
    <a href="logout.php">Salir</a>
    <br>
    <!-- Inicio de zona para mostrar libros -->
    <div>
        <h1>Usuarios:</h1>
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
        
        <h1>Libros</h1>
        <!-- TABLA LIBROS -->
        <table>
            <tr>
                <th>Nombre</th>
                <th>Autor</th>
                <th>Descripción</th>
                <th>Estatus</th>
                <th>Acción</th>
            </tr>
            <?php while ($row = $result2->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['autor']; ?></td>
                    <td><?php echo $row['descripcion']; ?></td>
                    <td>
                        <?php if ($row['estatus'] == 1) :
                            echo 'Disponible';
                        ?>

                        <?php else : ?>
                            <?php echo 'No disponible'; ?>
                        <?php endif; ?>
                    <td>
                        <?php 
                            echo  '<a href="eliminarLibro.php?idLibro=' . $row['idLibros'] . '">Eliminar</a>';
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>



    </div>
</body>


</html>
