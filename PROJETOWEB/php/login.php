
<?php
    $error = false;

        $email = $_POST['ajax_email'];
        $senha = $_POST['ajax_senha'];
        
        if(file_exists('../xml/'.$email.'.xml') and $error==false){
            $xml = new SimpleXMLElement ('../xml/'.$email.'.xml', 0 , true );
            if($senha == $xml->senha and $error==false){
                session_start();
                $_SESSION['email'] = $email;
                echo json_encode ("success");
                die;
            }
            else{
                $error = true;
            }
        }
        else{
        $error = true;
        }
        if ($error == true){
            echo json_encode ("error");
        }
?>