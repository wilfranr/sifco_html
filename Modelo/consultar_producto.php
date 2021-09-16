
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="" method="GET">
    <label for="codproducto">Código del Producto</label>
    <input type="text" name="consultar_producto" value="<?php echo ($_GET['consultar_producto']); ?>">
    <input type="submit" value="Buscar"><br><br>
    
    <?php
    if(!empty($_GET['consultar_producto'])){
        include '../includes/conexion.php';
        $consultar_producto = ($_GET['consultar_producto']);

        
            $query="SELECT * FROM producto WHERE codproducto = '".$consultar_producto."'";
            $result_producto = $conexion->query($query) or die ("Error al consultar: " .mysqli_error($conexion));
            $rows = mysqli_num_rows($result_producto);
            if($rows>0){
    
    $sentence="SELECT * FROM producto WHERE codproducto = '".$consultar_producto."'";
    $result = $conexion->query($sentence) or die ("Error al consultar: " .mysqli_error($conexion));
            
            
            while($rows = $result->fetch_array())
            {?>
    <label for="descripcion">Descripción</label>
    <input type="text" value="<?php echo $rows['descripcion']; ?>" >
                <?php
            }
        }else{?>
            <label for='descripcion'>Descripción</label>
            <input class="control2" name="descripcion" type="text" ><br>
        <?php
        }
    }
?>
    </form>
</body>
</html>
