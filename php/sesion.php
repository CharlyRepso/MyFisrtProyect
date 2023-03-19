<?php
session_start();
$conexion = mysqli_connect('mybd', 'root', 'test', 'TiendaPro');
if ($conexion->connect_error) {
    die("Conexion Fallida: " . $conexion->connect_error);
}

$operacion = $_POST["operacion"];

switch ($operacion) {
    case 1:
        IniciarSesion();
        break;
    case 2:
        CerrarSesion();
        break;
}

function IniciarSesion()
{
    global $conexion;
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    //Soliciatamos a la base de datos el usario ingresado
    $SQL = "SELECT U.Id_Usuario as ID, U.Activo as Estado
    FROM Usuario U
    WHERE U.Usuario = '$usuario'
    AND U.Contra = '$password';";


    $Validar = mysqli_query($conexion, $SQL);

    //Validamos si el usuario exite o si los datos han sido ingresados correctamente
    if ($Validar->num_rows > 0) {
        while ($array = $Validar->fetch_assoc()) {

            //Si el Usuario existe procedemos a verificar si esta activo.
            if ($array['Estado'] == 1) {
                
                //Si esta activo consultamos el rol que ocupa para retornarlo.
                $ID = $array['ID'];
                $SQL = "SELECT R.Nombre as ROL, U.Nombre, U.Usuario 
                        FROM Usuario U, ROL R, Usuario_Rol UR
                        WHERE U.Id_Usuario = '$ID'
                        AND UR.Id_Usuario = U.Id_Usuario
                        AND UR.Id_Rol = R.Id_Rol;";
                
                $Tipo = mysqli_query($conexion, $SQL);
                
                $array2 = $Tipo->fetch_assoc();
                $_SESSION['Rol'] = $array2['ROL'];
                $_SESSION['Usuario'] = $array2['Usuario'];
                $_SESSION['Nombre'] = $array2['Nombre'];
                echo $array2['ROL'];
                

            }
            else {
                echo "Inactivo";
            }
        }
    }
    else {
        echo "Error";
    }

    mysqli_close($conexion);

}

function CerrarSesion()
{
    session_destroy();
    echo 1;
}

?>