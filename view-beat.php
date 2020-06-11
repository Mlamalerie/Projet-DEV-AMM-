<?php
session_start();
$_SESSION['ici_index_bool'] = false;
include_once("assets/db/connexiondb.php");


$beat_id = (int)$_GET['id'];


$req = $BDD -> prepare("SELECT * FROM beat WHERE beat_id = ?");
$req->execute(array($beat_id));
$instru = $req->fetch();



?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title><?= $instru['beat_title'] ?></title>
        <?php
    require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <link rel="stylesheet" type="text/css" href="assets/css/view-beat.css">
    </head>
    <body>
        <!-- Demo header-->
        <section class="mt-5 pb-4 header text-center">

            <div class="bg-dark container py-5 text-white rounded">

                <div class="text-light font-italic"><?= $instru['beat_title']?> <br>by
                    <a class="text-light" href="https://bootstrapious.com/">
                        <u><?= $instru['beat_author']?></u>
                    </a>
                </div>
                <section id="divInfo" class="py-3">
                    <h1 class="display-4">Bootstrap animated play button</h1>
                    <p class="text-light font-italic mb-1">Using css animation and pseudo elements, create a nice animated play button.</p>
                    <?php  $tags = explode(',',$instru['beat_tags']); ?>



                    <div scope="row" class=" border-0 align-middle rounded">
                        <div class="p-0 rounded ">
                            <?php foreach($tags as $t) { if(strlen($t)>1){ $t = trim($t);

                            ?>
                            <a class="spanTag  badge badge-light text-dark px-2 rounded-pill ml-2" href="search.php?Type=beats&q=<?= $t ?>">#<?= $t ?> </a>
                            <?php }} ?>
                        </div>

                    </div>

                </section>
            </div>




            <!-- Animated button -->
            <span  onclick='goAfficheInfo()' class="animated-btn text-white" href="#"><i class="fa fa-play iconPlay"></i></span>


        </section>

        <script>
            function goAfficheInfo() {

            }

            function playBeat(){

            }

        </script>

    </body>

</html>
