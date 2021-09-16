<?php
    include '../../includes/conexion.php';
    include '../../includes/header.php';
    include '../../includes/nav.php';
    include '../../includes/script.php';

    if ($_SESSION['rol'] == 'Administrador'||$_SESSION['rol']=='Vendedor'){
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../js/functions.js"></script>
    
    <title>Clientes</title>
</head>
    
<body>
<!--Botones de usuario-->
<div class="container-tabla-usuarios">
    <h1>CLIENTES</h1><br>
    <table class="tabla-usuarios">
        <th>Identificación</th>
        <th>Nombres</th>
        <th>Direccion</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Tipo. Id</th>
    
        <?php 
        //query para paginador
        $sql_register = mysqli_query($conexion, "SELECT COUNT(*) as total_registro FROM cliente");
        $result_register = mysqli_fetch_array($sql_register);
        $total_registro=$result_register['total_registro'];

        $por_pagina = 5;//numero de registros que se muestran por página

        if (empty($_GET['pagina'])){
            $pagina=1;
        }else{
            $pagina=$_GET['pagina'];
        }

            $desde = ($pagina-1) * $por_pagina;
            $total_paginas=ceil($total_registro/$por_pagina);

            $sentence="SELECT * FROM cliente ORDER BY nombre LIMIT $desde, $por_pagina";
            $result = $conexion->query($sentence) or die ("Error al consultar: " .mysqli_error($conexion));
            mysqli_close($conexion);
            
            while($rows = $result->fetch_assoc())
            {
        ?>
                <tr>
                    <td><?php echo $rows['id']?></td>
                    <td><?php echo $rows['nombre']?></td>
                    <td><?php echo $rows['direccion']?></td>
                    <td><?php echo $rows['telefono']?></td>
                    <td><?php echo $rows['correo']?></td>
                    <td><?php echo $rows['tipoId']?></td>
                    <td><a href="modify_cliente.php?usr=<?php echo $rows['id'] ?>"><input class="btn-modificar" type="button" value="Modificar"></a></td>
                    <td><input class="btn-eliminar" type="button" value="Eliminar" onclick="DeleteClient()"></td>
                    
                </tr>

        <?php
            }
        ?>
    
    </table><br><br>

            <div class="paginador">
            <ul>
            <?php
                if ($pagina !=1){
            ?>
                <li><a href="?pagina=<?php echo 1;?>">|<</a></li>
                <li><a href="?pagina=<?php echo $pagina-1;?>"><<</a></li>
            <?php
                }
                for ($i=1; $i <= $total_paginas; $i++){  
                    
                    if($i == $pagina){
                        echo '<li class="pageSelected" >'.$i.'</li>';
                    }else{
                        echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
                    }
                }  
                if($pagina != $total_paginas){
            ?>
                <li><a href="?pagina=<?php echo $pagina+1;?>">>></a></li>
                <li><a href="?pagina=<?php echo $total_paginas?>">>|</a></li>
            <?php } ?>
            </ul>
            </div>

    <form action="search_cliente.php" method="GET">
    <label id="buscar" for="buscar">Consultar Base de Datos </label>
    <input type="text" class="control-buscar" id="busqueda" name="search" placeholder="Ingrese término a buscar">
    <input class="btn-buscar" type="submit" value="Buscar" name="buscar"><br><br><br>
    </form>

    <a href="new_cliente.php"><input class="btn-crear" type="button" value="Crear Cliente"></a>
</div>



</body>
<?php include '../../includes/footer.php'; 
}else{
    echo'<script>
            UserNoAccess()
        </script>';
}?>

</html>