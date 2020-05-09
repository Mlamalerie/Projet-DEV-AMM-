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
                    <nav id="menuvertical" class="nav flex-column bg-white shadow-sm font-italic rounded p-3"> <h3 class="text-white">Filtres de recherche</h3>

                        <div class="list_group">
                            <h4 class="text-white">Trier par prix</h4>
                        </div>

                        <div class="list_group">
                            <h4 class="text-white">Catégories</h4>


                            <a href="#" class="nav-link px-4 rounded-pill activer">
                                <i class="fa fa-circle-o mr-2 icon_activer"></i>
                                Tout
                                <span class="badge badge-primary px-2 rounded-pill ml-2">45</span>
                            </a>
                            <a href="#" class="nav-link px-4 rounded-pill activer">
                                <i class="fa fa-circle-o mr-2"></i>
                                Afro Beats
                            </a>
                            <a href="#" class="nav-link px-4 rounded-pill activer">
                                <i class="fa fa-circle-o mr-2"></i>
                                Active link
                            </a>
                            <a href="#" class="nav-link px-4 rounded-pill activer">
                                <i class="fa fa-circle-o mr-2"></i>
                                Drill
                            </a>
                            <a href="#" class="nav-link px-4 rounded-pill activer">
                                <i class="fa fa-circle-o mr-2"></i>
                                Electro
                            </a>
                            <a href="#" class="nav-link px-4 rounded-pill activer">
                                <i class="fa fa-circle-o mr-2"></i>
                                Trap
                            </a>
                            <a href="#" class="nav-link rounded-pill px-4 activer">
                                <i class="fa fa-circle-o mr-2"></i>
                                Urbatutt
                            </a>
                        </div> 

                        <div class="list_group">
                            <h4 class="text-white">Trier par Date</h4>
                        </div>
                    </nav>
                    <!-- End -->

                </div>

                <div class="col-lg-8 mb-5 col-md-8 col-xl-9">
                    <!-- Demo Content-->
                    <div class="p-5 bg-white d-flex align-items-center shadow-sm rounded h-100">
                        <div class="demo-content">
                            <!--  <p class="lead font-italic">- Demo content:</p>
<p class="lead font-italic mb-0">"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat consectetur
adipisicing eli exercitation ullamco laboris nisi."</p>-->
                            <!--<img src="img/Sch.jpg">-->
                            <?php


    //print_r($resu);
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