$(document).ready(function(){

    $("#bLog").click(function(){
        fLocalValidaCampos();
        fLocalValidaEmail();
    });
});

function fLocalValidaEmail(){
    var email = $("#tEmail").val();

    if( email.indexOf("@") == -1){
        $("#tEmail").addClass("erro");
    }
    else{
        $("#tEmail").removeClass("erro");
    }

}

function fLocalValidaCampos(){
    var email = $("#tEmail").val();
    var senha = $("#tSenha").val();

    if (email == ""){
        $("#tEmail").addClass("erro vazio");
    }
    else{
        $("#tEmail").removeClass("erro");
    }

    if (senha == ""){
        $("#tSenha").addClass("erro vazio");
    }
    else{
        $("#tSenha").removeClass("erro");
    }
}