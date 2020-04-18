$(document).ready(function(){
    
    $("#trocarfoto").on("click", function(){
        document.getElementById("fotoupload").style.display = "block";
        document.getElementById("para").style.display = "block";
    });

    $("#enviarfoto").on("click", function(){
        var form = new FormData(document.getElementById("upload")); //necessário us

        //chamada ajax para mandar os dados necessários para troca da foto
        $.ajax({
            url: "api/perfil/uploadfoto.php",
            type: "POST",
            processData: false,
            contentType: false,
            data: form,
            success:function(data){
                //ao mandar nova foto atualiza o perfil sem que tenha que recarregar a página
                $("#imagemperfil").attr("src","data:image/png;base64,"+data+"");   
            },
            error: function(data){
                console.log(data);
            }
        });

    });
})