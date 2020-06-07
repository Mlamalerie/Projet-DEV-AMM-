<?php
session_start();
include_once("assets/db/connexiondb.php");
$_SESSION['ici_index_bool'] = false;
$listeGenres = $_SESSION['listeGenres'];
print_r("$ <br><br><br><br>");
print_r($_SESSION);
print_r($_FILES);print_r($_POST);



$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {

    $okconnectey = true;
} 


require_once 'assets/functions/uploadFile.php';

$icon = " <svg class='mr-1 my-1 bi bi-exclamation-circle' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                            <path fill-rule='evenodd' d='M8 15A7 7 0 108 1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z' clip-rule='evenodd'/>
                                            <path d='M7.002 11a1 1 0 112 0 1 1 0 01-2 0zM7.1 4.995a.905.905 0 111.8 0l-.35 3.507a.552.552 0 01-1.1 0L7.1 4.995z'/>
                                  </svg>";



$temaEtape1 = true;
$temaEtape2 = false;
$temaEtape3 = false;

// UPLOADER
$upd = new uploadFile();
if(isset($_FILES['uploadAudio'])) {
    if($_FILES['uploadAudio']['size'] != 0) { 
        // FICHIER RECU
        var_dump($_FILES['uploadAudio']);
        $tmp_name = $_FILES['uploadAudio']['tmp_name'];
        $name = $_FILES['uploadAudio']['name'];


        $nomduboug = $_SESSION['user_pseudo'];
        $idduboug = $_SESSION['user_id'];

        //            $idbeatx = 1;
        //            $continuecherche = true;
        //            do {
        //                $req = $BDD->prepare("SELECT beat_title
        //                                        FROM beat
        //                                        WHERE beat_id = ? 
        //                                            ");
        //                $req->execute(array($idbeatx));
        //                $b = $req->fetch();
        //
        //                if(!isset($b['user_id'])){
        //                    $continuecherche = false;
        //                    echo "YES";
        //                } else {
        //                    $idbeatx++;
        //                }
        //            } while($continuecherche);

        $destination = $upd->uploadAudio($tmp_name,$name,$nomduboug,$idduboug);


    }
    else {
        $destination = "error0";
    }

    $okaudioposer = true;
    if (substr($destination,0,-1) == "error") { 
        if ($destination[5] == "0") { 
            $err_upload = "Taille 0";
            $okaudioposer = false;

        } else if( $destination[5] == "1") { 
            $err_upload = "ceci n'est pas un audio";
            $okaudioposer = false;

        }else if( $destination[5] == "2") { 
            $err_upload = "erreur inconnu";
            $okaudioposer = false;

        }

    } else {
        $_SESSION['destination'] = $destination;

    }

} 

$dir = "data/".$_SESSION['user_id']."-".$_SESSION['user_pseudo']."/beats/";
$fichier = $dir.basename($_SESSION['user_id']."-beat-x.mp3");


