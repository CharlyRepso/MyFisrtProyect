<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../libs/bootstrap/css/bootstrap.min.css">
    <script src="../libs/bootstrap/js/bootstrap.min.js"></script>
    <script src= "../js/jquery-3.6.1.js"></script>
    <script src= "../js/funciones.js"> </script>
    <title>Supervision</title>
</head>
<body>
    <div id="YesAccess">
        <br>
        <div class="container">
            <div class = "row align-items-center">
                <table class= "table table-borderless">
                    <tr>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <td rowspan="2" align="center" style="vertical-align:middle;">
                            <h1>Panel de Supervision</h1>
                        </td>
                        <td rowspan="2" align="center" style="vertical-align:middle;">
                            <button class= "btn btn-outline-warning btn-lg" onclick = "SessionClose()">Cerrar Sesión</button>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $_SESSION['Nombre'];?></td>
                        <td><?php echo $_SESSION['Usuario'];?></td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div class="accordion accordion-flush container" id="accordionAdminsitrador">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Productos
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                            <div  class= "col-10 container" id="TableProductos"></div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Reportes
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                       <div  class= "col-11 container" id="TableReportes"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class ="modal" id=modal-Producto>
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-tittle" id="titulo_Modal">
                    </h5>
                    <button type="button" class="close btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!--Cuerpo del Modal -->
                <div class="modal-body">
                    <form id="f_productos" name = "f_productos" method="POST">
                        <fieldset class="form-group row col-auto">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Nombre</span>
                                <input type="text" placeholder="Nombre del producto" class="form-control"  name="NombreProducto" id="NombreProducto" aria-label="Default">
                            </div>
                        </fieldset>
                        <fieldset class="form-group row col-auto">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Precio</span>
                                <input type="number" placeholder="Nombre del producto" class="form-control"  name="PrecioProducto" id="PrecioProducto" aria-label="Default">
                            </div>
                        </fieldset>
                        <fieldset class="form-group row col-auto">
                            <center>
                                <div class = "alert" role="alert" id="respuestaProducto"></div>
                            </center>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button"  id ="btnModificarPro" class="btn btn-outline-success" onclick="updateProducto()">Guardar Cambios</button>
                    <button  type="button" id ="btnRegistrarPro" class="btn btn-outline-primary">Registrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class ="modal" id=modal-Venta>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-tittle" id="titulo_Modal">
                        Registro de ventas
                    </h5>
                    <button type="button" class="close btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!--Cuerpo del Modal -->
                <div class="modal-body">
                    <form id="f_ventas" name="f_ventas" method="POST">
                        <fieldset class="form-group row col-auto">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Factura</span>
                                <input type="text" placeholder="Número de venta" class="form-control" id="NoFactura" aria-label="Default">
                            </div>
                        </fieldset>
                        <fieldset class="form-group row col-auto">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Usuario</span>
                                <input type="number" placeholder="ID Usuario" class="form-control" id="NoUsuario" aria-label="Default">
                                <span class="input-group-text" id="BusquedaUsuario"></span>
                            </div>
                        </fieldset>
                        <fieldset class="form-group row col-auto">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Producto</span>
                                <input type="number" placeholder="ID Producto" class="form-control" id="NoProducto" aria-label="Default">
                                <span class="input-group-text" id="BusquedaProducto"></span>
                            </div>
                        </fieldset>
                        <fieldset class="form-group row col-auto">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Cantidad</span>
                                <input type="text" placeholder="Total Vendido" class="form-control" id="Cantidad" aria-label="Default">
                            </div>
                        </fieldset>
                        <center>
                            <fieldset class="form-group row col-10">
                                    <div class = "alert" role="alert" id="respuestaVenta"></div>
                            </fieldset>
                        </center>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button  type="button" id ="btnRegistrarVenta" class="btn btn-outline-primary">Registrar</button>
                </div>
            </div>
        </div>
    </div>

    <!--Validmos si el usuario es Administrador para darle acceso al contenido-->
    <script type="text/javascript">
        let usuario = <?php echo json_encode($_SESSION['Rol']);?>;
        Supervisor(usuario);
    </script>
    <script src= "../js/eventos.js"></script>
</body>
</html>