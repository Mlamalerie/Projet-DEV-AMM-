<?php
session_start();
$_SESSION['ici_index_bool'] = false;
include_once("assets/db/connexiondb.php");
$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])){

    $okconnectey = true;
} 

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Mon historique de ventes </title>
        <?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>
    </head>
    <body>
        <div class="row py-5">
            <div class="col-lg-10 mx-auto">
                <div class="card rounded shadow border-0">
                    <div class="card-body p-5 bg-white rounded">
                        <div class="table-responsive">
                            <table id="example" style="width:100%" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle" >Image</th>
                                        <th class="text-center align-middle">Titre</th>
                                        <th class="text-center align-middle" >Acheteur</th>
                                        <th class="text-center align-middle" >E-mail</th>
                                        <th class="text-center align-middle" >Date de la vente</th>
                                        <th class="text-center align-middle" >Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $RESRES=[];
                                    $req = $BDD->prepare("SELECT beat_id
                                                            FROM beat
                                                            WHERE beat_author_id = ? ");
                                    $req->execute(array($_SESSION['user_id']));
                                    $resuBEATSUSER = $req->fetchAll();
                                    foreach($resuBEATSUSER as $b) {

                                        $req = $BDD->prepare("SELECT *
                                                            FROM vente
                                                            WHERE vente_beat_id = ?
                                                            ORDER BY vente_date DESC");
                                        $req->execute(array($b['beat_id']));
                                        $resuBEATSVENTE= $req->fetchAll();
                        

                                        if(isset($resuBEATSVENTE)){
                                            $RESRES = array_merge($RESRES,$resuBEATSVENTE);
                                        }
                                    }
                                    foreach($RESRES as $p) {

                                        $req = $BDD->prepare("SELECT *
                                                                            FROM beat
                                                                            WHERE beat_id = ?");
                                        $req->execute(array($p['vente_beat_id']));
                                        $resuPAN = $req->fetchAll();
                                       

                                        foreach($resuPAN as $b) {
                                    ?> 
                                    <tr>
                                        <td class="text-center align-middle">
                                            <img src="<?=$b['beat_cover']?>" style="height : 25px; width : 25px;" class="img-fluid mb-3 roundedImage shadow-sm">
                                        </td>
                                        <td  class="text-center align-middle">
                                            <span><?=$b['beat_title']?></span>
                                        </td>  
                                        <?php
                                            $req1=$BDD->prepare("SELECT *
                                                                FROM user
                                                                WHERE user_id = ?");
                                            $req1->execute(array($p['vente_user_id']));
                                            $acheteur=$req1->fetch();
                                        ?>
                                        <td class="text-center align-middle">
                                            <span><?=$acheteur['user_pseudo']?></span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span><?=$acheteur['user_email']?></span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span><?=$p['vente_date']?></span>
                                        </td>   
                                        <td>
                                            <span><?=$b['beat_price']?></span>
                                        </td>    
                                    </tr>
                                    <?php 
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>