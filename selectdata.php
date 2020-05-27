<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="icons8-home-64.png" type="image/png">
    <title>PDO S.A. de C.V. | Select Data</title>
</head>
<body>


<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Nombre</th><th>Apellido Paterno</th><th>Apellido Materno</th><th>Edad</th><th>E-Mail</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  
    function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:150px;border:1px solid black;'>" . parent::current() . "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}

require_once 'database.php';

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $stmt = $conn->prepare("SELECT id_registros, nombre, a_paterno, a_materno, edad, email FROM registros");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
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