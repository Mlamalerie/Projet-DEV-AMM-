<?php
session_start();
$_SESSION['ici_index_bool'] = false;
include_once("assets/db/connexiondb.php");
$prix = $_POST['khalassCa'];
print_r($_POST);
if($prix == 0){     
    header('Location: bravo.php');      
    exit(); 
}
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

<?php require_once("assets/functions/js-panier.php"); ?>

!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->


        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="Test_Mathieu/panierTestMathieu/affichagepanier.css">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>



        <title>Confirmation de votre commande | WeBeats</title>
    </head>
    <body>


        <style>

            body {
                background: linear-gradient(to right, #13161a, #7327ad)!important;
                background: -webkit-linear-gradient(to right, #eecda3, #ef629f);
                background: linear-gradient(to right, #eecda3, #ef629f);
                min-height: 100vh;
            }
        </style>






        <div class="px-4 px-lg-0">
            <!-- For demo purpose -->
            <div class="container text-white py-5 text-center">
                <h1 class="display-4">Panier WeBeats</h1>
                <p class="lead mb-0">Confirmation de commande</p>
            </div>
            <!-- End -->

            <div class="pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

                            <!-- Shopping cart table -->
                            <div class="table-responsive">
                                <table class="table">
                                    <div>Montant à payer : <?php echo $prix; ?> &euro; </div>
                                </table>
                            </div>


                            <div id="paypal-button-container"></div>
                            <script src="https://www.paypal.com/sdk/js?client-id=Ae0hwalIu4jYQfJOup2Toy5iQHgLlK84Upq3nYmfD6y7UeQgyJDRrFOv-yI2IJZXUXhiXKhhPMhph1XV&currency=EUR" data-sdk-integration-source="button-factory"></script>

                            <script>
                                paypal.Buttons({
                                    style: {
                                        shape: 'pill',
                                        color: 'blue',
                                        layout: 'horizontal',
                                        label: 'pay',

                                    },
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
                                            setTimeout(redir("bravo.php"),2000);
                                        });
                                    }
                                }).render('#paypal-button-container');
                            </script>



                            <!-- End -->
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>




    </body>
</html>