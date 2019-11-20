<?php
$errors = array();

    $usuario = $_POST['ajax_usuario'];
    $email = $_POST['ajax_email'];
    $senha = $_POST['ajax_senha'];
    $c_senha = $_POST['ajax_confirmarsenha'];

    if(file_exists('../xml/'.$email.'.xml')){
        $errors[] = 'Email ja esta sendo usado'."\n";
    }
    if($usuario == ''){
        $errors[] = 'Usuario esta vazio';
    }
    if($email == ''){
        $errors[] = 'Email esta vazio';
    }
    if($senha == ''){
        $errors[] = 'Senha esta vazio';
    }
    if($c_senha == ''){
        $errors[] = 'Confirmar senha esta vazio';
    }
    if($senha != $c_senha){
        $errors[] = 'Senhas nao correspondem';
    }

    if(count($errors) == 0){
        $xml = new DOMDocument("1.0");

        $user = $xml->createElement("user");
    
        $xml_usuario = $xml->createElement("usuario",$usuario);
        $xml_senha = $xml->createElement("senha",$senha);
    
        $user->appendChild($xml_senha);
        $user->appendChild($xml_usuario);
    
        $xml->appendChild($user);
    
        $xml->save("../xml/$email.xml");
        echo json_encode ("success");
    }
    
    if(count($errors) > 0){
        echo json_encode($errors);
    }
?>


