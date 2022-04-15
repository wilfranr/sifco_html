<?php
include '../../includes/header.php';
include '../../includes/nav.php';
include '../../includes/script.php';
echo '<script type="text/javascript" src="../js/functions.js"></script>';

if (empty($_GET['usr'])) {
    header('Location: inventarios.php');
} else {
    $id_producto = $_REQUEST['usr'];
    if (!is_numeric($id_producto)) {
        header('Location: inventarios.php');
    }
    $query_producto = mysqli_query($conexion, "SELECT p.codproducto, p.nombre, p.descripcion, p.costo, p.precio, p.fechaVencimiento, pr.proveedor, p.foto FROM producto p INNER JOIN proveedor pr ON p.proveedor = pr.codproveedor WHERE p.codproducto = $id_producto AND p.estatus = 1");
    $result_producto = mysqli_num_rows($query_producto);

    $foto = '';
    $classRemove = 'notBlock';

    if ($result_producto > 0) {
        $data_producto = mysqli_fetch_assoc($query_producto);

        if ($data_producto['foto'] != 'img_producto.png') {  
            $classRemove = '';
            $foto = '<img id="img" src="../img/uploads/'.$data_producto['foto'].'" alt="Producto">';
            
        }
    } else {
        header('Location: inventarios.php');
    }
}

$consult = Consult_user($_GET['usr']);
function Consult_user($id)
{

    include '../../includes/conexion.php';
    $sentence = "SELECT * FROM producto WHERE codproducto = '" . $id . "'";
    $result = $conexion->query($sentence) or die("Error al consultar: " . mysqli_error($conexion));

    $rows = $result->fetch_assoc();

    return [
        //aquí deben ir las columnas de la base de datos
        $rows['codproducto'], //0
        $rows['nombre'], //1
        $rows['descripcion'], //2
        $rows['proveedor'], //3
        $rows['costo'], //4
        $rows['precio'], //5
        $rows['fechaVencimiento'], //6
        $rows['proveedor'], //6
        $rows['foto'], //7

    ];
}
?>
<?php
include '../../includes/conexion.php'
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Vista/css/estilos.css">
    <link rel="stylesheet" href="../font.css">
    
    <title>Editar Producto</title>
</head>

<body>
    

    <!--modificar producto-->
    <?php 
        $codproducto = $consult[0];
        $nombre = $consult[1];
        $descripcion = $consult[2];
        $costo = $consult[4];
        $precio = $consult[5];
        $fechaVence = $consult[6];
        $proveedor = $consult[3];
    
    ?>
    
    <div class="agregar-usuario" id="modificar-usuario">
        <form action="" class="inventario" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $data_producto['codproducto']; ?>">
            <input type="hidden" name="foto_actual" id="foto_actual" value="<?php echo $data_producto['foto']; ?>">
            <input type="hidden" name="foto_remove" id="foto_remove" value="<?php echo $data_producto['foto']; ?>">
            
            <h3>EDITAR PRODCUTO</h3><br>
            <label for="consulta-codigo">NOMBRE</label>
            <input class="control-usuario" name="name" value="<?php echo $nombre ?>" type="text" required><br><br>
            <!-- <label for="consulta-codigo">DESCRIPCIÓN</label>
            <input class="control-usuario mb-2" type="text" value="<?php echo $consult[2] ?>"><br> -->

            <label for="proveedor" class="">PROVEEDOR</label>
            <?php

            $query_proveedor = mysqli_query($conexion, "SELECT * FROM proveedor");
            $result_proveedor = mysqli_num_rows($query_proveedor);

            $query_update = mysqli_query($conexion, "UPDATE producto SET(nombre = $nombre, descripcion = $descripcion, proveedor = $proveedor, costo = $costo, precio = $precio, fechaVencimiento = $fechaVence, foto = $foto)
            WHERE codproducto = $codproducto ");


            ?>
            <select name="proveedor" id="tipo-id" class="notItemOne">
                <option value="<?php echo $data_producto['codproveedor']; ?>"><?php echo $data_producto['proveedor']; ?></option>
                <?php
                


                if ($result_proveedor > 0) {
                    while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                ?>

                        <option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?></option>
                        
                        <?php
                    }
                } ?>


            </select><br><br>

            <label for="id">DESCRIPCIÓN</label>
            <input class="control-usuario" name="id" value="<?php echo $descripcion ?>" type="text" required readonly><br><br>
            <label for="consulta-palabra">COSTO</label>
            <input class="control-usuario" name="dir" value="<?php echo $costo ?>" type="text"><br><br>
            <label for="consulta-palabra">PRECIO</label>
            <input class="control-usuario" name="tel" value="<?php echo $precio ?>" type="text"><br><br>
            <label for="consulta-palabra">FECHA VENCIMIENTO</label>
            <input class="control-usuario" name="email" value="<?php echo $fechaVence ?>" type="date"><br><br>
            <div class="photo">
                <label for="foto">Foto</label>
                <div class="prevPhoto">
                    <span class="delPhoto <?php echo $classRemove; ?>">X</span>
                    <label for="foto"></label>
                    <?php echo $foto; ?>
                    
                </div>
                <div class="upimg">
                    <input type="file" name="foto" id="foto">
                </div>
                <div id="form_alert"></div>
            </div>

            <div class="d-flex justify-content-between">
                <input class="btn btn-primary" type="submit" value="MODIFICAR">
                <a href="inventarios.php"><input class="btn btn-danger" type="button" value="CANCELAR"></a>
            </div>

        </form>

    </div>

</body>

<?php include '../../includes/footer.php'; ?>

</html>