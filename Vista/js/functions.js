$(document).ready(function () {

    //--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
    $("#foto").on("change", function () {
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

    $('.delPhoto').click(function () {
        $('#foto').val('');
        $(".delPhoto").addClass('notBlock');
        $("#img").remove();

        if ($('#foto_actual') && $('#foto_remove')) {
            $('#foto_remove').val('img_producto.png');
        }

    });


    //Modal form add product
    $('.add_product').click(function (e) {
        e.preventDefault();
        var producto = $(this).attr('product');
        var action = "infoProducto";

        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: { action: action, producto: producto },
            async: true,

            success: function (response) {
                if (response != 'error') {
                    var info = JSON.parse(response);

                    $('#producto_id').val(info.codproducto);
                    $('.nameProducto').html(info.descripcion);
                }
            },
            error: function (error) {
                console.log(error)
            }

        });

    })

    //función para buscar cliente en nueva venta
    $('#nit_cliente').keyup(function (e) {
        e.preventDefault();
        var cl = $(this).val();
        action = 'searchCliente';
        $.ajax({
            type: "POST",
            url: "ajax.php",
            async: true,
            data: { action: action, cliente: cl },
            success: function (response) {
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
            error: function (error) {

            }
        });
    })

    //funcion para buscar producto

    $('#txt_cod_producto').keyup(function (e) {
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
                success: function (response) {
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
                error: function (error) {

                }
            });
        }
    })

    //validar cantidad del prodcuto
    $('#txt_cant_producto').keyup(function (e) {
        e.preventDefault()
        var precio_total = $(this).val() * $('#txt_precio').html()
        var existencia = parseInt($('#txt_cantidad').html())

        $('#txt_precio_total').html(precio_total)

        //ocultar boton si la cantidada es menor a 1
        if (($(this).val() < 1 || isNaN($(this).val())) || ($(this).val() > existencia)) {
            $('#add_product_venta').slideUp()

        } else {

            $('#add_product_venta').slideDown()
            $('#btn-pagar-venta').slideUp()

        }
    })


    //Agregar producto al detalle
    $('#add_product_venta').click(function (e) {
        e.preventDefault();

        if ($('#txt_cant_producto').val() > 0) {
            var codproducto = $('#txt_cod_producto').val()
            var cantidad = $('#txt_cant_producto').val()
            var action = 'add_product_detalle'

            $.ajax({
                url: 'ajax.php',
                type: "POST",
                async: true,
                data: { action: action, producto: codproducto, cantidad: cantidad },

                success: function (response) {
                    if (response != 'error') {
                        var info = JSON.parse(response)
                        $('#detalle_venta').html(info.detalle)
                        $('#detalle_totales').html(info.totales)

                        $('#txt_cod_producto').val('')
                        $('#txt_nombre').html('-')
                        $('#txt_descripcion').html('-')
                        $('#txt_cantidad').html('-')
                        $('#txt_cant_producto').val(0)
                        $('#txt_precio').html('0.00')
                        $('#txt_precio_total').html('0.00')

                        $('#txt_cant_producto').attr('disabled', 'disabled')
                        $('#add_product_venta').slideUp()//ocultar botón


                    } else {
                        console.log('no data')
                    }
                    viewProcesar()
                },
                error: function (error) {

                }
            })

        }
    })

    //anular venta
    $('#btn-anular-venta').click(function (e) {
        e.preventDefault()

        var rows = $('#detalle_venta tr').length
        if (rows > 0) {
            var action = 'anularventa';

            $.ajax({
                url: 'ajax.php',
                type: "POST",
                async: true,
                data: { action: action },

                success: function (response) {
                    if (response != 'error') {
                        location.reload()

                    }
                },
                error: function (error) { }
            })
        }
    })

    //facturar venta
    $('#btn-pagar-venta').click(function (e) {
        e.preventDefault()

        var rows = $('#detalle_venta tr').length
        if (rows > 0) {
            var action = 'procesarVenta';
            var codcliente = $('#id_cliente').val()

            $.ajax({
                url: 'ajax.php',
                type: "POST",
                async: true,
                data: { action: action, codcliente: codcliente },

                success: function (response) {
                    if (response != 'error') {
                        var info = JSON.parse(response)
                        console.log(info)

                        generarPDF(info.codcliente, info.nofactura)
                        location.reload()

                    } else {
                        console.log('no data')
                    }
                },
                error: function (error) { }
            })
        }
    })


});//end ready

