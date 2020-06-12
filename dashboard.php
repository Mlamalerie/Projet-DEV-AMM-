<?php
session_start();
include_once("assets/db/connexiondb.php");
$_SESSION['ici_index_bool'] = false;

// si une connection est détecter : (ta rien a faire ici mec)
$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    print_r($_SESSION);
    $okconnectey = true;
} else{
    echo "Pas de connexion";
}


include('assets/functions/date-fct.php');
$dateajd = date("Y-m-d"); 
$date22 = date_outil($dateajd,30);


$req = $BDD->prepare("SELECT beat_id,beat_price 
                    FROM beat
                    WHERE beat_author_id = ?");
$req->execute(array($_SESSION['user_id']));
$resuBEATU=$req->fetchAll();

$nbventesmois = 0; // nb de vent dans le mois
$moneymois = (float) 0; // sous quil s'est fait dans le mois
foreach($resuBEATU as $b){

    $req = $BDD->prepare("SELECT COUNT(*) FROM 
                    (SELECT * FROM vente WHERE vente_date BETWEEN ? AND ?) base
                    WHERE vente_beat_id = ?");
    $req->execute(array($date22,$dateajd,$b['beat_id']));

    $resu=$req->fetch();
    $nbventesmois += $resu['COUNT(*)'];
    $moneymois += $b['beat_price'];

}

$req = $BDD->prepare("SELECT *, MAX(beat_nbvente) FROM beat WHERE beat_author_id = ?");
$req->execute(array($_SESSION['user_id']));
$prodlaplusvendu =$req->fetch();


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


        <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="assets/js/chart.js/Chart.css">
        <link rel="stylesheet" type="text/css" href="assets/js/chart.js/Chart.min.css">

        <title>Dash Board</title>
    </head>
    <body id="page-top">
        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->
        <?php
        //require_once('assets/skeleton/navbar.php');
        ?>

        <br>

        <section class="dashboard-counts no-padding-bottom bg-success">
            <div class="container-fluid">
                <div class="row bg-white has-shadow">

                    <div class="col-12"> CE mois </div>
                    <div class="row col-12">
                        <!-- Item -->
                        <div class="col-xl-3 col-sm-6">
                            <div class="item d-flex align-items-center justify-content-center ">
                                <div class="icon bg-dark"><i class="icon-user"></i></div>
                                <div class="title"><span>Nombre de Ventes</span></div>
                                <div class="number"><strong><?= $nbventesmois?></strong></div>
                            </div>
                        </div>
                        <!-- Item -->
                        <div class="col-xl-3 col-sm-6">
                            <div class="item d-flex align-items-center justify-content-center">
                                <div class="icon bg-dark"><i class="icon-padnote"></i></div>
                                <div class="title"><span>money</span>
                                
                                </div>
                                <div class="number"><strong><?= $moneymois?></strong>€</div>
                            </div>
                        </div>
                        <!-- Item -->
                        <div class="col-xl-3 col-sm-6">
                            <div class="item d-flex align-items-center justify-content-center">
                                <img src="<?=$prodlaplusvendu['beat_cover']?>" width='65' alt="" class="rouded">
                                <div class="title"><span><?=$prodlaplusvendu['beat_title']?></span>
                                  
                                </div>
                                <div class="number"><strong><?=$prodlaplusvendu['beat_nbvente']?></strong></div>
                            </div>
                        </div>
                        <!-- Item -->
                        <div class="col-xl-3 col-sm-6">
                            <div class="item d-flex align-items-center justify-content-center">
                                <div class="icon bg-dark"><i class="icon-check"></i></div>
                                <div class="title"><span>Nouveaux Follower</span>
<!--
                                    <div class="progress">
                                        <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                                    </div>
-->
                                </div>
                                <div class="number"><strong>50</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="dashboard-header">
            <div class="container-fluid">
                <div class="row">
                    <!-- Statistics -->
                    <div class="statistics col-lg-3 col-12">
                        <div class="statistic d-flex align-items-center bg-white shadow-sm">
                            <div class="icon bg-dark"><i class="fa fa-tasks"></i></div>
                            <div class="text"><strong>234</strong><br><small>Applications</small></div>
                        </div>
                        <div class="statistic d-flex align-items-center bg-white shadow-sm">
                            <div class="icon bg-dark"><i class="fa fa-calendar-o"></i></div>
                            <div class="text"><strong>152</strong><br><small>Interviews</small></div>
                        </div>
                        <div class="statistic d-flex align-items-center bg-white shadow-sm">
                            <div class="icon bg-dark"><i class="fa fa-paper-plane-o"></i></div>
                            <div class="text"><strong>147</strong><br><small>Forwards</small></div>
                        </div>
                    </div>
                    <!-- Line Chart            -->

                
                </div>
            </div>
        </section>

        <?php
    require_once('assets/skeleton/endLinkScripts.php');
        ?>




    </body>
</html>