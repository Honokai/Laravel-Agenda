<?php 
if($_SERVER['REQUEST_METHOD'] == "POST"){
require_once('../../config/BancoDados.php');
    date_default_timezone_set('America/Fortaleza');
    $banco = new BancoDados;
    $conexao = $banco->conexao();
    $char = $conexao->prepare("set names utf8");
    $char->execute();
    
}
?>