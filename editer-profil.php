<?php
session_start();

include('assets/db/connexiondb.php'); 

print_r($_GET);
print_r("<br>");
print_r($_POST);
// ta rien a faire ici si c pas toi le boug


$baseid = (int) $_GET['profil_id'];/*récupère id du profil qu'on a cliqué*/

$req = $BDD->prepare("SELECT * 
    FROM user 
    WHERE user_id = ?");

$req->execute(array($baseid));
$afficher_profil = $req->fetch();
print_r($afficher_profil['user_pseudo']);
$basepseudo = $afficher_profil['user_pseudo'];
$baseemail = $afficher_profil['user_email'];
$basemotdepasse = $afficher_profil['user_password'];
$baseville = $afficher_profil['user_ville'];
$basepays = $afficher_profil['user_pays'];

$basenom = $afficher_profil['user_nom'];
$baseprenom = $afficher_profil['user_prenom'];
$basedescription = $afficher_profil['user_description'];

$basesexe = $afficher_profil['user_sexe'];
$basedate_naissance = $afficher_profil['user_datenaissance'];
$baseimage = $afficher_profil['user_image'];

$activetabinfoprofil = true;
$activetabemail = false;
$activetabmdp = false;
$activetabinfoperso = false;

$toutestboninfoprofil = false;
$toutestbonemail = false;
$toutestbonmdp = false;
$toutestboninfoperso = false;
if(!empty($_POST)){

    extract($_POST); // si pas vide alors extraire le tableau, grace a ça on pourra directemet mettre le nom de la varilable en dur
    $ok = true;
    $icon = " <svg class='mr-1 my-1 bi bi-exclamation-circle' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                            <path fill-rule='evenodd' d='M8 15A7 7 0 108 1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z' clip-rule='evenodd'/>
                                            <path d='M7.002 11a1 1 0 112 0 1 1 0 01-2 0zM7.1 4.995a.905.905 0 111.8 0l-.35 3.507a.552.552 0 01-1.1 0L7.1 4.995z'/>
                                        </svg>";
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
                $err_pseudo = "Vous êtes obliger de mettre au moins une lettre dans votre pseudo";
            }

            else if (substr_count($pseudo, ' ') >= 3) {

                $ok = false;
                $err_pseudo = "Votre pseudo ne peut contenir au plus 2 espaces";
            }
            else if (!ctype_alnum(implode("",explode(' ',$pseudo)))) {

                $ok = false;
                $err_pseudo = "Votre pseudo ne doit contenir que des lettres ou des chiffres";
            }
            else if (strlen($pseudo) > 25) {

                $ok = false;
                $err_pseudo = "Ce pseudo est trop grand ! Vous avez saisie ".(strlen($pseudo) - 25)." caractère en trop";
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
                    $err_pseudo = "Ce pseudo est déjà pris ! Choisissez en un autre. ";
                }
            }
        }

        $okdescriptionnotsame = false;
        if($description != $basedescription){
            $okdescriptionnotsame = true;
            $description = (String) trim($description);
            if (strlen(implode("",explode(' ',$description))) > 140) {

                $ok = false;
                $err_description = "TRop grand";
            }
        }


        if($ok) {

            if($okpseudonotsame){$basepseudo = $pseudo;}
            if($okdescriptionnotsame){$basedescription = $description;}
            // preparer requete
            $req = $BDD->prepare("UPDATE user
            SET user_pseudo = ? ,user_description = ?
            WHERE user_id = ?"); 

            $req->execute(array($pseudo,$description,$baseid));


            $toutestboninfoprofil = true;


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
            $err_votremotdepasse4email = "Veuillez renseigner ce champ après avoir saisie votre nouvel email !";

        } else if (crypt($votremotdepasse4email, '$6$rounds=5000$grzgirjzgrpzhte95grzegruoRZPrzg8$') != $basemotdepasse) {
            $ok = false;
            $err_votremotdepasse4email = "Vous n'aviez pas bien saisie votre mot de passe ! Resaisissez un email puis le bon mot de passe cette fois ci...";
        }


        if($ok) {

            if($okemailnotsame){$baseemail = $email;}
            // preparer requete
            $req = $BDD->prepare("UPDATE user
            SET user_email = ?
            WHERE user_id = ?"); 

            $req->execute(array($email,$baseid));


            $toutestbonemail = true;

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
            $err_nouveaumotdepasse = "Euh chakal c'est le mmmot de passe";
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

    } // End savechangemeail


}


?>


<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Editer profil</title>
        <?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <link rel="stylesheet" type="text/css" href="assets/css/editer-profil.css">

    </head>
    <body>

        <div class="container py-5">
            <!-- For demo purpose -->
            <div class="row mb-5">
                <div class="col-lg-8 text-white py-4 text-center mx-auto">
                    <h1 class="display-4">Bootstrap 4 tabs</h1>
                    <p class="lead mb-0">Build a few custom styled tab variants using Bootstrap 4.</p>
                    <p class="lead">Snippet by <a href="https://bootstrapious.com/snippets" class="text-white">
                        Bootstrapious</a>
                    </p>
                </div>
            </div>
            <!-- End -->


            <div class="p-5 bg-white rounded shadow mb-5">
                <!-- TITTRE DES TAB -->
                <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
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

                        <form method="post">
                            <!--PSEUDO-->
                            <div class="form-group mb-2  ">

                                <div class="row">
                                    <object class="iconGradient" data="assets/img/icon/user.svg" type="image/svg+xml"></object>
                                    <label for="pseudo"> Pseudo </label>
                                </div>
                                <input onkeyup="goBtnSave(this,1)" type="text" class="mb-2 text-center form-control rounded-pill border-0 shadow-sm px-4" id="pseudo" name="pseudo" placeholder="Mettez un pseudo pour votre profil"  value="<?=$basepseudo?>" autofocus>
                                <?php
    if(isset($err_pseudo)){
        echo "<span class='spanAlertchamp'> ";
        echo $icon . $err_pseudo ;
        echo "</span> ";
    } 
                                ?>
                            </div>

                            <!--BIO-->
                            <div class="form-group mb-2  ">

                                <div class="row">
                                    <object class="iconGradient" data="assets/img/icon/user.svg" type="image/svg+xml"></object>
                                    <label for="description"> Bio </label>
                                </div>
                                <input  onkeyup="goBtnSave(this,1)" type="text" class="mb-2 text-center form-control rounded-pill border-0 shadow-sm px-4" id="description" name="description" placeholder=""  value="<?=$basedescription?>" autofocus>
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
                            <div class="divDone">
                                <span class="spanDone"> Vos modiffication ont bien été enregistrer </span>
                                <object class="iconDone" data="assets/img/icon/done.svg" type="image/svg+xml"></object>
                            </div>
                            <?php
                            }
                            ?>


                        </form>
                    </div>

                    <!--  TAB EMAIL   -->
                    <div id="tabemail" role="tabpanel" aria-labelledby="email-tab" class="tab-pane fade px-4 py-5 <?php if($activetabemail){ ?> show active <?php } ?> ">
                        <form method="post">

                            <div class="form-group mb-4">
                                <div class="row">
                                    <object class="iconGradient" data="assets/img/icon/envelope.svg" type="image/svg+xml"></object>
                                    <label for="email"> Adresse Email</label>
                                </div>
                                <input onkeyup="goBtnSave(this,2)" type="email" class="mb-1 text-center form-control rounded-pill border-0 shadow-sm px-4" id="email" name="email" aria-describedby="emailHelp" placeholder="Tapez votre e-mail" value="<?=$baseemail?>">
                                <?php
    if(isset($err_email)){
        echo "<span class='spanAlertchamp'> ";
        echo $icon . $err_email ;
        echo "</span> ";
    } 
                                ?>


                            </div>
                            <!--VOTRE MOT DE PASSE -->
                            <div class="form-group mb-2  ">

                                <div class="row">
                                    <object class="iconGradient" data="assets/img/icon/user.svg" type="image/svg+xml"></object>
                                    <label for="votremotdepasse4email"> saisir Mot de passe </label>
                                </div>
                                <input onkeyup="goBtnSave(this,2)" type="password" class="mb-2 text-center form-control rounded-pill border-0 shadow-sm px-4" id="votremotdepasse4email" name="votremotdepasse4email" placeholder="" autofocus  disabled>

                                <?php
                                if(isset($err_votremotdepasse4email)){
                                    echo "<span class='spanAlertchamp'> ";
                                    echo $icon . $err_votremotdepasse4email ;
                                    echo "</span> ";
                                } 
                                ?>

                            </div>
                            <input id="btnsave2" type="hidden" class="btn btn-primary btn-block mt-3 boutonstyle2ouf  rounded-pill shadow-sm" name="savechangeemail" value="Sauvegarder changement">



                        </form>
                        <?php
                        if($toutestbonemail){ 
                        ?>
                        <div>
                            <span class="spanDone"> Vos modiffication ont bien été enregistrer </span>
                            <object class="iconDone" data="assets/img/icon/done.svg" type="image/svg+xml"></object>
                        </div>
                        <?php
                        }
                        ?>

                    </div>
                    <!-- TAB MDP   -->
                    <div id="tabmotdepasse" role="tabpanel" aria-labelledby="password-tab" class="tab-pane fade px-4 py-5<?php if($activetabmdp){ ?> show active <?php } ?>">
                        <form method="post">
                            <!--ANCIEN MOT DE PASSE -->
                            <div class="form-group mb-2  ">

                                <div class="row">
                                    <object class="iconGradient" data="assets/img/icon/user.svg" type="image/svg+xml"></object>
                                    <label for="ancienmotdepasse"> Ancien Mot de passe </label>
                                </div>
                                <input onkeyup="goBtnSave(this,3)" type="text" class="mb-2 text-center form-control rounded-pill border-0 shadow-sm px-4" id="ancienmotdepasse" name="ancienmotdepasse" placeholder="" autofocus>

                                <?php
                                if(isset($err_ancienmotdepasse)){
                                    echo "<span class='spanAlertchamp'> ";
                                    echo $icon . $err_ancienmotdepasse ;
                                    echo "</span> ";
                                } 
                                ?>

                            </div>

                            <!-- NOUVEAU MOT DE PASSE -->
                            <div class="form-group mb-2  ">

                                <div class="row">
                                    <object class="iconGradient" data="assets/img/icon/user.svg" type="image/svg+xml"></object>
                                    <label for="nouveaumotdepasse"> nouveau Mot de passe </label>
                                </div>
                                <input onkeyup="goBtnSave(this,3)" type="text" class="mb-2 text-center form-control rounded-pill border-0 shadow-sm px-4" id="nouveaumotdepasse" name="nouveaumotdepasse" placeholder="" autofocus>
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
                        <div>
                            <span class="spanDone"> Vos modiffication ont bien été enregistrer </span>
                            <object class="iconDone" data="assets/img/icon/done.svg" type="image/svg+xml"></object>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- TAB INFO PERSO  -->
                    <div id="tabinfoperso" role="tabpanel" aria-labelledby="info-perso-tab" class="tab-pane fade px-4 py-5 <?php if($activetabinfoperso){ ?> show active <?php } ?>">
                        <form method="post">
                            <!-- SEXE -->
                            <div class="custom-control custom-radio mb-3 ">
                                <div  class="form-check form-check-inline">
                                    <input onchange="goBtnSave(this,4)" class="custom-control-input form-check-input" type="radio" name="inlineRadioOptions" id="radioHomme" value="M" <?php if(isset($basesexe) && ($basesexe == "M")) { ?> checked <?php } ?>>
                                    <label  class="custom-control-label form-check-label" for="radioHomme">HOMME</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input onchange="goBtnSave(this,4)" class="custom-control-input form-check-input" type="radio" name="inlineRadioOptions" id="radioFemme" value="F">
                                    <label  class="custom-control-label form-check-label" for="radioFemme" <?php if(isset($basesexe) && ($basesexe == "F")) { ?> checked <?php } ?>>FEMME</label>
                                </div>

                            </div>

                            <!--PRENOM-->
                            <div class="form-group mb-2  ">

                                <div class="row">
                                    <object class="iconGradient" data="assets/img/icon/user.svg" type="image/svg+xml"></object>
                                    <label for="prenom"> Prenom </label>
                                </div>
                                <input onkeyup="goBtnSave(this,4)" type="text" class="mb-2 text-center form-control rounded-pill border-0 shadow-sm px-4" id="prenom" name="prenom" placeholder="Mettez un prenom pour votre profil"  value="<?=$baseprenom?>" autofocus>

                            </div>
                            <!--NOM-->
                            <div class="form-group mb-2  ">

                                <div class="row">
                                    <object class="iconGradient" data="assets/img/icon/user.svg" type="image/svg+xml"></object>
                                    <label for="nom"> NOM </label>
                                </div>
                                <input onkeyup="goBtnSave(this,4)" type="text" class="mb-2 text-center form-control rounded-pill border-0 shadow-sm px-4" id="nom" name="nom" placeholder="Mettez un nom pour votre profil"  value="<?=$basenom?>" autofocus>

                            </div>
                            <!--DATE-->
                            <div class="form-group mb-2  ">

                                <div class="row">
                                    <object class="iconGradient" data="assets/img/icon/user.svg" type="image/svg+xml"></object>
                                    <label for="datenaissance"> DATE </label>
                                </div>
                                <input onchange="goBtnSave(this,4)" type="date" class="mb-2 text-center form-control rounded-pill border-0 shadow-sm px-4" id="datenaissance" name="datenaissance" value="<?= $basedate_naissance ?>" autofocus>

                            </div>

                            <!--VILLE-->
                            <div class="row">
                                <object class="iconGradient" data="assets/img/icon/map.svg" type="image/svg+xml"></object>
                                <label for="ville"> Ville </label>
                            </div>

                            <input onkeyup="goBtnSave(this,4)" type="text" class="mb-1 text-center form-control rounded-pill border-0 shadow-sm px-4" id="ville" name="ville" placeholder="Ou habiter vous ?"  value="<?=$baseville?>" autofocus>

                            <!--PAYS-->
                            <div class="row">
                                <object class="iconGradient" data="assets/img/icon/compass.svg" type="image/svg+xml"></object>
                                <label for="pays">Votre Pays</label>
                            </div>
                            <select onchange="goBtnSave(this,4)" id='pays' name="pays" class="form-control rounded-pill border-0 shadow-sm px-4 dropdown-toggle">
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

                            <p class="custom-control custom-switch">
                                <input  name="role" class="custom-control-input" id="role" type="checkbox" checked>
                                <label class="custom-control-label " for="simpleacheteur"> Activer mode artiste </label>
                            </p>

                            <input id="btnsave4" type="hidden" class="btn btn-primary btn-block mt-3 boutonstyle2ouf  rounded-pill shadow-sm" name="savechangeinfoperso" value="Sauvegarder changement">
                        </form>

                    </div>
                </div>
                <!-- End rounded tabs -->
            </div>
        </div>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
        <script>

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
                    } else {
                        csexe = "F";
                    } 

                    let cnom = document.getElementById('nom').value.trim();
                    let cprenom = document.getElementById('prenom').value.trim();
                    let cdate = document.getElementById('datenaissance').value;
                    let cville = document.getElementById('ville').value.trim();
                    let cpays = document.getElementById('pays').value;

                    let oksexe = csexe != "<?=$basesexe?>";
                    if ("<?=$basesexe?>" == "") {
                        oksexe = false;
                    }
                    let oknom = cnom != "<?=$basenom?>";
                    let okprenom = cprenom != "<?=$baseprenom?>";
                    let okdate = cdate != "<?=$basedate_naissance?>";
                    let okville = cville != "<?=$baseville?>";
                    let okpays = cpays != "<?=$basepays?>";




                    okokafficherbouton = oksexe || oknom || okprenom || okdate || okville || okpays ;  
                    console.log(okokafficherbouton ,"<?=$basesexe?>",oksexe , oknom , okprenom ,okdate , okville , okpays);


                } 

                let okerreurphp = "<?=isset($err_pseudo)?>" == 1;

                console.log("okokafficherbouton",okokafficherbouton);
                // apparition disparition du bouton okok=true=apparrition
                if (okokafficherbouton) {btnsave.type = 'submit';} else {btnsave.type = 'hidden';}





            }



        </script>
    </body>
</html>