            
            //***************************Funciones para las sesiones***************************

function iniciarSesion(usuario, password) {
    let cadena = "usuario=" + usuario +
            "&password=" + password +
            "&operacion="+1;
    $.ajax({
        type: "POST",
        url: "../php/sesion.php",
        data: cadena,
        success: function(r){
            console.log(r);
            switch (r) {
                
                case "Administrador":
                    window.location.href="../vistas/administracion.php";
                    break;
                case "Supervisor":
                    window.location.href ="../vistas/supervision.php";
                    break;
                case "Vendedor":
                    window.location.href ="../vistas/reporte.php";
                    break;
                case 'Inactivo':
                    $('#ErrorIniciarSesion')
                    .removeClass('alert-danger')
                    .addClass('alert-warning')
                    .html('Este usuaraio se encuentra inactivo')
                    .show(200).delay(2500).hide(200); 
                    break;
                default:
                    $('#ErrorIniciarSesion')
                    .removeClass('alert-warning')
                    .addClass('alert-danger')
                    .html('ERROR: Nombre de usuario o contraseña incorrectos')
                    .show(200).delay(2500).hide(200); 
                    break;
            }
        }
    }); 
}

function SessionClose(){
    $.ajax({
        type: "POST",
        url: "../php/sesion.php",
        data: "operacion=2",
        success: function (r) {
            window.location.href ="Login.php";
        }
    });
}

function Administrador(usuario) {
    if (usuario == "Administrador") {
        displayTableUser();   
        displayTableProducto();
        displayTableVentas();
    }
}

function Supervisor(usuario) {
    if (usuario == "Administrador" || usuario == "Supervisor") { 
        displayTableProducto();
        displayTableVentas();
    }
}

function Vendedor(usuario) {
    if (usuario == "Administrador" || usuario == "Supervisor" || usuario == "Vendedor") {  
        displayTableVentas();
    }
}

//***************************Funciones para los usuarios***************************

function agregardatos(nombre, usuario, password){
    let cadena = "nombre=" + nombre +
            "&usuario=" + usuario +
            "&password=" + password+
            "&operacion="+1;
    $.ajax({
        type:"POST",
        url: "../php/usuarios.php",
        data: cadena,
        success: function(resultado){
            if (resultado==1) {
                $('#f_nuevoUsuarios')[0].reset();
                $('#respuesta')
                .removeClass('alert-danger')
                .addClass('alert-success')
                .html('Usuario ingresado con exito')
                .show(200).delay(2500).hide(200);
            }
            else{
                $('#respuesta')
                .removeClass('alert-success')
                .addClass('alert-danger')
                .html('Error al ingresar usuario')
                .show(200).delay(2500).hide(200);
            }
        }
    });
}

function ModalUserUp(id, estado, rol) {
    IdUsuario = id;
    switch (estado) {
        case 0:
            document.querySelector('#inactivo').checked = true;
            break;
        case 1:
            document.querySelector('#activo').checked = true;
            break;
    }

    switch (rol) {
        case 'No asignado':
            document.getElementById("SelcRol").selectedIndex = "0";
            break;
        case 'Administrador':
            document.getElementById("SelcRol").selectedIndex = "3";
            break;
        case 'Supervisor':
            document.getElementById("SelcRol").selectedIndex = "2";
            break
        case 'Vendedor':
            document.getElementById("SelcRol").selectedIndex = "1";
            break
        default:
            break;
    }
}

function  updateUser (id, estado, rol) {
    let datos = "id=" +id+
                "&estado=" +estado+
                "&rol=" + rol +
                "&operacion="+2;
    $.ajax({
        type: "POST",
        url: "../php/usuarios.php",
        data: datos,
        success: function (r) {
            if (r == 1) {
                $('#respuestaUsuario')
                .removeClass('alert-warning alert-danger')
                .addClass('alert-success')
                .html('Datos actualizados con exito')
                .show(200).delay(2500).hide(200); 
            }
            else{
                $('#respuestaUsuario')
                .removeClass('alert-success alert-warning')
                .addClass('alert-danger')
                .html('Error datos no actualizados')
                .show(200).delay(2500).hide(200); 
            }
            displayTableUser();
        }
    });
}

function displayTableUser() {
    $.ajax({
        type: "POST",
        url: "../php/usuarios.php",
        data: "operacion="+3,
        success: function (tabla_Usarios) {
            $("#TableUsuarios").html(tabla_Usarios);
        }
    });
}

                //***************************Funciones para los productos***************************

