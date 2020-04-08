<?php 
require_once("./../../config/connection.php");

$id = $_GET['id'];

$query = mysqli_query($conexao,"Select * from agenda where usuario_id=".$id);

$teste = array();
$teste['dados'] = array();

while( $row = mysqli_fetch_assoc($query)){
    
    $teste1 = array(
        'Nome' => $row['Nome'],
        'Descricao' => $row['Descricao'],
        'Data' => $row['data_ag'],
        'Hora' => $row['horario']
    );
    array_push($teste['dados'], $teste1);
};
header('Content-Type: application/json');

echo json_encode($teste);

?>