<?php
session_start();
include_once("assets/db/connexiondb.php");
$_SESSION['ici_index_bool'] = true;
?>
<?php
$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {

    $okconnectey = true;
} 

$req = $BDD->prepare("SELECT * 
                    FROM beat
                    ORDER BY beat_dateupload DESC
                    LIMIT 7 ");
$req->execute(array());
$resuTENDANCES=$req->fetchAll();


?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name='description' content="Site Responsive Hotel ">

        <?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>

        <link rel="stylesheet" type="text/css" href="assets/css/index.css">
        <link rel="stylesheet" type="text/css" href="assets/css/loading.css">
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
        <link rel="stylesheet" type="text/css" href="assets/css/navbar-index-turfu.css">


        <link rel="stylesheet" type="text/css" href="assets/css/music_card.css">

        <!--  Audio player de mathieu   -->
        <link rel="stylesheet" type="text/css" href="assets/skeleton/AudioPlayer/audioplayer.css">


        <!--Slides-->
        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/slide.css">


        <style>
            .video-icon {
                display: inline-block;
                height: 5rem;
                width: 5rem;
                border-radius: 50%;
                background-color: #793ea5;
                background-image: url(assets/img/icon/icon-play.svg);
                background-repeat: no-repeat;
                background-position: 55% center;
                background-size: 24px 27px;
                -webkit-transition: background-color 0.3s ease-in-out;
                transition: background-color 0.3s ease-in-out;
            }
        </style>
        <title>WeBeatz</title>
    </head>
    <body id="top">
        <!-- preloader
================================================== -->
        <div id="preloader">
            <div id="loader" class="dots-jump">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>


        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->

        <?php
        require_once('assets/skeleton/navbar.php');
        ?>

        <!--   *************************************************************  -->
        <!--   ************************** MUSIC PLAYER  **************************  -->

        <?php
        require_once('assets/skeleton/AudioPlayer/audioplayer.php');
        ?>




        <!--   *************************************************************  -->
        <!--   ************************** HEADER  **************************  -->

        <header class="s-header">
            <div class="overlay-sombre"></div>
            <video id="BACKGROUNDVIDEO1" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"><!--fond d'écran animé-->
                <source src="img/Nebula.mp4" type="video/mp4">
            </video>
            <div class="container h-100">
                <div class="d-flex h-100 text-center align-items-center">
                    <div class="w-100 text-white">
                        <div class="mb-4">  <span class="video-icon"></span>
                            <h1 class="display-3">Bienvenue sur WeBeatz</h1>
                            <p class="lead mb-0">Retrouvez les beats des meilleurs producteurs du moment</p>
                            <p class="lead mb-0"><a href="incription.php" >Inscrivez-vous</a> pour commencer à acheter ou vendre des prods 

                        </div>

                        <form id="searchform" method="get" action="search.php">


                            <div class="searchbar searchtest">

                                <input id='searchbar' class="search_input" type="text" placeholder="Recherchez vos musiques, artistes..." name="q">


                                <button type="submit" class="search_icon"><i class="fas fa-search"></i></button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </header>
        <script src="assets/js/search.js"></script>
        <!--   ************************** PARTIE MLAMALI TEST CALA PAS  **************************  -->

        


        <!--   *************************************************************  -->
        <!--   ************************** SECTIONS  ***********************  -->
        <!-- ******* Section 1 -->
        <section class="py-5 d-flex align-items-center" id="one">

            <div class="container-fluid">
                <div class="mx-auto" id="tendances">
                    <h2 class="h1 mb-4 text-center text-white">Tendances</h2>
                    <p class="lead mb-0 text-center text-white">Retrouvez les beats du moment</p>
                    <div class="my_slides multiple-items">

                        <?php
                        foreach($resuTENDANCES as $rT){

                        ?>
                        <div class="items">
                            <div class="hover hover-5 text-white rounded"><img src="<?= $rT['beat_cover']?>" alt="">
                                <div class="hover-overlay"></div>
                                <div class="link_icon"><i class="far fa-play-circle"></i></div>
                                <h6 class="hover-5-title text-uppercase font-weight-light mb-0"><?= $rT['beat_author']?><strong class="font-weight-bold text-white">
                                    <?= $rT['beat_title']?></strong><span> <?= $rT['beat_year']?></span></h6>
                            </div>
                        </div>

                        <?php } ?>

                    </div>

                    <div class="slider-btn rounded-circle">
                        <span class="prev1 position-top"><i class="fas fa-chevron-left"></i></span>
                        <span class="next1 position-top right-0"><i class="fas fa-chevron-right"></i></span>
                    </div>


                </div>
            </div>      
        </section>

        <!-- Section 2-->
        <section class="py-5 d-flex align-items-center" id="two">
            <div class="container-fluid">
                <div class="mx-auto" id="topventes">
                    <h2 class="h1 mb-4 text-center text-white">TOP des ventes</h2>
                    <p class="lead mb-0 text-white text-center">Les meilleures ventes de beats</p>

                    <div class="my_slides multipleitems2">
                        <div class="items">
                            <div class="hover hover-5 text-white rounded"><img src="img/Laylow.jpg" alt="">
                                <div class="hover-overlay"></div>
                                <div class="link_icon"><i class="far fa-play-circle"></i></div>
                                <h6 class="hover-5-title text-uppercase font-weight-light mb-0">Laylow<strong class="font-weight-bold text-white">
                                    BURNING MAN</strong><span> 2020</span></h6>

                            </div>
                        </div>
                        <div class="items">
                            <div class="hover hover-5 text-white rounded"><img src="img/bigmetro.jpg" alt="">
                                <div class="hover-overlay"></div>
                                <div class="link_icon"><i class="far fa-play-circle"></i></div>
                                <h6 class="hover-5-title text-uppercase font-weight-light mb-0">Big Sean(ft Travis Scott)<strong class="font-weight-bold text-white">
                                    Go Legend</strong><span> 2020</span></h6>
                            </div>
                        </div>
                        <div class="items">
                            <div class="hover hover-5 text-white rounded"><img src="img/CG6.png" alt="">
                                <div class="hover-overlay"></div>
                                <div class="link_icon"><i class="far fa-play-circle"></i></div>
                                <h6 class="hover-5-title text-uppercase font-weight-light mb-0">CG6<strong class="font-weight-bold text-white">
                                    Nelson</strong><span> 2019</span></h6>
                            </div>
                        </div>
                        <div class="items">
                            <div class="hover hover-5 text-white rounded"><img src="img/DB5.jpg" alt="">
                                <div class="hover-overlay"></div>
                                <div class="link_icon"><i class="far fa-play-circle"></i></div>
                                <h6 class="hover-5-title text-uppercase font-weight-light mb-0">Leto<strong class="font-weight-bold text-white">
                                    Double Bang 5</strong><span> 2018</span></h6>
                            </div>                        
                        </div>
                        <div class="items">
                            <div class="hover hover-5 text-white rounded"><img src="img/luv.jpg" alt="">
                                <div class="hover-overlay"></div>
                                <div class="link_icon"><i class="far fa-play-circle"></i></div>
                                <h6 class="hover-5-title text-uppercase font-weight-light mb-0">Lil Uzi Vert<strong class="font-weight-bold text-white">
                                    Futball Shuffle </strong><span> 2020</span></h6>
                            </div>
                        </div>
                        <div class="items">
                            <div class="hover hover-5 text-white rounded"><img src="img/Sch.jpg" alt="">
                                <div class="hover-overlay"></div>
                                <div class="link_icon"><i class="far fa-play-circle"></i></div>
                                <h6 class="hover-5-title text-uppercase font-weight-light mb-0">Sch<strong class="font-weight-bold text-white">
                                    Poupée Russe </strong><span> 2017</span></h6>
                            </div>
                        </div>
                        <div class="items">
                            <div class="hover hover-5 text-white rounded"><img src="img/roddy.jpg" alt="">
                                <div class="hover-overlay"></div>
                                <div class="link_icon"><i class="far fa-play-circle"></i></div>
                                <h6 class="hover-5-title text-uppercase font-weight-light mb-0">Roddy Rich<strong class="font-weight-bold text-white">
                                    Tip toe</strong><span> 2020</span></h6>
                            </div>
                        </div>
                        <div class="items">
                            <div class="hover hover-5 text-white rounded"><img src="img/Spri.jpg" alt="">
                                <div class="hover-overlay"></div>
                                <div class="link_icon"><i class="far fa-play-circle"></i></div>
                                <h6 class="hover-5-title text-uppercase font-weight-light mb-0">Spri(ft 4Keus)<strong class="font-weight-bold text-white">
                                    Night and Day</strong><span> 2020</span></h6>
                            </div>
                        </div>
                    </div>

                    <div class="slider-btn rounded-circle">
                        <span class="prev2 position-top"><i class="fas fa-chevron-left"></i></span>
                        <span class="next2 position-top right-0"><i class="fas fa-chevron-right"></i></span>
                    </div>
                </div>
            </div>  
        </section>

        <!-- Section 3 -->
        <section class="py-5 d-flex align-items-center" id="three">
            <div class="container">
                <div class="col-lg-9 mx-auto" id="ccm">
                    <h2 class="h1 mb-4 text-white text-center" >Comment ça marche?</h2>
                    <p class="lead mb-0 text-white text-center">Découvrez de quelle manière fonctionne le site</p>

                    <div id="recherchez" class="text-center">
                        <h3>Recherchez</h3>
                        <p> Retrouvez de nombreuses productions au sein de notre catalogue.</p>
                        <img src="https://airbit.com/img/landing-pages/buy-beats/how-it-works/browse.svg">
                    </div>
                    <div id="achetez" class="text-center">
                        <h3>Achetez</h3>
                        <p>Choisissez la licence qui vous convient et ajoutez la au panier.</p>
                        <img src="https://airbit.com/img/landing-pages/buy-beats/how-it-works/buy.svg" width="100">
                    </div>
                    <div id="creez" class="text-center">
                        <h3>Créez</h3>
                        <p>Uploadez vos créations sur notre site et rejoignez de nombreux beatmakers</p>
                        <img src="https://airbit.com/img/landing-pages/buy-beats/how-it-works/create.svg">
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 4 -->
        <section class="py-5 d-flex align-items-center" id="four">
            <div class="container py-5">
                <div class="row text-center">
                    <div class="col-lg-9 mx-auto" id="bestprod">
                        <h2 class="h1 mb-4 text-white text-center">Meilleur Producteur</h2>
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
                <h2 class="h1 mb-4 txt-footer">Témoignages</h2>
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
                                                    <p class="font-italic lead text-white" > <i class="fa fa-quote-left mr-3 text-success guillemets" ></i>Je suis tombé sur ce site par hasard en cherchant des prods sur internet et aujourd'hui je ne m'en passe plus !</p>
                                                    <footer class="blockquote-footer">Employé à
                                                        <cite>Chicken Spot</cite>
                                                    </footer>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <div class="media"><img class="rounded-circle img-thumbnail" src="https://res.cloudinary.com/mhmd/image/upload/v1579676165/avatar-3_hdxocq.jpg" alt="" width="75">
                                            <div class="media-body ml-3">
                                                <blockquote class="blockquote border-0 p-0">
                                                    <p class="font-italic lead text-white"> <i class="fa fa-quote-left mr-3 text-success guillemets"></i>Etant beatmaker, j'apprécie réellement ce site qui permet de faciliter les liens entre les artistes.</p>
                                                    <footer class="blockquote-footer">Ghost Killer Track</footer>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <div class="media"><img class="rounded-circle img-thumbnail" src="https://res.cloudinary.com/mhmd/image/upload/v1579676165/avatar-2_gibm2s.jpg" alt="" width="75">
                                            <div class="media-body ml-3">
                                                <blockquote class="blockquote border-0 p-0">
                                                    <p class="font-italic lead text-white"> <i class="fa fa-quote-left mr-3 text-success guillemets"></i>WeBeatz est mon site préféré ! J'ai découvert de nombreux beatmakers grâce à ce site !</p>
                                                    <footer class="blockquote-footer">Hakim</footer>
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

        <!-- features
================================================== -->
        <section id="features" class="s-features target-section">

            <div class="testimonials-wrap" data-aos="fade-up">

                <div class="row">
                    <div class="col-full testimonials-header">
                        <h2 class="display-2">Our Users Love Our App!</h2>
                    </div>
                </div>

                <div class="row testimonials">

                    <div class="col-full slick-slider testimonials__slider">

                        <div class="testimonials__slide">
                            <img src="images/avatars/user-03.jpg" alt="Author image" class="testimonials__avatar">

                            <p>Qui ipsam temporibus quisquam velMaiores eos cumque distinctio nam accusantium ipsum. 
                                Laudantium quia consequatur molestias delectus culpa facere hic dolores aperiam. Accusantium praesentium corpori.</p>

                            <div class="testimonials__author">
                                <span class="testimonials__name">Naruto Uzumaki</span>
                                <a href="#0" class="testimonials__link">@narutouzumaki</a>
                            </div>
                        </div> <!-- end testimonials__slide -->

                        <div class="testimonials__slide">
                            <img src="images/avatars/user-05.jpg" alt="Author image" class="testimonials__avatar">

                            <p>Excepturi nam cupiditate culpa doloremque deleniti repellat. Veniam quos repellat voluptas animi adipisci.
                                Nisi eaque consequatur. Quasi voluptas eius distinctio. Atque eos maxime. Qui ipsam temporibus quisquam vel.</p>

                            <div class="testimonials__author">
                                <span class="testimonials__name">Sasuke Uchiha</span>
                                <a href="#0" class="testimonials__link">@sasukeuchiha</a>
                            </div>
                        </div> <!-- end testimonials__slide -->

                        <div class="testimonials__slide">
                            <img src="images/avatars/user-01.jpg" alt="Author image" class="testimonials__avatar">

                            <p>Repellat dignissimos libero. Qui sed at corrupti expedita voluptas odit. Nihil ea quia nesciunt. Ducimus aut sed ipsam.  
                                Autem eaque officia cum exercitationem sunt voluptatum accusamus. Quasi voluptas eius distinctio.</p>

                            <div class="testimonials__author">
                                <span class="testimonials__name">Shikamaru Nara</span>
                                <a href="#0" class="testimonials__link">@shikamarunara</a>
                            </div>
                        </div> <!-- end testimonials__slide -->

                    </div> <!-- end testimonials__slider -->

                </div> <!-- end testimonials -->

            </div> <!-- end testimonials-wrap -->

        </section> <!-- end s-features -->


        <!-- download
================================================== -->

        <div class="go-top">
            <a class="smoothscroll" title="Back to Top" href="#top"></a>
        </div>
        <!--   *************************************************************  -->
        <!--   ************************** FOOTER  **************************  -->


        <footer class="bg-info" id="foot">
            <div class="container py-5">
                <div class="row py-4">

                    <div id='boxocial' class="col-lg-4 col-md-6 mb-4 mb-lg-0  "><!--<img src="img/logo.png" alt="" width="180" class="mb-3">-->

                        <p class="font-italic text-mute">Retrouvez-nous également sur les réseaux sociaux</p>
                        <ul class="list-inline mt-4 footer__social">
                            <li class=" "><a href="https://www.facebook.com/webeatz.prod.1"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                            <li class=" "><a href="https://twitter.com/webeatzprod"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                            <li class=" "><a href="https://www.instagram.com/webeatz/"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                        <h6 class="text-uppercase font-weight-bold mb-4 txt-footer ">WeBeats</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><a href="#" class="text-mute">A Propos</a></li>
                            <li class="mb-2"><a href="#" class="text-mute">Aide</a></li>
                            <li class="mb-2"><a href="#" class="text-mute">On recrute</a></li>
                            <li class="mb-2"><a href="#" class="text-mute">Contactez-nous</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                        <h6 class="text-uppercase font-weight-bold mb-4 txt-footer ">Explorer</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><a href="#tendances" class="text-mute">Tendances</a></li>
                            <li class="mb-2"><a href="#topventes" class="text-mute">Top ventes</a></li>
                            <li class="mb-2"><a href="#bestprod" class="text-mute">Nos meilleurs producteurs</a></li>
                            <li class="mb-2"><a href="#temoignages" class="text-mute">Témoignages</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-lg-0">
                        <h6 class="text-uppercase font-weight-bold mb-4 txt-footer ">Newsletter</h6>
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


        <!--   *************************************************************  -->
        <!--   ************************** MUSIC PLAYER  **************************  -->

        <?php
        require_once('assets/skeleton/AudioPlayer/audioplayer.php');
        ?>

        <!--  JS du MusicPlayer  -->
        <script id="scriptDuPlayer" src="assets/skeleton/AudioPlayer/audioplayer.js"></script>



        <script src="assets/js/search.js"></script>


        <?php
    require_once('assets/skeleton/endLinkScripts.php');
        ?>
        <!--     RECHERCHE  -->


        <!--        COMPTE A REBOURS -->
        <script src="assets/js/comptearebours.js"></script>
        <!--    END     COMPTE A REBOURS -->

        <!-- SCRIPT SLIDES       -->
        <script src="assets/js/slick.min.js"></script>
        <script src="assets/js/slide.js"></script>


        <script src="assets/js/main.js"></script>

    </body>
</html>