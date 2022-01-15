<?php
$conexion = new mysqli("localhost", "root", "", "sifcoweb");//datos de la base de datos para conectar

//comprobar que funcione la conexion
if(mysqli_connect_errno())
{
    printf("Error en la conexión");
}
?>

