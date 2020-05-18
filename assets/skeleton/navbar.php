
<?php $jesuissurindex = $_SESSION['ici_index_bool']; ?>


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
            <div class="input-group searchbar">

                <select name="Type" class="custom-select ">

                    <option value="beats" class="dropdown-item">All beats</option>


                    <option value="users" class="dropdown-item">All users </option>


                </select>


                <input id='searchbar' class="search_input form-control  mr-sm-" type="text" placeholder="Recherchez vos musiques, artistes..." name="q">

                <div class="input-group-append">
                    <button onclick="goSearch()" href="#" class="search_icon"><i class="fas fa-search"></i></button>
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
                if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo']) ){

                ?>
                <li class="nav-item">
                    <button class="nav-link btn" href="#" data-toggle="modal" data-target="#exampleModalCenter"><img id="iconUpload" src="assets/img/icon/ui.svg"> Uploader </button>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn" href="#" ><img id="iconPanier" src="assets/img/icon/shopping-cart.svg"> Panier </a>
                </li>

                


                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle btn  " href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                        <img id="iconUser" src="assets/img/user.png">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                        <a class="dropdown-item  " href="#"> Mon Profil </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="deconnexion.php">Déconnexion</a>
                    </div>
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
                <!-- User account -->
                <!--
<div class="pull-right">

<div class="dropdown user-account">
<a class="dropdown-toggle" href="#" data-toggle="dropdown">
<img src="img/user.png" width='50' alt="avatar">
</a>

<ul class="dropdown-menu dropdown-menu-right">
<li><a href="EditProfile.php">Edit Profile</a></li>
<li><a href="deconnexion.php">Logout</a></li>
</ul>
</div>

</div>
-->
                <!-- END User account -->


            </ul>
        </div>
    </nav>

</div>

