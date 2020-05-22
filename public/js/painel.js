$(document).ready(function(){
    /*
    document.getElementById("menu").style.width = "250px";
    document.getElementById("menu").style.visibility = "visible";
    document.getElementById("menu").style.backgroundColor = "white";
    */

   

   $(document).onresize = (function(){
        if(screen.width > 600){
            document.getElementById("content-menu").style.display = "block";
        }
   });
    $("#alterarFoto").on("click", function(){
        //mostrarOcultarMenu();
        document.getElementById("content").style.display = "block";
        document.getElementById("fotoupload").style.display = "block";
        ocultarMenu();
        //document.getElementById('todosEventos').style.display = "block";
        //document.getElementById("para").style.display = "block";
    });

    

    $("#fecharFoto").on("click", function(){
        document.getElementById("fotoupload").style.display = "none";
    });

    $("#fecharRelatorio").on("click", function(){
        document.getElementById("relatorio").style.display = "none";
    });

    $("#cardrelatorio").on("click", function(){
        document.getElementById("content").style.display = "block";
        document.getElementById("relatorio").style.display = "block";
        ocultarMenu();
    });
    /*
    $("#abrirmenu").on("click", function(){
        alert("botao clicado");
        document.getElementById("opcao-lateral").style.visibility = "visible";
        document.getElementById("opcao-lateral").style.width = "200px";
    });
    */
    $("#menu").on("click", function(){
        mostrarOcultarMenu();
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

  

    $("#menu-change").on("click", function(){
        menuTeste();
    });

})

function menuTeste(){
    var menu = document.getElementById("container-menu").style.display;
    if(menu == "" || menu == "none"){
        document.getElementById("container-menu").style.display = "block";
        document.getElementById("content").style.display = "none";
       
    }else{
        document.getElementById("container-menu").style.display = "none";
        document.getElementById("content").style.display = "block";
    }
}
/*
function mostrarOcultarMenu(){
    var menu = document.getElementById("menulateral").style.visibility;
    document.getElementById("menu").classList.toggle("change");
    if(menu == "" || menu == "hidden"){
        document.getElementById("menulateral").style.width = "200px";
        document.getElementById("menulateral").style.visibility = "visible";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    }else{
        document.getElementById("menulateral").style.width = "0px";
        document.getElementById("menulateral").style.visibility = "hidden";
        document.body.style.backgroundColor = "rgba(255,255,255,1)";
    }
}
*/


function ocultarMenu(){
    if(window.innerWidth <= 600){
        document.getElementById("container-menu").style.display = "none";
    }
}

function fecharFoto(){
    document.getElementById('fotoupload').style.display = "none";
}
