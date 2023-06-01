<?php
include 'Cod_iniciar_sesion.php';
 ?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="css/Login.css" type="text/css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <title>Hello, world!</title>
    </head>
    <body>

        <?php
       $pdo=new PDO("mysql:dbname=citas;host=127.0.0.1", "root", "");

        $Contar = $pdo->prepare("SELECT * FROM empleados");
            $Contar->execute();
            $Contar_noti = $Contar->fetchAll(PDO::FETCH_ASSOC);
            // $Total_Notificacion = 0;
            $Total = $Contar->rowCount();
                // echo' <span class="badge badge-light" style="font-size:12px;"> '.$Total.' </span>';
                // echo "$Total";
                if ($Total == 0) {
               echo '<script> document.getElementById("#enlace").style.display = "none"; </script>';
               }
         ?>

 <!-- <input type="text" name="contar" id="contar" value="<?php echo $Total;?>"> -->
 <div class="formulario">
   <form class="" action="" method="post">

     <h2>INICIAR SESIÓN</h2>

     <div class="Centrar_imagen" style="justify-content: center; align-items: center; display: flex;">
       <img src="images/logo.png" alt="" width="160px" height="145px" style="filter: brightness(1,1); mix-blend-mode: multiply;">
     </div>

     <?php if ($Mensaje_error !=""): ?>
       <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
      <strong><i class="fa-solid fa-ban"></i> <?php echo $Mensaje_error; ?></strong>
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
   </button>
 </div>
     <?php endif; ?>

    <div class="conte" style="margin-top:1rem;">
      <input type="text" class="form-control caja" id="c1" name="correo" required placeholder="Ingrese su correo" value=""> <br>
    </div>

    <div class="">
      <input type="password" class="form-control caja" name="contrasena" required placeholder="Ingrese su clave" value="">
    </div>

    <div class="d-flex justify-content-end" id="enlace" style="margin-top: 1rem;">
      <?php if ($Total == 0): ?>
        <a href="#" id="enlace" data-toggle="modal" data-target="#Registrar_Primera_Vez"> Crear cuenta por unica vez</a>

      <?php else: ?>
        <a href="#" id="enlace" style="display:none;" > Crear cuenta por unica vez </a>
      <?php endif; ?>
    </div>

    <div class="boton">
      <button type="submit" id="boton_1" name="Entrar"> Iniciar sesión </button>
      <!-- <button type="submit" name="Entrar"
      class="btn btn-primary"><i class="fa-solid fa-door-open"></i> Iniciar sesión</button> -->
    </div>
   </form>
 </div>

 <!-- Modal para registrar por unica vez al primer usuario en la base de datos -->
 <div class="modal fade" id="Registrar_Primera_Vez" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <!-- modal-sm = modal small | modal-lg = modal large | modal-xl = modal extra large  -->
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Registarse por primera vez</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="post" style="padding: 10px;">
                   <h2>REGISTRO</h2>


                   <div class="form-row">
                     <div class="form-group col-md-6">
                         <label for="correo" class="col-md-2 col-form-label">Correo</label>
                         <input type="text" name="Correo" class="form-control" id="correo">
                     </div>

                     <div class="form-group col-md-6">
                         <label for="contraseña" class="col-md-2 col-form-label">Contraseña</label>
                         <input type="password" name="Clave" class="form-control" id="contraseña">
                         <input type="hidden" name="Administrador" value="Administrador" class="form-control" id="Administrador">
                         <input type="hidden" name="Especialidad" value="1" class="form-control" id="Administrador">

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
                           <option value="Masculino">Femenino</option>
                         </select>
                     </div>
                   </div>

                     <div class="form-group">
                         <label for="Domicilio" class="col-md-2 col-form-label">Domicilio</label>
                         <input type="text" name="Domicilio" required class="form-control" id="Domicilio">
                     </div

                     <div class="form-group">
                         <label for="Domicilio" class="col-md-2 col-form-label">Telefono</label>
                         <input type="text" name="Telefono" class="form-control" id="Domicilio">
                     </div>

                     <div class="modal-footer d-flex justify-content-center">
                         <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                         <button type="submit" name="Registrarse" class="btn btn-success"> Registrarse </button>
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
