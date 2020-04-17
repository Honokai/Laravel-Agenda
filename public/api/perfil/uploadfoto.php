<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $foto = $_FILES['arquivo'];
    if(mkdir("../../profile/".$id) === true){
        //  if(file_exists("../../profile/".$id."/"
        move_uploaded_file($_FILES['arquivo']['tmp_name'], "../../profile/".$id."/".$id.".png");
    }else{
        move_uploaded_file($_FILES['arquivo']['tmp_name'], "../../profile/".$id."/".$id.".png");
    }

}else{
    echo json_encode("Opa, algo deu errado.");
}   