$(document).ready(function(){

    $("#bLog").click(function(){
        fLocalValidaCampos();
        fLocalValidaEmail();
    });
});

function fLocalValidaCampos(){
    var email = $("#tEmail").val();
    var senha = $("#tSenha").val();

    if (email == ""){
        $("#tEmail").addClass("erro");
    }
    else{
        $("#tEmail").removeClass("erro");
    }

    if (senha == ""){
        $("#tSenha").addClass("erro");
    }
    else{
        $("#tSenha").removeClass("erro");
    }
}

function fLocalValidaEmail(){
    var email = $("#tEmail").val();

    if( email.indexOf("@") == -1){
        $("#tEmail").addClass("erro");
    }
    else{
        $("#tEmail").removeClass("erro");
    }

}