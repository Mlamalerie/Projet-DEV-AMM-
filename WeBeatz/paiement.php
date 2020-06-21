<?php
session_start();
$_SESSION['ici_index_bool'] = false;
include_once("assets/db/connexiondb.php");


$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {

    $okconnectey = true;
} else{
    echo "Pas de connexion";
}

$reduction = 0.0;
if (isset($_SESSION['AppliquerRedu'])) {


    $code = (String) $_SESSION['AppliquerRedu'];

    $listeCodeRedu = ["WEBEATZ10","BARTHOLOMEW-EISTI"];

    $okredu = false;
    if(in_array($code, $listeCodeRedu)) {
        $okredu = true;
        if($code == $listeCodeRedu[0]) {
            $reduction = 0.1;

        }else if($code == $listeCodeRedu[1]) {
            $reduction = 0.5;

        }
    } else {
        $reduction = 0.0;
    }

}


// ** verif prix total
$req = $BDD->prepare("SELECT *
                            FROM panier
                            WHERE panier_user_id = ?");
$req->execute(array($_SESSION['user_id']));
$resuPANIER = $req->fetchAll();
$somme = 0;
$nb = 0;
foreach($resuPANIER as $p) {

    $req = $BDD->prepare("SELECT beat_price
                                            FROM beat
                                            WHERE beat_id = ?");
    $req->execute(array($p['panier_beat_id']));
    $resuPAN = $req->fetchAll();

    foreach($resuPAN as $b) {       
        $nb++;
        $somme = $somme + $b['beat_price']; 


    }
}


$prix = round($somme * (1-$reduction),2);

//if($prix == 0){     
//    header('Location: bravo.php?n='.$nb);      
//    exit(); 
//}


?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->


        <?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>

        <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">



        <title>Paiement • WeBeatz</title>
    </head>
    <body id="top" >


        <div class="px-4 px-lg-0">
            <!-- For demo purpose -->
            <div class="container text-white py-5 text-center">
                <h1 class="display-4">Paiement</h1>
                <p class="lead mb-0">Confirmation de commande</p>
            </div>
            <!-- End -->

            <div class="pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

                            <!-- Bouton acheter paypal, affiche le prix à payer -->
                            <div class="table-responsive">
                                <table class="table">
                                    <div>Montant à payer : <?php echo $prix; ?> &euro; </div>
                                </table>
                            </div>

                            <div id="paypal-button-container"></div>
                            <script src="https://www.paypal.com/sdk/js?client-id=Ae0hwalIu4jYQfJOup2Toy5iQHgLlK84Upq3nYmfD6y7UeQgyJDRrFOv-yI2IJZXUXhiXKhhPMhph1XV&currency=EUR" data-sdk-integration-source="button-factory"></script>
                            <?php require_once("assets/functions/js-panier.php"); ?>
                            <?php require_once("assets/functions/js-paiement.php"); ?>

                            <!-- End -->

                            <!-- Script affichage de PayPal Sandbox-->
                            <script>

                                <?php if ($prix != 0.00) { ?>
                                paypal.Buttons({
                                    style: {
                                        shape: 'pill',
                                        color: 'blue',
                                        layout: 'horizontal',
                                        label: 'pay',

                                    },
                                    // La page PayPal prend en valeur le montant du panier (avec réduction s'il y a)
                                    createOrder: function(data, actions) {
                                        return actions.order.create({
                                            purchase_units: [{
                                                amount: {
                                                    value: '<?php echo $prix; ?>'
                                                }
                                            }]
                                        });
                                    },
                                    onApprove: function(data, actions) {
                                        return actions.order.capture().then(function(details) {
                                            alert('Transaction effectuée !');

                                            ToutEstBonTransac('<?=$nb?>') ;

                                        });
                                    }
                                }).render('#paypal-button-container');

                                <?php } else {?>
                                alert('free');
                                ToutEstBonTransac('<?=$nb?>') ;
                                <?php } ?>
                            </script>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <?php
        require_once('assets/skeleton/endLinkScripts.html');
        ?>



    </body>
</html>