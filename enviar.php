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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/estilo5.css?v=<?php echo time(); ?>">
        <title>Enviar email</title>
    </head>

    <body>
    <div>
    
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
         
        <div class="divBox">
        
            <form action="" method="post">
                <p><text class="destinario">Destinario</text><input type="text" name="destino" class="destinario2"></p>
                <p><text class="assunto">Assunto</text><input type="text" name="titulo" class="assunto2"></p>
                <p><textarea name="texto"cols="60" rows="10" class="textarea"></textarea></p>
                <p><input type="submit" name="enviar" value="enviar" class="enviar"></p><br>
                <p>
                <?php
                if ($error == true){
                echo 'Usuario '.$destinatario.' inexistente';
                }
                ?>
                </p>
                <br><br>
                <a href="principal.php"><img border="0" alt="W3Schools" src="img/back.png" width="40" height="40" class="back"></a><br>
                <a href="logout.php"><img border="0" alt="W3Schools" src="img/logout.png" width="100" height="100" class="logout"></a>
            </form>
            
        </div>
        
    </body>

</html>