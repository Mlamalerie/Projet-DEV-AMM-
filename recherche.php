<br><br><br><br><br><br><br><br>
<?php
session_start();
include_once("db/connexiondb.php");

print_r($_GET);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <?php
        require_once('skeleton/headLinkCSS.php');
        ?>
        <link rel="stylesheet" type="text/css" href="css/navbar.css">
        <link rel="stylesheet" type="text/css" href="css/navmenuvertical.css">
         <link rel="stylesheet" type="text/css" href="css/navmenuvertical_responsive.css">

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

        <?php

        if(isset($_GET['q'])) {

            $xxx = (String) trim(($_GET['q']));


            $req = $BDD->prepare("SELECT *
                                FROM beat
                                WHERE CONCAT(beat_title,beat_author,beat_description,beat_year)
                                LIKE ?
                                ORDER BY beat_title DESC");

            $req->execute(array("%".$xxx."%"));
            $resu = $req->fetchAll();

            //print_r($resu);
            foreach($resu as $r){


        ?>

        <?= $r['beat_title']?><?= $r['beat_author']?><?= $r['beat_year']?>

        <?php

            }



        } else {
            print_r("****");
        }

        ?>

        <!--   *************************************************************  -->
        <!--   ************************** MENU VERTICAL **************************  -->
        <div class="rounded">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0 col-md-4 col-xl-3">

                    <!-- Vertical Menu-->
                    <nav id="menuvertical" class="nav flex-column bg-white shadow-sm font-italic rounded p-3">
                        <a href="#" class="nav-link px-4 rounded-pill">
                            <i class="fa fa-bar-chart mr-2"></i>
                            Action here
                            <span class="badge badge-primary px-2 rounded-pill ml-2">45</span>
                        </a>
                        <a href="#" class="nav-link px-4 rounded-pill">
                            <i class="fa fa-pie-chart mr-2"></i>
                            Another action here
                            <span class="badge badge-primary px-2 rounded-pill ml-2">12</span>
                        </a>
                        <a href="#" class="nav-link px-4 active bg-primary text-white shadow-sm rounded-pill">
                            <i class="fa fa-line-chart mr-2"></i>
                            Active link
                            <span class="badge badge-light text-primary px-2 rounded-pill ml-2">17</span>
                        </a>
                        <a href="#" class="nav-link px-4 rounded-pill">
                            <i class="fa fa-area-chart mr-2"></i>
                            Action here
                            <span class="badge badge-primary px-2 rounded-pill ml-2">32</span>
                        </a>
                        <a href="#" class="nav-link px-4 rounded-pill">
                            <i class="fa fa-th-large mr-2"></i>
                            Another action here
                        </a>
                        <a href="#" class="nav-link px-4 rounded-pill">
                            <i class="fa fa-line-chart mr-2"></i>
                            Action here
                        </a>
                        <a href="#" class="nav-link px-4 disabled">
                            <i class="fa fa-pie-chart mr-2"></i>
                            Disabled link
                        </a>
                    </nav>
                    <!-- End -->

                </div>

                <div class="col-lg-8 mb-5 col-md-8 col-xl-9">
                    <!-- Demo Content-->
                    <div class="p-5 bg-white d-flex align-items-center shadow-sm rounded h-100">
                        <div class="demo-content">
                            <p class="lead font-italic">- Demo content:</p>
                            <p class="lead font-italic mb-0">"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat consectetur
                                adipisicing eli exercitation ullamco laboris nisi."</p>
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