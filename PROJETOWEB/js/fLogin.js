$(document).ready(function(){

    $("#login").click(function(){
        var email = $("#email").val();
        var senha = $("#senha").val();

        $.ajax({

            type: "POST",
            dataType: "json",
            url: "php/login.php",
            data:{
                ajax_email: email,
                ajax_senha: senha
            },
            success:function(response){
                if (response == "success") {
                    window.location.href="paginas/principal.html"
                }
                else{
                    alert("Falha ao fazer login")
                }
            }
        });
    });
});