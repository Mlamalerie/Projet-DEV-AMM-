

<?php 
$jesuissurindex = $_SESSION['ici_index_bool']; 

?>

<div class="boxnav">
    <nav id='LANAVBAR' class="navbar navbar-expand-lg navbar-light fixed-top" >
        <a class="navbar-brand" href="#">
            <?php if (!$jesuissurindex){ ?>
            <img src='assets/img/icon/compact-disc.svg' width="35" height="35" alt="">
            <?php } else { ?>
            <img src='assets/img/icon/compact-disc2.svg' width="35" height="35" alt="">
            <?php } ?>
        </a>
        <a class="navbar-brand" href="index.php">WeBeats</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> 
        </button>
        <!--   Barre de recherche     -->
        <!--   Barre de recherche     -->
        <?php if (!$jesuissurindex) { ?>

        <form id="searchform" method="get" action="search.php" class="form-inline nav-brand " style="margin-bottom: 0px;">

            <div class="row">
                <div class="form-group col-md-3">
                    <select name="Type" class=" rounded-pill btn-block shadow-sm custom-select" >

                        <option value="beats" class="dropdown-item">All beats</option>


                        <option value="users" class="dropdown-item">All users </option>


                    </select>
                </div>
                <div class="form-group col-md-9">
                    <input id="exampleFormControlInput6" type="email" placeholder="What're you searching for?" class="form-control form-control-underlined">
                </div>
            </div>s
            <!--

<button onclick="goSearch()" id="button-search" type="button" class="btn btn-link text-info search_icon"><i class="fa fa-search"></i></button>
<input id='searchbar'
type="text" placeholder="Recherchez vos musiques, artistes..." name="q" aria-describedby="button-search" class="form-control searchbar bg-none border-0">
-->
        </form>
        <?php } ?>

        <!--            Menu droite -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-md-auto" >
                <?php
                // si je detecte une connexion alors
                if($okconnectey) {
                ?>

                <li class="nav-item ">
                    <a class="nav-link btn" href="test_zone.php">Test_Zone<span class="sr-only">(current)</span></a>
                </li>


                <!-- UPLOADER -->
                <?php if(!$jesuissurindex) { ?>
                <li class="nav-item">
                    <button class="nav-link btn" href="#" data-toggle="modal" data-target="#modalUpload"><img id="iconUpload" src="assets/img/icon/ui.svg"> Uploader </button>
                </li>
                <?php } ?>

                <?php if(!$jesuissurindex) { ?>
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img id="iconPanier" src="assets/img/icon/chat-box.svg">
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter">7</span>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class=" dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Mes messages
                        </h6>
                        <?php 
                    include('assets/functions/datediff.php');
                    $req = $BDD->prepare("SELECT *
                            FROM messagerie
                            WHERE id_to = ?
                            ORDER BY date_message DESC
                             LIMIT 5");
                    $req->execute(array($_SESSION['user_id']));
                    $resuMESS = $req->fetchAll();

                    foreach($resuMESS as $m) {
                        ?>

                        <?php  $req = $BDD->prepare("SELECT *
                            FROM user
                            WHERE user_id = ?");
                        $req->execute(array($m['id_from']));
                        $user = $req->fetch();
                        $date1 = new DateTime( $m['date_message']);
                        $date2 = new DateTime(date("Y-m-d H:i:s"));
                        $recent = dateDiff($date1, $date2);

                        ?>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" width="30" src="<?= $user['user_image']?>" alt="">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-truncate"><?= $m['message']?></div>

                                <div class="small text-gray-500"><?= $user['user_pseudo']?> · <?=$recent?></div>
                            </div>
                        </a>
                        <?php } ?>


                        <a class="dropdown-item text-center small text-gray-500" href="messagerie.php">Read More Messages</a>
                    </div>
                </li>
                <?php } ?>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- DEROULANT PROFIL-->
                <li class="nav-item dropdown no-arrow ">
                    <a class="nav-link dropdown-toggle btn  " href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                        <span class="mr-2 d-none d-lg-inline "><?= $_SESSION['user_pseudo'] ?></span> <img id="iconUser" src="assets/img/user.png">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in " aria-labelledby="navbarDropdownMenuLink">

                        <a class="dropdown-item  " href="profils.php?profil_id=<?= $_SESSION['user_id']?>"><i class="fas fa-user fa-sm fa-fw mr-1 text-gray-400"></i> Mon Profil </a>
                        <a class="dropdown-item  " href="#"> <i class="fas fa-compact-disc mr-1 text-gray-400"></i> Mes Tracks </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="deconnexion.php"><i class="fas fa-power-off mr-2"></i>Déconnexion</a>
                    </div>
                </li>

                <!--  PANIER -->
                <?php if(!$jesuissurindex) { ?>

                <li class="nav-item">

                    <button class="nav-link btn" href="#" data-toggle="modal" data-target="#ModalPanier" ><img id="iconPanier" src="assets/img/icon/shopping-cart.svg"> <sup><span id="span_nb_panier" class="badge badge-primary px-1 rounded-pill ml-2 compteurPanier "></span> </sup></button>

                </li>
                <?php } ?>






                <?php
                }
                // si je detecte pas de connection
                else{
                ?>
                <li class="nav-item ">
                    <a class="nav-link btn" href="test_zone.php">Test_Zone <span class="sr-only">(current)</span></a>
                </li>

                <?php if($jesuissurindex) { ?>
                <li class="nav-item ">
                    <a class="nav-link btn" href="#">Accueil <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle btn  " href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                        Genres
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php 
                    $listeGenres = $_SESSION['listeGenres'];
                    foreach($listeGenres as $gr){

                        ?>
                        <a class="dropdown-item  " href="#"><?= $gr?></a>
                        <?php
                    }
                        ?>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Free Beats</a>
                    </div>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link btn" href="connexion.php">Se connecter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill btn btninscription" href="inscription.php">S'inscrire</a>
                </li>

                <?php
                }
                ?>



            </ul>
        </div>
    </nav>

</div>
<?php if(!$jesuissurindex) { ?>
<!--   *************************************************************  -->
<!--   ************************** MODAL PANIER  **************************  -->
<div class="modal fade" id="ModalPanier" tabindex="-1" role="dialog" aria-labelledby="ModalPanierLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalPanierLabel">Panier WeBeats</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="croixquit d-flex justify-content-center rounded" aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">

                <?php require_once('assets/skeleton/tablePanier.php'); ?>

            </div>
            <div class="modal-footer" >


            </div>
        </div>
    </div>
</div>


<?php } ?>




