<?php
    include '../../includes/header.php';
    include '../../includes/nav.php';
    
    if(empty($_GET['usr'])){
        header('Location: usuarios.php');
    }
    
    
    $consult = Consult_user($_GET['usr']);
    function Consult_user($id){

    include '../../includes/conexion.php';
    $sentence = "SELECT * FROM usuario WHERE id = '".$id."'";
    $result = $conexion->query($sentence) or die ("Error al consultar: ".mysqli_error($conexion));
    
    $rows = $result->fetch_assoc();

    return[
        //aquí deben ir las columnas de la base de datos
        $rows['id'],//0
        $rows['nombre'],//1
        $rows['usuario'],//2
        $rows['clave'],//3
        $rows['rol'],//4
        $rows['tipoId'],//5
        $rows['direccion'],//6
        $rows['telefono'],//7
        $rows['correo']//8
        
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
    <title>Modificar Usuario</title>
</head>

<body>
    
    <!--modificar usuario-->
    <div class="agregar-usuario" id="modificar-usuario">
        <form action="../../Controlador/edit_user.php" class="inventario" method="POST">
            <h3>MODIFICAR USUARIO</h3><br>
            <label for="consulta-codigo">NOMBRES</label>
            <input class="control-usuario" name="name" value="<?php echo $consult[1]?>" type="text" required><br><br>
            <label for="consulta-codigo">USUARIO</label>
            <input class="control-usuario" name="user" value="<?php echo $consult[2]?>" type="text" required readonly><br><br>
            <label for="Tipo id">TIPO ID.</label>
            <select name="typeId" id="tipo-id" required>
            <option><?php echo $consult[5]?></option>
            <option>CC</option>
            <option>CE</option>
            </select><br><br>
            <label for="id">IDENTIFICACIÓN</label>
            <input class="control-usuario" name="id" value="<?php echo $consult[0]?>" type="text" required readonly><br><br>
            <label for="consulta-palabra">DIRECCIÓN</label>
            <input class="control-usuario" name="dir" value="<?php echo $consult[6]?>" type="text" ><br><br>
            <label for="consulta-palabra">TELÉFONO</label>
            <input class="control-usuario" name="tel" value="<?php echo $consult[7]?>" type="text" ><br><br>
            <label for="consulta-palabra">EMAIL</label>
            <input class="control-usuario" name="email" value="<?php echo $consult[8]?>" type="email" ><br><br>
            <label for="tipo-usuario">TIPO DE USUARIO</label>
            <select class="noItem" name="type" id="tipo-id" required>
                <option><?php echo $consult[4]?></option>
                <option>Vendedor</option>
                <option>Administrador</option>
            </select><br><br>   
            <input class="boton-consultar" type="submit" value="MODIFICAR">
            <a href="usuarios.php"><input class="boton-cancelar" type="button" value="CANCELAR"></a> 
            <a href="mod_clave.php?usr=<?php echo $consult[0] ?>"><input class="btn-modificar-pass" type="button" value="Modificar Password"></a>
         </form>

    </div>

</body>

<?php include '../../includes/footer.php';?>
</html>