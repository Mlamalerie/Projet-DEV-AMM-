<div class="boxnav">
   <nav id='LANAVBAR' class="navbar navbar-expand-lg navbar-light fixed-top" >
    <a class="navbar-brand" href="#">
        <img src="https://getbootstrap.com/docs/4.4/assets/brand/bootstrap-solid.svg" width="30" height="30" alt="">
    </a>
    <a class="navbar-brand" href="index.php">WeBeats</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span> 
    </button>
    <!--            Menu droite -->
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-md-auto" >
            <?php
            // si je detecte une connexion alors
            if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo']) ){
            ?>
            <li class="nav-item">
                <a class="nav-link btn" href="deconnexion.php">Déconnexion</a>
            </li>


            <?php
            }else{
            ?>
            <li class="nav-item ">
                <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle btn  " href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    Genres
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item  " href="#">Afro Beats</a>
                    <a class="dropdown-item  " href="#" >Agressif</a>
                    <a class="dropdown-item  " href="#" >Drill</a>
                    <a class="dropdown-item  " href="#" >Electro</a>
                    <a class="dropdown-item  " href="#" >Trap</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item  " href="#">Free Beats</a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link btn" href="connexion.php">Se connecter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-danger rounded-pill btninscription btn" href="inscription.php">S'inscrire</a>
            </li>

            <?php
            }
            ?>


        </ul>
    </div>
</nav>

</div>

