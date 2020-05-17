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
        
        <!-- Modal -->
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
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

    </body>
</html>
