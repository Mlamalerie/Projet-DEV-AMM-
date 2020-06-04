

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

{ // ensuite on verifie si ce beat est deja dans panier
    $req = $BDD->prepare("SELECT id
                            FROM panier
                            WHERE panier_user_id = ? AND panier_beat_id = ?
                                ");
    $req->execute(array($idboug,$idbeat));
    $p = $req->fetch();

    if(isset($p['id'])){
        $ok = false;
        echo "Cette beat existe déjé !";
    }
}

if($ok){

    $req = $BDD->prepare("INSERT INTO panier (panier_beat_id,panier_user_id) VALUES (?, ?)"); 
    $req->execute(array($idbeat,$idboug));

    echo "*** sendPanier ***";
}

?>
