<?php
session_start();
$_SESSION['ici_index_bool'] = false;

include('assets/db/connexiondb.php');
/*active ça si tu veux pas te voir dans la liste si t'es connecté*/
if(isset($_SESSION['user_id'])){

     $req =$BDD->prepare("SELECT * FROM messagerie");
    $req->execute(array());
} 
else{
 
    $req =$BDD->prepare("SELECT * FROM messagerie");
    $req->execute();
}

$afficher_messages=$req->fetchAll();

$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {

    $okconnectey = true;
} 

print_r($_SESSION);



if(isset($_POST['inputOption'])) {
    $id_message=$_POST['inputOption_message_id'];
    $ok = true;


    $req = $BDD->prepare("SELECT message 
                            FROM messagerie
                            WHERE lu = 1");
    $req->execute(array());
    $verif_u = $req->fetch();
    if(!isset($verif_u['message'])){ 
        $ok = false;
        echo '###';
    }
    else if($_POST['inputOption']== "suppr"){
        if($ok){
             $req = $BDD->prepare("DELETE FROM messagerie
            WHERE id = ?"); 
            $req->execute(array($id_message));
            header('Location: all-messages');
            exit;
            
        }
    }
    else if($_POST['inputOption']== "signaler"){/*si l'utilisateur choisit de supprimer le message signalé*/
        if($ok){
             $req = $BDD->prepare("DELETE FROM messagerie
            WHERE id = ?"); 
            $req->execute(array($id_message));
            header('Location: all-messages');
            exit;
            
        }
    }
    else if($_POST['inputOption']== "annuler"){/*si l'utilisateur choisit d'annuler le signalement d'un message*/
        if($ok){
             $req = $BDD->prepare("DELETE FROM messagerie_signal
            WHERE message_id = ?"); 
            $req->execute(array($id_message));
            header('Location: all-messages');
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
        <title>All Messages</title>
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
                                        <th class="text-center align-middle">Messages</th>
                                        <th class="text-center align-middle" >Expéditeur</th>  

                                        <th class="text-center align-middle" >Destinataire</th>
                                        <th class="text-center align-middle" >Date d'envoi du message</th>
                                        <th class="text-center align-middle" >Signalement</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                    foreach($afficher_messages as $am){
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <div class="row"> 
                                                <a href="messagerie.php?id=<?= $am['id_from'] ?>"> <button class="btn">Accéder à la messagerie</button></a>                                                                           
                                                <button class="btn" data-toggle="modal" data-target="#desac_modal" onclick="goInputOption(this,'<?= $am['id'] ?>','<?= $am['message']?>')" value="suppr"><i class='fa fa-trash'></i></button>
  
                                            </div>
                                        </td>
                                        <td  class="text-center align-middle">
                                            <?=$am['message']?>
                                        </td>  
                                        <td class="text-center align-middle">
                                           <?php
                                            $req = $BDD->prepare("SELECT user_pseudo
                                                                FROM user
                                                                WHERE user_id = ?");
                                            $req->execute(array($am['id_from']));

                                            $af=$req->fetch(); 

                                            ?>
                                            <a href="profils.php?profil_id=<?=$am['id_from']?>"><span><?=$af['user_pseudo']?></span></a>
                                        </td>
                                        
                                        <?php
                                            $req = $BDD->prepare("SELECT user_pseudo
                                                                FROM user
                                                                WHERE user_id = ?");
                                            $req->execute(array($am['id_to']));

                                            $at=$req->fetch(); 

                                            ?>
                                        <td class="text-center align-middle">
                                           <a href="profils.php?profil_id=<?=$am['id_to']?>"><span><?=$at['user_pseudo']?></span></a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span><?=$am['date_message']?></span>
                                        </td>
                                        <td>
                                            <?php
                                                $req1 =$BDD->prepare("SELECT *
                                                                    FROM messagerie_signal
                                                                    WHERE message_id = ?
                                                                    ");
                                            /*on prend tous les id des messages signalés qui ont le même id dans la messagerie*/
                                                 $req1->execute(array($am['id']));
                                                 $s=$req1->fetch();
                                        
                                                if(isset($s['id'])){
                                            ?>
                                            <!--  On affiche cet icon quand un message a été signalé  -->
                                            <button class="btn" data-toggle="modal" data-target="#desac_modal" onclick="goInputOption(this,'<?= $am['id'] ?>','<?= $af['user_pseudo']?>')" value="signaler"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></button>
                                            
                                            <!--  On affiche cet icon pour enlever le signalement d'un message -->
                                            <button class="btn" data-toggle="modal" data-target="#desac_modal" onclick="goInputOption(this,'<?= $am['id'] ?>','<?= $af['user_pseudo']?>')" value="annuler"><i class="fas fa-undo" style="color:red"></i></button>
                                           
                                            <?php
                                                }
                                                else{
                                                    echo "Rien à signaler";
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php 
                                    }
                                    ?>

                                </tbody>
                                 <script type="text/javascript">
                                            function goInputOption(bay,idd,blaz){
                                                let mode = bay.value;
                                                console.log(mode,idd);

                                                var p = document.getElementById('phraseConfirm');
                                                var iO = document.getElementById('inputOption');
                                                var iO_id = document.getElementById('inputOption_message_id');

                                                iO.value = mode;
                                                iO_id.value = idd;
                                                
                                                if (mode == 'suppr'){
                                                    p.innerHTML = "supprimer le message " + blaz + " ?";   
                                                }
                                                if (mode == 'signaler'){
                                                    p.innerHTML = "supprimer le message signalé de " + blaz + " ou <a href='all-utilisateurs.php'>désactiver son compte?</a>";   
                                                }
                                                if(mode == 'annuler'){
                                                    p.innerHTML = "annuler le signalement du message " + blaz + " ?";
                                                }
                                                
                                                console.log(iO,iO_id);
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
                                                <input type="hidden" name="inputOption_message_id" id="inputOption_message_id">
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
        require_once('assets/skeleton/endLinkScripts.php');
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