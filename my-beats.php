<?php
session_start();
$_SESSION['ici_index_bool'] = false;

include('assets/db/connexiondb.php');



$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    $okconnectey = true;

} else {
    header('Location: index.php');
    exit;
}

if(isset($_POST['inputOption'])) {
    $id_beat=$_POST['inputOption_beat_id'];
    $ok = true;
    if($_POST['inputOption']== "suppr"){
        if($ok){
            $req = $BDD->prepare("DELETE FROM beat
            WHERE beat_id = ?"); 
            $req->execute(array($id_beat));
            header('Location: my-beats');
            exit;

        }
    }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php        require_once('assets/skeleton/headLinkCSS.html');
        ?>




        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
        <link rel="stylesheet" type="text/css" href="assets/css/my-beats.css">

        <title>All Users</title>

    </head>
    <body>
        <!--   ************************** NAVBAR  **************************  -->

        <?php

        require_once('assets/skeleton/navbar.php');
        ?>
        <div class="container py-5">
            <!-- For demo purpose -->
            <div class="row mb-5">
                <div class="col-lg-8 text-white py-4 text-center mx-auto">
                    <h1 class="display-4">Mes tracks</h1>
                    <p class="lead mb-0">Tous vos beats sont réunis ici</p>
                </div>
            </div>
            <!-- End -->


            <div class="p-5 bg-white rounded shadow mb-5">
                <!-- Rounded tabs -->
                <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
                    <li class="nav-item flex-sm-fill">
                        <a id="myupload-tab" data-toggle="tab" href="#myupload" role="tab" aria-controls="myupload" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active">Mes Upload</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="mypurchase-tab" data-toggle="tab" href="#mypurchase" role="tab" aria-controls="mypurchase" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">Mes achats</a>
                    </li>

                </ul>
                <div id="myTabContent" class="tab-content">
                    <div id="myupload" role="tabpanel" aria-labelledby="myupload-tab" class="tab-pane fade px-4 py-5 show active">
                        <p class="text-muted">Retrouvez la liste de vos beats uploadés.</p>
                        <?php 
                        require_once('assets/skeleton/tableUpload.php');
                        ?>
                    </div>
                    <div id="mypurchase" role="tabpanel" aria-labelledby="mypurchase-tab" class="tab-pane fade px-4 py-5">
                        <p class="text-muted">Retrouvez la liste de vos achats</p>

                        <?php 
                        $lim = 0;
                        require_once('assets/skeleton/tableAchats.php');
                        ?>
                    </div>

                </div>
                <!-- End rounded tabs -->
            </div>
        </div>

        <!--      SCRIPTS      -->
        <?php 
        require_once('assets/skeleton/endLinkScripts.php');
        ?>


    </body>
</html>