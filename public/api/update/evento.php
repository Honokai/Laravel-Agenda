<?php 
  require_once("../../config/BancoDados.php");
  date_default_timezone_set('America/Fortaleza');
  $banco = new BancoDados;
  $conexao = $banco->conexao();
  $char = $conexao->prepare("set names utf8");
  $char->execute();
  $data = substr($_POST['data'],0,24);$data = strtotime($data);$data = date("Y-m-d H:m:s",$data);
  $dataend = substr($_POST['dataend'],0,24);$dataend = strtotime($dataend);$dataend = date("Y-m-d H:m:s",$dataend);
  $query = "update agenda set data_ag='".$data."', data_fim='".$dataend."' where usuario_id=".$_POST['login']." and nome='".$_POST['nome']."'";
  $result = $conexao->prepare($query);

  if($result->execute()){
    http_response_code(200);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode(array("resposta"=>"sucesso"));
  }else{
    http_response_code(404);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($query);
  }
?>