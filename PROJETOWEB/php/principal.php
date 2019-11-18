<?php 
session_start();
if(!isset($_SESSION['email'])){
    echo json_encode("sair");
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
                if($xml->Destinatario == $_SESSION['email']){
                    $linha[$count]["url"] = $file;
                    $linha[$count]["remetente"] = trim($xml->Remetente);
                    $linha[$count]["titulo"] = trim($xml->Titulo);
                    $linha[$count]["texto"] = trim($xml->Texto);
                    $count++;
                }
            }
            else{
                if($xml->Remetente == $busca and $xml->Destinatario == $_SESSION['email']){
                    $linha[$count]["url"] = $file;
                    $linha[$count]["remetente"] = trim($xml->Remetente);
                    $linha[$count]["titulo"] = trim($xml->Titulo);
                    $linha[$count]["texto"] = trim($xml->Texto);
                    $count++;
            }
            if($xml->Titulo == $busca and $xml->Destinatario == $_SESSION['email']){
                    $linha[$count]["url"] = $file;
                    $linha[$count]["remetente"] = trim($xml->Remetente);
                    $linha[$count]["titulo"] = trim($xml->Titulo);
                    $linha[$count]["texto"] = trim($xml->Texto);
                    $count++;
            }
            if($xml->Destinatario == $_SESSION['email'] and $busca == ''){
                    $linha[$count]["url"] = $file;
                    $linha[$count]["remetente"] = trim($xml->Remetente);
                    $linha[$count]["titulo"] = trim($xml->Titulo);
                    $linha[$count]["texto"] = trim($xml->Texto); 
                    $count++;
                }
                
            }
            
        }
        echo json_encode($linha);
?>
    