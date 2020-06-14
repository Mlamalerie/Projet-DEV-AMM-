<?php
session_start();
$_SESSION['ici_index_bool'] = false;
include('assets/db/connexiondb.php'); 

print_r($_GET);
print_r("<br>");
print_r($_POST);
print_r($_SESSION);

$baseid = (int) $_GET['profil_id'];/*récupère id du profil qu'on a cliqué*/

$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    $okconnectey = true;
} else {
    header('Location: connexion.php');
    exit;
}





$req = $BDD->prepare("SELECT * 
    FROM user 
    WHERE user_id = ?");

$req->execute(array($baseid));
$afficher_profil = $req->fetch();

$basepseudo = $afficher_profil['user_pseudo'];
$baseemail = $afficher_profil['user_email'];
$basemotdepasse = $afficher_profil['user_password'];
$baseville = $afficher_profil['user_ville'];
$basepays = $afficher_profil['user_pays'];

$basenom = $afficher_profil['user_nom'];
$baseprenom = $afficher_profil['user_prenom'];
$basedescription = $afficher_profil['user_description'];

$basesexe = $afficher_profil['user_sexe'];
var_dump($basesexe);
$baserole  = (int) $afficher_profil['user_role'];
$okadmin = false;
if ($baserole == 0){
    $okadmin = true;

}

$basedate_naissance = $afficher_profil['user_datenaissance'];
$baseimage = $afficher_profil['user_image'];



// ta rien a faire ici si c pas toi le boug
if(empty($baseid) ){
    header('Location: edit-profil.php?profil_id='.$_SESSION['user_id']);
    exit;
} else if ( empty($afficher_profil)) {

} else if($_SESSION['user_id'] != $baseid || $_SESSION['user_role'] != 0 ){

    //   header('Location: edit-profil.php?profil_id='.$_SESSION['user_id']);
    // exit;
}

if($baseid != $_SESSION['user_id']  ) {
    if($okadmin && $_SESSION['user_role'] != 0 ){// si le compte à afficher est celui d'un admin et que tu n'es pa admin..
        //   header('Location: edit-profil.php?profil_id='.$_SESSION['user_id']);
        //   exit;
    }
}


$activetabinfoprofil = true;
$activetabemail = false;
$activetabmdp = false;
$activetabinfoperso = false;

$toutestboninfoprofil = false;
$toutestbonemail = false;
$toutestbonmdp = false;
$toutestboninfoperso = false;
$toutestbonimage = false;

$icon = " <i class='fas fa-exclamation-circle mr-2'></i>";

if(!empty($_POST)){

    extract($_POST); // si pas vide alors extraire le tableau, grace a ça on pourra directemet mettre le nom de la varilable en dur
    $ok = true;

    $activetabinfoprofil = false;
    // si le bouton saveprofil a été cliqué
    if (isset($_POST['savechangeinfoprofil'])){
        $activetabinfoprofil = true;

        $okpseudonotsame = false;
        if($pseudo != $basepseudo){
            $okpseudonotsame = true;
            $pseudo = (String) trim($pseudo);
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
                $err_pseudo = "Le pseudo doit contenir au moins une lettre";
            }

            else if (substr_count($pseudo, ' ') >= 3) {

                $ok = false;
                $err_pseudo = "Votre pseudo ne peut contenir plus de 2 espaces";
            }
            else if (!ctype_alnum(implode("",explode(' ',$pseudo)))) {

                $ok = false;
                $err_pseudo = "Votre pseudo ne doit contenir que des lettres ou des chiffres";
            }
            else if (strlen($pseudo) > 25) {

                $ok = false;
                $err_pseudo = "Ce pseudo est trop grand ! Vous avez saisi ".(strlen($pseudo) - 25)." caractère(s) de trop";
            }

            else { // ensuite on verifie si ce pseudo existe déja ou pas
                $req = $BDD->prepare("SELECT user_id,user_pseudo
                            FROM user
                            WHERE user_pseudo = ? 
                                ");
                $req->execute(array($pseudo));
                $user = $req->fetch();

                if(isset($user['user_id'])) {
                    if(strtolower($user['user_pseudo']) != strtolower($basepseudo) ) {
                        $ok = false;
                        $err_pseudo = "Ce pseudo est déjà pris ! Choisissez en un autre. ";
                    }
                }
            }
        }

        $okdescriptionnotsame = false;
        if($description != $basedescription){
            $okdescriptionnotsame = true;
            $description = (String) trim($description);
            if (strlen(implode("",explode(' ',$description))) > 140) {

                $ok = false;
                $err_description = "Trop grand";
            }
        }


        if($ok) {

            if($okpseudonotsame){$oldpseudo = $basepseudo;$basepseudo = $pseudo;}
            if($okdescriptionnotsame){$basedescription = $description;}
            // preparer requete
            $req = $BDD->prepare("UPDATE user
            SET user_pseudo = ? ,user_description = ?
            WHERE user_id = ?"); 

            $req->execute(array($pseudo,$description,$baseid));


            $toutestboninfoprofil = true;

            if($_SESSION['user_id'] == $baseid) {
                $_SESSION['user_pseudo'] = $basepseudo;
            }


        }

    } // End saveinfoprofil

    $activetabemail = false;
    // si le bouton saveemail a été cliqué
    if (isset($_POST['savechangeemail'])){
        $activetabemail = true;
        echo "<br>* ";
        //** Verification du mail 
        $okemailnotsame = false;
        if($email != $baseemail){ // si l'email est different alors la on peut commencer a le tester
            echo "<br>** ";
            $okemailnotsame = true;
            $email = (String) trim($email);
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
                    $err_email = "Cette e-mail existe déjé !";
                }
            }
        }

        if(empty($votremotdepasse4email)) { // si vide
            $ok = false;
            $err_votremotdepasse4email = "Veuillez renseigner ce champ après avoir saisi votre nouvel email !";

        } else if (crypt($votremotdepasse4email, '$6$rounds=5000$grzgirjzgrpzhte95grzegruoRZPrzg8$') != $basemotdepasse) {
            $ok = false;
            $err_votremotdepasse4email = "Vous n'aviez pas bien saisi votre mot de passe ! Veuillez ressaisir un email et votre mot de passe";
        }


        if($ok) {

            if($okemailnotsame){$baseemail = $email;}
            // preparer requete
            $req = $BDD->prepare("UPDATE user
            SET user_email = ?
            WHERE user_id = ?"); 

            $req->execute(array($email,$baseid));


            $toutestbonemail = true;if($_SESSION['user_id'] == $baseid) {
                $_SESSION['user_email'] = $baseemail;}

        }

    } // End savechangemeail

    $activetabmdp = false;
    // si le bouton savemdp a été cliqué
    if (isset($_POST['savechangemdp'])){
        $activetabmdp = true;

        if(empty($ancienmotdepasse)) { // si le champ ancien mot de passe est vide
            $ok = false;
            $err_ancienmotdepasse = "Veuillez renseigner ce champ !";

        } else if (crypt($ancienmotdepasse, '$6$rounds=5000$grzgirjzgrpzhte95grzegruoRZPrzg8$') != $basemotdepasse) {
            $ok = false;
            $err_ancienmotdepasse = "Ce n'est pas votre ancien mot de passe";
        }

        //** Verification du Nouveau mot de passe
        if(crypt($nouveaumotdepasse, '$6$rounds=5000$grzgirjzgrpzhte95grzegruoRZPrzg8$') != $basemotdepasse){
            $oknewmdpnotsame = true;
            $nouveaumotdepasse = (String) trim($nouveaumotdepasse);

            if(empty($nouveaumotdepasse)) { // si le champ mot de passe est vide
                $ok = false;
                $err_nouveaumotdepasse = "Veuillez renseigner ce champ !";

            } else if(strlen($nouveaumotdepasse) < 5) { // si le champ mot de passe est vide
                $ok = false;
                $err_nouveaumotdepasse = "Ce mot de passe est trop petit ! ";

            }
        } else{
            $ok = false;
            $oknewmdpnotsame = false;
            $err_nouveaumotdepasse = "Mot de passe identique !";
            //mettre icon qui change en ampoule

        }

        if($ok) {

            if($oknewmdpnotsame){$basemotdepasse = $nouveaumotdepasse;}

            // preparer requete
            $req = $BDD->prepare("UPDATE user
            SET user_password = ?
            WHERE user_id = ?"); 

            $req->execute(array(crypt($nouveaumotdepasse, '$6$rounds=5000$grzgirjzgrpzhte95grzegruoRZPrzg8$'),$baseid));


            $toutestbonmdp = true;

        }

    } // End savechangemdp

    $activetabinfoperso = false;
    // si le bouton saveprofil a été cliqué
    if (isset($_POST['savechangeinfoperso'])){
        $activetabinfoperso = true;




        if(isset($sexe)) {
            $oksexenotsame = false;
            if($sexe != $basesexe){
                $oksexenotsame = true;

                //*** Verification du sexe
                if (($sexe != 'M') &&  ($sexe != 'F') && ($sexe != "0")) {

                    $ok = false;
                    $err_sexe = "ERREUR";
                }
            }
        } else {
            $oksexenotsame = false;
            $sexe = "0";
        }

        $okprenomnotsame = false;
        if($prenom != $baseprenom){
            $okprenomnotsame = true;
            $prenom = (String) trim($prenom);

            //*** Verification du prenom
            if (strlen($prenom) > 30) {

                $ok = false;
                $err_prenom = "Ce pseudo est trop grand ! Il y a ".(strlen($prenom) - 30)." caractère(s) en trop";
            }else if(!ctype_alpha(implode("",explode(' ',$prenom)))){
                $ok = false;
                $err_prenom = "Juste des lettres !";
            }
        }

        $oknomnotsame = false;
        if($nom != $basenom){
            $oknomnotsame = true;
            $nom = (String) trim($nom);
            //*** Verification du nom
            if (strlen($nom) > 30) {

                $ok = false;
                $err_nom = "Ce nom est trop grand ! Il y a ".(strlen($nom) - 30)." caractère(s) en trop";
            }else if(!ctype_alpha(implode("",explode(' ',$nom)))){
                $ok = false;
                $err_nom = "Juste des letre
                !";

            }
        }
        $okdatenaissancenotsame = false;
        if(empty($datenaissance)) {
            $ok = false;
            echo "ùù";

        }else {
            if($datenaissance != $basedate_naissance) {


                $okdatenaissancenotsame = true;



                //*** Verification du date
                $dateuh = explode('-',$datenaissance);
                print_r($datenaissance);
                print_r($dateuh);

                if (!checkdate($dateuh[1], $dateuh[2], $dateuh[0])) {

                    $ok = false;
                    $err_datenaissance = "Date incorrecte";
                } 


            }  
        }
        $okvillenotsame = false;
        if($ville != $baseville) {
            $okvillenotsame = true;

            //*** Verification du ville
            if(empty($ville)) { // si vide
                $ok = false;
                $err_ville = "Veuillez renseigner ce champ !";

            } else if (strlen($ville) < 3) {

                $ok = false;
                $err_ville = "Ce ville est trop petit !";
            } else if (!ctype_alpha(implode("",explode(' ',$ville)))) {

                $ok = false;
                $err_ville = "Veuilez saisir uniquement des lettres (sans acents)";
            }
        }

        $okpaysnotsame = false;
        if($pays != $basepays) {
            $okpaysnotsame = true;

            //*** Verification du Pays
            $req = $BDD->prepare("SELECT id 
                            FROM pays
                            WHERE code = ?");
            $req->execute(array($pays));
            $verif_pays = $req->fetch();

            if(!isset($verif_pays['id'])){ // si 
                $ok = false;
                $err_pays = "Veuillez renseigner ce champ !";
            }
        }
        //*** Verification du role
        if(isset($roleee)) {

            $role = 2;

        } else {
            $role = 1;

        }

        $okrolenotsame = false;
        if($role != $baserole) {
            $okrolenotsame = true;
        }

        echo $datenaissance;


        if($ok) {

            // preparer requete
            $req = $BDD->prepare("UPDATE user
            SET  user_sexe = ? ,user_prenom = ?, user_nom = ?, user_datenaissance = ?, user_ville = ?, user_pays = ?,user_role = ?
            WHERE user_id = ?"); 

            $req->execute(array($sexe,$prenom,$nom,$datenaissance,$ville,$pays,$role,$baseid));




            if($oknomnotsame) {$basenom = $nom;}
            if($oksexenotsame) {echo $sexe; $basesexe = $sexe;}
            if($okprenomnotsame) {$baseprenom = $prenom;}
            if($okdatenaissancenotsame) {$basedate_naissance = $datenaissance;}
            if($okvillenotsame){$baseville = $ville;}
            if($okpaysnotsame){$basepays = $pays;}
            if($okrolenotsame){$baserole = $role;}

            $toutestboninfoperso = true;if($_SESSION['user_id'] == $baseid) {
                $_SESSION['user_role'] = $baserole;}
//            header('Location: edit-profil.php?profil_id='.$baseid);
//            exit;

        }

    } // End saveinfoperso

} // end post


?>


<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Editer profil</title>
        <?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
        <link rel="stylesheet" type="text/css" href="assets/css/edit-profil.css">

    </head>
    <body>

        <?php
        // require_once('assets/skeleton/navbar.php');
        ?>
        <div class="container py-2">
            <!-- For demo purpose -->
            <div class="row mb-1">
                <div class="col-lg-8 py-3 text-center mx-auto">

                    <img onclick="getfile();" id="imgduboug" src="<?=$baseimage ?>" alt=""  class="img-fluid  mb-3  roundedImage shadow-sm">
                    <h5 class="mb-0 "><?=$basepseudo ?> <?php if($okadmin) { ?> (ADMIN) <?php } ?> </h5>
                    <span class="small text-uppercase text-muted">Cliquer sur l'image pour la changer</span>
                    <?php 

                    require_once 'assets/functions/uploadFile.php';

                    $upd = new uploadFile();

                    if(isset($_FILES['fileUploadImage'])) {
                        if($_FILES['fileUploadImage']['size'] != 0) { 
                            // FICHIER RECU
                            //                                var_dump($_FILES['fileUploadImage']);
                            $tmp_name = $_FILES['fileUploadImage']['tmp_name'];
                            $name = $_FILES['fileUploadImage']['name'];

                            $nomduboug = $basepseudo;
                            $idduboug = $baseid;


                            $destination = $upd->uploadImage($tmp_name,$name,$nomduboug,$idduboug);
                           // echo $destination;
                            if ($destination == "error1") { 
                                $err_uploadimage = " ERREUR : Ceci n'est pas une image";

                            }
                            else if ($destination == "error2") {
                                $err_uploadimage = "ERREUR : Image non sauvegardée...";

                            } else {
                                $toutestbonimage = true;

                                // preparer requete
                                $req = $BDD->prepare("UPDATE user
            SET  user_image = ?
            WHERE user_id = ?"); 

                                $req->execute(array($destination,$baseid));

                                $baseimage = $destination;



                            }
                        } else {
                            $err_uploadimage = "fichier taille 0";
                        }
                    }


                    ?>

                    <form id='formUpload1' action="" method="post" enctype="multipart/form-data">

                        <input id="hiddenfile" type="file" style="display:none;" name='fileUploadImage' onchange="submit()" class="form-control border-0">
                    </form>

                    <?php
                    if(isset($err_uploadimage)){
                        echo "<span class='spanAlertchamp'> ";
                        echo $icon . $err_uploadimage ;
                        echo "</span> ";
                    } 
                    ?>
                    <?php
                    if($toutestbonimage){ 
                    ?>
                    <div class="divDone ml-4 ">
                                <span class="spanDone text-center"> Vos modifications ont bien été enregistrées <i class="fas fa-check-circle mx-1"></i> (Le changement de votre photo ne sera pas visible directement)</span>
                        </div>
                    <?php
                    }
                    ?>
                    <script type="text/javascript">
                        function getfile(){
                            document.getElementById('hiddenfile').click();
                        }

                    </script>





                </div>
            </div>
            <!-- End div du haut-->



            <div class="p-5 bg-back rounded shadow mb-5">
                <!-- TITTRE DES TAB -->
                <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center  border-0 rounded-nav">
                    <li class="nav-item flex-sm-fill">
                        <a id="home-tab" data-toggle="tab" href="#tabinfoprofil" role="tab" aria-controls="tabinfoprofil" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold <?php if($activetabinfoprofil){ ?> active <?php } ?>">Information du profil </a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="profile-tab" data-toggle="tab" href="#tabemail" role="tab" aria-controls="tabemail" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold <?php if($activetabemail){ ?> active <?php } ?>">Email</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="contact-tab" data-toggle="tab" href="#tabmotdepasse" role="tab" aria-controls="tabmotdepasse" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold <?php if($activetabmdp){ ?> active <?php } ?>">Mot de passe </a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="contact-tab" data-toggle="tab" href="#tabinfoperso" role="tab" aria-controls="tabinfoperso" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold <?php if($activetabinfoperso){ ?> active <?php } ?>">Infos personnels</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <!--  TAB INFO DU PROFIL   -->
                    <div id="tabinfoprofil" role="tabpanel" aria-labelledby="info-profil-tab" class="tab-pane fade px-4 py-5 <?php if($activetabinfoprofil){ ?> show active <?php } ?>">

                        <form method="post" class="">
                            <!--PSEUDO-->
                            <div class="form-group mb-4 ml-3 mr-3">

                                <div class="d-flex justify-content-start ">
                                    <div class=" text-uppercase text-center">  <label for="pseudo" class="lesLabels rounded ml-3"><i class="fas fa-user mr-2"></i>Pseudo</label></div>
                                </div>
                                <input onkeyup="goBtnSave(this,1)" type="text" class="mb-2 mr-3 text-light text-center border-0 form-control lesInputs rounded-pill shadow-sm px-4" id="pseudo" name="pseudo" placeholder="Mettez un pseudo pour votre profil"  value="<?=$basepseudo?>" autofocus>
                                <?php
    if(isset($err_pseudo)){
        echo "<span class='spanAlertchamp'> ";
        echo $icon . $err_pseudo ;
        echo "</span> ";
    } 
                                ?>
                            </div>


                            <!--BIO-->
                            <div class="form-group  ml-3 mr-3 ">

                                <div class="d-flex justify-content-start ">
                                    <div class=" text-uppercase text-center">  <label for="description" class="lesLabels rounded ml-3"><i class="fas fa-user mr-2"></i>Description</label></div>
                                </div>

                                <textarea onkeyup="goBtnSave(this,1)" id="description" name="description" class="mb-2 mr-3 text-light border-0 form-control lesInputs rounded shadow-sm px-4" value="<?=$basedescription?>"><?=$basedescription?></textarea>

                                <?php
    if(isset($err_description)){
        echo "<span class='spanAlertchamp'> ";
        echo $icon . $err_description ;
        echo "</span> ";
    } 
                                ?>
                            </div>

                            <input id="btnsave1" type="hidden" class="btn btn-primary btn-block mt-3 boutonstyle2ouf  rounded-pill shadow-sm" name="savechangeinfoprofil" value="Sauvegarder changement">

                            <?php
                            if($toutestboninfoprofil){ 
                            ?>
                            <div class="divDone ml-4 ">
                                <span class="spanDone text-center"> Vos modifications ont bien été enregistrées <i class="fas fa-check-circle ml-1"></i></span>
                                

                                <script>
                                    majmajFolder("<?= $baseid?>");
                                    function majmajFolder(oldold) {
                                        console.log("**malFolder");
                                        var xmlhttp = new XMLHttpRequest();


                                        let ou = "data/majUserBDD.php?id="
                                        ou += oldold;
                                        console.log(ou);
                                        xmlhttp.open("GET",ou,true);
                                        xmlhttp.send();
                                    }
                                </script>
                            </div>
                            <?php
                            }
                            ?>


                        </form>
                    </div>

                    <!--  TAB EMAIL   -->
                    <div id="tabemail" role="tabpanel" aria-labelledby="email-tab" class="tab-pane fade px-4 py-5 <?php if($activetabemail){ ?> show active <?php } ?> ">
                        <form method="post">

                            <div class="form-group ml-3 mr-3 mb-4 ">
                                <div class="d-flex justify-content-start ">
                                    <div class=" text-uppercase text-center">  <label for="email" class="lesLabels rounded ml-3"><i class="fas fa-envelope mr-2"></i>Adresse email</label></div>
                                </div>
                                <input onkeyup="goBtnSave(this,2)" type="email" class="mb-2 mr-3 text-light text-center border-0 form-control lesInputs rounded-pill shadow-sm px-4" id="email" name="email" aria-describedby="emailHelp" placeholder="Tapez votre e-mail" value="<?=$baseemail?>">
                                <?php
    if(isset($err_email)){
        echo "<span class='spanAlertchamp'> ";
        echo $icon . $err_email ;
        echo "</span> ";
    } 
                                ?>


                            </div>
                            <!--VOTRE MOT DE PASSE -->
                            <div class="form-group ml-3 mr-3 mb-4  ">

                                <div class="d-flex justify-content-start ">
                                    <div class=" text-uppercase text-center">  <label for="password" class="lesLabels rounded ml-3"><i class="fas fa-key mr-2"></i>Saisissez votre mot de passe</label></div>
                                </div>
                                <input onkeyup="goBtnSave(this,2)" type="password" class="mb-2 mr-3 text-light text-center border-0 form-control lesInputs rounded-pill shadow-sm px-4" id="votremotdepasse4email" name="votremotdepasse4email" placeholder="" autofocus  disabled>

                                <?php
                                if(isset($err_votremotdepasse4email)){
                                    echo "<span class='spanAlertchamp'> ";
                                    echo $icon . $err_votremotdepasse4email ;
                                    echo "</span> ";
                                } 
                                ?>

                            </div>
                            <input id="btnsave2" type="hidden" class="btn btn-primary btn-block mt-3 boutonstyle2ouf  rounded-pill shadow-sm  " name="savechangeemail" value="Sauvegarder changement">



                        </form>
                        <?php
                        if($toutestbonemail){ 
                        ?>
                         <div class="divDone ml-4 ">
                                <span class="spanDone text-center"> Vos modifications ont bien été enregistrées <i class="fas fa-check-circle ml-1"></i></span>
                        </div>
                        <?php
                        }
                        ?>

                    </div>
                    <!-- TAB MDP   -->
                    <div id="tabmotdepasse" role="tabpanel" aria-labelledby="password-tab" class="tab-pane fade px-4 py-5<?php if($activetabmdp){ ?> show active <?php } ?>">
                        <form method="post">
                            <!--ANCIEN MOT DE PASSE -->
                            <div class="form-group ml-3 mr-3 ml-3 mr-3  mb-4  ">

                                <div class="d-flex justify-content-start ">
                                    <div class=" text-uppercase text-center">  <label for="ancienmotdepasse" class="lesLabels rounded ml-3"><i class="fas fa-key mr-2"></i>Ancien mot de passe</label></div>
                                </div>
                                <input onkeyup="goBtnSave(this,3)" type="password" class="mb-2 mr-3 text-light text-center border-0 form-control lesInputs rounded-pill shadow-sm px-4" id="ancienmotdepasse" name="ancienmotdepasse" placeholder="" autofocus <?php if(isset($_POST['ancienmotdepasse']) && !$toutestbonmdp){ ?> value="<?= $_POST['ancienmotdepasse'] ?>" <?php }?> >

                                <?php
                                if(isset($err_ancienmotdepasse)){
                                    echo "<span class='spanAlertchamp'> ";
                                    echo $icon . $err_ancienmotdepasse ;
                                    echo "</span> ";
                                } 
                                ?>

                            </div>

                            <!-- NOUVEAU MOT DE PASSE -->
                            <div class="form-group ml-3 mr-3 ml-3 mr-3  mb-2  ">

                                <div class="d-flex justify-content-start ">
                                    <div class=" text-uppercase text-center">  <label for="nouveaumotdepasse" class="lesLabels rounded ml-3"><i class="fas fa-key mr-2"></i>Nouveau mot de passe</label></div>
                                </div>
                                <input onkeyup="goBtnSave(this,3)" type="password" class="mb-2 mr-3 text-light text-center border-0 form-control lesInputs rounded-pill shadow-sm px-4" id="nouveaumotdepasse" name="nouveaumotdepasse" placeholder="" autofocus >
                                <?php
                                if(isset($err_nouveaumotdepasse)){
                                    echo "<span class='spanAlertchamp'> ";
                                    echo $icon . $err_nouveaumotdepasse ;
                                    echo "</span> ";
                                } 
                                ?>


                            </div>

                            <input id="btnsave3" type="hidden" class="btn btn-primary btn-block mt-3 boutonstyle2ouf  rounded-pill shadow-sm" name="savechangemdp" value="Sauvegarder changement">


                        </form>

                        <?php
                        if($toutestbonmdp){ 
                        ?>
                         <div class="divDone ml-4 ">
                                <span class="spanDone text-center"> Vos modifications ont bien été enregistrées <i class="fas fa-check-circle ml-1"></i></span>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- TAB INFO PERSO  -->
                    <div id="tabinfoperso" role="tabpanel" aria-labelledby="info-perso-tab" class="tab-pane fade px-4 py-5 <?php if($activetabinfoperso){ ?> show active <?php } ?>">
                        <form method="post" action="">

                            <!-- SEXE -->
                            <div class="custom-control custom-radio mb-2  ">
                                <div class="d-flex align-items-center justify-content-center ">
                                    <div class=" text-center text-uppercase mr-3 ">  <span  class="lesLabels rounded ml-2 px-2"> <i class="fas fa-venus-mars"></i> </span></div>

                                    <div  class="form-check form-check-inline mx-4">
                                        <input name="sexe" onchange="goBtnSave(this,4)" class="custom-control-input form-check-input" type="radio" name="inlineRadioOptions" id="radioHomme" value="M" <?php if(isset($basesexe) && ($basesexe == "M")) { ?> checked <?php } ?>>
                                        <label  class="custom-control-label lesLabels rounded text-center " for="radioHomme">HOMME</label>
                                    </div>
                                    <div class="form-check form-check-inline mx-4">
                                        <input  name="sexe" onchange="goBtnSave(this,4)" class="custom-control-input form-check-input" type="radio" name="inlineRadioOptions" id="radioFemme" value="F" <?php if(isset($basesexe) && ($basesexe == "F")) { ?> checked <?php } ?>>
                                        <label  class="custom-control-label lesLabels rounded text-center " for="radioFemme" >FEMME</label>
                                    </div>
                                </div>

                                <?php
                                if(isset($err_sexe)){
                                    echo "<span class='spanAlertchamp'> ";
                                    echo $icon . $err_sexe ;
                                    echo "</span> ";
                                } 
                                ?>

                            </div>

                            <!--PRENOM-->      <!--NOM-->
                            <div class="form-group mb-3  ml-3 mr-3 ">
                                <div class="d-flex justify-content-between ml-4 mr-4">
                                    <div class=" text-uppercase text-center">  <label for="prenom" class="lesLabels rounded px-2"><i class="fas fa-key mr-2"></i>Prénom</label></div>
                                    <div class=" text-uppercase text-center">  <label for="nom" class="lesLabels rounded  px-2"><i class="fas fa-key mr-2"></i>Nom</label></div>

                                </div>
                                <div class="d-flex justify-content-center">

                                    <input onkeyup="goBtnSave(this,4)" type="text" class="mb-2 mr-2 text-light  text-center border-0 form-control lesInputs rounded-pill shadow-sm px-4" id="prenom" name="prenom" placeholder="Mettez un prenom pour votre profil"  value="<?=$baseprenom?>" autofocus>
                                    <?php
    if(isset($err_prenom)){
        echo "<span class='spanAlertchamp'> ";
        echo $icon . $err_prenom ;
        echo "</span> ";
    } 
                                    ?>

                                    <input onkeyup="goBtnSave(this,4)" type="text" class="mb-2 ml-2 text-light text-center  border-0 form-control lesInputs rounded-pill shadow-sm px-4" id="nom" name="nom" placeholder="Mettez un nom pour votre profil"  value="<?=$basenom?>" autofocus>

                                    <?php
    if(isset($err_nom)){
        echo "<span class='spanAlertchamp'> ";
        echo $icon . $err_nom ;
        echo "</span> ";
    } 
                                    ?>
                                </div>
                            </div>


                            <!--DATE-->
                            <div class="form-group mb-3 ml-3 mr-3  ">

                                <div class="d-flex justify-content-start ">
                                    <div class=" text-uppercase text-center">  <label for="datenaissance" class="lesLabels rounded ml-3"><i class="fas fa-key mr-2"></i>date de naissance</label></div>
                                </div>
                                <input onchange="goBtnSave(this,4)" type="date" class="mb-2 text-light border-0 text-center  form-control lesInputs rounded-pill shadow-sm px-4" id="datenaissance"  name="datenaissance" value="<?= $basedate_naissance ?>" autofocus>
                                <?php
    if(isset($err_datenaissance)){
        echo "<span class='spanAlertchamp'> ";
        echo $icon . $err_datenaissance ;
        echo "</span> ";
    } 
                                ?>

                            </div>
                            <div class="form-group mb-2  ml-3 mr-3 ">
                                <!--VILLE-->  <!--PAYS-->
                                <div class="d-flex justify-content-between ml-4 mr-4">
                                    <div class=" text-uppercase text-center">  <label for="ville" class="lesLabels rounded px-2"><i class="fas fa-key mr-2"></i>ville</label></div>
                                    <div class=" text-uppercase text-center">  <label for="pays" class="lesLabels rounded  px-2"><i class="fas fa-key mr-2"></i>Pays</label></div>

                                </div>
                                <div class="d-flex justify-content-center">


                                    <input onkeyup="goBtnSave(this,4)" type="text" class="mb-2  mr-2 text-light text-center border-0 form-control lesInputs rounded-pill shadow-sm px-4" id="ville" name="ville" placeholder="Ou habiter vous ?"  value="<?=$baseville?>" autofocus>
                                    <?php if(isset($err_ville)){
    echo "<span class='spanAlertchamp'> ";
    echo $icon . $err_ville ;
    echo "</span> ";
} 
                                    ?>


                                    <select onchange="goBtnSave(this,4)" id='pays' name="pays" class="mb-2 ml-2  text-light text-center border-0 form-control lesInputs rounded-pill shadow-sm px-4">
                                        <?php
                                        if(isset($basepays)){
                                            $req = $BDD->prepare("SELECT code,nom_fr_fr
                            FROM pays 
                            WHERE code = ?
                            ");
                                            $req->execute(array($basepays));
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

                                    <?php
                                    if(isset($err_pays)){
                                        echo "<span class='spanAlertchamp'> ";
                                        echo $icon . $err_pays ;
                                        echo "</span> ";
                                    } 
                                    ?>

                                </div>


                            </div>

                            <?php if  (!$okadmin) { ?>  

                            <div class="form-group  mt-4">
                          
                                    <div class="d-flex align-items-center justify-content-center ">
                                        

                                        <!--free-->
                                        <div class="custom-control custom-switch  mb-2">
                                            <input onchange="goBtnSave(this,4)" name="roleee" class="custom-control-input " id="roleee" type="checkbox" <?php if(isset($baserole) && ($baserole == 2)) { ?> checked <?php } ?> >
                                           <label class="custom-control-label lesLabels rounded text-center px-1" for="roleee">Mode Produceur activé <span class="text-danger">*</span></label> 
                                            
                                        </div>
                                     
                                        
                                           <?php
                                                   if(isset($err_sexe)){
                                                       echo "<span class='spanAlertchamp'> ";
                                                       echo $icon . $err_role ;
                                                       echo "</span> ";
                                                   } 
                                ?>
                                    </div>
   <div class="ml-5 mr-5 text-center font-italic"><span class="text-danger">*</span> Désactivez ce mode si vous ne souhaitez pas être visible par les autres membres de WeBeatz.
On ne pourra pas vous trouver à partir de la barre de recherche.</div>
                              
                            </div>

                        



                             
                      
                            <?php } ?>

                            <input id="btnsave4" type="hidden" class="btn btn-primary btn-block mt-3 boutonstyle2ouf  rounded-pill shadow-sm" name="savechangeinfoperso" value="Sauvegarder changement">
                        </form>
                        <?php
                        if($toutestboninfoperso){ 
                        ?>
                         <div class="divDone ml-4 ">
                                <span class="spanDone text-center"> Vos modifications ont bien été enregistrées <i class="fas fa-check-circle ml-1"></i></span>
                        </div>
                    </div>
                    <?php
                        }
                    ?>

                </div>
            </div>
            <!-- End rounded tabs -->


        </div>

        <?php if($_SESSION['user_role'] == 0) { ?> <div><a href="all-utilisateurs.php">Voir tous les utilisateurs.</a></div> <?php } ?>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
        <script>
            $(document).ready(function() {
                $(window).keydown(function(event){
                    if(event.keyCode == 13) {                   
                        event.preventDefault();
                        return false;
                    }
                });
            });
            function goBtnSave(bay,numero){
                $('.spanDone').remove();
                $('.iconDone').remove();
                let btnsave = document.getElementById('btnsave'+numero);
                console.log(btnsave);


                console.log(bay.id);
                let okokafficherbouton = false;
                if (numero == 1) {
                    let cpseudo = document.getElementById('pseudo').value.trim();
                    let cbio = document.getElementById('description').value.trim();
                    let okpseudo = cpseudo != "<?=$basepseudo?>";
                    let okbio = cbio != "<?=trim($basedescription)?>";


                    okokafficherbouton = okpseudo || okbio;  
                    console.log(okokafficherbouton , okpseudo , okbio);


                } 

                if (numero == 2) {
                    let cemail = document.getElementById('email').value.trim();
                    let cmdp = document.getElementById('votremotdepasse4email');

                    let okemail = cemail != "<?=$baseemail?>";



                    okokafficherbouton = okemail;  
                    if (okemail) {
                        cmdp.disabled = false;
                    } else{
                        cmdp.disabled = true;
                    }
                    console.log(okokafficherbouton , okemail,cmdp);

                } 

                if (numero == 3) {
                    let coldmdp = document.getElementById('ancienmotdepasse').value;
                    let cnewmdp = document.getElementById('nouveaumotdepasse').value;
                    let okoldmdp = coldmdp.length > 0; let oknewmdp = cnewmdp.length > 0; 

                    okokafficherbouton = okoldmdp && oknewmdp;  
                    console.log(okokafficherbouton , okoldmdp , oknewmdp);


                } 


                if (numero == 4) {

                    let radioH = document.getElementById('radioHomme');
                    let radioF = document.getElementById('radioFemme');

                    let csexe;
                    if (radioH.checked){
                        csexe = "M";
                    } else if(radioF.checked) {
                        csexe = "F";
                    } 

                    let cnom = document.getElementById('nom').value.trim();
                    let cprenom = document.getElementById('prenom').value.trim();
                    let cdate = document.getElementById('datenaissance').value;
                    let cville = document.getElementById('ville').value.trim();
                    let cpays = document.getElementById('pays').value;
                    let croleee = document.getElementById('roleee').checked;
                    if(croleee) {
                        crole = "2";
                    } else{
                        crole = "1";
                    }


                    let oksexe = csexe != "<?=$basesexe?>";
                    if ("<?=$basesexe?>" == "") {
                        oksexe = false;
                    }
                    let oknom = cnom != "<?=$basenom?>";
                    let okprenom = cprenom != "<?=$baseprenom?>";
                    let okdate = cdate != "<?=$basedate_naissance?>";
                    let okville = cville != "<?=$baseville?>";
                    let okpays = cpays != "<?=$basepays?>";

                    let okrole = crole != "<?=$baserole?>";



                    okokafficherbouton = okrole || oksexe || oknom || okprenom || okdate || okville || okpays ;  
                    console.log(okokafficherbouton ,crole,"<?=$baserole?>",okrole,oksexe , oknom , okprenom ,okdate , okville , okpays);


                } 

                let okerreurphp = "<?=isset($err_pseudo)?>" == 1;

                console.log("okokafficherbouton",okokafficherbouton);
                // apparition disparition du bouton okok=true=apparrition
                if (okokafficherbouton) {btnsave.type = 'submit';} else {btnsave.type = 'hidden';}





            }



        </script>
    </body>
</html>
