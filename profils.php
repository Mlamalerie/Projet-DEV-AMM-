<?php
session_start();

include('assets/db/connexiondb.php');
/*active ça si tu veux pas te voir dans la lsite si t'es connecté*/
/*if(isset($_SESSION['id'])){
    $afficher_membres =$BDD->prepare("SELECT * FROM user WHERE id <> ?");
} 
else{
    $afficher_membres =$BDD->prepare("SELECT * FROM user");
}*/

$afficher_membres =$BDD->prepare("SELECT * FROM user");

/*$afficher_membres->execute(array($_SESSION['user_id']));*/
$afficher_membres->execute();
?>


<!DOCTYPE html>
<html>
    <head>
        <?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <title>Profils</title>
        <link rel="stylesheet" type="text/css" src="assets/css/profils.css">



    </head>
    <body>
        <div class="container">
            <div class="row">
                <?php
                foreach($afficher_membres as $am){
                    echo "<div class='col-sm-3'>".$am['user_pseudo'];
                }
                ?>
            </div>
        </div>












        <?php
        require_once('assets/skeleton/endLinkScripts.php');
        ?>

    </body>
</html>