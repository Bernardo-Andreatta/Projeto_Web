<?php 
session_start();
if(!file_exists('../xml/'. $_SESSION['email'].'.xml')){
    header('Location: ../paginas/login.html');
    die;
}

$xml = new SimpleXMLElement ('../xml/'.$_SESSION['email'].'.xml', 0 , true );
$usuario = $xml->usuario;
$count = 0;
$linha = array();

        $files = glob('../xml/mail/*.xml');
        foreach($files as $file) {
            $xml = new SimpleXMLElement ($file, 0 , true );
            $pesquisado = false;

            if (isset($_POST['ajax_pesquisa'])){
                $pesquisado = true;
                $busca = $_POST['ajax_pesquisa'];
            }

            if($pesquisado == false){
                if($xml->Remetente == $_SESSION['email']){
                    $linha[$count]["url"] = $file;
                    $linha[$count]["destinatario"] = trim($xml->Destinatario);
                    $linha[$count]["titulo"] = trim($xml->Titulo);
                    $linha[$count]["texto"] = trim($xml->Texto);
                    $count++;
                }
            }
            else{
                if($xml->Destinatario == $busca and $xml->Remetente == $_SESSION['email']){
                    $linha[$count]["url"] = $file;
                    $linha[$count]["destinatario"] = trim($xml->Destinatario);
                    $linha[$count]["titulo"] = trim($xml->Titulo);
                    $linha[$count]["texto"] = trim($xml->Texto);
                    $count++;
            }
            if($xml->Titulo == $busca and $xml->Remetente == $_SESSION['email']){
                $linha[$count]["url"] = $file;
                $linha[$count]["destinatario"] = trim($xml->Destinatario);
                $linha[$count]["titulo"] = trim($xml->Titulo);
                $linha[$count]["texto"] = trim($xml->Texto);
                $count++;
            }
            if($xml->Remetente == $_SESSION['email'] and $busca == ''){
                $linha[$count]["url"] = $file;
                $linha[$count]["destinatario"] = trim($xml->Destinatario);
                $linha[$count]["titulo"] = trim($xml->Titulo);
                $linha[$count]["texto"] = trim($xml->Texto);
                $count++;
                }
                
            }
            
        }
        echo json_encode($linha);
?>
    