<!DOCTYPE html>
<html>
<?php require '../../session.php'; ?>
<?php require '../../head.php'; ?>
<?php require '../../estilosPropios.php' ?>

<?php 

$sqlDatosGenerales = "SELECT (SELECT COUNT(id_obra) AS totalObras FROM tbl_obra) AS totalObras,
                      (SELECT COUNT(id_sub_obra) AS totalSubObras FROM tbl_sub_obra) AS totalSubObras,
                      (SELECT COUNT(id_estudiante) AS totalEstudiante FROM tbl_estudiante) AS totalEstudiante,
                      COUNT(id_producto) AS totalProductos FROM tbl_producto;";

$queryDatosGenerales = mysqli_query($conn, $sqlDatosGenerales);
$fetchDatosGenerales = mysqli_fetch_row($queryDatosGenerales);


?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php require '../../menu.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-color: white">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= $base_url ?>index.php">Home</a></li>
                <li class="breadcrumb-item active">Inicio</li>
              </ol>
            </div><!-- /.col -->
            <div class="col-sm-12 text-center">
              <h1>DASHBOARD GENERAL</h1>
            </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header" style="margin-bottom: 63px;">
                <div class="row">

                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="box">
                      <div class="box-header">
                      </div>
                      <div class="box-body">
                        <div class="container-fluid">
                          <section class="content">
                            <div class="container-fluid">
                              <!-- Small boxes (Stat box) -->
                              <div class="row">
                                <div class="col-lg-3 col-6">
                                  <!-- small box -->
                                  <div class="small-box bg-warning">
                                    <div class="inner">
                                      <h3><?= $fetchDatosGenerales[0] ?></h3>

                                      <p>OBRAS REGISTRADOS</p>
                                    </div>
                                    <div class="icon">
                                    <i class="fas fa-hammer"></i>
                                    </div>
                                  </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                  <!-- small box -->
                                  <div class="small-box bg-warning">
                                    <div class="inner">
                                      <h3><?= $fetchDatosGenerales[3] ?></h3>

                                      <p>TAREAS REGISTRADAS</p>
                                    </div>
                                    <div class="icon">
                                      <i class="fas fa-box-open"></i>
                                    </div>
                                  </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                  <!-- small box -->
                                  <div class="small-box bg-warning">
                                    <div class="inner">
                                      <h3><?= $fetchDatosGenerales[1] ?></h3>

                                      <p>SUB-OBRAS REGISTRADAS</p>
                                    </div>
                                    <div class="icon">
                                      <i class="fas fa-toolbox"></i>
                                    </div>
                                  </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                  <!-- small box -->
                                  <div class="small-box bg-warning">
                                    <div class="inner">
                                      <h3><?= $fetchDatosGenerales[2] ?></h3>

                                      <p>ESTUDIANTES REGISTRADOS</p>
                                    </div>
                                    <div class="icon">
                                    <i class="fas fa-users"></i>
                                    </div>
                                  </div>
                                </div>
                                <!-- ./col -->
                              </div>
                              <!-- /.row -->
                              <!-- Main row -->
                              <div class="row">
                                <!-- Left col -->
                                <section class="col-lg-7 connectedSortable">
                                  <!-- Custom tabs (Charts with tabs)-->
                                  <div class="card">
                                    <div class="card-header">
                                      <h3 class="card-title">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        Reporte numero 1
                                      </h3>
                                      <div class="card-tools">
                                        <button type="button" class="btn bg-warning btn-sm" data-card-widget="collapse">
                                          <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn bg-warning btn-sm" data-card-widget="remove">
                                          <i class="fas fa-times"></i>
                                        </button>
                                      </div>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                      <div class="tab-content p-0">
                                        <!-- Morris chart - Sales -->
                                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                                          <iframe width="100%" height="100%" src="https://datastudio.google.com/embed/reporting/2198c03d-9931-498a-b94e-7b570a7e4bb7/page/urhlC" frameborder="0" style="border:0" allowfullscreen></iframe>
                                          <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                        </div>
                                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                          <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                                        </div>
                                      </div>
                                    </div><!-- /.card-body -->
                                  </div>
                                  <!-- /.card -->
                                  <!-- TO DO List -->
                                  <!-- /.card -->
                                </section>
                                <!-- /.Left col -->
                                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                                <section class="col-lg-5 connectedSortable">

                                  <!-- Map card -->
                                  <div class="card">
                                    <div class="card-header">
                                      <h3 class="card-title">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        Reporte numero 2
                                      </h3>
                                      <div class="card-tools">
                                        <button type="button" class="btn bg-warning btn-sm" data-card-widget="collapse">
                                          <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn bg-warning btn-sm" data-card-widget="remove">
                                          <i class="fas fa-times"></i>
                                        </button>
                                      </div>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                      <div class="tab-content p-0">
                                        <!-- Morris chart - Sales -->
                                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                                          <iframe width="100%" height="100%" src="https://datastudio.google.com/embed/reporting/efe80ab7-01c0-44c4-b0c4-5037f36ed8ff/page/avhlC" frameborder="0" style="border:0" allowfullscreen></iframe>
                                          <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                        </div>
                                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                          <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                                        </div>
                                      </div>
                                    </div><!-- /.card-body -->
                                  </div>
                                  <!-- /.card -->
                                </section>
                                <section class="col-lg-12 connectedSortable">

                                  <!-- Map card -->
                                  <div class="card">
                                    <div class="card-header">
                                      <h3 class="card-title">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        Reporte numero 3
                                      </h3>
                                      <div class="card-tools">
                                        <button type="button" class="btn bg-warning btn-sm" data-card-widget="collapse">
                                          <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn bg-warning btn-sm" data-card-widget="remove">
                                          <i class="fas fa-times"></i>
                                        </button>
                                      </div>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                      <div class="tab-content p-0">
                                        <!-- Morris chart - Sales -->
                                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                                          <iframe width="100%" height="100%" src="https://datastudio.google.com/embed/reporting/0e4ee22f-6d68-4a01-9dee-7e3856037b79/page/0xhlC" frameborder="0" style="border:0" allowfullscreen></iframe>
                                          <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                        </div>
                                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                          <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                                        </div>
                                      </div>
                                    </div><!-- /.card-body -->
                                  </div>
                                  <!-- /.card -->
                                </section>
                                <!-- right col -->
                              </div>
                              <!-- /.row (main row) -->
                            </div><!-- /.container-fluid -->
                          </section>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <?php require_once('../../footer.php') ?>
  <!-- Scripts -->
  <?php require_once('../../scripts.php') ?>

</body>

</html>
