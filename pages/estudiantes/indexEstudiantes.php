<!DOCTYPE html>
<html>
<?php require '../../session.php'; ?>
<?php require '../../head.php'; ?>
<?php require '../../estilosPropios.php' ?>

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
              <h1>LISTADO DE ESTUDIANTES</h1>
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

                  <div class="col-sm-2 col-sm-offset-10 ml-auto float-right" style="margin-right: 15px">
                    <a href="JavaScript:void(0)" class="btn btn-purple btn-block mb-4" data-toggle="modal" data-target="#modalNuevoEstudiante">
                      <i class="fa fa-fw fa-plus" style="margin-right:15px;"></i><b>Nuevo</b>
                    </a>
                  </div>
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
                          <table id="listEstudiante" class="table-light table-bordered table-striped table-hover" width="98%" cellspacing="0">
                            <thead>
                              <tr>
                                <!--<th>SALARIO</th> -->
                                <th>TIPO DE USUARIOS</th>
                                <th>AREA DE TRABAJO</th>
                                <th>ACCIONES</th>
                              </tr>
                            </thead>
                          </table>
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
    <!-- Modal Registrar Nuevo Usuario -->
    <div id="modalNuevoEstudiante" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header header-modal-sany" style="background-color: #6F42C1">
            <div class="container-fluid">
              <h4 class="modal-title " style="text-align: center; color: black">REGISTRAR UN NUEVO EMPLEADO</h4>
            </div>
          </div>

          <div class="modal-body modal-xl">
            <div class="content">
              <form method="POST" name="registrarProducto" id="registrarProducto" action="procesarEstudiantes.php?accion=crear">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="recipient-name" class="form-control-label">Salario <i style="color: darkorange">*</i></label>
                    <input type="number" class="form-control" name="salario" id="salario" required minlength="1" maxlength="30" autocomplete="off" />
                  </div>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="recipient-name" class="form-control-label">Tipo de estudiante <i style="color: darkorange">*</i></label>
                    <select class="form-control" name="tipoEstudiante" id="tipoEstudiante" required>
                      <option value="">Selecciona una opción</option>
                      <?php
                      $sqlTipoEstudiante = "SELECT id_tipo_estudiante, nombre FROM tbl_tipo_estudiante;";
                      $queryTipoEstudiante = $db->query($sqlTipoEstudiante);
                      $fetchTipoEstudiante = $queryTipoEstudiante->fetchAll(PDO::FETCH_OBJ);
                      foreach ($fetchTipoEstudiante as $fetch) {
                        echo '<option value="' . $fetch->id_tipo_estudiante . '">' . $fetch->nombre . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="recipient-name" class="form-control-label">Area trabajo <i style="color: darkorange">*</i></label>
                    <select class="form-control" name="areaTrabajo" id="areaTrabajo" required>
                      <option value="0">Selecciona una opción</option>
                      <?php
                      $sqlareaTrabajo = "SELECT id_area_trabajo, nombre FROM tbl_area_trabajo;";
                      $queryareaTrabajo = $db->query($sqlareaTrabajo);
                      $fetchareaTrabajo = $queryareaTrabajo->fetchAll(PDO::FETCH_OBJ);
                      foreach ($fetchareaTrabajo as $fetch) {
                        echo '<option value="' . $fetch->id_area_trabajo . '">' . $fetch->nombre . '</option>';
                      }
                      ?>
                    </select>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cancelar
                  </button>
                  <button type="submit" class="btn btn-purple" name="Guardar" id="registrarButton">
                    Registrar
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Actualizar Datos de Usuario -->
    <div id="modalModificarUsuario" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header header-modal-sany" style="background-color: #6F42C1">
            <div class="row">
              <div class="form-group col-md-12 text-center" style="margin-bottom: -8px;background-color: #6F42C1">
                <h4 class="modal-title">MODIFICAR DATOS DEL USUARIO</h4>
              </div>
            </div>
          </div>

          <div id="divModificarDatos" class="modal-body">

          </div>

        </div>
      </div>
    </div>


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
  <script type="text/javascript" src="../../js/javascriptIndexProducto.js" defer></script>
  <script type="text/javascript">
    $.fn.dataTable.ext.errMode = 'none';
    <?php
    function cargarDataTables($divId, $namePage)
    {
      $string = '
    $("#' . $divId . '").DataTable({
      language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 de 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": " Mostrar:_MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      },
      "processing": true,
      "serverSide": true,
      "ajax": {
        url: "' . $namePage . '.php",
        type: "post",
        error: function () {}
      }
    });
    ';
      return $string;
    }
    ?>
    <?php echo cargarDataTables('listEstudiante', 'responseEstudiantes'); ?>
    <?php
    if (isset($_GET['r'])) {
      echo 'let resquest ="' . $_GET['r'] . '";';
    } else {
      echo 'let resquest = "none";';
    }
    ?>
    if (resquest == "success") {
      swal("Excelente!", "Estudiante almacenado correctamente!", "success");
    } else if (resquest == "editado") {
      swal("Excelente!", "Estudiante editado correctamente!", "success");
    } else if (resquest == "eliminado") {
      swal("Excelente!", "Estudiante eliminado correctamente!", "success");
    }else if (resquest == "noeliminado") {
      swal("Error!", "Lo siento no puede eliminar este registro,\n esta siendo usado en algun otro lugar!", "error");
    }

    function fnEditarEstudiante(idUsuario) {
      $.ajax({
        url: "formEditarEstudiantes.php",
        type: "POST",
        dataType: "html",
        data: {
          idu: idUsuario
        },
        success: function(data) {
          $("#divModificarDatos").html(data);
        }
      });
    }

    function fnEliminarEstudiante(idUsuario) {
      swal({
          title: "Estas seguro que deseas eliminar este Estudiante?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Procesando informacion!", {
              timer: 3000,
            });
            window.location = "<?= $base_url ?>pages/estudiantes/procesarEstudiantes.php?accion=eliminar&id=" + idUsuario;
          }
        });
    }
  </script>
</body>

</html>
