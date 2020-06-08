<?php
include_once("assets/db/connexiondb.php");
$qq = explode('-',$_GET['qq']);


$idboug = intval($qq[0]);$idbeat = intval($qq[1]);

$ok = true;
print_r($qq);
//*** Verification du beat
$req = $BDD->prepare("SELECT beat_title 
                            FROM beat
                            WHERE beat_id = ?");
$req->execute(array($idbeat));
$verif_b = $req->fetch();

    //*** Verification du boug
$req = $BDD->prepare("SELECT user_pseudo 
                            FROM user
                            WHERE user_id = ?");
$req->execute(array($idboug));
$verif_bg = $req->fetch();

var_dump($verif_bg);
var_dump($verif_b);
if(isset($verif_b['beat_title']) && isset($verif_bg['user_pseudo'])){


    // ensuite on verifie si ce beat est acheté par le  boug
    $req = $BDD->prepare("SELECT id
                            FROM vente
                            WHERE vente_user_id = ? AND vente_beat_id = ? ");
    $req->execute(array($idboug,$idbeat));
    $p = $req->fetch();

    if(isset($p['id'])){
        $ok = false;
        echo "Cette beat est deja achté par le boug !";
    }


    if($ok){

        $req = $BDD->prepare("INSERT INTO vente (vente_beat_id,vente_user_id) VALUES (?, ?)"); 
        $req->execute(array($idbeat,$idboug));

        echo "*** acheté ***";
    }

}else {
    echo "#beatexistepas# ou #bougexistepas# ";
}
?>