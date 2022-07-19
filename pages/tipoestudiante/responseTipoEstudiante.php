<?php

//include connection file 
require "../../session.php";

//$id_matricula_dato = $_POST['id'];
//$params = $columns = $totalRecords = $data = array();

$params = filter_input_array(INPUT_POST);

//var_dump($params);

//define index of column
$columns = array(
	0 => 'nombre',
  1 => 'descripcion'
);

$sqlTot = $sqlRec = "";

// check search value exist
$where = "";

if (isset($params['search']['value']) && $params['search']['value'] != '') {
    $where .= "
            WHERE 
                (emp.descripcion LIKE '%" . $params['search']['value'] . "%'
                OR emp.nombre  LIKE '%" . $params['search']['value'] . "%')";
}


// getting total number records without any search
$sql = "SELECT 
        emp.id_tipo_estudiante , 
        UPPER(emp.nombre) nombre,
        emp.descripcion descripcion
        FROM tbl_tipo_estudiante emp" ;


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
        $dataTwo[$key][2] = '
        &nbsp;
        <a href="#" style="color:#000;" data-toggle="modal" data-target="#modalModificarTipoEstudiante" onClick="fnEditarTipoEstudiante(\'' . $val[0] . '\');">
        <span data-toggle="tooltip" title="Editar usuario" class="fas fa-pencil-alt"></span>
        </a>
        ';
        $dataTwo[$key][2] .= '
        &nbsp;
        <a href="#" style="color:#000;" data-toggle="modal" data-target="#modalEliminarTipoEstudiante" onClick="fnEliminarTipoEstudiante(\'' . $val[0] . '\');">
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
