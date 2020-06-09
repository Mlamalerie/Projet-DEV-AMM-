<?php
session_start();
include_once("assets/db/connexiondb.php"); // inclure le fichier pour se connecter à la base de donnée
include_once("fichierfct.php");
print_r($_SESSION);
// si une connection est détecter : (ta rien a faire ici mec)
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo']) ){
    header('Location: test_zone.php');
    exit;
}

print_r($_POST);

if(!empty($_POST)){

    extract($_POST); // si pas vide alors extraire le tableau, grace a ça on pourra directemet mettre le nom de la varilable en dur

    $ok = true;

    if(isset($_POST['connexion'])){

        $email = (String) strtolower(trim($email));
        $motdepasse = (String) trim($motdepasse);

        $icon = " <svg class='bi bi-exclamation-circle' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                            <path fill-rule='evenodd' d='M8 15A7 7 0 108 1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z' clip-rule='evenodd'/>
                                            <path d='M7.002 11a1 1 0 112 0 1 1 0 01-2 0zM7.1 4.995a.905.905 0 111.8 0l-.35 3.507a.552.552 0 01-1.1 0L7.1 4.995z'/>
                                        </svg>";


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

            if(!isset($user['user_id'])){
                $ok = false;
                $err_email = "nda";
            }
        }

        $req = $BDD->prepare("SELECT user_id,user_statut
                            FROM user
                            WHERE user_email = ? AND user_password = ?
                                ");
        $req->execute(array($email,crypt($motdepasse,'$6$rounds=5000$grzgirjzgrpzhte95grzegruoRZPrzg8$')));
        $verif_user = $req->fetch();

        if(!isset($verif_user['user_id'])) {
            $ok = false;
            $err_email = " Adresse e-mail ou mot de passe invalide";

        } else {
            if($verif_user['user_statut'] == 0) {
            $ok = false;
            $err_email = " Pour des raisons, votre compte à été désactivé.";
            }

            
            
        }

        if($ok){//tout est bon on a bien l'utilisateur
            $req = $BDD->prepare("UPDATE user
            SET user_dateconnexion = ?
            WHERE user_id = ?");
            $req->execute(array(date("Y-m-d H:i:s"),$verif_user['user_id']));


            // selectionne tout les info de l'user
            $req = $BDD->prepare("SELECT *
                            FROM user
                            WHERE user_id = ?
                                ");
            $req->execute(array($verif_user['user_id']));
            $verif_user = $req->fetch();

            // initialiser variable de session
            $_SESSION['user_id'] = $verif_user['user_id'];
            $_SESSION['user_pseudo'] = $verif_user['user_pseudo'];
            $_SESSION['user_email'] = $verif_user['user_email'];
            $_SESSION['user_image'] = $verif_user['user_image'];
            $_SESSION['user_role'] = $verif_user['user_role'];

            $listeGenres = ['Hip Hop','Trap','Afro','Deep','Pop','Rock','Reggae',"Indéfini"];
            sort($listeGenres);
            $_SESSION['listeGenres'] = $listeGenres ;

           // header('Location: dashboard.php');
          
            echo "<script> history.go(-2); </script>";
             exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="assets/css/styles-index.css">
        <link rel="stylesheet" type="text/css" href="assets/css/inscription-connexion.css">
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">

        <title>Connexion</title>
    </head>
    <body>
      
        <div class="container-fluid">
            <div class="row no-gutter">
                <!-- The image half -->
                <div class="col-md-6 d-none d-md-flex bg-image"></div>


                <!-- The content half -->
                <div class="col-md-6 ">
                    <div class="login d-flex align-items-center py-5">

                        <!-- Demo content-->
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 col-xl-7 mx-auto">
                                    <h3 class="display-4">Connexion</h3>
                                    <p class="text-muted mb-4">Connectez-vous pour accéder à des fonctionnalités supplémentaires !</p>
                                    <form method="post">


                                        <!--EMAIL-->
                                        <div class="form-group mb-4">
                                            <?php

                                            if(isset($err_email)){
                                                echo "<span class='spanAlertchamp'> ";
                                                echo $icon . $err_email ;
                                                echo "</span> ";
                                            } 
                                            ?>
                                            <label for="email">Votre Adresse Email</label>
                                            <input type="email" class="form-control rounded-pill border-0 shadow-sm px-4" id="email" name="email" aria-describedby="emailHelp" placeholder="Tapez votre e-mail" value="<?php if(isset($email)){echo $email;}?>">
                                           
                                        </div>
                                        <!--MOT DE PASSE-->
                                        <div class="form-group">
                                            <?php

                                            if(isset($err_motdepasse)){
                                                echo "<span class='spanAlertchamp'> ";
                                                echo  $icon . $err_motdepasse ;
                                                echo "</span> ";
                                            } 
                                            ?>
                                            <label for="motdepasse">Mot de passe</label>
                                            <input type="password" class="form-control rounded-pill border-0 shadow-sm px-4" id="motdepasse" name ="motdepasse" placeholder="Tapez votre mot de passe">
                                        </div>





                                        <button type="submit" class="btn btn-primary" name="connexion">Connectez-vous</button>
                                    </form>
                                    <p class="text-muted mb-4">Vous n'avez pas de compte ? <a href="inscription.php">Inscrivez vous</a></p>
                                </div>
                            </div>
                        </div><!-- End -->

                    </div>
                </div><!-- End -->

            </div>
        </div>



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>