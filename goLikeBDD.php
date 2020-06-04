<?php
include_once("assets/db/connexiondb.php");
$qq = explode('-',$_GET['qq']);


$mode = $qq[0]; $idboug = intval($qq[1]);$idbeat = intval($qq[2]);

$ok = true;

//if (($mode != 1)){ // si pas positif et si pas chiffre
//    $ok = false;
//} 
if (($idbeat < 1)){
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
        echo "Cette beat existe déjé !";
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
        echo "Cette beat existe pas !";
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