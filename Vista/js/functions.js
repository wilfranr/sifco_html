$(document).ready(function() {

    //--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
    $("#foto").on("change", function() {
        var uploadFoto = document.getElementById("foto").value;
        var foto = document.getElementById("foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.getElementById('form_alert');

        if (uploadFoto != '') {
            var type = foto[0].type;
            var name = foto[0].name;
            if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                $("#img").remove();
                $(".delPhoto").addClass('notBlock');
                $('#foto').val('');
                return false;
            } else {
                contactAlert.innerHTML = '';
                $("#img").remove();
                $(".delPhoto").removeClass('notBlock');
                var objeto_url = nav.createObjectURL(this.files[0]);
                $(".prevPhoto").append("<img id='img' src=" + objeto_url + ">");
                $(".upimg label").remove();

            }
        } else {
            alert("No selecciono foto");
            $("#img").remove();
        }
    });

    $('.delPhoto').click(function() {
        $('#foto').val('');
        $(".delPhoto").addClass('notBlock');
        $("#img").remove();

        if ($('#foto_actual') && $('#foto_remove')) {
            $('#foto_remove').val('img_producto.png');
        }

    });


    //Modal form add product
    $('.add_product').click(function(e) {
        e.preventDefault();
        var producto = $(this).attr('product');
        var action = "infoProducto";

        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: { action: action, producto: producto },
            async: true,

            success: function(response) {
                if (response != 'error') {
                    var info = JSON.parse(response);

                    $('#producto_id').val(info.codproducto);
                    $('.nameProducto').html(info.descripcion);
                }
            },
            error: function(error) {
                console.log(error)
            }

        });

    })

    //función para buscar cliente en nueva venta
    $('#nit_cliente').keyup(function(e) {
        e.preventDefault();
        var cl = $(this).val();
        action = 'searchCliente';
        $.ajax({
            type: "POST",
            url: "ajax.php",
            async: true,
            data: { action: action, cliente: cl },
            success: function(response) {
                console.log(response)
                if (response == 0) {
                    $('#id_cliente').val('');
                    $('#nom_cliente').val('');
                    $('#tel_cliente').val('');
                    $('#dir_cliente').val('');
                    //mostrar boton de agregar cliente
                    $('#btn_new_client').slideDown();
                } else {
                    var data = $.parseJSON(response);
                    $('#id_cliente').val(data.codCliente);
                    $('#nom_cliente').val(data.nombre);
                    $('#tel_cliente').val(data.telefono);
                    $('#dir_cliente').val(data.direccion);
                    //ocultar boton
                    $('#btn_new_client').slideUp();

                    //bloque campos
                    $('#nom_cliente').attr('disabled', 'disabled');
                    $('#tel_cliente').attr('disabled', 'disabled');
                    $('#dir_cliente').attr('disabled', 'disabled');

                    //ocultar boton
                    $('#btn_guardar').slideUp();
                }
            },
            error: function(error) {

            }
        });
    })

    //funcion para buscar producto

    $('#txt_cod_producto').keyup(function(e) {
        e.preventDefault();
        var producto = $(this).val();
        var action = 'infoProducto';

        //Validar si el campo está vacio
        if (producto != '') {

            $.ajax({
                type: "POST",
                url: "ajax.php",
                async: true,
                data: { action: action, producto: producto },
                success: function(response) {
                    if (response != 'error') {
                        var info = JSON.parse(response)
                        $('#txt_nombre').html(info.nombre)
                        $('#txt_descripcion').html(info.descripcion)
                        $('#txt_cantidad').html(info.cantidad)
                        $('#txt_cant_producto').val('1')
                        $('#txt_precio').html(info.precio)
                        $('#txt_precio_total').html(info.precio)

                        //Activar cantidad
                        $('#txt_cant_producto').removeAttr('disabled')

                        //Mostrar boton agregar
                        $('#add_product_venta').slideDown()

                    } else {
                        $('#txt_nombre').html('-')
                        $('#txt_descripcion').html('-')
                        $('#txt_cantidad').html('-')
                        $('#txt_cant_producto').val('0')
                        $('#txt_precio').html('0.00')
                        $('#txt_precio_total').html('0.00')

                        //Bloquear Cantidad
                        $('#txt_cant_producto').attr('disabled', 'disabled')

                        //ocultar botón
                        $('#add_product_venta').slideUp()

                    }

                },
                error: function(error) {

                }
            });
        }
    })

    //validar cantidad del prodcuto
    $('#txt_cant_producto').keyup(function(e) {
        e.preventDefault()
        var precio_total = $(this).val() * $('#txt_precio').html()
        var existencia = parseInt($('#txt_cantidad').html())

        $('#txt_precio_total').html(precio_total)

        //ocultar boton si la cantidada es menor a 1
        if (($(this).val() < 1 || isNaN($(this).val())) || ($(this).val() > existencia)) {
            $('#add_product_venta').slideUp()
        } else {

            $('#add_product_venta').slideDown()
        }
    })

    //Agregar producto al detalle
    $('#add_product_venta').click(function(e) {
        e.preventDefault();
        if ($('#txt_cant_producto').val() > 0) {
            var codproducto = $('#txt_cod_producto').val()
            var cantidad = $('#txt_cant_producto').val()
            var action = 'add_product_detalle'

            $.ajax({
                url: 'ajax.php',
                type: "POST",
                async: true,
                data: { action:action,producto:codproducto,cantidad:cantidad },

                success: function(response) {
                    if (response != 'error') {
                        var info = JSON.parse(response)
                        $('#detalle_venta').html(info.detalle)
                        $('#detalle_totales').html(info.totales)

                        $('#txt_cod_producto').val('')
                        $('#txt_descripcion').html('-')
                        $('#txt_cantidad').html('-')
                        $('#txt_cant_producto').val(0)
                        $('#txt_precio').html('0.00')
                        $('#txt_precio_total').html('0.00') 
                        
                        $('#txt_cant_producto').attr('disabled','disabled')
                        $('#add_product_venta').slideUp()
                    }else{
                        console.log('no data')
                    }
                },
                error: function(error) {

                }
            })

        }
    })

});

