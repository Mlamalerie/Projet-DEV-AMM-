
<?php
session_start();
include_once("assets/db/connexiondb.php");

print_r($_GET);
$listeGenres = ['Hip Hop','Trap','Afro','Deep','House','DanceHall','Soul','Pop','Rock','Techno','Reggae','World','Jazz'];
sort($listeGenres);
$_SESSION["listeGenres"] = $listeGenres;


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

    if($_GET['sort'] == "populaire") {
        $_GET['trierpar'] = "beat_like";
        $_GET['asc_desc'] = "DESC";

    } else if($_GET['sort'] == "prixcr") {
        $_GET['trierpar'] = "beat_price";
        $_GET['asc_desc'] = "ASC";

    } else if($_GET['sort'] == "prixdecr") {
        $_GET['trierpar'] = "beat_price";
        $_GET['asc_desc'] = "DESC";

    } else {
        $_GET['trierpar'] = "beat_dateupload";
        $_GET['asc_desc'] = "DESC";

    }


} else {
    $wesortexiste = false;
    $_GET['trierpar'] = "beat_dateupload";
    $_GET['asc_desc'] = "DESC";

}
$trierpar = $_GET['trierpar'];
$asc_desc = $_GET['asc_desc'];

// $_GET[PRICE
if (isset($_GET['Price']) && !empty($_GET['Price'])) {
    $wepriceexiste = true;
    if ($_GET['Price'] == "free") {
        $borneprixinf = 0;
        $borneprixsup = 0;
    }else {


    }
}
else {
    $wepriceexiste = false;

}

