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
        });
    });
});