//Enviar datos mediante Modal
function sendDataProduct() {
    $('.alert_add_product').html('');

    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: $('#form_add_product').serialize(),
        async: true,

        success: function(response) {
            if (response == 'error') {
                $('.alert_add_product').html('<p style="color: red;">Error al agregar el producto.</p>');
            } else {
                var info = JSON.parse(response);
                $('.fila' + info.producto_id + ' .celCosto').html(info.nuevo_precio);
                $('.fila' + info.producto_id + ' .celCantidad').html(info.nueva_existencia);
                $('#txtCantidad').val('')
                $('#txtPrecio').val('')
                $('.alert_add_product').html('<p>Producto Agregado.</p>');
                console.log(response);
            }
        },
        error: function(error) {
            console.log(error)
        }

    });

}
//cerrar modal
function closeModal() {
    $('.alert_add_product').html('');
    $('#txtCantidad').val('');
    $('#txtPrecio').val('');
    // $('.modal').fadeOut();

}

//Alerta Usuario o Password Inválidos
function WrongPassword() {
    swal.fire({
        title: "Error!",
        text: "Usuario o Password Inválidos!",
        type: "error",
        icon: "error",
    }).then(function() {
        window.location = "../index.php";
    });
}
//Alerta Cliente Modificado
function ClientModify() {
    swal.fire({
        title: "Éxito",
        text: "Cliente Modificado!!",
        type: "success",
        icon: "success",
    }).then(function() {
        window.location = "../Vista/html/clientes.php";
    });
}

function UserModify() {
    swal.fire({
        title: "Éxito",
        text: "Usuario Modificado!!",
        type: "success",
        icon: "success",
    }).then(function() {
        window.location = "../Vista/html/usuarios.php";
    });
}

function UserCreate() {
    swal.fire({
        title: "Usuario Creado!!!",
        type: "success",
        icon: "success",
    }).then(function() {
        window.location = "../Vista/html/usuarios.php";
    });
}

function ClientCreate() {
    swal.fire({
        title: "Cliente Creado!!!",
        type: "success",
        icon: "success",
    }).then(function() {
        window.location = "../Vista/html/clientes.php";
    });
}

function ProviderCreate() {
    swal.fire({
        title: "Proveedor Creado!!!",
        type: "success",
        icon: "success",
    }).then(function() {
        window.location = "../Vista/html/proveedores.php";
    });
}

function ProductCreate() {
    swal.fire({
        title: "Producto Agregado!!!",
        type: "success",
        icon: "success",
    }).then(function() {
        window.location = "../Vista/html/inventarios.php";
    });
}

function IdExist() {
    swal.fire({
        title: "Error!",
        text: "Identificacion ya existe!",
        type: "error",
        icon: "error",
    }).then(function back() {
        history.back();
    });
}

