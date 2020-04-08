<?php 
require_once("../../config/BancoDados.php");
$banco = new BancoDados;
date_default_timezone_set('America/Fortaleza');
$conexao = $banco->conexao();
$char = $conexao->prepare("set names utf8");
$char->execute();
$data = "".$_POST['datainicio'] ." " .$_POST['horarioinicio'];
$dataend = "".$_POST['datatermino'] ." " .$_POST['horariotermino'];


$query = "update agenda set data_ag='".$data.
    "', data_fim='".$dataend.
    "', nome='".$_POST['nome'] . 
    "', Descricao='".$_POST['descricao']."' where id=".$_POST['id'] . " and usuario_id=".$_POST['login'].
    " and nome='".$_POST['nome1']."'"." and data_ag='".$_POST['datainicio1']. " " . $_POST['horarioinicio1']."'"." and data_fim='".$_POST['datatermino1']. " " . $_POST['horariotermino1']."'";


$result = $conexao->prepare($query);
if($result->execute()){
  http_response_code(200);
  header('Content-Type: application/json;charset=utf-8');
  echo json_encode($query);
}else{
  http_response_code(404);
  header('Content-Type: application/json;charset=utf-8');
  echo json_encode($query);
}
?>