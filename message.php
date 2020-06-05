<?php
session_start();
$_SESSION['ici_index_bool'] = false;

include('assets/db/connexiondb.php'); 


if (!isset($_SESSION['user_id'])){/*si pas connecté*/
    header('Location: /'); 
    exit;
}

$get_id =(int)$_GET['profil_id'];

if($get_id <= 0){
    header('Location: messagerie.php'); 
    exit;
}

$req= $BDD -> prepare("SELECT id 
                    FROM relation 
                    WHERE ((id_demandeur,id_receveur)=(:id1,:id2) OR (id_demandeur,id_receveur)=(:id2,:id1)) AND statut = :statut");/*sécurité pour  les personnes bloquées (on peut pas envoyer ou recevoir leur mssg) */
$req->execute(array('id1'=>$_SESSION['user_id'], 'id2' => $get_id, 'statut' => 1));/*statut 1 est un utilisateur non bloqué*/

$verif_relation=$req->fetch();
if(!isset($verif_relation['id'])){
    header('Location: messagerie.php'); 
    exit;
}

$req= $BDD -> prepare("SELECT * 
                    FROM messagerie 
                    WHERE ((id_from,id_to)=(:id1,:id2) OR (id_from, id_to)=(:id2,:id1)) 
                    ORDER BY date_message ASC
                    LIMIT 25");/*affichage limité à 25 messages*/
$req->execute(array('id1'=>$_SESSION['user_id'], 'id2' => $get_id));

$afficher_message=$req->fetchAll();

if(!empty($_POST)){
    extract($_POST);
    $valid=(boolean) true;

    if(isset($_POST['envoyer'])){
        $message=(String) trim($message);
        if(empty($message)){
            $valid=false;
            $err_message="Mets un message ma gueule";
        }

        if($valid){
            $date_message=date("Y-m-d h:m:s");
            $req=$BDD->prepare("INSERT INTO messagerie (id_from,id_to, message,date_message,lu) VALUES (?,?,?,?,?)");

            $req->execute(array($_SESSION['user_id'],$get_id,$message,$date_message,1));
        }

        header('Location: message.php?profil_id='.$get_id);
        exit;
    }

    else if(isset($_POST['supprimer'])){

        $req=$BDD->prepare("DELETE FROM messagerie WHERE id = ?");

        $req->execute(array($_POST['id']));

        header('Location: message.php?profil_id='.$get_id);
        exit;
    }
    else if(isset($_POST['bloquer'])){/*on efface toute la conversation */

        $req=$BDD->prepare("DELETE FROM messagerie  WHERE (id_from = ? AND id_to = ?) OR (id_to = ? AND id_from = ?)");
        $req->execute(array($_SESSION['user_id'],$get_id,$_SESSION['user_id'],$get_id));



        header('Location: message.php?profil_id='.$get_id);
        echo '<br/><br/><br/><br/>Vous avez bloqué cet utilisateur';
        exit;
    }
}



?>


<?php
$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    
    $okconnectey = true;
} else{
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Mes DM</title>
        <?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">

        <style>

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
                <div class="col-sm-12">
                    <?php
                    foreach($afficher_message as $am){
                        if($am['id_from']==$_SESSION['user_id']){
                    ?>
                    <div style="background:#7728b2; color:white;margin-left:25%"> <!--le message qu'on envoie-->
                        <?= $am['message'] ?> 
                        <form method="post"><!--si on veut supprimer un mssg-->
                            <input type="text" name="id" value ="<?= $am['id'] ?>" class="d-none">
                            <input type="submit" name="supprimer" value="Supprimer">
                        </form>
                       
                      
                    </div>
                    <?php
                        }
                        else{
                    ?>
                    <div>
                        <?= $am['message'] ?> <!--le message qu'on reçoit-->
                         <!--si on veut signaler un mssg-->
                        <select>
                            <option>Agression</option>
                            <option>Contenant choquant</option>
                            <option selected>Signaler(pour un abus par défaut)</option>
                            <option>Atteinte à la pudeur</option>
                        </select>
                    </div>
                    <?php 
                        }
                    }
                    ?>
                </div>
                <div class="col-sm-12" style="margin-top: 50px">
                    <?php
                    if(isset($err_message)){
                        echo $err_message;
                    }
                    ?>
                    <form method="post">
                        <textarea placeholder="Votre message..." name="message"></textarea>
                        <br/>
                        <input type="submit" name="envoyer" value="Envoyer"/>
                        <input type="submit" name="bloquer" value="Supprimer la conversation"/>
                    </form>
                   
                </div>
            </div>
        </div>
        

    </body>
</html> 