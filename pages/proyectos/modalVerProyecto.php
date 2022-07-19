<?php

//include connection file 
require "../../session.php";

$sqlUsuario = "
SELECT 
UPPER(ob.nombre) nombreObra, ob.fecha_inicio, ob.fecha_fin, cantidad_pisos,
CONCAT(CONCAT('$', FORMAT(ob.presupuesto_obra, 2, 'de_DE')),' COP') presupuesto,
UPPER(CONCAT(c.primer_nombre,' ',c.segundo_nombre,' ',c.primer_apellido,' ',c.segundo_apellido)) AS nombreCliente,
UPPER(po.nombre),
UPPER(ctra.nombre),
ob.fk_id_ref_documentos
FROM tbl_obra ob
INNER JOIN tbl_estado_obra eb ON eb.id_estado_obra = ob.fk_id_estado_obra
INNER JOIN tbl_cliente c ON c.id_cliente = ob.fk_id_cliente
INNER JOIN tbl_tipo_obra po ON po.id_tipo_obra = ob.fk_id_tipo_obra
INNER JOIN tbl_contratista ctra ON ctra.id_contratista = ob.fk_id_contratista
WHERE ob.id_obra = " . $_REQUEST["idu"];

$queryUsuario = mysqli_query($conn, $sqlUsuario);
$fetchUsuario = mysqli_fetch_row($queryUsuario);
$rows = mysqli_num_rows($queryUsuario);


