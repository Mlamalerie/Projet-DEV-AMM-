<?php
session_start();
include_once("assets/db/connexiondb.php");
$_SESSION['ici_index_bool'] = false;

$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {

    $okconnectey = true;
} else {
    header('Location: connexion.php');
    exit;
} 


include_once('assets/functions/date-fct.php');
$dateajd = date("Y-m-d"); 
$dateya30j = date_outil($dateajd,30);


//******** Nombre de Ventes & Argent fait dans le mois
//*******
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
    $req->execute(array($dateya30j,$dateajd,$b['beat_id']));
    $resu=$req->fetch();
    $nbventesmois += $resu['COUNT(*)'];

    $req2 = $BDD->prepare("SELECT * FROM 
                    (SELECT * FROM vente WHERE vente_date BETWEEN ? AND ?) base
                    WHERE vente_beat_id = ?");
    $req2->execute(array($dateya30j,$dateajd,$b['beat_id']));
    $resuVENTESINT=$req2->fetchAll();

    foreach($resuVENTESINT as $v){
        $req = $BDD->prepare("SELECT beat_price FROM 
                    beat WHERE beat_id = ?");
        $req->execute(array($v['vente_beat_id']));
        $resub=$req->fetch();
  $moneymois += $resub['beat_price'];
       

    }
   
   

}

//******** prod la plus vendu
//*******
$req = $BDD->prepare("SELECT *, MAX(beat_nbvente) FROM beat WHERE beat_author_id = ?");
$req->execute(array($_SESSION['user_id']));
$prodlaplusvendu =$req->fetch();

//********Nouveau follower dans le mois
//*******

$req = $BDD->prepare("SELECT COUNT(*) FROM 
                    (SELECT * FROM relation WHERE date_relation BETWEEN ? AND ?) base
                    WHERE id_receveur = ?");
$req->execute(array($dateya30j,$dateajd,$_SESSION['user_id']));

$resu=$req->fetch();
$nbnewfollowers = $resu['COUNT(*)'];



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

        <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">



        <title>Tableau de Bord • WeBeatz</title>
    </head>
    <body id="top" onload=" refreshAllBeats()">


        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->
        <?php
        require_once('assets/skeleton/navbar.php');
        require_once('assets/functions/js-refreshBDD.php');
        ?>



        <section class="dashboard-counts no-padding-bottom mt-5">
            <div class="container-fluid ">
                <!-- For demo purpose -->
                <div class="container text-white py-5 text-center">
                    <h1 class="display-5">Tableau de Bord</h1>
                    <p class="lead mb-0">Bonjour <?= $_SESSION['user_pseudo']?> 💜<br>  Vous allez bien ?</p>
                </div>
                <div class="row bg-back has-shadow rounded ">

                    <div class="row w-100">
                        <div class="col-9">    
                            <h1 class="mb-0 ml-5 font-weight-bold">Statistiques du mois</h1>
                        </div>
                        <div class="col-3">  

                            <a class='text-deco chap text-warning ' href="histo-ventes.php"><i class="fas fa-search-dollar mr-1 text-gray-400"></i> Voir historique de ventes</a>
                        </div>
                    </div>

                    <div class="row col-12">
                        <!-- Item -->
                        <div class="col-xl-3 col-sm-6  rounded">
                            <h3 class="text-center chap rounded  py-3 ">Nombre de ventes</h3>
                            <a href="histo-ventes.php ">
                                <div class="item d-flex align-items-center justify-content-center  rounded py-4">
                                    <div class="icon  mr-3"><i class="fas fa-shopping-bag"></i></div>

                                    <div class="number"><strong><?= $nbventesmois?></strong></div>


                                </div>
                            </a>
                        </div>
                        <!-- Item -->
                        <div class="col-xl-3 col-sm-6 rounded">
                            <h3 class="text-center chap rounded  py-3 ">Money</h3>
                            <a href="histo-ventes.php ">
                                <div class="item d-flex align-items-center justify-content-center rounded py-4">
                                    <div class="icon  mr-3"><i class="fas fa-money-check-alt"></i></div>

                                    <div class="number mr-3"><strong><?= $moneymois?></strong>€</div>


                                </div>
                            </a>
                        </div> 
                        <!-- Item -->
                        <div class="col-xl-3 col-sm-6 rounded">
                            <h3 class="text-center chap rounded  py-3 ">Votre produit le + vendus</h3>
                            <a href="view-beat.php?id=<?=$prodlaplusvendu['beat_id']?>">
                                <div class="item d-flex align-items-center justify-content-center rounded py-4">
                                    <img class="mx-3" src="<?=$prodlaplusvendu['beat_cover']?>" width='40' height='40' alt="" class="rounded">
                                    <div class="title mr-1"><span class="text-light"><?=$prodlaplusvendu['beat_title']?></span>    </div>
                                    <div class="number">(<strong><?=$prodlaplusvendu['beat_nbvente']?></strong>) </div>
                                </div>
                            </a>
                        </div>
                       
                        <!-- Item -->
                        <div class="col-xl-3 col-sm-6 rounded">
                            <h3 class="text-center chap rounded py-3 ">Nouveaux Followers</h3>
                            <div class="item d-flex align-items-center justify-content-center rounded py-4">
                                <div class="icon  mr-3"><i class="fas fa-users"></i></div>
                                <div class="number mr-3"><strong><?= $nbnewfollowers ?></strong></div>

                                <!--
<div class="progress">
<div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
</div>
-->


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>




        <?php
    require_once('assets/skeleton/endLinkScripts.html');
        ?>




    </body>
</html>