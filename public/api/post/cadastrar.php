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
    $nome = $_POST['nome'];
    $inicio = $_POST['datainicio']. " " . $_POST['horarioinicio'];
    $fim = $_POST['datatermino']. " " . $_POST['horariotermino'];
    $descricao = $_POST['descricao'];
    $query = "INSERT INTO agenda(
        `usuario_id`,
        `nome`,
        `data_ag`,
        `data_fim`,
        `descricao`) VALUES (". 
        $usuario. ",'". 
        $nome ."','". 
        $inicio . "','". 
        $fim . "','". 
        $descricao .
        "')";
    $resultado = $conexao->prepare($query);
    if($resultado->execute()){
        echo json_encode("EVENTO ADICIONADO");
    }else{
        echo json_encode($query);
    }
       
}


?>