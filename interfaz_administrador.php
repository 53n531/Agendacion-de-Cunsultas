<?php
include 'CRUD_Empleados.php';
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

          </div> <br>
          <div class="menu" style="text-align:center;">
            <a href="interfaz_administrador.php" class="enlaces enlaces2"><i class="fa-solid fa-envelope icono"></i> Consultar empleados
                <span class="badge badge-light" id="mi_noti"></span> </a>

            <!-- <a href="#" class="enlaces"><i class="fa-solid fa-share icono"></i> Turnados </a>
            <a href="#" class="enlaces"><i class="fa-solid fa-arrow-rotate-left icono"></i> Retornados</a> -->
          </div>

          <br><br><br>
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
                              <h4 class="text-center"><?php echo "Bienvenido administrador ". $MI_NOMBRE. " ". $MI_APELLIDO; ?></h4>
                            <?php else: ?>
                              <h4 class="text-center"><?php echo "Bienvenida administradora ". $MI_NOMBRE. " ". $MI_APELLIDO; ?></h4>
                            <?php endif; ?>
                           </li>
                       </ul>

                       <ul class="navbar-nav ">
                         <li class="nav-item dropdown">
                             <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 Opción
                             </a>
                             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                 <a class="dropdown-item" id="BTN_MODAL" href="#"> Agregar empleado</a>
                                 <a class="dropdown-item" id="BTN_MODAL2" href="#"> Agregar Especialidad</a>
                                 <a class="dropdown-item" href="#"> Mi perfil</a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="cerrarSesion_empleado.php">cerrar sesión</a>
                             </div>
                         </li>
                       </ul>

                   </div>
               </div>
           </nav> <br>


           <div class="contenedor" style="overflow-y: auto; overflow-x: hidden; height:87vh; width:90%; padding-bottom:0px; margin: auto;">

             <table class="table text-center table-bordered table-hover">

               <?php
               $Consultar_empleados = $pdo->prepare("SELECT ID_Empleados, Nombre, Apellido, Domicilio,
               Telefono, Puesto, especialidad.ID_Especialidad, especialidad.Nombre_especialidad
               FROM empleados INNER JOIN especialidad ON empleados.ESPECIALIDAD = especialidad.ID_Especialidad");
               $Consultar_empleados->execute();
               $Lista_empleados = $Consultar_empleados->fetchAll(PDO::FETCH_ASSOC);
                ?>

               <thead>
                 <th>ID</th>
                 <th>Nombre</th>
                 <th>Apellido</th>
                 <th>Puesto</th>
                 <th>Especialidad</th>
                 <th>Dirección</th>
                 <th>Telefono</th>
                 <th colspan="2">Opciones</th>
               </thead>

               <?php foreach ($Lista_empleados as $Empleados): ?>
               <tbody>
                 <td><?php echo $Empleados['ID_Empleados']; ?></td>
                 <td><?php echo $Empleados['Nombre']; ?></td>
                 <td><?php echo $Empleados['Apellido']; ?></td>
                 <td><?php echo $Empleados['Puesto']; ?></td>
                 <td style="display:none;"><?php echo $Empleados['ID_Especialidad']; ?></td>
                 <td><?php echo $Empleados['Nombre_especialidad']; ?></td>
                 <td><?php echo $Empleados['Domicilio']; ?></td>
                 <td><?php echo $Empleados['Telefono']; ?></td>
                 <td><button type="button" data-target="#Modal_editar" id="BTN_MODAL3" class="btn btn-info BTN_MODAL3">Editar</button></td>
                 <td><button type="button" class="btn btn-danger BTN_MODAL4">Borrar</button></td>
               </tbody>
             <?php endforeach; ?>
             </table>
           </div>

         </div>
       </div>


       <!-- Modal -->
       <div class="modal fade" id="Modal_agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <!-- modal-sm = modal small | modal-lg = modal large | modal-xl = modal extra large  -->
           <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Registrar empleado</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>

                   <div class="modal-body">
                       <form method="post" style="padding: 10px;">
                         <h4 class="text-center">REGISTRO DE EMPLEADO</h4>


                         <div class="form-row">
                           <div class="form-group col-md-6">
                               <label for="correo" class="col-md-2 col-form-label">Correo</label>
                               <input type="text" name="Correo" class="form-control" id="correo">
                           </div>

                           <div class="form-group col-md-6">
                               <label for="contraseña" class="col-md-2 col-form-label">Contraseña</label>
                               <input type="password" name="Clave" class="form-control" id="contraseña">
                           </div>
                         </div>

                         <div class="form-row">
                           <div class="form-group col-md-5">
                               <label for="nombre" class="col-md-2 col-form-label">Nombre</label>
                               <input type="text" name="Nombre" class="form-control" id="nombre">
                           </div>

                           <div class="form-group col-md-5">
                               <label for="Apellido" class="col-md-2 col-form-label">Apellido</label>
                               <input type="text" name="Apellido" class="form-control" id="Apellido">
                           </div>

                           <div class="form-group col-md-2">
                               <label for="Sexo" class="col-md-2 col-form-label">Sexo</label>
                               <select class="form-control" name="Sexo" required>
                                 <option value="">¿?</option>
                                 <option value="Masculino">Masculino</option>
                                 <option value="Femenino">Femenino</option>
                               </select>
                           </div>
                         </div>

                         <div class="form-row">
                           <div class="form-group col-md-6">
                               <label for="Puesto" class="col-md-2 col-form-label">Puesto</label>
                               <select class="form-control" name="Puesto" required id="Puesto">
                                 <option value=""> Seleccione un puesto </option>
                                 <option value="Administrador"> Administrador </option>
                                 <option value="Doctor"> Doctor </option>
                               </select>
                           </div>

                           <?php
                           $Consultar_especialidades = $pdo->prepare("SELECT * FROM especialidad");
                           $Consultar_especialidades->execute();
                           $Lista_especialidad = $Consultar_especialidades->fetchAll(PDO::FETCH_ASSOC);
                            ?>

                           <div class="form-group col-md-6">
                             <label for="Especialidad" class="col-md-2 col-form-label">Especialidad</label>
                             <select class="form-control" name="Especialidad" required id="Especialidad">
                               <option value=""> Seleccione un puesto </option>
                               <?php foreach ($Lista_especialidad as $Especialidades): ?>
                                 <option value="<?php echo $Especialidades['ID_Especialidad'] ?>"><?php echo $Especialidades['Nombre_especialidad'] ?></option>
                               <?php endforeach; ?>
                             </select>
                           </div>
                         </div>

                          <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Domicilio" class="col-md-2 col-form-label">Domicilio</label>
                                <input type="text" name="Domicilio" class="form-control" id="Domicilio">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="Domicilio" class="col-md-2 col-form-label">Telefono</label>
                                <input type="text" name="Telefono" class="form-control" id="Domicilio">
                            </div>
                          </div>

                           <div class="modal-footer d-flex justify-content-center">
                               <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                               <button type="submit" name="Boton" value="Agregar" class="btn btn-success"> Registrar </button>
                           </div>
                       </form>
               </div>
             </div>
          </div>
       </div>


       <!-- Modal -->
       <div class="modal fade" id="Modal_especialidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <!-- modal-sm = modal small | modal-lg = modal large | modal-xl = modal extra large  -->
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Agregar especialidades para el doctor</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                       <form method="post" style="padding: 10px;">

                         <label for="Domicilio" class="col-md-2 col-form-label">Especialidad</label>
                         <input type="text" class="form-control" required name="Especialidades"
                          placeholder="Ejemplo: Nutriologo">

                   </div>
                   <div class="modal-footer d-flex justify-content-center">
                       <button type="submit" name="Boton" value="Agregar_especialidades" class="btn btn-success">Guardar</button>
                       <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                   </div>
                 </form>

               </div>
           </div>
       </div>

       <!-- Modal -->
       <div class="modal fade" id="Modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <!-- modal-sm = modal small | modal-lg = modal large | modal-xl = modal extra large  -->
           <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Editar empleado</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>

                   <div class="modal-body">
                       <form method="post" style="padding: 10px;">
                         <h4 class="text-center">EDITAR DATOS DEL EMPLEADO</h4>


                         <div class="form-row">
                           <input type="hidden" name="id_empleado" class="form-control" id="id_empleado">
                           <div class="form-group col-md-6">
                               <label for="nombre" class="col-md-2 col-form-label">Nombre</label>
                               <input type="text" name="Nombre" class="form-control" id="Nombre">
                           </div>

                           <div class="form-group col-md-6">
                               <label for="Apellido" class="col-md-2 col-form-label">Apellido</label>
                               <input type="text" name="Apellido" class="form-control" id="Apellido_empleado">
                           </div>


                         </div>

                         <div class="form-row">
                           <div class="form-group col-md-6">
                               <label for="Puesto" class="col-md-2 col-form-label">Puesto</label>
                               <select class="form-control" name="Puesto" required id="Puesto_empleado">
                                 <option value=""> Seleccione un puesto </option>
                                 <option value="Administrador"> Administrador </option>
                                 <option value="Doctor"> Doctor </option>
                               </select>
                           </div>

                           <?php
                           $Consultar_especialidades = $pdo->prepare("SELECT * FROM especialidad");
                           $Consultar_especialidades->execute();
                           $Lista_especialidad = $Consultar_especialidades->fetchAll(PDO::FETCH_ASSOC);
                            ?>

                           <div class="form-group col-md-6">
                             <label for="Espe" class="col-md-2 col-form-label">Especialidad</label>
                             <select class="form-control" name="Especialidad" required id="ID_Espe">
                               <option value=""> Seleccione un puesto </option>
                               <?php foreach ($Lista_especialidad as $Especialidades): ?>
                                 <option value="<?php echo $Especialidades['ID_Especialidad'] ?>"><?php echo $Especialidades['Nombre_especialidad'] ?></option>
                               <?php endforeach; ?>
                             </select>
                           </div>
                         </div>

                          <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Domicilio_empleado" class="col-md-2 col-form-label">Domicilio</label>
                                <input type="text" name="Domicilio" class="form-control" id="Domicilio_empleado">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="Domicilio" class="col-md-2 col-form-label">Telefono</label>
                                <input type="text" name="Telefono" class="form-control" id="Telefono">
                            </div>
                          </div>

                           <div class="modal-footer d-flex justify-content-center">
                               <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                               <button type="submit" name="Boton" value="Editar" class="btn btn-success"> Editar </button>
                           </div>
                       </form>
               </div>
             </div>
          </div>
       </div>


       <!-- Modal -->
       <div class="modal fade" id="Modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <!-- modal-sm = modal small | modal-lg = modal large | modal-xl = modal extra large  -->
           <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Eliminar empleado</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>

                   <div class="modal-body">
                       <form method="post" style="padding: 10px;">
                         <h4 class="text-center">¿DESEA ELIMINAR ESTE EMPLEADO?</h4>

                           <input type="hidden" name="id_empleado" class="form-control" id="id_empleados">

                           <div class="modal-footer d-flex justify-content-center">
                               <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar </button>
                               <button type="submit" name="Boton" value="Borrar" class="btn btn-danger"> Eliminar </button>
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

$(".BTN_MODAL3").on("click", function(e) {
  $('#Modal_editar').modal();

  $tr = $(this).closest('tr');

  var data = $tr.children("td").map(function(){
    return $(this).text();
  }).get();

  console.log(data);

  $('#id_empleado').val(data[0]);
  $('#Nombre').val(data[1]);
  $('#Apellido_empleado').val(data[2]);
  $('#Puesto_empleado').val(data[3]);
  $('#ID_Espe').val(data[4]);
  $('#Espe').val(data[5]);
  $('#Domicilio_empleado').val(data[6]);
  $('#Telefono').val(data[7]);
});

$(".BTN_MODAL4").on("click", function(e) {
  $('#Modal_eliminar').modal();

  $tr = $(this).closest('tr');

  var data = $tr.children("td").map(function(){
    return $(this).text();
  }).get();

  console.log(data);

  $('#id_empleados').val(data[0]);
  $('#Nombres').val(data[1]);
  $('#Apellido_empleado').val(data[2]);
  $('#Puesto_empleado').val(data[3]);
});
</script>
