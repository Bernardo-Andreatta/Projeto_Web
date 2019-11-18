$(document).ready(function(){

    $("#enviar").click(function(){
        var titulo = $("#titulo").val();
        var destino = $("#destino").val();
        var texto = $("#texto").val();

        $.ajax({

            type: "POST",
            dataType: "json",
            url: "../php/enviar.php",
            data:{
                ajax_titulo:  titulo,
                ajax_destino:  destino,
                ajax_texto: texto
            },
            success: function(retorno){ 
                if(retorno == "error"){
                alert("Usuario " + destino + " nao existente")
                }
                else{
                    window.location = "../paginas/principal.html";
                }

            }
        });
    });
    
    $.ajax({

        type: "POST",
        dataType: "json",
        url: "../php/enviar.php",
        success: function(retorno){ 
            
            if(retorno == "sair"){
                window.location = "../php/logout.php";
            }

        }
    });
});