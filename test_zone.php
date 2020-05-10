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

    </body>
</html>