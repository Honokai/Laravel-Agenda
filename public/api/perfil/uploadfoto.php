<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $foto = $_FILES['arquivo'];
    if(file_exists("../../profile/".$id)){
        copy($_FILES['arquivo']['tmp_name'], "../../profile/".$id."/".$id.".png");
        $imagem = file_get_contents("../../profile/".$id."/".$id.".png");
        header("Content-Type: image/png");
        echo base64_encode($imagem); 
    }else{
        mkdir("../../profile/".$id);
        copy($_FILES['arquivo']['tmp_name'], "../../profile/".$id."/".$id.".png");
        $imagem = file_get_contents("../../profile/".$id."/".$id.".png");
        header("Content-Type: image/png");
        echo base64_encode($imagem); 
    }

}else{
    echo json_encode("Opa, algo deu errado.");
}   