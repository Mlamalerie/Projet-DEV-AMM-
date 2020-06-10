<?php
session_start();
$_SESSION['ici_index_bool'] = false;
include_once("assets/db/connexiondb.php");
print_r('<br><br><br><br><br><br><br>');
print_r($_GET);

$req = $BDD->prepare("SELECT genre_nom,id FROM genre  ORDER BY genre_nom ASC");
$req->execute(array());
$listeGenres = $req->fetchAll();

var_dump($_POST);


{
    // $_GET[TYPE
    if(isset($_GET['Type']) && !empty($_GET['Type'])) {
        $wetypeexiste = true;
        print_r("type existeuuh");
        if ($_GET['Type'] == "users") {
            $jechercheunboug = true;
        }
        else {
            $jechercheunboug = false;
        }
    }else{
        print_r("type existe pas");
        $wetypeexiste = false;
        $jechercheunboug = false;
    }
    // $_GET[Q
    if(isset($_GET['q']) && !empty($_GET['q'])) {
        $weqexiste = true;
    }else{
        $weqexiste = false;
    }
    // $_GET[GENRE
    if (isset($_GET['Genre']) && !empty($_GET['Genre'])) {
        $wegenreexiste = true;

    }
    else {
        $wegenreexiste = false;
    }

    // $_GET[SORT
    if (isset($_GET['sort']) && !empty($_GET['sort'])) {
        $wesortexiste = true;
        if(!$jechercheunboug){


            if($_GET['sort'] == "populaire") {
                $_GET['trierpar'] = "beat_like";
                $_GET['asc_desc'] = "DESC";

            } else if($_GET['sort'] == "prixcr") {
                $_GET['trierpar'] = "beat_price";
                $_GET['asc_desc'] = "ASC";

            } else if($_GET['sort'] == "prixdecr") {
                $_GET['trierpar'] = "beat_price";
                $_GET['asc_desc'] = "DESC";

            }else if($_GET['sort'] == "vente") {
                $_GET['trierpar'] = "beat_nbvente";
                $_GET['asc_desc'] = "DESC";

            }else if($_GET['sort'] == "aime") {
                $_GET['trierpar'] = "beat_like";
                $_GET['asc_desc'] = "DESC";

            } else {
                $_GET['trierpar'] = "beat_dateupload";
                $_GET['asc_desc'] = "DESC";
            }


        } 
        else if ($jechercheunboug){
            if($_GET['sort'] == "alphacr") {
                $_GET['trierpar'] = "user_pseudo";
                $_GET['asc_desc'] = "ASC";

            } else if($_GET['sort'] == "alphadecr") {
                $_GET['trierpar'] = "user_pseudo";
                $_GET['asc_desc'] = "DESC";


            }


        }
    } // sort par défaut
    else {
        $wesortexiste = false;
        if(!$jechercheunboug){
            $_GET['trierpar'] = "beat_dateupload";
            $_GET['asc_desc'] = "DESC";
        } else if ($jechercheunboug) {
            $_GET['trierpar'] = "user_pseudo";
            $_GET['asc_desc'] = "ASC";

        }

    }
    $trierpar = $_GET['trierpar'];
    $asc_desc = $_GET['asc_desc'];

    // $_GET[PRICE
    if (isset($_GET['Price']) && !empty($_GET['Price'])) {
        $wepriceexiste = true;
        if ($_GET['Price'] == "free") {
            $jeveuxdesfreebeats = true;
            $borneprixinf = 0;
            $borneprixsup = 0;
        }
        else {
            $jeveuxdesfreebeats = false;
            $bornes = explode('-',$_GET['Price']);
            $borneprixinf = $bornes[0];
            $borneprixsup = $bornes[1];
        }
    }
    else {
        $wepriceexiste = false;

    }
}


