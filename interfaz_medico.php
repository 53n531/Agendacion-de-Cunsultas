<?php
include 'CRUD_Citas.php';
 ?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="css/interfaz_medico.css" type="text/css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>

        <title>Hello, world!</title>

    </head>

    <body>

      <?php
        session_start();
        if ($_SESSION['correo']) {
          $USUARIO = $_SESSION['correo'];

          $conexion = mysqli_connect("localhost", "root", "", "citas") or
            die("Problemas con la conexión");

          $Perfiles = mysqli_query($conexion, "select * from empleados where Usuarios = '$USUARIO'") or
            die("Problemas en el select:" . mysqli_error($conexion));

            $Perf = mysqli_fetch_array($Perfiles);

            $MI_ID = $Perf['ID_Empleados'];
            $MI_NOMBRE = $Perf['Nombre'];
            $MI_APELLIDO = $Perf['Apellido'];
            $SEXO = $Perf['Sexo'];

        } else {
          header("location:Login.php");
        }
         ?>

      <?php
      $M = "";
      date_default_timezone_set('America/Mexico_City');
      $hora= date("G");
      $Fecha_actual = date("Y-m-d");

     if ($hora >=6 && $hora <12) {
       $M = "Buenos dias ". ' <i class="fa-solid fa-sun"></i>';
     } elseif ($hora >= 12 && $hora < 19){
       $M = "Buenas tardes ". '<i class="fa-solid fa-cloud-sun"></i>';
     } else {
       $M = "Buenas noches ". '<i class="fa-solid fa-cloud-moon"></i>' ;
     }
       ?>

      <div class="d-flex d-sm-flex d-md-flex d-lg-flex">
        <div id="sidebar-container" style="background: #15BBAC;">
          <div class="logo">
            <div class="Centrar_imagen" style="justify-content: center; align-items: center; display: flex;">
              <img src="images/Logo.png" alt="" width="130px" height="130px">
            </div>
            <hr style="height: 2px; background:white;">
          </div> <br><br>
          <div class="menu" style="text-align:center;">
              <a href="Crear_agenda.php" class="enlaces"> Crear cita </a>
              <a href="interfaz_medico.php" class="enlaces2"></i> Agenda de citas</a>
          </div>

          <br><br>
           <hr style="height: 2px; background:white;">
         <strong> <p class="text-center"><?php echo $M;?> </p> </strong>
          <!-- <h5 class="text-center"> <?php echo $hora; ?> </h5> -->
          <hr style="height: 2px; background:white;">
        </div>

        <div class="Menu_navegacion">
           <nav class="navbar navbar-expand-lg navbar-light bg-light">
               <div class="container">
                   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                       <span class="navbar-toggler-icon"></span>
                   </button>

                   <div class="collapse navbar-collapse" id="navbarSupportedContent">
                       <ul class="navbar-nav mx-auto">

                           <li class="nav-item ">
                             <?php if ($SEXO == "Masculino"): ?>
                               <h4 class="text-center"><?php echo "Bienvenido doctor ". $MI_NOMBRE. " ". $MI_APELLIDO; ?></h4>
                             <?php else: ?>
                               <h4 class="text-center"><?php echo "Bienvenida doctora ". $MI_NOMBRE. " ". $MI_APELLIDO; ?></h4>
                             <?php endif; ?>
                           </li>
                       </ul>

                       <ul class="navbar-nav ">
                         <li class="nav-item dropdown">
                             <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 Opción
                             </a>
                             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                 <a class="dropdown-item" href="#"> Mi perfil</a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="cerrarSesion_empleado.php">cerrar sesión</a>
                             </div>
                         </li>
                       </ul>

                   </div>
               </div>
           </nav>
         <br>
           <div class="contenedor" style="overflow-y: auto; overflow-x: hidden; height:87vh; width:90%;
                                          padding-bottom:0px; margin: auto;">
             <?php
             $Consultar_citas = $pdo->prepare("SELECT * FROM citas_pacientes where ID_DOCTOR = '$MI_ID'
                                               AND Fecha = '$Fecha_actual;'");
             $Consultar_citas->execute();
             $Lista_citas = $Consultar_citas->fetchAll(PDO::FETCH_ASSOC);
              ?>

             <div class="row">
               <?php foreach ($Lista_citas as $citas): ?>
               <div class="col-4">
               <div class="card" >
                   <div class="row">

                       <div class="col-md-12">
                           <div class="card-body">
                               <h5 class="card-title text-center"> Datos de la cita </h5>
                               <p class="card-text"> <?php echo " <strong> Nombre del paciente: </strong>". $citas['Nombre_paciente']; ?> </p>
                               <p class="card-text"> <?php echo " <strong> Apellido del paciente: </strong>". $citas['Apellido_paciente']; ?> </p>
                               <!-- <p class="card-text"> <?php echo "Nombre: ". $citas['Nombre_doctor']; ?> </p>
                               <p class="card-text"> <?php echo "Apellido: ". $citas['Apellido_doctor']; ?> </p> -->
                               <p class="card-text"> <?php echo " <strong> Fecha: </strong>". $citas['Fecha']; ?> </p>
                               <p class="card-text"> <?php echo " <strong> Hora: </strong>". $citas['Hora']; ?> </p>
                               
                           </div>
                       </div>
                     </div>
                   </div>
                  </div>
                <?php endforeach; ?>
                 </div>
               </div>

         </div>
       </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" ></script>
        <script src="js\bootstrap.min.js"></script>
  </body>
</html>
<script src="js/indicador_modulo.js" charset="utf-8"></script>
