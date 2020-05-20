<?php 

/* 
Arquivo responsável por receber os dados do formulario quando o evento já existe
Este faz o update na agenda, e insert na tabela historico
*/
require_once("../../config/BancoDados.php");
$banco = new BancoDados;
date_default_timezone_set('America/Fortaleza');
$conexao = $banco->conexao();
$char = $conexao->prepare("set names utf8");
$char->execute();
/* Variáveis recebidas através de requisição ajax*/
$id = $_POST['id'];
$login = $_POST['login'];
$atividade = $_POST['atividade'];
$status = $_POST['status'];
$nome = $_POST['nome'];
$celular = $_POST['celular'];
$endereco = $_POST['endereco'];
$cidade = $_POST['cidade'];
$data = $_POST['data'] . " " . $_POST['hora']; /* concatenação de data com horario para criacão de uma timestamp */ 
$recomendante = $_POST['recomendante'];
$recomendacoes = $_POST['recomendacoes'];
$qrec = $_POST['qrec'];
$atuacao = $_POST['atuacao'];
$potencial = $_POST['potencial'];
$observacoes = $_POST['observacoes'];
/* Termino de bloco de atribuicao de variaves*/ 

//update na tabela agenda
$query = "UPDATE `site`.`agenda`
SET
`usuario_id` = {$login},
`tipo_atividade` = '{$atividade}',
`status_atividade` = '{$status}',
`nome` = '{$nome}',
`celular` = '{$celular}',
`endereco` = '{$endereco}',
`cidade` = '{$cidade}',
`data` = '{$data}',
`recomendante` = '{$recomendante}',
`recomendações` = '{$recomendacoes}',
`q_rec` = '{$qrec}',
`atuacao` = '{$atuacao}',
`pot_negocio` = '{$potencial}',
`observacao` = '{$observacoes}',
`alteracao` = CURRENT_TIMESTAMP()
WHERE `id` = {$id};
";

$result = $conexao->prepare($query);
//se conseguir efetuar o update então segue o fluxo normal do programa, caso contrário retorna uma mensagem de erro ao front
if($result->execute()){
  $query = "INSERT INTO `site`.`historico`
  (
  `usuario_id`,
  `tipo_atividade`,
  `status_atividade`,
  `nome`,
  `celular`,
  `endereco`,
  `cidade`,
  `data`,
  `recomendante`,
  `recomendações`,
  `q_rec`,
  `atuacao`,
  `pot_negocio`,
  `observacao`)
  VALUES
  (
  {$login},
  '{$atividade}',
  '{$status}',
  '{$nome}',
  '{$celular}',
  '{$endereco}',
  '{$cidade}',
  '{$data}',
  '{$recomendante}',
  '{$recomendacoes}',
  '{$qrec}',
  '{$atuacao}',
  '{$potencial}',
  '{$observacoes}');
  ";

  $result = $conexao->prepare($query);
  $result->execute();
  http_response_code(200);
  header('Content-Typeapplication/json;charset=utf-8');
  echo json_encode("Evento atualizado com sucesso");
  
}else{
  http_response_code(301);
  header('Content-Typeapplication/json;charset=utf-8');
  echo json_encode($query);
}
?>