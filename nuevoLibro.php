<?php
require_once "conexion/conexion.php";
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">
    <title>Nuevo Libro</title>
</head>
<body>
  <h1>Registro de Nuevo Libro</h1>
  <form action="" method="post">
    <label for="isbn">ISBN:</label>
    <input type="text" id="isbn" name="isbn" onkeyup="buscarLibros()">
    <button type="button" onclick="buscarLibro()">Buscar</button><br><br>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre"><br><br>
    <label for="autor">Autor:</label>
    <input type="text" id="autor" name="autor"><br><br>
    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion"><br><br>
    <input type="hidden" id="estatus" name="estatus" value="1">
    <input type="hidden" id="idUsuario" name="idUsuario" value="1">
    <input type="submit" name="nuevoLibro" value="Guardar">
    
  </form>
    <?php
        if (isset($_POST['nuevoLibro'])) {

            $isbn = $_REQUEST['isbn'];
            $nombre = $_REQUEST['nombre'];
            $autor = $_REQUEST['autor'];
            $descripcion = $_REQUEST['descripcion'];
            $estatus = $_REQUEST['estatus'];
            $idUsuario = $_REQUEST['idUsuario'];

            $sql = "INSERT INTO libros (isbn, nombre, autor, descripcion, estatus, idUsuario) 
                     VALUES ('".$isbn."', '".$nombre."', '".$autor."', '".$descripcion."', '".$estatus."', '".$idUsuario."');";

           
            if ($conn->query($sql) === TRUE) {
                echo '<h2>Registro de libro Exitoso</h2><br><br>';
                echo '<div class="button-container">';
                echo '<a href="index.php"><button type="button" class="adopt-button">Salir</button><a>';
                echo '</div>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

    ?>

  <script>
    
    function buscarLibro() {
    
        const isbn = document.getElementById('isbn').value;
        const url = `https://www.googleapis.com/books/v1/volumes?q=isbn:${isbn}`;
        

        fetch(url)
            .then(response => response.json())
            .then(data => {
            const book = data.items[0].volumeInfo;
            document.getElementById('nombre').value = book.title;
            document.getElementById('autor').value = book.authors[0];
            document.getElementById('descripcion').value = book.description;
            })
            .catch(error => {
            console.error(error);
            });
    }
  </script>
</body>
</html>
