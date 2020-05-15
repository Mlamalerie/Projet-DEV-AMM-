
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

    // si condition de prix
    if ($wepriceexiste){
        if(in_array($_GET['Genre'],$listeGenres)) {
            print_r("<br> >->-> ");

            foreach($listeGenres as $gr){

                if($_GET['Genre'] == $gr) {
                    print_r("- ");
                    $req = $BDD->prepare("SELECT *
                         FROM beat
                         WHERE beat_genre = '$gr' AND ($borneprixinf <= beat_price AND beat_price <= $borneprixsup )
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
    }

    $req->execute(array());
    $resu = $req->fetchAll();


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
                                <input id='valprice' type='hidden' name='Price' value='<?= $_GET['Price'] ?>'/>
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

                            </form> 


                        </div>



                    </nav>
                    <!--   END Menu vertical      -->


                </div>
                <!--   *************************************************************  -->
                <!--   ************************** RESULTAT**************************  -->
                <!--   *************************************************************  -->
                <!--   *************************************************************  -->
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



                    <!--   *************************************************************  -->
                    <!--   ************************** RESULTAT BEAT **************************  -->

                    <div id="resultcontent"  class="pt-3 pb-3 d-flex shadow-sm rounded h-100" style="background-color : blue;">

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

                                <div class=" d-flex col-sm-6 align-middle  " style="background-color : cyan; flex-direction : row;">

                                    <span class='TitleCardMusic'><?=$r['beat_title']?> - </span>
                                    <span class='authorCardMusic'><?=$r['beat_author']?> / </span>
                                    <span class='GenreCardMusic'><?=$r['beat_genre']?> </span>

                                    <div style="background-color : green;"> 
                                        <span> (<?=$r['beat_like']?> ) </span>

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

                    <!--   *************************************************************  -->
                    <!--   ************************** RESULTAT USER **************************  -->
                    <div id="resultuser"  class="pt-3 pb-3 d-flex shadow-sm rounded h-100" style="background-color : blue;">


                    </div>


                </div>
                <!--   END divResultat -->


            </div>
        </div>
        <!--   END MENU + RESULTAT -->




        <script src="assets/js/search.js"></script>
        <?php 

        ?>



        <?php
        require_once('assets/skeleton/endLinkScripts.php');
        ?>
        <!-- JS de Fourchette -->
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


        <script>
            <?php 




            ?>

            $(function() {

                // Initiate Slider
                $('#slider-range').slider({
                    range: true,
                    min: 5,
                    max: 100,
                    step: 5,
                    values: [

                        <?php if($wepriceexiste && ($_GET['Price'] != "free")){
    print_r($borneprixinf);
    print_r(",");print_r($borneprixsup);}

                        else { 

                            print_r("5,100");
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

    </body>
</html>