$(document).ready(function() {

    $('#emails tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });
    $("#pesq").click(function(){
        var pesquisado = true;
        var pesquisa = $("#pesquisa").val();
        $.ajax({

            type: "POST",
            dataType: "json",
            url: "../php/principal.php",
            data:{
                ajax_pesquisa: pesquisa,
                pesquisado : pesquisado
            },
            success: function(retorno){
 
                var conteudo = "";
                conteudo += "<table class= 'emails' id= 'emails' >";
                for(var i = 0;i < retorno.length; i++){
                conteudo += "<tr>";
                conteudo += "<td>"+ "<a href=../xml/mail/" + retorno[i].url + ".xml" + " class='mail'><img border='0'src='../img/open.png' width='35' height='35'></a>" + "</td>";
                conteudo += "<td>"+ retorno[i].remetente + "</td>";
                conteudo += "<td>"+ retorno[i].titulo + "</td>";
                conteudo += "<td>"+ retorno[i].texto + "</td>";
                conteudo += "</tr>";
                conteudo += "</table>";
                $("#divLista").html(conteudo);
            }
        });
    });
});