if (!empty($_POST)) {
    echo 'emppy';
    extract($_POST); // si pas vide alors extraire le tableau, grace a ça on pourra directemet mettre le nom de la varilable en dur

    $ok = true;

    if(isset($_POST['b_title']) && isset($_POST['b_price']) ){
        echo " *_";
        $b_title = (String) $b_title;
        $b_description = (String) $b_description;
        $b_tags = (String) $b_tags;
        $b_genre = (String) $b_genre;
        $b_price = (float) $b_price;

        $temaEtape1 = false;
        $temaEtape2 = false;
        $temaEtape3 = false;

        if(isset($_POST['freebay'])) {
            $b_price = 0.00;
        } else {
            if(empty($b_price)) {
                $ok = false;
                $err_b_price = "Veuillez renseigner ce champ !"; $temaEtape3 = true;

            }
        }


        $b_year = (int) $b_year;
        if(empty($b_title)) {
            $ok = false; $err_b_title = "Veuillez renseigner ce champ !"; $temaEtape1 = true;

        } 
        if(empty($b_description)) {$ok = false;$err_b_description = "Veuillez renseigner ce champ !"; $temaEtape1 = true;} 
        if(empty($b_tags)) {$ok = false;$err_b_tags = "Veuillez renseigner ce champ !"; $temaEtape1 = true;

                           } 
        if(empty($b_genre)) {
            $ok = false;
            $err_b_genre = "Veuillez renseigner ce champ !"; $temaEtape2 = true;

        }

        if(empty($b_year)) {
            $ok = false;
            $err_b_year = "Veuillez renseigner ce champ !";  $temaEtape2 = true;

        }

        if($temaEtape1 && $temaEtape2) {
            $temaEtape1 = false;
        }else if($temaEtape1 && $temaEtape3) {
            $temaEtape3 = false;
        }else if($temaEtape2 && $temaEtape3) {
            $temaEtape3 = false;
        }else if($temaEtape1 && $temaEtape2 && $temaEtape3) {
            $temaEtape2 = false;
            $temaEtape3 = false;
        }
        if($ok) {
            echo "€€OOOOK";

            $date_upload = date("Y-m-d H:i:s"); 
            $destination = "data/".$_SESSION['user_id']."-".$_SESSION['user_pseudo']."/beats/".$_SESSION['user_id']."-beat-x.mp3";

            $nn = pathinfo($destination);
            var_dump($nn);
            $ext =  strtolower($nn['extension']);



            // preparer requete
            $req = $BDD->prepare("INSERT INTO beat (beat_title,beat_author,beat_author_id,beat_format,beat_genre,beat_description,beat_year,beat_price,beat_dateupload,beat_tags,beat_source) VALUES (?,?,?,?,?,?,?,?,?,?,?)"); 

            $req->execute(array($b_title,$_SESSION['user_pseudo'],$_SESSION['user_id'],$ext,$b_genre,$b_description,$b_year,$b_price,$date_upload,$b_tags,$destination));
            
            
            $req = $BDD->prepare("SELECT beat_id FROM beat WHERE (beat_title = ? AND beat_author = ? AND beat_author_id = ? AND beat_format = ? AND beat_genre = ? AND beat_description = ? AND beat_year = ? AND beat_price = ? AND beat_dateupload = ? AND beat_tags = ? AND beat_source = ?) "); 

            $req->execute(array($b_title,$_SESSION['user_pseudo'],$_SESSION['user_id'],$ext,$b_genre,$b_description,$b_year,$b_price,$date_upload,$b_tags,$destination));
            $bb = $req->fetch();



           
            echo $fichier;
            if(rename($fichier,$dir.basename($_SESSION['user_id']."-beat-".$bb['beat_id'].".".$ext))) {
                echo 'rennneeaame';
                unset($_SESSION['destination']);
                
                echo "<script> alert('".$fichier."') </script>";
                echo "<script> alert('".$_SESSION['user_id']."-beat-".$bb['beat_id'].".".$ext."') </script>";
            }
            
            
           //  header('Location: view-beat.php?$beat_id='.$bb['beat_id']);
          //  exit;



        } else {
            echo "not";
        }

    }

}



