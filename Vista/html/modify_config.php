<?php
    include '../../includes/header.php';
    include '../../includes/nav.php';
    include '../../includes/script.php';
    
    if(empty($_GET['usr'])){
        header('Location: configuracion.php');
    }
    
    
    $consult = Consult_user($_GET['usr']);
    function Consult_user($id){

    include '../../includes/conexion.php';
    $sentence = "SELECT * FROM configuracion WHERE id = '".$id."'";
    $result = $conexion->query($sentence) or die ("Error al consultar: ".mysqli_error($conexion));
    
    $rows = $result->fetch_assoc();

    return[
        //aquí deben ir las columnas de la base de datos
        $rows['id'],//0
        $rows['nit'],//1
        $rows['nombre'],//2
        $rows['razon_social'],//3
        $rows['telefono'],//7
        $rows['email'],//4
        $rows['direccion'],//6
        $rows['iva'],//5
        
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
    <title>Modificar Empresa</title>
</head>

<body>
    
    <!--modificar usuario-->
    <div class="agregar-usuario" id="modificar-usuario">
        <form action="../../Controlador/edit_empresa.php" class="inventario" method="POST">
            <h3>MODIFICAR EMPRESA</h3><br>
            <label for="consulta-codigo">NIT</label>
            <input class="control-usuario" name="nit" value="<?php echo $consult[1]?>" type="number" required><br><br>
            
            <label for="consulta-codigo">NOMBRE</label>
            <input class="control-usuario" name="name" value="<?php echo $consult[2]?>" type="text" required ><br><br>

            <label for="consulta-codigo">RAZON SOCIAL</label>
            <input class="control-usuario" name="razon_social" value="<?php echo $consult[2]?>" type="text" required ><br><br>
            
            <label for="consulta-palabra">TELÉFONO</label>
            <input class="control-usuario" name="tel" value="<?php echo $consult[4]?>" type="text" ><br><br>

            <label for="consulta-palabra">EMAIL</label>
            <input class="control-usuario" name="email" value="<?php echo $consult[5]?>" type="email" ><br><br>

            <label for="consulta-palabra">DIRECCIÓN</label>
            <input class="control-usuario" name="dir" value="<?php echo $consult[6]?>" type="text" ><br><br>
            
            <label for="consulta-palabra">IVA%</label>
            <input class="control-usuario" name="iva" value="<?php echo $consult[7]?>" type="number" ><br><br>
            
            <input name="id" value="<?php echo $consult[0]?>" type="hidden">

            <input class="boton-consultar" type="submit" value="MODIFICAR">

            <a href="configuracion.php"><input class="boton-cancelar" type="button" value="CANCELAR"></a> 
            

         </form>

    </div>

</body>

<?php include '../../includes/footer.php';?>
</html>