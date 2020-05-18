<?php
session_start();

$_SESSION['ici_index_bool'] = false;
?>

<!-- POUR MODAL UPLOAD.php -->
<?php
require 'assets/functions/uploadFile.php';

$upd = new uploadFile();
print_r("$ <br><br><br><br>rg<br>");
print_r($upd);
print_r($_POST);

if (isset($_POST['Envoyer']) && !empty($_POST['Envoyer']) ) {
    print_r("$$ <br>");
    
    $tmp_name = $_FILES['upload']['tmp_name'];
     $name = $_FILES['upload']['name'];
    
    $name = "Mlamali.jpg";
    $upd->upload($tmp_name,$name,$_SESSION['user_pseudo']);
    print_r("$$$$ <br>");
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
        <link rel="stylesheet" type="text/css" href="assets/css/button-style2ouf.css">
        <title>TEST ZONE</title>
    </head>
    <body>
        <br><br><br><br><br><br><br>
        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->

        <?php
        require_once('assets/skeleton/navbar.php');
        ?>

        <!-- Modal UPLOAD -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                        <form id='formUpload1' action="" method="post" enctype="multipart/form-data">

                            <input name="upload" type="file" class="form-control border-0">
                            <input type="submit" name="Envoyer" value='SUBMIt'>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


        Ici c'est l'index des connecté
        <?php
        if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
            print_r($_SESSION);
        } else{
            echo "Pas de connexion";
        }
        ?>
        <fieldset>
            <legend> ok </legend>
            <form action="" method="post" enctype="multipart/form-data">

                <input id="" type="file" name="upload" class="form-control border-0">
                <input type="submit" name="Sub"  value="Envoyer"> 
            </form>
        </fieldset>
        <?php 
        var_dump($_FILES);
        print_r($_POST)
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

    </body>
</html>