function agregarProducto(nombre, precio) {
    let datos = "nombre=" +nombre+
                "&precio="+precio+
                "&operacion="+2;
    $.ajax({
        type: "POST",
        url: "../php/productos.php",
        data: datos,
        success: function (r) {
            if (r == 1) {
                $("#respuestaProducto")
                .removeClass('alert-danger')
                .addClass('alert-success')
                .html("Producto ingresado correctamente")
                .show(200).delay(2500).hide(200);
                $('#f_productos')[0].reset();
                displayTableProducto();
            }
            else{
                $("#respuestaProducto")
                .removeClass('alert-success')
                .addClass('alert-danger')
                .html("Error no se pudo ingresar el producto")
                .show(200).delay(2500).hide(200);
            }
        }
    });
}
function ModalProUp (operacion, id) {

    switch (operacion) {
        case 1:
            let titulo = document.getElementById("titulo_Modal");
            titulo.innerText = "Ingresando productos";
            $('#f_productos')[0].reset();
            $('#btnRegistrarPro').show();
            $('#btnModificarPro').hide();
            break;
        case 2:
            let titulo2 = document.getElementById("titulo_Modal");
            titulo2.innerText = "Modificando productos";
            $('#btnModificarPro').show();
            $('#btnRegistrarPro').hide();
            IdProducto = id;
            informacionProducto(IdProducto);
            break;
        default:
            break;
    }
}

function displayTableProducto() {
    let operacion = "operacion="+1;
    $.ajax({
        type: "POST",
        url: "../php/productos.php",
        data: operacion,
        success: function (tabla_Producto) {
            $("#TableProductos").html(tabla_Producto);
        }
    });
}


function informacionProducto(id) {
    let datos = "id="+id+"&operacion="+4;
    $.ajax({
        type: "POST",
        url: "../php/productos.php",
        dataType: "json",
        data: datos,
        success: function (info) {
            let nombre = document.getElementById('NombreProducto');
            let precio = document.getElementById('PrecioProducto');
            nombre.value = info.datos.Nombre;
            precio.value = info.datos.Precio;
        }
    });
}

function updateProducto() {
    let nombre = document.getElementById('NombreProducto').value;
    let precio = document.getElementById('PrecioProducto').value;
    let datos =  "id="+IdProducto+
                "&nombre="+nombre+
                "&precio="+precio+
                "&operacion="+3;
    $.ajax({
        type: "POST",
        url: "../php/productos.php",
        data: datos,
        success: function (r) {
            if (r == 1) {
                $("#respuestaProducto")
                .removeClass('alert-danger')
                .addClass('alert-success')
                .html("Producto Modificado correctamente")
                .show(200).delay(2500).hide(200);
                $('#f_ventas')[0].reset();
                displayTableVentas();
                displayTableProducto();
            }
            else{
                $("#respuestaProducto")
                .removeClass('alert-success')
                .addClass('alert-danger')
                .html("Error no se pudo modificar el producto")
                .show(200).delay(2500).hide(200);
            }
        }
    });
}

                //***************************Funciones para la ventas***************************

function NombreUsuario(id) {
    let datos = "id="+id+
                "&operacion="+4;
    $.ajax({
        type:"POST",
        url: "../php/ventas.php",
        data: datos,
        success: function (nombre) {
            let usuario = document.getElementById("BusquedaUsuario");
            usuario.innerText = nombre;
        }
    });
}

function NombreProducto(id) {
    let datos = "id="+id+
                "&operacion="+5;
    $.ajax({
        type:"POST",
        url: "../php/ventas.php",
        data: datos,
        success: function (nombre) {
            let producto = document.getElementById("BusquedaProducto");
            producto.innerText = nombre;
        }
    });
}

function agregarVenta(factura, id_producto, id_usuario, cantidad) {
    let datos = "factura="+factura+
                "&id_producto="+id_producto+
                "&id_usuario="+id_usuario+
                "&cantidad="+cantidad+
                "&operacion="+1;
    $.ajax({
        type: "POST",
        url: "../php/ventas.php",
        data: datos,
        success: function (r) {
            if (r == 1) {
                $('#respuestaVenta')
                .removeClass('alert-danger')
                .addClass('alert-success')
                .html("Venta Ingresada correctamente")
                .show(200).delay(2500).hide(200);
                displayTableVentas();
            }
            else{
                $("#respuestaVenta")
                .removeClass('alert-success')
                .addClass('alert-danger')
                .html("Error no se pudo ingresar la venta, datos incorrectos")
                .show(200).delay(2500).hide(200);
            }
        }
    });
}

function displayTableVentas() {
    let operacion = "operacion="+2;
    $.ajax({
        type: "POST",
        url: "../php/ventas.php",
        data: operacion,
        success: function (tabla_Ventas) {
            $("#TableReportes").html(tabla_Ventas);
        }
    });
}