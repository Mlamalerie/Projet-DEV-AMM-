<?php
session_start();
$_SESSION['ici_index_bool'] = false;
include_once("assets/db/connexiondb.php");
  unset($_SESSION['AppliquerRedu']);
?>

<?php
$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    print_r($_SESSION);
    $okconnectey = true;
} else{
    echo "Pas de connexion";
}



$okkhalass = true;

?>

<?php require_once("assets/functions/js-panier.php"); ?>

!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
<?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="Test_Mathieu/panierTestMathieu/affichagepanier.css">
        <link rel="stylesheet" type="text/css" href="assets/css/bravo.css">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>



        <title>Confirmation de votre commande | WeBeats</title>
    </head>
    <body>


        <div class="px-4 px-lg-0">
            <!-- For demo purpose -->
            <div class="container text-white py-5 text-center">
                <h1 class="display-4">WeBeatz</h1>
                <p class="lead mb-0">Merci de votre confiance</p>
            </div>
            <!-- End -->

            <div class="pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                           
                            <?php if($okkhalass) {require_once('assets/skeleton/tableCommande.php'); } else {echo "tu veux douillez qui ?";}?>
                            <br/>
                            <br/>
                            <!-- Shopping cart table -->
                            <div class="table-responsive">
                                <table class="table">
                                    <div> Votre commande a bien été effectuée. Vous recevrez un mail de confirmation à l'adresse <?php echo $_SESSION['user_email']; ?> </div>
                                    <br/>
                                    <button type="submit" onclick="document.location = 'search.php'" class="btn btn-primary btn-fini rounded-pill">Continuer mon shooping</button>
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


        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>




    </body>
</html>