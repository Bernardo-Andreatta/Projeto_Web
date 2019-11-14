<?php 
session_start();
if(!file_exists('../xml/'. $_SESSION['email'].'.xml')){
    header('Location: ../paginas/login.html');
    die;
}

$xml = new SimpleXMLElement ('../xml/'.$_SESSION['email'].'.xml', 0 , true );
$usuario = $xml->usuario;
echo 'Bem<text class="vindo"> Vindo </text><br>'.$usuario;

$linha = array();
$count = 0;

        $files = glob('../xml/mail/*.xml');
        foreach($files as $file) {
            $xml = new SimpleXMLElement ($file, 0 , true );
            $pesquisado = false;

           
            if($pesquisado == false){
                if($xml->Destinatario == $_SESSION['email']){
                    $linha[$count]["url"] = $file;
                    $linha[$count]["remetente"] = $xml->Remetente;
                    $linha[$count]["titulo"] = $xml->Titulo;
                    $linha[$count]["texto"] = $xml->Texto;
                }
            }
            else{
                if($xml->Remetente == $busca and $xml->Destinatario == $_SESSION['email']){
                    $linha[$count]["url"] = $file;
                    $linha[$count]["remetente"] = $xml->Remetente;
                    $linha[$count]["titulo"] = $xml->Titulo;
                    $linha[$count]["texto"] = $xml->Texto;
            }
            if($xml->Titulo == $busca and $xml->Destinatario == $_SESSION['email']){
                    $linha[$count]["url"] = $file;
                    $linha[$count]["remetente"] = $xml->Remetente;
                    $linha[$count]["titulo"] = $xml->Titulo;
                    $linha[$count]["texto"] = $xml->Texto;
            }
            if($xml->Destinatario == $_SESSION['email'] and $busca == ''){
                    $linha[$count]["url"] = $file;
                    $linha[$count]["remetente"] = $xml->Remetente;
                    $linha[$count]["titulo"] = $xml->Titulo;
                    $linha[$count]["texto"] = $xml->Texto;  
                }
            }
            $count++;
        }
        echo json_encode($linha);
?>
    