//DANS LES INSTRU
if ($wetypeexiste && !$jechercheunboug) {
    //******************************************************
    // si on recherche un truc
    if($weqexiste) {

        $xxx = (String) trim(($_GET['q']));

        //*** recherche dans TOUT les genres

        if(($wegenreexiste && $_GET['Genre'] == "All") || !$wegenreexiste) {
            print_r("##");

            // selection des free beats
            if ($wepriceexiste){
                print_r("##");

                print_r("<br> FREEBEATZ+");
                $req = $BDD->prepare("SELECT * FROM (       SELECT *
                                                        FROM beat
                                                        WHERE CONCAT(beat_title,beat_author,beat_description,beat_year)
                                                        LIKE ?  ) base
                                                        WHERE $borneprixinf <= beat_price AND beat_price <= $borneprixsup  
                                                        ORDER BY $trierpar $asc_desc");
            }

            //si ya pas de condition de prix
            else {
                print_r("<br> FREEBEATZ--");
                $req = $BDD->prepare("SELECT *
                                                        FROM beat
                                                        WHERE CONCAT(beat_title,beat_author,beat_description,beat_year)
                                                        LIKE ?
                                                        ORDER BY $trierpar $asc_desc");
            }
        } 

        //*** recherche dans un genre précis
        else {

            //condition de prix
            if($wepriceexiste){
                foreach($listeGenres as $gr){

                    if($wegenreexiste && $_GET['Genre'] == $gr['id'] ) {

                        $g = $gr['id'];
                        $req = $BDD->prepare("SELECT * FROM (
                                                        SELECT * FROM beat
                                                        WHERE CONCAT(beat_title,beat_author,beat_description,beat_year)
                                                        LIKE ? ) base
                                        WHERE beat_genre = '$g' AND ($borneprixinf <= beat_price AND beat_price <= $borneprixsup )
                                        ORDER BY $trierpar $asc_desc");
                    } 

                }

            } 

            // pas de condition de prix
            else {
                foreach($listeGenres as $gr){

                    if($wegenreexiste && $_GET['Genre'] == $gr['id']) {
                        $g = $gr['id'];
                        $req = $BDD->prepare("SELECT * FROM (
                                                        SELECT * FROM beat
                                                        WHERE CONCAT(beat_title,beat_author,beat_description,beat_year)
                                                        LIKE ? ) base
                                        WHERE beat_genre = '$g'
                                        ORDER BY $trierpar $asc_desc");

                    } 

                }
            }

        }


        $req->execute(array("%".$xxx."%"));
        $resuBEATS = $req->fetchAll();

    } //si bay recherche vide mais Genre pas vide
    else if ($wegenreexiste) {

        // si condition de prix
        if ($wepriceexiste){
            if(in_array($_GET['Genre'],$listeGenres)) {
                print_r("<br> >->-> ");

                foreach($listeGenres as $gr){

                    if($_GET['Genre'] == $gr['id']) {
                        $g = $gr['id'];
                        print_r("- ");
                        $req = $BDD->prepare("SELECT *
                         FROM beat
                         WHERE beat_genre = '$g' AND ($borneprixinf <= beat_price AND beat_price <= $borneprixsup )
                         ORDER BY $trierpar $asc_desc");
                        //break;break;
                    }
                }
            }
            else {
                print_r("+ ");
                $req = $BDD->prepare("SELECT *
                            FROM beat
                            WHERE $borneprixinf <= beat_price AND beat_price <= $borneprixsup
                            ORDER BY $trierpar $asc_desc");

            }

        }

        // si pas de condition de prix
        else{
            if(in_array($_GET['Genre'],$listeGenres)) {
                print_r("<br> >->-> ");

                foreach($listeGenres as $gr){

                    if($_GET['Genre'] == $gr['id']) {
                        $g = $gr['id'];
                        print_r("- ");
                        $req = $BDD->prepare("SELECT *
                         FROM beat
                         WHERE beat_genre = '$g'
                         ORDER BY $trierpar $asc_desc");
                        //break;break;
                    }
                }
            }
            else {
                print_r("+ ");
                $req = $BDD->prepare("SELECT *
                            FROM beat
                            ORDER BY $trierpar $asc_desc");

            }
        }

        $req->execute(array());
        $resuBEATS = $req->fetchAll();


    } 

    // si genre vide et q vide
    else {
        if ($wepriceexiste){
            $req = $BDD->prepare("SELECT *
                            FROM beat
                            WHERE $borneprixinf <= beat_price AND beat_price <= $borneprixsup
                            ORDER BY $trierpar $asc_desc");

        }else {
            $req = $BDD->prepare("SELECT *
                            FROM beat
                            ORDER BY $trierpar $asc_desc");

        }

        $req->execute(array());
        $resuBEATS = $req->fetchAll();
        print_r("****-");
    }

}

//DANS LES USERS
else if ($wetypeexiste && $jechercheunboug){

    if($weqexiste) {
        print_r("GANGA");
        $xxx = (String) trim(($_GET['q']));
        $req = $BDD->prepare("SELECT *
                            FROM user
                            WHERE CONCAT(user_pseudo,user_description)
                            LIKE ?
                            ORDER BY $trierpar $asc_desc");



        $req->execute(array("%".$xxx."%"));
        $resuUSERS = $req->fetchAll();



    } else {
        $req = $BDD->prepare("SELECT *
                            FROM user
                            ORDER BY $trierpar $asc_desc");

        $req->execute(array());
        $resuUSERS = $req->fetchAll();

    }



}

//DANS TOUTES CATEGORIES
else if (!$wetypeexiste) {


    if($weqexiste){
        $xxx = (String) trim(($_GET['q']));


        $req = $BDD->prepare("SELECT *
                            FROM user
                            WHERE CONCAT(user_pseudo,user_description)
                            LIKE ?
                            ORDER BY user_pseudo ASC");

        $req->execute(array("%".$xxx."%"));
        $resuUSERS = $req->fetchAll();

        $req = $BDD->prepare("SELECT *
                            FROM beat
                            WHERE CONCAT(beat_title,beat_author,beat_description,beat_year)
                            LIKE ?
                            ORDER BY beat_title ASC");

        $req->execute(array("%".$xxx."%"));
        $resuBEATS = $req->fetchAll();


    }


    else {

        $req = $BDD->prepare("SELECT *
                            FROM user
                            ORDER BY user_pseudo ASC");

        $req->execute(array());
        $resuUSERS = $req->fetchAll();

        $req = $BDD->prepare("SELECT *
                            FROM beat
                            ORDER BY beat_title ASC");

        $req->execute(array());
        $resuBEATS = $req->fetchAll();
    }


}

$yadesresultatsBEATS = false;
if (isset($resuBEATS) && !empty($resuBEATS)){
    $yadesresultatsBEATS = true;
}
$yadesresultatsUSERS = false;

if (isset($resuUSERS) && !empty($resuUSERS)){
    $yadesresultatsUSERS = true;

} 
?>


<?php
$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    print_r($_SESSION);
    $okconnectey = true;
} else{
    echo "Pas de connexion";
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
        <!--  Audio player de mathieu   -->
        <link rel="stylesheet" type="text/css" href="assets/skeleton/AudioPlayer/audioplayer.css">


        <link rel="stylesheet" type="text/css" href="assets/css/navmenuvertical.css">
        <link rel="stylesheet" type="text/css" href="assets/css/navmenuvertical_responsive.css">
        <!--        <link rel="stylesheet" type="text/css" href="assets/css/music_card.css">-->
        <link rel="stylesheet" type="text/css" href="assets/css/search.css">
        <link rel="stylesheet" type="text/css" href="assets/css/modalPanier.css">
        <link rel="stylesheet" type="text/css" href="assets/css/modalUploadAudio.css">

        <style>
            
        </style>



        <title>Search</title>
    </head>
    <body onload=" refreshNbPanier();refreshAllBeats() ">




        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->
        <?php require_once('assets/skeleton/navbar.php');  require_once('assets/functions/js-panier.php');?>


        <div class="rounded container-fluid mb-0">
            <div class="row ">

                <div class="col-lg-4 mb-4 mb-lg-0 col-md-4 col-xl-3">
                    <!--   *************************************************************  -->
                    <!--   ************************** MENU VERTICAL **************************  -->

                    <nav id="menuvertical" class="nav flex-column bg-white shadow-sm font-italic rounded p-3">


                        <div class="list-group">
                            <h4 class="text-white">Type </h4>
                            <form action="search.php" id="formType">

                                <span onclick="goType(this)" class="nav-link px-4 rounded-pill activer text-white" >
                                    <!--   icon croix ou rond -->
                                    <?php if(!$wetypeexiste) { ?>
                                    <i class="far  fa-dot-circle mr-2"></i>
                                    <?php } else { ?> 
                                    <i class="fa fa-circle-o mr-2 icon_activer"></i>
                                    <?php } ?>
                                    <span id="" >All Catégories</span>

                                </span>

                                <span onclick="goType(this)" class="nav-link px-4 rounded-pill activer text-white" >
                                    <!--   icon croix ou rond -->
                                    <?php if($wetypeexiste && $_GET['Type'] == "users") { ?>
                                    <i class="far  fa-dot-circle mr-2"></i>
                                    <?php } else { ?> 
                                    <i class="fa fa-circle-o mr-2 icon_activer"></i>
                                    <?php } ?>
                                    <span id="" >Musiciens</span>

                                </span>

                                <span onclick="goType(this)" class="nav-link px-4 rounded-pill activer text-white " >
                                    <!--   icon croix ou rond -->
                                    <?php if($wetypeexiste && $_GET['Type'] == "beats") { ?>
                                    <i class="far  fa-dot-circle mr-2"></i>
                                    <?php } else { ?> 
                                    <i class="fa fa-circle-o mr-2 icon_activer"></i>
                                    <?php } ?>
                                    <span id="" >Instrumentals</span>

                                </span>



                                <!-- *DIV BAZOUKA D'ENVOIE du Type* -->
                                <div id="icitype">  <span id="wewetype"></span></div>

                                <!-- garder la variable de recherche -->
                                <?php if ($weqexiste)  { ?>
                                <input id='valq11' type='hidden' name='q' value='<?= $_GET['q'] ?>'/>
                                <?php } ?>


                            </form>  


                        </div>

                        <?php if($wetypeexiste && !$jechercheunboug) { ?>
                        <!-- ***** GENRES -->
                        <div class="list-group">
                            <h4 class="text-white display-6">GENRES</h4>
                            <form id='formGenre' action="search.php">

                                <!-- -All Genres-  -->
                                <span onclick="goGenre(this)" class="nav-link px-4 rounded-pill activer " >

                                    <!--   icon croix ou rond -->
                                    <?php if(!$wegenreexiste) { ?>
                                    <i class="far  fa-dot-circle mr-2"></i>
                                    <?php } else { ?> 
                                    <i class="fa fa-circle-o mr-2 icon_activer"></i>
                                    <?php } ?>

                                    <span id="genre_All" >All Genres</span>
                                    <!--                                    <span class="badge badge-primary px-2 rounded-pill ml-2">45</span>-->
                                </span>

                                <?php 
                                                                      foreach($listeGenres as $gr){ 
                                ?>
                                <!-- -Coulissage de tout les autres genres -  -->
                                <span onclick="goGenre(this)" class="nav-link px-4 rounded-pill activer " >
                                    <!--   icon croix ou rond -->
                                    <?php if($wegenreexiste && $_GET['Genre'] == $gr['id']) { ?>
                                    <i class="fas fa-times-circle"></i>
                                    <?php } else { ?> 
                                    <i class="fa fa-circle-o mr-2 icon_activer"></i>
                                    <?php } ?>
                                    <span id="genre_<?= $gr['id']?>"  ><?= $gr['genre_nom']?></span>
                                </span>

                                <?php

                                                                      }
                                ?>

                                <!-- garder la variable de Type -->
                                <?php if ($wetypeexiste)  { ?>
                                <input id='valType22' type='hidden' name='Type' value='<?= $_GET['Type'] ?>'/>
                                <?php } ?>

                                <!-- garder la variable de recherche -->
                                <?php if ($weqexiste)  { ?>
                                <input id='valq22' type='hidden' name='q' value='<?= $_GET['q'] ?>'/>

                                <?php } ?>

                                <!-- *DIV BAZOUKA D'ENVOIE du genre* -->
                                <div id="icigenre">  <span id="wewegenre"></span></div>

                                <!-- garder la variable de trie -->
                                <?php if ($wesortexiste)  { ?>
                                <input id='valsort22' type='hidden' name='sort' value='<?= $_GET['sort'] ?>'/>
                                <?php } ?>

                                <?php if ($wepriceexiste)  { ?>
                                <input id='valprice22' type='hidden' name='Price' value='<?= $_GET['Price'] ?>'/>
                                <?php } ?>




                            </form>

                        </div> 

                        <!-- ***** PRIX -->
                        <div class="list-group">
                            <h4 class="text-white">PRIX </h4>
                            <form action="search.php" id="formPrice">

                                <!-- -All Prix-  -->
                                <span onclick="goPrice(this)" class="nav-link px-4 rounded-pill activer " >

                                    <!--   icon croix ou rond -->
                                    <?php if(!$wepriceexiste) { ?>
                                    <i class="far  fa-dot-circle mr-2 "></i>
                                    <?php } else { ?> 
                                    <i class="fa fa-circle-o mr-2 icon_activer"></i>
                                    <?php } ?>

                                    <span>All Prix</span>
                                    <!--                                    <span class="badge badge-primary px-2 rounded-pill ml-2">45</span>-->
                                </span>


                                <span onclick="goPrice(this)" class="nav-link px-4 rounded-pill activer " >
                                    <!--   icon croix ou rond -->
                                    <?php if($wepriceexiste && $_GET['Price'] == "free") { ?>
                                    <i class="fas fa-times-circle"></i>
                                    <?php } else { ?> 
                                    <i class="fa fa-circle-o mr-2 icon_activer"></i>
                                    <?php } ?>
                                    <span id="price_Price" >Free Beats</span>

                                </span>

                                <!-- garder la variable de Type -->
                                <?php if ($wetypeexiste)  { ?>
                                <input id='valType33' type='hidden' name='Type' value='<?= $_GET['Type'] ?>'/>
                                <?php } ?>

                                <!-- garder la variable de recherche -->
                                <?php if ($weqexiste)  { ?>
                                <input id='valq33' type='hidden' name='q' value='<?= $_GET['q'] ?>'/>
                                <?php } ?>
                                <!-- garder la variable de genre -->
                                <?php if ($wegenreexiste)  { ?>
                                <input id='valGenre33' type='hidden' name='Genre' value='<?= $_GET['Genre'] ?>'/>
                                <?php } ?>
                                <!-- garder la variable de trie -->
                                <?php if ($wesortexiste)  { ?>
                                <input id='valsort33' type='hidden' name='sort' value='<?= $_GET['sort'] ?>'/>
                                <?php } ?>

                                <!-- *DIV BAZOUKA D'ENVOIE du price* -->
                                <div id="iciprice">  <span id="weweprice"></span></div>


                            </form>  

                            <form action="search.php" id="formPrice2">

                                <!-- Fourchete de prix -->
                                <div class="wrapper fourchettes2prix mt-4">
                                    <div class="container">

                                        <div class="slider-wrapper">
                                            <div id="slider-range"></div>
                                            <div class="range mt-3"></div>
                                            <div class="range-wrapper">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- garder la variable de Type -->
                                <?php if ($wetypeexiste)  { ?>
                                <input id='valType44' type='hidden' name='Type' value='<?= $_GET['Type'] ?>'/>
                                <?php } ?>

                                <!-- garder la variable de recherche -->
                                <?php if ($weqexiste)  { ?>
                                <input id='valq44' type='hidden' name='q' value='<?= $_GET['q'] ?>'/>
                                <?php } ?>
                                <!-- garder la variable de genre -->
                                <?php if ($wegenreexiste)  { ?>
                                <input id='valGenre44' type='hidden' name='Genre' value='<?= $_GET['Genre'] ?>'/>
                                <?php } ?>
                                <!-- garder la variable de trie -->
                                <?php if ($wesortexiste)  { ?>
                                <input id='valsort44' type='hidden' name='sort' value='<?= $_GET['sort'] ?>'/>
                                <?php } ?>

                            </form> 


                        </div>

                        <?php } ?>


                    </nav>
                    <!--   END <nav> Menu vertical      -->


                </div>
                <!--   *************************************************************  -->
                <!--   ************************** RESULTAT**************************  -->
                <!--   *************************************************************  -->
                <!--   *************************************************************  -->
                <div class="col-lg-8 mb-5 col-md-8 col-xl-9 m-0 " style="background-color : yellow;">


                    <?php if (!empty($_GET['q']))  { ?>
                    <div class="">
                        <div class=" bg-dark mx-auto mt-4">
<span class="play-audio-icon"></span>
                            <h1 class="display-4">Résultats de recherche pour "<?= $_GET['q'] ?>"</h1>



                        </div>

                    </div>
                    <?php } ?>

                    <!--   *************************************************************  -->
                    <!--   ************************** RESULTAT BEAT **************************  -->

                    <?php if (!$jechercheunboug || (!$wetypeexiste)) { ?>



                    <div class="container-fluid  d-flex mx-3">
                        <div class="row col-6 bg-danger">
                            <p class="lead mx-4  ">
                                <?php 

    if ($yadesresultatsUSERS && $yadesresultatsBEATS) {
        $obj1 = count($resuBEATS)." beats trouvé, ";
        $obj2 = count($resuUSERS)." personnes trouvées";
        print_r($obj1);
        print_r($obj2);
    } else if ($yadesresultatsUSERS) {

        $obj1 = count($resuUSERS)." personnes trouvées";
        print_r($obj1);
    } else if ($yadesresultatsBEATS) {
        $obj1 = count($resuBEATS)." beats trouvé";

        print_r($obj1);
    } else {
        $obj1 = "Rien trouvé";

        print_r($obj1);

    }


                                ?> 

                            </p>

                        </div>
                        <?php if (($wetypeexiste && !$jechercheunboug)) { ?>
                        <div class="row col-6 bg-success d-flex align-items-center justify-content-end mx-3">

                            <form  id="formTrie" action="search.php">
                                <!-- garder la variable de Type -->
                                <?php if ($wetypeexiste)  { ?>
                                <input id='valType55' type='hidden' name='Type' value='<?= $_GET['Type'] ?>'/>
                                <?php } ?>
                                <!-- garder la variable de recherche -->
                                <?php if ($weqexiste)  { ?>
                                <input id='valq55' type='hidden' name='q' value='<?= $_GET['q'] ?>'/>
                                <?php } ?>
                                <!-- garder la variable de genre -->
                                <?php if ($wegenreexiste)  { ?>
                                <input id='valGenre55' type='hidden' name='Genre' value='<?= $_GET['Genre'] ?>'/>
                                <?php } ?>
                                <!-- garder la variable de prix -->
                                <?php if ($wepriceexiste)  { ?>
                                <input id='valprice55' type='hidden' name='Price' value='<?= $_GET['Price'] ?>'/>
                                <?php } ?>

                                <select id='sort' name="sort" class="custom-select " onchange="goTrier()">
                                    <option value="nouveaute" <?php if($wesortexiste && $_GET['sort'] == 'nouveaute'){?> selected <?php } ?>>Nouveautés en premier </option>
                                    <option value="vente"  <?php if($wesortexiste && $_GET['sort'] == 'vente'){?> selected <?php } ?> >Les + vendus </option>
                                    <option value="aime"  <?php if($wesortexiste && $_GET['sort'] == 'aime'){?> selected <?php } ?> >Les + aimé</option>
                                    <option value="prixcr" <?php if($wesortexiste && $_GET['sort'] == 'prixcr'){?> selected <?php } ?>>Prix croissant </option>
                                    <option value="prixdecr"  <?php if($wesortexiste && $_GET['sort'] == 'prixdecr'){?> selected <?php } ?>>Prix décroissant </option>
                                </select>
                            </form>
                        </div> <?php } ?>
                    </div>




                    <div id="resultcontent"  class="pt-3 pb-3 d-flex shadow-sm rounded h-100    bg-primary" >


                        <?php  require_once('assets/skeleton/tableBeatSearch.php'); ?>




                    </div>

                    <!--  END div blue -->


                    <p class="lead font-italic mb-0">"Lorem ipsumnisi."</p>

                    <?php } //end je cherche une prod ?>
                    <!--   *************************************************************  -->
                    <!--   ************************** RESULTAT USER **************************  -->
                    <?php if ($jechercheunboug || (!$wetypeexiste)) { ?>
                    <?php if (($wetypeexiste && $jechercheunboug)) { ?>
                    <form id="formTrie2" action="search.php">

                        <!-- garder la variable de Type -->
                        <?php if ($wetypeexiste)  { ?>
                        <input id='valType55' type='hidden' name='Type' value='<?= $_GET['Type'] ?>'/>
                        <?php } ?>
                        <!-- garder la variable de recherche -->
                        <?php if ($weqexiste)  { ?>
                        <input id='valq55' type='hidden' name='q' value='<?= $_GET['q'] ?>'/>
                        <?php } ?>
                        <!-- garder la variable de genre -->
                        <?php if ($wegenreexiste)  { ?>
                        <input id='valGenre55' type='hidden' name='Genre' value='<?= $_GET['Genre'] ?>'/>
                        <?php } ?>
                        <!-- garder la variable de prix -->
                        <?php if ($wepriceexiste)  { ?>
                        <input id='valprice55' type='hidden' name='Price' value='<?= $_GET['Price'] ?>'/>
                        <?php } ?>
                        <select id='sortuser' name="sort" class="custom-select " onchange="goTrier2()">




                            <option value="alphacr" <?php if($wesortexiste && $_GET['sort'] == 'alphacr'){?> selected <?php } ?>>Ordre Alphabétique (A - Z) </option>
                            <option value="alphadecr" <?php if($wesortexiste && $_GET['sort'] == 'alphadecr'){?> selected <?php } ?>>Ordre Alphabétique (Z - A) </option>


                        </select>
                    </form>
                    <?php } ?>
                    <div id="resultuser"  class="pt-3 pb-3 d-flex shadow-sm rounded h-100" style="background-color : blue;">
                        <?php  if (isset($resuUSERS)) {
    foreach($resuUSERS as $r){ 

        if( ($r['user_role'] == 2 || $r['user_role'] == 0) && ($r['user_statut'] == 1) ) {
                        ?>



                        <!-- Team item-->
                        <div class="col-xl-3 col-sm-6 mb-5 text-center">


                            <div class=" rounded shadow-sm py-3 px-3"><a href="profils.php?profil_id=<?= $r['user_id']?>">
                                <img src="<?=$r['user_image'] ?>" alt=""  class="img-fluid roundedImage img-thumbnail shadow-sm">
                                <h5 class="mb-0"><a href="profils.php?profil_id=<?= $r['user_id']?>"><?=$r['user_pseudo'] ?></a></h5>

                                <span class="small  text-muted"><?=$r['user_ville'] ?>
                                    <span class="text-uppercase ">

                                        <?php

                            //*** Verification du Pays
                            $req = $BDD->prepare("SELECT * 
                            FROM pays
                            WHERE code = ?");
            $req->execute(array($r['user_pays'] ));
            $aff_pays = $req->fetch();

            echo '('.$aff_pays['nom_fr_fr'].')';
                                        ?>

                                    </span>
                                </span>

                                </a>
                            </div>
                        </div>



                        <?php    }    
    }
} ?>



                    </div>

                    <?php } ?>



                </div>
                <!--   END divResultat Jaune -->


            </div>
        </div>
        <!--   END MENU + RESULTAT (Tout le container)-->


        <?php
        require_once('assets/skeleton/endLinkScripts.php');
        ?>
        <!-- JS de Fourchette -->
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script>

            $(function() {

                // Initiate Slider
                $('#slider-range').slider({
                    range: true,
                    min: 0,
                    max: 100,
                    step: 5,
                    values: [

                        <?php if($wepriceexiste && ($_GET['Price'] != "free")){
    print_r($borneprixinf);
    print_r(",");print_r($borneprixsup);}

                        else { 

                            print_r("0,100");
                        } ?>

                    ]
                });

                // Move the range wrapper into the generated divs
                $('.ui-slider-range').append($('.range-wrapper'));

                // Apply initial values to the range container
                $('.range').html('<input id="rangeBorneInf" class="range-value" type="text" value="' + $('#slider-range').slider("values",0 ).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '"><span class="range-divider"></span><input id="rangeBorneSup" class="range-value" type="text" value="' + $("#slider-range").slider("values", 1).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '"> <input name="Price" type="hidden" value="'+$('#slider-range').slider("values", 0).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '-' + $("#slider-range").slider("values", 1).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '"> ');

                // Show the gears on press of the handles0
                $('.ui-slider-handle, .ui-slider-range').on('mousedown', function() {
                    $('.gear-large').addClass('active');

                });

                $('.ui-slider-handle, .ui-slider-range').on('mouseup', function(){
                    let ok = true;
                    $("#formPrice2").submit();

                });




                // Hide the gears when the mouse is released
                // Done on document just incase the user hovers off of the handle
                $(document).on('mouseup', function() {
                    if ($('.gear-large').hasClass('active')) {
                        $('.gear-large').removeClass('active');
                    }
                });

                // Rotate the gears
                var gearOneAngle = 0,
                    gearTwoAngle = 0,
                    rangeWidth = $('.ui-slider-range').css('width');

                $('.gear-one').css('transform', 'rotate(' + gearOneAngle + 'deg)');
                $('.gear-two').css('transform', 'rotate(' + gearTwoAngle + 'deg)');

                $('#slider-range').slider({
                    slide: function(event, ui) {

                        // Update the range container values upon sliding
                        let inputenvoie2 = '<input name="Price" type="hidden" value="'+ui.values[0].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '-' +  ui.values[1].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '">';


                        $('.range').html('<input id="rangeBorneInf" class="range-value" type="text" value="'  + ui.values[0].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '"><span class="range-divider"></span><input id="rangeBorneSup" class="range-value" type="text" value="' + ui.values[1].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '"> '

                                         + inputenvoie2

                                        );

                        // Get old value
                        var previousVal = parseInt($(this).data('value'));

                        // Save new value
                        $(this).data({
                            'value': parseInt(ui.value)
                        });

                        // Figure out which handle is being used
                        if (ui.values[0] == ui.value) {

                            // Left handle
                            if (previousVal > parseInt(ui.value)) {
                                // value decreased
                                gearOneAngle -= 7;
                                $('.gear-one').css('transform', 'rotate(' + gearOneAngle + 'deg)');
                            } else {
                                // value increased
                                gearOneAngle += 7;
                                $('.gear-one').css('transform', 'rotate(' + gearOneAngle + 'deg)');
                            }

                        } else {

                            // Right handle
                            if (previousVal > parseInt(ui.value)) {
                                // value decreased
                                gearOneAngle -= 7;
                                $('.gear-two').css('transform', 'rotate(' + gearOneAngle + 'deg)');
                            } else {
                                // value increased
                                gearOneAngle += 7;
                                $('.gear-two').css('transform', 'rotate(' + gearOneAngle + 'deg)');
                            }

                        }

                        if (ui.values[1] === 105) {
                            if (!$('.range-alert').hasClass('active')) {
                                $('.range-alert').addClass('active');
                            }
                        } else {
                            if ($('.range-alert').hasClass('active')) {
                                $('.range-alert').removeClass('active');
                            }
                        }
                    }
                });

                // Prevent the range container from moving the slider
                $('.range, .range-alert').on('mousedown', function(event) {
                    event.stopPropagation();
                });

            });

        </script>
        <!--   END JS de fourchette      -->
        <script >

            function goSearch() {
                let ok = true;
                let champs = document.getElementById('searchbar');


                if (champs.value.trim().length == 0) {
                    ok = false; 

                }

                if (ok) {
                    document.getElementById('searchform').submit();

                }


            }

            function goType(bay) {


                ok = true;
                // si il ya l'icon rond rempli alors 
                if ("fa-dot-circle" == bay.children[0].classList[1] ) {
                    console.log("rond rempli");
                    ok = false; // ne rien envoyer

                } // si il ya l'icon croix alors 
                else if ("fa-dot-circle" == bay.children[0].classList[1] ) {
                    console.log("rond rempli");
                    ok = false;

                }
                // si il ya l'icon rond alors 
                else {
                    console.log("rond");
                    let okok = true;
                    // recuperer le genre
                    let ty = bay.children[1].innerHTML;

                    if (ty == "Musiciens"){ty = 'users'};
                    if (ty == "Instrumentals"){ty = 'beats'};

                    console.log("ty : ",ty);
                    if (ty == 'All Catégories'){okok = false;}


                    if (okok){
                        // cration d'un input

                        let ici = document.getElementById('icitype');
                        let avant = document.getElementById('wewetype');

                        if (ici.children.length < 2) {
                            let input = document.createElement('input');
                            input.id = 'valTypeMenu';
                            input.type = 'hidden';
                            input.name = 'Type';

                            // poser le genre sur le input d'envoie
                            input.value = ty;

                            ici.insertBefore(input,avant);
                        }
                    }
                }


                if (ok) {
                    document.getElementById('formType').submit();

                }




            }

            function goGenre(bay){

                ok = true;
                // si il ya l'icon rond rempli alors 
                if ("fa-dot-circle" == bay.children[0].classList[1] ) {
                    console.log("rond rempli");
                    ok = false; // ne rien envoyer

                } // si il ya l'icon croix alors 
                else if ("fa-times-circle" == bay.children[0].classList[1] ) {
                    console.log("croix"); // envoyer du vide

                }
                // si il ya l'icon rond alors 
                else {
                    console.log("rond");
                    let okok = true;

                    // recuperer le genre
                    gr = bay.children[1].id.split('_')[1];
                    console.log("gr : ",gr);
                    if (gr == 'All Genres'){okok = false;}



                    if (okok){
                        // cration d'un input

                        let ici = document.getElementById('icigenre');
                        let avant = document.getElementById('wewegenre');

                        if (ici.children.length < 2) {
                            let input = document.createElement('input');
                            input.id = 'valGenreMenu';
                            input.type = 'hidden';
                            input.name = 'Genre';

                            // poser le genre sur le input d'envoie
                            input.value = gr;

                            ici.insertBefore(input,avant);
                            console.log(input);
                        }
                    }

                }
                if (ok) {
                    document.getElementById('formGenre').submit();

                }
            }


            function goPrice(bay) {
                ok = true;
                // si il ya l'icon rond rempli alors 
                if ("fa-dot-circle" == bay.children[0].classList[1] ) {
                    console.log("rond rempli");
                    ok = false; // ne rien envoyer

                }
                // si il ya l'icon croix alors
                else if ("fa-times-circle" == bay.children[0].classList[1] ) {
                    console.log("croix");

                }
                // si il ya l'icon rond alors 
                else {
                    console.log("rond");
                    okok = true;
                    // recuperer le genre
                    fr = bay.children[1].innerHTML;
                    console.log("fr : ",fr);
                    if (fr == "Free Beats") {fr = "free";}
                    if (fr == "All Prix") {okok = false;}
                    if (okok){
                        // cration d'un input

                        let ici = document.getElementById('iciprice');
                        let avant = document.getElementById('weweprice');

                        if (ici.children.length < 2) {
                            let input = document.createElement('input');
                            input.id = 'valPriceMenu3';
                            input.type = 'hidden';
                            input.name = 'Price';

                            // poser le genre sur le input d'envoie
                            input.value = fr;
                            ici.insertBefore(input,avant);
                        }
                    }

                }

                if (ok) {
                    document.getElementById('formPrice').submit();

                }



            }

            function goTrier(bay){
                ok = true;
                if (ok) {
                    document.getElementById('formTrie').submit();

                }

            }
            function goTrier2(bay){
                ok = true;
                if (ok) {
                    document.getElementById('formTrie2').submit();

                }

            }

        </script>

        <!--   *************************************************************  -->
        <!--   ************************** MUSIC PLAYER  **************************  -->
        <?php
        require_once('assets/skeleton/AudioPlayer/audioplayer.php');
        ?>

    </body>
</html>