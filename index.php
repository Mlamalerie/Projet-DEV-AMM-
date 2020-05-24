<?php
session_start();

$_SESSION['ici_index_bool'] = true;
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

        <link rel="stylesheet" type="text/css" href="assets/css/styles-index.css">
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
        <link rel="stylesheet" type="text/css" href="assets/css/navbar-index-turfu.css">
        <link rel="stylesheet" type="text/css" href="assets/css/navbar_responsive.css">

        <link rel="stylesheet" type="text/css" href="assets/css/music_card.css">

        <link rel="stylesheet" type="text/css" href="assets/css/player.css">

                



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
        require_once('assets/skeleton/navbar.php');
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

                        <a href="test_zone.php"
                           ><button type="button" class="btn btn-danger btninscription">Test</button></a><br/>

                           <button type="button" class="btn btn-danger btninscription">Test1</button>
                           <button type="button" class="btn btn-danger btninscription">Test2</button>
                           <button type="button" class="btn btn-danger btninscription">Test3</button>

                        <form id="searchform" method="get" action="search.php">
                            <input type="hidden" name="Genre" value="All">

                            <div class="searchbar ">

                                <input id='searchbar' class="search_input" type="text" placeholder="Recherchez vos musiques, artistes..." name="q">


                                <button type="submit" class="search_icon"><i class="fas fa-search"></i></button>
                            </div>
                        </form>

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



        }
        ?>
        <div id="countdown">
            Temps restant pour le projet :
            <span id="d"></span>


        </div>


        <!--   *************************************************************  -->
        <!--   ************************** SECTION 1  ***********************  -->
        <!-- ******* Section 1 -->
        <section class="py-5 d-flex align-items-center" id="one">
            <div class="row" id="tendances">
                <div style="padding-left : 575px">
                    <h2 class="h1 mb-4">Tendances</h2>
                </div>
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators invisible" style="padding-left : 150px">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class=" rounded-circle active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1" class="rounded-circle"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2" class="rounded-circle"></li>
                    </ol>

                    <div class="carousel-inner caroustyle">

                        <div class="carousel-item active">

                            <div class="container row col-md-12" style="padding-left : 200px">

                                <div class="col-md-3">
                                    <div class="hover hover-5 text-white rounded"><img src="img/Laylow.jpg" alt="">
                                        <div class="hover-overlay"></div>
                                        <div class="link_icon"><i class="far fa-play-circle"></i></div>
                                        <h6 class="hover-5-title text-uppercase font-weight-light mb-0">Laylow<strong class="font-weight-bold text-white">
                                            BURNING MAN</strong><span> 2020</span></h6>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="hover hover-5 text-white rounded"><img src="img/bigmetro.jpg" alt="">
                                        <div class="hover-overlay"></div>
                                        <div class="link_icon" onclick="playPause(0)"><i class="far fa-play-circle"></i></div>
                                        <h6 class="hover-5-title text-uppercase font-weight-light mb-0">Big Sean ft Travis Scott,Metro Boomin<strong class="font-weight-bold text-white"> Go Legend</strong><span> 2020</span></h6>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="hover hover-5 text-white rounded"><img src="img/luv.jpg" alt="">
                                        <div class="hover-overlay"></div>
                                        <div class="link_icon" onclick="playPause(1)"><i class="far fa-play-circle"></i></div>
                                        <h6 class="hover-5-title text-uppercase font-weight-light mb-0">Lil Uzi Vert<strong class="font-weight-bold text-white"> Futsal Shuffle 2020</strong><span> 2020</span></h6>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="hover hover-5 text-white rounded"><img src="img/roddy.jpg" alt="">
                                        <div class="hover-overlay"></div>
                                        <div class="link_icon" onclick="playPause(2)"><i class="far fa-play-circle"></i></div>
                                        <h6 class="hover-5-title text-uppercase font-weight-light mb-0">Roddy Rich<strong class="font-weight-bold text-white"> Tip Toe</strong><span> 2020</span></h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="container row col-md-12" style="padding-left : 200px">

                                <div class="col-md-3">
                                    <img src="img/roddy.jpg">
                                    <h4>Titre</h4>
                                    <p>Nom artiste</p>
                                </div>

                                <div class="col-md-3">
                                    <img src="img/bigmetro.jpg"  height="225">
                                    <h4>Titre</h4>
                                    <p>Nom artiste</p>
                                </div>

                                <div class="col-md-3">
                                    <img src="img/luv.jpg" height="225">
                                    <h4>Titre</h4>
                                    <p>Nom artiste</p>
                                </div>

                                <div class="col-md-3">
                                    <img src="img/roddy.jpg">
                                    <h4>Titre</h4>
                                    <p>Nom artiste</p>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="container row col-md-12" style="padding-left : 200px">

                                <div class="col-md-3">
                                    <img src="img/roddy.jpg">
                                    <h4>Titre</h4>
                                    <p>Nom artiste</p>
                                </div>

                                <div class="col-md-3">
                                    <img src="img/bigmetro.jpg"  height="225">
                                    <h4>Titre</h4>
                                    <p>Nom artiste</p>
                                </div>

                                <div class="col-md-3">
                                    <img src="img/luv.jpg" height="225">
                                    <h4>Titre</h4>
                                    <p>Nom artiste</p>
                                </div>

                                <div class="col-md-3">
                                    <img src="img/roddy.jpg">
                                    <h4>Titre</h4>
                                    <p>Nom artiste</p>
                                </div>
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


        </section>

        <!-- Section 2-->
        <section class="py-5 d-flex align-items-center" id="two">
            <div class="container py-5">
                <div class="row text-center">
                    <div class="col-lg-9 mx-auto" id="topventes">
                        <h2 class="h1 mb-4">TOP des ventes</h2>

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
                                        <a href="javascript:void();" class="album-poster" data-switch="3">
                                            <button class="btn btn-danger btn-circle btn-circle-xl m-1 btnplay"  ><i class="fa fa-play"></i></button>
                                        </a>
                                    </div>
                                </div>

                                <div class="carousel-item">                                    
                                    <img src="img/bigmetro.jpg" class="d-block w-100 image_sons"  alt="...">                            
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Nom de la prod : </h5>
                                        <p>Nom du producteur : </p>
                                        <a href="javascript:void();" class="album-poster" data-switch="4">
                                            <button class="btn btn-danger btn-circle btn-circle-xl m-1 btnplay" ><i class="fa fa-play"></i></button>
                                        </a>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <img src="img/luv.jpg" class="d-block w-100 image_sons"  alt="...">                                  
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Nom de la prod : </h5>
                                        <p>Nom du producteur : </p>
                                        <a href="javascript:void();" class="album-poster" data-switch="5">
                                            <button class="btn btn-danger btn-circle btn-circle-xl m-1 btnplay"  ><i class="fa fa-play"></i></button>
                                        </a>
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
                        <h2 class="h1 mb-4">Meilleur Producteur</h2>
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

        

    <nav class="navplayer fixed-bottom">        
        <audio src="./audio/go_legend.mp3" id="song"></audio>
        <div class="box">     
        <img src="./img/bigmetro.jpg" id="thumbnail" />
        
        <img src="./assets/icon/play.png" onclick="playPause(songIndex)" id="play-pause" />
        <img src="./assets/icon/forward.png" onclick="nextSong()" id="next-song" />
        <img src="./assets/icon/backward.png" onclick="previousSong()" id="previous-song" />

        <div class="song-artist">WeBeats</div>
        <div class="song-title"></div>

        <input 
            type="range" 
            id="progress-bar" 
            min="0" 
            max="" 
            value="0" 
            onchange="changeProgressBar()"
        />

        <a href="?action=add">
        <button type="button" class="btn btn-light btn-buy">Acheter</button>
        </a>

        <div class="currentTime"></div>
        <div class="durationTime"></div>
    </div>
    </nav>






        <!--   *************************************************************  -->
        <!--   ************************** FOOTER  **************************  -->


        <footer class="bg-info" id="foot">
            <div class="container py-5">
                <div class="row py-4">

                    <div id='boxocial' class="col-lg-4 col-md-6 mb-4 mb-lg-0  ">
                        <!--                       <img src="img/logo.png" alt="" width="180" class="mb-3">-->
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


        <script>
