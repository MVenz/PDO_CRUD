<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="icons8-home-64.png" type="image/png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <title>PDO S.A. de C.V. | Select Data</title>
</head>
<body>


<?php

require_once 'database.php';

echo "<table class='table'>";
echo "<tr><th>Id</th><th>Nombre</th><th>Apellido Paterno</th><th>Apellido Materno</th><th>Edad</th><th>E-Mail</th><th>Acciones</th></tr>";

//$sentencia = "SELECT id_registros, nombre, a_paterno, a_materno, edad, email FROM registros";
$sentencia = "SELECT * FROM registros";

$stmt = $conn->prepare($sentencia);
$stmt->execute();

//guardar en una variable los datos buscados
$respuesta = $stmt->fetchAll();
$stmt = null;//cerrar la conexión, los datos ya los obtuvo del servidor

//ordenar los datos en la tabla
foreach ($respuesta as $key => $value) {
  
  echo '<tr>
          <td>'.  $value["id_registros"]. '</td>
          <td>'.  $value["nombre"]      . '</td>
          <td>'.  $value["a_paterno"]   . '</td>
          <td>'.  $value["a_materno"]   . '</td>
          <td>'.  $value["edad"]        . '</td>
          <td>'.  $value["email"]       . '</td>

          <td><a href="editar.php?id='. $value["id_registros"].'"><button>Editar</button></a></td>
          <td><a href="editar.php?id='. $value["id_registros"].'"><button>Borrar</button></a></td>         
        </tr>';
}
echo "</table>";

?>
    
</body>
</html>

<style>

    *{
        margin: 10px;
        padding: 10px;
    }
    .insertar{
        position: relative;
        background-color: aliceblue;
    }


</style>