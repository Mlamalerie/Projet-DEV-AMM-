<?php
session_start();
include_once("assets/db/connexiondb.php");

$_SESSION['ici_index_bool'] = false;

$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    $okconnectey = true;

} 
?>






<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <script src="https://kit.fontawesome.com/8157870d7a.js" crossorigin="anonymous"></script>
        <!--        <link rel="stylesheet" type="text/css" href="assets/css/styles-index.css"> -->
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">


        <link rel="stylesheet" type="text/css" href="assets/css/about-us.css">

        <title>about-us</title>
    </head>
    <body>      


        <style>
            .social-link {
                width: 30px;
                height: 30px;
                border: 1px solid #ddd;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #666;
                border-radius: 50%;
                transition: all 0.3s;
                font-size: 0.9rem;
            }

            .social-link:hover,
            .social-link:focus {
                background: #ddd;
                text-decoration: none;
                color: #555;
            }

            .bg-abus{
                background-color: var(--base-colorDark1);
            }
        </style>







        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->

        <?php
        require_once('assets/skeleton/navbar.php');
        ?>


        <div class="bg-light bg-abus">
            <div class="container py-5">
                <div class="row h-100 align-items-center py-5">
                    <div class="col-lg-6">
                        <h1 class="display-4">A propos de nous</h1>
                        <p class="lead text-muted mb-0">WeBeatz est né d'un projet commun entre trois étudiants de CY Tech à Cergy-Pontoise.
                            En créant WeBeatz, nous souhaitions faciliter les échanges entre les beatmakers et les chanteurs/rappeurs.<p/>
                        <h2>Trouver les artistes de demain</h2>
                        <p class="lead text-muted mb-0">Un de nos souhaits était de faire de WeBeatz un lieu de partage, où les musiciens pouvait poursuivre leur passion pour la musique, faire des rencontres, et gagner en visibilité. Faire de notre site où seront révélés les artistes de demain.<p/>
                        <h2>Rejoignez-nous !</h2>
                        <p class="lead text-muted mb-0">Inscrivez-vous sur notre site et faites partie d'une nouvelle communauté d'artistes. Ecoutez gratuitement les beats en vente sur le site, entrez en contact avec d'autre membres du site. WeBeatz joue le rôle de plateforme communautaire. En tant que membre, vous avez la possibilité de suivre d'autres utilisateurs, de les bloquer et de leur envoyer des messages.<p/>
                        
                    </div>
                    <div class="col-lg-6 d-none d-lg-block"><img src="assets/img/tracks3.jpg" alt="" class="img-fluid"></div>
                </div>
            </div>
        </div>



        <div class="bg-light bg-abus py-5">
            <div class="container py-5">
                <div class="row mb-4">
                    <div class="col-lg-5">
                        <h2 class="display-4 font-weight-light">Notre équipe</h2>
                        <p class="font-italic text-muted">Les personnes ayant contribuées à la réalisation du site.</p>
                    </div>
                </div>

                <div class="row text-center">
                    <!-- Team item-->
                    <div class="col-xl-3 col-sm-6 mb-5">
                        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556834132/avatar-4_ozhrib.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Mlamali SAID SALIMO</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
                            <ul class="social mb-0 list-inline mt-3">
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End-->

                    <!-- Team item-->
                    <div class="col-xl-3 col-sm-6 mb-5">
                        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="assets/img/icon/pencil.svg" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Mathieu CISSE</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
                            <ul class="social mb-0 list-inline mt-3">
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End-->

                    <!-- Team item-->
                    <div class="col-xl-3 col-sm-6 mb-5">
                        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556834133/avatar-2_f8dowd.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Ari RAJAOFERA</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
                            <ul class="social mb-0 list-inline mt-3">
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End-->

                </div>
            </div>
        </div>


        <footer class="bg-light bg-abus pb-5">
            <div class="container text-center">
                <p class="font-italic text-muted mb-0">&copy; 2020 WeBeats All rights reserved.</p>
            </div>
        </footer>



    </body>
</html>
