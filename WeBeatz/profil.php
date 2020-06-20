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
    var_dump($resuIFOLLOWHE);
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
            <div class="profile-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 ml-auto mr-auto">
                            <div class="profile">
                                <div class="avatar">
                                    <img src="<?=$afficher_profil['user_image']?>" alt="Circle Image" class="img-raised img-fluid roundedImage"> 

                                </div>
                                <div class="name">
                                    <h3 class="title"><?=$afficher_profil['user_pseudo']?></h3>
                                    <?php if ($afficher_profil['user_role'] == 0){?>
                                    <h6>ADMIN</h6>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
            if($okheblocki){/*si l'utilisateur nous a bloqué*/
                echo "Ce compte vous a bloqué";
            }
            else if($okiblockhe){
                echo"Vous l'avez bloqué depuis le ".$resuIBLOCKHE['date_relation']."<br/>";
                    ?>
                    <form action="" method="post">
                        <button  class="btn btn-danger" style="background:white;border-color:red; color : red"><i class="fa fa-unlock-alt" aria-hidden="true"></i><input type="submit" class="btn" style="background:white; color : red" name="debloquer" value="Débloquer"></button>
                    </form>
                    <?php    
            }
            else{
                    ?>
                    <div class="description text-center">
                        <p><?=$afficher_profil['user_description']?> </p>
                    </div>
                    <div>
                        <?php 
                        if($id_demandeur==$id_receveur){ 
                        ?> 
                        <button class="btn btn-danger" style="background:#7728b2;border-color:#7728b2;box-shadow :0 0 0 0.2rem #7728b2"><a href="edit-profil.php?profil_id=<?=$id_receveur?>" class="text-white"><i class="fas fa-edit"></i><span class="ml-3">Editer</span></a></button>

                    
                        <!-- SI C'EST PAS TON COMPTE -->
                        <?php } 
                else if ($id_demandeur!=$id_receveur){
                        ?>
                        <div class="row">
                            <!-- Message -->
                            <?php
                    if(!$okconnectey){
                            ?>
                            <button onclick="window.location.replace('connexion.php')" class="btn btn-danger col-3 mb-3" style="background:#7728b2;border-color:#7728b2;box-shadow :0 0 0 0.2rem #7728b2"><i class="fas fa-comment-alt"></i><span class="ml-3">DM</span></button>
                            
                            <?php        
                    }
                    else{
                            ?>
                            <button class="btn btn-danger col-3 mb-3" style="background:#7728b2;border-color:#7728b2;box-shadow :0 0 0 0.2rem #7728b2" ><a href="message.php?profil_id=<?= $id_receveur ?>-<?= $id_demandeur ?>" class="text-white"><i class="fas fa-comment-alt"></i><span class="ml-3">DM</span></a></button>       
                            <br/><br/>
                            <?php
                    
                            ?>


                            

                        </div>

                        <form action="" method="post">
                            <?php  
                                if($okifollowhe){
                                    echo "Vous le suivez depuis le ".$resuIFOLLOWHE['date_relation']."<br/>";
                            ?>
                            <button class="btn btn-danger" style="background:white;border-color:#7728b2; color : #7728b2; box-shadow :0 0 0 0.2rem #7728b2"><i class="fas fa-user-minus"></i><input type="submit"  class="btn" style="margin-left:3px;background:white;color : #7728b2;" name="unfollow" value="Unfollow"></button>
                            <?php 
                                } 
                    else{ 
                            ?>
                            <button class="btn btn-danger" style="background:#7728b2;border-color:#7728b2;box-shadow :0 0 0 0.2rem #7728b2" ><i class="fas fa-user-plus"></i><input type="submit" class="btn btn-danger" style="margin-left:3px;background:#7728b2;border-color:#7728b2;box-shadow :0 0 0 0.2rem #7728b2"  name="follow" value="Follow"></button>
                            <?php   
                    }    
                            ?>
                            <button class="btn btn-danger" style="margin-left:10px;" ><i class="fas fa-user-lock"></i><input type="submit" class="btn btn-danger" name="bloquer" value="Bloquer"></button>
                        </form>
                        <?php
                    }
                } 
                        ?>
                    </div>

                    <?php 

                $req = $BDD->prepare("  SELECT *
                                                        FROM beat
                                                        WHERE beat_author_id = ?
                                                        ORDER BY beat_dateupload DESC");
                $req->execute(array($id_receveur));
                $resuBEATS = $req->fetchAll();

                $yadesresultatsBEATS = false;
                if (isset($resuBEATS) && !empty($resuBEATS)){
                    $yadesresultatsBEATS = true;
                }
                $nb_prods=0;
                foreach($resuBEATS as $r){ 
                    foreach($r as $key => $value){

                        if($key =='beat_author_id' && $value==$id_receveur ){
                            $nb_prods++;
                        }   
                    }
                }
                    ?>
                    <div class="row">
                    
                        <div class="col-9">
                            <span><?= $nb_prods ?> Production(s)</span>
                            <span class="ml-3"><?= $nb_follow?> Follower(s)</span>
                        </div>

                        <div class="col-3">
                           <div>Sexe : <?=$afficher_profil['user_sexe']?></div>
                            <div>Né le : <?=$afficher_profil['user_datenaissance']?></div>
                            <div>Ville : <?=$afficher_profil['user_ville']?></div>
                            <div>E-mail : <?=$afficher_profil['user_email']?></div>
                        </div>
                    
                    </div>
                    
                    <div class="row">

                        <div class="pt-3 pb-3 d-flex shadow-sm rounded h-100 w-100 bg-primary">
                           
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
        require_once('assets/skeleton/AudioPlayer/audioplayer.php');
        ?>

    </body>
</html>