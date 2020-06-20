<?php
session_start();
$_SESSION['ici_index_bool'] = false;

include('assets/db/connexiondb.php');



$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    $okconnectey = true;

    if($_SESSION['user_role'] != 0){
        echo "<script> history.go(-1); </script>";
        exit;

    }
} else {
    header('Location: index.php');
            exit;
}

print_r($_POST);

/*active ça si tu veux pas te voir dans la liste si t'es connecté*/
if($okconnectey){
    $req =$BDD->prepare("SELECT * FROM user");
    $req->execute(array());
} 
else{
    $req =$BDD->prepare("SELECT * FROM user");
    $req->execute();
}
$afficher_membres=$req->fetchAll();


if(isset($_POST['inputOption'])) {
    $id_user=$_POST['inputOption_user_id'];
    $ok = true;


    //*** Verification du id
    $req = $BDD->prepare("SELECT user_pseudo 
                            FROM user
                            WHERE user_id = ?");
    $req->execute(array($id_user));
    $verif_u = $req->fetch();
    if(!isset($verif_u['user_pseudo'])){ 
        $ok = false;
        echo '###';
    }


    if($_POST['inputOption']== "desac") {

        if($ok) {
            $req = $BDD->prepare("UPDATE user
            SET user_statut = ?
            WHERE user_id = ?"); 
            $req->execute(array(0,$id_user));

            
             header('Location: all-utilisateurs');

            exit;
        }


    }
    else if($_POST['inputOption']== "act") {
        if($ok) {
            $req = $BDD->prepare("UPDATE user
            SET user_statut = ?
            WHERE user_id = ?"); 
            $req->execute(array(1,$id_user));

             header('Location: all-utilisateurs');

            exit;
        }

    }
    else if($_POST['inputOption']== "suppr"){
        if($ok){
            $req = $BDD->prepare("DELETE FROM user
            WHERE user_id = ?"); 
            $req->execute(array($id_user));
            header('Location: all-utilisateurs');
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

        <!--    Lien pour défiler les pages    -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">


        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
        <link rel="stylesheet" type="text/css" src="assets/css/all-utilisateurs.css">
        <title>All Users</title>
        <style>
            tr {
                height: 5px;
                padding: none;

            }
            tbody tr td{
                font-size: 10px;
                height: 5px;
            }
            thead tr th{
                font-size: 15px;
            }
            body{
                background-image: url(assets/img/space.jpg);
            }
        </style>
    </head>
    <body>
        <!--   ************************** NAVBAR  **************************  -->
        <?php
            require_once('assets/skeleton/navbar.php');
        ?>
        <br/><br/><br/><br/>



        <div class="row py-5">
            <div class="col-lg-10 mx-auto">
                <div class="card rounded shadow border-0">
                    <div class="card-body p-5 bg-white rounded">
                        <div class="table-responsive">
                            <table id="example" style="width:100%" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle" >Options</th>
                                        <th class="text-center align-middle">Image</th>
                                        <th class="text-center align-middle" >Role</th>  

                                        <th class="text-center align-middle" >Pseudo</th>
                                        <th class="text-center align-middle" >E-Mail</th>
                                        <th class="text-center align-middle" >Date d'inscription</th>

                                        <th class="text-center align-middle" >Date de naissance</th>
                                        <th class="text-center align-middle" >Sexe</th>

                                        <th class="text-center align-middle" >Pays</th>
                                        <th class="text-center align-middle" >Ville</th>

                                        <th class="text-center align-middle" >Statut</th>
                                        <th class="text-center align-middle" >Nombre de follow(s)</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                    foreach($afficher_membres as $am){
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle">


                                            <div  class="btn-group mr-2" role="group" >

                                                <a href="edit-profil.php?profil_id=<?= $am['user_id'] ?>" title="Modifier les informations de <?= $am['user_pseudo']?>"><button class="btn"><span class="text-dark" ><i class="fas fa-pencil-alt"></i></span></button></a>                                           

                                                <?php 
                                        if($am['user_id']!=$_SESSION['user_id']){
                                                ?>
                                                <?php 
                                            if($am['user_statut'] == 1) {
                                                ?>
                                                <a class="btn" title="Désactiver <?= $am['user_pseudo']?>" data-toggle="modal" data-target="#desac_modal" onclick="goInputOption(this,'desac','<?= $am['user_id'] ?>', '<?= $am['user_pseudo']?>')" ><span class="text-dark" ><i class="fas fa-lightbulb"></i></span></a>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                <a class="btn" title="RéActiver <?= $am['user_pseudo']?>" data-toggle="modal" data-target="#desac_modal" onclick="goInputOption(this,'act','<?= $am['user_id'] ?>', '<?= $am['user_pseudo']?>')" ><span class="text-dark" ><i class="far fa-lightbulb"></i></span></a>
                                                <?php
                                            }
                                                ?>

                                                <a class="btn" title="Supprimer <?= $am['user_pseudo']?>" data-toggle="modal" data-target="#desac_modal" onclick="goInputOption(this,'suppr','<?= $am['user_id'] ?>','<?= $am['user_pseudo']?>')" ><span class="text-dark"><i class='fa fa-trash'></i></span>
                                                </a>
                                                <?php
                                        }
                                                ?>

                                            </div>

                                        </td>
                                        <td  class="text-center align-middle">
                                            <img src="<?=$am['user_image']?>" style="height : 25px; width : 25px;" class="img-fluid mb-3 roundedImage shadow-sm">
                                        </td>  
                                        <td class="text-center align-middle">
                                            <span><?=$am['user_role']?></span>
                                        </td>

                                        <td class="text-center align-middle">
                                            <a href="profil.php?profil_id=<?= $am['user_id'] ?>"><span><?=$am['user_pseudo']?></span></a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span><?=$am['user_email']?></span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span><?=$am['user_dateinscription']?></span>
                                        </td>

                                        <td class="text-center align-middle">
                                            <span><?=$am['user_datenaissance']?></span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span><?=$am['user_sexe']?></span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span><?=$am['user_pays']?></span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span><?=$am['user_ville']?></span>
                                        </td>

                                        <td class="text-center align-middle">
                                            <span><?=$am['user_statut']?></span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php
                                                    $req1 = $BDD->prepare("SELECT *
                                                                FROM relation
                                                                WHERE id_receveur = ? AND statut = 1");
                                        $req1->execute(array($am['user_id']));

                                        $nb_follow=0;

                                        $resuRELA = $req1->fetchAll();

                                        foreach($resuRELA as $rr){

                                            foreach($rr as $key => $value){

                                                if($key =='statut' && $value== 1){

                                                    $nb_follow++;
                                                }   
                                            } 
                                        }
                                        echo "<span>".$nb_follow."</span>";

                                            ?>
                                        </td>
                                    </tr>
                                    <?php 
                                    }
                                    ?>

                                </tbody>
                                <script type="text/javascript">
                                            function goInputOption(bay,mode,idd,blaz){
                                               
                        
                                                var p = document.getElementById('phraseConfirm');
                                                var iO = document.getElementById('inputOption');
                                                var iO_id = document.getElementById('inputOption_user_id');

                                                iO.value = mode;
                                                iO_id.value = idd;

                                                if(mode == 'desac' ) {
                                                    p.innerHTML = "desactiver le compte de " + blaz + " ?";
                                                } else if(mode == 'act' ) {
                                                    p.innerHTML = "activer le compte de " + blaz + " ?";
                                                }
                                                else if (mode == 'suppr'){
                                                    p.innerHTML = "supprimer le compte de " + blaz + " ?";   
                                                }
                                                
                                            } 
                                        </script>
                            </table>

                            <!-- Modal -->
                            <div class="modal fade" id="desac_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes vous sûr de vouloir <span id="phraseConfirm"></span>
                                            <form method="post" id="formOptionConfirm" action="">
                                                <input type="hidden" name="inputOption" id="inputOption">
                                                <input type="hidden" name="inputOption_user_id" id="inputOption_user_id">
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                                            <button onclick="document.getElementById('formOptionConfirm').submit()" type="button" class="btn btn-primary">Oui</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- END Modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--      SCRIPTS      -->
        <?php 
        require_once('assets/skeleton/endLinkScripts.html');
        ?>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> 
        <script type="text/javascript">
            $(function() {
                $(document).ready(function() {
                    $('#example').DataTable();
                });
            });
        </script>


    </body>
</html>