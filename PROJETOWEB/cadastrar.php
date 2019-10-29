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
        $xml->addChild('usuario',$usuario);
        $xml->asXML('xml/'.$email.'.xml');
        header('Location: login.php');
        die;
    }
}
?>


<html>
    <head>
    <link rel="stylesheet" href="css/estilo2.css?v=<?php echo time(); ?>">
    <title>Logon</title>
    </head>

    <body>
        
        <form method="post" action="">
            <div class="aviso">
            <?php
                if(count($errors) > 0){
                    echo '<ul>';
                    foreach($errors as $e){
                        echo '<li>'.$e.'</li>';
                    }
                    echo '</ul>';
                }
            ?>
            </div>
            <div class="box">
            <div class="divBackground"></div>
            <div ><img class="divLogo" src="img/logo.png" alt="Logo"></div>
            <h1><text class="cyan">Log</text>On</h1><br>
            <div class="loc">
            <p><input class="divInput" type="text" name="usuario" placeholder="Usuario" value="<?php if(isset($_POST['usuario'])){echo $_POST['usuario']; }?>"></p>
            <p><input class="divInput" type="text" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])){echo $_POST['email']; } ?>"></p>
            <p><input class="divInput" type="text" name="senha"placeholder="Senha" value="<?php if(isset($_POST['senha'])){echo $_POST['senha']; } ?>"></p>
            <p><input class="divInput" type="text" placeholder="Confirmar senha" name="c_senha" value="<?php if(isset($_POST['c_senha'])){echo $_POST['c_senha']; } ?>"></p>
            </div>
            <p><input type="submit" name="submit" value="Logon" class="botao"=></p>
            </div>
        </form>

    </body>
</html>