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
    //variaveis recebidas pelo ajax
    $usuario = $_POST['login'];
    $atividade = $_POST['atividade'];
    $status = $_POST['status'];
    $nome = $_POST['nome'] == "" ? NULL : $_POST['nome'];
    $celular = $_POST['celular'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $data = $_POST['data']. " " . $_POST['hora'];
    $recomendante = $_POST['recomendante'];
    $recomendacoes = $_POST['recomendacoes'];
    $qrec = $_POST['qrec'];
    $atuacao = $_POST['atuacao'];
    $potencial = $_POST['potencial'];
    $observacoes = $_POST['observacoes']; 
    
    //$fim = $_POST['datatermino']. " " . $_POST['horariotermino'];
    
    $query = "INSERT INTO agenda(
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
        `observacao`) VALUES (". 
        $usuario. ",'". 
        $atividade . "','".
        $status . "','".
        $nome ."','". 
        $celular ."','".
        $endereco ."','".
        $cidade ."','".
        $data ."','".
        $recomendante ."','".
        $recomendacoes ."','".
        $qrec ."','".
        $atuacao ."','".
        $potencial ."','".
        $observacoes.
        "')";

    
    $resultado = $conexao->prepare($query);
    if($resultado->execute()){
        $query = "INSERT INTO historico(
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
            `observacao`) VALUES (". 
            $usuario. ",'". 
            $atividade . "','".
            $status . "','".
            $nome ."','". 
            $celular ."','".
            $endereco ."','".
            $cidade ."','".
            $data ."','".
            $recomendante ."','".
            $recomendacoes ."','".
            $qrec ."','".
            $atuacao ."','".
            $potencial ."','".
            $observacoes.
            "')";
            $resultado = $conexao->prepare($query);
            $resultado->execute();
        echo json_encode("Evento adicionado com sucesso.");
    }else{
        http_response_code(301);
        echo json_encode($query);
    }
       
}


?>