

<?php
include_once("assets/db/connexiondb.php");
$qq = $_GET['qq'];


$idbeat = intval($qq);

$ok = true;

//*** Verification du beat
$req = $BDD->prepare("SELECT beat_title,beat_author_id 
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
echo ' nblike#'.count($p);

// compter nb ventes
$req = $BDD->prepare("SELECT id
                            FROM vente
                            WHERE vente_beat_id = ?
                                ");
$req->execute(array($idbeat));
$v = $req->fetchAll();
echo ' nbvente#'.count($v);



// maj athor

$req = $BDD->prepare("SELECT user_pseudo
                            FROM user
                            WHERE user_id = ?
                                ");
$req->execute(array($verif_b['beat_author_id']));
$user = $req->fetch();

print_r($user);
if(!isset($user['user_pseudo'])){  
    echo "#authorexistepas#";
    $ok = false;

}



if($ok){
    //*
    $nb = count($p);
    $req = $BDD->prepare("UPDATE beat
            SET beat_like = ?
            WHERE beat_id = ?"); 
    $req->execute(array($nb,$idbeat));

    echo "<br> *** refreshlike ***";
    //*
    $nb = count($v);
    $req = $BDD->prepare("UPDATE beat
            SET beat_nbvente = ?
            WHERE beat_id = ?"); 
    $req->execute(array($nb,$idbeat));
    
     echo "<br> *** refreshnbvente ***";
    
   
    $req = $BDD->prepare("UPDATE beat
            SET beat_author = ?
            WHERE beat_id = ?"); 
    $req->execute(array($user['user_pseudo'],$idbeat));

    echo "<br> *** refreshAuthor***";
} else {
    echo "erreur";
}



?>
