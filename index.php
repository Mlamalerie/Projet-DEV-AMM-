<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <title>WeBeats</title>
    </head>
    <body>
        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->

        <?php
        require_once('skeleton/menu.php');
        ?>

        <!--   *************************************************************  -->
        <!--   ************************** HEADER  **************************  -->

        <header>
            <div class="overlay-sombre"></div>
            <video id="BACKGROUNDVIDEO1" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
                <source src="https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4" type="video/mp4">
            </video>
            <div class="container h-100">
                <div class="d-flex h-100 text-center align-items-center">
                    <div class="w-100 text-white">
                        <h1 class="display-3">Développez vos sons</h1>
                        <p class="lead mb-0">Découvrez et Partagez les prods de vos choix</p>
                        <p class="lead mb-0">Pour pouvoir acheter ou vendre des prods  <a href="inscription.php"><button type="button" class="btn btn-danger" >Inscrivez-vous</button></a></p>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- ******* Section 1 -->
        <section class="py-5 d-flex align-items-center" id="one">
            <div class="container py-5">
                <div class="row text-center">
                    <div class="col-lg-9 mx-auto">
                        <h2 class="h1 mb-4">Les Produits Tendances du Moment</h2>
                        <p class="font-italic mb-4 text-muted">Ici on mettra les prods Tendances</p>
                        <a class="btn btn-outline-light px-4 rounded-0 scroll-top" href="#">Back to top</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2-->
        <section class="py-5 d-flex align-items-center" id="two">
            <div class="container py-5">
                <div class="row text-center">
                    <div class="col-lg-9 mx-auto">
                        <h2 class="h1 mb-4">TOP des ventes</h2>
                        <p class="font-italic mb-4 text-muted">On fera une liste avec les produits les vendus.</p>
                        <a class="btn btn-outline-light px-4 rounded-0 scroll-top" href="#">Back to top</a>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Section 3 -->
        <section class="py-5 d-flex align-items-center" id="three">
            <div class="container py-5">
                <div class="row text-center">
                    <div class="col-lg-9 mx-auto">
                        <h2 class="h1 mb-4">Comment ça marche?</h2>
                        <p class="font-italic mb-4 text-muted">Descritption du fonctionnement du site</p>
                        <a class="btn btn-outline-light px-4 rounded-0 scroll-top" href="#">Back to top</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section 4 -->
        <section class="py-5 d-flex align-items-center" id="four">
            <div class="container py-5">
                <div class="row text-center">
                    <div class="col-lg-9 mx-auto">
                        <h2 class="h1 mb-4">Meilleur Producteur</h2>
                        <p class="font-italic mb-4 text-muted">Liste des profils des producteurs</p>
                        <a class="btn btn-outline-light px-4 rounded-0 scroll-top" href="#">Back to top</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section 5 -->
        <section class="py-5 d-flex align-items-center" id="five">
            <div class="container py-5">
                <div class="row text-center">
                    <div class="col-lg-9 mx-auto">
                        <h2 class="h1 mb-4">Témoignages</h2>
                        <p class="font-italic mb-4 text-muted">Blablatez sur notre</p>
                        <a class="btn btn-outline-light px-4 rounded-0 scroll-top" href="#">Back to top</a>
                    </div>
                </div>
            </div>
        </section>
       
            
        










        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>