
                                    //Eventos para el Login.
$('#respuesta').hide();
$(document).ready(function(){
    $('#btnRegistrar').click(function(){
        let nombre = $('#newNombre').val();
        let usuario = $('#newUsuario').val();
        let password = $('#newPassword').val();
        agregardatos(nombre, usuario, password);
    });
});
        
//Evento para iniciar Session

$(document).ready(function(){
    $('#btnLogear').click(function() {
        let usuario = $('#usuario').val();
        let password = $('#password').val();
        iniciarSesion(usuario, password);
    });
});

                                    //Eventos para el control de usuarios, productos y ventas
$('#respuestaUsuario').hide();
$('#respuestaProducto').hide();
$('#respuestaVenta').hide();

//Evento del boton modificar usuarios.
$(document).ready(function () {
    $('#btnUpUser').click(function () {
        let id = IdUsuario;
        let estado = $("input[type=radio][name=estadoUsuario]:checked").val(); 
        let rol = document.getElementById("SelcRol").value;

        if (estado == 1 && rol > 0 || estado == 0) {
            updateUser(id, estado, rol);   
        }
        else{
            $('#respuestaUsuario')
            .removeClass('alert-success alert-danger')
            .addClass('alert-warning')
            .html('Seleccione un rol para poder activar al usuario')
            .show(200).delay(2500).hide(200); 
        }

    });
});

//Envento del boton agregar Producto.
$(document).ready(function() {
    $('#btnRegistrarPro').click(function() {
        let NombrePro = $('#NombreProducto').val();
        let PrecioPro = $('#PrecioProducto').val();
        agregarProducto(NombrePro, PrecioPro);               
    });
});

//Envento para buscar usuario
$(document).ready(function () {
    $('#NoUsuario').on('keyup',function(){
        let id = $('#NoUsuario').val();
        NombreUsuario(id);
    });
});

//Evento para buscar Producto
$(document).ready(function () {
    $('#NoProducto').on('keyup',function(){
    let id = $('#NoProducto').val();
    NombreProducto(id);
    });
});

//Evento para el boton registrar venta.
$(document).ready(function () {
    $('#btnRegistrarVenta').click(function () {
        let factura = $("#NoFactura").val();
        let id_usuario = $("#NoUsuario").val();
        let id_producto = $("#NoProducto").val();
        let cantidad = $("#Cantidad").val();
        agregarVenta(factura, id_producto, id_usuario, cantidad);
    });
});