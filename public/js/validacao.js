$(document).ready(function(){
   
    $('.hora').mask("00:00:00");
    $(".celular").mask("(00) 00000-0000");    
    $(".potencial").mask("000.000.000,00",{reverse: true});

    $(".endereco,.cidade").focusout(function(e){ //pegas os inputs com classe endereco e cidade e ao perder o foco
        this.value = $(this).val().toUpperCase(); //coloca os caracteres possíveis em maiúscula 
    });


    $('#e-mail').blur(function(){
        var valor = document.getElementById('e-mail').value;
        $.ajax({
            url: 'usuario.php',
            type: "GET",
            data: {data: valor},
            success: function (data, response){
                console.log(data);
                console.log(response);
                if(data == 0){
                    document.getElementById('alerta').style.display = "block";
                    document.getElementById('e-mail').value = "";
                }else{
                    document.getElementById('alerta').style.display = "none";
                }
            },

        });   
    });
    $('#enviar').on('click', function(){
        let id = $('#idevento').val();
        let login = $('#login').val();
        let atividade = $("#atividade").val();
        let status = $("#status").val(); 
        let nome = $('#nome').val();
        let celular = $('#celular').val();
        let endereco = $('#endereco').val();
        let cidade = $('#cidade').val();
        let data = $('#data').val();
        let hora = $('#hora').val();
        let recomendante = $('#recomendante').val();
        let recomendacoes = $("#recomendacoes").val();
        let qtderec = $("#qtderecs").val();
        let atuacao = $("#atuacao").val();
        let potencial = $("#potencial").val();
        let iniciovento = $("#datainicio").val();
        let horarioinicio = $("#horarioinicio").val();
        let observacoes = $("#observacoes").val();
        $.ajax({
            url: 'api/update/modalupdate.php',
            type: 'POST',
            data:{
                "id":id, //id do evento
                "login":login, //id do usuário
                "atividade" : atividade,
                "status" : status,
                "nome" : nome,
                "celular" : celular,
                "endereco" : endereco,
                "cidade" : cidade ,
                "data" : data,
                "hora": hora,
                "recomendante" : recomendante,
                "recomendacoes" : recomendacoes,
                "qrec" : qtderec,
                "atuacao" : atuacao,
                "potencial" : potencial,
                "observacoes" : observacoes
            },
            success: function(data,response){
                console.log(data);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: JSON.parse(data),
                    showConfirmButton: false,
                    timer: 1500
                });
                $("#modal").modal('toggle');
                setTimeout(location.reload.bind(location), 1500);
            },
            error: function(data){
                console.log(JSON.parse(data.responseText));
            }

        });
      });

      $("#novohora").focusout(function(){
        document.getElementById('novohorarioinicio').value = $("#novohora").val();
      });
      
      $('#criar').on("click", function(){
          let login = $('#login').val();
          let atividade = $("#novoatividade").val();
          let status = $("#novostatus").val(); 
          let nome = $('#novonome').val();
          let celular = $('#novocelular').val();
          let endereco = $('#novoendereco').val();
          let cidade = $('#novocidade').val();
          let data = $('#novadata').val();
          let hora = $('#novahora').val();
          let recomendante = $('#novorecomendante').val();
          let recomendacoes = $("#novorecomendacoes").val();
          let qtderec = $("#novoqtderecs").val();
          let atuacao = $("#novoatuacao").val();
          let potencial = $("#novopotencial").val();
          let observacoes = $("#novoobservacoes").val();
          $.ajax({
            url:"api/eventos",
            type:"POST",
            data: {
                "login" : login,
                "atividade" : atividade,
                "status" : status,
                "nome" : nome,
                "celular" : celular,
                "endereco" : endereco,
                "cidade" : cidade ,
                "data" : data,
                "hora": hora,
                "recomendante" : recomendante,
                "recomendacoes" : recomendacoes,
                "qrec" : qtderec,
                "atuacao" : atuacao,
                "potencial" : potencial,
                "observacoes" : observacoes
            },
            success: function(data){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: data,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(location.reload.bind(location), 1500);
            },
            error: function(data){
                console.log(data);
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: JSON.parse(data.responseText),
                    showConfirmButton: false,
                    timer: 1500
                });
            }
          });
      })
      $("#excluirevento").on("click", function(){
        let id = $('#idevento').val();
        let login = $('#login').val();
        $.ajax({
            url:"api/eventos/"+id,
            type:"DELETE",
            data: {
                "_method":"DELETE",
                "usuario":login,
            },
            success: function(data){
                console.log(data);
                //let resposta = JSON.parse(data);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: data,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(location.reload.bind(location), 1500);
            },
            error: function(data){
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: data.responseText,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
      });

      $('#listadados a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
      });

      $('#acontecimentos').on("click", function(){
        let feedback = $('#feedbackdescricao').val();
        if(feedback == ""){
            document.getElementById('atualizardescricao').style.display = "none";
            document.getElementById('adicionardescricao').style.display = "inline-block";
        }else{
            document.getElementById('adicionardescricao').style.display = "none";
            document.getElementById('atualizardescricao').style.display = "inline";
        }
      });

      $('#adicionardescricao').on("click", function(){
        $.ajax({
            url: 'api/post/descricaoadd.php',
            type: 'POST',
            data: {
                "tipo" : 1,
                "id" : $('#idevento').val(),
                "descricao" : $('#feedbackdescricao').val()
            },
            success: function(data, response){
                let resposta = JSON.parse(data);
                console.log(data);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: resposta.resposta,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(location.reload.bind(location), 1500);
            },
            error: function(data,response){
                console.log(data);
            }
        });
      });
      $('#atualizardescricao').on("click", function(){
        $.ajax({
            url: 'api/post/descricaoadd.php',
            type: 'POST',
            data: {
                "tipo" : 2,
                "id" : $('#idevento').val(),
                "descricao" : $('#feedbackdescricao').val()
            },
            success: function(data, response){
                let resposta = JSON.parse(data);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: resposta.resposta,
                    showConfirmButton: false,
                    timer: 1500
                });
                $("#modal").modal('toggle');
            },
            error: function(data,response){
                let resposta = JSON.parse(data);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: resposta.resposta,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
      });
});
