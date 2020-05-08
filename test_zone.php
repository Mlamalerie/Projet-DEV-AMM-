<?php
session_start();


?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

       <?php
        require_once('skeleton/headLinkCSS.php');
        ?>
        <link rel="stylesheet" type="text/css" href="css/navbar.css">
        
        
        <title>Dash BOard</title>
    </head>
    <body>
        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->
        <?php
        require_once('skeleton/menu.php');
        ?>

        Ici c'est l'index des connecté
        <?php
        if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
            print_r($_SESSION);
        } else{
            echo "Pas de connexion";
        }
        ?>
        


        <?php
        require_once('skeleton/endLinkScripts.php');
        ?>
        
        
    </body>
</html>