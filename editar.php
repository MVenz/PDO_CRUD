<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="icons8-home-64.png" type="image/png">
    
    <title>PDO S.A. de C.V. | Editar</title>
</head>
<body>
    <?php
        error_reporting(0);
        require_once 'database.php';

        $sentenciaSelect = "SELECT id_registros, nombre, a_paterno, a_materno, edad, email FROM registros WHERE id_registros=:id";
        $stmt = $conn->prepare($sentenciaSelect);

        $datos = $_GET['id'];
        
        $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);
        $stmt -> execute();
        $respuesta = $stmt->fetch();
        //$stmt = null;
        
        echo '<h3>Editar un registro </h3> 
            
        <div class="editar">
            <form method="post">
                <input type="hidden" name="id" placeholder="ID" value = "'.$respuesta["id_registros"].'" required>
                <table>
                    <tr>
                        <td><label for="nombre">Nombre:</label></td>
                        <td><input type="text" name="nombre" size = "30" value = "'.$respuesta["nombre"].'" required><br></td>
                    </tr>
                    <tr>
                        <td><label for="apellido_paterno">Apellido Paterno:</label></td>
                        <td><input type="text" name="apellido_paterno" size = "30" value = "'.$respuesta["a_paterno"].'" required><br></td>
                    </tr>
                    <tr>
                        <td><label for="apellido_materno">Apellido Materno:</label></td>
                        <td><input type="text" name="apellido_materno" size = "30" value = "'.$respuesta["a_materno"].'" required><br></td>
                    </tr>
                    <tr>
                        <td><label for="edad">Edad:</label></td>
                        <td><input type="text" name="edad" size = "30" value = "'.$respuesta["edad"].'" required><br></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td></td>
                        <td><input type="email" name="email" size = 30 value = "'.$respuesta["email"].'" required><br></td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
            
        </div>';
        ?>

        <?php
        if(isset($_POST['nombre'])){

            $id_registros       =   $_POST['id'];
            $nombre             =   $_POST['nombre'];
            $apellido_paterno   =   $_POST['apellido_paterno'];
            $apellido_materno   =   $_POST['apellido_materno'];
            $edad               =   $_POST['edad'];
            $email              =   $_POST['email'];
            $sql                =   "UPDATE registros SET nombre=:nombre ,a_paterno=:a_paterno,a_materno=:a_materno,edad=:edad,email=:email WHERE id_registros = :id_registros";

            try { 
                // prepare sql and bind parameters
                $stmt = $conn->prepare($sql);
                
                //bind parameters
                //               parámetro          variable            data type
                //               base de datos      formulario (name)   tipo de dato
                $stmt->bindParam(':id_registros',   $id_registros,      PDO::PARAM_INT);
                $stmt->bindParam(':nombre',         $nombre,            PDO::PARAM_STR);
                $stmt->bindParam(':a_paterno',      $apellido_paterno,  PDO::PARAM_STR);
                $stmt->bindParam(':a_materno',      $apellido_materno,  PDO::PARAM_STR);
                $stmt->bindParam(':edad',           $edad,              PDO::PARAM_INT);
                $stmt->bindParam(':email',          $email,             PDO::PARAM_STR);
                
                $stmt->execute();

                //header("location: selectdata.php");

            } catch(PDOException $e) {
                echo "**Error: " . $e->getMessage();
            }
        
            $conn = null;

        }
        
              
    ?>
    
</body>
</html>

<style>

    *{
        margin: 10px;
        padding: 10px;
    }
    .editar{
        position: relative;
        background-color: aliceblue;
    }


</style>