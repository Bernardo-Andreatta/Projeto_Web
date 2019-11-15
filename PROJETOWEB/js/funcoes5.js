$(document).ready(function() {
       
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });

    $("#pesq").click(function(){
        var pesquisa = $("#pesquisa").val();
        $.ajax({

            type: "POST",
            dataType: "json",
            url: "../php/enviados.php",
            data:{
                ajax_pesquisa: pesquisa
            },
    });
});
    $.ajax({

        type: "POST",
        dataType: "json",
        url: "../php/enviados.php",
        success: function(retorno){ 
            var conteudo = "";
            conteudo += "<table class= 'emails'>";
            for(var i = 0;i < retorno.length; i++){
            conteudo += "<tr>";
            conteudo += "<td>"+ "<a href=" + retorno[i].url + " class='mail'><img border='0'src='../img/open.png' width='35' height='35'></a>" + "</td>";
            conteudo += "<td>"+ retorno[i].destinatario + "</td>";
            conteudo += "<td>"+ retorno[i].titulo + "</td>";
            conteudo += "<td class='menor'>"+" - "+ retorno[i].texto + "</td>";
            conteudo += "</tr>";
            $("#divLista").html(conteudo);
        }
        conteudo += "</table>";
        
    }
});
});