<?php
session_start();
$_SESSION['ici_index_bool'] = false;

include('assets/db/connexiondb.php');



$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    $okconnectey = true;

} else {
    header('Location: index.php');
    exit;
}

if(isset($_POST['inputOption'])) {
    $id_beat=$_POST['inputOption_beat_id'];
    $ok = true;
    if($_POST['inputOption']== "suppr"){
        if($ok){

            // supprimer le fichier du dossier data
            $req = $BDD->prepare("SELECT beat_source FROM beat
            WHERE beat_id = ?"); 
            $req->execute(array($id_beat));
            $bb = $req->fetch();

            unlink($bb['beat_source']);

            // supprimer de la BDD
            $req = $BDD->prepare("DELETE FROM beat
            WHERE beat_id = ?"); 
            $req->execute(array($id_beat));

            header('Location: my-beats.php');
            exit;

        }
    }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php require_once('assets/skeleton/headLinkCSS.html');?>




        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
        <link rel="stylesheet" type="text/css" href="assets/css/my-beats.css">
        <link rel="stylesheet" type="text/css" href="assets/css/search.css">

        <link rel="stylesheet" type="text/css" href="assets/skeleton/AudioPlayer/audioplayer.css">

        <title>Mes Tracks • WeBeatz</title>

    </head>
    <body>


        <style>


        </style>


        <!--   ************************** NAVBAR  **************************  -->

        <?php

        require_once('assets/skeleton/navbar.php');
        ?>

        <div class="container py-5">
            <!-- For demo purpose -->
            <div class="row mb-2">
                <div class="col-lg-8 text-white py-4 text-center mx-auto">
                    <h1 class="display-4">Mes tracks</h1>
                    <p class="lead mb-0">Tous vos beats sont réunis ici</p>
                </div>
            </div>
            <!-- End -->


            <div class="p-5 bg-back rounded shadow mb-5">
                <!-- Rounded tabs -->
                <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center  border-0 rounded-nav">
                    <li class="nav-item flex-sm-fill">
                        <a id="myupload-tab" data-toggle="tab" href="#myupload" role="tab" aria-controls="myupload" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active"><i class="fas fa-file-upload mr-2"></i>Mes Upload</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="mypurchase-tab" data-toggle="tab" href="#mypurchase" role="tab" aria-controls="mypurchase" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold"><i class="fas fa-shopping-bag mr-2"></i>Mes achats</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="mylike-tab" data-toggle="tab" href="#mylike" role="tab" aria-controls="mylike" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold"><i class="fas fa-heart mr-2"></i>Mes likes</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div id="myupload" role="tabpanel" aria-labelledby="myupload-tab" class="tab-pane fade px-4 py-5 show active">
                        <p class="text-muted">Retrouvez la liste de vos beats uploadés.</p>
                        <?php 
                        $req = $BDD->prepare("SELECT *
                                            FROM beat
                                            WHERE beat_author_id = ?");
                        $req->execute(array($_SESSION['user_id']));
                        $resuUP = $req->fetchAll();


                        require_once('assets/skeleton/tableUpload.php');
                        ?>
                    </div>
                    <div id="mypurchase" role="tabpanel" aria-labelledby="mypurchase-tab" class="tab-pane fade px-4 py-5">
                        <p class="text-muted">Retrouvez la liste de vos achats</p>

                        <?php 
                        $lim = 0;
                        if ($lim != 0){
                            $req = $BDD->prepare("SELECT *
                            FROM vente
                            WHERE vente_user_id = ? 
                            ORDER BY vente_date DESC
                            LIMIT $lim ");
                            $req->execute(array($_SESSION['user_id']));
                        } else {
                            $req = $BDD->prepare("SELECT *
                            FROM vente
                            WHERE vente_user_id = ? 
                            ORDER BY vente_date DESC");
                            $req->execute(array($_SESSION['user_id']));

                        }
                        $resuACHAT = $req->fetchAll();
                        require_once('assets/skeleton/tableAchats.php');
                        ?>
                    </div>
                    <div id="mylike" role="tabpanel" aria-labelledby="mylike-tab" class="tab-pane fade px-4 py-5">
                        <p class="text-muted">Les beats que vous avez likés</p>
                        <?php 
                        $resuBEATS = [];
                        $req = $BDD->prepare("SELECT like_beat_id
                                            FROM likelike
                                            WHERE like_user_id = ?");
                        $req->execute(array($_SESSION['user_id']));
                        $resuLIKES = $req->fetchAll();

                        foreach($resuLIKES as $p) {

                            $req = $BDD->prepare("SELECT *
                                            FROM beat
                                            WHERE beat_id = ?");
                            $req->execute(array($p['like_beat_id']));
                            $resuPAN = $req->fetchAll();
                            if(isset($resuPAN)){
                                $resuBEATS = array_merge($resuBEATS,$resuPAN);
                            }
                        }

                        $yadesresultatsBEATS = false;
                        if (isset($resuBEATS) && !empty($resuBEATS)){
                            $yadesresultatsBEATS = true;
                        }

                        require_once('assets/skeleton/tableLikes.php');
                        ?>
                    </div>
                </div>
                <!-- End rounded tabs -->
            </div>
        </div>

        <!--      SCRIPTS      -->


        <?php 
        require_once('assets/skeleton/endLinkScripts.html');
        ?>
        <!--   *************************************************************  -->
        <!--   ************************** MUSIC PLAYER  **************************  -->
        <?php
        if(isset($resuBEATS) && !empty($resuBEATS)) {
            $resuPLAYLIST = array_merge($resuUP, $resuBEATS);
        } else {
            $resuPLAYLIST = array();
        }
        require_once('assets/skeleton/AudioPlayer/audioplayer.php');
        ?>
        <?php 
        require_once('assets/functions/js-panier.php');
        ?>
    </body>
</html>