//******************************************************
// si on recherche un truc
if($weqexiste) {

    $xxx = (String) trim(($_GET['q']));

    //*** recherche dans tout les genres

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
                                                        WHERE beat_price = 0
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
        if($wepriceexiste){
            foreach($listeGenres as $gr){

                if($wegenreexiste && $_GET['Genre'] == $gr ) {
                    $req = $BDD->prepare("SELECT * FROM (
                                                        SELECT * FROM beat
                                                        WHERE CONCAT(beat_title,beat_author,beat_description,beat_year)
                                                        LIKE ? ) base
                                        WHERE beat_genre = '$gr' AND ($borneprixinf <= beat_price AND beat_price <= $borneprixsup )
                                        ORDER BY $trierpar $asc_desc");
                } 

            }

        }

        // pas de condition de prix
        else {
            foreach($listeGenres as $gr){

                if($wegenreexiste && $_GET['Genre'] == $gr) {
                    $req = $BDD->prepare("SELECT * FROM (
                                                        SELECT * FROM beat
                                                        WHERE CONCAT(beat_title,beat_author,beat_description,beat_year)
                                                        LIKE ? ) base
                                        WHERE beat_genre = '$gr'
                                        ORDER BY $trierpar $asc_desc");

                } 

            }
        }

    }


    $req->execute(array("%".$xxx."%"));
    $resu = $req->fetchAll();

} //si bay recherche vide mais Genre pas vide
else if ($wegenreexiste) {

    if(in_array($_GET['Genre'],$listeGenres)) {

        foreach($listeGenres as $gr){
            print_r("<br> > ");
            print_r($gr);

            if($_GET['Genre'] == $gr) {
                print_r("- ");
                $req = $BDD->prepare("SELECT *
                         FROM beat
                         WHERE beat_genre = '$gr'
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

    $req->execute(array());
    $resu = $req->fetchAll();


} 

// si genre vide et q vide
else {
    $req = $BDD->prepare("SELECT *
                            FROM beat
                            ORDER BY $trierpar $asc_desc");

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
        <link rel="stylesheet" type="text/css" href="assets/css/music_card.css">
        <link rel="stylesheet" type="text/css" href="assets/css/search.css">




        <title>Search</title>
    </head>
    <body>

        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->
        <?php
        //require_once('assets/skeleton/menu.php');
        ?>

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
                        <form id='formGenre' action="search.php">

                            <!-- ** GENRES -->
                            <div class="list-group">
                                <h4 class="text-white display-6">GENRES</h4>
                                <!-- -All Genres-  -->
                                <span onclick="goGenre(this)" class="nav-link px-4 rounded-pill activer spanGenre" >

                                    <!--   icon croix ou rond -->
                                    <?php if($wegenreexiste && $_GET['Genre'] == "All") { ?>
                                    <i class="fas fa-times-circle"></i>
                                    <?php } else { ?> 
                                    <i class="fa fa-circle-o mr-2 icon_activer"></i>
                                    <?php } ?>

                                    <span id="genre_All" >All Genres</span>
                                    <!--                                    <span class="badge badge-primary px-2 rounded-pill ml-2">45</span>-->
                                </span>

                                <?php foreach($listeGenres as $gr){
                                ?>
                                <!-- -Coulissage de tout les autres genres -  -->
                                <span onclick="goGenre(this)" class="nav-link px-4 rounded-pill activer spanGenre" >
                                    <!--   icon croix ou rond -->
                                    <?php if($wegenreexiste && $_GET['Genre'] == $gr) { ?>
                                    <i class="fas fa-times-circle"></i>
                                    <?php } else { ?> 
                                    <i class="fa fa-circle-o mr-2 icon_activer"></i>
                                    <?php } ?>
                                    <span id="genre_<?= $gr?>" ><?= $gr?></span>
                                </span>

                                <?php
}
                                ?>

                                <!-- garder la variable de recherche -->
                                <?php if ($weqexiste)  { ?>
                                <input id='valq' type='hidden' name='q' value='<?= $_GET['q'] ?>'/>
                                <?php } ?>
                                <!-- garder la variable de trie -->
                                <?php if ($wesortexiste)  { ?>
                                <input id='valsort' type='hidden' name='sort' value='<?= $_GET['sort'] ?>'/>
                                <?php } ?>

                                <?php if ($wepriceexiste)  { ?>
                                <input id='valprice' type='hidden' name='sort' value='<?= $_GET['Price'] ?>'/>
                                <?php } ?>

                                <!-- *DIV BAZOUKA D'ENVOIE du genre* -->
                                <div id="icigenre">  <span id="wewegenre"></span></div>




                            </div> 
                        </form>

                        <div class="list-group">
                            <form action="search.php" id="formPrice">
                                <h4 class="text-white">PRIX </h4>
                                <span onclick="goPrice(this)" class="nav-link px-4 rounded-pill activer spanGenre" >
                                     <!--   icon croix ou rond -->
                                    <?php if($wepriceexiste && $_GET['Price'] == "free") { ?>
                                    <i class="fas fa-times-circle"></i>
                                    <?php } else { ?> 
                                    <i class="fa fa-circle-o mr-2 icon_activer"></i>
                                    <?php } ?>
                                    <span id="price_Price" >Free Beats</span>


                                    <!--                                    <input id='valPriceFreeMenu' type='hidden' name='Price' value='free'/>-->

                                </span>



                                <!-- Fourchete de prix -->
                                <!--
<div class="wrapper fourchettes2prix">
<div class="container">

<div class="slider-wrapper">
<div id="slider-range"></div>

<div class="range-wrapper">
<div class="range"></div>
<div class="range-alert">+</div>

<div class="gear-wrapper">
<div class="gear-large gear-one">
<div class="gear-tooth"></div>
<div class="gear-tooth"></div>
<div class="gear-tooth"></div>
<div class="gear-tooth"></div>
</div>
<div class="gear-large gear-two">
<div class="gear-tooth"></div>
<div class="gear-tooth"></div>
<div class="gear-tooth"></div>
<div class="gear-tooth"></div>
</div>
</div>

</div>

<div class="marker marker-0"><sup>$</sup>10,000</div>
<div class="marker marker-25"><sup>$</sup>35,000</div>
<div class="marker marker-50"><sup>$</sup>60,000</div>
<div class="marker marker-75"><sup>$</sup>85,000</div>
<div class="marker marker-100"><sup>$</sup>110,000+</div>
</div>

</div>
</div>
-->

                                <!-- garder la variable de recherche -->
                                <?php if ($weqexiste)  { ?>
                                <input id='valq3' type='hidden' name='q' value='<?= $_GET['q'] ?>'/>
                                <?php } ?>
                                <!-- garder la variable de genre -->
                                <?php if ($wegenreexiste)  { ?>
                                <input id='valGenre3' type='hidden' name='Genre' value='<?= $_GET['Genre'] ?>'/>
                                <?php } ?>
                                <!-- garder la variable de trie -->
                                <?php if ($wesortexiste)  { ?>
                                <input id='valsort3' type='hidden' name='sort' value='<?= $_GET['sort'] ?>'/>
                                <?php } ?>

                                <!-- *DIV BAZOUKA D'ENVOIE du price* -->
                                <div id="iciprice">  <span id="weweprice"></span></div>

                            </form>          
                        </div>



                    </nav>
                    <!--   END Menu vertical      -->


                </div>
                <!--   *************************************************************  -->
                <!--   ************************** RESULTAT **************************  -->
                <div class="col-lg-8 mb-5 col-md-8 col-xl-9 m-0 " style="background-color : yellow;">


                    <?php if (!empty($_GET['q']))  { ?>
                    <div class="row mb-5">
                        <div class="col-lg-7 mx-auto">

                            <h1 class="display-4">Résultats de recherche pour "<?= $_GET['q'] ?>"</h1>

                            <p class="lead mb-0">(Nombre de résultat)</p>

                        </div>
                    </div>
                    <?php } ?>

                    <form id="formTrie" action="search.php">
                        <select id='sort' name="sort" class="custom-select " onchange="goTrier()">
                            <option value="nouveaute" <?php if($wesortexiste && $_GET['sort'] == 'nouveaute'){?> selected <?php } ?>>Nouveautés en premier </option>
                            <option value="populaire"  <?php if($wesortexiste && $_GET['sort'] == 'populaire'){?> selected <?php } ?> >Popularité </option>
                            <option value="prixcr" <?php if($wesortexiste && $_GET['sort'] == 'prixcr'){?> selected <?php } ?>>Prix croissant </option>
                            <option value="prixdecr"  <?php if($wesortexiste && $_GET['sort'] == 'prixdecr'){?> selected <?php } ?>>Prix décroissant </option>
                        </select>


                        <?php if ($weqexiste)  { ?>
                        <input id='valq2' type='hidden' name='q' value='<?= $_GET['q'] ?>'/>
                        <?php } ?>
                        <?php if ($wegenreexiste)  { ?>
                        <input id='valGenre2' type='hidden' name='Genre' value='<?= $_GET['Genre'] ?>'/>
                        <?php } ?>

                        <?php if ($wepriceexiste)  { ?>
                        <input id='valprice2' type='hidden' name='Price' value='<?= $_GET['Price'] ?>'/>
                        <?php } ?>

                    </form>



                    <!-- Demo Content-->
                    <div id="resultcontent"  class="pt-3 pb-3 d-flex shadow-sm rounded h-100" style="background-color : cyan;">

                        <div class=" container-fluid ligneCardMusic">
                            <?php

                            $i = 1;
                            foreach($resu as $r){
                            ?>
                            <div class="row justify-content-center p-0 mx-auto mb-2 rounded"  style="background-color : pink;">
                                <?= $i ?>

                                <div class="col-sm-2 p-0  " style="background-color : red;">
                                    <img  src="img/Laylow.jpg" width="80"  >


                                </div>

                                <div class=" d-flex col-sm-6 align-middle  " style="background-color : blue; flex-direction : row;">

                                    <span class='TitleCardMusic'><?=$r['beat_title']?> </span>
                                    <span class='authorCardMusic'><?=$r['beat_author']?> </span>
                                    <span class='GenreCardMusic'><?=$r['beat_genre']?> </span>

                                    <div style="background-color : green;"> 
                                        <span> (Likes ) </span>

                                        <a class="btn btn-danger" href="#" role="button"><?=$r['beat_price']?> €</a><?=$r['beat_dateupload']?> ---


                                    </div>


                                </div>



                            </div>
                            <?php
                                $i++;
                            }


                            ?>
                        </div>
                        <!--  END -->



                    </div>
                    <!--  END div blue -->
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">First item</li>
                        <li class="list-group-item">Second item</li>
                        <li class="list-group-item">Third item</li>
                        <li class="list-group-item">Fourth item</li>
                    </ul> 

                    <p class="lead font-italic mb-0">"Lorem ipsumnisi."</p>

                    <?php
                    foreach($resu as $r){

                    ?>

                    <?= "<br>".$r['beat_title']." "?><?= $r['beat_author']." "?><?= $r['beat_year']." ---"?>

                    <?php

                    }

                    ?>






                </div>
                <!--   END divResultat -->

            </div>
        </div>
        <!--   END MENU + RESULTAT -->




        <script src="assets/js/search.js"></script>



        <?php
        require_once('assets/skeleton/endLinkScripts.php');
        ?>
        <!-- JS de Fourchette -->
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="assets/js/fourchette2prix.js"></script>
        <!--   END JS de fourchette      -->

    </body>
</html>