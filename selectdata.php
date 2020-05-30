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
error_reporting(0);
//Obtener datos
require_once 'database.php';

echo "<table class='table'>";
echo "<tr><th>Id</th><th>Nombre</th><th>Apellido Paterno</th><th>Apellido Materno</th><th>Edad</th><th>E-Mail</th><th>Editar</th><th>Borrar</th></tr>";

//$sentencia = "SELECT id_registros, nombre, a_paterno, a_materno, edad, email FROM registros";
$sentenciaSELECT = "SELECT * FROM registros";

$stmt = $conn->prepare($sentenciaSELECT);
$stmt->execute();

//guardar en una variable los datos buscados y encontrados en la BD
$respuesta = $stmt->fetchAll();
$stmt = null;//cerrar la conexión, los datos ya los obtuvo del servidor

//ordenar los datos encontrados en una tabla
foreach ($respuesta as $key => $value) {
  
  echo '<tr>
          <td>'.  $value["id_registros"]. '</td>
          <td>'.  $value["nombre"]      . '</td>
          <td>'.  $value["a_paterno"]   . '</td>
          <td>'.  $value["a_materno"]   . '</td>
          <td>'.  $value["edad"]        . '</td>
          <td>'.  $value["email"]       . '</td>

          <td><a href="editar.php?id='. $value["id_registros"].'"> <span class="material-icons">edit</span>     </a></td>
          <td><a href="selectdata.php"> <span class="material-icons">cancel</span>   </a></td>
        </tr>';
}
echo "</table>";


//Eliminar datos

$sentenciaDELETE = "DELETE FROM registros WHERE id_registros = :id_registros";
$stmt = $conn->prepare($sentenciaDELETE);
$id_registros = $_GET["id_registros"];

$stmt -> bindParam(":id_registros", $id_registros, PDO::PARAM_INT);

$stmt->execute();

$stmt = null;

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