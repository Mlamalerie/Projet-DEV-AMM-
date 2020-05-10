
<?php
session_start();
include_once("db/connexiondb.php");

print_r($_GET);
$listeGenres = ['Trap','Afro','Deep','Soul'];



// si le contenu recherché existe et n'est pas vide
if(isset($_GET['q']) && !empty($_GET['q'])) {

    $xxx = (String) trim(($_GET['q']));



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

                //break;
            } 

        }

    }


    $req->execute(array("%".$xxx."%"));
    $resu = $req->fetchAll();

} //si bay recherche vide mais Genre pas vide
else if ( !empty($_GET['Genre']) ) {
    foreach($listeGenres as $gr){

        if($_GET['Genre'] == $gr) {
            $req = $BDD->prepare("SELECT *
                         FROM beat
                         WHERE beat_genre = '$gr'
                         ORDER BY beat_title DESC");
            $req->execute(array());
            $resu = $req->fetchAll();



            print_r("Caca");
        }
    }

} 
else {
    $req = $BDD->prepare("SELECT *
                            FROM beat
                            ORDER BY beat_title DESC");

    $req->execute(array());
    $resu = $req->fetchAll();
    print_r("****");
}










?>
<br><br><br><br>
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
        <link rel="stylesheet" type="text/css" href="css/search.css">

        <title>Search</title>
    </head>
    <body>

        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->
        <?php
        //require_once('skeleton/menu.php');
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




        <h1 class="resultat">Résultats trouvés</h1>

        <div class="rounded container-fluid mb-0">
            <div class="row ">

                <div class="col-lg-4 mb-4 mb-lg-0 col-md-4 col-xl-3">
                    <!--   *************************************************************  -->
                    <!--   ************************** MENU VERTICAL **************************  -->

                    <nav id="menuvertical" class="nav flex-column bg-white shadow-sm font-italic rounded p-3">
                        <form id='formMenuvertical' action="search.php">
                            <div class="list_group">
                                <h4 class="text-white">Trier par prix</h4>
                            </div>

                            <div class="list_group">
                                <h4 class="text-white display-6">Catégories</h4>


                                <span onclick="goGenre(this)" class="nav-link px-4 rounded-pill activer spanGenre" >


                                    <i class="fa fa-circle-o mr-2 icon_activer"></i>
                                    <span id="genre_All" >All</span>
                                    <!--                                    <span class="badge badge-primary px-2 rounded-pill ml-2">45</span>-->

                                </span>

                                <?php foreach($listeGenres as $gr){
                                ?>
                                <span onclick="goGenre(this)" class="nav-link px-4 rounded-pill activer spanGenre" >


                                    <i class="fa fa-circle-o mr-2 icon_activer"></i>
                                    <span id="genre_<?=$gr?>" ><?=$gr?></span>
                                    <!--                                    <span class="badge badge-primary px-2 rounded-pill ml-2">45</span>-->

                                </span>

                                <?php
}
                                ?>


                                <?php if (!empty($_GET['q']))  { ?>
                                <input id='valq' type='hidden' name='q' value='<?= $_GET['q'] ?>'/>
                                <?php } ?>

                                <input id='valGenreMenu' type='hidden' name='Genre' value=''/>

                            </div> 

                            <div class="list_group">
                                <h4 class="text-white">Trier par Date</h4>
                            </div>
                        </form>
                    </nav>


                </div>
                <!--   *************************************************************  -->
                <!--   ************************** RESULTAT **************************  -->
                <div class="col-lg-8 mb-5 col-md-8 col-xl-9">
                    <!-- Demo Content-->
                    <div class="p-5 bg-white d-flex align-items-center shadow-sm rounded h-100">
                        <div class="demo-content">

                            <p class="lead font-italic mb-0">"Lorem ipsumnisi."</p>

                            <?php



                            foreach($resu as $r){



                            ?>

                            <?= $r['beat_title']." "?><?= $r['beat_author']." "?><?= $r['beat_year']." ---"?>

                            <?php

                            }




                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>

            function goGenre(bay){
               

                console.log();
                gr = bay.childNodes[3].innerHTML;

                ok = true;


                 console.log(gr);


                valGenreMenu = document.getElementById('valGenreMenu');
                valGenreMenu.value = gr;
                
                



                if (ok) {
                    document.getElementById('formMenuvertical').submit();

                }




            }

            console.log("a",a);

        </script>


        <?php
        require_once('skeleton/endLinkScripts.php');
        ?>


    </body>
</html>