//generar pdf
function generarPDF(cliente, factura) {

    //tamaño de la ventana
    var ancho = 1000;
    var alto = 800;

    //Calcular posición de la ventana
    var x = parseInt((window.screen.width / 2) - (ancho / 2))
    var y = parseInt((window.screen.width / 2) - (alto / 2))

    $url = '../factura/generaFactura.php?cl=' + cliente + '&f=' + factura;
    window.open($url, "Factura", "left=" + x + ",top=" + y + ",height=" + alto + ",width=" + ancho + ",scrollbar=si,location=no,resizable=si,menubar=no");

}

//Eliminar prodcuto del detalle
function del_product_detalle(correlativo) {
    var action = 'delProductoDetalle';
    var id_detalle = correlativo;

    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: { action: action, id_detalle: id_detalle },

        success: function (response) {
            if (response != 'error') {
                var info = JSON.parse(response)

                $('#detalle_venta').html(info.detalle)
                $('#detalle_totales').html(info.totales)

                $('#txt_cod_producto').val('')
                $('#txt_nombre').html('-')
                $('#txt_descripcion').html('-')
                $('#txt_cantidad').html('-')
                $('#txt_cant_producto').val(0)
                $('#txt_precio').html('0.00')
                $('#txt_precio_total').html('0.00')

                $('#txt_cant_producto').attr('disabled', 'disabled')
                $('#add_product_venta').slideUp()

            } else {
                $('#detalle_venta').html('')
                $('#detalle_totales').html('')
            }
            viewProcesar();
        },
        error: function (error) {
        }
    });
}

//Mostrar boton de pagar venta
function viewProcesar() {
    if ($('#detalle_venta tr').length > 0) {
        $('#btn-pagar2-venta').show();
    } else {
        $('#btn-pagar2-venta').show();
    }
}

//extraer datos del detalle
function searchForDetalle(id) {
    var action = 'searchForDetalle';
    var user = id;


    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: { action: action, user: user },

        success: function (response) {
            if (response != 'error') {
                var info = JSON.parse(response);

                $('#detalle_venta').html(info.detalle)
                $('#detalle_totales').html(info.totales)



            } else {
                console.log('no data')
            }
            viewProcesar()
        },
        error: function (error) {
        }
    })


}

//Enviar datos mediante Modal
function sendDataProduct() {
    $('.alert_add_product').html('');

    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: $('#form_add_product').serialize(),
        async: true,

        success: function (response) {
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
        error: function (error) {
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
    }).then(function () {
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
    }).then(function () {
        window.location = "../Vista/html/clientes.php";
    });
}

//Alerta usuario modificado
function UserModify() {
    swal.fire({
        title: "Éxito",
        text: "Usuario Modificado!!",
        type: "success",
        icon: "success",
    }).then(function () {
        window.location = "../Vista/html/usuarios.php";
    });
}
//Alerta empresa modificada
function EmpresaModify() {
    swal.fire({
        title: "Éxito",
        text: "Empresa Modificada!!",
        type: "success",
        icon: "success",
    }).then(function () {
        window.location = "../Vista/html/configuracion.php";
    });
}

//Alerta Usuario creado
function UserCreate() {
    swal.fire({
        title: "Usuario Creado!!!",
        type: "success",
        icon: "success",
    }).then(function () {
        window.location = "../Vista/html/usuarios.php";
    });
}

//alerta de cliente creado
function ClientCreate() {
    swal.fire({
        title: "Cliente Creado!!!",
        type: "success",
        icon: "success",
    }).then(function () {
        window.location = "../Vista/html/clientes.php";
    });
}

//Alerta de Proveedor creado
function ProviderCreate() {
    swal.fire({
        title: "Proveedor Creado!!!",
        type: "success",
        icon: "success",
    }).then(function () {
        window.location = "../Vista/html/proveedores.php";
    });
}
//Alerta de Empresa creada
function EmpresaCreate() {
    swal.fire({
        title: "Empresa Creada!!!",
        type: "success",
        icon: "success",
    }).then(function () {
        window.location = "../Vista/html/configuracion.php";
    });
}

//Alerta de producto creado
function ProductCreate() {
    swal.fire({
        title: "Producto Agregado!!!",
        type: "success",
        icon: "success",
    }).then(function () {
        window.location = "../Vista/html/inventarios.php";
    });
}

//Alerta de Id existente
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
//Alerta de empresa existente
function EmpresaExist() {
    swal.fire({
        title: "Error!",
        text: "Empresa ya existe!",
        type: "error",
        icon: "error",
    }).then(function back() {
        history.back();
    });
}

