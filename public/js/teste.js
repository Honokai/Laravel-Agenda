$(document).ready(function(){
    
    $("#trocarfoto").on("click", function(){
        document.getElementById("fotoupload").style.display = "block";
    });

    $("#enviarfoto").on("click", function(){
        var form = new FormData(document.getElementById("upload"));

        console.log(form);
        
        $.ajax({
            url: "api/perfil/uploadfoto.php",
            type: "POST",
            processData: false,
            contentType: false,
            data: form,
            success:function(data){
                console.log(data);
            },
            error: function(data){
                console.log(data);
            }
        });
    });
})