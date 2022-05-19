<?php
    include '../../includes/header.php';
    include '../../includes/nav.php';
    include '../../includes/script.php';
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
        //aquí van las columnas de la base de datos
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
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="font.css">
    <title>SIFCO-WEB</title>
</head>

<body>
    

    
    <!--modificar usuario-->
    <div class="agregar-usuario" id="modificar-usuario">
        <form action="../../Controlador/edit_pass.php" class="inventario" method="POST">
            <h3>MODIFICAR CLAVE</h3><br>

            <label for="id">IDENTIFICACIÓN</label>
            <input class="control-usuario" name="id" value="<?php echo $consult[0]?>" type="text" required readonly><br><br>
            <label for="consulta-codigo">USUARIO</label>
            <input class="control-usuario" name="user" value="<?php echo $consult[2]?>" type="text" required readonly><br><br>
            
            <label for="consulta-palabra">PASSWORD</label>
            <input class="control-usuario" value="" name="pass" type="password" ><br><br>
            <label for="consulta-palabra">CONFIRME SU PASSWORD</label>
            <input class="control-usuario" value="" name="pass2" type="password" ><br><br><br>

            <input class="boton-consultar" type="submit" value="MODIFICAR">
            <a href="..//html/usuarios.php"><input class="boton-cancelar" type="button" value="CANCELAR"></a> 
            
         </form>

    </div>
   

</body>

<?php include '../../includes/footer.php';?>
</html>