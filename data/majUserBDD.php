<?php

include_once("../assets/db/connexiondb.php");

$ok = true;
$id = (int) $_GET['id'];

$req = $BDD->prepare("SELECT user_pseudo,user_image
                            FROM user
                            WHERE user_id = ?");
$req->execute(array($id));
$u = $req->fetch();

if(!isset($u)) {
    $ok = false;
    echo "user existe pas..";
} else {

    $fics = scandir('../data',1);
    foreach ($fics as $f) {
        if($f != "majUserBDD.php" ) {
            if(explode('-',$f)[0] == $id ) {
                echo "rfes".$f;
                $old = $f;
                $new = $id.'-'.$u['user_pseudo'];
                break;
            }
        } else {
            $ok = false;
        }
    }

}
$okrename = false;
echo $old."%".$new;
$ok = $ok && isset($old) && isset($new);
if($ok) {
    if ($old != $new) {
        if(rename($old,$new)){
            echo "rename reussi";$okrename = true;
        }else {
            echo "reeeru";
        }
    }
}

$attend = explode('/',$u['user_image']);
if ($attend[1] != $new){
    $attend[1] = $new;
    $newimage = implode('/',$attend);
    echo "<br> New image :".$newimage;

    $req = $BDD->prepare("UPDATE user
            SET user_image = ? 
            WHERE user_id = ?"); 

    $req->execute(array($newimage,$id));

}



;
?>