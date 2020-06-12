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

if(empty($_FILES)) {

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


            if(isset($bb)) {

                echo $fichier;
                if(rename($fichier,$dir.basename($_SESSION['user_id']."-beat-".$bb['beat_id'].".".$ext))) {
                    echo 'rennneeaame';
                    unset($_SESSION['destination']);
                    header('Location: view-beat.php?beat_id='.$bb['beat_id']);
                    exit;

                    echo "<script> alert('".$fichier."') </script>";
                    echo "<script> alert('".$_SESSION['user_id']."-beat-".$bb['beat_id'].".".$ext."') </script>";
                }




            }else {
                echo'not bb';
            }



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

        <link rel="stylesheet" type="text/css" href="assets/css/edit-upload.css">

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
        <section class="mt-5 pb-4 header text-center">

            <div class="bg-dark container py-5 text-white rounded">

                <div class="text-light font-italic"> <br>by
                    <a class="text-light" href="https://bootstrapious.com/">
                        <u>eger</u>
                    </a>
                </div>
                <section id="divInfo" class="py-3">
                    <h1 class="display-4">Bootstrap animated play button</h1>
                    <p class="text-light font-italic mb-1">Using css animation and pseudo elements, create a nice animated play button.</p>
               



                    <div scope="row" class=" border-0 align-middle rounded">
                        <div class="p-0 rounded ">
                           ztrz
                        </div>

                    </div>

                </section>
            </div>




            <!-- Animated button -->
            <span  onclick='goAfficheInfo()' class="animated-btn text-white" href="#"><i class="fa fa-play iconPlay"></i></span>


        </section>

        <div class="container-fluid">
            <div class="row no-gutter">
                <!-- The image half -->
                <div class="overlay-dark col-md-6 d-none d-md-flex bg-image"> 
                    <div class="overlay-content">refrez
                    </div>
                </div>


                <!-- The content half -->
                <div class="col-md-6 ">
                    <div class="login d-flex align-items-center py-5">

                        <!-- Demo content-->
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 col-xl-7 mx-auto">

                                    <form id='formNewUpload' action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="destinationbay" id="destinationbay" value="<?php if(isset($destination)){ echo $destination;} ?>">


                                        <!--TITRE-->
                                        <input onkeyup="gogoUpload2()" type="text" class="mb-2 text-center form-control rounded-pill shadow-sm px-4" id="b_title" name="b_title" placeholder="Mettez un title pour votre profil"  value="<?php if (isset($b_title)) {echo $b_title;} ?>" autofocus>

                                        <?php if(isset($err_b_title)){echo "<span class='spanAlertchamp'> ";echo $icon . $err_b_title ;echo "</span> ";} ?>


                                        <!--DESCRITION-->
                                        <textarea onkeyup="gogoUpload2()" id="b_description" name="b_description" class="mb-2 form-control shadow-sm d-none" placeholder="description ici la" value="this.value.trim()"><?php if (isset($b_description)) {echo $b_description;} ?></textarea>


                                        <!--TAGS-->
                                        <input onkeyup="gogoUpload2()" type="text" class="mb-2 text-center form-control rounded-pill  shadow-sm d-none px-4" id="b_tags" name="b_tags" placeholder="Mettez un tags pour votre profil"  value="<?php if (isset($b_tags)) {echo $b_tags;} ?>" >

                                        <?phpif(isset($err_b_tags)){echo "<span class='spanAlertchamp'> ";echo $icon . $err_b_tags ;echo "</span> ";} ?>
                                        <!--GENRE-->
                                        <div class="row">

                                            <label for="b_genre"> genre </label>
                                        </div>
                                        <select onchange="gogoUpload2()" name="b_genre" id="b_genre" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4">
                                            <option class=" " value="-1">Selectionner Genre</option>
                                            <?php 

              foreach($listeGenres as $gr){
                                            ?>
                                            <option class=" " value="<?=$gr?>"><?= $gr?></option>
                                            <?php
              }
                                            ?>

                                        </select>



                                        <!--ANNEE-->
                                        <input onchange="gogoUpload2()" onkeyup="gogoUpload2()" type="number" min="1900" max="<?= date("Y")+5?>" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4" id="b_year" name="b_year" placeholder="Mettez un year pour votre profil"  value="<?php if(isset($b_year)){echo $b_year;} else { echo date("Y");} ?>" autofocus>


                                        <!--PRICE-->
                                        <p class="custom-control custom-switch m-0">
                                            <input onchange="gogoUpload2()" name="freebay" class="custom-control-input" id="freebay" type="checkbox" <?php if(isset($_POST['freebay']) || (isset($b_price) && $b_price == 0.00)){ ?> checked <?php } ?> >
                                            <label class="custom-control-label " for="freebay"> FREE BEAT</label>

                                        </p>
                                        <input  onchange="gogoUpload2()" onkeyup="gogoUpload2()" type="number" step="0.01" min="1" max="10000" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4" id="b_price" name="b_price" placeholder="Mettez un price pour votre profil"  value="<?php if(isset($b_price) && !isset($_POST['freebay'])){echo $b_price;}?>" autofocus>




                                        <span id="spanErreurPrice" class="text-danger d-none"> </span>

                                        <span id="spanErreurGenre" class="text-danger d-none"> </span>
                                        <span id="spanErreurYear" class="text-danger d-none"> </span>


                                        <span id="spanErreurTitle" class="text-danger d-none"> </span>
                                        <span id="spanErreurDescription" class="text-danger d-none"> </span>
                                        <span id="spanErreurTags" class="text-danger d-none"> </span>



                                    </form>

                                    <p class="text-muted mb-4">Avez-vous déjà un compte ? <a href="connexion.php">Connectez-vous</a></p>
                                </div>
                            </div>
                        </div><!-- End -->

                    </div>
                </div><!-- End -->

            </div>
        </div>



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
