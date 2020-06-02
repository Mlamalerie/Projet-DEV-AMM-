<?php
session_start();

include('assets/db/connexiondb.php'); 

/*print_r($_GET);*/

if (!isset($_GET['profil_id'])){
    header('Location: profils.php'); 
    exit;
}

$id = (int)$_GET['profil_id'];/*récupère id du profil qu'on a cliqué*/

$req = $BDD->prepare("SELECT * 
    FROM user 
    WHERE user_id = ?");

$req->execute(array($id));

$privee = $req->fetch();

/*print_r($afficher_profil);*/

?>


<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>Partie privée</title>
        <style>
            .img-privee{
                background: red;
                width: 150px;
                height: 150px; 
                padding: 10px;
                display:inline-block;
                width:15%;
            }
            .infos-privee{
                background:rgba(121, 6, 247,1);
                display:inline-block;
                width:80%;
            }
        </style>
</head>
<body>
        <div class="container">
           
            <div class="img-privee">
                    <img src="img/<?=$privee['user_image']?>" style="width: 150px;height: 150px;">
            </div>
            
            <div class="infos-privee">
                    <h2><?= $privee['user_nom'] ?> <?= $privee['user_prenom']?></h2>  
                    <ul>                   
                        <li>Adresse complète : <?= $privee['user_ville'] ?></li> 
                         <li>Mot de passe : <?= $privee['user_password'] ?></li>               <li>Historique des achats/ventes<?= $privee['user_id_beats'] ?></li>
                    </ul>
            </div>
            
        </div>
</body>
</html>