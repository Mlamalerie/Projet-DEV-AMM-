<?php
session_start();
$_SESSION['ici_index_bool'] = false;
include_once("assets/db/connexiondb.php");
$beat_id = (int)$_GET['id'];

$req = $BDD -> prepare("SELECT * FROM beat WHERE beat_id = ?");
$req->execute(array($beat_id));
$instru = $req->fetch();

$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    print_r($_SESSION);
    $okconnectey = true;
} else{
    echo "Pas de connexion";
}



?>

<!DOCTYPE html>
<html lang="fr">
    <head>
      <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
       <meta charset="utf-8">
        <title>Détail de la prod <?= $instru['beat_title'] ?></title>
        <?php
            require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <style>
            
            body{
                background: rgb(242, 242, 242);
            }
            
            .container{
                background:  #8828b2;
                color: white;
                width: 100%;
            }
            .image_beat{
                display: block; /*centrer image*/
                margin-left: auto;
                margin-right: auto;
                width: 200px;
               
            }
            .info{
                display: block;
                margin-left: auto;
                margin-right: auto;
                background: none;
                color: white;
                text-align: center;
            }
            .btn-ajout_panier{
                background-color: #7728b2;
                border-color: #7728b2;
            }
        </style>
    </head>
    <body>
            <!--   ************************** NAVBAR  **************************  -->

        <?php

        require_once('assets/skeleton/navbar.php');
        ?>
            <!-- image source info -->
        <div class="container">
           
            <div>
                <img src="<?= $instru['beat_cover']?>" class="col-md-6 image_beat">
            </div>
                
           
            <div class="col-md-6 info">
                <h2>Titre : <?= $instru['beat_title']?> </h2>
                <h3>Auteur :  <?= $instru['beat_author']?></h3>
                <p> Description : <?= $instru['beat_description'] ?> </p>
                <h4> Prix : <?= $instru['beat_price'] ?>€</h4>
                
                <button type="button" class="btn btn-danger btn-ajout_panier" >Ajouter au panier</button>
                
                
            </div>
            
        </div>    

        
        
    </body>
    
</html>
