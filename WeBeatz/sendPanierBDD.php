

<?php
include_once("assets/db/connexiondb.php");
$qq = explode('-',$_GET['qq']);

$idboug = intval($qq[0]);
$idbeat = intval($qq[1]);

$ok = true;

//*** Verification du boug
$req = $BDD->prepare("SELECT user_pseudo 
                            FROM user
                            WHERE user_id = ?");
$req->execute(array($idboug));
$verif_bg = $req->fetch();

if(!isset($verif_bg['user_pseudo'])){  
    echo "#bougexistepas#";
    $ok = false;

}


//*** Verification du beat
$req = $BDD->prepare("SELECT beat_title 
                            FROM beat
                            WHERE beat_id = ?");
$req->execute(array($idbeat));
$verif_b = $req->fetch();

if(!isset($verif_b['beat_title'])){  
    echo "#beatexistepas#";
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
        echo "Cette beat est déjà dans le panier !";
    }
}

if($ok){

    $req = $BDD->prepare("INSERT INTO panier (panier_beat_id,panier_user_id) VALUES (?, ?)"); 
    $req->execute(array($idbeat,$idboug));

    echo "*** sendPanier ***";
}

?>
