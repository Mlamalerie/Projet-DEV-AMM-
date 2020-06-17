<?php 
$jesuissurindex = $_SESSION['ici_index_bool']; 
$reqG = $BDD->prepare("SELECT genre_nom,id FROM genre  ORDER BY genre_nom ASC");
$reqG->execute(array());
$listeGenres = $reqG->fetchAll();


?>

<div class="boxnav">
    <nav id='LANAVBAR' class="navbar navbar-expand-lg navbar-light fixed-top" >
        <a class="navbar-brand ml-2" href="#">
            <?php if (!$jesuissurindex){ ?>
            <img src='assets/img/icon/compact-disc.svg' width="35" height="35" alt="">
            <?php } else { ?>
            <img src='assets/img/icon/compact-disc2.svg' width="35" height="35" alt="">
            <?php } ?>
        </a>
        <a class="navbar-brand mr-3" href="index.php">WeBeatz</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> 
        </button>
        <!--   Barre de recherche     -->
        <!--   Barre de recherche     -->
        <?php if (!$jesuissurindex) { ?>
        <div class="ml-3">
            <form id="searchform" method="get" action="search.php" class="form-inline nav-brand " style="margin-bottom: 0px;">


                <div class="form-group row mr-2">
                    <input id='searchbar'
                           type="text" placeholder="Recherchez vos musiques, artistes..." name="q" aria-describedby="button-search" class="form-control rounded-pill form-control-underlined " value="<?php if(!empty($_GET['q']) && isset($_GET['q']) ) echo $_GET['q']; ?>">
                    <div class="input-group-append">
                        <select name="Type" class=" rounded-pill btn-block shadow-sm custom-select" onchange='submit()'>

                           <option value="beats" class="dropdown-item"  <?php if (!empty($_GET['Type']) && isset($_GET['Type']) && $_GET['Type'] == 'beats' )  { ?> selected <?php } ?>>All beats</option> 


                       <option value="users" class="dropdown-item"  <?php if (!empty($_GET['Type']) && isset($_GET['Type']) && $_GET['Type'] == 'users' )  { ?> selected <?php } ?>>All users</option>


                        </select>
                    </div>

                </div>

                <!--

<button onclick="goSearch()" id="button-search" type="button" class="btn btn-link text-info search_icon"><i class="fa fa-search"></i></button>
<input id='searchbar'
type="text" placeholder="Recherchez vos musiques, artistes..." name="q" aria-describedby="button-search" class="form-control searchbar bg-none border-0">
-->
            </form>
        </div>
        <?php } ?>

        <!--            Menu droite -->
        <!--            Menu droite -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-md-auto" >
                <?php if(!$jesuissurindex) { ?>


                <!-- Megamenu-->
                <li class="nav-item dropdown megamenu">
                    <a id="megamneu" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-uppercase">Beats</a>
                    <div id='div1megamega' aria-labelledby="megamneu" class="dropdown-menu border-0 p-0 m-0">
                        <div class="container mx-auto">
                            <div class="row bg-dark rounded-0 m-0 shadow-sm w-100">
                                <div class="col-lg-7 col-xl-8 contenant-mega-1" >
                                    <div class="p-4">
                                        <div class="row mb-1">
                                            <div class="col-lg-4 border-right border-secondary">

                                                <ul class="list-unstyled text-left">
                                                    <li class="nav-item"><a href="search.php?Type=beats&sort=vente" class="nav-link text-small pb-0">Top Ventes Beats</a></li>

                                                    <li class="nav-item"><a href="http://localhost/Projet/search.php?Type=beats&sort=nouveaute" class="nav-link text-small pb-0 ">Récemment ajouté </a></li>
                                                    <li class="nav-item"><a href="search.php?Type=beats&Price=free" class="nav-link text-small pb-0 ">Free Beats</a></li>
                                                    <li class="nav-item"><a href="http://localhost/Projet/search.php?Type=users&sort=seller" class="nav-link text-small pb-0">Top Vendeurs</a></li>

                                                </ul>
                                            </div>
                                            <div class="col-lg-4 border-right border-secondary">
                                                <h6 class="font-weight-bold text-uppercase">Genres</h6>
                                                <ul class="list-unstyled text-left"> <?php 
                    
                    foreach($listeGenres as $gr){
                        if($gr['id'] != 6 && $gr['id'] != 0 && $gr['id'] != 12 && $gr['id'] != 15 && $gr['id'] != 4 && $gr['id'] != 6) { ?>

                                                    <li class="nav-item"><a class="dropdown-item  " href="search.php?Type=beats&Genre=<?= $gr['id']?>"><?= $gr['genre_nom']?></a></li> 
  <?php
                                                             }}
                        ?>

                                                </ul>
                                            </div>
                                            <div class="col-lg-4">
                                                <h6 class="font-weight-bold text-uppercase">Type Beat</h6>
                                                <ul class="list-unstyled text-left">
                                                  <li class="nav-item"><a href="search.php?Type=beats&q=BlackD" class="nav-link text-small pb-0 ">BlackD</a></li>
                                                   <li class="nav-item"><a href="search.php?Type=beats&q=Cheu-b" class="nav-link text-small pb-0 ">Cheu-B</a></li>
                                                   <li class="nav-item"><a href="search.php?Type=beats&q=Kepler" class="nav-link text-small pb-0 ">Kepler</a></li>
                                                    <li class="nav-item"><a href="search.php?Type=beats&q=Leto" class="nav-link text-small pb-0 ">Leto</a></li>         
                                                    <li class="nav-item"><a href="search.php?Type=beats&q=Wanabilini" class="nav-link text-small pb-0 ">Wanabilini</a></li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-xl-4 px-0 d-none d-lg-block contenant-mega-2" style="background: center center url(https://res.cloudinary.com/mhmd/image/upload/v1556990826/mega_bmtcdb.png)no-repeat; background-size: cover;"></div>
                            </div>
                        </div>
                    </div>
                </li>

                <?php } ?>
                <?php
                // si je detecte une connexion alors


                if($okconnectey) {
                ?>

                <li class="nav-item ">
                    <a class="nav-link btn" href="test_zone.php">Test_Zone<span class="sr-only">(current)</span></a>
                </li>



                <?php if(!$jesuissurindex) { ?>



                <!-- UPLOADER -->
                <li class="nav-item">
                    <button class="nav-link btn" href="#" data-toggle="modal" data-target="#modalUpload"><img id="iconUpload" src="assets/img/icon/ui.svg"> Uploader </button>
                </li>
                <?php } ?>

                <?php if(!$jesuissurindex) { ?>
                <li class="nav-item dropdown no-arrow mx-1" >
                    <a class="nav-link dropdown-toggle dropdown-toggle-pointpoint" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img id="iconPanier" src="assets/img/icon/chat-box.svg">

                        <!-- Counter - Messages -->
                        <span id="span_nb_mess" class="badge badge-danger rounded-pill "></span>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div id="dropMess" class=" dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Mes messages
                        </h6>
                        <?php 
                    $req1=$BDD->prepare("SELECT * FROM relation WHERE statut = ?");
                    $req1->execute(array(3));   //pour enlever les bloqués de la messagerie

                    $relation_bloq=$req1->fetchAll(); 


                    include('assets/functions/date-fct.php');
                    $req = $BDD->prepare("SELECT * FROM (
                    SELECT *
                            FROM messagerie

                            WHERE id_to = ? AND lu = 0
                            ) base
                            ORDER BY date_message DESC
                             LIMIT 5");
                    $req->execute(array($_SESSION['user_id']));
                    $resuMESS = $req->fetchAll();


                    $nbmess = 0;
                    foreach($resuMESS as $m) {
                        ?>

                        <?php  $req = $BDD->prepare("SELECT *
                            FROM user
                            WHERE user_id = ?");
                        $req->execute(array($m['id_from']));
                        $user = $req->fetch();



                        $okaffichemess = true;

                        foreach($relation_bloq as $rb) {

                            if($m['id_from'] == $rb['id_receveur'] ||  $m['id_from'] == $rb['id_demandeur']    ) {

                                $okaffichemess = false;
                            }
                        }


                        if($okaffichemess){ 
                            $nbmess++;

                            $date1 = new DateTime( $m['date_message']);
                            $date2 = new DateTime(date("Y-m-d H:i:s"));
                            $recent = dateDiff($date1, $date2);

                        ?>
                        <a class="dropdown-item d-flex align-items-center" href="message.php?profil_id=<?= $m['id_from'] ?>-<?= $_SESSION['user_id']?>">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" width="30" src="<?= $user['user_image']?>" alt="">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-truncate"><?= $m['message']?></div>

                                <div class="small text-gray-500"><?= $user['user_pseudo']?> · <?=$recent?></div>
                            </div>
                        </a>
                        <?php } 
                    }
                        ?>


                        <a class="dropdown-item text-center small text-gray-500" href="messagerie.php?id=<?= $_SESSION['user_id']?>">Read More Messages</a>
                    </div>
                    <script>
                        refreshNbMess();
                        function refreshNbMess() {

                            let ici = document.getElementById("span_nb_mess");

                            if (ici != null) {
                                let nb = <?= $nbmess ?>;

                                console.log(nb,ici);
                                if (nb != 0) {
                                    ici.innerHTML = nb;

                                } else {
                                    ici.innerHTML = "";
                                }

                            }
                        }
                    </script> 
                </li>
                <?php } ?>

                <div class="topbar-divider d-none d-sm-block"></div>





                <!-- DEROULANT PROFIL-->
                <?php 
                    if($_SESSION['user_role']==0){   
                ?>

                <li class="nav-item dropdown no-arrow ">
                    <a class="nav-link dropdown-toggle btn  " href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >

                        <span class="mr-2 d-none d-lg-inline "><i class="fa fa-lock mr-1 text-gray-400"></i>Admin</span>

                    </a>
                    <div class="dropdown-menu shadow animated--grow-in " aria-labelledby="navbarDropdownMenuLink">

                        <a class="dropdown-item" href="all-utilisateurs.php"> <i class="fa fa-users mr-1 text-gray-400" aria-hidden="true"></i>  All-Users</a>
                        <a class="dropdown-item" href="all-beats.php"> <i class="fa fa-music mr-1 text-gray-400" aria-hidden="true"></i>  All-Beats</a>
                        <a class="dropdown-item" href="all-messages.php"> <i class="fa fa-comments mr-1 text-gray-400" aria-hidden="true"></i>  All-Messages</a>

                    </div>

                </li>

                <?php
                    }
                ?>




                <!-- DEROULANT PROFIL-->
                <li class="nav-item dropdown no-arrow ">
                    <a class="nav-link dropdown-toggle btn  " href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                        <span class="mr-2 d-none d-lg-inline "><?= $_SESSION['user_pseudo'] ?></span> <img id="iconUser" src="assets/img/user.png">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in " aria-labelledby="navbarDropdownMenuLink">


                        <a class="dropdown-item" href="profil.php?profil_id=<?= $_SESSION['user_id']?>"><i class="fas fa-user fa-sm fa-fw mr-1 text-gray-400"></i> Mon Profil </a>

                        <a class="dropdown-item" href="my-beats.php"> <i class="fas fa-compact-disc mr-1 text-gray-400"></i> Mes Tracks </a>
                        
<!--                        <a class="dropdown-item" href="privee.php?profil_id=<?= $_SESSION['user_id']?>"><i class="fas fa-user-shield mr-1 text-gray-400"></i> Mes Informations Privées </a><-->  
                        <a class="dropdown-item" href="histo-ventes.php"><i class="fas fa-search-dollar mr-1 text-gray-400"></i>Mon historique de ventes </a>


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
                    
                    foreach($listeGenres as $gr){
                        if($gr['id'] != 6 && $gr['id'] != 0) { ?>
                        <a class="dropdown-item  " href="search.php?Type=beats&Genre=<?= $gr['id']?>"><?= $gr['genre_nom']?></a>
                        <?php
                                                             }}
                        ?>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="search.php?Type=beats&Price=free">Free Beats</a>
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
            <div id="modal_footer_panier" class="modal-footer" >
            </div>


            <?php require_once('assets/functions/js-panier.php'); ?>
            <script>

                function affichePasserCommande(ok){

                    let aa = document.getElementById("passercommandes");
                    let mdf = document.getElementById("modal_footer_panier");


                    console.log('affPasserComm',mdf );
                    okyarien = false;
                    if(mdf.children.length == 0){
                        okyarien = true;
                    }

                    if(ok){

                        let a = document.createElement('a');
                        a.setAttribute('href','commande.php');
                        a.setAttribute('id','passercommandes');
                        a.setAttribute('class','w-100');
                        let btn = document.createElement('button');
                        btn.setAttribute('type','button');
                        btn.setAttribute('class','btn btn-primary w-100 btn-block p-2 rounded-pill shadow-sm');
                        btn.innerHTML = "Passer Commandes"
                        a.appendChild(btn);
                        console.log(a);

                        if( okyarien){
                            mdf.appendChild(a);
                        }



                    }else {
                        let a = document.getElementById("passercommandes");

                        if(!okyarien){
                            let ca = a.parentNode;

                            ca.removeChild(a);
                        }

                    }

                }




                refreshNbPanier() ;

                function refreshNbPanier() {
                    let tbody = document.getElementById("tbodypanier");
                    let ici = document.getElementById("span_nb_panier");

                    if (ici != null) {
                        let nb = tbody.children.length;
                        console.log(nb,ici);

                        console.log(nb,ici);
                        if (nb != 0) {
                            ici.innerHTML = nb;
                            affichePasserCommande(true);
                        } else {
                            ici.innerHTML = "";

                            affichePasserCommande(false);
                        }
                        console.log(nb,ici);
                    }
                }



            </script>                
        </div>
    </div>
</div>

<!--   *************************************************************  -->
<!--   ************************** MODAL UPLOAD  **************************  -->


<div  class=" modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="modalUploadTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Uploader</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id='formUpload1' action="edit-newupload.php" method="post" enctype="multipart/form-data">

                <div class="modal-body" id="modalBodyUpload">

                    <!-- FICHIER -->
                    <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">

                        <input accept=".mp3, .wav" onchange="gogoUpload();" id="uploadAudio" name="uploadAudio" type="file" class="form-control border-0">


                        <label id="uploadAudio-label" for="uploadAudio" class="font-weight-light text-muted">Choose Audio file</label>
                        <div class="input-group-append">

                            <label for="uploadAudio" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i>
                                <small class="text-uppercase font-weight-bold text-muted">Choose file</small>
                            </label>

                        </div>

                        <script>
                            var inputAudio = document.getElementById( 'uploadAudio' );
                            var infoAreaAudio = document.getElementById('uploadAudio-label');


                            inputAudio.addEventListener( 'change', showFileNameAudio );

                            function showFileNameAudio( event ) {
                                var inputAudio = event.srcElement;
                                var fileName = inputAudio.files[0].name;
                                infoAreaAudio.innerHTML = ': ' + fileName;

                            }

                        </script>

                    </div>


                    <span id="spanErreurUpload" class="text-danger d-none"> </span>

                    <br>

                </div>
                <!--
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


</div>
-->
            </form>
            <?php 


            ?>
            <script>


                function gogoUpload(){

                    let submit = document.getElementById('submit_upload');

                    let upload = document.getElementById("uploadAudio").value.split('.');
                    let ext = upload[upload.length - 1].toLowerCase();
                    let erreurUpload = document.getElementById('spanErreurUpload');
                    //                                console.log(upload.length,ext);

                    //** UPLOADER FICHIER AUDIO
                    formatAudio = ["mp3","wav"];
                    okaffichesubmit = true;
                    if (formatAudio.indexOf(ext) == -1 ) { // si pas un fichier audio
                        okaffichesubmit = false;
                        if(upload.length < 2) { 
                            erreurUpload.classList.add("d-none"); //ne pas afficher l'erreur si rien a été uploader
                        } else {
                            erreurUpload.classList.remove("d-none");
                            erreurUpload.innerHTML = "Ce n'est pas un audio";
                        }

                    } else { // si bien audio alors
                        erreurUpload.classList.add("d-none"); // pas afficher message d'erreur
                        //                                    console.log("**",erreur);
                    }


                    let ici = document.getElementById('modalBodyUpload');
                    let btn = document.getElementById('submit_upload');
                    console.log("$",btn);
                    if( okaffichesubmit) {


                        if (btn == null) {

                            //                        let btn = document.createElement('input');
                            //                        btn.setAttribute('id','submit_upload');
                            //                        btn.setAttribute('name','submit_upload');
                            //                        btn.setAttribute('onclick',"document.getElementById('formUpload1').submit();");
                            //                        btn.setAttribute('class',"btn btn-primary");
                            //                        btn.setAttribute('value',"uploadMoiCa");
                            //                        ici.appendChild(btn);
                            document.getElementById('formUpload1').submit();
                        }


                    } else {

                        if (btn != null) {
                            ici.removeChild(btn);
                        }

                    }



                }

            </script>

        </div>
    </div>
</div>





<?php } ?>




