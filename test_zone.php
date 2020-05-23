<?php
session_start();

$_SESSION['ici_index_bool'] = false;
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

        <title>TEST ZONE</title>
    </head>
    <body onload="gogoUpload()">
        <br><br><br><br><br><br><br>

        <?php
        require_once 'assets/functions/uploadFile.php';

        $upd = new uploadFile();
        print_r($upd);
        print_r($_POST);

        if (isset($_POST['submit_upload']))  {

            extract($_POST);

            //*** Saisies :
            $b_title = (String) trim($b_title);
            $b_genre = (String) trim($b_genre);
            $b_description = (String) trim($b_description);
            $b_year = (int) $b_year;
            $b_price = (float) $b_price;
            
            //*** Verification du b_title
            if(empty($b_title)) { // si vide
                $ok = false;
                $err_b_title = "Veuillez renseigner ce champ !";

            }

            else if (substr_count($b_title, ' ') >= 3) {

                $ok = false;
                $err_b_title = "Votre pseudo ne peut contenir au plus 2 espaces";
            }
            else if (strlen($b_title) > 30) {

                $ok = false;
                $err_b_title = "Ce pseudo est trop grand ! Vous avez ".(strlen($b_title) - 30)." caractère en trop";
            }



            if($_FILES['upload']['size'] != 0) {
                // FICHIER RECU
                var_dump($_FILES['upload']);
                $tmp_name = $_FILES['upload']['tmp_name'];
                $name = $_FILES['upload']['name'];

                $nomduboug = $_SESSION['user_pseudo'];
                $idduboug = $_SESSION['user_id'];
                $date = date("Ymd-His");

                $destination = $upd->uploadAudio($tmp_name,$name,$nomduboug,$idduboug,$date);
                echo $destination;
            }


            //   $_SESSION['destinationdubayupload'] = $destination; 
            //   header('Location: edit-newupload.php');
            //   exit;

        }

        ?> 

        <!-- Modal UPLOAD modal fade -->
        <div  class=" " id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="modalUploadTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Uploader</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id='formUpload1' action="" method="post" enctype="multipart/form-data">

                        <div class="modal-body" >

                            <!-- FICHIER -->
                            <input onchange="gogoUpload()" id="upload" name="upload" type="file" class="form-control border-0">
                            <!--TITLE-->
                            <div id="div1" class="form-group mb-2  " style="display : none;">

                                <div class="row">

                                    <label for="b_title"> title </label>
                                </div>

                                <input onkeyup="gogoUpload()" type="text" class="mb-2 text-center form-control rounded-pill shadow-sm px-4" id="b_title" name="b_title" placeholder="Mettez un title pour votre profil"  value="<?php if(isset($b_title)){echo $b_title;}?>" autofocus>
                            </div>


                            <!--GENRE-->
                            <div class="row">

                                <label for="b_genre"> genre </label>
                            </div>
                            <select name="b_genre" id="b_genre" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4">
                                <?php 
                                $listeGenres = $_SESSION['listeGenres'];
                                foreach($listeGenres as $gr){
                                ?>
                                <option class=" " value="<?=$gr?>"><?= $gr?></option>
                                <?php
                                }
                                ?>

                            </select>
                            <!--ANNEE-->
                            <input onkeyup="gogoUpload()" type="number" min="1900" max="<?= date("Y")+5?>" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4" id="b_year" name="b_year" placeholder="Mettez un year pour votre profil"  value="<?php if(isset($b_year)){echo $b_year;}?>" autofocus>

                            <!--DESCRITION-->
                            <textarea onkeyup="gogoUpload()" id="b_description" name="b_description" class="mb-2 form-control shadow-sm" value="this.innerHTML.trim()"></textarea>
                            <!--TAGS-->
                            <input onkeyup="gogoUpload()" type="text" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4" id="b_tags" name="b_tags" placeholder="Mettez un tags pour votre profil"  value="<?php if(isset($b_tags)){echo $b_tags;}?>" autofocus>

                            <!--PRICE-->
                            <input onkeyup="gogoUpload()" type="number" step="0.01" min="1" max="10000" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4" id="b_price" name="b_price" placeholder="Mettez un price pour votre profil"  value="<?php if(isset($b_price)){echo $b_price;}?>" autofocus>



                            <span id="spanErreurUpload1"> </span>




                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit_upload" class="btn btn-primary">Save changes</button>
                        </div>
                        <script>
                            function gogoUpload(){
                                let upload = document.getElementById("upload").value.split('.');
                                let ext = upload[upload.length - 1].toLowerCase();
                                let erreur = document.getElementById('spanErreurUpload1');
                                console.log(upload,ext);


                                formatAudio = ["mp3","wav"];
                                if (formatAudio.indexOf(ext) == -1) {
                                    okaffichediv1 = false;
                                    //  erreur.style = "display: ;";
                                    // erreur.innerHTML = "Ce n'est pas un audio";
                                } else {
                                    okaffichediv1 = true;
                                    //  erreur.style = "display: none;";

                                }

                                let div1 = document.getElementById("div1");
                                okaffichediv1 = true;//** AFFICHER DIV1
                                if(okaffichediv1) {
                                    div1.style = "display : ;";

                                } else {
                                    div1.style = "display : none;";

                                }



                            }

                        </script>
                    </form>
                </div>
            </div>
        </div>





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

        <?php 
        var_dump($_FILES);

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
