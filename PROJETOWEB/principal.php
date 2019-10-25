<?php 
session_start();
if(!file_exists('xml/'. $_SESSION['email'].'.xml')){
    header('Location: login.php');
    die;
}
?>


<html>
    <head>
        <title>Pagina do Usuario</title>
    </head>

    <body>
            <h1> oi <?php echo $_SESSION['email'];?> </h1>
            <a href="logout.php">Logout</a>
    </body>

</html>