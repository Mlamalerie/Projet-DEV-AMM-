
<?php
session_start();
include_once("assets/db/connexiondb.php");

print_r($_GET);
$listeGenres = ['Hip Hop','Trap','Afro Beat','Deep','Soul','Mlamali'];
sort($listeGenres);



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


    print_r($_GET['Genre']);

    foreach($listeGenres as $gr){
        print_r("<br> > ");
        print_r($gr);

        if($_GET['Genre'] == $gr) {
            print_r("- ");
            $req = $BDD->prepare("SELECT *
                         FROM beat
                         WHERE beat_genre = '$gr'
                         ORDER BY beat_title DESC");
        //break;break;


        }
        
//        else {
//            print_r("+ ");
//            $req = $BDD->prepare("SELECT *
//                            FROM beat
//                            ORDER BY beat_title DESC");
//
//        }

        $req->execute(array());
        $resu = $req->fetchAll();
    }

} 
else {
    $req = $BDD->prepare("SELECT *
                            FROM beat
                            ORDER BY beat_title DESC");

    $req->execute(array());
    $resu = $req->fetchAll();
    print_r("****-");
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



        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
        <link rel="stylesheet" type="text/css" href="assets/css/navmenuvertical.css">
        <link rel="stylesheet" type="text/css" href="assets/css/navmenuvertical_responsive.css">
        <link rel="stylesheet" type="text/css" href="assets/css/search.css">



        <title>Search</title>
    </head>
    <body>

        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->
        <?php
        //require_once('assets/skeleton/menu.php');
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
                                    <span id="genre_<?= $gr?>" ><?= $gr?></span>
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
                <div class="col-lg-8 mb-5 col-md-8 col-xl-9 m-0 " style="background-color : yellow;">
                    <?php if (!empty($_GET['q']))  { ?>
                    <h1 class="resultat">Résultats de recherche pour "<?= $_GET['q'] ?>"</h1>
                    <?php } ?>
                    <!-- Demo Content-->
                    <div id="resultcontent"  class="pt-3 pb-3 d-flex shadow-sm rounded h-100" style="background-color : cyan;">

                        <div class=" container-fluid ligneCardMusic">
                            <?php
                            foreach($resu as $r){
                            ?>
                            <div class="row justify-content-center p-0 mx-auto mb-2 rounded"  style="background-color : pink;">

                                <div class="col-sm-2 p-0  " style="background-color : red;">
                                    <img  src="img/Laylow.jpg" width="80"  >


                                </div>

                                <div class=" col-sm-6 align-middle  " style="background-color : blue;">

                                    <span class='TitleCardMusic'><?=$r['beat_title']?> </span>
                                    <span class='authorCardMusic'><?=$r['beat_author']?> </span>
                                    <span class='GenreCardMusic'><?=$r['beat_genre']?> </span>



                                </div>




                                <div class=" col-sm-4  row align-items-center justify-content-center rounded-right" style="background-color : green;"> 
                                    <span> (Likes ) </span>

                                    <a class="btn btn-danger" href="#" role="button"><?=$r['beat_price']?> €</a>


                                </div>

                            </div>
                            <?php

                            }

                            ?>
                        </div>


                    </div>

                    <p class="lead font-italic mb-0">"Lorem ipsumnisi."</p>

                    <?php
                    foreach($resu as $r){

                    ?>

                    <?= "<br>".$r['beat_title']." "?><?= $r['beat_author']." "?><?= $r['beat_year']." ---"?>

                    <?php

                    }

                    ?>

                    <?php
                    $i = 0;
                    foreach($resu as $r){ 

                    ?>

                    en travaux

                    <?php

                        $i++;
                    }

                    ?>
                    <div class="col-md-3">
                        <a  class="album-poster" data-switch="0">
                            <img src="img/roddy.jpg">
                        </a>
                        <h4>Titre</h4>
                        <p>Nom artiste</p>
                    </div>



                </div>
                <!--   END divResultat -->

            </div>
        </div>
        <!--   END MENU + RESULTAT -->




        <script>


            function goGenre(bay){


                console.log();
                gr = bay.children[1].innerHTML;

                // for (var i = 0; i < bay.children)
                console.log("bay",bay.children);

                console.log("gr",gr);
                ok = true;


                console.log(gr);


                valGenreMenu = document.getElementById('valGenreMenu');
                valGenreMenu.value = gr;





                if (ok) {
                    document.getElementById('formMenuvertical').submit();

                }




            }



        </script>


        <?php
        require_once('assets/skeleton/endLinkScripts.php');
        ?>


    </body>
</html>