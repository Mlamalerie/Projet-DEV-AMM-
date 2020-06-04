

<?php $jesuissurindex = $_SESSION['ici_index_bool']; 

// si je detecte une connexion alors
$connect = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo']) ){
    $connect = true;
}

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
        <?php 


        if (!$jesuissurindex) { ?>
        <form id="searchform" method="get" action="search.php">
            <div class="input-group">

                <div class="input-group mb-4 border rounded-pill p-1">




                    <div class="input-group-prepend border-0">

                        <select name="Type" class="custom-select ">

                            <option value="beats" class="dropdown-item">All beats</option>


                            <option value="users" class="dropdown-item">All users </option>


                        </select>

                        <button onclick="goSearch()" id="button-search" type="button" class="btn btn-link text-info search_icon"><i class="fa fa-search"></i></button>
                    </div>
                    <input id='searchbar'
                           type="text" placeholder="Recherchez vos musiques, artistes..." name="q" aria-describedby="button-search" class="form-control searchbar bg-none border-0">
                </div>






            </div>
        </form>




        <?php  
        }





        ?>

        <!--            Menu droite -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-md-auto" >
                <?php
                // si je detecte une connexion alors
                if($connect){

                ?>


                <li class="nav-item ">
                    <a class="nav-link btn" href="messagerie.php">Messagerie<span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link btn" href="test_zone.php">Test_Zone <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <button class="nav-link btn" href="#" data-toggle="modal" data-target="#modalUpload"><img id="iconUpload" src="assets/img/icon/ui.svg"> Uploader </button>
                </li>

                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle btn  " href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                        <img id="iconUser" src="assets/img/user.png">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                        <span class="dropdown-item  "> <?= $_SESSION['user_pseudo'] ?> </span>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item  " href="profils.php?profil_id=<?= $_SESSION['user_id']?>"> Mon Profil </a>
                        <a class="dropdown-item  " href="#"> Mes Tracks </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="deconnexion.php"><i class="fas fa-power-off"></i>Déconnexion</a>
                    </div>
                </li>

                <li class="nav-item">

                    <button class="nav-link btn" href="#" data-toggle="modal" data-target="#ModalPanier" ><img id="iconPanier" src="assets/img/icon/shopping-cart.svg"> <span id="span_nb_panier" class="badge badge-primary px-2 rounded-pill ml-2"></span> </button>

                </li>







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