const thumbnail = document.querySelector('#thumbnail'); // album cover 
const song = document.querySelector('#song'); // audio 

const songArtist = document.querySelector('.song-artist'); // element où noms artistes apparaissent
const songTitle = document.querySelector('.song-title'); // element où titre apparait
const progressBar = document.querySelector('#progress-bar'); // element où progress bar apparait
let pPause = document.querySelector('#play-pause'); // element où images play pause apparaissent

let mouseDown = false;



songIndex = 0;
songs = ['./audio/go_legend.mp3','./audio/futsal_shuffle_2020.mp3','./audio/tip_toe.mp3']; //Stockage des audios
thumbnails = ['./img/bigmetro.jpg', './img/luv.jpg', './img/roddy.jpg']; //Stockage des covers
songArtists = ['Big Sean & Metro Boomin(ft. Travis Scott)', 'Lil Uzi Vert', 'Roddy Rich']; //Stockage Noms Artistes
songTitles = ["Go Legend", "Futsal Shuffle 2020", "Tip Toe"]; //Stockage Titres

/*
let playing = true;
function playPause(songIndex) {
    if (playing) {
        const song = document.querySelector('#song'),
        thumbnail = document.querySelector('#thumbnail');
        pPause.src = "./assets/icon/pause.png"
        song.play();
        playing = false;
    } else {
        pPause.src = "./assets/icon/play.png"
        song.pause();
        playing = true;
    }
}

*/


