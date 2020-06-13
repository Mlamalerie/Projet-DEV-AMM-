<?php
session_start();

include('assets/db/connexiondb.php'); 

/*print_r($_GET);*/

if (!isset($_GET['profil_id'])){
    header('Location: /'); 
    exit;
}

$id = (int)$_GET['profil_id'];/*récupère id du profil qu'on a cliqué*/

if ($id != $_SESSION['user_id']){
    header('Location: /'); 
    exit;
}

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
        <title>Ma partie privée</title>
        <?php
    require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <link rel="stylesheet" type="text/css" href="assets/css/profil.css">
    </head>
    <body class="profile-page">
        <div class="page-header header-filter" data-parallax="true" style=""></div>
        <div class="main main-raised">
            <div class="profile-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 ml-auto mr-auto">
                            <div class="profile">
                                <div class="avatar">
                                    <img src="<?=$privee['user_image']?>" alt="Circle Image" class="img-raised img-fluid roundedImage"> 

                                </div>
                                <div class="name">
                                    <h3 class="title"><?=$privee['user_pseudo']?></h3>
                                    <?php if ($privee['user_role'] == 0){?>
                                    <h6>ADMIN</h6>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div >
                        <h2><?= $privee['user_nom'] ?> <?= $privee['user_prenom']?></h2>  
                        <ul>                   
                            <li>Adresse complète : <?= $privee['user_ville'] ?></li> 
                            <li>Mot de passe : <?= $privee['user_password'] ?></li>               
                        </ul>
                    </div>        
                </div>
            </div>
        </div>
        <?php
        require_once('assets/skeleton/endLinkScripts.php');
        ?>
    </body>
</html>