//alerta de usuario borrado
function UserDelete() {
    swal.fire({
        title: "Éxito",
        text: "Usuario Eliminado!!",
        type: "success",
        icon: "success",
    }).then(function () {
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
    }).then(function () {
        window.location = "../Vista/html/proveedores.php";
    });
}
//Eliminar usuario
function DeleteUser() {
    $(".tabla-usuarios").click(function () {
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
                ).then(function () {

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
    $(".tabla-usuarios").click(function () {
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
                ).then(function () {
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
    $(".tabla-usuarios").click(function () {
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
                ).then(function () {
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
    $(".tabla-usuarios").click(function () {
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
                ).then(function () {
                    console.log(id)
                    window.location = "../../Controlador/delete_product.php?usr=" + id;
                })
            } else {
                window.location.href = "../html/inventarios.php";
            }
        });
    });
}
//Eliminar empresa
function DeleteEmpresa() {
    $(".tabla-usuarios").click(function () {
        var id = $(this).find("td:eq(0)").text();
        console.log(id);
        Swal.fire({
            title: 'Deseas eliminar la Empresa?',
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
                ).then(function () {

                    window.location = "../../Controlador/delete_empresa.php?usr=" + id;
                })
            } else {
                window.location.href = "../html/configuracion.php";
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
//Alerta si password ya existen
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
    }).then(function () {
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
    }).then(function () {
        window.location = "../Vista/html/usuarios.php";
    });
}

//alerta de producto agregado
function addedProduct() {
    swal.fire({
        title: "Exito!!!",
        text: "Producto agregado!",
        type: "success",
        icon: "success",
    });
}

//Alerta de producto modificado
function editedProduct() {
    swal.fire({
        title: "Exito!!!",
        text: "Producto editado!",
        type: "success",
        icon: "success",
    }).then(function () {
        window.location = "../html/inventarios.php";
    });
}

//alerta de error al agregar producto
function errorProduct() {
    swal.fire({
        title: "Error!!!",
        text: "Error al agregar producto!",
        type: "error",
        icon: "error",
    });
}

//Error de datos incorrectos
function errorData() {
    swal.fire({
        title: "Error!!!",
        text: "Datos invalidos o inexistentes!",
        type: "error",
        icon: "error",
    });
}

//funcion para pagar venta
function pagar() {
    
    var valor = "";
    var valor = document.getElementById('total').innerHTML;

    
    
    Swal.fire({
        
        title: '<strong>PAGAR</strong>',
        html:
            '<p>Valor a pagar: $' + valor + '</p>' +
            '<p><label for="valor">Paga con: </label></p>' +
            '<input type="number" name="paga" id="paga" >',
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: true,
        confirmButtonText:
            '<i class="fa fa-thumbs-up"></i> Pagar!',
        confirmButtonAriaLabel: 'Thumbs up, great!',
        cancelButtonText:
            '<i class="fa fa-thumbs-down">Cancelar</i>',
        cancelButtonAriaLabel: 'Thumbs down',
    }).then((result) => {
        paga = document.getElementById('paga').value;

        if (result.isConfirmed) {
            if (paga < valor) {
                Swal.fire('Valor incorrecto')
            }else{
            var cambio = paga - valor;
            Swal.fire({
                title: '<strong>PAGO EXITOSO</strong>',
                html: 'Cambio $: '+ cambio,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Imprimir!',
                confirmButtonAriaLabel: 'Thumbs up, great!',                
                cancelButtonText: '<i class="fa fa-thumbs-down">Cancelar</i>',
                cancelButtonAriaLabel: 'Thumbs down',
            }).then((result) =>{
                if (result.isConfirmed){
                    procesarVenta()
                }
            });
            }
          }

    })
    
}

//procesar venta
function procesarVenta(procesarVenta) {
    var rows = $('#detalle_venta tr').length
        if (rows > 0) {
            var action = 'procesarVenta';
            var codcliente = $('#id_cliente').val()

            $.ajax({
                url: 'ajax.php',
                type: "POST",
                async: true,
                data: { action: action, codcliente: codcliente },

                success: function (response) {
                    if (response != 'error') {
                        var info = JSON.parse(response)
                        console.log(info)

                        generarPDF(info.codcliente, info.nofactura)
                        location.reload()

                    } else {
                        console.log('no data')
                    }
                },
                error: function (error) { }
            })
        }
}

//password incorrecta
function PasswordIncorrect() {
    swal.fire({
        icon: 'error',
        title: 'Password incorrecto',
        closeModal: false
    }).then(function back() {
        history.back();
    });
}