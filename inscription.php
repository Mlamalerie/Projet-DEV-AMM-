<?php
session_start();
include_once("assets/db/connexiondb.php"); // inclure le fichier pour se connecter à la base de donnée
include_once("fichierfct.php");

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
        $pseudo = (String) trim($pseudo);
        $email = (String) strtolower(trim($email));
        $motdepasse = (String) trim($motdepasse);

        $pays = (int) $pays;

        $naiss_jour = (int) $naiss_jour;
        $naiss_mois = (int) $naiss_mois;
        $naiss_annees = (int) $naiss_annees;

        $date_naissance = (String) null;
        
        $icon = " <svg class='bi bi-exclamation-circle' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                            <path fill-rule='evenodd' d='M8 15A7 7 0 108 1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z' clip-rule='evenodd'/>
                                            <path d='M7.002 11a1 1 0 112 0 1 1 0 01-2 0zM7.1 4.995a.905.905 0 111.8 0l-.35 3.507a.552.552 0 01-1.1 0L7.1 4.995z'/>
                                        </svg>";

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

        // verification date de naissance

        if($naiss_jour < 1 || $naiss_jour > 31) {
            $ok = false;
            $err_naiss_jour = "Veuillez renseigner ce champ !";

        }
        if($naiss_mois < 1 || $naiss_mois > 12){
            $ok = false;
            $err_naiss_mois = "Veuillez renseigner ce champ !";

        }
        $aaa_debut = 1950; $aaa_n = 70;

        if($naiss_annees < 1900 || $naiss_annees > 2020 ){
            $ok = false;
            $err_naiss_annees = "Veuillez renseigner ce champ !";

        }

        if (!checkdate($naiss_jour,$naiss_mois,$naiss_annees)){
            $ok = false;
            $err_date = "Date fausse !";

        }else {
            $date_naissance = $naiss_annees .'-'. $naiss_mois.'-'.$naiss_jour;

        }
        // veri pays 

        $req = $BDD->prepare("SELECT id 
                            FROM pays
                            WHERE code = ?");
        $req->execute(array($pays));
        $verif_pays = $req->fetch();


        if(!isset($verif_pays['id'])){
            $ok = false;
            $err_pays = "Veuillez renseigner ce champ !";
        }

        if($ok) {

            $date_inscription = date("Y-m-d H:i:s"); 
            $motdepasse = crypt($motdepasse, '$6$rounds=5000$grzgirjzgrpzhte95grzegruoRZPrzg8$');


            // preparer requete
            $req = $BDD->prepare("INSERT INTO user (user_pseudo,user_email,user_password,user_datenaissance,user_pays,user_dateinscription,user_dateconnexion) VALUES (?, ?, ?, ?, ?, ?, ?)"); 

            $req->execute(array($pseudo,$email,$motdepasse,$date_naissance,$pays,$date_inscription,$date_inscription));
            
             $_SESSION['user_pseudo'] = $pseudo;

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
        
        <title>Inscription</title>
    </head>
    <body>
        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->

        <?php
        require_once('assets/skeleton/navbar.php');

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
                                    <h3 class="display-4">Inscription</h3>
                                    <p class="text-muted mb-4">Create a login split page using Bootstrap 4.</p>
                                    <form method="post">
                                       
                                        <!--PSEUDO-->
                                        <div class="form-group mb-3 ">
                                            <?php
                                            if(isset($err_pseudo)){
                                                echo "<span class='spanAlertchamp'> ";
                                                echo $icon . $err_pseudo ;
                                                echo "</span> ";
                                            } 
                                            ?>
                                            <label for="pseudo">Votre Pseudo </label>
                                            <input type="text" class="form-control rounded-pill border-0 shadow-sm px-4" id="pseudo" name="pseudo" placeholder="Mettez un pseudo pour votre profil"  value="<?php if(isset($pseudo)){echo $pseudo;}?>" autofocus>
                                        </div>
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
                                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
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

                                        <!--DATE DE NAISSANCE-->
                                        <div id="divNaissance" class="form-group btn-group dropup">
                                            <?php

                                            if(isset($err_naiss_jour)){
                                                echo $err_naiss_jour;
                                            } 
                                            if(isset($err_naiss_mois)){
                                                echo $err_naiss_mois;
                                            }
                                            if(isset($err_naiss_annes)){
                                                echo $err_naiss_annes;
                                            }
                                            if(isset($err_date)){
                                                echo $err_date;
                                            }
                                            ?>
                                            <select name="naiss_jour" class="form-control rounded-pill custom-select ">
                                                <?php

                                                listannee(1,31);
                                                ?>
                                            </select>
                                            <select name="naiss_mois" class="form-control rounded-pill border-0 shadow-sm px-4 dropdown-toggle">
                                                <option value="1">Janvier </option>
                                                <option value="2">Février </option>
                                                <option value="3">Mars </option>
                                                <option value="4">Avril </option>
                                                <option value="5">Mai</option>
                                                <option value="6">Juin </option>
                                                <option value="7">Juillet </option>
                                                <option value="8">Aout </option>
                                                <option value="9">Septembre </option>
                                                <option value="10">Octobre </option>
                                                <option value="11">Novembre </option>
                                                <option value="12">Décembre </option>
                                            </select>
                                            <select name="naiss_annees" class="form-control rounded-pill border-0 shadow-sm px-4 dropdown-toggle">
                                                <?php
                                                listannee(1950,70);
                                                ?>
                                            </select> 
                                        </div>
                                        <!--PAYS-->
                                        <div class="form-group">
                                            <label for="pays">Votre Pays</label>
                                            <select name="pays" class="form-control rounded-pill border-0 shadow-sm px-4 dropdown-toggle">
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

                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block mt-5 rounded-pill shadow-sm" name="inscription">C'est parti</button>
                                    </form>
                                </div>
                            </div>
                        </div><!-- End -->

                    </div>
                </div><!-- End -->

            </div>
        </div>
        <!--   *************************************************************  -->
        <!--   ************************** Form  **************************  -->




        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>