<?php 
session_start();
if(!file_exists('xml/'. $_SESSION['email'].'.xml')){
    header('Location: login.php');
    die;
}
?>
<html>
    <head>
    <link rel="stylesheet" href="css/estilo4.css?v=<?php echo time(); ?>">
    <title>Emails Enviados</title>
    </head>
    <body>
    <div class="emails">
    <?php
        $files = glob('xml/mail/*.xml');
        foreach($files as $file) {
            $xml = new SimpleXMLElement ($file, 0 , true );
            $pesquisado = false;
            if(isset($_GET['pesq'])){
                $pesquisado = true;
                $busca = $_GET['pesquisa'];
            }
            if($pesquisado == false){
                if($xml->Remetente == $_SESSION['email']){
                    echo '<a href="'.$file.'" class="mail">'.'Para: '.$xml->Destinatario .' - Titulo: '.$xml->Titulo .'</a>';
                    echo '<br>'; 
            }
            }
            else{
            if($xml->Destinatario == $busca and $xml->Remetente == $_SESSION['email']){
                echo '<a href="'.$file.'" class="mail">'.'Para: '.$xml->Destinatario .' - Titulo: '.$xml->Titulo .'</a>';
                echo '<br>';
                
            }
            if($xml->Titulo == $busca and $xml->Remetente == $_SESSION['email']){
                echo '<a href="'.$file.'" class="mail">'.'Para: '.$xml->Destinatario .' - Titulo: '.$xml->Titulo .'</a>';
                echo '<br>';
                
            }
            if($xml->Remetente == $_SESSION['email'] and $busca == ''){
                echo '<a href="'.$file.'" class="mail">'.'Para: '.$xml->Destinatario .' - Titulo: '.$xml->Titulo .'</a>';
                echo '<br>'; 
            }
            
        }
        }
    ?>
    </div>
    <form action="" method="get">
            <p><input class="divInput" type="text" name="pesquisa"></p>
            <p><input type="submit" name="pesq" value="Pesquisar" class="botao"></p>
        </form>
    <a href="logout.php"><img border="0" src="img/logout.png" width="100" height="100"></a>
    <a href="principal.php"><img border="0"src="img/back.png" width="60" height="60"></a>
    </body>
</html>