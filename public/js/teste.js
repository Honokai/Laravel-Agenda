$(document).ready(function(){
    
    $("#trocarfoto").on("click", function(){
        document.getElementById("fotoupload").style.display = "block";
        document.getElementById("para").style.display = "block";
    });

    $("#cardrelatorio").on("click", function(){
        document.getElementById("par").style.display = "block";
        document.getElementById("relatorio").style.display = "block";
    });
    
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