if(isset($err_upload)) {
    echo $err_upload;
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

        <link rel="stylesheet" type="text/css" href="assets/css/edit-newupload.css">

        <title>New upload</title>
    </head>
    <body onload="gogoUpload2()">

        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->

        <?php
        //  require_once('assets/skeleton/navbar.php');
        ?>;
        <?php
        if (isset($err_upload)) { ?>
        <a href=javascript:history.go(-1)>Retournez en arrière</a>

        <?php   }


        else {?>

        <?php if(isset($destination)) {echo $destination;}


        ?>
        <section class="py-5 header">
            <div class="container py-4">



                <div class="row">
                    <div class="col-md-3">
                        <!-- Tabs nav -->
                        <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link mb-3 p-3 shadow <?php if($temaEtape1){ ?>active <?php } ?> " id="u1-tab" data-toggle="pill" href="#u1" role="tab" aria-controls="u1" aria-selected="true">
                                <i class="fa fa-user-circle-o mr-2"></i>
                                <span class="font-weight-bold small text-uppercase">1 : TITRE &amp; DESCRIPTION </span>
                            </a>

                            <a class="nav-link mb-3 p-3 shadow <?php if($temaEtape2){ ?>active <?php } ?>" id="u2-tab" data-toggle="pill" href="#u2" role="tab" aria-controls="u2" aria-selected="false">
                                <i class="fa fa-calendar-minus-o mr-2"></i>
                                <span class="font-weight-bold small text-uppercase">2 : INFO INDISPENSABLE </span>
                            </a>

                            <a class="nav-link mb-3 p-3 shadow <?php if($temaEtape3){ ?>active <?php } ?>" id="u3-tab" data-toggle="pill" href="#u3" role="tab" aria-controls="u3" aria-selected="false">
                                <i class="fa fa-star mr-2"></i>
                                <span class="font-weight-bold small text-uppercase">3 : PRIX</span>
                            </a>


                            <button onclick="document.getElementById('formNewUpload').submit()" name="submit_newupload"  class="btn mb-3 p-3 " id="uconfirm">
                                <i class="fa fa-check mr-2 text-primary"></i>
                                <span class="font-weight-bold small text-uppercase">Confirmer et uploader</span>
                            </button>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <!-- Tabs content -->
                        <form id='formNewUpload' action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="destinationbay" id="destinationbay" value="<?php if(isset($destination)){ echo $destination;} ?>">
                            <div class="tab-content" id="u-tabContent">




                                <!--  **TITRE ET DESCRIPTION -->
                                <div class="tab-pane fade shadow rounded bg-white <?php if($temaEtape1){ ?> show active <?php } ?> p-5" id="u1" role="tabpanel" aria-labelledby="u1-tab">
                                    <h4 class="font-italic mb-4">Personal information</h4>

                                    <div class="row">

                                        <label for="b_title"> title </label>
                                    </div>

                                    <input onkeyup="gogoUpload2()" type="text" class="mb-2 text-center form-control rounded-pill shadow-sm px-4" id="b_title" name="b_title" placeholder="Mettez un title pour votre profil"  value="<?php if (isset($b_title)) {echo $b_title;} ?>" autofocus>

                                    <?php
              if(isset($err_b_title)){
                  echo "<span class='spanAlertchamp'> ";
                  echo $icon . $err_b_title ;
                  echo "</span> ";
              } 
                                    ?>




                                    <!--DESCRITION-->
                                    <textarea onkeyup="gogoUpload2()" id="b_description" name="b_description" class="mb-2 form-control shadow-sm d-none" placeholder="description ici la" value="this.value.trim()"><?php if (isset($b_description)) {echo $b_description;} ?></textarea>
                                    <?php
              if(isset($err_b_description)){
                  echo "<span class='spanAlertchamp'> ";
                  echo $icon . $err_b_description ;
                  echo "</span> ";
              } 
                                    ?>

                                    <!--TAGS-->
                                    <input onkeyup="gogoUpload2()" type="text" class="mb-2 text-center form-control rounded-pill  shadow-sm d-none px-4" id="b_tags" name="b_tags" placeholder="Mettez un tags pour votre profil"  value="<?php if (isset($b_tags)) {echo $b_tags;} ?>" autofocus>

                                    <?php
              if(isset($err_b_tags)){
                  echo "<span class='spanAlertchamp'> ";
                  echo $icon . $err_b_tags ;
                  echo "</span> ";
              } 
                                    ?>


                                    <span id="spanErreurTitle" class="text-danger d-none"> </span>

                                    <span id="spanErreurDescription" class="text-danger d-none"> </span>
                                    <span id="spanErreurTags" class="text-danger d-none"> </span>
                                </div>
                                <!--  ** info +++ -->
                                <div class="tab-pane fade shadow rounded bg-white <?php if($temaEtape2){ ?> show active <?php } ?> p-5" id="u2" role="tabpanel" aria-labelledby="u2-tab">
                                    <h4 class="font-italic mb-4">Bookings</h4>

                                    <!--GENRE-->
                                    <div class="row">

                                        <label for="b_genre"> genre </label>
                                    </div>
                                    <select onchange="gogoUpload2()" name="b_genre" id="b_genre" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4">
                                        <option class=" " value="0">Selectionner Genre</option>
                                        <?php 

              foreach($listeGenres as $gr){
                                        ?>
                                        <option class=" " value="<?=$gr?>"><?= $gr?></option>
                                        <?php
              }
                                        ?>

                                    </select>

                                    <?php
              if(isset($err_b_genre)){
                  echo "<span class='spanAlertchamp'> ";
                  echo $icon . $err_b_genre ;
                  echo "</span> ";
              } 
                                    ?>

                                    <!--ANNEE-->
                                    <input onchange="gogoUpload2()" onkeyup="gogoUpload2()" type="number" min="1900" max="<?= date("Y")+5?>" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4" id="b_year" name="b_year" placeholder="Mettez un year pour votre profil"  value="<?php if(isset($b_year)){echo $b_year;} else { echo date("Y");} ?>" autofocus>
                                    <?php
              if(isset($err_b_year)){
                  echo "<span class='spanAlertchamp'> ";
                  echo $icon . $err_b_year ;
                  echo "</span> ";
              } 
                                    ?>
                                    <span id="spanErreurGenre" class="text-danger d-none"> </span>
                                    <span id="spanErreurYear" class="text-danger d-none"> </span>

                                </div>
                                <!--  ** PRIX -->
                                <div class="tab-pane fade shadow rounded bg-white <?php if($temaEtape3){ ?> show active <?php } ?> p-5" id="u3" role="tabpanel" aria-labelledby="u3-tab">
                                    <h4 class="font-italic mb-4">Reviews</h4>
                                    <!--PRICE-->
                                    <p class="custom-control custom-switch m-0">
                                        <input onchange="gogoUpload2()" name="freebay" class="custom-control-input" id="freebay" type="checkbox" <?php if(isset($_POST['freebay']) || (isset($b_price) && $b_price == 0.00)){ ?> checked <?php } ?> >
                                        <label class="custom-control-label " for="freebay"> FREE BEAT</label>

                                    </p>
                                    <input  onchange="gogoUpload2()" onkeyup="gogoUpload2()" type="number" step="0.01" min="1" max="10000" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4" id="b_price" name="b_price" placeholder="Mettez un price pour votre profil"  value="<?php if(isset($b_price) && !isset($_POST['freebay'])){echo $b_price;}?>" autofocus>

                                    <span id="spanErreurPrice" class="text-danger d-none"> </span>

                                </div>

                            </div>
                        </form>
                    </div>
                    <div  class="col-md-3">
                        <!-- Uploaded image area-->
                        <p class="font-italic text-black text-center">The image uploaded will be rendered inside the box below.</p>
                        <div class="image-area mt-4"><img id="imageResult" src="assets/img/cover_default.jpg" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>

                    </div>

                    <form action="" method="post">

                        <input type="submit" name="annuler_upload" value="Annuler" class="btn btn-primary">
                    </form>


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
                            ok1 = true;
                            //******************************************** ETAPE 1
                            let erreurTitle = document.getElementById('spanErreurTitle');
                            let title = document.getElementById('b_title');

                            let erreurDescription = document.getElementById('spanErreurDescription');
                            let description = document.getElementById('b_description');
                            let tags = document.getElementById('b_tags');


                            if(title.value.trim().split(' ').length-1 > 2){ // plus de 1 espace
                                erreurTitle.classList.remove("d-none"); //afficher erreur
                                erreurTitle.innerHTML = "Votre titre doit comporter au plus 1 espace";

                                ok1 = false;

                            }else if (!isAlphanumeric(title.value.trim())){
                                erreurTitle.classList.remove("d-none");  //afficher erreur
                                erreurTitle.innerHTML = "Votre titre doit etes soit lettre soit nombre";
                                ok1 = false;

                            } 
                            else if (title.value.trim().length > 20){
                                erreurTitle.classList.remove("d-none");  //afficher erreur
                                erreurTitle.innerHTML = "Titre trop grand";
                                ok1 = false;
                            } 
                            else {
                                erreurTitle.classList.add("d-none");



                            }

                            //- description
                            if (erreurTitle.classList.contains("d-none") && title.value.trim().length != 0) {
                                description.classList.remove('d-none');
                                console.log(description.value.trim().length);
                                if (description.value.trim().length > 140){
                                    erreurDescription.classList.remove("d-none");
                                    erreurDescription.innerHTML = "Description trop grande";
                                    ok1 = false;

                                }
                                else {
                                    erreurDescription.classList.add("d-none");

                                }

                                if (erreurDescription.classList.contains("d-none") && description.value.trim().length != 0) {
                                    tags.classList.remove('d-none');
                                    //--b_tags
                                    let erreurTags = document.getElementById('spanErreurTags');
                                    let tagsval = tags.value.trim();
                                    let tttag =  tagsval.split(',');
                                    console.log(tttag);
                                    if (tttag.length-1 > 4)  {

                                        erreurTags.classList.remove("d-none");
                                        erreurTags.innerHTML = "Vous ne pouvez mettre que 5 tags max";
                                        ok1 = false;


                                    }else if(tttag.length > 1) {
                                        okvirgulebzr = false;
                                        for (let i = 0; i < tttag.length; i++ ) {
                                            if(tttag[i] == '') {
                                                okvirgulebzr = true;
                                            }
                                        }
                                        if(okvirgulebzr){
                                            erreurTags.classList.remove("d-none");
                                            erreurTags.innerHTML = "Erreur virgule";
                                            ok1 = false;
                                        } else {
                                            erreurTags.classList.add("d-none");
                                        }

                                    }

                                    else {
                                        erreurTags.classList.add("d-none");

                                    }


                                }else {
                                    tags.classList.add('d-none');

                                }



                            } else {
                                description.classList.add('d-none');

                            }
                            // end etape1
                            //******************************************** ETAPE 2
                            ok2 = true;
                            let genre = document.getElementById('b_genre');
                            let erreurGenre = document.getElementById('spanErreurGenre');
                            //--b_year
                            let maxyea = <?= date("Y")+5?> ;
                            let erreurYear = document.getElementById('spanErreurYear');
                            let year = ( document.getElementById('b_year').value);

                            if(isNumeric(year)){
                                year2 = parseInt(year);
                                if (year2 < 1900 || year2 > maxyea) {
                                    erreurYear.classList.remove("d-none");
                                    erreurYear.innerHTML = "saisir entre 1900 et 2025 svp";

                                } else {
                                    erreurYear.classList.add("d-none");

                                }
                            } else {
                                erreurYear.classList.remove("d-none");
                                erreurYear.innerHTML = "saisir un chiffre svp";

                            }
                            if (!(erreurYear.classList.contains("d-none") && erreurGenre.classList.contains("d-none"))) {
                                ok2 = false;

                            }


                            ok3 = true;
                            //--freebay
                            let freebay = document.getElementById('freebay');
                            let erreurPrice = document.getElementById('spanErreurPrice');
                            let price = document.getElementById('b_price').value;
                            if(freebay.checked) {
                                document.getElementById('b_price').classList.add('d-none');
                                erreurPrice.classList.add("d-none");
                            } else {
                                document.getElementById('b_price').classList.remove('d-none');
                                //--price
                                let price2 = parseFloat(price)
                                console.log(price);

                                if (price2 < 1 || price2 > 10000){
                                    erreurPrice.classList.remove("d-none");
                                    erreurPrice.innerHTML = "Saisir un prix entre 1 et 10000";

                                } else {
                                    erreurPrice.classList.add("d-none");
                                }

                            }

                            if(!(erreurPrice.classList.contains("d-none"))) {
                                ok3 = false;
                            }

                            ok1 = ok1 && (title.value.trim().length > 0) && (description.value.trim().length > 0) && (tags.value.trim().length > 0);
                            ok2 = ok2 && (genre.value.trim().length > 0) && (document.getElementById('b_year').value.length != 0);
                            ok3 = ok3;



                            let btn = document.getElementById('uconfirm');
                            ok = ok1 && ok2 && ok3 ;
                            if (ok) {
                                btn.classList.remove('d-none');

                            }else {
                                btn.classList.add('d-none');

                            }

                            console.log("ok1",ok1,"ok2",ok2,"ok3",ok3);

                        }

                    </script>
                </div>
            </div>
        </section>


        <?php
                                      

                                       
             }
        ?>







        <?php
        require_once('assets/skeleton/endLinkScripts.php');
        ?>
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#imageResult')
                            .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(function () {
                $('#uploadCover').on('change', function () {
                    readURL(input);
                });
            });


            // SHOW UPLOADED IMAGE NAME

            var input = document.getElementById( 'uploadCover' );
            var infoArea = document.getElementById( 'uploadCover-label' );

            input.addEventListener( 'change', showFileName );
            function showFileName( event ) {
                var input = event.srcElement;
                var fileName = input.files[0].name;
                infoArea.textContent = 'File name: ' + fileName;
            }

        </script>


    </body>
</html>
