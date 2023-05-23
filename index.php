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

        th, td {
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
        <h1>Hola Internauta</h1>
        <a href="nuevoUsuario.php">Nuevo usuario</a>
        <a href="nuevoLibro.php">Nuevo Libro</a>
        <a href="miPerfil.php">Mi perfil</a>
        <br>
        <!-- Inicio de zona para mostrar libros -->
        <div>
            <h1>Libros disponibles:</h1><form method="POST">
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
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['ISBN']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['autor']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td>
                            <?php if (!empty($row['foto'])): ?>
                                <img src="uploads/<?php echo $row['foto']; ?>" alt="Foto del libro" class="book-image">
                            <?php else: ?>
                                No disponible
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($row['estatus'] == 1): 
                            echo  '<a href="solicitarlibro.php?idLibro=' . $row['idLibros'] . '">Solicitar</a>';    
                            ?>
                                
                            <?php else: ?>
                                <button type="button" class="button" disabled>No disponible</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>

        </div>
    </body>


</html>