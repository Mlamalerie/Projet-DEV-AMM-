 <?php
session_start();
$_SESSION['ici_index_bool'] = false;
include_once("assets/db/connexiondb.php");
?>

<?php
$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    print_r($_SESSION);
    $okconnectey = true;
} else{
    echo "Pas de connexion";
}
?>

<?php
if (isset($_POST['AppliquerRedu'])) {

    print_r($_POST);
    $code = (String) $_POST['code'];

    $listeCodeRedu = ["WEBEATZ10","BARTHOLOMEW-EISTI"];

    $okredu = false;
    if(in_array($code, $listeCodeRedu)) {
        $okredu = true;
        if($code == $listeCodeRedu[0]) {
            $reduction = 0.1;

        }else if($code == $listeCodeRedu[1]) {
            $reduction = 0.5;

        }
        $_SESSION['AppliquerRedu'] = $code;
    } else {
        unset($_SESSION['AppliquerRedu']);
    }

}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->

        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="Test_Mathieu/panierTestMathieu/affichagepanier.css">
        <link rel="stylesheet" type="text/css" href="assets/css/search.css">
        <link rel="stylesheet" type="text/css" href="assets/css/commande.css">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

        <title>Confirmation de votre commande • WeBeats</title>
        
    </head>
    <body onload="actualiserTOTALTOTAL()">




        <div class="px-4 px-lg-0">
            <!-- For demo purpose -->
            <div class="container text-white py-5 text-center">
                <h1 class="display-4">Panier WeBeats</h1>
                <p class="lead mb-0">Validez votre commande</p>
            </div>
            <!-- End -->

            <div class="pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

                            <?php require_once('assets/skeleton/tablePanier.php'); ?> 
                            <button type="button" onclick="document.location = 'search.php'" class="btn btn-dark rounded-pill py-2 btn-block btn-confirm">Continuer Shopping</button>
                        </div>
                    </div>

                    <div id="sectionRecap" class="row py-5 p-4 bg-white rounded shadow-sm" >
                        <div class="col-lg-6">
                            <div class="text-dark rounded-pill px-4 py-3 text-uppercase font-weight-bold">Code de réduction</div>
                            <div class="p-4">
                                <form action="" method="post">
                                    <p class="font-italic mb-4 text-dark">Si vous en possédez un, entrez votre code ci-dessous</p>
                                    <div class="input-group mb-4 border rounded-pill p-2">
                                        <input name='code' type="text" placeholder="Appliquer le code" aria-describedby="button-addon3" class="form-control border-0">
                                        <div class="input-group-append border-0">
                                            <button id="button-addon3" type="submit" name='AppliquerRedu' value="Appliquer" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Appliquer</button>
                                        </div>
                                    </div>
                                </form>

                                <?php if(isset($reduction)) { ?> 
                                <span>Reduction bien appliquée <?=($reduction*100)."%" ?></span>

                                <?php } else if (isset($_POST['AppliquerRedu'])) { ?>
                                <span class="text-danger">NAda mgl</span>
                                <?php } ?>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="text-dark rounded-pill px-4 py-3 text-uppercase font-weight-bold">Récapitulatif de votre commande </div>
                            <div class="p-4">
                                <p class="font-italic mb-4 text-dark">Attention : aucun remboursement possible après confirmation de votre commande</p>
                                <ul class="list-unstyled mb-4">
                                    <li class="d-flex justify-content-between py-3 border-bottom">

                                        <?php 
                                        $req = $BDD->prepare("SELECT panier_beat_id
                                                                                        FROM panier
                                                                                        WHERE panier_user_id = ?");
                                        $req->execute(array($_SESSION['user_id']));


                                        $listes = $req->fetchAll();

                                        $somme = 0;

                                        foreach($listes as $b) {

                                            $req = $BDD->prepare("SELECT beat_price
                                                                                        FROM beat
                                                                                        WHERE beat_id = ?");
                                            $req->execute(array($b['panier_beat_id']));
                                            $bbbeat = $req->fetchAll();

                                            foreach($bbbeat as $k) {
                                                $somme += $k['beat_price'];

                                            }


                                        }
                                        ?>
                                        <strong class="text-muted">Prix </strong><strong id="TotalPanierCommande" class="text-dark"><?= $somme ?>€</strong>


                                    </li>
                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted text-dark">Réduction appliquée</strong>
                                        <strong id='Reduction'  class="text-dark"> <?php if(!isset($reduction)) { ?> 
                                            0.00€ 
                                            <?php } ?>
                                        </strong>
                                    </li>


                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted  text-uppercase">Total</strong>
                                        <h5 class="font-weight-bold text-dark" id="TOTALTOTAL" ></h5>
                                    </li>

                                    <script>

                                    </script>
                                </ul> 

                                <form id='formConfirmer' action="paiement.php" method="post">
                                    <input type="hidden" name="khalassStp" id="khalassStp">
                                    <button type="button" onclick="document.getElementById('formConfirmer').submit()" href="confirmation.php" class="btn btn-dark rounded-pill py-2 btn-block" name='ConfirmCommande' value='Confirm'>Confirmer</button>

                                </form>

                                <div id="paypal-button-container"></div>
                                <script src="https://www.paypal.com/sdk/js?client-id=Ae0hwalIu4jYQfJOup2Toy5iQHgLlK84Upq3nYmfD6y7UeQgyJDRrFOv-yI2IJZXUXhiXKhhPMhph1XV&currency=EUR" data-sdk-integration-source="button-factory"></script>
                            

                                <?php require_once("assets/functions/js-panier.php"); ?>
                                <span class="text-dark" id="waitRedirigey"></span>
                            </div>
                        </div>
                    </div>

                  

                </div>
            </div>
        </div>


        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>




    </body>
</html>