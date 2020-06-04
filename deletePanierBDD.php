

<?php
include_once("assets/db/connexiondb.php");
$qq = explode('-',$_GET['qq']);
// id du boug
$idboug = intval($qq[0]);$idbeat = intval($qq[1]);

$ok = true;

if (($idboug < 1)){ // si pas positif et si pas chiffre
    $ok = false;
} 
if (($idbeat < 1)){
    $ok = false;
} 

{ // ensuite on verifie si ce beat existe
    $req = $BDD->prepare("SELECT id
                            FROM panier
                            WHERE panier_user_id = ? AND panier_beat_id = ?
                                ");
    $req->execute(array($idboug,$idbeat));
    $p = $req->fetch();

    if(!isset($p['id'])){
        $ok = false;
        echo "Cette beat existe pas";
    }
}

if($ok){

    $req = $BDD->prepare("DELETE FROM panier 
 WHERE panier_user_id = ? AND panier_beat_id = ?"); 
    $req->execute(array($idboug,$idbeat));

    echo "*** deletePanier ***";
}

?>
