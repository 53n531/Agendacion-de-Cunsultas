<?php
include 'global/config.php';
include 'global/conexion.php';
 ?>

 <?php
 $Mensaje = "";

 if (isset($_POST['Boton'])) {

 switch ($_POST['Boton']) {
  case 'Agregar':
  $ID_PACIENTE = $_POST['ID_PACIENTE'];
  $Nombre_paciente = $_POST['Nombre_paciente'];
  $Apellido_paciente = $_POST['Apellido_paciente'];
  $ID_DOCTOR = $_POST['ID_DOCTOR'];
  $Nombre = $_POST['Nombre'];
  $Apellido = $_POST['Apellido'];
  $Especialidad = $_POST['Especialidad'];
  $Fecha = $_POST['Fecha'];
  $Hora = $_POST['Hora'];

  $Agregar_citas = $pdo->prepare("INSERT INTO citas_pacientes (ID_PACIENTE, Nombre_paciente, Apellido_paciente,
                                    ID_DOCTOR, Nombre_doctor, Apellido_doctor, Especialidad, Fecha, Hora)
                                    VALUES(:ID_PACIENTE, :Nombre_paciente, :Apellido_paciente, :ID_DOCTOR,
                                      :Nombre, :Apellido, :Especialidad, :Fecha, :Hora)");


  $Agregar_citas->bindParam(':ID_PACIENTE', $ID_PACIENTE);
  $Agregar_citas->bindParam(':Nombre_paciente', $Nombre_paciente);
  $Agregar_citas->bindParam(':Apellido_paciente', $Apellido_paciente);
  $Agregar_citas->bindParam(':ID_DOCTOR', $ID_DOCTOR);
  $Agregar_citas->bindParam(':Nombre', $Nombre);
  $Agregar_citas->bindParam(':Apellido', $Apellido);
  $Agregar_citas->bindParam(':Especialidad', $Especialidad);
  $Agregar_citas->bindParam(':Fecha', $Fecha);
  $Agregar_citas->bindParam(':Hora', $Hora);
  $Agregar_citas->execute();
  header("location:interfaz_paciente.php");
    break;

  default:
    echo "Hay un error... contactese con el desarrollador";
    break;
 }

 }

  ?>
