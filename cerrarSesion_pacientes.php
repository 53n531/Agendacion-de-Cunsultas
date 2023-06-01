<?php
session_start();
session_destroy();
unset($_SESSION['correo']);
header('location:Login_pacientes.php')
?>
