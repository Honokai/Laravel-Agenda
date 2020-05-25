<?php 

require_once("../../config/BancoDados.php");
date_default_timezone_set('America/Fortaleza');
$bd = new BancoDados;
$conexao = $bd->conexao();
$char = $conexao->prepare("set names utf8");
$char->execute();
$data = substr($_GET['data'],0,24);
$data = strtotime($data);
$data = date("Y-m-d H:i:s", $data);
$nome= $_GET['nome']; $login = $_GET['login'];
//$query = "select a.id,a.nome,a.data_ag,a.data_fim,a.Descricao,a.categoria,f.descricao feedback from agenda a left join feedback f on a.id=f.agenda_id where `usuario_id`=".$login." and nome='".$nome."' and `data_ag`='". $data."'";
$query = "select * from agenda where `usuario_id`=".$login." and nome='".$nome."' and `data`='". $data."'";
$result = $conexao->prepare($query);

if($result->execute()){
    echo json_encode($result->fetchAll(PDO::FETCH_OBJ));
}else{
    echo json_encode($query);
}
?>

