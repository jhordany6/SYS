<?php

//include connection file 
require "../../session.php";

try {
  //code...

//$id_matricula_dato = $_POST['id'];
//$params = $columns = $totalRecords = $data = array();

$params = filter_input_array(INPUT_POST);

//var_dump($params);

//define index of column
$columns = array(
  0 => "nombreCompleto",
  1 => 'documento',
  2 => 'email',
  3 => 'tipoCliente',
  4 => 'empresa'
);

$sqlTot = $sqlRec = "";

// check search value exist
$where = "";

if (isset($params['search']['value']) && $params['search']['value'] != '') {
    $where .= "
            AND 
              (UPPER(CONCAT(cli.primer_nombre,' ',cli.segundo_nombre,' ',cli.primer_apellido,' ',cli.segundo_apellido))  LIKE '%" . $params['search']['value'] . "%' 
              OR cli.documento LIKE '%" . $params['search']['value'] . "%'
              OR cli.email  LIKE '%" . $params['search']['value'] . "%'
              OR tpcli.nombre  LIKE '%" . $params['search']['value'] . "%'
              OR cli.nombre_empresa  LIKE '%" . $params['search']['value'] . "%')";
}


// getting total number records without any search
$sql = "SELECT 
          cli.id_cliente,
          UPPER(CONCAT(cli.primer_nombre,' ',cli.segundo_nombre,' ',cli.primer_apellido,' ',cli.segundo_apellido)) AS nombreCompleto, 
          UPPER(cli.documento) documento,
          UPPER(cli.email) email,
          UPPER(tpcli.nombre) tipoCliente,
          UPPER(cli.nombre_empresa) empresa
          FROM tbl_cliente cli
          INNER JOIN tbl_tipo_cliente tpcli WHERE cli.fk_id_tipo_cliente = tpcli.id_tipo_cliente";


$sqlTot .= $sql;
$sqlRec .= $sql;



//concatenate search sql if value exist
if (isset($where) && $where != '') {
    $sqlTot .= $where;
    $sqlRec .= $where;
}

$sqlRec .= " ORDER BY " . $columns[$params['order'][0]['column']] . "  " . $params['order'][0]['dir'] . "  LIMIT " . $params['start'] . " ," . $params['length'] . " ";

$queryTot = mysqli_query($conn, $sqlTot) or die("database error:" . mysqli_error($conn));

$totalRecords = mysqli_num_rows($queryTot);

$queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch employees data");

$data = array();
//iterate on results row and create new index array of data
while ($row = mysqli_fetch_row($queryRecords)) {
    $data[] = $row;
}
$dataTwo = array();
foreach ($data as $key => $val) {
        $dataTwo[$key][0] = $val[1];
        $dataTwo[$key][1] = $val[2];
        $dataTwo[$key][2] = $val[3];
        $dataTwo[$key][3] = $val[4];
        $dataTwo[$key][4] = $val[5];
        $dataTwo[$key][5] = '
        &nbsp;
        <a href="#" style="color:#000;" data-toggle="modal" data-target="#modalModificarUsuario" onClick="fnEditarCliente(\'' . $val[0] . '\');">
        <span data-toggle="tooltip" title="Editar usuario" class="fas fa-pencil-alt"></span>
        </a>
        ';
        $dataTwo[$key][5] .= '
        &nbsp;
        <a href="#" style="color:#000;" data-toggle="modal" data-target="#modalEliminarUsuario" onClick="fnEliminarCliente(\'' . $val[0] . '\');">
        <span data-toggle="tooltip" title="Eliminar usuario" class="fa fa-times"></span>
        </a>';

}

$json_data = array(
    "draw" => intval($params['draw']),
    "recordsTotal" => intval($totalRecords),
    "recordsFiltered" => intval($totalRecords),
    "data" => $dataTwo   // total data array
);

echo json_encode($json_data);  // send data as json format
} catch (Exception $e) {
  echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}

