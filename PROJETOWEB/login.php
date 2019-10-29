<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/estilo.css?v=<?php echo time(); ?>">
        <title>Login</title>
    </head>


    <body>
            <?php
                $error = false;
                if(isset($_POST['login'])){
                   $email = $_POST['email'];
                   $senha = $_POST['senha'];
                   if(file_exists('xml/'.$email.'.xml')){
                        $xml = new SimpleXMLElement ('xml/'.$email.'.xml', 0 , true );
                        if($senha == $xml->senha){
                            session_start();
                            $_SESSION['email'] = $email;
                            header('Location: principal.php');
                            die;
                        }
                   }
                $error = true;
               }
            ?>

            <?php
                if(isset($_POST['cadastrar'])){
                    header('Location: cadastrar.php');
                }
            ?>

        <div class="divBox">
           

                <div class="divBackground"></div>

                <div ><img class="divLogo" src="img/logo.png" alt="Logo"></div>

                <div>
                        <h1><text class="cyan">Cyan</text>Mail</h1><br>
                        <h2>Bem vindo de volta!<br> Acesse sua conta para ver seus emails!</h2>
                </div>

                <div>
                    <form action="" method="post">
                        <input id="tEmail" type="text" placeholder="E-mail" name="email" class="divInput1"><br>
                    
                        <input id="tSenha" type="password" placeholder="Senha" name="senha" class="divInput2">

                        <input type="submit" class="botao" name='login' value = "Login">

                        <input type="submit" class="botao2" name='cadastrar' value = " Logon">

                    </form>
        </div>

    </body>

</html>