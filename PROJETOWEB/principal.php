<?php 
session_start();
if(!file_exists('xml/'. $_SESSION['email'].'.xml')){
    header('Location: login.php');
    die;
}
?>

<?php
    $error = false;
    if(isset($_POST['enviar'])){
        $destinatario = $_POST['destino'];
        $titulo = $_POST['titulo'];
        $texto = htmlentities($_POST['texto']);
        if(file_exists('xml/'.$destinatario.'.xml')){
            $xml = simplexml_load_file('xml/'.$destinatario.'.xml');
            $xml->addChild('titulo',$titulo);
            $xml->titulo->addChild('texto',$texto);
            $xml->asXML('xml/'.$destinatario.'.xml');
        }
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
           
        <form action="" method="post">
            <p>Destinatario<input type="text" name="destino"></p>
            <p>Assunto<input type="text" name="titulo"></p>
            <p><textarea name="texto"cols="30" rows="10"></textarea></p>
            <p><input type="submit" name="enviar" value="enviar"></p><br>
            <a href="logout.php">Logout</a>
        </form>
        
    </body>

</html>