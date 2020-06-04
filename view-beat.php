<?php
session_start();
$_SESSION['ici_index_bool'] = false;
include_once("assets/db/connexiondb.php");
$beat_id = (int)$_GET['id'];

$req = $BDD -> prepare("SELECT * FROM beat WHERE beat_id = ?");
$req->execute(array($beat_id));
$instru = $req->fetch();





?>

<!DOCTYPE html>
<html lang="fr">
    <head>
       <meta charset="utf-8">
        <title>Détail de la prod <?= $instru['beat_title'] ?></title>
        <?php
            require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <style>
            .container{
                background:  #7728b2;
                color: white;
            }
            .image_beat{
                display: block; /*centrer image*/
                margin-left: auto;
                margin-right: auto;
                width: 300px;
               
            }
            .info{
                display: block;
                margin-left: auto;
                margin-right: auto;
                background: black;
                color: #7728b2;
                text-align: center;
            }
            .btn-ajout_panier{
                background-color: #7728b2;
                border-color: #7728b2;
            }
        </style>
    </head>
    <body>
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
