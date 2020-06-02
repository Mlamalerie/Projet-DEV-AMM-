<?php
session_start();
include_once("assets/db/connexiondb.php"); // inclure le fichier pour se connecter à la base de donnée
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

        <!-- Modal UPLOAD modal fade -->
        <div  class=" modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="modalUploadTitle" aria-hidden="true">
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


                                <input accept=".mp3, .wav" onchange="gogoUpload();" id="uploadAudio" name="uploadAudio" type="file" class="form-control border-0">


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

                                <?php
                                if(isset($err_b_title)){
                                    echo "<span class='spanAlertchamp'> ";
                                    echo $icon . $err_b_title ;
                                    echo "</span> ";
                                }
                                ?>

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

                                <?php
                                if(isset($err_b_genre)){
                                    echo "<span class='spanAlertchamp'> ";
                                    echo $icon . $err_b_genre ;
                                    echo "</span> ";
                                }
                                ?>
                                <!--ANNEE-->
                                <input onchange="gogoUpload()" onkeyup="gogoUpload()" type="number" min="1900" max="<?= date("Y")+5?>" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4" id="b_year" name="b_year" placeholder="Mettez un year pour votre profil"  value="<?php if(isset($b_year)){echo $b_year;} else { echo date("Y");} ?>" autofocus>


                            </div>
                            <div id="div2" class="form-group mb-2 d-none" >


                                <!--DESCRITION-->
                                <textarea onkeyup="gogoUpload()" id="b_description" name="b_description" class="mb-2 form-control shadow-sm" placeholder="description ici la" value="this.value.trim()"><?php if (isset($b_description)) {echo $b_description;} ?></textarea>

                                <?php
                                if(isset($err_b_description)){
                                    echo "<span class='spanAlertchamp'> ";
                                    echo $icon . $err_b_description ;
                                    echo "</span> ";
                                }
                                ?>
                                <!--TAGS-->
                                <input onkeyup="gogoUpload()" type="text" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4" id="b_tags" name="b_tags" placeholder="Mettez un tags pour votre profil"  value="<?php if (isset($b_tags)) {echo $b_tags;} ?>" autofocus>

                                <?php
                                if(isset($err_b_tags)){
                                    echo "<span class='spanAlertchamp'> ";
                                    echo $icon . $err_b_tags ;
                                    echo "</span> ";
                                }
                                ?>
                            </div>
                            <div id="div3" class="form-group mb-2 d-none" >

                                <!--PRICE-->
                                <p class="custom-control custom-switch m-0">
                                    <input onchange="gogoUpload()" name="freebay" class="custom-control-input" id="freebay" type="checkbox" <?php if(isset($_POST['freebay'])){ ?> checked <?php } ?> >
                                    <label class="custom-control-label " for="freebay"> FREE BEAT</label>

                                </p>
                                <input  onchange="gogoUpload()" onkeyup="gogoUpload()" type="number" step="0.01" min="1" max="10000" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4" id="b_price" name="b_price" placeholder="Mettez un price pour votre profil"  value="<?php if(isset($b_price)){echo $b_price;}?>" autofocus>
                                <?php
                                if(isset($err_b_price)){
                                    echo "<span class='spanAlertchamp'> ";
                                    echo $icon . $err_b_price ;
                                    echo "</span> ";
                                }
                                ?>
                            </div>

                            <span id="spanErreurUpload" class="text-danger d-none"> </span>
                            <span id="spanErreurTitle" class="text-danger d-none"> </span>
                            <span id="spanErreurGenre" class="text-danger d-none"> </span>
                            <span id="spanErreurYear" class="text-danger d-none"> </span>
                            <span id="spanErreurDescription" class="text-danger d-none"> </span>
                            <span id="spanErreurTags" class="text-danger d-none"> </span>

                            <br>
                            <input id="submit_upload" onclick="document.getElementById('formUpload1').submit();" name="submit_upload" class="btn btn-primary d-none" value="uploadMoiCa">
                        </div>
                        <!--
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


</div>
-->
                    </form>
                    <?php 


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
                                                okaffichesubmit = false;


                                            }

                                        }

                                        okaffichesubmit = okaffichesubmit && okaffichediv1 && okaffichediv2 && okaffichediv3  ;
                                        console.log("submit :",okaffichesubmit ,"1 :" , okaffichediv1 , "2 :",okaffichediv2 ,"3 :", okaffichediv3  )


                                        if (okaffichesubmit) {
                                            submit.classList.remove("d-none");
                                        }else {
                                            submit.classList.add("d-none");
                                        }


                                    }else { // cacher div 3

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


                            submit.classList.remove("d-none");


                        }

                    </script>

                </div>
            </div>
        </div>




        <!--   *************************************************************  -->
        <!--   ************************** MODAL PANIER  **************************  -->


        <div class="modal fade" id="ModalPanier" tabindex="-1" role="dialog" aria-labelledby="ModalPanierLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalPanierLabel">Panier WeBeats</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
                <div class="table-responsive">
                   <table class="table table-bordered">
                      <tr>
                         <th width="40%">Nom de l'article</th>
                         
                         <th width="20%">Prix</th>
                         
                         <th width="5%">Action</th>
                      </tr>
                      <?php
                      if(!empty($_SESSION["shopping_cart"]))
                      {
                         $total = 0;
                         foreach($_SESSION["shopping_cart"] as $keys => $values)
                         {
                      ?>
                      <tr>
                         <td><?php echo $values["item_name"]; ?></td>
                         
                         
                         <td><?php echo number_format($values["item_price"], 2);?> &euro;</td>
                         <td><a href="test.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Retirer</span></a></td>
                      </tr>
                      <?php
                            $total = $total + ($values["item_price"]);
                         }
                      ?>
                      <tr>
                         <td colspan="3" align="right">Total</td>
                         <td align="right"><?php echo number_format($total, 2); ?> &euro;</td>
                         <td></td>
                      </tr>
                      <?php
                      }
                      ?>
                         
                   </table>
                </div>



              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <a href="affichagepanier.php?action=add&id=<?php echo $row["id"]; ?>"><button type="button" class="btn btn-primary">Valider</button></a>
              </div>
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
