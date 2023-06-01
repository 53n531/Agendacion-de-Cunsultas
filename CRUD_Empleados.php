<?php
include 'global/config.php';
include 'global/conexion.php';
 ?>

 <?php
$Mensaje = "";

if (isset($_POST['Boton'])) {

switch ($_POST['Boton']) {
  case 'Agregar':
  $Correo = $_POST['Correo'];
  $Clave = $_POST['Clave'];
  $Nombre = $_POST['Nombre'];
  $Apellido = $_POST['Apellido'];
  $Sexo = $_POST['Sexo'];
  $Domicilio = $_POST['Domicilio'];
  $Telefono = $_POST['Telefono'];
  $Administrador = $_POST['Puesto'];
  $Especialidad = $_POST['Especialidad'];

  $Agregar_Empleado = $pdo->prepare("INSERT INTO empleados (Usuarios, Clave, Nombre,
                                    Apellido, Sexo, Domicilio, Telefono, Puesto, ESPECIALIDAD)
                                    VALUES (:Correo, :Clave, :Nombre, :Apellido, :Sexo, :Domicilio, :Telefono, :Puesto, :Especialidad)");

  $Agregar_Empleado->bindParam(':Correo', $Correo);
  $Agregar_Empleado->bindParam(':Clave', $Clave);
  $Agregar_Empleado->bindParam(':Nombre', $Nombre);
  $Agregar_Empleado->bindParam(':Apellido', $Apellido);
  $Agregar_Empleado->bindParam(':Sexo', $Sexo);
  $Agregar_Empleado->bindParam(':Domicilio', $Domicilio);
  $Agregar_Empleado->bindParam(':Telefono', $Telefono);
  $Agregar_Empleado->bindParam(':Puesto', $Administrador);
  $Agregar_Empleado->bindParam(':Especialidad', $Especialidad);
  $Agregar_Empleado->execute();
  header("location:interfaz_administrador.php");
    break;

    case 'Agregar_especialidades':
      $Especialidades = $_POST['Especialidades'];

      $Agregar_Especialidad = $pdo->prepare("INSERT INTO especialidad (Nombre_especialidad)
      VALUES (:Especialidades)");

      $Agregar_Especialidad->bindParam(':Especialidades', $Especialidades);
      $Agregar_Especialidad->execute();
      header("location:interfaz_administrador.php");
      break;

      case 'Editar':
      $ID_EMPLEADO = $_POST['id_empleado'];
      $Nombre = $_POST['Nombre'];
      $Apellido = $_POST['Apellido'];
      $Domicilio = $_POST['Domicilio'];
      $Telefono = $_POST['Telefono'];
      $Administrador = $_POST['Puesto'];
      $Especialidad = $_POST['Especialidad'];

      $Editar_Empleado = $pdo->prepare("UPDATE empleados SET Nombre = :Nombre,
      Apellido = :Apellido, Domicilio = :Domicilio,
      Telefono = :Telefono, Puesto = :Puesto, ESPECIALIDAD = :Especialidad WHERE `empleados`.`ID_Empleados` = :id_empleado");

      $Editar_Empleado->bindParam(':id_empleado', $ID_EMPLEADO);
      $Editar_Empleado->bindParam(':Nombre', $Nombre);
      $Editar_Empleado->bindParam(':Apellido', $Apellido);
      $Editar_Empleado->bindParam(':Domicilio', $Domicilio);
      $Editar_Empleado->bindParam(':Telefono', $Telefono);
      $Editar_Empleado->bindParam(':Puesto', $Administrador);
      $Editar_Empleado->bindParam(':Especialidad', $Especialidad);
      $Editar_Empleado->execute();
      header("location:interfaz_administrador.php");
        break;

        case 'Borrar':
        $ID_EMPLEADO = $_POST['id_empleado'];

        $Eliminar_Empleados = $pdo->prepare("DELETE FROM empleados WHERE ID_Empleados = :id_empleado");
        $Eliminar_Empleados->bindParam(':id_empleado', $ID_EMPLEADO);
        $Eliminar_Empleados->execute();
          break;

  default:
    echo "Hay un error... contactese con el desarrollador";
    break;
 }

}

  ?>
