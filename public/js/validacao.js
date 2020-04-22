$(document).ready(function(){
   
    $('.hora').mask("00:00:00");
    $(".celular").mask("(00) 00000-0000");    
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
        let nome = $('#nomevento').val();
        let datainicio = $('#datainicio').val();
        let horainicio = $('#horarioinicio').val();
        let datatermino = $('#datatermino').val();
        let horatermino = $('#horariotermino').val();
        let descricao = $('#descricaoevento').val();
        let categoria = $('#categoria').val();
        let nome1 = $('#namevento').val();
        let datainicio1 = $('#dataevento').val();
        let horainicio1 = $('#horaevento').val();
        let datatermino1 = $('#datet').val();
        let horatermino1 = $('#horat').val();
        let descricao1 = $('#descricao').val();

        $.ajax({
            url: 'api/update/modalupdate.php',
            type: 'POST',
            data:{
                "id":id,
                "login":login,
                "nome":nome,
                "datainicio":datainicio,
                "horarioinicio":horainicio,
                "datatermino":datatermino ,
                "horariotermino":horatermino,
                "descricao": descricao, //atuais novos
                "categoria":categoria,
                "nome1":nome1, //antigos
                "datainicio1":datainicio1,
                "horarioinicio1":horainicio1,
                "datatermino1":datatermino1 ,
                "horariotermino1":horatermino1,
                "descricao1": descricao1
            },
            success: function(data,response){
                console.log(login);
                console.log(response);
                console.log(data);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Evento atualizado!',
                    showConfirmButton: false,
                    timer: 1500
                });
                $("#modal").modal('toggle');
                setTimeout(location.reload.bind(location), 1500);
            },
            error: function(data){
                console.log(data);
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
          let data = $('#novodata').val();
          let hora = $('#novohora').val();
          let recomendante = $('#novorecomendante').val();
          let recomendacoes = $("#novorecomendacoes").val();
          let qtderec = $("#novoqtderecs").val();
          let atuacao = $("#novoatuacao").val();
          let potencial = $("#novopotencial").val();
          let iniciovento = $("#novadatainicio").val();
          let horarioinicio = $("#novohorarioinicio").val();
          let observacoes = $("#observacoes").val();
          $.ajax({
            url:"api/post/cadastrar.php",
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
                "inicioevento" : iniciovento,
                "horarioinicio" : horarioinicio,
                "observacoes" : observacoes
            },
            success: function(data){
                console.log(data);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: JSON.parse(data),
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
        let nome = $('#nomevento').val();
        let datainicio = $('#datainicio').val();
        let horainicio = $('#horarioinicio').val();
        let datatermino = $('#datatermino').val();
        let horatermino = $('#horariotermino').val();
        let descricao = $('#descricaoevento').val();
        $.ajax({
            url:"api/delete/excluirevento.php",
            type:"POST",
            data: {
                "_method":"DELETE",
                "id":id,
                "usuario":login,
                "nome":nome,
                "data": datainicio+' '+horainicio,
                "termino": datatermino+' '+horatermino
            },
            success: function(data){
                let resposta = JSON.parse(data);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: resposta,
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
