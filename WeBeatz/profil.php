<?php
session_start();
$_SESSION['ici_index_bool'] = false;
include('assets/db/connexiondb.php'); 



$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])) {
    $okconnectey = true;
    $id_demandeur=$_SESSION['user_id'];
} else {
    $id_demandeur=0;
}

if(!isset($_GET['profil_id'])) {
    header('HTTP/1.0 404 Not Found');
    exit;
}
$id_receveur = (int) $_GET['profil_id'];/*récupère id du profil qu'on a cliqué*/

//** verif profil_id
$req = $BDD->prepare("SELECT u.*
        FROM user u
        WHERE u.user_id = :id1");

$req->execute(array(':id1' => $id_receveur));

$afficher_profil = $req->fetch();

if(!isset($afficher_profil['user_pseudo'])) {
    header('HTTP/1.0 404 Not Found');
    exit;
}

$okiblockhe = false;
$okheblocki = false;
$okifollowhe = false;

//*** BOOLEEN
if(isset($id_demandeur)){
    // je l'ai bloqué ?

    $req = $BDD->prepare("SELECT *
        FROM relation
        WHERE id_demandeur = ? AND id_receveur = ? AND statut = ?");
    $req->execute(array($id_demandeur,$id_receveur,3));
    $resuIBLOCKHE = $req->fetch(); 
    if(isset($resuIBLOCKHE['statut'])) {
        $okiblockhe = true;
    }
    // il m'a bloqué ?

    $req = $BDD->prepare("SELECT *
        FROM relation
        WHERE id_demandeur = ? AND id_receveur = ? AND statut = ?");
    $req->execute(array($id_receveur,$id_demandeur,3));
    $resuHEBLOCKI = $req->fetch();
    if(isset($resuHEBLOCKI['statut'])) {
        $okheblocki = true;
    }
    // je le follow ?

    $req = $BDD->prepare("SELECT *
        FROM relation
        WHERE id_demandeur = ? AND id_receveur = ? AND statut = ?");
    $req->execute(array($id_demandeur,$id_receveur,1));
    $resuIFOLLOWHE = $req->fetch(); 
   // var_dump($resuIFOLLOWHE);
    if(isset($resuIFOLLOWHE['statut'])) {
        echo 'truetrue';
        $okifollowhe = true;
    }


}


$okprofildesac = false;
if(($afficher_profil['user_statut'] == 0)){
    $okprofildesac = true;

}

if(!empty($_POST)){
    extract($_POST);
    $valid=(boolean) true;


    if(isset($_POST['follow'])){
        echo "#follow";
        $req = $BDD->prepare("SELECT id FROM relation WHERE (id_demandeur = ? AND id_receveur = ?)"); 

        $req->execute(array( $id_demandeur,$id_receveur ));

        $verif_relation = $req->fetch();

        if(isset($verif_relation['id'])){/*follow existe*/
            $valid=false;
            echo "follow existe";
        }
        if($valid){
            $date_relation = date("Y-m-d H:i:s");
            $req=$BDD->prepare("INSERT INTO relation (id_demandeur,id_receveur,statut,date_relation) VALUES (?,?,?,?)");
            $req->execute(array($id_demandeur,$id_receveur,1,$date_relation));
        }
        header('Location: profil.php?profil_id='.$id_receveur);
        exit;
    }

    else if(isset($_POST['unfollow'])){
        echo "#unfollow";
        $req=$BDD->prepare("DELETE FROM relation  WHERE (id_receveur = ? AND id_demandeur = ?)");
        $req->execute(array($id_receveur,$id_demandeur));
        header('Location: profil.php?profil_id='.$id_receveur);
        exit;
    }
    else if(isset($_POST['bloquer'])){
        echo "#bloquer";
        $req=$BDD->prepare("DELETE FROM relation  WHERE (id_receveur = ? AND id_demandeur = ?) OR (id_receveur = ? AND id_demandeur = ?)");

        $req->execute(array($id_receveur, $id_demandeur, $id_demandeur,$id_receveur));

        $date_relation = date("Y-m-d H:i:s");
        $req=$BDD->prepare("INSERT INTO relation (id_demandeur,id_receveur, statut,date_relation) VALUES (?,?,?,?)");
        $req->execute(array($id_demandeur,$id_receveur,3,$date_relation));
        /*c'est comme unfollow mais on insère juste l'id de du profil bloqué*/ /*on suppose que le statut 3 est une demande bloqué*/


        header('Location: profil.php?profil_id='.$id_receveur);
        exit;
    } 
    else if(isset($_POST['debloquer'])){
        echo "#debloquer";
        $req=$BDD->prepare("DELETE FROM relation  WHERE (id_demandeur = ? AND id_receveur = ? AND statut = ? )");
        $req->execute(array($id_demandeur,$id_receveur,3));
        header('Location: profil.php?profil_id='.$id_receveur);
        exit;
    } 
}

// req1 seletionne toutes les relations où on le follow
$req1 = $BDD->prepare("SELECT *
                        FROM relation
                        WHERE id_receveur = ? AND statut = 1");
$req1->execute(array($id_receveur));
// compter les resulter, count la tableau
$nb_follow=0;
$resuFOLLOWprof= $req1->fetchAll();

//print_r($resuRELA);
foreach($resuFOLLOWprof as $rr){ 
    foreach($rr as $key => $value){

        if($key =='statut' && $value== 1){
            $nb_follow++;
        }   
    }
}

$okcmoncompte = false;
if( $id_demandeur==$id_receveur){
    $okcmoncompte = true;
}
?>



<?php 
// PRODUIT DU PROFIL
$req = $BDD->prepare("  SELECT * FROM beat   WHERE beat_author_id = ?  ORDER BY beat_dateupload DESC");
$req->execute(array($id_receveur));
$resuBEATS = $req->fetchAll();

$yadesresultatsBEATS = false;
if (isset($resuBEATS) && !empty($resuBEATS)){
    $yadesresultatsBEATS = true;
}
$nb_prods=count($resuBEATS);

?>  


<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Profil de <?= $afficher_profil['user_pseudo'] ?></title>
        <?php
    require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
        <link rel="stylesheet" type="text/css" href="assets/css/search.css">
        <link rel="stylesheet" type="text/css" href="assets/css/profil.css">
        <link rel="stylesheet" type="text/css" href="assets/skeleton/AudioPlayer/audioplayer.css">

    </head>
    <body class="profile-page">
        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->
        <?php require_once('assets/skeleton/navbar.php');  require_once('assets/functions/js-panier.php');?>
        <br/> <br/> <br/> <br/>

        <?php
        if($okprofildesac){
            echo "Ce compte a été désactivé";
        }
        else{
        ?>
        <div class="page-header header-filter" data-parallax="true" style=""></div>
        <div class="main main-raised">
            <div class="profile-content bg-back rounded">
                <div class="container rounded">
                    <div class="row">
                        <div class="col-md-6 ml-auto mr-auto">
                            <div class="profile">
                                <div class="avatar">
                                    <img src="<?=$afficher_profil['user_image']?>" alt="Circle Image" class="img-fluid roundedImage2  shadow-sm "> 

                                </div>
                                <div class="name">
                                    <h3 class="title"><?=$afficher_profil['user_pseudo']?></h3>
                                    <?php if ($afficher_profil['user_role'] == 0){?>
                                    <h6>ADMIN</h6>
                                    <?php } ?>


                                    <span class="small  text-muted"><?=$afficher_profil['user_ville'] ?>
                                        <span class="text-uppercase ">

                                            <?php
            //*** Pays
            $req = $BDD->prepare("SELECT *  FROM pays WHERE code = ?");
            $req->execute(array($afficher_profil['user_pays'] ));
            $aff_pays = $req->fetch();

            echo '('.$aff_pays['nom_fr_fr'].')';
                                            ?>

                                        </span>
                                    </span>
                                </div>
                                <div class="description text-center row mb-3 ">
                                   <?php if(!$okiblockhe && !$okheblocki) { ?> <div class="col-12 mb-2"><?=$afficher_profil['user_description']?></div>
                                    <?php } ?>

                                    <div class="col-12 chiffres">
                                        <span><strong class='text-light'><?= $nb_prods ?></strong> Productions</span>
                                        <span class="ml-3"><strong class='text-light'><?= $nb_follow?></strong> Followers</span>
                                    </div>
                                </div>


                                <?php   if($id_demandeur==$id_receveur){   ?> 
                                <button class="btn btn-pf rounded text-white"  ><a href="edit-profil.php?profil_id=<?=$id_receveur?>" class="text-white"><i class="fas fa-edit mr-2"></i>Modifier son Profil</a></button>                  
                                <?php } ?>
                            </div>



                        </div> 
                    </div> 
                    <?php
            if($okheblocki){/*si l'utilisateur nous a bloqué*/
                echo "Ce compte vous a bloqué";
            }
            else if($okiblockhe){
                echo "Vous avez bloqué ".$afficher_profil['user_pseudo']."  le ".$resuIBLOCKHE['date_relation']."<br/>";
                    ?>
                    <form action="" method="post">
                        <button  class="btn btn-danger" style="background:white;border-color:red; color : red"><i class="fa fa-unlock-alt" aria-hidden="true"></i><input type="submit" class="btn" style="background:white; color : red" name="debloquer" value="Débloquer"></button>
                    </form>
                    <?php    
            }
            else{
                    ?>



                    <div>

                        <!-- SI C'EST PAS TON COMPTE -->
                        <?php
                if ($id_demandeur!=$id_receveur){
                        ?>

                        <!-- ** si connecté -->
                        <?php
                    if(!$okconnectey){
                        ?>
                        
                        
                        <!--  btn MESSAGE -->
                        <div class="d-flex justify-content-center ">
                            <div class="p-2">
                                    <a href="connexion.php"  ><button class="btn btn-pf text-white mb-3"  ><i class="fas fa-comment-alt mr-2"></i>Message</button>   </a> 
 
                            </div>
                            
                            
                        </div>
                   
                       
                        <!-- ** si pas connecté -->
                        <?php  } else { ?>

                       <!--  btn MESSAGE -->
                        <a href="message.php?profil_id=<?= $id_receveur ?>-<?= $id_demandeur ?>"  ><button class="btn btn-pf text-white mb-3"  ><i class="fas fa-comment-alt"></i><span class="ml-3">Message</span></button>   </a>    


                        <form action="" method="post">
                            <?php   if($okifollowhe){ ?>
                            <button type="submit"  class="btn btn-pfdark" name="unfollow" value="Unfollow"> <i class="fas fa-user-minus mr-2"></i>Unfollow </button>
                            <?php 
                        } 
                                       else{ 
                            ?>
                           <button type="submit" class="btn btn-pf text-white"   name="follow" value="Follow"><i class="fas fa-user-plus mr-2"></i>Follow</button>
                            <?php   
                                       }    
                            ?>
                            <button type="submit" class="btn btn-pf text-white" name="bloquer" value="Bloquer"><i class="fas fa-user-lock mr-2"></i>Bloquer</button>
                        </form>
                        <?php
                                      } 
                } 
                        ?>
                    </div>



                    <div class="row">

                        <div class="mt-3 pt-3 pb-3 d-flex shadow-sm rounded h-100 w-100 bg-back">
<div class="text-center w-25">Tout les produit de <?=$afficher_profil['user_pseudo'] ?> uuuuuuuuuuuuuuuuuuuu</div>
                            <?php $decal = 0; require_once('assets/skeleton/tableBeatSearch.php'); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php  
            }
        }
        ?>


        <?php
        require_once('assets/skeleton/endLinkScripts.html');
        ?>

        <!--   *************************************************************  -->
        <!--   ************************** MUSIC PLAYER  **************************  -->
        <?php
        if(isset($resuBEATS) && !empty($resuBEATS)) {
            $resuPLAYLIST = $resuBEATS;
        } else {
            $resuPLAYLIST = array();
        }
        require_once('assets/skeleton/AudioPlayer/audioplayer.php');
        ?>

    </body>
</html>