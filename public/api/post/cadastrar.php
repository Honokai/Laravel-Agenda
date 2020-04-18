<?php 
/*
ponto para cadastro de novos eventos
*/
if($_SERVER['REQUEST_METHOD'] == "POST"){
require_once('../../config/BancoDados.php');
    date_default_timezone_set('America/Fortaleza');
    $banco = new BancoDados;
    $conexao = $banco->conexao();
    $char = $conexao->prepare("set names utf8");
    $char->execute();
    $usuario = $_POST['login'];
    $nome = $_POST['nome'] == "" ? NULL : $_POST['nome'];
    $categoria = $_POST['categoria'];
    $inicio = $_POST['datainicio']. " " . $_POST['horarioinicio'];
    $fim = $_POST['datatermino']. " " . $_POST['horariotermino'];
    $descricao = $_POST['descricao'];
    $query = "INSERT INTO agenda(
        `usuario_id`,
        `nome`,
        `data_ag`,
        `data_fim`,
        `descricao`, 
        `categoria`) VALUES (". 
        $usuario. ",'". 
        $nome ."','". 
        $inicio . "','". 
        $fim . "','". 
        $descricao . "','".
        $categoria.
        "')";

    
    $resultado = $conexao->prepare($query);
    if($_POST['nome'] != "" && $inicio < $fim){
        $resultado->execute();
        echo json_encode("Evento adicionado com sucesso.");
    }else{
        http_response_code(301);
        echo json_encode("Verifique os campos informados.");
    }
       
}


?>