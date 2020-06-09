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

        //require_once('assets/skeleton/navbar.php');
        ?>
        <div class="container py-5">
            <!-- For demo purpose -->
            <div class="row mb-5">
                <div class="col-lg-8 text-white py-4 text-center mx-auto">
                    <h1 class="display-4">Bootstrap 4 tabs</h1>
                    <p class="lead mb-0">Build a few custom styled tab variants using Bootstrap 4.</p>
                    <p class="lead">Snippet by <a href="https://bootstrapious.com/snippets" class="text-white">
                        Bootstrapious</a>
                    </p>
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
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                            irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <p class="text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                            irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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