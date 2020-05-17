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
        
        
        <div class="profil_card rounded-circle text-center">
            <img src="img/user.png">
            <span>Pseudo</span>
        </div><br/>
        
        
        
        <!--    SLIDES JS SCRIPT    -->
        
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="assets/js/slide.js"></script>
        
        
        
    </body>
</html>
