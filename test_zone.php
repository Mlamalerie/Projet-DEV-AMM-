<?php
session_start();
include_once("assets/db/connexiondb.php"); // inclure le fichier pour se connecter à la base de donnée
$_SESSION['ici_index_bool'] = false;


?>
<?php
$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {

    $okconnectey = true;
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
        <link rel="stylesheet" type="text/css" href="assets/css/test_zone.css">
        <link rel="stylesheet" type="text/css" href="assets/css/MusicPlayerMlamali.css">


        <!--  Slides Link      -->
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>


        <link rel="stylesheet" type="text/css" href="assets/css/button-style2ouf.css">
        <link rel="stylesheet" type="text/css" href="assets/css/modalUploadAudio.css">


        <title>TEST ZONE</title>
    </head>
    <body onload="gogoUpload()">
        <br><br><br><br><br><br><br>

        <?php
        require_once 'assets/functions/uploadFile.php';
        // le svg de l'icon erreur
        $icon = " <svg class='mr-1 my-1 bi bi-exclamation-circle' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                            <path fill-rule='evenodd' d='M8 15A7 7 0 108 1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z' clip-rule='evenodd'/>
                                            <path d='M7.002 11a1 1 0 112 0 1 1 0 01-2 0zM7.1 4.995a.905.905 0 111.8 0l-.35 3.507a.552.552 0 01-1.1 0L7.1 4.995z'/>
                                        </svg>";
        $listeGenres = $_SESSION['listeGenres'];
        print_r($_POST);print_r("<br><br>");
        print_r($_FILES);
        if (isset($_POST['submit_upload']))  {

            extract($_POST);
            $ok = true;

            //*** Saisies :
            $b_title = (String) trim($b_title);
            $b_genre = (String) trim($b_genre);
            $b_description = (String) trim($b_description);
            $b_year = (int) $b_year;
            if(isset($_POST['freebay'])) {
                $b_price = 0.00; echo "popo";
            }
            $b_price = (float) $b_price;

            //*** Verification du b_title
            if(empty($b_title)) { // si vide
                $ok = false;
                $err_b_title = "Veuillez renseigner ce champ !";

            }
            else if (strlen($b_title) > 30) {

                $ok = false;
                $err_b_title = "Ce pseudo est trop grand ! Vous avez ".(strlen($b_title) - 30)." caractère en trop";
            }

            //*** Verification du b_genre
            if(!in_array($b_genre,$listeGenres)){
                $ok = false;
                $err_b_genre = "ce genre n'existe pas!";

            }
            //*** Verification du b_description
            if(empty($b_description)) { // si vide
                $ok = false;
                $err_b_description = "Veuillez renseigner ce champ !";

            }
            //*** Verification du b_year
            if( empty($b_year)) { // si vide
                $ok = false;
                $err_b_year = "Veuillez renseigner ce champ !";

            }
            //*** Verification du b_price
            if(!isset($_POST['freebay']) && empty($b_price)) { // si vide
                $ok = false;
                $err_b_price = "Veuillez renseigner ce champ !";

            }

            //*** Verification du cover

            if(isset($_FILES['uploadAudio']) && $ok) {
                if($_FILES['uploadAudio']['size'] != 0) { 
                    // Le fichier uploadé
                    var_dump($_FILES['uploadAudio']);
                    $tmp_name = $_FILES['uploadAudio']['tmp_name'];
                    $name = $_FILES['uploadAudio']['name'];


                    $nomduboug = $_SESSION['user_pseudo'];
                    $idduboug = $_SESSION['user_id'];

                    // trouver un id pour le nouveau beats
                    $trouverunid = false;
                    $iddubeat = 1;
                    do {
                        $reqxx = $BDD->prepare("SELECT *
                                        FROM beat
                                        WHERE beat_id = ? 
                                            ");
                        $reqxx->execute(array($iddubeat));
                        $bb = $reqxx->fetch();

                        if(!isset($bb['user_id'])){
                            $trouverunidbeat = true;
                        } else {
                            $iddubeat++;
                        }
                    } while($trouverunid == false);
                    echo "idubeat".$iddubeat ;

                    $upd2 = new uploadFile();
                    $destinationCover = $upd2->uploadAudio($tmp_name,$name,$nomduboug,$idduboug,$iddubeat);
                    echo $destinationCover;
                    if ($destinationCover == "error1") { 
                        $err_cover = " ERREUR : Ceci n'est pas un audio";
                        $ok = false;

                    }
                    else if ($destinationCover == "error2") {
                        $err_cover = "ERREUR : Pour des raisons inconnues votre audio n'a pas été uploader";
                        $ok = false;
                        echo  $err_cover ;

                    } 
                } else {
                    $err_cover = "fichier taille 0";
                    $ok = false;
                    echo  $err_cover ;
                }
            } else {
                echo 'fififif';
            }



            if($ok) {
                $b_author = $_SESSION['user_id'];
                // preparer requete
                $req = $BDD->prepare("INSERT INTO beat (beat_id,beat_title,beat_author,beat_genre,beat_description,beat_year,beat_price,beat_dateupload,beat_tags,beat_format,beat_source) VALUES (?,?,?,?,?,?,?,?,?,?,?)"); 
                $req->execute(array($iddubeat,$b_title,$b_author,$b_genre,$b_description,$b_year,$b_price,date("Y-m-d H:i:s"),$b_tags,'mp3',' '));


            } else {
                echo "**not ok**";
            }





            //   $_SESSION['destinationdubayupload'] = $destination; 
            //   header('Location: edit-newupload.php');
            //   exit;

        }

        ?> 

        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->

        <?php
        require_once('assets/skeleton/navbar.php');
        ?>





        Ici c'est l'index des connecté
        <?php
        if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
            print_r($_SESSION);
        } else{
            echo "Pas de connexion";
        }
        ?>



        <form id="searchform" method="get" action="search.php">
            <select name="Genre" class="custom-select">-->
                <option value="All" selected >ALL</option>
                <option value="Trap" >TRAP</option>
                <option value="Afro" >AFRO</option>

            </select>
            <div class="searchbar ">

                <input id='searchbar' class="search_input" type="text" placeholder="Recherchez vos musiques, artistes..." name="q">


                <a onclick="goSearch()" href="#" class="search_icon"><i class="fas fa-search"></i></a>
            </div>
        </form>


        <div class="buttons">
            <button class="boutonstyle2ouf"> Hover Me</button>
            <!--            <button class="boutonstyle2ouf"> Hover Me</button>-->

        </div>





        <?php
        require_once('assets/skeleton/endLinkScripts.php');
        ?>
        <script>

            function goSearch() {
                console.log("*goSearch*");

                var ok = false;
                var champs = document.getElementById('searchbar');
                var baysearch = champs.value.trim();




                ok = (baysearch != "");
                console.log(champs,baysearch,ok);

                if (ok) {

                    document.getElementById("searchform").submit();
                }

            }

        </script>


        <div class="profil_card rounded-circle text-center">
            <img src="img/user.png">
            <span>Pseudo</span>
        </div><br/>



        <!--    SLIDES JS SCRIPT    -->

        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="assets/js/slide.js"></script>



    </body>
</html>
