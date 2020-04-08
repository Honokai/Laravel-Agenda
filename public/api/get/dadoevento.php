<?php 

require_once("../../config/connection.php");
date_default_timezone_set('America/Fortaleza');
$bd = new BD();
$conexao = $bd->conexao();
$data = substr($_GET['data'],0,24);
$data = strtotime($data);
$data = date("Y-m-d H:i:s", $data);
$nome=$_GET['nome']; $login = $_GET['login'];
$query = "select a.id,a.nome,a.data_ag,a.data_fim,a.Descricao,f.descricao feedback from agenda a left join feedback f on a.id=f.agenda_id where `usuario_id`=".$login." and nome='".$nome."' and `data_ag`='". $data."'";
$result = mysqli_query($conexao,$query); 
if($result = mysqli_query($conexao,$query)){
    echo json_encode(mysqli_fetch_assoc($result), true);
}else{
    echo json_encode($query, true);
}
?>

