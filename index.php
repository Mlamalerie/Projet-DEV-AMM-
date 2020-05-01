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
        
            
        










        <!--   *************************************************************  -->
        <!--   ************************** FOOTER  **************************  -->


        <footer class="page-footer font-small stylish-color-dark pt-4">
            <!-- Liens Footer -->
            <div class="container text-center text-md-left">
                <!-- Lignes -->
                <div class="row">
                    <!-- Colonnes -->
                    <div class="col-md-4 mx-auto">
                        <!-- Contenu -->
                        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Footer Content</h5>
                        <p>Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet,
                         consectetur
                        adipisicing elit.</p>











            </div>
            






        </footer>






        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>