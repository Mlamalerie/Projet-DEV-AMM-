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


        <title>T'as aimé ?</title>
    </head>
    <body>

        <ul class="list-inline small">
            <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
            <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
            <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
            <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
            <li class="list-inline-item m-0"><i class="fa fa-star-o text-gray"></i></li>
        </ul>


        <?php
        require_once('assets/skeleton/endLinkScripts.php');
        ?>


    </body>
</html>