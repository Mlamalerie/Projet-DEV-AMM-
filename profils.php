<?php
session_start();
$_SESSION['ici_index_bool'] = false;

include('assets/db/connexiondb.php'); 


/*print_r($_GET);*/

if (!isset($_GET['profil_id'])){
    header('Location: utilisateurs.php'); 
    exit;
}

$id = (int)$_GET['profil_id'];/*récupère id du profil qu'on a cliqué*/

if(isset($_SESSION['user_id'])){
    $req = $BDD->prepare("SELECT u.*, r.id_demandeur, r.id_receveur, r.statut,r.id_bloqueur
        FROM user u
        LEFT JOIN relation r ON (id_receveur = u.user_id AND id_demandeur = :id2) OR (id_receveur = :id2 AND id_demandeur =u.user_id)
        WHERE u.user_id = :id1");

    $req->execute(array(':id1' => $id, ':id2' =>$_SESSION['user_id']));
}
else{
    $req = $BDD->prepare("SELECT u.*, r.id_demandeur, r.id_demandeur, r.statut,r.id_bloqueur
        FROM user u
        WHERE u.user_id = :id1");

    $req->execute(array(':id1' => $id));
}

$afficher_profil = $req->fetch();

/*print_r($afficher_profil);*/
if(!empty($_POST)){
    extract($_POST);
    $valid=(boolean) true;


    if(isset($_POST['user-follow'])){
        $req = $BDD->prepare("SELECT id FROM relation WHERE (id_receveur = ? AND id_demandeur = ?) OR (id_receveur = ? AND id_demandeur = ?)"); 

        $req->execute(array($afficher_profil['user_id'], $_SESSION['user_id'], $_SESSION['user_id'],$afficher_profil['user_id']));

        $verif_relation = $req->fetch();

        if(isset($verif_relation['id'])){/*qd on a déja envoyé une demande on ne plus en envoyer a la mm personne*/
            $valid=false;
        }
        if($valid){
            $req=$BDD->prepare("INSERT INTO relation (id_demandeur,id_receveur,statut) VALUES (?,?,?)");
            $req->execute(array($_SESSION['user_id'],$afficher_profil['user_id'],1));
        }

        header('Location: profils.php?profil_id='.$afficher_profil['user_id']);
        exit;
    }

    else if(isset($_POST['user-unfollow'])){
        $req=$BDD->prepare("DELETE FROM relation  WHERE (id_receveur = ? AND id_demandeur = ?) OR (id_receveur = ? AND id_demandeur = ?)");
        $req->execute(array($_SESSION['user_id'],$afficher_profil['user_id'],1));
        $req->execute(array($afficher_profil['user_id'], $_SESSION['user_id'], $_SESSION['user_id'],$afficher_profil['user_id']));
        header('Location: profils.php?profil_id='.$afficher_profil['user_id']);
        exit;
    }
    else if(isset($_POST['user-bloquer'])){
        $req=$BDD->prepare("DELETE FROM relation  WHERE (id_receveur = ? AND id_demandeur = ?) OR (id_receveur = ? AND id_demandeur = ?)");
        $req->execute(array($_SESSION['user_id'],$afficher_profil['user_id'],1)); /*on suppose que le statut 1 est une demande en attente*/
        $req->execute(array($afficher_profil['user_id'], $_SESSION['user_id'], $_SESSION['user_id'],$afficher_profil['user_id']));

        $req=$BDD->prepare("INSERT INTO relation (id_demandeur,id_receveur,statut,id_bloqueur) VALUES (?,?,?,?)");
        $req->execute(array($_SESSION['user_id'],$afficher_profil['user_id'],3,$afficher_profil['user_id']));
        /*c'est comme delete mais on insère juste l'id de du profil bloqué*/ /*on suppose que le statut 3 est une demande bloqué*/


        header('Location: profils.php?profil_id='.$afficher_profil['user_id']);
        exit;
    } 
    else if(isset($_POST['user-debloquer'])){
        $req=$BDD->prepare("DELETE FROM relation  WHERE (id_receveur = ? AND id_demandeur = ?) OR (id_receveur = ? AND id_demandeur = ?)");
        $req->execute(array($_SESSION['user_id'],$afficher_profil['user_id'],1));
        $req->execute(array($afficher_profil['user_id'], $_SESSION['user_id'], $_SESSION['user_id'],$afficher_profil['user_id']));

        header('Location: profils.php?profil_id='.$afficher_profil['user_id']);
        exit;
    } 
}

?>


<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Mon profil</title>
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
        require_once('assets/skeleton/navbar.php');
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
                        if($_SESSION['user_id']==$afficher_profil['user_id']){/*on peut voir ces boutons seulement sur notre compte*/
                     ?>
                    <button class="infos-privee-btn"><a href="privee.php?profil_id=<?= $afficher_profil['user_id']?>" >Infos privée</a></button>

                    <button class="editer-btn"><a href="editer-profil.php?profil_id=<?= $afficher_profil['user_id']?>" >Editer</a></button>
                    <?php
                        }
                         else{
                    ?>
                     <div class="col-md-4" style="display:inline-block;width:30%;margin-left:5%">
                    <button class="msg-btn">DM</button>   
                    <?php
                         }
                    ?>
                    
                    
                    <div>
                        <?= $afficher_profil['user_nbfollowers'] ?> Follower(s)
                    </div>
                </div>


            </div>
        </div>
        <div>
            <?php
             if(isset($_SESSION['user_id'])&& $_SESSION['user_id']!=$afficher_profil['user_id']){
            ?>    
            <form method="post" class="follow-btn">
                <?php
                    if(!isset($afficher_profil['statut'])){
                ?>
                <input type="submit" name="user-follow" value="Follow" class="follow-btn">
                <?php
                    }
                ?>
                <?php
                    if(isset($afficher_profil['statut']) && $afficher_profil['statut']<3 && $afficher_profil['id_demandeur']==$_SESSION['user_id']){
                ?>
                <input type="submit" name="user-unfollow" value="Unfollow" class="follow-btn">
                <?php
                    }
                    if((isset($afficher_profil['statut'])||$afficher_profil['statut']==NULL) && $afficher_profil['statut']<3){
                ?>
                <input type="submit" name="user-bloquer" value="Bloquer" class="follow-btn">
                 <?php
                    }
                    else if($afficher_profil['id_bloqueur'] != $_SESSION['user_id']){
                ?>
                <input type="submit" name="user-debloquer" value="Débloquer" class="follow-btn">
                <?php
                    }
                    else{
                ?>
                <div>Vous avez été bloqué par cet utilisateur</div>
                <?php
                      }
                ?>
            </form>
            <?php
        }
        ?> 
        </div>                     

    </body>
</html>