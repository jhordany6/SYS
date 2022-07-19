<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Construcciones Colombia</title>
  <link rel="icon" href="images/casco.png" type="image/png" />
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
<body class="hold-transition login-page" style="background-color: #D68910 !important">
  <div class="login-box" style="height: 60%!important">
    <div class="login-logo">
      <img src="images/Captura.png" class="img-responsive" alt="User Image" style="width: 250px;">
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg"><b>Recuperar Contraseña</b></p>
        <!--Section: Block Content-->
        <section class="mb-5 text-center">
          <p>Ingrese los datos para recuperar su contraseña</p>
          <form action="verificarCorreo.php" autocomplete="off">
            <div class="md-form md-outline mb-2">
              <input type="email" id="email" name="email" class="form-control" required="true" placeholder="Correo electronico">
            </div>
            <div class="md-form md-outline mb-2">
              <input type="number" id="phone" name="phone" class="form-control" required="true" placeholder="Telefono celular">
            </div>
            <div class="md-form md-outline mb-2">
              <input type="number" id="document" name="document" class="form-control" required="true" placeholder="Numero de documento">
            </div>
            <button type="submit" class="btn btn-purple mb-4">Recuperar</button>
          </form>
          <div class="d-flex justify-content-between align-items-center mb-2">
            <u><a href="index.php">Iniciar sesion</a></u>
          </div>
        </section>
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
    ?>
    if(error == 1){
      swal({
        icon: 'error',
        title: 'Oops...',
        text: 'Datos Incocorrectos!'
      });
    }
    
  </script>
</body>
</html>
