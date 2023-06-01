<?php
include 'CRUD_Pacientes.php';
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

          $Perfiles = mysqli_query($conexion, "select * from pacientes where Usuarios = '$USUARIO'") or
            die("Problemas en el select:" . mysqli_error($conexion));

            $Perf = mysqli_fetch_array($Perfiles);

            $MI_ID = $Perf['ID_Pacientes'];
            $MI_NOMBRE = $Perf['Nombre'];
            $MI_APELLIDO = $Perf['Apellido'];
            $SEXO = $Perf['Sexo'];

        } else {
          header("location:Login_pacientes.php");
        }
         ?>

      <?php
      $M = "";
      date_default_timezone_set('America/Mexico_City');
      $hora= date("G");
      $Mes = date("m");

     if ($hora >=6 && $hora <12) {
       $M = "Buenos dias ". ' <i class="fa-solid fa-sun"></i>';
     } elseif ($hora >= 12 && $hora < 19){
       $M = "Buenas tardes ". '<i class="fa-solid fa-cloud-sun"></i>';
     } else {
       $M = "Buenas noches ". '<i class="fa-solid fa-cloud-moon"></i>' ;
     }
       ?>

      <div class="d-flex d-sm-flex d-md-flex d-lg-flex">
        <div id="sidebar-container" class="" style="background: #15BBAC;">
          <div class="logo">
            <div class="Centrar_imagen" style="justify-content: center; align-items: center; display: flex;">
              <img src="images/Logo.png" alt="" width="130px" height="130px">
            </div>
            <!-- <h6 style="text-align:center; margin-top: 8px;">Vitales</h6> -->
            <hr style="height: 2px; background:white;">

          </div> <br> <br>
          <div class="menu" style="text-align:center;">
            <a href="interfaz_paciente.php" class="enlaces"><i class="fa-solid fa-file-pdf"></i> Citas medicas</a>
            <a href="miCitas_paciente.php" class="enlaces2"><i class="fa-solid fa-file-pdf"></i> Mis citas</a>
            <!-- <a href="interfaz_medico.php" class="enlaces enlaces2"><i class="fa-solid fa-envelope icono"></i> Agenda de citas
                <span class="badge badge-light" id="mi_noti"></span> </a> -->

          </div>

          <br> <br> <br>
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
                               <h4 class="text-center"><?php echo "Bienvenido ". $MI_NOMBRE. " ". $MI_APELLIDO; ?></h4>
                             <?php else: ?>
                               <h4 class="text-center"><?php echo "Bienvenida ". $MI_NOMBRE. " ". $MI_APELLIDO; ?></h4>
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
                                 <a class="dropdown-item" href="cerrarSesion_pacientes.php">cerrar sesión</a>
                             </div>
                         </li>
                       </ul>

                   </div>
               </div>
           </nav>
         <br>
           <div class="contenedor" style="overflow-y: auto; overflow-x: hidden; height:87vh; width:90%; padding-bottom:0px; margin: auto;">
             <?php
             $Consultar_citas = $pdo->prepare("SELECT * FROM citas_pacientes where ID_PACIENTE = '$MI_ID;'");
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
                               <h5 class="card-title text-center"><?php echo $citas['Especialidad']; ?></h5>
                               <p class="card-text"> <?php echo "<strong>Nombre del doctor: </strong>". $citas['Nombre_doctor']; ?> </p>
                               <p class="card-text"> <?php echo "<strong>Apellido del doctor: </strong>". $citas['Apellido_doctor']; ?> </p>
                               <p class="card-text"> <?php echo "<strong>Fecha de la cita: </strong>". $citas['Fecha']; ?> </p>
                               <p class="card-text"> <?php echo "<strong>Hora de la cita: </strong>". $citas['Hora']; ?> </p>
                              <hr>
                              <p class="card-text"> <?php echo "<strong> Nombre del paciente: </strong>". $citas['Nombre_paciente'] ?> </p>
                              <p class="card-text"> <?php echo "<strong>Apellido del paciente: </strong>". $citas['Apellido_paciente']; ?> </p>
                               <p class="card-text text-center"><small class="text-muted"> Le recomendamos llegar al tiempo, de lo contrario
                                                                               podria perder su cita</small></p>
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

       <!-- Modal -->
       <div class="modal fade" id="MODAL_ADVERTENCIA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <!-- modal-sm = modal small | modal-lg = modal large | modal-xl = modal extra large  -->
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                       <h5 class="text-center">¿Desea agendar esta fecha?</h5>
                       <form method="post" style="padding: 10px;">

                         <strong>Resumen de la cita:</strong>
                         <hr>

                         Especialidad del medico
                         <input type="text" readonly class="form-control" name="Especialidad" id="Especialidad" value="">
                         Nombre del medico
                         <input type="text" readonly class="form-control" name="Nombre" id="Nombre" value="">
                         Apellido del medico
                         <input type="text" readonly class="form-control" name="Apellido" id="Apellido" value="">
                         Fecha de la cita
                         <input type="text" readonly class="form-control" name="Fecha" id="Fecha" value="">
                         Hora de la cita
                         <input type="text" readonly class="form-control" name="Hora" id="Hora" value="">
                         <input type="text" name="Nombre_paciente" value="<?php echo $MI_NOMBRE; ?>">
                         <input type="text" name="Apellido_paciente" value="<?php echo $MI_APELLIDO; ?>">
                   </div>

                   <div class="modal-footer d-flex justify-content-center">
                     <button type="submit" name="Boton" value="Agregar" class="btn btn-primary"> Guardar cita </button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar</button>
                   </div>
                 </form>
               </div>
           </div>
       </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" ></script>
        <script src="js\bootstrap.min.js"></script>
  </body>
</html>