let playing = true;
function playPause(songIndex) {
    song.src = songs[songIndex];
    thumbnail.src = thumbnails[songIndex];
    songArtist.innerHTML = songArtists[songIndex];
    songTitle.innerHTML = songTitles[songIndex];
    if (playing) {
        pPause.src = "./assets/icon/pause.png"
        song.play();
        playing = false;
    } else {
        pPause.src = "./assets/icon/play.png"
        song.pause();
        playing = true;
    }
}



// joue automatiquement le son suivant
song.addEventListener('ended', function(){
    nextSong();
});

function nextSong() {
    songIndex++;
    if (songIndex > songs.length -1) {
        songIndex = 0;
    };
    song.src = songs[songIndex];
    thumbnail.src = thumbnails[songIndex];
    if((songArtists[songIndex] != null) && (songTitles[songIndex] != null)){
        songArtist.innerHTML = songArtists[songIndex];
        songTitle.innerHTML = songTitles[songIndex];
    }
    playing = true;
    playPause(songIndex);
}

function previousSong() {
    songIndex--;
    if (songIndex < 0) {
        songIndex = songs.length -1;
    };
    song.src = songs[songIndex];
    thumbnail.src = thumbnails[songIndex];
    if((songArtists[songIndex] != null) && (songTitles[songIndex] != null)){
        songArtist.innerHTML = songArtists[songIndex];
        songTitle.innerHTML = songTitles[songIndex];
    }
    playing = true;
    playPause(songIndex);
}

// maj de la durée max du son, maj temps actuel
function updateProgressValue() {
    progressBar.max = song.duration;
    progressBar.value = song.currentTime;
    document.querySelector('.currentTime').innerHTML = (formatTime(Math.floor(song.currentTime)));
    if (document.querySelector('.durationTime').innerHTML === "NaN:NaN") {
        document.querySelector('.durationTime').innerHTML = "0:00";
    } else {
        document.querySelector('.durationTime').innerHTML = (formatTime(Math.floor(song.duration)));
    }
};


// conversion du temps en minutes/secondes dans le lecteur
function formatTime(seconds) {
    let min = Math.floor((seconds / 60));
    let sec = Math.floor(seconds - (min * 60));
    if (sec < 10){ 
        sec  = `0${sec}`;
    };
    return `${min}:${sec}`;
};

// actualisation du lecteur en fct du temps(demi-secondes)
setInterval(updateProgressValue, 500);

// Valeur de la bar qd curseur est glissé sans lecture
function changeProgressBar() {
    song.currentTime = progressBar.value;
};

        </script>



        <script src="assets/js/search.js"></script>


        <?php
        require_once('assets/skeleton/endLinkScripts.php');
        ?>
        <!--     RECHERCHE  -->


        <!--        COMPTE A REBOURS -->
        <script src="assets/js/comptearebours.js"></script>
        <!--    END     COMPTE A REBOURS -->

        


    </body>
</html>