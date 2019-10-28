<?php 
session_start();
if(!file_exists('xml/'. $_SESSION['email'].'.xml')){
    header('Location: login.php');
    die;
}
?>
<?php
    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
     }
     return $randomString;
}
?>

<html>
    <head>
        <link rel="stylesheet" href="css/estilo2.css">
        <title>Pagina do Usuario</title>
    </head>

    <body>
    <?php
        $xml = new SimpleXMLElement ('xml/'.$_SESSION['email'].'.xml', 0 , true );
        $usuario = $xml->usuario;
        echo 'Bem vindo '.$usuario;
        echo "<br>";
    ?>

    <?php
    $error = false;
    if(isset($_POST['enviar'])){
        $destinatario = $_POST['destino'];
        $titulo = $_POST['titulo'];
        $texto = htmlentities($_POST['texto']);
        $remetente = $_SESSION['email'];
        $random = generateRandomString();
        if(file_exists('xml/'.$destinatario.'.xml')){
            $xml = new SimpleXMLElement ('<mail></mail>');
            $xml->addChild('Destinatario',$destinatario);
            $xml->Destinatario->addChild('Remetente',$remetente);
            $xml->Destinatario->Remetente->addChild('Titulo',$titulo);
            $xml->Destinatario->Remetente->Titulo->addChild('Texto',$texto);
            $xml->asXML('xml/mail/'.$random.'.xml');
        }
        else{
            $error = true; 
        }
    }
        ?>
           
        <form action="" method="post">
            <p>Destinatario<input type="text" name="destino"></p>
            <p>Assunto<input type="text" name="titulo"></p>
            <p><textarea name="texto"cols="30" rows="10"></textarea></p>
            <p><input type="submit" name="enviar" value="enviar"></p><br>
            <p>
            <?php
            if ($error == true){
            echo 'Usuario '.$destinatario.' inexistente';
            }
            ?>
            </p>
            <a href="principal.php">Principal</a><br>
            <a href="logout.php">Logout</a>
        </form>
        
    </body>

</html>