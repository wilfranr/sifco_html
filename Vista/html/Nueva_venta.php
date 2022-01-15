<?php
include "../../includes/conexion.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "../../includes/script.php";
    include "../../includes/header.php";
    include "../../includes/nav.php";
    ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva venta</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../js/functions.js"></script>
</head>

<body>
    <section id="container">
        <div class="title_page mt-2">
            <h1>Nueva Venta</h1>
        </div>

        <div class="nueva_venta">
            <div class="container">
                <h4>Datos del Cliente</h4>
                <a href="new_cliente.php" target="blank" class="btn btn-primary mb-3" id="btn_new_client">Nuevo</a>

                <div class="datos_cliente">
                    <form>
                        <div class="row">
                            <div class="form-group col">
                                <input type="hidden" name="action" value="addCliente">
                                <input type="hidden" name="id_cliente" id="id_cliente" value="" required>
                                <label for="nit">Nit o CC</label>
                                <input type="number" class="form-control" id="nit_cliente">
                            </div>
                            <div class="form-group mb-2 col">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nom_cliente" disabled required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" id="tel_cliente" disabled required>
                            </div>
                            <div class="form-group mb-3 col">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control" id="dir_cliente" disabled required>
                            </div>
                        </div>
                </div>

                </form>
            </div>
        </div>
        <div class="container nueva_venta">
            <p>Datos de Facturación</p>
            <p><?php
                echo utf8_decode($row['rol']);
                echo ": ";
                echo utf8_decode($row['nombre']);
                ?></p>
        </div>

    </section>
    <?php include "../../includes/footer.php" ?>
</body>

</html>