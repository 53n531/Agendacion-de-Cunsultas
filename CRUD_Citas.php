<?php
include 'global/config.php';
include 'global/conexion.php';
 ?>

 <?php
$Mensaje = "";

if (isset($_POST['Boton'])) {

switch ($_POST['Boton']) {
  case 'Agregar':
  $ID = $_POST['ID'];
  $Nombre = $_POST['Nombre'];
  $Apellido = $_POST['Apellido'];
  $Especialidad = $_POST['Especialidad'];
  $Fecha = $_POST['Fecha'];
  $Hora = $_POST['Hora'];

  $Agregar_cita = $pdo->prepare("INSERT INTO crear_citas (ID_DOCTOR, Nombre_Doctor, Apellido_Doctor, ESPECIALIDAD, Fecha, Hora)
  VALUES (:ID, :Nombre, :Apellido, :Especialidad, :Fecha, :Hora)");

  $Agregar_cita->bindParam(':ID', $ID);
  $Agregar_cita->bindParam(':Nombre', $Nombre);
  $Agregar_cita->bindParam(':Apellido', $Apellido);
  $Agregar_cita->bindParam(':Especialidad', $Especialidad);
  $Agregar_cita->bindParam(':Fecha', $Fecha);
  $Agregar_cita->bindParam(':Hora', $Hora);
  $Agregar_cita->execute();
  header("location:interfaz_medico.php");
    break;

    case 'Agregar_especialidades':
      $Especialidades = $_POST['Especialidades'];

      $Agregar_Especialidad = $pdo->prepare("INSERT INTO especialidad (Nombre_especialidad)
      VALUES (:Especialidades)");

      $Agregar_Especialidad->bindParam(':Especialidades', $Especialidades);
      $Agregar_Especialidad->execute();
      header("location:interfaz_administrador.php");
      break;

  default:
    echo "Hay un error... contactese con el desarrollador";
    break;
 }

}

  ?>
