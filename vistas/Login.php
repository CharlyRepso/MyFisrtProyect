<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../libs/bootstrap/css/bootstrap.min.css">
    <script src="../js/jquery-3.6.1.js"></script>
    <script src="../js/funciones.js"></script>
    <script src="../libs/bootstrap/js/bootstrap.min.js"></script>
    <title>LOGIN</title>
    
</head>
<body>
    <br><br>
    <center>
    <h1>Iniciar Sesión</h1>
    <br><br>
    <div class = "container">
        <form id="logear" method="post">
            <fieldset class="form-group row">
                <center>
                    <div class="form-group col-md-5">
                        <label>Usuario</label>
                        <input type="text" class="form-control validar" name="usuario" id="usuario">
                    </div>
                </center> 
            </fieldset>
            <br>
            <fieldset class="form-group row">
                <center>
                    <div class="form-group col-md-5">
                        <label>Password</label>
                        <input type="password" class="form-control validar" name="password" id="password">
                    </div>
                </center>  
            </fieldset>
            <br>
            <fieldset class = "form-group row">
                <center>
                    <div class = "alert form-group col-md-5" role="alert" id="ErrorIniciarSesion"></div>
                </center>
            </fieldset>
            <fieldset class="form-group row">
                <center>
                    <button type="button" id="btnLogear" class="btn btn-primary btn-lg">Login</button>
                </center>
            </fieldset>
        </form>
        <br><br><br>
        <button id ="nuevo-usario" class="btn btn-primary btn-lg" data-bs-toggle = "modal" data-bs-target = "#modal-NuevoUsiario"> 
            Registrarse
        </button>  

        <!--Modal para registrar los usuarios-->

        <div class ="modal" id=modal-NuevoUsiario>
            <div class="modal-dialog">
                <div class="modal-content">
                    <!--Titulo del Modal -->
                    <div class="modal-header">
                        <h5 class="modal-tittle">
                            Registro de nuevos usuarios
                        </h5>
                        <button type="button" class="close btn btn-close" data-bs-dismiss="modal"></button>
                    </div>
                     <!--Cuerpo del Modal -->
                     <div class="modal-body">
                        <form id="f_nuevoUsuarios" method="POST">
                            <fieldset class="form-group row col-auto">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Nombre</span>
                                    <input type="text" placeholder="Ingrese su nombre" class="form-control" name="newNombre" id="newNombre" aria-label="Default">
                                </div>
                            </fieldset>
                            <fieldset class="form-group row col-auto">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Usuario</span>
                                    <input type="text" placeholder="Ingrese su usuario" class="form-control" name="newUsuario" id="newUsuario" aria-label="Default">
                                </div>
                            </fieldset>
                            <fieldset class="form-group row col-auto">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Password</span>
                                    <input type="text" placeholder="Ingrese su constraseña" class="form-control" name="newPassword" id = "newPassword" aria-label="Default">
                                </div>
                            </fieldset>
                            <fieldset class = "form-group row col-auto">
                                    <div class = "alert form-group" role="alert" id="respuesta"></div>
                            </fieldset>
                        </form>
                     </div>
                     <div class="modal-footer">
                        <button class= "btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button  type="button" id ="btnRegistrar" class="btn btn-primary">Registrar</button>
                     </div>
                </div>
            </div>
        </div>
    </div>
    </center>
    <script src= "../js/eventos.js"></script>
</body>
</html>