$(document).ready(function(){
    /*
    document.getElementById("menu").style.width = "250px";
    document.getElementById("menu").style.visibility = "visible";
    document.getElementById("menu").style.backgroundColor = "white";
    */
    $("#trocarfoto").on("click", function(){
        document.getElementById("fotoupload").style.display = "block";
        document.getElementById("para").style.display = "block";
    });

    $("#cardrelatorio").on("click", function(){
        document.getElementById("par").style.display = "block";
        document.getElementById("relatorio").style.display = "block";
    });
    
    $("#menu").on("click", function(){
        document.getElementById("menu").style.visibility = "hidden";
        document.getElementById("close").style.visibility = "visible";
        document.getElementById("menulateral").style.width = "200px";
        document.getElementById("menulateral").style.visibility = "visible";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    });

    $("#close").on("click", function(){
        document.getElementById("close").style.visibility = "hidden";
        document.getElementById("menu").style.visibility = "visible";
        document.getElementById("menulateral").style.width = "0px";
        document.getElementById("menulateral").style.visibility = "hidden";
        document.body.style.backgroundColor = "rgba(255,255,255,1)";
    });
/*
    $("#submitregistro").on("click", function(){
        var form = new FormData(document.getElementById("form"));
        let token = document.getElementsByName("_token")[0].defaultValue;
        let nome = document.getElementById("name").val;
        let senha =  document.getElementById("password").val;
        let tipo = document.getElementById("tipo").val;
        let email = document.getElementById("email").val;
        $.ajax({
           url: "register",
           type: "POST",
           data: {
               "name": nome,
               "email": email,
               "_token": token,
               "password": senha,
               "tipo": tipo
           },
           success: function(data){
                console.log(data);
           },
           error: function(data){
                console.log(data);
           }
        });
    });
*/
    $("#enviarrelatorio").on("click", function(element){
        let login = $('#userid').val();
        let relatorio = $('#tiporelatorio').val();
        let titulo = $('#nomeplanilha').val();
        $.ajax({
            url: "relatorios/tipo1.php",
            type: "POST",
            data: { "id": login,
                    "relatorio":relatorio,
                    "titulo":titulo
            },
            success: function(data){
                //console.log(data);
                let resposta = JSON.parse(data);
                $('#enviarrelatorio').after("<a class='btn btn-success' target='blank' "+"href='/planilha/"+resposta.planilha+"'>"+ resposta.planilha +"</a>");
            },
            error: function(data) {
                console.log("Erro");
            }
        });
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
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: "Foto atualizada",
                    showConfirmButton: false,
                    timer: 1500
                });
                document.getElementById('fotoupload').style.display = "none";
            },
            error: function(data){
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: "Algo deu errado.",
                    showConfirmButton: false,
                    timer: 1500
                });

            }
        });

    });
})