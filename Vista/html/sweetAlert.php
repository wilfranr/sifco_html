<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="../js/functions.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <!--Pruebas para eliminar usuario-->

    <button class="cancelar
    " onclick="mensaje()">Eliminar</button>

    <script>
        function mensaje() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Estas seguro?',
                text: "Esta acción no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        'Eliminado!',
                        'Datos eliminados',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'Tus datos están seguros',
                        'error'
                    )
                }
            })
        }

        function DeleteUser() {
            Swal.fire({
                title: 'Desea guardar los cambios?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Guardar`,
                denyButtonText: `No guardar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire('Usuario modificado!', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Usuario no modificado', '', 'info')
                }
            })
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
function DiferentPassword () {
    swal.fire({
        icon: 'error',
        title: 'Passwords no coinciden',
        closeModal: false
        }).then(function back() {
        history.back();
});
}
    </script>
    
    <input type="button" value="Wrong Password" onclick="WrongPassword()">

    <input type="button" value="Delete User" onclick="DeleteUser()">
    <input type="button" value="Create User" onclick="UserCreate()">
    <input type="button" value="Diferent" onclick="DiferentPassword()">


</body>

</html>