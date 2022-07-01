<?php
    include '../../includes/header.php';
    include '../../includes/nav.php';
    include '../../includes/script.php';
    
    if(empty($_GET['usr'])){
        header('Location: proveedores.php');
    }
    
    
    $consult = Consult_user($_GET['usr']);
    function Consult_user($cod){

    include '../../includes/conexion.php';
    $sentence = "SELECT * FROM proveedor WHERE codproveedor = '".$cod."'";
    $result = $conexion->query($sentence) or die ("Error al consultar: ".mysqli_error($conexion));
    
    $rows = $result->fetch_assoc();

    return[
        //aquí deben ir las columnas de la base de datos
        $rows['codproveedor'],//0
        $rows['id'],//1
        $rows['tipoIdProveedor'],//2
        $rows['proveedor'],//3
        $rows['contacto'],//4
        $rows['direccion'],//5
        $rows['telefono'],//6
        $rows['correo']//7
        
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
    <script type="text/javascript" src="../js/functions.js"></script>
    <title>Modificar Proveedor</title>
</head>

<body>
    
    <!--modificar usuario-->
    <div class="agregar-usuario" id="modificar-usuario">
        <form action="../../Controlador/edit_proveedor.php" class="inventario" method="POST">
            <h3>MODIFICAR PROVEEDOR</h3><br>
            <label for="consulta-codigo">PROVEEDOR</label>
            <input class="control-usuario" name="proveedor" value="<?php echo $consult[3]?>" type="text" required><br><br>
            <label for="consulta-codigo">IDENTIFICACION</label>
            <input class="control-usuario" name="id" value="<?php echo $consult[1]?>" type="text" placeholder="Cédula o Nit" required><br><br>
            <label for="Tipo id">TIPO ID.</label>
            <select name="typeId" id="tipo-id" required>
            <option disabled value="" style="color:white;">Seleccione una opcion</option>
            <option>NIT</option>
            <option>CC</option>
            <option>CE</option>
            </select><br><br>
            <label for="consulta-codigo">CONTACTO</label>
            <input class="control-usuario" name="contacto" value="<?php echo $consult[4]?>" type="text" required><br><br>
            
            <input class="control-usuario" name="codproveedor" value="<?php echo $consult[0]?>" type="hidden" required readonly>
            
            <label for="consulta-palabra">DIRECCIÓN</label>
            <input class="control-usuario" name="dir" value="<?php echo $consult[5]?>" type="text" ><br><br>
            <label for="consulta-palabra">TELÉFONO</label>
            <input class="control-usuario" name="tel" value="<?php echo $consult[6]?>" type="text" ><br><br>
            <label for="consulta-palabra">EMAIL</label>
            <input class="control-usuario" name="email" value="<?php echo $consult[7]?>" type="email" ><br><br>
            <input class="boton-consultar" type="submit" value="MODIFICAR">
            <a href="proveedores.php"><input class="boton-cancelar" type="button" value="CANCELAR"></a> 
            
         </form>

    </div>

</body>

<?php include '../../includes/footer.php';?>
</html>