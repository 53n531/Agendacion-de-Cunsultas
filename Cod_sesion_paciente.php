<?php

$Mensaje_error = "";

if (isset($_POST['Entrar'])) {
  $usuario = $_POST['correo'];
  $contrase = $_POST['contrasena'];


  $conexion = mysqli_connect("localhost", "root", "", "citas") or
    die("Problemas con la conexión");

  $registros = mysqli_query($conexion, "select * from pacientes where Usuarios = '$usuario' and  Clave = '$contrase'") or
    die("Problemas en el select:" . mysqli_error($conexion));
    $reg1 = mysqli_fetch_array($registros);


      if($reg1){
       session_start();
       $_SESSION['correo'] = $usuario;
       header("location:interfaz_paciente.php");

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
  $Apellido = $_POST['Apellido'];
  $Sexo = $_POST['Sexo'];
  $Domicilio = $_POST['Domicilio'];
  $Telefono = $_POST['Telefono'];
  // $Administrador = $_POST['Administrador'];
  // $Especialidad = $_POST['Especialidad'];


  $Agregar_Pacientes = $pdo->prepare("INSERT INTO pacientes (Usuarios, Clave, Nombre, Apellido, Sexo, Domicilio, Telefono)
  VALUES (:Correo, :Clave, :Nombre, :Apellido, :Sexo, :Domicilio, :Telefono)");

  $Agregar_Pacientes->bindParam(':Correo', $Correo);
  $Agregar_Pacientes->bindParam(':Clave', $Clave);
  $Agregar_Pacientes->bindParam(':Nombre', $Nombre);
  $Agregar_Pacientes->bindParam(':Apellido', $Apellido);
  $Agregar_Pacientes->bindParam(':Sexo', $Sexo);
  $Agregar_Pacientes->bindParam(':Domicilio', $Domicilio);
  $Agregar_Pacientes->bindParam(':Telefono', $Telefono);
  // $Agregar_Pacientes->bindParam(':Administrador', $Administrador);
  // $Agregar_Pacientes->bindParam(':Especialidad', $Especialidad);
  $Agregar_Pacientes->execute();

  header("location:Login_pacientes.php");

}
 ?>
