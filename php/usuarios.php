<?php
session_start();
$conexion = mysqli_connect('mybd', 'root', 'test', 'TiendaPro');
if ($conexion->connect_error) {
    die("Conexion Fallida: " . $conexion->connect_error);
}

$operacion = $_POST["operacion"];

switch ($operacion) {
    case 1:
        InsertarUsuario();
        break;
    case 2:
        ModificarUsuario();
        break;
    case 3:
        ListaUsuarios();
        break;
}

function InsertarUsuario()
{
    global $conexion;
    $Nombre = $_POST['nombre'];
    $Usuario = $_POST['usuario'];
    $Password = $_POST['password'];

    $DML= "INSERT INTO Usuario (Nombre, Usuario, Contra, Activo)
            VALUES ('$Nombre', '$Usuario', '$Password', false);";

    try {
        mysqli_query($conexion, $DML);
        echo 1;
    } catch (\Throwable $th) {
        echo 0;
    }
        mysqli_close($conexion);
}

function ModificarUsuario()
{
    global $conexion;
    $id = $_POST["id"];
    $estado = $_POST["estado"];
    $rol = $_POST["rol"];

    if ($estado == 1) {
        $estado = "true";
    }
    else {
        $estado = "false";
    }

    $dml_estado = "UPDATE Usuario SET Activo = ".$estado." WHERE Id_Usuario = ".$id.";";
    $dml_removerAsignacion = "DELETE FROM Usuario_Rol WHERE Id_Usuario = ".$id.";";
    $dml_establecerAsignacion = "INSERT INTO Usuario_Rol VALUES (".$id.", ".$rol.");";

    try {
        if ($rol == 0) {
            mysqli_query($conexion, $dml_estado);
            mysqli_query($conexion, $dml_removerAsignacion);   
        }
        else {
            mysqli_query($conexion, $dml_estado);
            mysqli_query($conexion, $dml_removerAsignacion);
            mysqli_query($conexion, $dml_establecerAsignacion);
        }
        echo "1";

    } catch (\Throwable $th) {
        echo "0";
    }

    mysqli_close($conexion);
}

function ListaUsuarios()
{
    global $conexion;
    $sql = "SELECT Nombre, Usuario, Activo, Id_Usuario as ID FROM Usuario;";
    $ListaUsuarios = mysqli_query($conexion, $sql);
    if ($ListaUsuarios->num_rows > 0) {
        echo '<table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Accion</th>
                        </tr>
                </thead>
                <tbody>';
                
        while($row = $ListaUsuarios->fetch_assoc()) {

            if ($row['Activo'] == 1) {
                $estado = 'Activo';
            }
            else {
                $estado = 'Inactivo';
            }
            
            $ID = $row['ID'];

            $sql2 = "SELECT R.Nombre as ROL
                FROM Usuario U, ROL R, Usuario_Rol UR
                WHERE U.Id_Usuario = '$ID'
                AND UR.Id_Usuario = U.Id_Usuario
                AND UR.Id_Rol = R.Id_Rol;";
        
        $rol = mysqli_query($conexion, $sql2);

            if ($rol->num_rows > 0){
                while ($puesto = $rol->fetch_assoc()) {
                    $asignado = $puesto['ROL'];
                }
            }
            else{
                $asignado = 'No asignado';
            }
            
            $x = "'".$asignado."'";

            echo '
                <tr>
                    <th scope="row">'.$row['Nombre'].'</th>
                    <td>'.$row['Usuario'].'</td>
                    <td>'.$asignado.'</td>
                    <td>'.$estado.'</td> 
                    <td>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ModalUsuarios" onclick="ModalUserUp('.$ID.', '.$row['Activo'].','.$x.')">Modificar</button>
                    </td>
                </tr>';				
        }
        echo '
                </tbody>            
            </table>';
    }
    mysqli_close($conexion);
}
?>