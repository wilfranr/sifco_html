<?php
//destruye la sesión iniciada y regresa a index.php
    session_start();
    session_destroy();

    header('location: ../index.php')
?>