if ($rows == 0) {
  echo "<p style='color:red;font-size:0.9em;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No se encontraron datos :(</p>";
} else {
?>
  <div class="content">
    <h3 class="text-center mb-4"><u><?php echo $fetchUsuario[0]; ?></u></h3>
    <div class="row">
      <div class="user-block col-sm-12 col-xs-12">
        <label style="font-size: 20px">CLIENTE: </label> <span style="font-size: 18px"><?php if (empty($fetchUsuario[5])) {
                                                                                          echo 'Sin dato';
                                                                                        } else {
                                                                                          echo $fetchUsuario[5];
                                                                                        } ?></span>
      </div>
      <div class="user-block col-sm-12 col-xs-12">
        <label style="font-size: 20px">CONTRATISTA: </label> <span style="font-size: 18px"><?php if (empty($fetchUsuario[5])) {
                                                                                              echo 'Sin dato';
                                                                                            } else {
                                                                                              echo $fetchUsuario[5];
                                                                                            } ?></span>
      </div>
      <div class="user-block col-sm-4 col-xs-6">
        <label style="font-size: 20px">FECHA-INICIO: </label> <span style="font-size: 18px"><?php if (empty($fetchUsuario[1])) {
                                                                                              echo 'Sin dato';
                                                                                            } else {
                                                                                              echo $fetchUsuario[1];
                                                                                            } ?></span>
      </div>
      <div class="user-block col-sm-4 col-xs-6">
        <label style="font-size: 20px">FECHA-FIN: </label> <span style="font-size: 18px"><?php if (empty($fetchUsuario[2])) {
                                                                                            echo 'Sin dato';
                                                                                          } else {
                                                                                            echo $fetchUsuario[2];
                                                                                          } ?></span>
      </div>
      <div class="user-block col-sm-4 col-xs-6">
        <label style="font-size: 20px">CANTIDAD-PISOS: </label> <span style="font-size: 18px"><?php if (empty($fetchUsuario[3])) {
                                                                                                echo 'Sin dato';
                                                                                              } else {
                                                                                                echo $fetchUsuario[3];
                                                                                              } ?></span>
      </div>
      <div class="user-block col-sm-6 col-xs-6">
        <label style="font-size: 20px">PRESUPUESTO: </label> <span style="font-size: 18px"><?php if (empty($fetchUsuario[4])) {
                                                                                              echo 'Sin dato';
                                                                                            } else {
                                                                                              echo $fetchUsuario[4];
                                                                                            } ?></span>
      </div>
      <div class="user-block col-sm-6 col-xs-6">
        <label style="font-size: 20px">TIPO-OBRA: </label> <span style="font-size: 18px"><?php if (empty($fetchUsuario[6])) {
                                                                                            echo 'Sin dato';
                                                                                          } else {
                                                                                            echo $fetchUsuario[6];
                                                                                          } ?></span>
      </div>
      <div class="user-block col-sm-12 col-xs-12 border-top">
        <h3 class="text-center mb-4"><u>SUB-OBRAS</u></h3>
      </div>
      <div class="col-md-12 ">
        <div class="row">
          <div class="user-block col-sm-6 col-xs-6">
            <h4 class="text-center">NOMBRE</h4>
          </div>
          <div class="user-block col-sm-6 col-xs-6">
            <h4 class="text-center">CANTIDAD</h4>
          </div>
          <?php
          $sqlDetalleObra = "SELECT UPPER(so.nombre) nombre,dso.cantidad_sub_obra cantidad FROM tbl_detalle_sub_obra dso INNER JOIN tbl_sub_obra so ON so.codigo = dso.codigo_sub_obra WHERE dso.fk_id_obra = " . $_REQUEST["idu"];
          $queryDetalleObra = $db->query($sqlDetalleObra);
          $fetchDetalleObra = $queryDetalleObra->fetchAll(PDO::FETCH_OBJ);
          foreach ($fetchDetalleObra as $fetch) {
            echo '<div class="user-block col-sm-6 col-xs-6">';
            echo '<h6 class="text-center"><i class="fas fa-chevron-circle-right"></i>' . $fetch->nombre . '</h6>';
            echo '</div>';
            echo '<div class="user-block col-sm-6 col-xs-6">';
            echo '<h6 class="text-center"><i class="fas fa-chevron-circle-right"></i>' . $fetch->cantidad . '</h6>';
            echo '</div>';
          }
          ?>
        </div>
      </div>
      <div class="user-block col-sm-12 col-xs-12 border-top">
        <h3 class="text-center mb-4"><u>EMPLEADOS</u></h3>
      </div>
      <div class="col-md-12 ">
        <div class="row">
          <div class="user-block col-sm-6 col-xs-6">
            <h4 class="text-center">NOMBRE</h4>
          </div>
          <div class="user-block col-sm-6 col-xs-6">
            <h4 class="text-center">CANTIDAD</h4>
          </div>
          <?php
          $sqlDetalleObraEstudiante = "SELECT deemp.cantidad cantidad, art.nombre areatrabajo 
                                                FROM tbl_detalle_estudiante deemp 
                                                INNER JOIN tbl_estudiante emp ON emp.id_estudiante = deemp.fk_id_estudiante 
                                                INNER JOIN tbl_area_trabajo art ON art.id_area_trabajo = emp.fk_id_area_trabajo 
                                                WHERE deemp.fk_id_obra =  " . $_REQUEST["idu"];
          $queryDetalleObraEstudiante = $db->query($sqlDetalleObraEstudiante);
          $fetchDetalleObraEstudiante = $queryDetalleObraEstudiante->fetchAll(PDO::FETCH_OBJ);
          foreach ($fetchDetalleObraEstudiante as $fetch) {
            echo '<div class="user-block col-sm-6 col-xs-6">';
            echo '<h6 class="text-center"><i class="fas fa-chevron-circle-right"></i>' . $fetch->areatrabajo . '</h6>';
            echo '</div>';
            echo '<div class="user-block col-sm-6 col-xs-6">';
            echo '<h6 class="text-center"><i class="fas fa-chevron-circle-right"></i>' . $fetch->cantidad . '</h6>';
            echo '</div>';
          }
          ?>
        </div>
      </div>
      <div class="user-block col-sm-12 col-xs-12 border-top">
        <h3 class="text-center mb-4"><u>COSTOS TOTALES DE LA OBRA</u></h3>
      </div>
      <div class="col-md-12 ">
        <div class="row">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>PRESUPUESTO DE LA OBRA</th>
                <th>VALOR TOTAL DE LA OBRA</th>
                <th>GANANCIA</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sqlCostosObra = "SELECT valor_total valortotal, presupuesto_obra presupuesto FROM tbl_obra WHERE id_obra = " . $_REQUEST["idu"];
              $queryCostosObra = $db->query($sqlCostosObra);
              $fetchCostosObra = $queryCostosObra->fetchAll(PDO::FETCH_OBJ);
              foreach ($fetchCostosObra as $fetch) {
                echo '<tr>';
                echo '<td class="text-center">' . number_format($fetch->presupuesto, 2, '.', "'") . ' COP </td>';
                echo '<td class="text-center">' . number_format($fetch->valortotal, 2, '.', "'") . ' COP</td>';
                echo '<td class="text-center">' . number_format($fetch->presupuesto - $fetch->valortotal, 2, '.', "'") . ' COP</td>';
                echo '</tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="user-block col-sm-12 col-xs-12 border-top">
        <h3 class="text-center mb-4"><u>DOCUMENTACION DE LA OBRA</u></h3>
      </div>
      <?php
      $sqlDocumentacion = "
        SELECT 
          refd.ref_planos planos,
          refd.ref_pdf documentos,
          refd.ref_img imagenes
          FROM tbl_obra ob
          INNER JOIN tbl_referencia_documentos refd ON ob.fk_id_ref_documentos = refd.id_referencia_documentos
          WHERE refd.id_referencia_documentos = " . $fetchUsuario[8];

      $queryDocumentacion = mysqli_query($conn, $sqlDocumentacion);
      $fetchDocumentacion = mysqli_fetch_row($queryDocumentacion);

      $planos = json_decode($fetchDocumentacion[0], true);
      $documentos = json_decode($fetchDocumentacion[1], true);
      $imagenes = json_decode($fetchDocumentacion[2], true);

      ?>
      <div class="col-md-12">
        <div class="row">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>PLANOS</th>
                <th>DOCUMENTOS</th>
                <th>IMAGENES</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><button download="<?= $planos['name']; ?>" type="button" class="btn btn-purple" onClick="openPlanosBase64('<?= $planos['base64']; ?>')"><i class="fas fa-solid fa-file-pdf"></i></button></td>
                <td class="text-center"><button download="<?= $documentos['name']; ?>" type="button" class="btn btn-purple" onClick="openPlanosBase64('<?= $documentos['base64']; ?>')"><i class="fas fa-solid fa-file"></i></button></td>
                <td class="text-center"><button download="<?= $imagenes['name']; ?>" type="button" class="btn btn-purple" onClick="openPlanosBase64('<?= $imagenes['base64']; ?>')"><i class="fas fa-solid fa-image"></i></button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>


    </div>
    <div class="user-block">&nbsp;</div>
  </div><!-- Fin del content -->
<?php } ?>
