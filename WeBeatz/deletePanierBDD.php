

<?php
include_once("assets/db/connexiondb.php");
$qq = explode('-',$_GET['qq']);
// id du boug
$idboug = intval($qq[0]);
$idbeat = intval($qq[1]);

$ok = true;

{ // ensuite on verifie si ce beat et est dans le panier existe
    $req = $BDD->prepare("SELECT id
                            FROM panier
                            WHERE panier_user_id = ? AND panier_beat_id = ?
                                ");
    $req->execute(array($idboug,$idbeat));
    $p = $req->fetch();

    if(!isset($p['id'])){
        $ok = false;
        echo "Cette beat n'est pas dans le panier";
    }
}

if($ok){

    $req = $BDD->prepare("DELETE FROM panier 
 WHERE panier_user_id = ? AND panier_beat_id = ?"); 
    $req->execute(array($idboug,$idbeat));

    echo "*** deletePanier ***";
}

?>
