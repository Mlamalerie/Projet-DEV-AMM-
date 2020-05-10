<!doctype html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" type="text/css" href="css/testplayer.css">
        
          <!-- APlayer CSS -->
        <link rel="stylesheet" href="APlayer.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/aplayer/1.10.1/APlayer.min.css">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">



        <title>Bibliothèque de musique</title>
    </head>
    <body>

        <div class="main">
            <div class="container">

                <div class="row">

                    <div class="col-md-12">
                        <h3>Top Ventes</h3>
                    </div>

                  <!-- met les balises php /*
                    function affiche_image_enhaut($title,$author,$year,$source,$i){           
                        echo "<div class='col-md-3'>
                    <a href='javascript:void();' class='album-poster' data-switch=".$i.".>";
                        echo " <img src=".$source.">";
                        echo "</a>
                      <h4>".$title."</h4>
                      <p>".$author." ".$year."</p>
                      </div>";
                    }

                    $titre1="High Fashion (ft.Dj Mustard)";
                    $auteur1="Roddy Rich";
                    $annee1=2020;
                    $source1="img/roddy.jpg";
                    affiche_image_enhaut($titre1,$auteur1,$annee1,$source1,0);
                    -->
                

                    <div class="col-md-3">
                        <a href="javascript:void();" class="album-poster" data-switch="0"><img src="img/roddy.jpg">
                        </a>
                        <h4>Titre</h4>
                        <p>Nom artiste</p>
                    </div>

                    <div class="col-md-3">
                        <a href="javascript:void();" class="album-poster" data-switch="1">
                        <img src="img/bigmetro.jpg">
                        </a>
                        <h4>Titre</h4>
                        <p>Nom artiste</p>
                    </div>

                    <div class="col-md-3">
                        <a href="javascript:void();" class="album-poster" data-switch="2">
                        <img src="img/luv.jpg">
                        </a>
                        <h4>Titre</h4>
                        <p>Nom artiste</p>
                    </div>

                    <div class="col-md-3">
                        <a href="javascript:void();" class="album-poster" data-switch="3">
                        <img src="img/roddy.jpg">
                        </a>
                        <h4>Titre</h4>
                        <p>Nom artiste</p>
                    </div>

                    </div> 

                    <div class="row">
                        <div class="col-md-12">
                            <h3>Tendances</h3>
                        </div>

                        <div class="col-md-3">
                            <a href="#" class="album-poster" data-switch="4">
                                <img src="img/CG6.png">
                            </a>
                            <h4>Titre</h4>
                            <p>Nom Artiste</p>
                        </div>
                        <div class="col-md-3">
                            <a href="#" class="album-poster" data-switch="5">
                                <img src="img/DB5.jpg">
                            </a>
                            <h4>Titre</h4>
                            <p>Nom Artiste</p>
                        </div>
                        <div class="col-md-3">
                            <a href="#" class="album-poster" data-switch="6">
                                <img src="img/MILS.jpg">
                            </a>
                            <h4>Titre</h4>
                            <p>Nom Artiste</p>
                        </div>
                    </div>


                </div>
            </div>

            <div id="aplayer"></div>

            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <!-- APlayer Jquery link -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/aplayer/1.10.1/APlayer.min.js"></script>

            <script>

                $(".album-poster").on('click',function(e){
                    var dataSwitchId = $(this).attr('data-switch');
                    ap.list.switch(dataSwitchId);
                    ap.play();
                    $("#aplayer").addClass('showPlayer');
                })


                const ap = new APlayer({
                    container: document.getElementById('aplayer'),
                    listFolded: true,
                    audio: [
                        /********TOP VENTES********/
                        {
                            name: 'High Fashion (ft.Dj Mustard)', //nom son
                            artist: 'Roddy Rich', //nom artiste
                            url: 'audio/high_fashion.mp3', //url son
                            cover: 'img/roddy.jpg'
                        },
                        {
                            name: 'Go Legend (ft.Travis Scott)', 
                            artist: 'Big Sean & Metro Boomin',
                            url: 'audio/go_legend.mp3',
                            cover: 'img/bigmetro.jpg'
                        },
                        {
                            name: 'Futsal Shuffle 2020',
                            artist: 'Lil Uzi Vert',
                            url: 'audio/futsal_shuffle_2020.mp3',
                            cover: 'img/luv.jpg'
                        },
                        {
                            name: 'Tip Toe',
                            artist: 'Roddy Rich',
                            url: 'audio/tip_toe.mp3',
                            cover: 'img/roddy.jpg'
                        },
                        /*****TENDANCES*****/
                        {
                            name: 'Nelson',
                            artist: 'CG6',
                            url: 'audio/nelson.mp3',
                            cover: 'img/CG6.png'
                        },
                        {
                            name: 'Double Bang 5',
                            artist: 'Leto',
                            url: 'audio/DB5.mp3',
                            cover: 'img/DB5.jpg'
                        },
                        {
                            name: 'Malcolm',
                            artist: 'Ninho',
                            url: 'audio/Malcolm.mp3',
                            cover: 'img/MILS.jpg'
                        }

                    ]
                });
            </script>

            </body>
        </html>