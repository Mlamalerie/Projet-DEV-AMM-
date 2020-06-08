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
            $err_message="Mets un message";
        }

        if($valid){
            $date_message=date("Y-m-d h:m:s");
            $req=$BDD->prepare("INSERT INTO messagerie (id_from,id_to, message,date_message,lu) VALUES (?,?,?,?,?)");

            $req->execute(array($_SESSION['user_id'],$get_id,$message,$date_message,0));
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
            .selected-user {
                width: 100%;
                border: 3px solid #7728b2;
                border-radius: 2%;
            }
            .under_msg{
                margin-top: 100px;
            }

        </style>

    </head>
    <body>
        <!--   ************************** NAVBAR  **************************  -->

        <?php
        require_once('assets/skeleton/navbar.php');
        ?>
        <br/><br/><br/><br/>
        
        <div class="container selected-user">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    foreach($afficher_message as $am){
                        if($am['id_from']==$_SESSION['user_id']){
                    ?>
                    <div style="background:#7728b2; color:white;margin-left:25%;"> <!--le message qu'on envoie-->
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

                <div class="col-sm-12" class="under_msg">
                    <?php
                    if(isset($err_message)){
                        echo $err_message;
                    }
                    ?>
                    <br/>
                    <form method="post">
                        <textarea class="form-control" rows="3" placeholder="Votre message..." name="message"></textarea>
                        <br/>
                        <input type="submit" name="envoyer" value="Envoyer"/>
                        <input type="submit" name="bloquer" value="Supprimer la conversation"/>
                    </form>

                </div>
            </div>
        </div>
        <script type="text/javascript">
            function goInputOption(bay,idd,blaz){
                let mode = bay.value;
                console.log(mode,idd);

                var p = document.getElementById('phraseConfirm');
                var iO = document.getElementById('inputOption');
                var iO_id = document.getElementById('inputOption_message_id');

                iO.value = mode;
                iO_id.value = idd;

                if (mode == 'suppr'){
                    p.innerHTML = "supprimer le message " + blaz + " ?";   
                }
                console.log(iO,iO_id);
            } 
        </script>
        <!-- Modal -->
        <div class="modal fade" id="desac_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Êtes vous sûr de vouloir <span id="phraseConfirm"></span>
                        <form method="post" id="formOptionConfirm" action="">
                            <input type="hidden" name="inputOption" id="inputOption">
                            <input type="hidden" name="inputOption_message_id" id="inputOption_message_id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                        <button onclick="document.getElementById('formOptionConfirm').submit()" type="button" class="btn btn-primary">Oui</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal -->

    </body>
</html> 