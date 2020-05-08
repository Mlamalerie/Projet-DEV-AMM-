<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name='description' content="Site Responsive Hotel ">

        <?php
        require_once('skeleton/headLinkCSS.php');
        ?>
        <link rel="stylesheet" type="text/css" href="css/styles-index.css"> 
        <link rel="stylesheet" type="text/css" href="css/navbar.css"> 
        <link rel="stylesheet" type="text/css" href="css/navbar-index-turfu.css"> 

        <!--        LOGo -->
        <link rel="shortcut icon" href="img/bigmetro.jpg">

        <!--        PACK DE ICON -->
        <script src="https://kit.fontawesome.com/8157870d7a.js" crossorigin="anonymous"></script>




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
            <video id="BACKGROUNDVIDEO1" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"><!--fond d'écran animé--> 
                <source src="https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4" type="video/mp4">
            </video>
            <div class="container h-100">
                <div class="d-flex h-100 text-center align-items-center">
                    <div class="w-100 text-white">
                        <h1 class="display-3">Développez vos sons</h1>
                        <p class="lead mb-0">Découvrez et Partagez les prods de vos choix</p>
                        <p class="lead mb-0">Pour pouvoir acheter ou vendre des prods  <a href="inscription.php"><button type="button" class="btn btn-danger btninscription" >Inscrivez-vous</button></a></p><br/>
                        <div class="searchbar">
                            <input class="search_input" type="text" placeholder="Recherchez vos musiques, artistes...">
                            <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </header>
        <!--   ************************** PARTIE MLAMALI TEST CALA PAS  **************************  -->
        <?php
        if(isset($_SESSION['user_id'])) {
            print_r($_SESSION);
        } else{
            echo "Pas de connexion <br>";
            echo "Pas de connexion <br>";
            echo "Pas de connexion <br>";
            echo "Pas de connexion <br>";
            echo "Pas de connexion <br>";
            echo "Pas de connexion <br>";
            echo "Pas de connexion <br>";

        }
        ?>


        <!--   *************************************************************  -->
        <!--   ************************** SECTION 1  ***********************  -->
        <!-- ******* Section 1 -->
        <section class="py-5 d-flex align-items-center" id="one">
            <div class="container py-5">
                <div class="row text-center">
                    <div class="col-lg-9 mx-auto" id="tendances">
                        <h2 class="h1 mb-4  ">Les Produits Tendances du Moment</h2>
                        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="img/CG6.png" class="d-block w-100 image_sons"  alt="..." >
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Nom de la prod : </h5>
                                        <p>Nom du producteur : </p>
                                        <button class="btn btn-danger btn-circle btn-circle-xl m-1 btnplay" ><i class="fa fa-play"></i></button>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="img/DB5.jpg" class="d-block w-100 image_sons" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Nom de la prod : </h5>
                                        <p>Nom du producteur : </p>
                                        <button class="btn btn-danger btn-circle btn-circle-xl m-1 btnplay"  ><i class="fa fa-play"></i></button>
                                    </div>
                                </div>
                                <div class="carousel-item">

                                    <img src="img/MILS.jpg" class="d-block w-100 image_sons" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Nom de la prod : </h5>
                                        <p>Nom du producteur : </p>
                                        <button class="btn btn-danger btn-circle btn-circle-xl m-1 btnplay" ><i class="fa fa-play"></i></button>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2-->
        <section class="py-5 d-flex align-items-center" id="two">
            <div class="container py-5">
                <div class="row text-center">
                    <div class="col-lg-9 mx-auto" id="topventes">
                        <h2 class="h1 mb-4  " >TOP des ventes</h2>

                        <div id="carouselExampleCaptions1" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleCaptions1" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleCaptions1" data-slide-to="1"></li>
                                <li data-target="#carouselExampleCaptions1" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="img/roddy.jpg" class="d-block w-100 image_sons"  alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Nom de la prod : </h5>
                                        <p>Nom du producteur : </p>
                                        <button class="btn btn-danger btn-circle btn-circle-xl m-1 btnplay"  ><i class="fa fa-play"></i></button>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="img/bigmetro.jpg" class="d-block w-100 image_sons"  alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Nom de la prod : </h5>
                                        <p>Nom du producteur : </p>
                                        <button class="btn btn-danger btn-circle btn-circle-xl m-1 btnplay" ><i class="fa fa-play"></i></button>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="img/luv.jpg" class="d-block w-100 image_sons"  alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Nom de la prod : </h5>
                                        <p>Nom du producteur : </p>
                                        <button class="btn btn-danger btn-circle btn-circle-xl m-1 btnplay"  ><i class="fa fa-play"></i></button>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaptions1" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaptions1" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- Section 3 -->
        <section class="py-5 d-flex align-items-center" id="three">
            <div class="container py-5">
                <div class="row text-center">
                    <div class="col-lg-9 mx-auto" id="ccm">
                        <h2 class="h1 mb-4  " >Comment ça marche?</h2>

                        <div id="recherchez">
                            <h3>Recherchez</h3>
                            <p> Retrouvez de nombreuses productions au sein de notre catalogue.</p>
                            <img src="https://airbit.com/img/landing-pages/buy-beats/how-it-works/browse.svg">
                        </div>
                        <div id="achetez">
                            <h3>Achetez</h3>
                            <p>Choisissez la licence qui vous convient et ajoutez la au panier.</p>
                            <img src="https://airbit.com/img/landing-pages/buy-beats/how-it-works/buy.svg" width="100">
                        </div>
                        <div id="creez">
                            <h3>Créez</h3>
                            <p>Uploadez vos créations sur notre site et rejoignez de nombreux beatmakers</p>
                            <img src="https://airbit.com/img/landing-pages/buy-beats/how-it-works/create.svg">
                        </div>


                    </div>
                </div>
            </div>
        </section>
        <!-- Section 4 -->
        <section class="py-5 d-flex align-items-center" id="four">
            <div class="container py-5">
                <div class="row text-center">
                    <div class="col-lg-9 mx-auto" id="bestprod">
                        <h2 class="h1 mb-4  " >Meilleur Producteur</h2>
                        <p class="font-italic mb-4 text-muted">Liste des profils des producteurs</p>
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section 5 -->
        <section class="py-5 d-flex align-items-center" id="five">
            <div class="container">
                <h2 class="h1 mb-4  ">Témoignages</h2>
                <div class="row">
                    <div class="col-lg-10 col-xl-8 mx-auto">
                        <div class="p-5 rounded bloc_avis">
                            <div class="carousel slide" id="carouselExampleIndicators" data-ride="carousel">
                                <ol class="carousel-indicators mb-0">
                                    <li class="active" data-target="#carouselExampleIndicators" data-slide-to="0" ></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>


                                <div class="carousel-inner px-5 pb-4">
                                    <!-- Carousel slide-->
                                    <div class="carousel-item active">
                                        <div class="media"><img class="rounded-circle img-thumbnail" src="https://res.cloudinary.com/mhmd/image/upload/v1579676165/avatar-1_ffutqr.jpg" alt="" width="75">
                                            <div class="media-body ml-3">
                                                <blockquote class="blockquote border-0 p-0">
                                                    <p class="font-italic lead  " > <i class="fa fa-quote-left mr-3 text-success guillemets" ></i>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    <footer class="blockquote-footer">Someone famous in
                                                        <cite title="Source Title">Source Title</cite>
                                                    </footer>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <div class="media"><img class="rounded-circle img-thumbnail" src="https://res.cloudinary.com/mhmd/image/upload/v1579676165/avatar-3_hdxocq.jpg" alt="" width="75">
                                            <div class="media-body ml-3">
                                                <blockquote class="blockquote border-0 p-0">
                                                    <p class="font-italic lead  "> <i class="fa fa-quote-left mr-3 text-success guillemets"></i>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    <footer class="blockquote-footer">Someone famous in
                                                        <cite title="Source Title">Source Title</cite>
                                                    </footer>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <div class="media"><img class="rounded-circle img-thumbnail" src="https://res.cloudinary.com/mhmd/image/upload/v1579676165/avatar-2_gibm2s.jpg" alt="" width="75">
                                            <div class="media-body ml-3">
                                                <blockquote class="blockquote border-0 p-0">
                                                    <p class="font-italic lead  "> <i class="fa fa-quote-left mr-3 text-success guillemets"></i>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    <footer class="blockquote-footer">Someone famous in
                                                        <cite title="Source Title">Source Title</cite>
                                                    </footer>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <a class="carousel-control-prev width-auto" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <i class="fa fa-angle-left text-dark text-lg fleches" ></i>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next width-auto" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <i class="fa fa-angle-right text-dark text-lg fleches" ></i>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>













        <!--   *************************************************************  -->
        <!--   ************************** FOOTER  **************************  -->


        <footer class="bg-info" id="foot">
            <div class="container py-5">
                <div class="row py-4">

                    <div id='boxocial' class="col-lg-4 col-md-6 mb-4 mb-lg-0  "><img src="img/logo.png" alt="" width="180" class="mb-3">
                        <p class="font-italic text-mute">Retrouvez-nous également sur les réseaux sociaux</p>
                        <ul class="list-inline mt-4 footer__social">
                            <li class=" "><a href="#0"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                            <li class=" "><a href="#0"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                            <li class=" "><a href="#0"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                        <h6 class="text-uppercase font-weight-bold mb-4  ">WeBeats</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><a href="#" class="text-mute">A Propos</a></li>
                            <li class="mb-2"><a href="#" class="text-mute">Aide</a></li>
                            <li class="mb-2"><a href="#" class="text-mute">On recrute</a></li>
                            <li class="mb-2"><a href="#" class="text-mute">Contactez-nous</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                        <h6 class="text-uppercase font-weight-bold mb-4  ">Explorer</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><a href="#tendances" class="text-mute">Tendances</a></li>
                            <li class="mb-2"><a href="#topventes" class="text-mute">Top ventes</a></li>
                            <li class="mb-2"><a href="#bestprod" class="text-mute">Nos meilleurs producteurs</a></li>
                            <li class="mb-2"><a href="#temoignages" class="text-mute">Témoignages</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-lg-0">
                        <h6 class="text-uppercase font-weight-bold mb-4  ">Newsletter</h6>
                        <p class="text-mute mb-4">Inscrivez-vous pour ne rien louper de notre Actualité !</p>
                        <div class="p-1 rounded border">
                            <div class="input-group">
                                <input type="email" placeholder="Entrez votre adresse email" aria-describedby="button-addon1" class="form-control border-0 shadow-0">
                                <div class="input-group-append">
                                    <button id="button-addon1" type="submit" class="btn btn-link"><i class="fa fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyrights -->
            <div class="bg-light py-4">
                <div class="container text-center">
                    <p class="text-mute mb-0 py-2">© 2020 WeBeats All rights reserved.</p>
                </div>
            </div>
        </footer>
        <!-- End -->

        <?php
        require_once('skeleton/endLinkScripts.php');
        ?>







    </body>
</html>