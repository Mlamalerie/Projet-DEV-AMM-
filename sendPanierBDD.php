<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>

        <?php
        $qq = explode('-',$_GET['qq']);
        // id du boug
        $idboug = intval($qq[0]);

        // concatenation 
        $idbeat = intval($qq[1]);
        $ok = true;

        if (($idboug < 1)){ // si pas positif et si pas chiffre
            $ok = false;
        } 
        if (($idbeat < 1)){
            $ok = false;
        } 

        if($ok){
            include_once("assets/db/connexiondb.php");
            $req = $BDD->prepare("INSERT INTO panier (panier_beat_id,panier_user_id) VALUES (?, ?)"); 

            $req->execute(array($idbeat,$idboug));

            echo "*** sendPanier ***";
        }

        ?>
    </body>
</html>