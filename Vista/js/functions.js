
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

    });
    
});
//Alerta Usuario o Password Inválidos
function WrongPassword () {
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
function ClientModify () {
    swal.fire({
        title: "Éxito",
        text: "Cliente Modificado!!",
        type: "success",
        icon: "success",
        }).then(function() {
        window.location = "../Vista/html/clientes.php";
    });
}

function UserModify () {
    swal.fire({
        title: "Éxito",
        text: "Usuario Modificado!!",
        type: "success",
        icon: "success",
        }).then(function() {
        window.location = "../Vista/html/usuarios.php";
    });
}

function UserCreate () {
    swal.fire({
        title: "Usuario Creado!!!",
        type: "success",
        icon: "success",
        }).then(function() {
        window.location = "../Vista/html/usuarios.php";
    });
}
function ClientCreate () {
    swal.fire({
        title: "Cliente Creado!!!",
        type: "success",
        icon: "success",
        }).then(function() {
        window.location = "../Vista/html/clientes.php";
    });
}

function ProviderCreate () {
    swal.fire({
        title: "Proveedor Creado!!!",
        type: "success",
        icon: "success",
        }).then(function() {
        window.location = "../Vista/html/proveedores.php";
    });
}

function IdExist () {
    swal.fire({
        title: "Error!",
        text: "Identificacion ya existe!",
        type: "error",
        icon: "error",
        }).then(function back() {
            history.back();
    });
}

function UserDelete () {
    swal.fire({
        title: "Éxito",
        text: "Usuario Eliminado!!",
        type: "success",
        icon: "success",
        }).then(function() {
        window.location = "../Vista/html/usuarios.php";
    });
}

function ProviderModify () {
    swal.fire({
        title: "Éxito",
        text: "Proveedor Modificado!!",
        type: "success",
        icon: "success",
        }).then(function() {
        window.location = "../Vista/html/proveedores.php";
    });
}
function DeleteUser() {
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
              window.location = "../../Controlador/delete_user.php?usr="+id;
          })
        }else {
            window.location.href= "../html/usuarios.php";
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
              window.location = "../../Controlador/delete_cliente.php?usr="+id;
          })
        }else {
            window.location.href= "../html/clientes.php";
        }
      });
    });
}

//Eliminar proveedor
function DeleteProvider() {
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
              window.location = "../../Controlador/delete_proveedor.php?usr="+id;
          })
        }else {
            window.location.href= "../html/proveedores.php";
        }
      });
    });
}
//Alerta password diferentes
function DiferentPassword () {
    swal.fire({
        icon: 'error',
        title: 'Passwords no coinciden',
        closeModal: false
        }).then(function back() {
        history.back();
});
}
//Alerta si datos ya existen
function UserPasswordExists () {
    swal.fire({
        icon: 'error',
        title: 'Usuario o Password ya existen!!',
        closeModal: false
        }).then(function back() {
        history.back();
});
}
//usuario no tiene acceso
function UserNoAccess () {
    swal.fire({
        title: "Error",
        text: "Usuario no tiene permisos!!",
        type: "error",
        icon: "error",
        }).then(function() {
        window.location = "../../index.php";
    });
}

//password modificado
function PasswordEdit () {
    swal.fire({
        title: "Éxito",
        text: "Password Modificada!!",
        type: "success",
        icon: "success",
        }).then(function() {
        window.location = "../Vista/html/usuarios.php";
    });
}




