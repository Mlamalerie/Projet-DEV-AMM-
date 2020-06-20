<?php
session_start();
$_SESSION['ici_index_bool'] = false;
include('assets/db/connexiondb.php'); 




$okconnectey = false;
$okconnecteyadmin = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    $okconnectey = true;
    if(0 == $_SESSION['user_role'])  {
        $okconnecteyadmin = true;
    }

} else {
    header('Location: connexion.php');
    exit;
}

if(!isset($_GET['id']) ) {
     header('HTTP/1.0 404 Not Found');
    exit;
}

$baseid = (int) $_GET['id'];/*récupère id du beat qu'on a cliqué*/




$req = $BDD->prepare("SELECT * 
    FROM beat 
    WHERE beat_id = ?");

$req->execute(array($baseid));
$afficher_beat = $req->fetch();

//** verif beat_id
if(isset($afficher_beat['beat_title']) ) { // la prod existe

    if( !(($afficher_beat['beat_author_id'] == $_SESSION['user_id']) || $okconnecteyadmin)  ) { // 

        if(!$okconnecteyadmin){
            header('HTTP/1.1 403 Forbidden');
            exit;
        }
        header('HTTP/1.0 404 Not Found');
        exit;
    } 

} else {
    header('HTTP/1.0 404 Not Found');
    exit;
}


$basetitle = $afficher_beat['beat_title'];
$basedescription = $afficher_beat['beat_description'];
$baseprice = $afficher_beat['beat_price'];
$basegenre = $afficher_beat['beat_genre'];
$baseyear = $afficher_beat['beat_year'];
$basecover = $afficher_beat['beat_cover'];
$basetags = $afficher_beat['beat_tags'];




$reqG = $BDD->prepare("SELECT genre_nom,id FROM genre  ORDER BY genre_nom ASC");
$reqG->execute(array());
$listeGenres = $reqG->fetchAll();


$icon = "<i class='fas fa-exclamation-circle mr-1'></i>";

if (!empty($_POST) && isset($_POST)) {

    extract($_POST); // si pas vide alors extraire le tableau, grace a ça on pourra directemet mettre le nom de la varilable en dur

    $ok = true;

    if(isset($_POST['Modifier-mon-instru']) ){
        echo " *_";
        $b_title = (String) trim($b_title);
        $b_description = (String) trim($b_description);
        $b_tags = (String) trim($b_tags);
        $b_genre = (int) $b_genre;
        $b_year = (int) $b_year;
        $b_price = (float) round($b_price,2);

        $oktitlenotsame = false;
        if($basetitle != $b_title){
            $oktitlenotsame =  true;
            if(empty($b_title)) {
                $ok = false; 
                $err_b_title = "Veuillez renseigner ce champ !"; 

            } 
        }

        $okdescriptionnotsame = false;
        if($basedescription != $b_description){
            $okdescriptionnotsame =  true;
            if(empty($b_description)) {
                $ok = false;
                $err_b_description = "Veuillez renseigner ce champ !"; 
            } 
        }

        $oktagsnotsame = false;
        if($basetags != $b_tags){
            $oktagsnotsame =  true;
            //*** Verification du Tag
            if(empty($b_tags)) {
                $ok = false;
                $err_b_tags = "Veuillez renseigner ce champ !"; 
            } 
        }

        $okgenrenotsame = false;
        if($basegenre != $b_genre){
            $okgenrenotsame =  true;
            //*** Verification du Genre
            $req = $BDD->prepare("SELECT genre_nom 
                            FROM genre
                            WHERE id = ?");
            $req->execute(array($b_genre));
            $verif_g = $req->fetch();

            if(empty($b_genre)) {
                $ok = false;
                $err_b_genre = "Veuillez renseigner ce champ !"; 

            } else if($b_genre == -1){
                echo "$$";
                $ok = false;
                $err_b_genre = "oh !";
            }
            else if(!isset($verif_g['genre_nom'])){ // si 
                $ok = false;
                $err_b_genre = "Veuillez renseigner ce champ !";
            }
        }

        $okyearnotsame = false;
        if($baseyear != $b_year){
            $okyearnotsame =  true;
            //*** Verification du Année
            if(empty($b_year)) {
                $ok = false;
                $err_b_year = "Veuillez renseigner ce champ !";  

            }
        }
        $okpricenotsame = false;
        if($baseprice != $b_price){
            $okpricenotsame =  true;
            //*** Verification du Prix
            if(isset($_POST['freebay'])) {
                $b_price = 0.00;
            } else if(empty($b_price)) {
                $ok = false;
                $err_b_price = "Veuillez renseigner ce champ !"; 
            } else if( $b_price < 0 || 5000 < $b_price) {
                $ok = false;
                $err_b_price = "Veuillez saisir un prix entre 1 et 5000 !"; 
            }
        }


        if($ok) {

            echo "<script> alert('OKKKK') </script>";

            // preparer requete insertion
            $req = $BDD->prepare("UPDATE beat SET beat_title = ?, beat_genre = ?, beat_description = ?, beat_year = ?, beat_price = ?, beat_tags = ? WHERE beat_id = ?"); 

            $req->execute(array($b_title,$b_genre,$b_description,$b_year,$b_price,$b_tags,$baseid));

            if($oktitlenotsame) {$basetitle = $b_title;}
            if($okgenrenotsame) {$basegenre = $b_genre;}
            if($okdescriptionnotsame) {$basedescription = $b_description;}
            if($okyearnotsame) {$baseyear = $b_year;}
            if($okpricenotsame) {$baseprice = $b_price;}
            if($oktagsnotsame) {$basetags = $b_tags;}


        } else {
            echo "not ok";
        }

    }

}

//**** Supprimer
if(isset($_POST['inputOption'])) {
    $id_beat=$_POST['inputOption_beat_id'];
    $ok = true;
    if($_POST['inputOption']== "suppr"){
        if($ok){

            // supprimer le fichier du dossier data
            $req = $BDD->prepare("SELECT beat_source FROM beat
            WHERE beat_id = ?"); 
            $req->execute(array($id_beat));
            $bb = $req->fetch();

            unlink($bb['beat_source']);

            // supprimer de la BDD
            $req = $BDD->prepare("DELETE FROM beat
            WHERE beat_id = ?"); 
            $req->execute(array($id_beat));


            header('Location: my-beats.php');
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
        <script src="https://kit.fontawesome.com/8157870d7a.js" crossorigin="anonymous"></script>
        <!--        <link rel="stylesheet" type="text/css" href="assets/css/styles-index.css"> -->
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">

        <link rel="stylesheet" type="text/css" href="assets/css/edit-beat.css">
        <link rel="stylesheet" type="text/css" href="assets/css/button-style2ouf.css">

        <title>Editer <?= $basetitle ?> • WeBeatz</title>
    </head>
    <body onload="gogoUpload2()">

        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->

        <?php
    require_once('assets/skeleton/navbar.php');
        ?>;

        <br><br><br>

        <section class="mt-4  text-center container">

            <div class="row mt-4">

                <div class="col-12 col-lg-8 bg-back container py-5 text-white rounded">

                    <div class="  mb-5">
                        <div class="d-flex align-items-center justify-content-between mb-3 mr-5 ml-5"> 
                            <span class="grandTitre ml-1 px-2"><strong><span class="text-uppercase">Editer</span> •  <?= $basetitle ?></strong></span>
                            <div>
                                <?php
    $teuda = explode(' ',$afficher_beat['beat_dateupload'])[0];
                                $datedate = explode('-',$teuda);
                                ?>

                                <span class="badge  badge-light mr-1" >Date d'upload : <?= $datedate[2]?>-<?= $datedate[1]?>-<?= $datedate[0]?></span>
                            </div>
                            <div>
                                <button class="btn btn-dark rounded-pill p-2" data-toggle="modal" data-target="#supp_modal" onclick="goInputOption(this,'<?= $afficher_beat['beat_id'] ?>','<?= $afficher_beat['beat_title']?>')" value="suppr"><i class="fas fa-trash-alt text-danger"></i></button>


                                <!-- Modal -->
                                <div class="modal fade" id="supp_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-dark">
                                                Êtes vous sûr de vouloir <span id="phraseConfirm"></span>
                                                <form method="post" id="formOptionConfirm" action="">
                                                    <input type="hidden" name="inputOption" id="inputOption">
                                                    <input type="hidden" name="inputOption_beat_id" id="inputOption_beat_id">
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                                                <button onclick="document.getElementById('formOptionConfirm').submit()" type="button" class="btn btn-primary">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- END Modal -->
                                <script type="text/javascript">
                                    function goInputOption(bay,idd,blaz){
                                        let mode = bay.value;
                                        console.log(mode,idd,blaz);

                                        var p = document.getElementById('phraseConfirm');
                                        var iO = document.getElementById('inputOption');
                                        var iO_id = document.getElementById('inputOption_beat_id');

                                        iO.value = mode;
                                        iO_id.value = idd;

                                        if (mode == 'suppr'){
                                            p.innerHTML = "supprimer le beat " + blaz + " ?";   
                                        }
                                        console.log(iO,iO_id);
                                    } 
                                </script>

                            </div>
                        </div>

                    </div>
                    <form id='formNewUpload' action="" method="post">



                        <!--TITRE-->


                        <?php if(isset($err_b_title)){echo "<span class='spanAlertchamp'> ";echo $icon . $err_b_title ;echo "</span> ";} ?>


                        <!--GENRE & ANN2E --> 
                        <div class="form-group  ml-5 mr-5 ">
                            <div class="d-flex justify-content-between">
                                <div class="text-uppercase"><label for="b_title" class="lesLabels rounded ml-3">Titre <span class="text-danger">*</span></label></div>
                                <div class="text-uppercase"><label for="b_genre" class="lesLabels rounded ml-3"> Genre <span class="text-danger">*</span></label></div>
                                <div class="text-uppercase">  <label for="b_year" class="lesLabels rounded mr-3">Année <span class="text-danger">*</span></label></div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input onkeyup="gogoUpload2()" type="text" class="mb-2 mr-3 text-light border-0 form-control lesInputs rounded-pill shadow-sm px-4" id="b_title" name="b_title" placeholder="Mettez un title pour votre profil"  value="<?= $basetitle ?>" autofocus>

                                <select onchange="gogoUpload2()" name="b_genre" id="b_genre" class="mb-2  text-light  border-0 form-control lesInputs rounded-pill shadow-sm px-4">
                                    <?php $req = $BDD->prepare("SELECT genre_nom FROM genre WHERE id = ? ");
                                       $req->execute(array($basegenre));
                                       $voir_genre = $req->fetch();
                                    ?>
                                    <option value="<?= $basegenre?>"> <?= mb_strtoupper($voir_genre['genre_nom']) ?> </option>


                                    <?php foreach($listeGenres as $gr){ ?>
                                    <option class=" " value="<?=$gr['id']?>"><?= mb_strtoupper($gr['genre_nom'])?></option>
                                    <?php } ?>

                                </select>
                                <input onchange="gogoUpload2()" onkeyup="gogoUpload2()" type="number" min="1900" max="<?= date("Y")+5?>" class="mb-2 ml-3 text-light text-center border-0 form-control lesInputs rounded-pill shadow-sm px-4" id="b_year" name="b_year" placeholder="Mettez un year pour votre profil"  value="<?php if(isset($b_year)){echo $b_year;} else { echo date("Y");} ?>" autofocus>
                            </div>

                        </div>
                        <!--DESCRITION--> 
                        <div class="form-group  ml-5 mr-5">
                            <div class="d-flex justify-content-start ">
                                <div class=" text-uppercase">  <label for="b_description" class="lesLabels rounded ml-3">Description <span class="text-danger">*</span></label></div>
                            </div>
                            <textarea onkeyup="gogoUpload2()" id="b_description" name="b_description" class="mb-2 mr-3 text-light border-0 form-control lesInputs rounded shadow-sm px-4" placeholder="description ici la" value="this.value.trim()"><?= $basedescription?></textarea>
                        </div>
                        <!--TAGS--> 
                        <div class="form-group  ml-5 mr-5">
                            <div class="d-flex justify-content-start ">
                                <div class=" text-uppercase">  <label for="b_tags" class="lesLabels rounded ml-3">TAGS <span class="text-danger">*</span> <small>(4)</small></label></div>
                            </div>
                            <input onkeyup="gogoUpload2()" type="text" class="mb-2 mr-3 text-light border-0 form-control lesInputs rounded-pill shadow-sm px-4" id="b_tags" name="b_tags" placeholder="Mettez un tags pour votre profil"  value="<?= $basetags ?>" >

                        </div>

                        <!--PRICE-->
                        <div class="form-group  ml-5 mr-5 mt-4">
                            <div class="row mx-auto">
                                <div class="d-flex align-items-center justify-content-start ">
                                    <div class=" text-uppercase mr-5">  <label for="b_price" class="lesLabels rounded ml-3">Prix <span class="text-danger">*</span> </label></div>

                                    <!--free-->
                                    <div class="custom-control custom-switch d-flex justify-content-center mb-2">
                                        <input onchange="gogoUpload2()" name="freebay" class="custom-control-input" id="freebay" type="checkbox" <?php if(isset($_POST['freebay']) || (isset($baseprice) && $baseprice == 0.00)){ ?> checked <?php } ?> >
                                        <label class="custom-control-label lesLabels rounded ml-3" for="freebay" title="En cochant ca nanani aniniai">Gratuit</label>

                                    </div>
                                </div>

                                <!--money-->
                                <input  onchange="gogoUpload2()" onkeyup="gogoUpload2()" type="number" step="0.01" min="1" max="5000" class="mb-2 ml-4  text-light border-0 form-control lesInputs rounded-pill shadow-sm px-4" id="b_price" name="b_price" placeholder="Mettez un price pour votre profil"  value="<?php if(isset($baseprice) && $baseprice != 0.00){echo $baseprice;}?>" autofocus>
                            </div>
                        </div>





                        <div class=" ml-5 mr-5 "><div id="iciBtnSubmit" class="w-100 mx-auto "></div></div>
                        <p class="text-muted mt-2">
                            <span id="spanErreurTitle" class="text-danger d-none"> </span>
                            <span id="spanErreurYear" class="text-danger d-none"> </span>
                            <span id="spanErreurGenre" class="text-danger d-none"> </span>
                            <span id="spanErreurDescription" class="text-danger d-none"> </span>
                            <span id="spanErreurTags" class="text-danger d-none"> </span>
                            <span id="spanErreurPrice" class="text-danger d-none"> </span>

                        </p>




                    </form>

                </div>

                <!-- For demo purpose  sm md lg xl -->
                <div class="col-12 col-lg-4  my-5 d-flex align-items-center">
                    <div class="col-lg-8 pb-0 mt-3 text-center mx-auto">
                        <div class="hover text-white rounded d-inline-block align-middle ">
                            <img onclick="getfile();" id="imgdubeat" src="<?=$basecover ?>" alt=""  class="img-fluid  mb-3 shadow-sm">
                        </div>

                        <span onclick="getfile();" class="small text-uppercase text-muted">Cliquer sur l'image pour la changer :)</span>
                        <?php 
    $toutestboncover = false;
                                 require_once 'assets/functions/uploadFile.php';

                                 $upd = new uploadFile();

                                 if(isset($_FILES['fileUploadCover'])) {
                                     if($_FILES['fileUploadCover']['size'] != 0) { 
                                         // FICHIER RECU
                                         //                                var_dump($_FILES['fileUploadCover']);
                                         $tmp_name = $_FILES['fileUploadCover']['tmp_name'];
                                         $name = $_FILES['fileUploadCover']['name'];

                                         $nomduboug = $afficher_beat['beat_author'];
                                         $idduboug = $afficher_beat['beat_author_id'];


                                         $destination = $upd->uploadCoverBeats($tmp_name,$name,$nomduboug,$idduboug,$baseid);
                                         // echo $destination;
                                         if ($destination == "error1") { 
                                             $err_uploadcover = " ERREUR : Ceci n'est pas une image";

                                         }
                                         else if ($destination == "error2") {
                                             $err_uploadcover= "ERREUR : Image non sauvegardée...";

                                         } else {
                                             $toutestboncover = true;

                                             if($basecover != $destination){
                                                 if (file_exists($basecover)) {
                                                     unlink($basecover);
                                                 }

                                             }
                                             // preparer requete
                                             $req = $BDD->prepare("UPDATE beat SET  beat_cover = ? WHERE beat_id = ?"); 

                                             $req->execute(array($destination,$baseid));

                                             $basecover = $destination;



                                         }
                                     } else {
                                         $err_uploadcover = "fichier taille 0";
                                     }
                                 }


                        ?>

                        <form id='formUpload1' action="" method="post" enctype="multipart/form-data">

                            <input id="hiddenfile" type="file" style="display:none;" name='fileUploadCover' onchange="submit()" class="form-control border-0">
                        </form>

                        <?php
                        if(isset($err_uploadcover)){
                            echo "<span class='spanAlertchamp'> ";
                            echo $icon . $err_uploadcover ;
                            echo "</span> ";
                        } 
                        ?>
                        <?php
                        if($toutestboncover){ 
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
            </div>

        </section>


        <section class="mt-4 pb-4 header text-center">



        </section>









        <?php
        require_once('assets/skeleton/endLinkScripts.html');
        ?>
        <script>

            function isAlphanumeric(string)
            {
                for ( var i = 0; i < string.length; i++ )
                {
                    ch = string.charAt(i);

                    if (!(ch >= '0' && ch <= '9') && 	// Numeric (0-9)
                        !(ch >= 'A' && ch <= 'Z') && 		// Upper alpha (A-Z)
                        !(ch >= 'a' && ch <= 'z') && !(ch == " " || ch == "é" || ch == 'è') ) 			// Lower alpha (a-z)
                        return false;
                }
                return true;
            }

            function isNumeric(string)
            {
                for ( var i = 0; i < string.length; i++ )
                {
                    ch = string.charAt(i);

                    if (!(ch >= '0' && ch <= '9')	// Numeric (0-9)
                       ) 			
                        return false;
                }
                return true;
            }

            function gogoUpload2(){
                let icon = "<i class='fas fa-exclamation-circle mr-1'></i>";
                let ok = true;
                //******************************************** ETAPE 1
                let erreurTitle = document.getElementById('spanErreurTitle');
                let title = document.getElementById('b_title');

                //-title
                if(title.value.trim().split(' ').length-1 > 2){ // plus de 1 espace
                    erreurTitle.classList.remove("d-none"); //afficher erreur
                    erreurTitle.innerHTML = icon + "Votre titre doit comporter au plus 2 espace";

                    ok = false;

                }else if (!isAlphanumeric(title.value.trim())){
                    erreurTitle.classList.remove("d-none");  //afficher erreur
                    erreurTitle.innerHTML = icon + "Votre titre doit etes soit lettre soit nombre";
                    ok = false;

                } 
                else if (title.value.trim().length > 20){
                    erreurTitle.classList.remove("d-none");  //afficher erreur
                    erreurTitle.innerHTML = icon + "Titre trop grand";
                    ok = false;
                } else if (title.value.trim().length == 1 ){
                    erreurTitle.classList.remove("d-none");  //afficher erreur
                    erreurTitle.innerHTML = icon + "Titre trop petit";
                    ok = false;
                } 
                else {
                    erreurTitle.classList.add("d-none");
                }

                let genre = document.getElementById('b_genre');
                let erreurGenre = document.getElementById('spanErreurGenre');
                if(genre.value == -1){
                    ok = false;
                }
                //--b_year
                let maxyea = <?= date("Y")+5?> ;
                let erreurYear = document.getElementById('spanErreurYear');
                let year = ( document.getElementById('b_year').value);

                if(isNumeric(year)){
                    year2 = parseInt(year);
                    if (year2 < 1900 || year2 > maxyea) {
                        erreurYear.classList.remove("d-none");
                        erreurYear.innerHTML = icon + "saisir entre 1900 et <?= date("Y")+5?> svp";
                        ok = false;

                    } else {
                        erreurYear.classList.add("d-none");

                    }
                } else {
                    erreurYear.classList.remove("d-none");
                    erreurYear.innerHTML = icon + "Saisir un nombre positif, entre 1900 et <?= date("Y")+5?>";
                    ok = false;

                }

                //- description
                let erreurDescription = document.getElementById('spanErreurDescription');
                let description = document.getElementById('b_description');

                if (description.value.trim().length > 140){
                    erreurDescription.classList.remove("d-none");
                    erreurDescription.innerHTML = icon + "Description trop grande";
                    ok = false;

                }
                else {
                    erreurDescription.classList.add("d-none");

                }


                //--b_tags
                let tags = document.getElementById('b_tags');
                let erreurTags = document.getElementById('spanErreurTags');
                let tagsval = tags.value.trim();
                let tttag =  tagsval.split(',');
                console.log(tttag);
                if (tttag.length-1 > 3)  {

                    erreurTags.classList.remove("d-none");
                    erreurTags.innerHTML = icon + "Vous ne pouvez mettre que 4 tags max";
                    ok = false;


                }else if(tttag.length > 1) {
                    okvirgulebzr = false;
                    for (let i = 0; i < tttag.length; i++ ) {
                        if(tttag[i] == '') {
                            okvirgulebzr = true;
                        }
                    }
                    if(okvirgulebzr){
                        erreurTags.classList.remove("d-none");
                        erreurTags.innerHTML = icon + "Erreur virgule";
                        ok = false;
                    } else {
                        erreurTags.classList.add("d-none");
                    }

                }
                else {
                    erreurTags.classList.add("d-none");

                }



                //--freebay
                let freebay = document.getElementById('freebay');
                let erreurPrice = document.getElementById('spanErreurPrice');
                let price = document.getElementById('b_price').value;

                if(freebay.checked) {
                    document.getElementById('b_price').classList.add('d-none');
                    document.getElementById('b_price').value = null;
                    erreurPrice.classList.add("d-none");
                } else {
                    document.getElementById('b_price').classList.remove('d-none');
                    //--price
                    let price2 = parseFloat(price)
                    console.log(price);

                    if (price2 < 1 || price2 > 5000){
                        erreurPrice.classList.remove("d-none");
                        erreurPrice.innerHTML = icon + "Saisir un prix entre 1 et 5000";
                        ok = false;

                    } else {
                        erreurPrice.classList.add("d-none");
                    }

                }



                let btn = document.getElementById('uconfirm');

                let oktoutrempli = (title.value.trim().length > 0) && (description.value.trim().length > 0) && (tags.value.trim().length > 0) && (genre.value.trim().length > 0) && (document.getElementById('b_year').value.length != 0) && (freebay.checked || (!freebay.checked && price.length > 0 ));
                ok = ok && oktoutrempli;

                // ok = true;
                let divS = document.getElementById('iciBtnSubmit');
                let okyarien = false;
                if(divS.children.length == 0){
                    okyarien = true;
                }

                /***************** Changement ?**************************/
                let okokafficherbouton = false;

                let ctitle = document.getElementById('b_title').value.trim();
                let cdescription = document.getElementById('b_description').value.trim();
                let ctags = document.getElementById('b_tags').value.trim();
                let cgenre = document.getElementById('b_genre').value;
                let cyear = document.getElementById('b_year').value;
                let cprice = document.getElementById('b_price').value;
                if (freebay.checked) {
                    cprice = 0.00;
                }

                let oktitle = ctitle != "<?=$basetitle?>";
                let oktags = ctags != "<?=$basetags?>";
                let okyear = parseInt(cyear) != <?=$baseyear?>;
                let okgenre = parseInt(cgenre) != <?=$basegenre?>;
                let okprice = parseFloat(cprice) != <?=$baseprice?>;
                let okdescription = cdescription != "<?=trim($basedescription)?>";


                okokafficherbouton = oktitle || oktags || okyear || okgenre || okdescription || okprice;  
                console.log(ok,'#',okokafficherbouton,'//',ctitle,oktitle ,ctags, oktags ,cyear, okyear , cgenre, okgenre , cdescription, okdescription,cprice, okprice);

                /***/ 
                ok = ok && okokafficherbouton;
                if (ok) {

                    if(okyarien) {
                        let btn = document.createElement('button');
                        btn.setAttribute('type','submit');
                        btn.setAttribute('id','Modifier-mon-instru');
                        btn.setAttribute('name','Modifier-mon-instru');
                        btn.setAttribute('class','btn btn-primary w-100 btn-block p-2 rounded-pill shadow-sm');
                        btn.innerHTML = "Sauvegarder modifications ";
                        divS.appendChild(btn);
                    }

                }else {
                    if(!okyarien) {
                        let btn = document.getElementById('Modifier-mon-instru');
                        divS.removeChild(btn);
                    }



                }



            }

        </script>



    </body>
</html>
