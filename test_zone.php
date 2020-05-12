<?php
session_start();


?>




<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <?php
        require_once('skeleton/headLinkCSS.html');
        ?>
        <script src="https://kit.fontawesome.com/8157870d7a.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="css/styles-index.css"> 
        <link rel="stylesheet" type="text/css" href="css/navbar.css">
        <link rel="stylesheet" type="text/css" href="css/music_card.css">

        <title>TEST ZONE</title>
    </head>
    <body>
        <br><br><br><br><br><br><br>
        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->

        <?php
        require_once('skeleton/menu.php');
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
            <select name="Genre" class="custom-select">
                <option value="All"selected>ALL</option>
                <option value="Trap">TRAP</option>
                <option value="Afro">AFRO</option>

            </select>
            <div class="searchbar ">

                <input id='searchbar' class="search_input" type="text" placeholder="Recherchez vos musiques, artistes..." name="q">


                <a onclick="goSearch()" href="#" class="search_icon"><i class="fas fa-search"></i></a>
            </div>
        </form>

        <div>
            <div id="result-search"> </div>
        </div>



        <?php
        require_once('skeleton/endLinkScripts.php');
        ?>
        <script>
            function goSearch() {


                var ok = false;
                var champs = document.getElementById('searchbar');
                var baysearch = champs.value.trim();




                ok = (baysearch != "");
                console.log(champs,baysearch,ok);

                if (ok) {
                    document.getElementById("searchform").submit();
                }

            }
            //            $(document).ready(function() {
            //                $('#searchbar').keyup(function(){
            //                    $('#result-search').html('');
            //
            //                    var beat = $(this).val();
            //
            //                    if (beat != ""){
            //                        $.ajax({
            //                            type : "GET",
            //                            url : 'search.php',
            //                            data: 'instru=' + encodeURIComponent(beat),
            //                            success: function(data){
            //                                if(data != ""){
            //                                    $('#result-search').append(data);
            //                                }else {
            //                                    document.getElementById('result-search').innerHTML = "AUCUN BAY";
            //                                }
            //                            }
            //
            //
            //
            //                        });
            //
            //                    }

            //                    console.log(beat);
            //                });
            //
            //            });
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