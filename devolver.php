<?php
session_start();

$user = $_SESSION['username'];
$userID = $_SESSION['id'];

if (!isset($user)) {
    header("location: loginForm.php");
    exit();
}

require_once "conexion/conexion.php";

if (isset($_GET['idLibros'])) {
    $idLibros = $_GET['idLibros'];

    // Verificar si el usuario está seguro de marcar como devuelto
    if (isset($_POST['confirmar'])) {
        // Actualizar el campo 'estatus' en la tabla 'prestamorel'
        $sqlUpdatePrestamoRel = "UPDATE prestamorel SET estatus = 0 WHERE idLibros = $idLibros";
        if ($conn->query($sqlUpdatePrestamoRel) === TRUE) {
            // Actualizar el campo 'estatus' en la tabla 'libros'
            $sqlUpdateLibros = "UPDATE libros SET estatus = 1 WHERE idLibros = $idLibros";
            if ($conn->query($sqlUpdateLibros) === TRUE) {
                // Buscar el valor más reciente en la tabla 'prestamorel' para el mismo idLibros y actualizar el campo 'estatus' a 0
                $sqlUpdateLastPrestamoRel = "UPDATE prestamorel SET estatus = 0 WHERE idPrestamos = (SELECT idPrestamos FROM prestamorel WHERE idLibros = $idLibros ORDER BY idPrestamos DESC LIMIT 1)";
                if ($conn->query($sqlUpdateLastPrestamoRel) === TRUE) {
                    echo "Libro devuelto exitosamente.";
                    echo '<a href="miPerfil.php"><button type="button" class="adopt-button">Salir</button></a>';
                } else {
                    echo "Error al actualizar el estatus del último préstamo en prestamorel: " . $conn->error;
                }
            } else {
                echo "Error al actualizar el estatus del libro en la tabla libros: " . $conn->error;
            }
        } else {
            echo "Error al actualizar el estatus en la tabla prestamorel: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Devolver Libro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
        }

        p {
            margin: 10px 0;
        }

        form {
            margin-top: 20px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Devolver Libro</h1>
    <p>¿Estás seguro de marcar este libro como devuelto?</p>
    <form action="" method="POST">
        <input type="submit" name="confirmar" value="Confirmar">
        <a href=""></a>
    </form>
</body>
</html>
