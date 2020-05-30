<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="icons8-home-64.png" type="image/png">
    
    <title>PDO S.A. de C.V. | Registrar</title>
</head>
<body>
    <h3>Insertar un registro </h3> 

    <div class="insertar">

        <form action="" method="get">

            <table>
                <tr>
                    <td><label for="nombre">Nombre:</label></td>
                    <td><input type="text" name="nombre" id=""><br></td>
                </tr>
                
                <tr>
                    <td><label for="apellido_paterno">Apellido Paterno:</label></td>
                    <td><input type="text" name="apellido_paterno" id=""><br></td>
                </tr>
                
                <tr>
                    <td><label for="apellido_materno">Aepllido Materno:</label></td>
                    <td><input type="text" name="apellido_materno" id=""><br></td>
                </tr>
                
                <tr>
                    <td><label for="edad">Edad:</label></td>
                    <td><input type="text" name="edad" id=""><br></td>
                </tr>
                
                <tr>
                    <td><label for="email">Email:</label></td></td>
                    <td><input type="email" name="email" id=""><br></td>
                </tr>

            </table>
            
            <button type="submit" class="btn btn-primary">Guardar</button>
        
        </form>
    </div>    
</body>
</html>

<?php
error_reporting(0);
require_once 'database.php';

$nombre             =   $_GET['nombre'];
$apellido_paterno   =   $_GET['apellido_paterno'];
$apellido_materno   =   $_GET['apellido_materno'];
$edad               =   $_GET['edad'];
$email              =   $_GET['email'];
$sql                =   "INSERT INTO `registros` (`nombre`,`a_paterno`,`a_materno`,`edad`,`email`)
                        VALUES (:nombre, :a_paterno, :a_materno, :edad, :email)";

try { 
    // prepare sql and bind parameters
    $stmt = $conn->prepare($sql);
    
    //bind parameters
    //               parámetro      variable            data type
    //               base de datos  formulario (name)   tipo de dato
    $stmt->bindParam(':nombre',     $nombre,            PDO::PARAM_STR);
    $stmt->bindParam(':a_paterno',  $apellido_paterno,  PDO::PARAM_STR);
    $stmt->bindParam(':a_materno',  $apellido_materno,  PDO::PARAM_STR);
    $stmt->bindParam(':edad',       $edad,              PDO::PARAM_INT);
    $stmt->bindParam(':email',      $email,             PDO::PARAM_STR);
    
    $stmt -> execute();
    //echo "New records created successfully";

    /*echo '<div class="alert alert-primary" role="alert">';
    echo 'New records created successfully';
    echo '</div>';*/

    header("Location: insertar.php");

} catch(PDOException $e) {
    //echo "**Error: " . $e->getMessage();
}

$conn = null;

?>

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