<?php
session_start();
include_once("assets/db/connexiondb.php"); // inclure le fichier pour se connecter à la base de donnée

// si une connection est détecter : (ta rien a faire ici mec)
if(isset($_SESSION['user_id'])){
    header('Location: dashboard.php');
    exit;
}


print_r($_POST);

if(!empty($_POST)){

    extract($_POST); // si pas vide alors extraire le tableau, grace a ça on pourra directemet mettre le nom de la varilable en dur

    $ok = true;

    if(isset($_POST['inscription'])){
        //*** Saisies :
        $pseudo = (String) trim($pseudo);
        $email = (String) strtolower(trim($email));
        $motdepasse = (String) trim($motdepasse);
        $motdepasseverif = (String) trim($motdepasseverif);

        $ville = (String) trim($ville);
        $pays = (int) $pays;

        // le svg de l'icon erreur
        $icon = " <svg class='mr-1 my-1 bi bi-exclamation-circle' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                            <path fill-rule='evenodd' d='M8 15A7 7 0 108 1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z' clip-rule='evenodd'/>
                                            <path d='M7.002 11a1 1 0 112 0 1 1 0 01-2 0zM7.1 4.995a.905.905 0 111.8 0l-.35 3.507a.552.552 0 01-1.1 0L7.1 4.995z'/>
                                        </svg>";

        //*** Verification du pseudo
        if(empty($pseudo)) { // si vide
            $ok = false;
            $err_pseudo = "Veuillez renseigner ce champ !";

        } else if (strlen($pseudo) <= 3) {

            $ok = false;
            $err_pseudo = "Ce pseudo est trop petit !";
        }
        else if (ctype_digit($pseudo)) {

            $ok = false;
            $err_pseudo = "Vous êtes obligé de mettre au moins une lettre dans votre pseudo";
        }

        else if (substr_count($pseudo, ' ') >= 3) {

            $ok = false;
            $err_pseudo = "Votre pseudo ne peut contenir au plus 2 espaces";
        }
        else if (!ctype_alnum(implode("",explode(' ',$pseudo)))) {
//            $ps = explode('',$pseudo);
//            for ($i = 0; $i < strlen($pseudo); $i++) {
//                if($pseudo[i] ;
//            }
//            print_r($ps);
//            if(!in_array('_',$ps)) {
                $ok = false;
                $err_pseudo = "Votre pseudo ne doit contenir que des lettres ou des chiffres";
//            }
        }
        else if (strlen($pseudo) > 25) {

            $ok = false;
            $err_pseudo = "Ce pseudo est trop grand ! Vous avez ".(strlen($pseudo) - 25)." caractère(s) en trop";
        }

        else { // ensuite on verifie si ce pseudo existe déja ou pas
            $req = $BDD->prepare("SELECT user_id
                            FROM user
                            WHERE user_pseudo = ? 
                                ");
            $req->execute(array($pseudo));
            $user = $req->fetch();

            if(isset($user['user_id'])){
                $ok = false;
                $err_pseudo = "Ce pseudo est déjà pris ! Choisissez-en un autre. ";
            }
        }
        //*** Verification du mot de passe
        if(empty($motdepasseverif)) { // si le champ mot de passe est vide
            $ok = false;
            $err_motdepasseverif = "Veuillez renseigner ce champ !";

        }
        if(empty($motdepasse)) { // si le champ mot de passe est vide
            $ok = false;
            $err_motdepasse = "Veuillez renseigner ce champ !";

        } else if(strlen($motdepasse) < 5) { // si le champ mot de passe est vide
            $ok = false;
            $err_motdepasse = "Ce mot de passe est trop petit ! ";

        } else if ($motdepasse != $motdepasseverif && $ok){
            $ok = false;
            $err_motdepasse = "Vous n'avez pas rentré le même mot de passe !";
        }

        //*** Verification du mail
        if(empty($email)) { // si vide
            $ok = false;
            $err_email = "Veuillez renseigner ce champ !";

        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // si invalide
            $ok = false;
            $err_email = "Adresse e-mail invalide !";

        } else { // ensuite on verifie si ce mail a déja été pris
            $req = $BDD->prepare("SELECT user_id
                            FROM user
                            WHERE user_email = ? 
                                ");
            $req->execute(array($email));
            $user = $req->fetch();

            if(isset($user['user_id'])){
                $ok = false;
                $err_email = "Cet e-mail existe déjà !";
            }
        }

        //*** Verification du ville
        if(empty($ville)) { // si vide
            $ok = false;
            $err_ville = "Veuillez renseigner ce champ !";

        } else if (strlen($ville) < 3) {

            $ok = false;
            $err_ville = "Cette ville est trop petit !";
        } else if (!ctype_alpha(implode("",explode(' ',$ville)))) {

            $ok = false;
            $err_ville = "Veuillez saisir seulement des lettres sans caractères spéciaux et sans chiffres";
        }

        //*** Verification du Pays
        $req = $BDD->prepare("SELECT id 
                            FROM pays
                            WHERE code = ?");
        $req->execute(array($pays));
        $verif_pays = $req->fetch();


        if($pays == -1){
            echo "$$";
            $ok = false;
            $err_pays = "oh !";
        }
        else if(!isset($verif_pays['id'])){ // si 
            $ok = false;
            $err_pays = "Veuillez renseigner ce champ !";
        }

        //*** Verification du du checkbox
        if(empty($checkmala)) { // si vide
            $ok = false;
            $err_checkmala = "Veuillez renseigner ce champ !";

        }

        if($ok) {

            $date_inscription = date("Y-m-d H:i:s"); 
            $statut = 2;
            $sexe = "0";
            $motdepasse = crypt($motdepasse, '$6$rounds=5000$grzgirjzgrpzhte95grzegruoRZPrzg8$');

            // preparer requete
            $req = $BDD->prepare("INSERT INTO user (user_pseudo,user_email,user_password,user_ville,user_pays,user_dateinscription,user_dateconnexion,user_statut,user_sexe) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)"); 

            $req->execute(array($pseudo,$email,$motdepasse,$ville,$pays,$date_inscription,$date_inscription,$statut,$sexe));

            $_SESSION['user_pseudo'] = $pseudo;
            $_SESSION['user_email'] = $email;

            header('Location: dashboard.php');
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

        <?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
        <link rel="stylesheet" type="text/css" href="assets/css/inscription-connexion.css">
        <link rel="stylesheet" type="text/css" href="assets/css/button-style2ouf.css">

        <title>Inscription</title>
    </head>
    <body>
        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->

        <?php
        // require_once('assets/skeleton/navbar.php');

        ?>

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

                                    <a href="index.php"><img class="iconLOGO" src="assets/img/icon/compact-disc.svg" type="image/svg+xml"></a>
                                    <h3 class="display-4 text-center">Inscription</h3>

                                    <p class="text-muted mb-4 "><span class="topics"></span> Créez un compte WeBeats pour commncer à acheter de Beats et vendre les vôtres !</p>


                                    <form method="post">

                                        <!--PSEUDO-->
                                        <div class="form-group mb-2  ">

                                            <div class="row">
                                                <object class="iconGradient" data="assets/img/icon/user.svg" type="image/svg+xml"></object>
                                                <label for="pseudo"> Pseudo </label>
                                                <!--                                                  <small id="arobasepseudo" class="ml-5 form-text text-muted text-center">  </small>-->
                                            </div>

                                            <input type="text" class="mb-2 text-center form-control rounded-pill border-0 shadow-sm px-4" id="pseudo" name="pseudo" placeholder="Mettez un pseudo pour votre profil"  value="<?php if(isset($pseudo)){echo $pseudo;}?>" autofocus>
                                            <?php
                                            if(isset($err_pseudo)){
                                                echo "<span class='spanAlertchamp'> ";
                                                echo $icon . $err_pseudo ;
                                                echo "</span> ";
                                            }else {
                                            ?>
                                            <small id="emailHelp" class="form-text text-muted text-center"> Comment voulez vous qu'on vous appelle ? </small>
                                            <?php
                                            }
                                            ?>


                                        </div>
                                        <!--EMAIL-->
                                        <div class="form-group mb-4">
                                            <div class="row">
                                                <object class="iconGradient" data="assets/img/icon/envelope.svg" type="image/svg+xml"></object>
                                                <label for="email"> Adresse Email</label>
                                            </div>
                                            <input type="email" class="mb-1 text-center form-control rounded-pill border-0 shadow-sm px-4" id="email" name="email" aria-describedby="emailHelp" placeholder="Tapez votre e-mail" value="<?php if(isset($email)){echo $email;}?>">

                                            <?php

                                            if(isset($err_email)){
                                                echo "<span class='spanAlertchamp'> ";
                                                echo $icon . $err_email ;
                                                echo "</span> ";
                                            } else {
                                            ?>
                                            <small id="emailHelp" class="form-text text-muted text-center">Veuillez à bien rentrer votre e-mai car c'est sur ce dernier que vous allez recevoir vos achats si vous passez commande.</small>
                                            <?php
                                            }
                                            ?>
                                        </div>

                                        <!--MOT DE PASSE-->
                                        <div class="form-group">
                                            <div class="row">
                                                <object class="iconGradient" data="assets/img/icon/lock.svg" type="image/svg+xml"></object>
                                                <label for="motdepasse">Mot de passe</label>
                                            </div>
                                            <input type="password" class="mb-1 text-center form-control rounded-pill border-0 shadow-sm px-4" id="motdepasse" name ="motdepasse" placeholder="Tapez votre mot de passe" value="<?php if(isset($motdepasse)){echo $motdepasse;}?>">
                                            <?php

                                            if(isset($err_motdepasse)){
                                                echo " <span class='spanAlertchamp'> ";
                                                echo  $icon . $err_motdepasse ;
                                                echo "</span> <br>";
                                            } 
                                            ?>

                                            <div class="row">
                                                <object class="mt-2 iconGradient" data="assets/img/icon/lock.svg" type="image/svg+xml"></object>
                                                <label for="motdepasseverif">Confirmez le mot de passe</label>

                                            </div>
                                            <input type="password" class=" mb-1 text-center form-control rounded-pill border-0 shadow-sm px-4" id="motdepasseverif" name ="motdepasseverif" placeholder="Tapez à nouveau votre mot de passe" value="<?php if(isset($motdepasseverif)){echo $motdepasseverif;}?>">

                                            <?php

                                            if(isset($err_motdepasseverif)){
                                                echo "<span class=' spanAlertchamp'> ";
                                                echo  $icon . $err_motdepasseverif ;
                                                echo "</span> ";
                                            } 
                                            ?>


                                        </div>


                                        <div class="form-group">
                                            <!--VILLE-->
                                            <div class="row">
                                                <object class="iconGradient" data="assets/img/icon/map.svg" type="image/svg+xml"></object>
                                                <label for="ville"> Ville </label>
                                            </div>

                                            <input type="text" class="mb-1 text-center form-control rounded-pill border-0 shadow-sm px-4" id="ville" name="ville" placeholder="Où habitez-vous ?"  value="<?php if(isset($ville)){echo $ville;}?>" autofocus>
                                            <?php
                                            if(isset($err_ville)){
                                                echo "<span class='spanAlertchamp'> ";
                                                echo $icon . $err_ville ;
                                                echo "</span> <br>";
                                            } 
                                            ?>
                                            <!--PAYS-->
                                            <div class="row">
                                                <object class="iconGradient" data="assets/img/icon/compass.svg" type="image/svg+xml"></object>
                                                <label for="pays">Votre Pays</label>
                                            </div>
                                            <select id='pays' name="pays" class="form-control rounded-pill border-0 shadow-sm px-4 dropdown-toggle">
                                                <?php
                                                if(isset($pays)){
                                                    $req = $BDD->prepare("SELECT code,nom_fr_fr
                            FROM pays 
                            WHERE code = ?
                            ");
                                                    $req->execute(array($pays));
                                                    $voir_pays = $req->fetch();
                                                ?>
                                                <option value="<?= $voir_pays['code'] ?>"> <?= mb_strtoupper($voir_pays['nom_fr_fr']) ?> </option>



                                                <?php
                                                } else { ?>
                                                <option value="-1"> Selectionner votre pays </option>

                                                <?php  
                                                }

                                                $req = $BDD->prepare("SELECT code,nom_fr_fr  
                            FROM pays 
                             ORDER BY pays.nom_fr_fr ASC");
                                                $req->execute();
                                                $voir_pays = $req->fetchAll();

                                                foreach($voir_pays as $vp) {
                                                ?>     
                                                <option value="<?= $vp['code'] ?>"> <?= mb_strtoupper($vp['nom_fr_fr']) ?> </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <?php
                                            if(isset($err_pays)){
                                                echo "<span class='spanAlertchamp'> ";
                                                echo $icon . $err_pays ;
                                                echo "</span> <br>";
                                            } 
                                            ?>


                                        </div>



                                        <div class="custom-control custom-checkbox mb-4">
                                            <input name="checkmala" id="customCheck1" type="checkbox" class="custom-control-input">
                                            <label for="customCheck1" class="custom-control-label">J'ai lu et j'accepte les <a href="">conditions d'utilisation</a> et la <a href="">politique de confidentialité</a></label>
                                            <?php
                                            if(isset($err_checkmala)){
                                                echo "<span class='spanAlertchamp'> ";
                                                echo $icon . $err_checkmala ;
                                                echo "</span> <br>";
                                            } 
                                            ?>
                                        </div>

                                        <div class="buttons">
                                            <button type="submit" class="btn btn-primary btn-block mt-3 boutonstyle2ouf  rounded-pill shadow-sm" name="inscription">C'est parti</button>
                                        </div>
                                    </form>
                                    <p class="text-muted mb-4">Avez-vous déjà un compte ? <a href="connexion.php">Connectez-vous</a></p>
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