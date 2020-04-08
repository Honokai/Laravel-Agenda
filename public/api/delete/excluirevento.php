<?php 

if($_POST["_method"] == "DELETE"){
    require_once("../../config/BancoDados.php");
    $bd = new BancoDados();
    $conexao = $bd->conexao();
    $query = "DELETE FROM agenda 
                where id=".$_POST['id']." and usuario_id=".$_POST['usuario']." and data_ag='".$_POST['data']."' and data_fim='".$_POST['termino']."'";
    $resultado = $conexao->prepare($query);
    $resultado->execute();
    $row = $resultado->rowCount();

    if($row == 1 ){
        echo json_encode("Exclusão de evento efetuado.");
    }else{
        http_response_code(501);
        echo json_encode(array("resposta"=>"Algo não deu certo."));
    }
}
?>