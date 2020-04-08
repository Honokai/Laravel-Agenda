<?php 
require_once('../../config/BancoDados.php');
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $bd = new BancoDados();
    $conexao = $bd->conexao();
    $id = $_POST['id'];
    $descricao = addslashes($_POST['descricao']);
    if($_POST['tipo'] == 1 ){
        $query = "INSERT INTO feedback (`agenda_id`,descricao) VALUES (".$id.",'".$descricao."')";
        $resultado = $conexao->prepare($query);
        $resultado->execute();
        $row = $resultado->rowCount();
        if($row == 1 ){
            echo json_encode(array("resposta"=>"Descrição adicionada com sucesso."));
        } else {
            echo json_encode(array("erro"=>"Algo não funcionou corretamente."));
        }
    }elseif($_POST['tipo'] == 2){
        $query = "UPDATE feedback set descricao='".$descricao."' where `agenda_id`=".$id;
        $resultado = $conexao->prepare($query);
        $resultado->execute();
        $row = $resultado->rowCount();
        if($row == 1 ){
            echo json_encode(array("resposta"=>"Descrição atualizada com sucesso."));
        } else {
            echo json_encode(array("erro"=>"Algo não funcionou corretamente.","QUERY"=>$resultado->errorInfo()));
        }
    }

}


?>