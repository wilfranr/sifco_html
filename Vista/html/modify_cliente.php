<?php
    include '../../includes/header.php';
    include '../../includes/nav.php';
    
    if(empty($_GET['usr'])){
        header('Location: clientes.php');
    }
    
    
    $consult = Consult_user($_GET['usr']);
    function Consult_user($id){

    include '../../includes/conexion.php';
    $sentence = "SELECT * FROM cliente WHERE id = '".$id."'";
    $result = $conexion->query($sentence) or die ("Error al consultar: ".mysqli_error($conexion));
    
    $rows = $result->fetch_assoc();

    return[
        //aquí deben ir las columnas de la base de datos
        $rows['id'],//0
        $rows['nombre'],//1
        $rows['tipoId'],//2
        $rows['direccion'],//3
        $rows['telefono'],//4
        $rows['correo']//5
        
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
    <title>Modificar Cliente</title>
</head>

<body>
    
    <!--modificar usuario-->
    <div class="agregar-usuario" id="modificar-usuario">
        <form action="../../Controlador/edit_cliente.php" class="inventario" method="POST">
            <h3>MODIFICAR CLIENTE</h3><br>
            <label for="consulta-codigo">NOMBRES</label>
            <input class="control-usuario" name="name" value="<?php echo $consult[1]?>" type="text" required><br><br>
            <label for="Tipo id">TIPO ID.</label>
            <select name="typeId" id="tipo-id" required>
            <option><?php echo $consult[2]?></option>
            <option>CC</option>
            <option>CE</option>
            <option>NIT</option>
            </select><br><br>
            <label for="id">IDENTIFICACIÓN</label>
            <input class="control-usuario" name="id" value="<?php echo $consult[0]?>" type="text" required readonly><br><br>
            <label for="consulta-palabra">DIRECCIÓN</label>
            <input class="control-usuario" name="dir" value="<?php echo $consult[3]?>" type="text" ><br><br>
            <label for="consulta-palabra">TELÉFONO</label>
            <input class="control-usuario" name="tel" value="<?php echo $consult[4]?>" type="text" ><br><br>
            <label for="consulta-palabra">EMAIL</label>
            <input class="control-usuario" name="email" value="<?php echo $consult[5]?>" type="email" ><br><br>
            <input class="boton-consultar" type="submit" value="MODIFICAR">
            <a href="clientes.php"><input class="boton-cancelar" type="button" value="CANCELAR"></a> 
            
         </form>

    </div>

</body>

<?php include '../../includes/footer.php';?>
</html>