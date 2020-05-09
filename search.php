<br><br><br><br><br><br><br><br>
<?php
session_start();
include_once("db/connexiondb.php");

print_r($_GET);
if(isset($_GET['q']) && !empty($_GET['q'])) {

    $xxx = (String) trim(($_GET['q']));
    $listeGenres = ['Trap','Afro','Deep'];


    if($_GET['Genre'] == "All") {
        $req = $BDD->prepare("SELECT *
                                                        FROM beat
                                                        WHERE CONCAT(beat_title,beat_author,beat_description,beat_year)
                                                        LIKE ?
                                                        ORDER BY beat_title DESC");

    } else {
        foreach($listeGenres as $gr){

            if($_GET['Genre'] == $gr) {
                $req = $BDD->prepare("SELECT * FROM (
                                                        SELECT * FROM beat
                                                        WHERE CONCAT(beat_title,beat_author,beat_description,beat_year)
                                                        LIKE ? ) base
                                        WHERE beat_genre = '$gr'
                                        ORDER BY beat_title DESC");

                break;
            } 

        }

    }






    $req->execute(array("%".$xxx."%"));
    $resu = $req->fetchAll();




?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <?php
    require_once('skeleton/headLinkCSS.html');
        ?>
        <link rel="stylesheet" type="text/css" href="css/navbar.css">
        <link rel="stylesheet" type="text/css" href="css/navmenuvertical.css">
        <link rel="stylesheet" type="text/css" href="css/navmenuvertical_responsive.css">
        <link rel="stylesheet" type="text/css" href="css/recherche.css">

        <title>Search</title>
    </head>
    <body>

        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->
        <?php
    require_once('skeleton/menu.php');
        ?>
        <!--   *************************************************************  -->
        <!--   ************************** TEST TECHERCHE MLAMALI  **************************  -->
        Ici c'est l'index des connecté
        <?php
    if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
        print_r($_SESSION);
    } else{
        echo "Pas de connexion";
    }
        ?>



        <!--   *************************************************************  -->
        <!--   ************************** MENU VERTICAL **************************  -->
        <h1 class="resultat">Résultats trouvés</h1>
        <div class="rounded">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0 col-md-4 col-xl-3">

                    <!-- Vertical Menu-->
                    <form method="get" id="form_menu_vert" action="">
                    <nav id="menuvertical" class="nav flex-column bg-white shadow-sm font-italic rounded p-3"> <h3 class="text-white">Filtres de recherche</h3>

                        <div class="list_group">
                            <h4 class="text-white">Trier par prix</h4>
                            <p class="text-white"> Trier par ordre croissant </p>
                            <p class="text-white"> Trier par ordre décroissant </p>
                            <div data-role="main" class="ui-content">
                            <form method="post" action="/action_page_post.php">
                              <div data-role="rangeslider">
                                <label for="price-min" class="text-white">Prix minimum:</label>
                                <input type="range" name="price-min" id="price-min" value="200" min="0" max="1000">
                                <label for="price-max" class="text-white">Prix maximum:</label>
                                <input type="range" name="price-max" id="price-max" value="800" min="0" max="1000">
                              </div>
                                <input type="submit" data-inline="true" value="Submit">
                              </form>
                          </div>
                        </div>

                        <div class="list_group">
                            <h4 class="text-white">Catégories</h4>


                            <a href="#" class="nav-link px-4 rounded-pill activer">
                                <input type="checkbox" class="icon_activer">
                                Tout
                                <span class="badge badge-primary px-2 rounded-pill ml-2">45</span>
                            </a>
                            <a href="#" class="nav-link px-4 rounded-pill activer">
                                <input type="checkbox" class="icon_activer">
                                Afro Beats
                            </a>
                            <a href="#" class="nav-link px-4 rounded-pill activer">
                                <input type="checkbox" class="icon_activer">
                                Active link
                            </a>
                            <a href="#" class="nav-link px-4 rounded-pill activer">
                                <input type="checkbox" class="icon_activer">
                                Drill
                            </a>
                            <a href="#" class="nav-link px-4 rounded-pill activer">
                                <input type="checkbox" class="icon_activer">
                                Electro
                            </a>
                            <a href="#" class="nav-link px-4 rounded-pill activer">
                                <input type="checkbox" class="icon_activer">
                                Trap
                            </a>
                            <a href="#" class="nav-link rounded-pill px-4 activer">
                                <input type="checkbox" class="icon_activer">
                                Urban
                            </a>
                        </div> 

                        <div class="list_group">
                            <h4 class="text-white">Trier par Date</h4>
                        </div>
                    </nav>
                    </form>
                    <!-- End -->

                </div>

                <div class="col-lg-8 mb-5 col-md-8 col-xl-9">
                    <!-- Demo Content-->
                    <div class="p-5 bg-white d-flex align-items-center shadow-sm rounded h-100">
                        <div class="demo-content">

                            <?php
    foreach($resu as $r){
                            ?>
                            <?= $r['beat_title']." "?><?= $r['beat_author']." "?><?= $r['beat_year']." ---"?>
                            <?php

    }



} else {
    print_r("****");
}

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <?php
        require_once('skeleton/endLinkScripts.php');
        ?>


    </body>
</html>