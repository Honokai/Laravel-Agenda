<?php 
  require_once("../../config/BancoDados.php");
  $banco = new BancoDados;
  date_default_timezone_set('America/Fortaleza');
  $conexao = $banco->conexao();
  $char = $conexao->prepare("set names utf8");
  $char->execute();
  $usuario = $_GET['login'];
  $query = "select id,nome title,data_ag start, observacao description, tipo_atividade atividade from agenda a where usuario_id=" . $usuario;
  $result = $conexao->prepare($query);
  
  $result->execute(); $dados = []; $evento = array();
  
  while($linha = $result->fetch(PDO::FETCH_ASSOC)){
      array_push($evento, $linha);
  }

  header('Content-Type: application/json');
  echo json_encode($evento, true), "\n";
?>