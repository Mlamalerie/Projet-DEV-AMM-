

<?php
include_once("assets/db/connexiondb.php");
$qq = $_GET['qq'];


$idbeat = intval($qq);

$ok = true;

//*** Verification du beat
$req = $BDD->prepare("SELECT beat_title 
                            FROM beat
                            WHERE beat_id = ?");
$req->execute(array($idbeat));
$verif_b = $req->fetch();

if(!isset($verif_b['beat_title'])){  
    echo "#existepas#";
    $ok = false;

}



// compter nb like
$req = $BDD->prepare("SELECT id
                            FROM likelike
                            WHERE like_beat_id = ?
                                ");
$req->execute(array($idbeat));
$p = $req->fetchAll();


echo '#'.count($p);


if($ok){
    $nb = count($p);
    $req = $BDD->prepare("UPDATE beat
            SET beat_like = ?
            WHERE beat_id = ?"); 
    $req->execute(array($nb,$idbeat));

    echo "*** refreshlike ***";
} else {
    echo "erreur";
}



?>
