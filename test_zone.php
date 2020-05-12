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
<<<<<<< HEAD
<<<<<<< HEAD
        <link rel="stylesheet" type="text/css" href="css/styles-index.css"> 
        <link rel="stylesheet" type="text/css" href="css/navbar.css">
        <link rel="stylesheet" type="text/css" href="css/music_card.css">

=======
        <link rel="stylesheet" type="text/css" href="assets/css/styles-index.css"> 
=======
<!--        <link rel="stylesheet" type="text/css" href="assets/css/styles-index.css"> -->
>>>>>>> 8ed55db6a7fc1cb754039467711dc0df7eafe42a
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
        <link rel="stylesheet" type="text/css" href="assets/css/test_zone.css">
        <link rel="stylesheet" type="text/css" href="assets/css/MusicPlayerMlamali.css">
>>>>>>> a823754265ecf12ba8ee768a6a4f2929e7942f91
        <title>TEST ZONE</title>
    </head>
    <body>
        <br><br><br><br><br><br><br>
        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->

        <?php
        require_once('assets/skeleton/menu.php');
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
<<<<<<< HEAD
            <select name="Genre" class="custom-select">
                <option value="All"selected>ALL</option>
                <option value="Trap">TRAP</option>
                <option value="Afro">AFRO</option>
=======
            <select name="Genre" class="custom-select">-->
                <option value="All" selected >ALL</option>
                <option value="Trap" >TRAP</option>
                <option value="Afro" >AFRO</option>
>>>>>>> a823754265ecf12ba8ee768a6a4f2929e7942f91

            </select>
            <div class="searchbar ">

                <input id='searchbar' class="search_input" type="text" placeholder="Recherchez vos musiques, artistes..." name="q">


                <a onclick="goSearch()" href="#" class="search_icon"><i class="fas fa-search"></i></a>
            </div>
        </form>

        <nav id="MusicPlayer" class="navbar-light bg-dark fixed-bottom">
            <div class="container-fluid p-2 px-5" style="background-color:yellow;">
                <div class="row">
                    <div class="d-flex align-items-center justify-content-center" style="background-color:red;">
                        <a class="navbar-brand" >
                            <i id="logoPlay" onclick=" changeIcon()" class="fas fa-play " style="color : purple;"></i>
                        </a>

                    </div>
                    <div class="" style="background-color:blue;">2/3 </div>
                    <div class="" style="background-color:green;">3/3        </div>
                </div>
            </div>

        </nav>


        <?php
        require_once('assets/skeleton/endLinkScripts.php');
        ?>
        <script>
            function changeIcon(){
                let ici = document.getElementById("logoPlay")
                console.log(ici.node);
                //ici.classList.remove("fa-play");
                //console.log(ici);
            }

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
        <br/><br/>



        <div class="container row col-md-12">
            <div class="col-md-3">
                <div class="hover hover-5 text-white rounded"><img src="img/Laylow.jpg" alt="">
                    <div class="hover-overlay"></div>
                    <div class="link_icon"><i class="far fa-play-circle"></i></div>
                    <h6 class="hover-5-title text-uppercase font-weight-light mb-0">Laylow<strong class="font-weight-bold text-white">
                        BURNING MAN</strong><span> 2020</span></h6>
                </div>
            </div>
        </div>

    </body>
</html>