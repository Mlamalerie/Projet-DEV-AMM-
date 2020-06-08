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
        <a class="navbar-brand" href="index.php">WeBeatz</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> 
        </button>
        <!--   Barre de recherche     -->
        <!--   Barre de recherche     -->
        <?php if (!$jesuissurindex) { ?>

        <form id="searchform" method="get" action="search.php" class="form-inline nav-brand " style="margin-bottom: 0px;">


            <div class="form-group row mr-2">
                <input id='searchbar'
                       type="text" placeholder="Recherchez vos musiques, artistes..." name="q" aria-describedby="button-search" class="form-control rounded-pill form-control-underlined ">
                <div class="input-group-append">
                    <select name="Type" class=" rounded-pill btn-block shadow-sm custom-select" >

                        <option value="beats" class="dropdown-item">All beats</option>


                        <option value="users" class="dropdown-item">All users</option>


                    </select>
                </div>

            </div>
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
                <li class="nav-item dropdown no-arrow mx-1" >
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                   

                    include('assets/functions/datediff.php');
                    $req = $BDD->prepare("SELECT *
                            FROM messagerie
                            WHERE id_to = ?
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
                        <a class="dropdown-item d-flex align-items-center" href="message.php?profil_id=<?= $m['id_from'] ?>">
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


                        <a class="dropdown-item text-center small text-gray-500" href="messagerie.php">Read More Messages</a>
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
                <li class="nav-item dropdown no-arrow ">
                    <a class="nav-link dropdown-toggle btn  " href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                        <span class="mr-2 d-none d-lg-inline "><?= $_SESSION['user_pseudo'] ?></span> <img id="iconUser" src="assets/img/user.png">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in " aria-labelledby="navbarDropdownMenuLink">

                        <a class="dropdown-item  " href="profils.php?profil_id=<?= $_SESSION['user_id']?>"><i class="fas fa-user fa-sm fa-fw mr-1 text-gray-400"></i> Mon Profil </a>

                        <?php 
                    if($_SESSION['user_role']==0){   
                        ?>
                        <a class="dropdown-item  " href="all-utilisateurs.php"> <i class="fas fa-compact-disc mr-1 text-gray-400"></i> Admin Studio</a>
                        <?php
                    }
                        ?>



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




