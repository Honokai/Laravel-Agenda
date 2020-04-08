$(document).ready(function(){


    $("#horario").mask('AA:AA');
    var id = document.getElementById('usuario_id').value;;
    
    $('#save').on("click", function(){
        var descricao, data, nome, horario;
        
        descricao = document.getElementById('descrip').value;
        data = document.getElementById('data').value;
        nome = document.getElementById('evento').value;
        horario = document.getElementById('horario').value;
        if(descricao!='' || data!='' || nome!='' || horario != ''){
            $.ajax({
                method: "GET",
                url: 'eventoup.php',
                data: {"id":id,"descricao":descricao,"data":data,"nome":nome,"horario": horario},
                success: function(data){
                    console.log(data);
                }
            });
        }else{
            console.log("Faltam dados");
        }
    });
    
    $("#tabela").dataTable();

    
    $.ajax({
        method: "GET",
        url: 'api/get/agendamentos.php',
        dataType: 'json',
        data: {"id":id},
        success: function(data){
            var teste;
            $("#tabela").DataTable().clear().destroy();
            $.each(data['dados'], function(index, item){
                var teste = '<tr><td>'+item['Hora'] +'</td><td>'+item['Nome']+'</td><td>'+item['Data']+'</td><td id="recebedescri">'+item['Descricao']+'</td></tr> ';
                $('#tabela').append(teste);
            });
            
            $("#tabela").dataTable();  
        }
    });
    
    
    $('#adicionar').on("click", function(){
        var teste;
        var teste = '<tr class="row"><td class="col-3"><input class="form-control"></td><td class="col-3"><input class="form-control"></td><td class="col-3"><input class="form-control"></td><td class="col-3"><input class="form-control"></td></tr> ';
        
        $('#adiciona').append(teste);
    });

    $('#ativa').on("click", function(){
        
        var teste;
        $.ajax({
            method: "GET",
            url: 'api/get/agendamentos.php',
            dataType: 'json',
            data: {"id":id},
            success: function(data){
                $("#tabela").DataTable().clear().destroy();
                $.each(data['dados'], function(index, item){
                    var teste = '<tr><td>'+item['Hora'] +'</td><td>'+item['Nome']+'</td><td>'+item['Data']+'</td><td id="recebedescri">'+item['Descricao']+'</td></tr> ';
                    $('#tabela').append(teste);
                });
                
                $("#tabela").dataTable();  
            }
        });

        
        
         
    });

    

});