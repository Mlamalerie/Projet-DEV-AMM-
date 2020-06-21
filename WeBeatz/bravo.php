<?php
session_start();
$_SESSION['ici_index_bool'] = false;
include_once("assets/db/connexiondb.php");

$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    
    $okconnectey = true;
}  else {
    header('Location: connexion.php');
    exit;
}

if(isset($_GET['n'])) {
    $nxn = (int) $_GET['n'];
} else {
    $nxn = 0;
}

//$okkhalass = false;
//if(isset($_SESSION['khalassStp'])) {
//    $okkhalass = true;
//    unset($_SESSION['khalassStp']);
//    
//}

?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
        <?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>

        <link rel="stylesheet" type="text/css" href="assets/css/search.css">
        <link rel="stylesheet" type="text/css" href="assets/css/bravo.css">

        


        <title>Confirmation de votre commande | WeBeats</title>
    </head>
    <body onload=" refreshNbPanier();refreshAllBeats()">
    <?php require_once('assets/functions/js-paiement.php'); ?>
    <?php require_once("assets/functions/js-panier.php"); ?>
    

        <div class="px-4 px-lg-0">
            <!-- For demo purpose -->
            <div class="container text-white py-5 text-center">
                <h1 class="display-4">C'est bon ! Tout c'est bien passé </h1>
                <p class="lead mb-0"> Merci de votre confiance. Vous pouvez maintenant télécharger vos achat :) </p>
            </div>
            <!-- End -->

            <div class="pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 p-5 bg-warning rounded shadow-sm mb-5">
                            <?php
                            $lim = $nxn;

                            ?>

                            <?php require_once('assets/skeleton/tableAchats.php'); ?>
                            <br/>
                            <br/>
                            <!-- Shopping cart table -->
                            <div class="table-responsive">
                                <table class="table">
                                    <div> Votre commande a bien été effectuée. Vous recevrez un mail de confirmation à l'adresse <?php echo $_SESSION['user_email']; ?> </div>
                                    <br/>
                                    <button type="submit" onclick="document.location = 'search.php?Type=beats'" class="btn btn-primary btn-fini rounded-pill">Continuer mon shopping</button>
                                    <br/>
                                    <br/>
                                    <button type="submit" onclick="document.location = 'index.php'" class="btn btn-primary btn-fini rounded-pill">Retourner à l'accueil</button>

                                </table>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
        
<?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>




    </body>
</html>