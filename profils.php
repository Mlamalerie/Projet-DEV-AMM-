<?php
session_start();
$_SESSION['ici_index_bool'] = false;

include('assets/db/connexiondb.php'); 


/*print_r($_GET);*/

//if (!isset($_GET['profil_id'])){
//    header('Location: utilisateurs.php'); 
//    exit;
//}

$id_receveur = (int)$_GET['profil_id'];/*récupère id du profil qu'on a cliqué*/
$id_demandeur=$_SESSION['user_id'];

//*/*/*/*/*/*/

if(isset($id_demandeur)){
    $req = $BDD->prepare("SELECT u.*, r.id_demandeur, r.id_receveur, r.statut
        FROM user u
        LEFT JOIN relation r ON (id_receveur = u.user_id AND id_demandeur = :id2) OR (statut = 3 AND id_demandeur = u.user_id)
        WHERE u.user_id = :id1");

    $req->execute(array(':id1' => $id_receveur, ':id2' =>$id_demandeur));
}
else{
    $req = $BDD->prepare("SELECT u.*
        FROM user u
        WHERE u.user_id = :id1");

    $req->execute(array(':id1' => $id_receveur));
}

$afficher_profil = $req->fetch();


if(!empty($_POST)){
    extract($_POST);
    $valid=(boolean) true;


    if(isset($_POST['user-follow'])){
        $req = $BDD->prepare("SELECT id FROM relation WHERE (id_demandeur = ? AND id_receveur = ?)"); 

        $req->execute(array( $id_demandeur,$id_receveur ));

        $verif_relation = $req->fetch();

        if(isset($verif_relation['id'])){/*follow existe*/
            $valid=false;
            echo "follow existe";
        }
        if($valid){
            $req=$BDD->prepare("INSERT INTO relation (id_demandeur,id_receveur,statut) VALUES (?,?,?)");
            $req->execute(array($id_demandeur,$id_receveur,1));

        }

        header('Location: profils.php?profil_id='.$id_receveur);
        exit;
    }

    else if(isset($_POST['user-unfollow'])){
        $req=$BDD->prepare("DELETE FROM relation  WHERE (id_receveur = ? AND id_demandeur = ?)");
        $req->execute(array($id_receveur,$id_demandeur));
        header('Location: profils.php?profil_id='.$id_receveur);
        exit;
    }
    else if(isset($_POST['user-bloquer'])){
        $req=$BDD->prepare("DELETE FROM relation  WHERE (id_receveur = ? AND id_demandeur = ?) OR (id_receveur = ? AND id_demandeur = ?)");

        $req->execute(array($id_receveur, $id_demandeur, $id_demandeur,$id_receveur));

        $req=$BDD->prepare("INSERT INTO relation (id_demandeur,id_receveur, statut) VALUES (?,?,?)");
        $req->execute(array($id_demandeur,$id_receveur,3));
        /*c'est comme unfollow mais on insère juste l'id de du profil bloqué*/ /*on suppose que le statut 3 est une demande bloqué*/


        header('Location: profils.php?profil_id='.$id_receveur);
        exit;
    } 
    else if(isset($_POST['user-debloquer'])){
        $req=$BDD->prepare("DELETE FROM relation  WHERE (id_demandeur = ? AND id_receveur = ? AND statut = ? )");
        $req->execute(array($id_demandeur,$id_receveur,3));
        header('Location: profils.php?profil_id='.$id_receveur);
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
echo '^f=berd"';
$resuRELA = $req1->fetchAll();

print_r($resuRELA);
foreach($resuRELA as $rr){
    
    foreach($rr as $key => $value){
    
    if($key =='statut' && $value== 1){
        
        $nb_follow++;
    }   
} 
}
    
    
    
//$nb_follow = count()


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

        <style>
            .container{
                background: #7728b2;
                color: white;
            }
            .infos{
                background: red;
            }
            .msg-btn{
                margin:10px 0px 40px 0px; 
                background:rgba(121, 6, 247,1);
                border: 1px solid rgba(121, 6, 247,0.5); 
                padding:10px 25px; 
                color: #ffffff; 
                border-radius: 3px; 
                cursor:pointer; 
            }
            .follow-btn{
                margin:10px 0px 40px 0px;
                border: 1px solid rgba(121, 6, 247,0.5); 
                padding:10px 25px; 
                border-radius: 3px; cursor:pointer; 
                margin-left:10px; 
                background: white;
                color:rgba(121, 6, 247,1);
            }
            .infos-privee-btn{
                margin:10px 0px 40px 0px;
                margin-left:10px;
                background: #000000;
                color:rgba(121, 6, 247,1);
                padding:10px 25px; 
                border-radius: 3px; cursor:pointer; 

            }
            .infos-privee-btn a{
                text-decoration: none;
                color:rgba(121, 6, 247,1);
            }
            .editer-btn{
                margin:10px 0px 40px 0px;
                margin-left:10px;
                background: grey;
                color:rgba(121, 6, 247,1);

                border-radius: 3px; cursor:pointer; 

            }
            .editer-btn a{
                text-decoration: none;
                color:rgba(121, 6, 247,1);
            }
        </style>

    </head>
    <body>
        <!--   ************************** NAVBAR  **************************  -->

        <?php
        //require_once('assets/skeleton/navbar.php');
        ?>
        <br/><br/><br/><br/>
        <div class="container">
            <div class="row">


                <div class="col-md-4" style="width: 150px;height: 150px; padding: 10px;display:inline-block;width:15%";>
                    <img src="img/<?=$afficher_profil['user_image']?>" style="width: 150px;height: 150px;">
                </div>

                <div class="col-md-4 infos" style="display:inline-block;width:40%;margin-left:5%">
                    <h2><?= $afficher_profil['user_pseudo']?></h2>         
                    <ul>                   
                        <li>Sexe : <?= $afficher_profil['user_sexe'] ?></li> 
                        <li>Né le : <?= $afficher_profil['user_datenaissance'] ?></li>                             
                        <li><?= $afficher_profil['user_ville'] ?></li>             <li><?= $afficher_profil['user_email'] ?></li>   
                        <textarea><?= $afficher_profil['user_description'] ?></textarea> 
                        <li>Ce compte a été crée le : <?= $afficher_profil['user_dateinscription'] ?></li>                                         
                    </ul>
                </div>




                <?php
    /*on peut voir ces boutons seulement sur notre compte et si on est connectusé*/
    if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo']) ){
        if( $id_demandeur==$id_receveur ){
                ?>
                <button class="infos-privee-btn"><a href="privee.php?profil_id=<?= $id_receveur?>" >Infos privée</a></button>

                <button class="editer-btn"><a href="editer-profil.php?profil_id=<?= $id_receveur?>" >Editer</a></button>
                <?php
        } else {/*si on est juste connecté et qu'on regarde le profil d'un autre*/
                ?>
                <div class="col-md-4" style="display:inline-block;width:30%;margin-left:5%">
                    <button class="msg-btn" href=""> <a href="message.php?profil_id=<?= $id_receveur ?>" style="color:white">
                        DM
                        </a></button>   
                    <?php
        }
    }
                    ?>
                    <div>
                        <?= $nb_follow ?> Follower(s)
                    </div>                    
                </div>
            </div>
        </div>
        <div>



            <?php



    if(isset($id_demandeur)&& $id_demandeur!=$id_receveur){ // si c'est pas ton compte affichafe des bouton

        // Si le profil vous a bloqué
        if(isset($afficher_profil['statut']) && $afficher_profil['id_demandeur']==$id_receveur && $afficher_profil['statut'] == 3){
            echo "Vous a bloqué";


        } else {

            ?>    
            <form method="post" class="follow-btn">
                <?php
            echo '//'. $afficher_profil['id_demandeur'] .'-'. $afficher_profil['id_receveur'] .'-'. $afficher_profil['statut']  .'//<br>';
            echo '//**'.$id_demandeur.'-'. $id_receveur.'//';

            //** ON AFFICHE PAS CA SI TU LA BLOQU2 ! :
            if(isset($afficher_profil['statut']) && $afficher_profil['statut'] == 3 && $afficher_profil['id_demandeur']==$id_demandeur){
                echo "###";


            }else {
                if(isset($afficher_profil['statut']) && $afficher_profil['id_demandeur']==$id_receveur){
                    echo "Il vous suit";
                }
                // si tu le follow déja
                if(isset($afficher_profil['statut']) && $afficher_profil['id_demandeur']==$id_demandeur){

                    echo "<div>Vous le suivez</div>";
                ?>
                <!--afficher bouton unfollow-->
                <input type="submit" name="user-unfollow" value="Unfollow" class="follow-btn">
                <?php

                } else {

                ?>
                <!-- Afficher bouton flw-->
                <input type="submit" name="user-follow" value="Follow" class="follow-btn">
                <?php

                }
            }
            //*** bouton pour bloqqué // ||$afficher_profil['statut']==NULL
            //

            if(isset($afficher_profil['statut']) && $afficher_profil['statut'] == 3 && $afficher_profil['id_demandeur'] == $id_demandeur){
                echo "<div>Vous avez bloqué cet utilisateur</div>";
                ?>
                <input type="submit" name="user-debloquer" value="Débloquer" class="follow-btn">
                <?php
            }
            else {
                ?>
                <input type="submit" name="user-bloquer" value="Bloquer" class="follow-btn">
                <?php
            }
                ?>


            </form>
            <?php 
        }
    }
            ?>
        </div>                     

    </body>
</html>