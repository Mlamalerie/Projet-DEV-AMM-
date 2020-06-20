<?php
session_start();
$_SESSION['ici_index_bool'] = false;
include_once("assets/db/connexiondb.php");


$beat_id = (int)$_GET['id'];


$req = $BDD -> prepare("SELECT * FROM beat WHERE beat_id = ?");
$req->execute(array($beat_id));
$instru = $req->fetch();

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
        <meta charset="utf-8">
        <title><?= $instru['beat_title'] ?> by <?= $instru['beat_author'] ?> • WeBeatz </title>
        <?php
    require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
        <link rel="stylesheet" type="text/css" href="assets/css/search.css">
        <!--  Audio player de mathieu   -->
        <link rel="stylesheet" type="text/css" href="assets/skeleton/AudioPlayer/audioplayer.css">
        <link rel="stylesheet" type="text/css" href="assets/css/view-beat.css">
    </head>
    <body onload=" refreshNbPanier();refreshAllBeats() ">

        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->
        <?php require_once('assets/skeleton/navbar.php');  require_once('assets/functions/js-panier.php');?>

  efe
        <!-- Demo header-->
        <section class="mt-5 pb-4 header text-center">
            <div class="bg-dark mt-5 container py-5 text-white rounded vb-color ">
                <div class="row mx-4 align-middle rounded">
                    <div class="hover-xx">
                        <img src="<?= $instru['beat_cover']?>" alt="" id='imgdubeat' class="img-fluid rounded shadow-sm ">
                    </div>

                    <div class="text-light text-left mt-1 ml-4 d-inline-block align-middle rounded">
                        <h5 class="mb-0 vb-text "><?= $instru['beat_title']?> <small class="vb-year">• <?= $instru['beat_year']?></small></h5> 
                        <!--  auteur -->
                        <a class="text-light vb-stext " href="profils.php?profil_id=<?= $instru['beat_author_id']?>">
                            by <u><?= $instru['beat_author']?></u>

                        </a>
                        <!--  date-->
                        <?php
    $teuda = explode(' ',$instru['beat_dateupload'])[0];
                             $datedate = explode('-',$teuda);
                        ?>
                        <div class="w-100 mt-2 vb-date font-italic">
                           Date de mise en ligne : 
                            <i class="fas fa-clock ml-1"></i>  <?= $datedate[2]?>-<?= $datedate[1]?>-<?= $datedate[0]?>
                            <!--   description    -->
                        </div> 

                        <div class="vb-desc mw-75 mt-2">
                           <span>Description : </span>
                            <?= $instru['beat_description']?>
                            <!--    bouton acheter -->
                        </div>
                        <?php  $tags = explode(',',$instru['beat_tags']); ?>



                        <div scope="row" class=" border-0 d-flex justify-content-end mr-2 mt-3">
                            <div>

                                <?php 
                                $okdejadanspanier = false;
                                $okdejaacheter = false;
                                if($okconnectey) {
                                    $req = $BDD->prepare("SELECT *
                                                                                        FROM vente
                                                                                        WHERE vente_user_id = ? AND vente_beat_id = ?");
                                    $req->execute(array($_SESSION['user_id'],$instru['beat_id']));


                                    $ach = $req->fetch();


                                    if(isset($ach['id'])){
                                        $okdejaacheter = true;
                                    }else {
                                        $req = $BDD->prepare("SELECT *
                                                                                        FROM panier
                                                                                        WHERE panier_user_id = ? AND panier_beat_id = ?");
                                        $req->execute(array($_SESSION['user_id'],$instru['beat_id']));


                                        $aff = $req->fetch();



                                        if(isset($aff['id'])){
                                            $okdejadanspanier = true;
                                        }
                                    }
                                }
                                ?>
                                <?php 
                                $okcestpastaprod = ($okconnectey && $instru['beat_author_id'] != $_SESSION['user_id']);
                                if(!$okdejaacheter) {

                                    if($okcestpastaprod || !$okconnectey) { ?>
                                <button id='btnbeat-<?=$instru['beat_id']?>' 

                                        <?php if($okconnectey) { ?>
                                        onclick="go2Panier(this,'<?=$instru['beat_title']?>','<?=$instru['beat_author']?>', '<?=$instru['beat_price']?>', '<?=$instru['beat_cover']?>','<?=$instru['beat_id']?>');" <?php }else { ?> onclick="goConnexionStp();"  <?php } ?>

                                        class="btn btn-buy"


                                        >



                                    <?php if(!$okdejadanspanier) { ?>
                                    <i class="fas fa-shopping-cart iconPanierbtn"></i><sup>+</sup>
                                    <?php if($instru['beat_price'] != 0.00) { echo $instru['beat_price'].'€'; } else {echo "FREE";} ?>
                                    <?php } ?>

                                </button>
                                <?php } } else {?>
                                <a class="btn btn-danger" href="<?= $instru['beat_source']?>" download>
                                    <span class="text-white"><i class="fas fa-download"></i></span>
                                </a>
                                <?php } ?>
                                <?php  if($okdejadanspanier) {?>
                                <script>document.getElementById('btnbeat-<?=$instru['beat_id']?>').innerHTML = 'Dans le panier';</script>
                                <?php } ?>


                            </div>
                            <div class="p-2 rounded  ">
                                <?php foreach($tags as $t) { if(strlen($t)>1){ $t = trim($t);

                                ?>
                                <a class="spanTag  badge badge-light text-dark px-2 rounded-pill ml-2" href="search.php?Type=beats&q=<?= $t ?>">#<?= $t ?> </a>
                                <?php }} ?>
                            </div>

                        </div>

                    </div>


                </div>

            </div>




            <!-- Animated button -->
            <span id='btnplayView-<?=$instru['beat_id']?>' onclick="playPause(0,<?=$instru['beat_id']?>)" class="animated-btn text-white" href="#"><i class="fa fa-play iconPlay"></i></span>




        </section>

        <section class="mt-2 pb-4 header text-center">
            <div id="resultcontentAlea"  class="container pt-4 pb-5 text-white rounded bg-back mb-4 " >


                <?php

    $req = $BDD->prepare("SELECT beat_id
                            FROM beat
                            WHERE beat_id <> ?
                            ");
                  $req->execute(array( $instru['beat_id'] ));
                  $resuID = $req->fetchAll();
                  shuffle($resuID);
                  shuffle($resuID);

                  $resuBEATS = [];
                  for ($i = 0; $i < 3; $i++){
                      $req = $BDD->prepare("SELECT *
                            FROM beat
                            WHERE beat_id = ?");
                      $req->execute(array($resuID[$i]['beat_id']));
                      $resuB = $req->fetchAll();

                      $resuBEATS = array_merge($resuBEATS,$resuB);
                  }
                  $yadesresultatsBEATS = false;
                  if (isset($resuBEATS) && !empty($resuBEATS)){
                      $yadesresultatsBEATS = true;
                  }

                  $oublielepremier = false;

                ?>

                <?php  $decal = 1; require_once('assets/skeleton/tableBeatSearch.php'); ?>

            </div>
        </section>



        <?php
        require_once('assets/skeleton/endLinkScripts.html');
        ?>

        <!--   *************************************************************  -->
        <!--   ************************** MUSIC PLAYER  **************************  -->
        <?php
        if(isset($resuBEATS) && !empty($resuBEATS)) {
            $resuPLAYLIST = $resuBEATS;
            array_unshift($resuPLAYLIST, $instru);
        } else {
            $resuPLAYLIST = array();
        }

        require_once('assets/skeleton/AudioPlayer/audioplayer.php');
        ?>


    </body>

</html>
