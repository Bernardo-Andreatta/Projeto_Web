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
    if(isset($_POST['enviados'])){
        header('Location: enviados.php');
    }
?>

<html>

    <head>
        <title>Caixa de entrada</title>
        <link rel="stylesheet" href="css/estilo3.css?v=<?php echo time(); ?>">
        <script src="js/funcoes.js"></script>
        <script src="js/jquery-3.4.1.js"></script>
    </head>
    
    <body>
    <div class="divBox">
        <div class="bem">
            <?php
                $xml = new SimpleXMLElement ('xml/'.$_SESSION['email'].'.xml', 0 , true );
                $usuario = $xml->usuario;
                echo 'Bem<text class="vindo">Vindo </text>'.$usuario;

            ?>
        
        </div>

        </table>
        <form action="" method="get">
            <p><input class="divInput" placeholder="Pesquisar"type="text" name="pesquisa"></p>
            <p><input type="submit" name="pesq" value="Pesquisar"class="botao1"></p>
        </form>
        <div class="env">
        <form action="" method="post">
            <p><input type="submit" name="enviar" value="Enviar Email" class="botao2"></p>
            <p><input type="submit" name="enviados" value="Enviados" class="botao3"></p>
        </form>
        </div>
        <div class="logout"><a href="logout.php"><img border="0"src="img/logout.png" width="100" height="100"></a></div>
        
        </div>

        <table class="emails" id="emails">
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
                if($xml->Destinatario == $_SESSION['email']){
                    echo '<tr> <td> <a href="'.$file.'" class="mail"><img border="0"src="img/open.png" width="35" height="35"></a> </td> ';
                    echo ' <td>'.$xml->Remetente.'</td>';
                    echo ' <td></td>';
                    echo ' <td> Assunto: </td>';
                    echo ' <td>'.$xml->Titulo.'</td>';
                    echo ' <td class="menor">-</td>';
                    echo ' <td class="menor">'.$xml->Texto.' </td>';
                    echo ' <td><form action="" method="post">
                            <p><input type="submit" name="delete" value=""></p>
                            </form></td></tr>';
                    echo '<br>'; 
                    if(isset($_POST['delete'])){
                       
                    }
            }
            }
            else{
                if($xml->Remetente == $busca and $xml->Destinatario == $_SESSION['email']){
                    echo '<tr> <td> <a href="'.$file.'" class="mail"><img border="0"src="img/open.png" width="35" height="35"></a> </td> ';
                    echo ' <td>'.$xml->Remetente.'</td>';
                    echo ' <td></td>';
                    echo ' <td> Assunto: </td>';
                    echo ' <td>'.$xml->Titulo.'</td>';
                    echo ' <td class="menor">-</td>';
                    echo ' <td class="menor">'.$xml->Texto.' </td></tr>';
                    echo '<br>'; 
                
            }
            if($xml->Titulo == $busca and $xml->Destinatario == $_SESSION['email']){
                echo '<tr> <td> <a href="'.$file.'" class="mail"><img border="0"src="img/open.png" width="35" height="35"></a> </td> ';
                    echo ' <td>'.$xml->Remetente.'</td>';
                    echo ' <td></td>';
                    echo ' <td> Assunto: </td>';
                    echo ' <td>'.$xml->Titulo.'</td>';
                    echo ' <td class="menor">-</td>';
                    echo ' <td class="menor">'.$xml->Texto.' </td></tr>';
                    echo '<br>'; 
                
            }
            if($xml->Destinatario == $_SESSION['email'] and $busca == ''){
                echo '<tr> <td> <a href="'.$file.'" class="mail"><img border="0"src="img/open.png" width="35" height="35"></a> </td> ';
                    echo ' <td>'.$xml->Remetente.'</td>';
                    echo ' <td></td>';
                    echo ' <td> Assunto: </td>';
                    echo ' <td>'.$xml->Titulo.'</td>';
                    echo ' <td class="menor">-</td>';
                    echo ' <td class="menor">'.$xml->Texto.' </td></tr>';
                    echo '<br>'; 
            }
            
        }
        }
        ?>
    </body>

</html>