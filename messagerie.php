<?php
session_start();
$_SESSION['ici_index_bool'] = false;

include('assets/db/connexiondb.php'); 
$idmoi = (int) $_SESSION['user_id'] ;
$id_messagerie = (int) $_GET['id'];

$okconnectey = false;
$oksessionadmin = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    $okconnectey = true;

    if($_SESSION['user_role'] != 0 && $idmoi != $id_messagerie){
        echo "<script> history.go(-1); </script>";
        exit;

    } else {
        $oksessionadmin = true;
    }
} else {
    header('Location: index.php');
    exit;
}






print_r($_SESSION);

echo 'idmass'.$id_messagerie;


$req = $BDD ->prepare("SELECT u.user_pseudo, u.user_id, u.user_image, u.user_statut, m.message, m.date_message, m.id_from, m.id_to, m.lu
                        FROM(
                        SELECT IF(r.id_demandeur=:id, r.id_receveur, r.id_demandeur) id_user, MAX(m.id) max_id FROM relation r 
                        LEFT JOIN messagerie m ON ((m.id_from,m.id_to)=(r.id_demandeur,r.id_receveur) OR (m.id_from,m.id_to)=(r.id_receveur,r.id_demandeur)) 
                        WHERE (m.id_to=:id or m.id_from=:id)
                        GROUP BY IF(m.id_from=:id, m.id_to, m.id_from), r.id) AS DM
                        LEFT JOIN messagerie m ON m.id = DM.max_id
                        LEFT JOIN user u ON u.user_id = DM.id_user
                        ORDER BY m.date_message DESC");

$req->execute(array('id'=>$id_messagerie ));  





$afficher_conversation= $req ->fetchAll();
//var_dump($afficher_conversation);

$req1=$BDD->prepare("SELECT * FROM relation WHERE statut = ?");
$req1->execute(array(3));   //pour enlever les bloqués de la messagerie

$relation_bloq=$req1->fetchAll(); 

?>



<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Ma Messagerie</title>
        <?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">

        <style>
            .pseudo{
                color: #7728b2;

            }
            .pseudo img{
                height: 20px;
                width: 20px;
            }
            .all_mssg{
                border: 3px solid #7728b2;
                border-radius: 20%;
            }
            tr:nth-child(even) {
                background-color: rgb(230,235,255);
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
                <div class="col-sm-12">
                    <h1>Mes messages</h1>
                    <table class="all_mssg">
                        <?php

                        foreach($afficher_conversation as $ac){

                            $okaffichemess = true;


                            foreach($relation_bloq as $rb) {
                                if(($ac['user_id'] == $rb['id_receveur'] && $id_messagerie == $rb['id_demandeur'] )  ||  ($ac['user_id'] == $rb['id_demandeur'] && $id_messagerie == $rb['id_receveur'] )  || ($ac['user_statut'] == 0) ) {
                                    $okaffichemess = false;
                                }
                            }


                            if($okaffichemess){ //enlever bloqués messagerie

                        ?>
                        <tr>
                            <td>
                                <?php
                                if ($oksessionadmin && ($ac['id_to'] == $_SESSION['user_id']) ) {
                                ?>
                                <a href="message.php?profil_id=<?= $ac['user_id'] ?>-<?= $id_messagerie?>" class="pseudo">
                                    <img src="<?= $ac['user_image'] ?>"> 222222 <?= $ac['user_pseudo'] ?> <?= $ac['user_id'] ?>-<?=  $id_messagerie?>  </a>  


                                <?php }
                                else if ($oksessionadmin){
                                ?>   
                                <a href="message.php?profil_id=<?= $ac['user_id'] ?>-<?= $ac['id_from'] ?>" class="pseudo">
                                    <img src="<?= $ac['user_image'] ?>">111111  <?= $ac['user_pseudo'] ?><?= $ac['user_id'] ?>-<?= $ac['id_from'] ?>
                                </a>  

                                <?php
                                }
                                ?>
                            </td>

                            <td>
                                <?php
                                if(($ac['id_from'] != $id_messagerie ) && $ac['lu']==0){
                                ?>
                                <b>Nouveau message</b>
                                <?php
                                }
                                ?>
                            </td>

                            <td>
                                <?php 
                                if(isset($ac['date_message'])){
                                    echo date('d-m-Y à H:i:s', strtotime($ac['date_message'])); 
                                }
                                ?>
                            </td>
                        </tr>
                        <?php 
                            }            
                        }

                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html> 