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

          $Perfiles = mysqli_query($conexion, "SELECT ID_Empleados, Nombre, Apellido, Domicilio,
            Telefono, Puesto, Sexo, especialidad.Nombre_especialidad FROM empleados INNER JOIN especialidad
          ON empleados.ESPECIALIDAD = especialidad.ID_Especialidad where Usuarios = '$USUARIO'") or
            die("Problemas en el select:" . mysqli_error($conexion));

            $Perf = mysqli_fetch_array($Perfiles);

            $MI_ID = $Perf['ID_Empleados'];
            $MI_NOMBRE = $Perf['Nombre'];
            $MI_APELLIDO = $Perf['Apellido'];
            $SEXO = $Perf['Sexo'];
            $Mi_Puesto = $Perf['Puesto'];
            $Mi_Especialidad = $Perf['Nombre_especialidad'];

        } else {
          header("location:Login.php");
        }
         ?>

      <?php
      $M = "";
      date_default_timezone_set('America/Mexico_City');
      $hora= date("G");

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

          </div> <br> <br>
          <div class="menu" style="text-align:center;">
            <a href="Crear_agenda.php" class="enlaces2"><i class="fa-solid fa-file-pdf"></i> Crear cita </a>
            <a href="interfaz_medico.php" class="enlaces"><i class="fa-solid fa-envelope icono"></i> Agenda de citas </a>
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
                             <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

           <div class="contenedor" style="overflow-y: auto; overflow-x: hidden; height:87vh; width:90%; padding-bottom:0px; margin: auto;">


             <form method="post" style="padding: 10px;">
                 <div class="form-group row">
                     <label for="inputEmail3" class="col-md-2 col-form-label">Fecha de la cita</label>
                     <div class="col-md-10">
                         <input type="date" name="Fecha" class="form-control">
                     </div>
                 </div>

                 <div class="form-group row">
                   <label for="inputEmail3" class="col-md-2 col-form-label">Nombre</label>
                    <div class="col-md-10">
                   <input type="text" name="Nombre" class="form-control" value="<?php echo $MI_NOMBRE; ?>">
                   <input type="hidden" name="ID" class="form-control" value="<?php echo $MI_ID; ?>">
               </div>
             </div>

                 <div class="form-group row">
                   <label for="inputEmail3" class="col-md-2 col-form-label">Apellido</label>
                   <div class="col-md-10">
                   <input type="text" name="Apellido" class="form-control" value="<?php echo $MI_APELLIDO; ?>">
               </div>
             </div>

             <div class="form-group row">
               <label for="inputEmail3" class="col-md-2 col-form-label">Apellido</label>
               <div class="col-md-10">
               <input type="text" name="Especialidad" class="form-control" value="<?php echo $Mi_Especialidad; ?>">
           </div>
         </div>


                 <div class="form-group row">
                     <label for="inputPassword3" class="col-md-2 col-form-label">Hora de la cita</label>
                     <div class="col-md-10">
                       <input type="time" class="form-control" name="Hora" value="">
                     </div>
                 </div>

                 <div class="form-group row">
                     <div class="col-md-10 d-flex justify-content-center">
                       <button type="submit" name="Boton" value="Agregar" class="btn btn-outline-success"> Registrar </button>
                     </div>
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

<script type="text/javascript">

$("#BTN_MODAL").on("click", function(e) {
  $('#Modal_agregar').modal();
});

$("#BTN_MODAL2").on("click", function(e) {
  $('#Modal_especialidad').modal();
});
</script>
