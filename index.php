<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>System C.A</title>
  <link rel="icon" href="images/lapiz.png" type="image/png" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- DataTables -->
  <link type="text/css" rel="stylesheet" href="plugins/datatables/jquery.dataTables.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Sany Css -->
  <link rel="stylesheet" type="text/css" href="css/construccionesColombia.css">
  <!-- Select 2 CDN-->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <!-- SWEETALERT2-->
  <link rel="stylesheet" type="text/css" href="plugins/sweetalert2/sweetalert2.css">
</head>
<body class="hold-transition login-page" style="background-color: #615cb4 !important">
    <div class="login-box" style="height: 52%!important">
    <div class="login-Captura">
    <!--<img src="images/Captura.PNG" alt="logo" class="img-responsive" width="250PX"> -->
    <img src="<?php echo $base_url ?> images/Captura.PNG" class="img-responsive" alt="Logo" width ="250px;">
    </div> 
   
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg"><b>Iniciar sesion</b></p>
        <form action="validar_login.php" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Usuario" name="usuario" autocomplete="off">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Contraseña" name="contrasena" autocomplete="off">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-purple btn-block">Ingresar</button>
            </div>
            <!-- /.col -->
            <div class="d-flex justify-content-between align-items-center mb-2">
              <u><a href="recuperarContraseña.php">¿Olvidaste tu contraseña?</a></u>
            </div>
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

  <script src="dist/js/demo.js"></script>
  <!-- DataTables -->
  <script type="text/javascript" src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="plugins/datatables/dataTables.bootstrap.min.js"></script>
  <!-- Select 2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <!-- SWEETALERT2-->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script type="text/javascript" defer>
    <?php 
    if(isset($_GET['error'])){
      echo 'var error = '.$_GET['error'].';';
    }else{
      echo 'var error = 2;';
    }
    if(isset($_GET['success'])){
      echo 'var success = '.$_GET['success'].';';
    }else{
      echo 'var success = 3;';
    }
    ?>
    if(error == 1){
      swal({
        icon: 'error',
        title: 'Oops...',
        text: 'Datos Incocorrectos!'
      });
    }
    if(error == 3){
      swal({
        icon: 'error',
        title: 'Oops...',
        text: 'No te encuentras en nuestro sistemas!'
      });
    }
    if(success == 1){
      swal("Buen Trabajo!", "Tu contraseña es: <?php if(isset($_REQUEST['passwd'])){echo $_REQUEST['passwd'];} ?>!", "success");
    }
    
  </script>
</body>
</html>
