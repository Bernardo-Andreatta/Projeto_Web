<?php 
session_start();
if(!isset($_SESSION['email'])){
    echo json_encode("sair");
    die;
}

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
            if($busca == '' and $xml->Remetente == $_SESSION['email']){
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
    