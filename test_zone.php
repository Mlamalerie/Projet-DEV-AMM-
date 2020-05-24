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
        <link rel="stylesheet" type="text/css" href="assets/css/modalUploadAudio.css">


        <title>TEST ZONE</title>
    </head>
    <body onload="gogoUpload()">
        <br><br><br><br><br><br><br>

        <?php
        require_once 'assets/functions/uploadFile.php';

        $upd = new uploadFile();
        $listeGenres = $_SESSION['listeGenres'];
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
            else if (strlen($b_title) > 30) {

                $ok = false;
                $err_b_title = "Ce pseudo est trop grand ! Vous avez ".(strlen($b_title) - 30)." caractère en trop";
            }

            if(!in_array()){
                $ok = false;
                $err_b_genre = "Veuillez renseigner ce champ !";

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
                            <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                <form id='formUpload1' action="" method="post" enctype="multipart/form-data">

                                    <input accept=".mp3, .wav" onchange="gogoUpload();" id="uploadAudio" name="uploadAudio" type="file" class="form-control border-0">
                                </form>

                                <label id="uploadAudio-label" for="uploadAudio" class="font-weight-light text-muted">Choose Audio file</label>
                                <div class="input-group-append">

                                    <label for="uploadAudio" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>

                                </div>

                                <script>
                                    var inputAudio = document.getElementById( 'uploadAudio' );
                                    var infoAreaAudio = document.getElementById('uploadAudio-label');


                                    inputAudio.addEventListener( 'change', showFileNameAudio );

                                    function showFileNameAudio( event ) {
                                        var inputAudio = event.srcElement;
                                        var fileName = inputAudio.files[0].name;
                                        infoAreaAudio.innerHTML = ': ' + fileName;

                                    }

                                </script>

                            </div>

                            <div id="div1" class="form-group mb-2 d-none" >
                                <!--TITLE-->
                                <div class="row">

                                    <label for="b_title"> title </label>
                                </div>

                                <input onkeyup="gogoUpload()" type="text" class="mb-2 text-center form-control rounded-pill shadow-sm px-4" id="b_title" name="b_title" placeholder="Mettez un title pour votre profil"  value="<?php if(isset($b_title)){echo $b_title;}?>" autofocus>



                                <!--GENRE-->
                                <div class="row">

                                    <label for="b_genre"> genre </label>
                                </div>
                                <select name="b_genre" id="b_genre" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4">
                                    <?php 

                                    foreach($listeGenres as $gr){
                                    ?>
                                    <option class=" " value="<?=$gr?>"><?= $gr?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                                <!--ANNEE-->
                                <input onchange="gogoUpload()" onkeyup="gogoUpload()" type="number" min="1900" max="<?= date("Y")+5?>" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4" id="b_year" name="b_year" placeholder="Mettez un year pour votre profil"  value="<?php if(isset($b_year)){echo $b_year;}?>" autofocus>


                            </div>
                            <div id="div2" class="form-group mb-2 d-none" >


                                <!--DESCRITION-->
                                <textarea onkeyup="gogoUpload()" id="b_description" name="b_description" class="mb-2 form-control shadow-sm" placeholder="description ici la" value="this.innerHTML.trim()"></textarea>
                                <!--TAGS-->
                                <input onkeyup="gogoUpload()" type="text" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4" id="b_tags" name="b_tags" placeholder="Mettez un tags pour votre profil"  value="<?php if(isset($b_tags)){echo $b_tags;}?>" autofocus>
                            </div>
                            <div id="div3" class="form-group mb-2 d-none" >

                                <!--PRICE-->
                                <p class="custom-control custom-switch m-0">
                                    <input onchange="gogoUpload()" name="freebay" class="custom-control-input" id="freebay" type="checkbox"  >
                                    <label class="custom-control-label " for="freebay"> FREE BEAT</label>

                                </p>
                                <input  onchange="gogoUpload()" onkeyup="gogoUpload()" type="number" step="0.01" min="1" max="10000" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4" id="b_price" name="b_price" placeholder="Mettez un price pour votre profil"  value="<?php if(isset($b_price)){echo $b_price;}?>" autofocus>
                            </div>


                            <div id="div4" class="form-group mb-2 d-none" >
                                <!-- COVER -->
                                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                    <form id='formuploadCover1' action="" method="post" enctype="multipart/form-data">

                                        <input accept=".png, .jpg, .jpeg" onchange="gogoUpload()" id="uploadCover" name="uploadCover" type="file" class="form-control border-0">
                                    </form>

                                    <label id="uploadCover-label" for="uploadCover" class="font-weight-light text-muted">Choose Cover file</label>
                                    <div class="input-group-append">

                                        <label for="uploadCover" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>

                                    </div>

                                    <script>
                                        var inputCover = document.getElementById( 'uploadCover' );
                                        var infoAreaCover = document.getElementById( 'uploadCover-label' );


                                        inputCover.addEventListener( 'change', showFileNameCover );

                                        function showFileNameCover( event ) {
                                            var inputCover = event.srcElement;
                                            var fileName = inputCover.files[0].name;
                                            infoAreaCover.textContent = ': ' + fileName;
                                        }

                                    </script>

                                </div>

                            </div>

                            <span id="spanErreurUpload" class="text-danger d-none"> </span>
                            <span id="spanErreurTitle" class="text-danger d-none"> </span>
                            <span id="spanErreurGenre" class="text-danger d-none"> </span>
                            <span id="spanErreurYear" class="text-danger d-none"> </span>
                            <span id="spanErreurDescription" class="text-danger d-none"> </span>
                            <span id="spanErreurTags" class="text-danger d-none"> </span>
                            <span id="spanErreurCover" class="text-danger d-none"> </span>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="submit_upload" type="submit" name="submit_upload" class="btn btn-primary d-none">Save changes</button>
                        </div>
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


                            function gogoUpload(){
                                okaffichesubmit = true;
                                let submit = document.getElementById('submit_upload');

                                let upload = document.getElementById("uploadAudio").value.split('.');
                                let ext = upload[upload.length - 1].toLowerCase();
                                let erreurUpload = document.getElementById('spanErreurUpload');
                                //                                console.log(upload.length,ext);

                                //** UPLOADER FICHIER AUDIO
                                formatAudio = ["mp3","wav"];
                                okaffichediv1 = true;
                                if (formatAudio.indexOf(ext) == -1 ) { // si pas un fichier audio
                                    okaffichediv1 = false; // pas afficher la suite
 okaffichesubmit = false;
                                    if(upload.length < 2) { 
                                        erreurUpload.classList.add("d-none"); //ne pas afficher l'erreur si rien a été uploader
                                    } else {
                                        erreurUpload.classList.remove("d-none");
                                        erreurUpload.innerHTML = "Ce n'est pas un audio";
                                    }

                                } else { // si bien audio alors
                                    erreurUpload.classList.add("d-none"); // pas afficher message d'erreur
                                    //                                    console.log("**",erreur);
                                }

                                //******** AFFICHER DIV1
                                let div1 = document.getElementById("div1");
                                                                okaffichediv1 = true;
                                if(okaffichediv1) {
                                    div1.classList.remove("d-none"); // afficher div 1

                                    okaffichediv2 = true;
                                    //--titre
                                    let erreurTitle = document.getElementById('spanErreurTitle');
                                    let title = document.getElementById('b_title').value.trim();

                                    if(title.split(' ').length-1 > 2){ // plus de 1 espace
                                        erreurTitle.classList.remove("d-none"); //afficher erreur
                                        erreurTitle.innerHTML = "Votre titre doit comporter au plus 1 espace";
                                        okaffichediv2 = false;
                                    }else if (!isAlphanumeric(title)){
                                        erreurTitle.classList.remove("d-none");  //afficher erreur
                                        erreurTitle.innerHTML = "Votre titre doit etes soit lettre soit nombre";
                                        okaffichediv2 = false;
                                         okaffichesubmit = false;
                                    } 
                                    else if (title.length > 20){
                                        erreurTitle.classList.remove("d-none");  //afficher erreur
                                        erreurTitle.innerHTML = "Titre trop grand";
                                        okaffichediv2 = false;
                                    } 
                                    else {
                                        erreurTitle.classList.add("d-none");
                                    }
                                    //--genre

                                    //--b_year
                                    let maxyea = <?= date("Y")+5?> ;
                                    let erreurYear = document.getElementById('spanErreurYear');
                                    let year = ( document.getElementById('b_year').value);

                                    if(isNumeric(year)){
                                        year2 = parseInt(year);
                                        if (year2 < 1900 || year2 > maxyea) {
                                            erreurYear.classList.remove("d-none");okaffichesubmit = false;
                                            erreurYear.innerHTML = "saisir entre 1900 et 2025 svp";
                                            okaffichediv2 = false;
                                        } else {
                                            erreurYear.classList.add("d-none");

                                        }
                                    } else {
                                        erreurYear.classList.remove("d-none");okaffichesubmit = false;
                                        erreurYear.innerHTML = "saisir un chiffre svp";
                                        okaffichediv2 = false;
                                    }




                                    okaffichediv2 = okaffichediv1 && okaffichediv2 && (title.length > 0 && year.length > 0);
                                    //******** AFFICHER DIV2
                                    let div2 = document.getElementById("div2");
                                                                        okaffichediv2 =  true;
                                    if(okaffichediv2) {
                                        div2.classList.remove("d-none"); //afficher div 2

                                        okaffichediv3 =true;
                                        //-- b_description
                                        let erreurDescription = document.getElementById('spanErreurDescription');
                                        let description = document.getElementById('b_description').value.trim();
                                        let tags = document.getElementById('b_tags');

                                        if(description.length < 1){
                                            tags.classList.add("d-none");
                                            okaffichediv3 = false;

                                        }else if (description.length > 140){
                                            erreurDescription.classList.remove("d-none");
                                            erreurDescription.innerHTML = "Description trop grande";

                                            //                                            tags.classList.add("d-none");
                                            okaffichediv3 = false;
                                        }
                                        else {
                                            erreurDescription.classList.add("d-none");
                                            tags.classList.remove("d-none");
                                        }

                                        //--b_tags
                                        let erreurTags = document.getElementById('spanErreurTags');
                                        let tagsval = tags.value.trim();
                                        let tttag =  tagsval.split(',');
                                        console.log(tttag);
                                        if (tttag.length-1 > 4)  {

                                            erreurTags.classList.remove("d-none");
                                            erreurTags.innerHTML = "Vous ne pouvez mettre que 5 tags max";
                                            okaffichediv3 = false;


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
                                                okaffichediv3 = false;
                                            } else {
                                                erreurTags.classList.add("d-none");
                                            }

                                        }

                                        else {
                                            erreurTags.classList.add("d-none");

                                        }

                                        okaffichediv3 =  okaffichediv2 && okaffichediv3 && (description.length > 0 && tagsval.length > 0);
                                        //                                        console.log("okaffichediv3" , okaffichediv3 , (description.length > 0 && tags.length > 0))
                                        //** AFFICHER DIV3
                                        let div3 = document.getElementById("div3");
                                                                                okaffichediv3 =true;
                                        if(okaffichediv3) {
                                            div3.classList.remove("d-none");

                                            okaffichediv4 = true;
                                            //--freebay
                                            let freebay = document.getElementById('freebay');
                                            let erreurPrice = document.getElementById('spanErreurPrice');
                                            let price = document.getElementById('b_price').value;
                                            if(freebay.checked) {
                                                document.getElementById('b_price').classList.add('d-none');
                                            } else {
                                                document.getElementById('b_price').classList.remove('d-none');
                                                //--price


                                                let price2 = parseFloat(price)
                                                console.log(price);

                                                if (price2 < 1 || price2 > 10000) {

                                                    erreurTags.classList.remove("d-none");okaffichesubmit = false;
                                                    erreurTags.innerHTML = "Saisir un prix entre 1 et 10000";
                                                    okaffichediv4 = false;


                                                }

                                            }

                                            okaffichediv4 = okaffichediv3 && okaffichediv4 && (freebay.checked || price.length > 0);
                                            console.log("###", okaffichediv3 , okaffichediv4,"::",(freebay.checked || price.length > 0));

                                            //******** AFFICHER DIV4
                                            let div4 = document.getElementById("div4");
                                             okaffichediv4 = true;
                                            if(okaffichediv4) {
                                                div4.classList.remove("d-none");

                                                let upload2 = document.getElementById("uploadCover").value.split('.');
                                                let ext2 = upload2[upload2.length - 1].toLowerCase();
                                                let erreurCover = document.getElementById('spanErreurCover');

                                                console.log(upload2.length,ext2);


                                                //-- upload image
                                                formatImage = ["jpg","png","jpeg"];
                                                if (formatImage.indexOf(ext2) == -1 ) { // si pas un fichier image
                                                    okaffichesubmit = false;

                                                    if(upload2.length < 2) {
                                                        erreurCover.classList.add("d-none");
                                                    } else {
                                                        erreurCover.classList.remove("d-none");okaffichesubmit = false;
                                                        erreurCover.innerHTML = "Ce n'est pas une image";

                                                    }
                                                    console.log("--*",erreurCover);

                                                } else { // si bien Image alors
                                                    erreurCover.classList.add("d-none");
                                                    console.log("--**",erreurCover);
                                                }



                                                okaffichesubmit = okaffichesubmit && okaffichediv1 && okaffichediv2 && okaffichediv3 && okaffichediv4 ;
                                                console.log("submit :",okaffichesubmit ,"1 :" , okaffichediv1 , "2 :",okaffichediv2 ,"3 :", okaffichediv3 ,"4 :", okaffichediv4 )


                                                if (okaffichesubmit) {
                                                    submit.classList.remove("d-none");
                                                }else {
                                                    submit.classList.add("d-none");
                                                }


                                            } else { // cacher div 4
                                                div4.classList.add("d-none");
                                                submit.classList.add("d-none");
                                            }


                                        }else { // cacher div 3
                                            div4.classList.add("d-none");
                                            div3.classList.add("d-none");
                                            submit.classList.add("d-none");
                                        }




                                    }else { // cacher div 2
                                        div2.classList.add("d-none");
                                        submit.classList.add("d-none");
                                    }





                                } else { // cacher div 1
                                    div1.classList.add("d-none");
                                    submit.classList.add("d-none");

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
