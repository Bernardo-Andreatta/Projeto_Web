<?php
$errors = array();
if(isset($_POST['submit'])){

    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $c_senha = $_POST['c_senha'];

    if(file_exists('xml/'.$email.'.xml')){
        $errors[] = 'Email ja esta sendo usado';
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
        $xml = new SimpleXMLElement ('<user></user>');
        $xml->addChild('senha',$senha);
        $xml->addChild('usuario',$senha);
        $xml->asXML('xml/'.$email.'.xml');
        header('Location: login.php');
        die;
    }
}
?>


<html>
    <head>
    <title>Cadastrar</title>
    </head>

    <body>
        <form method="post" action="">
            <?php
                if(count($errors) > 0){
                    echo '<ul>';
                    foreach($errors as $e){
                        echo '<li>'.$e.'</li>';
                    }
                    echo '</ul>';
                }
            ?>
            <p>Usuario <input type="text" name="usuario" value="<?php if(isset($_POST['usuario'])){echo $_POST['usuario']; } ?>"></p>
            <p>Email <input type="text" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email']; } ?>"></p>
            <p>Senha <input type="text" name="senha" value="<?php if(isset($_POST['senha'])){echo $_POST['senha']; } ?>"></p>
            <p>Confirmar Senha <input type="text" name="c_senha" value="<?php if(isset($_POST['c_senha'])){echo $_POST['c_senha']; } ?>"></p>
            <p><input type="submit" name="submit" value="Cadastrar"></p>
        </form>

    </body>
</html>