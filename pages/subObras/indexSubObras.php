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
              <h1>LISTADO DE SUB-OBRAS</h1>
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
                  <a href="JavaScript:void(0)" class="btn btn-purple btn-block mb-4" data-toggle="modal" data-target="#modalNuevoProducto" >
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
                        <table id="listSubObras" class="table-light table-bordered table-striped table-hover"  width="98%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>CODIGO</th>
                              <th>SUB-OBRA</th>
                              <th>COSTO</th>
                              <th>UNIDAD DE MEDIDA</th>
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
  <div id="modalNuevoProducto" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header header-modal-sany" style="background-color: #6F42C1">
          <div class="container-fluid">
            <h4 class="modal-title " style="text-align: center; color: black">REGISTRAR UN NUEVA SUB-OBRA</h4>
          </div>
        </div>

        <div class="modal-body modal-xl">
          <div class="content">
            <form method="POST" name="registrarSubObra" id="registrarSubObra"  onsubmit="return enviarRegistroSubObra(event);" action="procesarSubObra.php?accion=crear">
              <div class="row">
                <div class="form-group col-md-12 border-top">
                  <h4 class="modal-title " style="text-align: center; color: black">ENCABEZADO</h4>
                </div>
                <div class="form-group col-md-4">
                  <label for="recipient-name" class="form-control-label">Codigo <i style="color: darkorange">*</i></label>
                  <input  type="text" class="form-control" name="codigo" id="codigo" required minlength="1" maxlength="30" autocomplete="off"/>
                </div>
                <div class="form-group col-md-8">
                  <label for="recipient-name" class="form-control-label">Nombre <i style="color: darkorange">*</i></label>
                  <input  type="text" class="form-control" name="nombre" id="nombre" required minlength="1" maxlength="30" autocomplete="off"/>
                </div>
                <div class="form-group col-md-12">
                  <label for="recipient-name" class="form-control-label">Descripcion</label>
                  <input  type="text" class="form-control" name="descripcion" id="descripcion" minlength="1" maxlength="30" autocomplete="off"/>
                </div>
                <div class="form-group col-md-6">
                  <label for="recipient-name" class="form-control-label">Costo <i style="color: darkorange">*</i></label>
                  <input  type="number" class="form-control" name="costo" id="costo" required minlength="1" maxlength="20" autocomplete="off"/>
                </div>
                <div class="form-group col-md-6">
                  <label for="recipient-name" class="form-control-label">Unidad de medida <i style="color: darkorange">*</i></label>
                  <select class="form-control" name="unidadMedida" id="unidadMedida" required>
                    <option value="">Selecciona una opción</option>
                    <?php 
                    $sqlUnidadMedida = "SELECT id_unidad_medida,nombre FROM tbl_unidad_medida;";
                    $queryUnidadMedida = $db->query($sqlUnidadMedida);
                    $fetchUnidadMedida = $queryUnidadMedida->fetchAll(PDO::FETCH_OBJ);
                    foreach ($fetchUnidadMedida as $fetch) {
                      echo '<option value="'.$fetch->id_unidad_medida.'">'.$fetch->nombre.'</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group col-md-12 border-top">
                  <h4 class="modal-title " style="text-align: center; color: black">DETALLE</h4>                
                </div>
                <div class="form-group col-md-12">
                  <div class="col-sm-1 col-sm-offset-10 ml-auto float-right" style="margin-right: 15px">
                    <a class="btn btn-success btn-block" onclick="agregarDetalle()"><i class="fas fa-plus"></i></a>
                  </div>
                </div>
                <div class="form-group col-md-12">
                  <div class="row" id="detalle">
                    <div class="form-group col-md-6" id="divProducto1">
                      <label for="recipient-name" class="form-control-label">Tarea <i style="color: darkorange">*</i></label>
                      <select class="form-control" name="tarea[]" id="tarea1" required="true">
                        <option value="">Selecciona una opción</option>
                        <?php 
                        $sqlProducto = "SELECT id_producto,codigo,nombre FROM tbl_producto;";
                        $queryProducto = $db->query($sqlProducto);
                        $fetchProducto = $queryProducto->fetchAll(PDO::FETCH_OBJ);
                        foreach ($fetchProducto as $fetch) {
                          echo '<option value="'.$fetch->id_producto.'">'.$fetch->codigo.' - '.$fetch->nombre.'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group col-md-5" id="divCantidad1">
                      <label for="recipient-name" class="form-control-label">Cantidad <i style="color: darkorange">*</i></label>
                      <input  type="number" class="form-control" name="cantidad[]" id="cantidad1" required="true"  maxlength="20" step="0.0001" autocomplete="off"/>
                    </div>
                    <div class="form-group col-md-1" id="divEliminar1">
                      <label for="recipient-name" class="form-control-label" id="lblCantidad">Eliminar</label>
                      <a class="btn btn-danger" id="eliminar1" onclick="eliminarDetalle(1)"><i class="fas fa-trash-alt"></i></a>
                    </div>
                  </div>
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
<script type="text/javascript" src="../../js/javascriptindexSubObra.js" defer></script>
<script type="text/javascript">
  var contadorDetalle = 1; 
  var acumulador = 1;

  var copiaSelect = document.getElementById("producto1");
  var divCantidad = document.getElementById("cantidad1");
  var btnEliminarBase = document.getElementById("eliminar1");

  var copiadivSelectProducto = copiaSelect.cloneNode(true);
  var copiadivInputCantidad = divCantidad.cloneNode(true);
  var copiadivButtonEliminar = btnEliminarBase.cloneNode(true);

  function agregarDetalle(){
    contadorDetalle++;
    acumulador++;
    let divPadre = document.getElementById("detalle");

    let divProducto = document.createElement("div");
    divProducto.className = "form-group col-md-6";
    divProducto.setAttribute("id", "divProducto"+contadorDetalle);

    let divCantidad = document.createElement("div");
    divCantidad.className = "form-group col-md-5";
    divCantidad.setAttribute("id", "divCantidad"+contadorDetalle);

    let divEliminar = document.createElement("div");
    divEliminar.className = "form-group col-md-1";
    divEliminar.setAttribute("id", "divEliminar"+contadorDetalle);

    
    let selectProductoCrear = copiadivSelectProducto.cloneNode(true);
    selectProductoCrear.setAttribute("id", "tarea"+contadorDetalle);
    selectProductoCrear.setAttribute("name", "tarea[]");

    
    let inputCantidadCrear = copiadivInputCantidad.cloneNode(true);
    inputCantidadCrear.setAttribute("id", "cantidad"+contadorDetalle);
    inputCantidadCrear.setAttribute("name", "cantidad[]");

    
    let btnEliminarCrear = copiadivButtonEliminar.cloneNode(true);
    btnEliminarCrear.setAttribute("id", "btncantidad"+contadorDetalle);
    btnEliminarCrear.setAttribute("name", "btncantidad");
    btnEliminarCrear.setAttribute("onclick", "eliminarDetalle("+contadorDetalle+")");

    divPadre.appendChild(divProducto);
    divProducto.appendChild(selectProductoCrear);

    divPadre.appendChild(divCantidad);
    divCantidad.appendChild(inputCantidadCrear);

    divPadre.appendChild(divEliminar);
    divEliminar.appendChild(btnEliminarCrear);


  }
  function eliminarDetalle(posicion){

    let divPadre = document.getElementById("detalle");
    let divProducto = document.getElementById('divProducto'+posicion);
    let divCantidad = document.getElementById('divCantidad'+posicion);
    let divEliminar = document.getElementById('divEliminar'+posicion);

    divPadre.removeChild(divProducto);
    divPadre.removeChild(divCantidad);
    divPadre.removeChild(divEliminar);

  }
  $.fn.dataTable.ext.errMode = 'none';
  <?php 
  function cargarDataTables($divId,$namePage){
    $string = '
    $("#'.$divId.'").DataTable({
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
        url: "'.$namePage.'.php",
        type: "post",
        error: function () {}
      }
    });
    ';
    return $string;
  }
  ?>
  <?php  echo cargarDataTables('listSubObras', 'responseSubObra'); ?>
  <?php 
  if(isset($_GET['r'])) {
    echo 'let resquest ="'.$_GET['r'].'";';
  }else{
    echo 'let resquest = "none";';
  }
  ?>
  if(resquest == "success"){
    swal("Excelente!", "Sub-Obra almacenado correctamente!", "success");
  }else if(resquest == "editado"){
    swal("Excelente!", "Sub-Obra editado correctamente!", "success");
  }else if(resquest == "eliminado"){
    swal("Excelente!", "Sub-Obra eliminado correctamente!", "success");
  }else if(resquest == "existe"){
    swal({
      title: "La tarea ya existe",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
  }else if (resquest == "noeliminado") {
    swal("Error!", "Lo siento no puede eliminar este registro,\n esta siendo usado en algun otro lugar!", "error");
  }

  function fnEditarSubObra(idUsuario) {
    $.ajax({
      url: "formEditarSubObra.php",
      type: "POST",
      dataType: "html",
      data: {idu: idUsuario},
      success: function (data) {
        $("#divModificarDatos").html(data);
      }
    });
  }
  var request;
  function fnEliminarSubObra(idUsuario){
    swal({
      title: "Estas seguro que deseas eliminar esta Sub-Obra?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Procesando informacion!", {
          timer: 3000,
        });
        window.location="procesarSubObra.php?accion=eliminar&codigo="+idUsuario;
      } 
    });
  }

</script>
</body>
</html>


