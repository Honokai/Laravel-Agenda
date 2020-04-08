$(document).ready(function(){

    $('#e-mail').blur(function(){
        var valor = document.getElementById('e-mail').value;
        $.ajax({
            type: "GET",
            url: 'usuario.php',
            data: {data: valor},
            success: function (data){
                if(data >= 1)
                    document.getElementById('alerta').style.display = "block";
            }

        });   
    });
    
    $('#fechar').on("click", function(){
        document.getElementById('alerta').style.display = "none";
    });

    $('#confirmacao').blur(function(){
        if(document.getElementById('senha').value == document.getElementById('confirmacao').value){
            console.log("Senhas conferem");
        }else{
            console.log("Senhas não conferem");
        }
    });

});