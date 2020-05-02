<?php
include_once("db/connexiondb.php"); // inclure le fichier pour se connecter à la base de donnée
include_once("fichierfct.php");

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

            header('Location: index.php');
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
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="css/inscription.css">
        <title>Inscription</title>
    </head>
    <body>
        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->

        <?php
        require_once('skeleton/menu.php');

        ?>

        <h1>Inscription</h1>
        <!--   *************************************************************  -->
        <!--   ************************** Form  **************************  -->
        <form method="post">

            <!--PSEUDO-->
            <div class="form-group">
                <?php
                if(isset($err_pseudo)){
                    echo $err_pseudo;
                } 
                ?>
                <label for="pseudo">Votre Pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Mettez un pseudo pour votre profil" value="<?php if(isset($pseudo)){echo $pseudo;}?>">
            </div>
            <!--EMAIL-->
            <div class="form-group">
                <?php

                if(isset($err_email)){
                    echo $err_email;
                } 
                ?>
                <label for="email">Votre Adresse Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Tapez votre e-mail" value="<?php if(isset($email)){echo $email;}?>">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <!--MOT DE PASSE-->
            <div class="form-group">
                <?php

                if(isset($err_motdepasse)){
                    echo $err_motdepasse;
                } 
                ?>
                <label for="motdepasse">Mot de passe</label>
                <input type="password" class="form-control" id="motdepasse" name ="motdepasse" placeholder="Tapez votre mot de passe">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <!--DATE DE NAISSANCE-->
            <div class="form-group">
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
                <select name="naiss_jour">
                    <?php

                    listannee(1,31);
                    ?>
                </select>
                <select name="naiss_mois">
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
                <select name="naiss_annees">
                    <?php
                    listannee(1950,70);
                    ?>
                </select> 
            </div>
            <div class="form-group">
                <select name="pays">
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

            <button type="submit" class="btn btn-primary" name="inscription">Submit</button>
        </form>



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>