<?php 
session_start();
if(!file_exists('xml/'. $_SESSION['email'].'.xml')){
    header('Location: login.php');
    die;
}
?>

<html>
    <head>
        <title>Pagina do Usuario</title>
    </head>

    <body>
    <?php
        $xml = new SimpleXMLElement ('xml/'.$_SESSION['email'].'.xml', 0 , true );
        $usuario = $xml->usuario;
        echo 'Bem vindo '.$usuario;
        echo "<br>";
        ?>
            <a href="logout.php">Logout</a>
    </body>

</html>