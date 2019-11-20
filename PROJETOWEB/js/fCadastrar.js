$(document).ready(function(){

    $("#submit").click(function(){
        var usuario = $("#usuario").val();
        var email = $("#email").val();
        var senha = $("#senha").val();
        var confirmarsenha = $("#c_senha").val();

        $.ajax({

            type: "POST",
            dataType: "json",
            url: "../php/cadastrar.php",
            data:{
                ajax_usuario: usuario,
                ajax_email: email,
                ajax_senha: senha,
                ajax_confirmarsenha: confirmarsenha
            },
            success:function(response){
                if (response == "success") {
                    window.location.href="../index.html"
                }
                else{
                    alert(response)
                }
            }
        });
    });
});