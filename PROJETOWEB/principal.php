<?php 
session_start();
if(!file_exists('xml/'. $_SESSION['email'].'.xml')){
    header('Location: login.php');
    die;
}
?>

<?php
    if(isset($_POST['enviar'])){
        header('Location: enviar.php');
    }
?>
<html>

    <head>

    </head>
    
    <body>

        <div>
            <?php
                $xml = new SimpleXMLElement ('xml/'.$_SESSION['email'].'.xml', 0 , true );
                $usuario = $xml->usuario;
                echo 'Bem vindo '.$usuario;
                echo "<br>";
            ?>
        
        </div>

        <table>
        <?php
        $files = glob('xml/mail/*.xml');
        foreach($files as $file) {
            $xml = new SimpleXMLElement ($file, 0 , true );
            if($xml->Destinatario == $_SESSION['email']){
                echo '<tr>
                    <table>
                    <tr><td>'.'Remetente: '.$xml->Destinatario->Remetente .'</td></tr>
                    <tr><td>'.'Titulo: '.$xml->Destinatario->Remetente->Titulo .'</td></tr>
                    <tr><td>'.$xml->Destinatario->Remetente->Titulo->Texto .'</td></tr>
                    <tr><td>_________________________________________</td></tr>
                    </table>
                </tr>';
                
            }
        }
        ?>
        </table>
        <form action="" method="post">
            <p><input type="submit" name="enviar" value="Enviar Email"></p>
            <a href="logout.php">Logout</a>
        </form>
    </body>

</html>