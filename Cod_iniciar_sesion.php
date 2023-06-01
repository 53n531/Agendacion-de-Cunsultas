<?php

$Mensaje_error = "";

if (isset($_POST['Entrar'])) {
  $usuario = $_POST['correo'];
  $contrase = $_POST['contrasena'];


  $conexion = mysqli_connect("localhost", "root", "", "citas") or
    die("Problemas con la conexión");

  $registros = mysqli_query($conexion, "select * from empleados where Usuarios = '$usuario' and  Clave = '$contrase'
  AND Puesto = 'Administrador'") or
    die("Problemas en el select:" . mysqli_error($conexion));
    $reg1 = mysqli_fetch_array($registros);


      $registros2 = mysqli_query($conexion, "select * from empleados where Usuarios = '$usuario' and  Clave = '$contrase'
      AND Puesto = 'Doctor'") or
        die("Problemas en el select:" . mysqli_error($conexion));
        $reg2 = mysqli_fetch_array($registros2);

      if($reg1){
       session_start();
       $_SESSION['correo'] = $usuario;
       header("location:interfaz_administrador.php");

     } elseif ($reg2) {
       session_start();
       $_SESSION['correo'] = $usuario;
       header("location:interfaz_medico.php");

     } else {
     $Mensaje_error = "¡Correo o contraseña incorrecto!";
      // echo '<script> alert("Usuario o contraseña incorrecta"); </script>';
      }
      mysqli_close($conexion);
}

if (isset($_POST['Registrarse'])) {

  $pdo=new PDO("mysql:dbname=citas;host=127.0.0.1", "root", "");

  $Correo = $_POST['Correo'];
  $Clave = $_POST['Clave'];
  $Nombre = $_POST['Nombre'];
  $Sexo = $_POST['Sexo'];
  $Apellido = $_POST['Apellido'];
  $Domicilio = $_POST['Domicilio'];
  $Telefono = $_POST['Telefono'];
  $Administrador = $_POST['Administrador'];
  $Especialidad = $_POST['Especialidad'];



  $Agregar_Empleado = $pdo->prepare("INSERT INTO empleados (Usuarios, Clave, Nombre, Apellido, Sexo, Domicilio, Telefono, Puesto, ESPECIALIDAD)
  VALUES (:Correo, :Clave, :Nombre, :Apellido, :Sexo, :Domicilio, :Telefono, :Administrador, :Especialidad)");

  $Agregar_Empleado->bindParam(':Correo', $Correo);
  $Agregar_Empleado->bindParam(':Clave', $Clave);
  $Agregar_Empleado->bindParam(':Nombre', $Nombre);
  $Agregar_Empleado->bindParam(':Apellido', $Apellido);
  $Agregar_Empleado->bindParam(':Sexo', $Sexo);
  $Agregar_Empleado->bindParam(':Domicilio', $Domicilio);
  $Agregar_Empleado->bindParam(':Telefono', $Telefono);
  $Agregar_Empleado->bindParam(':Administrador', $Administrador);
  $Agregar_Empleado->bindParam(':Especialidad', $Especialidad);
  $Agregar_Empleado->execute();

  header("location:Login.php");

}
 ?>
