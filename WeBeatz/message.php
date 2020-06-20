<?php
session_start();
$_SESSION['ici_index_bool'] = false;

include('assets/db/connexiondb.php'); 

$tab = explode('-',$_GET['profil_id']);
$get_id =(int)$tab[0];
$idmoi = (int)$tab[1];

$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    $okconnectey = true;

    if($_SESSION['user_role'] != 0 && $idmoi != $_SESSION['user_id']){
        echo "<script> history.go(-1); </script>";
        exit;

    }
} else {
    header('Location: index.php');
    exit;
}





//*** lu lu
$req=$BDD->prepare("UPDATE messagerie SET lu = 1
                        WHERE (id_to = ? AND id_from = ?)")  ;
$req->execute(array($idmoi,$get_id));

//*

$req=$BDD->prepare(" SELECT user_pseudo FROM user
                        WHERE user_id = ?");
$req->execute(array($get_id));
$user = $req->fetch();
print_r($_SESSION);
if($get_id <= 0){
    header('Location: messagerie.php'); 
    exit;
}

$req= $BDD -> prepare("SELECT id 
                    FROM relation 
                    WHERE ((id_demandeur,id_receveur)=(:id1,:id2) OR (id_demandeur,id_receveur)=(:id2,:id1)) AND statut = :statut");/*sécurité pour  les personnes bloquées (on peut pas envoyer ou recevoir leur mssg) */
$req->execute(array('id1'=>$_SESSION['user_id'], 'id2' => $get_id, 'statut' => 3));/*statut 3 est un utilisateur bloqué*/

$verif_relation=$req->fetch();
if(isset($verif_relation['id'])){
    header('Location: messagerie.php'); 
    exit;
}

$req= $BDD -> prepare("SELECT * 
                    FROM messagerie 
                    WHERE ((id_from,id_to)=(:id1,:id2) OR (id_from, id_to)=(:id2,:id1)) 
                    ORDER BY date_message ASC
                    LIMIT 25");/*affichage limité à 25 messages*/
$req->execute(array('id1'=>$idmoi, 'id2' => $get_id));

$afficher_message=$req->fetchAll();
print_r($_POST);
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
            $req->execute(array($idmoi,$get_id,$message,$date_message,0));

            //*** Vcreation dune relation 0
            $req = $BDD->prepare("SELECT id 
                            FROM relation
                            WHERE ((id_demandeur = ? AND id_receveur = ?) OR (id_demandeur = ? AND id_receveur = ?)) AND statut <> 3 ");
            $req->execute(array($idmoi,$get_id,$get_id,$idmoi));
            $verif_re0 = $req->fetch();
            if(!isset($verif_re0['id'])){
                $req=$BDD->prepare("INSERT INTO relation (id_demandeur,id_receveur,statut,date_relation) VALUES (?,?,?,?)");
            $req->execute(array($idmoi,$get_id,0,$date_message));
            }


        }

        header('Location: message.php?profil_id='.$get_id.'-'.$idmoi);
        exit;
    }

    if(isset($_POST['inputOption'])) {
        $id_message= (int) $_POST['inputOption_message_id'];
        $ok = true;


        //*** Verification du id
        $req = $BDD->prepare("SELECT id_from 
                            FROM messagerie
                            WHERE id = ?");
        $req->execute(array($id_message));
        $verif_m = $req->fetch();
        if(!isset($verif_m['id_from'])){ 
            $ok = false;
            echo '###';
        }


        if($_POST['inputOption']== "signaler") {

            if($ok) {
                echo "ezgrzg";
                $req = $BDD->prepare("INSERT INTO messagerie_signal
             (message_id, motif) VALUES (?, ?)
           "); 
                $req->execute(array($id_message,1));    
                //           header('Location: message.php?profil_id='.$get_id);
                //            exit;
            }
        }   
        else if($_POST['inputOption']== "suppr"){
            if($ok){
                $req = $BDD->prepare("DELETE FROM messagerie
            WHERE id = ?"); 
                $req->execute(array($id_message));
                header('Location: message.php?profil_id='.$get_id.'-'.$idmoi);
                exit;
            }
        }

    }


}

?>


<?php
$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {

    $okconnectey = true;
} 
else{
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

            <?php
            $req2 = $BDD->prepare("SELECT user_image
                                                FROM user
                                                 WHERE user_pseudo = ?");
            $req2->execute(array($user['user_pseudo']));

            $img_from=$req2->fetch(); 

            ?>

            <h1><a href="profil.php?profil_id=<?= $get_id ?>"><img src="<?= $img_from['user_image'] ?>"class="rounded-circle" width="50" height="50"></a>Discussion avec <a href="profil.php?profil_id=<?= $get_id ?>"><?= $user['user_pseudo']?></a></h1>
           <br/>

            <div class="row">
                <div class="col-sm-12">
                    <?php
    foreach($afficher_message as $am){
        if($am['id_from']==$idmoi){
                    ?>
                    <div style="background:#7728b2; color:white;margin-left:25%;"> <!--le message qu'on envoie-->
                        <div class=" p-2 rounded-pill border-0 shadow-sm"><?= $am['message'] ?></div>

                        <?php
                        $req = $BDD->prepare("SELECT user_pseudo
                                                FROM user
                                                 WHERE user_id = ?");
            $req->execute(array($am['id_from']));

            $a=$req->fetch(); 

                        ?>
                        <div style="font-size : 11px">
                            <a class="btn" title="Supprimer <?= $am['message']?>" data-toggle="modal" data-target="#desac_modal" onclick="goInputOption_mess(this,'suppr','<?= $am['id'] ?>','<?= $a['user_pseudo']?>')" ><span class="text-dark"><i class='fa fa-trash' style="font-size : 11px"></i></span></a>
                            <i class="fa fa-check-circle-o" aria-hidden="true"></i> <?= $am['date_message']?>
                        </div>
                    </div>
                    <?php
        }
        else{
                    ?>
                    <div>
                        <?php
            $req1 = $BDD->prepare("SELECT user_image
                                                FROM user
                                                 WHERE user_id = ?");
            $req1->execute(array($am['id_from']));

            $img_from=$req1->fetch(); 
                        ?>

                        <div class="p-2 rounded-pill border-0 shadow-sm"><img src="<?= $img_from['user_image'] ?>" class="rounded-circle" width="25" height="25"><span class="ml-3"><?= $am['message'] ?></span></div> <!--le message qu'on reçoit-->
                        <!--si on veut signaler un mssg-->

                        <?php
                            $req = $BDD->prepare("SELECT user_pseudo
                                                FROM user
                                                 WHERE user_id = ?");
            $req->execute(array($am['id_from']));

            $a=$req->fetch(); 

                        ?>
                        <div style="font-size : 11px">
                            <a class="btn" title="Signaler <?= $am['message']?>" data-toggle="modal" data-target="#desac_modal" onclick="goInputOption_mess(this,'signaler','<?= $am['id'] ?>', '<?= $a['user_pseudo']?>')" ><span class="text-dark" ><i class="fa fa-exclamation-circle" aria-hidden="true" style="font-size : 11px"></i></span></a>
                            <i class="fa fa-check-circle-o" aria-hidden="true"></i> <?= $am['date_message']?>
                        </div>

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
                        <input type="submit" name="envoyer" class="btn btn-danger" style="background:#7728b2;border-color:#7728b2" value="Envoyer"/>
                        <input type="submit" name="bloquer" class="btn btn-danger" value="Supprimer la conversation"/>
                    </form>

                </div>
            </div>
        </div>
        <script type="text/javascript">
            function goInputOption_mess(bay,mode,idd,blaz){
                var p = document.getElementById('phraseConfirm');
                var iO = document.getElementById('inputOption');
                var iO_id = document.getElementById('inputOption_message_id');

                iO.value = mode;
                iO_id.value = idd;
                console.log(iO.value,iO_id.value);
                if(mode == 'signaler' ) {
                    p.innerHTML = "signaler le message de " + blaz + " ?";
                }
                else if (mode == 'suppr'){
                    p.innerHTML = "supprimer votre message ?";   
                }

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
        <?php
        require_once('assets/skeleton/endLinkScripts.html');
        ?>
    </body>
</html> 