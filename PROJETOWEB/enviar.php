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
        <title>Enviar email</title>
    </head>

    <body>
    <div>
    <?php
        $xml = new SimpleXMLElement ('xml/'.$_SESSION['email'].'.xml', 0 , true );
        $usuario = $xml->usuario;
        echo 'Bem vindo '.$usuario;
    ?>
    </div>
    <?php
    $error = false;
    if(isset($_POST['enviar'])){
        $destinatario = $_POST['destino'];
        $titulo = $_POST['titulo'];
        $texto = htmlentities($_POST['texto']);
        $remetente = $_SESSION['email'];
        $random = generateRandomString();
        if(file_exists('xml/'.$destinatario.'.xml')){
            $xml = new DOMDocument();
            $xml->formatOutput = true;
            $xml->preserveWhiteSpace = false;
            $xslt = $xml->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="../../xsl/estiloXml.xsl"');
            $xml->appendChild($xslt);
            $root = $xml->createElement('mail');
            $root = $xml->appendChild($root);

            $ele1 = $xml->createElement('Destinatario');
            $ele1->nodeValue=$destinatario;
            $root->appendChild($ele1);

            $ele2 = $xml->createElement('Remetente');
            $ele2->nodeValue=$remetente;
            $root->appendChild($ele2);

            $ele3 = $xml->createElement('Titulo');
            $ele3->nodeValue=$titulo;
            $root->appendChild($ele3);

            $ele4 = $xml->createElement('Texto');
            $ele4->nodeValue=$texto;
            $root->appendChild($ele4);

            $xml->save('xml/mail/'.$random.'.xml');
        }
        else{
            $error = true; 
        }
    }
        ?>
         
        <form action="" method="post">
            <p>Destinatario <input type="text" name="destino"></p>
            <p>Assunto <input type="text" name="titulo"></p>
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
            <a href="logout.php"><img border="0" alt="W3Schools" src="img/logout.png" width="100" height="100"></a>
        </form>
        
    </body>

</html>