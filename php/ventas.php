<?php
$conexion = mysqli_connect('mybd', 'root', 'test', 'TiendaPro');
if ($conexion->connect_error) {
    die("Conexion Fallida: " . $conexion->connect_error);
}

$operacion = $_POST["operacion"];

switch ($operacion) {
    case 1:
        IngresarVenta();
        break;
    case 2:
        ListaVentas();
        break;
    case 3:
        ModificarVenta();
        break;
    case 4:
        NombreUsuario();
        break;
    case 5:
        NombreProducto();
        break;
}

//Funciones para el manejo de ventas

function IngresarVenta()
{
    global $conexion;
    $Id_Venta = $_POST['factura'];
    $Id_Usuario = $_POST['id_usuario'];
    $Id_Producto = $_POST['id_producto'];
    $Cantidad = $_POST['cantidad'];

    $sql_PrecioProducto = "SELECT Precio FROM Producto WHERE Id_Producto = ".$Id_Producto.";";

    try {

        //Obtenemos el precio del producto.
        $registroPrecio = mysqli_query($conexion, $sql_PrecioProducto);
        if ($registroPrecio->num_rows > 0) {
            $fila = $registroPrecio->fetch_assoc();
            $Precio = $fila['Precio'];

            //Insertamos la venta registrada
            $dml_InsertVenta = "INSERT INTO Venta VALUES (".$Id_Venta.", ".$Id_Producto.", ".$Id_Usuario.", ".$Cantidad.", ".$Precio.");";
            mysqli_query($conexion, $dml_InsertVenta);
            echo 1;
        }
        else {
            echo 0;
        }
    } catch (\Throwable $th) {
        echo 0;
    }
}

function ListaVentas()
{
    global $conexion;
    $sql_ventasRegistradas = 
        'SELECT V.Id_Venta as "Factura",  U.Nombre as "Usuario", P.Nombre as "Producto", 
        V.Cantidad as "Cantidad", V.Precio as "Precio", (V.Cantidad * V.Precio) as "Total"
        FROM Venta V, Usuario U, Producto P
        WHERE
        V.Id_Usuario = U.Id_Usuario AND
        V.Id_Producto = P.Id_Producto;';

    try {
        $registros = mysqli_query($conexion, $sql_ventasRegistradas);
        echo
        '<button type="button" class="btn btn-success btn-lg" data-bs-toggle = "modal" data-bs-target = "#modal-Venta">Agregar +</button>
        <br><br>';
        if ($registros->num_rows > 0) {
            echo
            '<table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Factura</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio Uni.</th>
                    <th scope="col">Total</th>
            </thead>
            <tbody>';
            while ($fila =  $registros->fetch_assoc()){
                echo
                '<tr>
                    <th scope="row">'.$fila['Factura'].'</th>
                    <td>'.$fila['Usuario'].'</td>
                    <td>'.$fila['Producto'].'</td>
                    <td>'.$fila['Cantidad'].'</td>
                    <td>'.$fila['Precio'].'</td>
                    <td>'.$fila['Total'].'</td>
                </tr>';	
            }
        }
        else {
            echo "No se han agregado ventas, pulse en agregar para insertar.";
        }
    } catch (\Throwable $th) {
        echo  "No se pudo obtener la lista";
    }
    mysqli_close($conexion);

}

function ModificarVenta()
{
    # code...
}

function NombreUsuario()
{
    global $conexion;
    $id = $_POST['id'];
    $sql_NombreUsuario = "SELECT Usuario From Usuario WHERE Id_Usuario = ".$id.";";

    try {
        $registro = mysqli_query($conexion, $sql_NombreUsuario);
        if ($registro->num_rows > 0) {
            $usuario = $registro->fetch_assoc();
            echo $usuario['Usuario'];
        }
        else {
            echo "";
        }
    } catch (\Throwable $th) {
        echo "";
    }
    mysqli_close($conexion);
}

function NombreProducto()
{
    global $conexion;
    $id = $_POST['id'];
    $sql_NombreUsuario = "SELECT Nombre From Producto WHERE Id_Producto = ".$id.";";

    try {
        $registro = mysqli_query($conexion, $sql_NombreUsuario);
        if ($registro->num_rows > 0) {
            $producto = $registro->fetch_assoc();
            echo $producto['Nombre'];
        }
        else {
            echo "";
        }
    } catch (\Throwable $th) {
        echo "";
    }

    mysqli_close($conexion);
}
?>