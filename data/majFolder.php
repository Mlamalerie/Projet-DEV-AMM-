<?php

include_once("../assets/db/connexiondb.php");

$ok = true;
$id = (int) $_GET['id'];

$req = $BDD->prepare("SELECT user_pseudo
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
        if(explode('-',$f)[0] == $id) {
            echo "rfes".$f;
            $old = $f;
            $new = $id.'-'.$u['user_pseudo'];
            break;
        }
    }

}
echo $old."%".$new;
$ok = $ok && isset($old) && isset($new);
if($ok) {
    if(rename($old,$new)){
        echo "rename reussi";
    }else {
        echo "reeeru";
    }
}

;
?>