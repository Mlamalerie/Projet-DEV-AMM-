<?php
session_start();

$_SESSION['ici_index_bool'] = false;

// si une connection est détecter : (ta rien a faire ici mec)
if(!isset($_SESSION['user_id'])){
    header('Location: test_zone.php');
    exit;
}
?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

       <?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
        
        
        <title>Dash BOard</title>
    </head>
    <body>
        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->
        <?php
        require_once('assets/skeleton/navbar.php');
        ?>

       <br><br><br><br> Ici c'est l'index des connectés
        <?php
        if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
            print_r($_SESSION);
        } else{
            print_r("<br/><br/><br><br>Pas de connexion");
        }
        ?>
        


        <?php
        require_once('assets/skeleton/endLinkScripts.php');
        ?>
        
        
    </body>
</html>