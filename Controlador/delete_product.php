<?php
    include '../includes/script.php';
   
    // Delete_product($_GET['usr']);
    $codproducto = $_GET['usr'];
    
    echo "<script>Swal.fire({
        title: 'Deseas eliminar producto?',
        text: 'Esta accion no se puede deshacer!',
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
                window.location.href = 'delete_product2.php?usr=$codproducto'
            })
        } else {
            window.location.href = '../Vista/html/inventarios.php';
        }
    });</script>";

    
    
    
?>