function UserDelete() {
    swal.fire({
        title: "Éxito",
        text: "Usuario Eliminado!!",
        type: "success",
        icon: "success",
    }).then(function() {
        window.location = "../Vista/html/usuarios.php";
    });
}

//modificar proveedor
function ProviderModify() {
    swal.fire({
        title: "Éxito",
        text: "Proveedor Modificado!!",
        type: "success",
        icon: "success",
    }).then(function() {
        window.location = "../Vista/html/proveedores.php";
    });
}
//Eliminar usuario
function DeleteUser() {
    $(".tabla-usuarios").click(function() {
        var id = $(this).find("td:eq(0)").text();
        console.log(id);
        Swal.fire({
            title: 'Deseas eliminar usuario?',
            text: "Esta accion no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Eliminado!',
                    'El registro ha sido eliminado!',
                    'success'
                ).then(function() {

                    window.location = "../../Controlador/delete_user.php?usr=" + id;
                })
            } else {
                window.location.href = "../html/usuarios.php";
            }
        });
    });
}
//Eliminar cliente
function DeleteClient() {
    $(".tabla-usuarios").click(function() {
        var id = $(this).find("td:eq(0)").text();



        Swal.fire({
            title: 'Deseas eliminar?',
            text: "Esta accion no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Eliminado!',
                    'El registro ha sido eliminado!',
                    'success'
                ).then(function() {
                    window.location = "../../Controlador/delete_cliente.php?usr=" + id;
                })
            } else {
                window.location.href = "../html/clientes.php";
            }
        });
    });
}

//Eliminar proveedor
function DeleteProvider() {
    $(".tabla-usuarios").click(function() {
        var id = $(this).find("td:eq(0)").text();
        console.log(id);

        Swal.fire({
            title: 'Deseas eliminar?',
            text: "Esta accion no se puede deshacer!",
            icon: 'warning',
            showCancelButton: 'Cancelar',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Eliminado!',
                    'El registro ha sido eliminado!',
                    'success'
                ).then(function() {
                    window.location = "../../Controlador/delete_proveedor.php?usr=" + id;
                })
            } else {
                window.location.href = "../html/proveedores.php";
            }
        });
    });
}
//Eliminar producto
function DeleteProduct() {
    $(".tabla-usuarios").click(function() {
        var id = $(this).find("td:eq(0)").text();

        Swal.fire({
            title: 'Deseas eliminar producto?',
            text: "Esta accion no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Eliminado!',
                    'El registro ha sido eliminado!',
                    'success'
                ).then(function() {
                    console.log(id)
                    window.location = "../../Controlador/delete_product.php?usr=" + id;
                })
            } else {
                window.location.href = "../html/inventarios.php";
            }
        });
    });
}

//Alerta password diferentes
function DiferentPassword() {
    swal.fire({
        icon: 'error',
        title: 'Passwords no coinciden',
        closeModal: false
    }).then(function back() {
        history.back();
    });
}
//Alerta si datos ya existen
function UserPasswordExists() {
    swal.fire({
        icon: 'error',
        title: 'Usuario o Password ya existen!!',
        closeModal: false
    }).then(function back() {
        history.back();
    });
}
//usuario no tiene acceso

function UserNoAccess() {
    swal.fire({
        title: "Acceso Negado!!",
        text: "Inicie sesión",
        type: "error",
        icon: "error",
    }).then(function() {
        window.location = "../../index.php";
    });
}

//password modificado
function PasswordEdit() {
    swal.fire({
        title: "Éxito",
        text: "Password Modificada!!",
        type: "success",
        icon: "success",
    }).then(function() {
        window.location = "../Vista/html/usuarios.php";
    });
}

function prueba() {
    swal.fire({
        title: "Prueba",
        text: "mensaje de prueba!!",
        type: "success",
        icon: "success",
    });
}

function addedProduct() {
    swal.fire({
        title: "Exito!!!",
        text: "Producto agregado!",
        type: "success",
        icon: "success",
    });
}

function editedProduct() {
    swal.fire({
        title: "Exito!!!",
        text: "Producto editado!",
        type: "success",
        icon: "success",
    }).then(function() {
        window.location = "../html/inventarios.php";
    });
}

function errorProduct() {
    swal.fire({
        title: "Error!!!",
        text: "Error al agregar producto!",
        type: "error",
        icon: "error",
    });
}

function errorData() {
    swal.fire({
        title: "Error!!!",
        text: "Datos invalidos o inexistentes!",
        type: "error",
        icon: "error",
    });
}