<?php
session_start();

include('assets/db/connexiondb.php'); 

/*print_r($_GET);*/



$id = (int)$_GET['profil_id'];/*récupère id du profil qu'on a cliqué*/

$req = $BDD->prepare("SELECT * 
    FROM user 
    WHERE user_id = ?");

$req->execute(array($id));

$afficher_profil = $req->fetch();

/*print_r($afficher_profil);*/

if(isset($_POST['modifier'])){
    $pseudo = (String) trim($pseudo);
    $email = (String) strtolower(trim($email));
    $motdepasse = (String) trim($motdepasse);


    // Verification pseudo motdepasse et email
    if(empty($pseudo)) {
        $ok = false;
        $err_pseudo = "Veuillez renseigner ce champ !";

    } else {
        $req = $BDD->prepare("SELECT user_id
                            FROM user
                            WHERE user_pseudo = ? 
                                ");
        $req->execute(array($pseudo));
        $user = $req->fetch();

        if(isset($user['user_id'])){
            $ok = false;
            $err_pseudo = "Ce pseudo existe déjé !";
        }
    }
    if(empty($motdepasse)) { // si le champ mot de passe est vide
        $ok = false;
        $err_motdepasse = "Veuillez renseigner ce champ !";

    }
    if(empty($email)) {
        $ok = false;
        $err_email = "Veuillez renseigner ce champ !";

    }else {
        $req = $BDD->prepare("SELECT user_id
                            FROM user
                            WHERE user_email = ? 
                                ");
        $req->execute(array($email));
        $user = $req->fetch();

        if(isset($user['user_id'])){
            $ok = false;
            $err_email = "Cette e-mail existe déjé !";
        }
    }

    if($ok) {
        // preparer requete
        $req = $BDD->prepare("UPDATE user SET(user_pseudo,user_email,user_password) VALUES (?, ?, ?) WHERE user_id= ?"); 

        $req->execute(array($pseudo,$email,$motdepasse));

        $_SESSION['user_pseudo'] = $pseudo;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_password'] = $motdepasse;

        header('Location: profils.php');
        exit;
    }
}

?>


<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Editer profil</title>
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
        <div class="container">
            <div class="row">


                <div class="col-md-4" style="width: 150px;height: 150px; padding: 10px;display:inline-block;width:15%";>
                    <img src="img/<?=$afficher_profil['user_image']?>" style="width: 150px;height: 150px;">
                </div>

                <div class="col-md-4 infos" style="display:inline-block;width:70%;margin-left:5%">
                    <form method="post">
                        <?php 
                            if(!isset($pseudo)){
                                $pseudo=$afficher_profil['user_pseudo'];
                            }
                        ?>
                        <label>Pseudo : </label>
                        <br/>
                        <input type="text" name="pseudo" value="<?= $pseudo ?>">
                        
                        
                        <?php 
                            if(!isset($email)){
                                $email=$afficher_profil['user_email'];
                            }
                        ?>
                        <label>Email : </label>
                        <br/>
                        <input type="mail" name="email" value="<?= $email ?>">
                        
                        
                        <?php 
                            if(!isset($motdepasse)){
                                $motdepasseo=$afficher_profil['user_password'];
                            }
                        ?>
                        <label>Mot de passe : </label>
                        <br/>
                        <input type="password" name="mdp" value="<?= $motdepasse ?>">
                        
                        
                        
                        
                    </form>
                </div>

            </div>
        </div>                                                                   

    </body>
</html>