<?php
session_start();
$_SESSION['ici_index_bool'] = false;

include('assets/db/connexiondb.php'); 


if (!isset($_SESSION['user_id'])){/*si pas connecté*/
    header('Location: /'); 
    exit;
}

$req = $BDD ->prepare("SELECT u.user_pseudo, u.user_id, u.user_image, u.user_statut, m.message, m.date_message, m.id_from, m.id_to, m.lu
    FROM(
   SELECT IF(r.id_demandeur=:id, r.id_receveur, r.id_demandeur) id_user, MAX(m.id) max_id 
    FROM relation r 
    LEFT JOIN messagerie m ON ((m.id_from,m.id_to)=(r.id_demandeur,r.id_receveur) OR (m.id_from,m.id_to)=(r.id_receveur,r.id_demandeur)) 
    WHERE (r.id_demandeur=:id or r.id_receveur=:id) 
    GROUP BY IF(m.id_from=:id, m.id_to, m.id_from), r.id) AS DM
    LEFT JOIN messagerie m ON m.id = DM.max_id
    LEFT JOIN user u ON u.user_id = DM.id_user
    ORDER BY m.date_message DESC");

$req->execute(array('id'=>$_SESSION['user_id']));  





$afficher_conversation= $req ->fetchAll();

$req1=$BDD->prepare("SELECT * FROM relation WHERE (id_demandeur = ? AND statut = ?) OR (id_receveur = ? AND statut = ?)");
$req1->execute(array($_SESSION['user_id'],3,$_SESSION['user_id'],3));   //pour enlever les bloqués de la messagerie

$relation_bloq=$req1->fetchAll(); 
print_r($relation_bloq);
?>

<?php
$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])) {

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
        // require_once('assets/skeleton/navbar.php');
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
                            foreach($relation_bloq as $rb) { //enlever les personnes bloqués de notre messagerie                            
                                if($ac['user_id'] == $rb['id_receveur']) {                                    
                                    $okaffichemess = false;
                                }
                                else if($ac['user_id']==$rb['id_demandeur']){ // on enlève la personne qui nous a bloqué aussi
                                     $okaffichemess = false;
                                }
                                else if($ac['user_statut'] == 0){// on enlève les profils désactivés
                                    $okaffichemess = false;
                                }
                            }
                            if($okaffichemess){ 
                        ?>
                        <tr>
                            <td>

                                <a href="message.php?profil_id=<?= $ac['user_id'] ?>" class="pseudo">
                                  <img src="<?= $ac['user_image'] ?>">  <?= $ac['user_pseudo'] ?>
                                </a>

                            </td>

                            <td>
                                <?php
                            if(($ac['id_from'] != $_SESSION['user_id']) && $ac['lu']==1){
                                ?>
                                <b>Nouveau message</b>
                                <?php
                            }
                                ?>
                            </td>

                            <td> <?php


                                if(isset($ac['message'])){
                                    echo $ac['message'];
                                }
                                else{
                                    echo '  <b>Dites lui bonjour !</b>  ';
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