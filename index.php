<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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


    <footer class="bg-info">
    <div class="container py-5">
      <div class="row py-4">

        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0"><img src="img/logo.png" alt="" width="180" class="mb-3">
          <p class="font-italic text-mute">Retrouvez-nous également sur les réseaux sociaux</p>
          <ul class="list-inline mt-4">
            <!-- Facebook-->
            <li class="list-inline-item"><a href="#" class="social-link rounded py-2 px-4 my-2 social-facebook"><i class="fa fa-facebook-f fa-fw"></i></a></li>
            <!-- Twitter-->
            <li class="list-inline-item"><a href="#" class="social-link rounded py-2 px-4 my-2 social-twitter"><i class="fa fa-twitter fa-fw"></i></a></li>
            <!-- Youtube-->
            <li class="list-inline-item mr-2"><a href="#" class="social-link rounded py-2 px-4 my-2 social-youtube"><i class="fa fa-youtube-play fa-fw"></i></a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
          <h6 class="text-uppercase font-weight-bold mb-4">WeBeats</h6>
          <ul class="list-unstyled mb-0">
            <li class="mb-2"><a href="#" class="text-mute">A Propos</a></li>
            <li class="mb-2"><a href="#" class="text-mute">Aide</a></li>
            <li class="mb-2"><a href="#" class="text-mute">On recrute</a></li>
            <li class="mb-2"><a href="#" class="text-mute">Contactez-nous</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
          <h6 class="text-uppercase font-weight-bold mb-4">Explorer</h6>
          <ul class="list-unstyled mb-0">
            <li class="mb-2"><a href="#" class="text-mute">Tendances</a></li>
            <li class="mb-2"><a href="#" class="text-mute">Top ventes</a></li>
            <li class="mb-2"><a href="#" class="text-mute">Nos meilleurs producteurs</a></li>
            <li class="mb-2"><a href="#" class="text-mute">Témoignages</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-6 mb-lg-0">
          <h6 class="text-uppercase font-weight-bold mb-4">Newsletter</h6>
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






        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>