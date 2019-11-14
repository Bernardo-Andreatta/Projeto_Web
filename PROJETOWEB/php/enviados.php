<?php 
session_start();
if(!file_exists('../xml/'. $_SESSION['email'].'.xml')){
    header('Location: ../paginas/login.html');
    die;
}
?>

<?php
    if(isset($_GET['enviar'])){
        header('Location: enviar.php');
    }
    if(isset($_GET['caixa'])){
        header('Location: principal.php');
    }
?>

<html>

    <head>
        <title>Enviados</title>
        <link rel="stylesheet" href="../css/estilo3.css?v=<?php echo time(); ?>">
        <script src="../js/jquery-3.4.1.js"></script>
        <script src="../js/funcoes.js"></script>
    </head>
    
    <body>
    <div class="divBox">
        <div class="bem">
            <?php
                $xml = new SimpleXMLElement ('../xml/'.$_SESSION['email'].'.xml', 0 , true );
                $usuario = $xml->usuario;
                echo 'Bem<text class="vindo"> Vindo </text><br>'.$usuario;

            ?>
        
        </div>

        </table>
        <form action="" method="get">
            <p><input class="divInput" placeholder="Pesquisar"type="text" name="pesquisa"></p>
            <p><input type="submit" name="pesq" value="Pesquisar"class="botao1"></p>
        </form>
        <div class="env">
        <form action="" method="get">
            <p><input type="submit" name="enviar" value="Enviar Email" class="botao2"></p>
            <p><input type="submit" name="caixa" value="Caixa de entrada" class="botao3"></p>
            <p><input type="submit" name="enviados" value="Emails enviados" class="botao4"></p>
        </form>
        </div>
        <div class="logout"><a href="logout.php"><img border="0"src="../img/logout.png" width="100" height="100"></a></div>
        
        </div>

        
        <table class="emails" id="emails">
        <?php
        $files = glob('../xml/mail/*.xml');
        foreach($files as $file) {
            $xml = new SimpleXMLElement ($file, 0 , true );
            $pesquisado = false;
            if(isset($_GET['pesq'])){
                $pesquisado = true;
                $busca = $_GET['pesquisa'];
            }
            if($pesquisado == false){
                if($xml->Remetente == $_SESSION['email']){
                    echo '<tr> <td> <a href="'.$file.'" class="mail"><img border="0"src="../img/open.png" width="35" height="35"></a> </td> ';
                    echo ' <td>'.$xml->Destinatario.'</td>';
                    echo ' <td></td>';
                    echo ' <td> Assunto: </td>';
                    echo ' <td>'.$xml->Titulo.'</td>';
                    echo ' <td class="menor">-</td>';
                    echo ' <td class="menor">'.$xml->Texto.' </td></tr>';
                    
    
            }
            }
            else{
                if($xml->Destinatario == $busca and $xml->Remetente == $_SESSION['email']){
                    echo '<tr> <td> <a href="'.$file.'" class="mail"><img border="0"src="../img/open.png" width="35" height="35"></a> </td> ';
                    echo ' <td>'.$xml->Destinatario.'</td>';
                    echo ' <td></td>';
                    echo ' <td> Assunto: </td>';
                    echo ' <td>'.$xml->Titulo.'</td>';
                    echo ' <td class="menor">-</td>';
                    echo ' <td class="menor">'.$xml->Texto.' </td></tr>';
                    
                
            }
            if($xml->Titulo == $busca and $xml->Destinatario == $_SESSION['email']){
                echo '<tr> <td> <a href="'.$file.'" class="mail"><img border="0"src="../img/open.png" width="35" height="35"></a> </td> ';
                    echo ' <td>'.$xml->Destinatario.'</td>';
                    echo ' <td></td>';
                    echo ' <td> Assunto: </td>';
                    echo ' <td>'.$xml->Titulo.'</td>';
                    echo ' <td class="menor">-</td>';
                    echo ' <td class="menor">'.$xml->Texto.' </td></tr>';
                    
                
            }
            if($xml->Destinatario == $_SESSION['email'] and $busca == ''){
                echo '<tr> <td> <a href="'.$file.'" class="mail"><img border="0"src="../img/open.png" width="35" height="35"></a> </td> ';
                    echo ' <td>'.$xml->Destinatario.'</td>';
                    echo ' <td></td>';
                    echo ' <td> Assunto: </td>';
                    echo ' <td>'.$xml->Titulo.'</td>';
                    echo ' <td class="menor">-</td>';
                    echo ' <td class="menor">'.$xml->Texto.' </td></tr>';
                    
            }
            
        }
        }
        ?>
        </table>
        
    </body>

</html>