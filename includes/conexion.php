<?php
$conexion = new mysqli("localhost", "root", "", "SifcoWeb");//datos de la vase de datos para conectar

//comprobar que funcione la conexion
if(mysqli_connect_errno())
{
    printf("Error en la conexión");
}
?>

