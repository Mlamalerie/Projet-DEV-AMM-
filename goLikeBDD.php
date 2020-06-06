<?php
include_once("assets/db/connexiondb.php");
$qq = explode('-',$_GET['qq']);


$mode = $qq[0]; $idboug = intval($qq[1]);$idbeat = intval($qq[2]);

$ok = true;

//*** verif mode
if($mode != 'likelike' && $mode != "dislikedislike"){  
    echo "#modeexistepas#";
    $ok = false;

}

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


if($mode == "likelike") {
{ // ensuite on verifie si ce beat est deja like
    $req = $BDD->prepare("SELECT id
                            FROM likelike
                            WHERE like_user_id = ? AND like_beat_id = ?
                                ");
    $req->execute(array($idboug,$idbeat));
    $p = $req->fetch();

    if(isset($p['id'])){
        $ok = false;
        echo "Cette beat est deja liké !";
    }
}

    if($ok){

        $req = $BDD->prepare("INSERT INTO likelike (like_beat_id,like_user_id) VALUES (?, ?)"); 
        $req->execute(array($idbeat,$idboug));

        echo "*** like ***";
    }
}else if ($mode == "dislikedislike") {
    { // ensuite on verifie si ce beat est deja like
    $req = $BDD->prepare("SELECT id
                            FROM likelike
                            WHERE like_user_id = ? AND like_beat_id = ?
                                ");
    $req->execute(array($idboug,$idbeat));
    $p = $req->fetch();

    if(!isset($p['id'])){
        $ok = false;
        echo "Cette beat n'est pas liké donc tu veux quoi ?";
    }
}

    if($ok){

        $req = $BDD->prepare("DELETE FROM likelike 
 WHERE like_user_id = ? AND like_beat_id = ?"); 
        $req->execute(array($idboug,$idbeat));

        echo "*** dislike ***";
    }
}
?>