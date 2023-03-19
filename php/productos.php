<?php
$conexion = mysqli_connect('mybd', 'root', 'test', 'TiendaPro');
if ($conexion->connect_error) {
    die("Conexion Fallida: " . $conexion->connect_error);
}

$operacion = $_POST['operacion'];

switch ($operacion) {
    case 1:
        listaProducto();
        break;
    case 2:
        agregarProdcuto();
        break;
    case 3:
        modificarProducto();
        break;
    case 4:
        informacionProducto();
        break;
}

//Funciones para el manejo de los productos.

function listaProducto()
{
    global $conexion;
    $sql_todosProductos = "SELECT * FROM Producto";
    echo
    '<button type="button" class="btn btn-success btn-lg" data-bs-toggle = "modal" data-bs-target = "#modal-Producto" onclick = "ModalProUp(1, 0)">Agregar +</button>
    <br><br>';

    try {
        $tablaProductos = mysqli_query($conexion, $sql_todosProductos);
        
        if ($tablaProductos->num_rows > 0) {
            echo
            '<table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <td align="center"">
                    <b>Acción</b></td>
                    </tr>
            </thead>
            <tbody>';
            while ($fila =  $tablaProductos->fetch_assoc()){
            echo
            '<tr>
                <th scope="row">'.$fila['Id_Producto'].'</th>
                <td>'.$fila['Nombre'].'</td>
                <td>'.$fila['Precio'].'</td>
                <td align="center">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-Producto" onclick = "ModalProUp(2, '.$fila['Id_Producto'].')">Modificar</button>
                </td>
            </tr>';	
            }
        }
        else {
            echo "No se han agregado productos, pulse en agregar para insertar.";
        }
    } catch (\Throwable $th) {
        echo "No se pudo obtener la lista";
    }

    mysqli_close($conexion);
}

function agregarProdcuto()
{
    global $conexion;
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $dml_agregarProducto = "INSERT INTO Producto (Nombre, Precio) VALUES ('".$nombre."', ".$precio.")";
    
    try {
        mysqli_query($conexion, $dml_agregarProducto);
        echo 1;

    } catch (\Throwable $th) {
        echo 0;
    }
    
    mysqli_close($conexion);
}

function modificarProducto()
{
    global $conexion;
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $dml_modificarProducto = "UPDATE Producto SET Nombre = '".$nombre."', Precio = ".$precio." WHERE Id_Producto = ".$id.";";

    try {
        mysqli_query($conexion, $dml_modificarProducto);
        echo 1;
    } catch (\Throwable $th) {
        echo 0;
    }
    mysqli_close($conexion);
}

function informacionProducto()
{
    global $conexion;
    $id = $_POST["id"];
    $sql_infomaracionProducto = "SELECT Nombre, Precio FROM Producto WHERE Id_Producto = ".$id.";";

    try {
        $producto = mysqli_query($conexion, $sql_infomaracionProducto);
        if ($producto->num_rows > 0) {
            $productoData = $producto->fetch_assoc();
            $data['datos'] = $productoData;
            echo json_encode($data);
        }
    } catch (\Throwable $th) {
        echo "err";
    }

    mysqli_close($conexion);
}
?>