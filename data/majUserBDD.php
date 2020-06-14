<?php

include_once("../assets/db/connexiondb.php");

$ok = true;
$id = (int) $_GET['id'];

//** selectionner information du boug coorespondant a cette id
$req = $BDD->prepare("SELECT user_pseudo,user_image
                            FROM user
                            WHERE user_id = ?");
$req->execute(array($id));
$u = $req->fetch();

$req = $BDD->prepare("SELECT beat_id,beat_source,beat_cover
                            FROM beat
                            WHERE beat_author_id = ?");
$req->execute(array($id));
$AllBeatsU = $req->fetchAll();

if(isset($u) && !empty($u)) {
    $fics = scandir('../data',1);
    var_dump($fics);

    $okdossiertrouvey = false;
    foreach ($fics as $f) {
        // echo $f."<br>";
        if($f != "majUserBDD.php" ) {// scan tout sauf le majUSER
            //echo (explode('-',$f)[0]).'¤'.$id.'<br>';
            if(explode('-',$f)[0] == $id ) { // trouvé le bon dossier

                echo "trouvey ".$f."<br>";
                $okdossiertrouvey = true;
                $old = $f; // l'ancien fichier (à changer)
                $new = $id.'-'.$u['user_pseudo']; // le nouveau nom
                var_dump($old);
                var_dump($new);
                break;
                break;
            }
        } 
    }

    if($okdossiertrouvey){

        echo "old : ".$old." / new : ".$new." <br>";
        $ok = $ok && isset($old) && isset($new);

        if($ok) {
            echo 'ok ';
            if ($old != $new) {
                if(rename($old,$new)){
                    echo "rename reussi";

                }else {
                    echo "erreur rename";
                    if (copy ($old,$new)) {
                        unlink($old);
                        echo "<br> euh comme rename marche pas jai tout copier et supprimer l'ancien bail";
                    }

                }

                //**update user_image
                $attend = explode('/',$u['user_image']);
                if ($attend[1] != $new){
                    if(implode('/',$attend) != 'assets/img/user.png'){

                        $attend[1] = $new;
                        $newimage = implode('/',$attend);
                        echo "<br> New user_image : ".$newimage;

                        $req = $BDD->prepare("UPDATE user SET user_image = ?  WHERE user_id = ?"); 

                        $req->execute(array($newimage,$id));
                    }else {
                        echo "<br> on change pas photo profil par defautl mec ";
                    }
                }

                //**
                if (count($AllBeatsU) > 0) {
                    echo '<br> * ';
                    //**update all beat_source
                    foreach($AllBeatsU as $b){
                        $attend = explode('/',$b['beat_source']);
                        if ($attend[1] != $new){
                            $attend[1] = $new;
                            $newbeatsource = implode('/',$attend);
                            echo "<br> New beat_source : ".$newbeatsource;

                            $req = $BDD->prepare("UPDATE beat SET beat_source = ?  WHERE beat_id = ?"); 
                            $req->execute(array($newbeatsource,$b['beat_id']));
                        }
                    }
                    //**update all beat_cover
                    foreach($AllBeatsU as $b){
                        $attend = explode('/',$b['beat_cover']);
                        if ($attend[1] != $new){



                            if(implode('/',$attend) != 'assets/img/cover_default.jpg'){
                                $attend[1] = $new;
                                $newbeatcover = implode('/',$attend);
                                echo "<br> New beat_source : ".$newbeatcover;

                                $req = $BDD->prepare("UPDATE beat SET beat_cover = ?  WHERE beat_id = ?"); 

                                $req->execute(array($newbeatcover,$b['beat_id']));
                            } else {
                                echo "<br> on change pas cover par defautl mec ";
                            }
                        }
                    }

                } 



            } else {
                echo "mm nom";
            }
        } else {
            echo "not ok chakal";
        }



    } else {
        echo "dossier inextant je crois donc je vai le creer chakal <br>";

        if (!is_dir($id.'-'.$u['user_pseudo'])) { 
            mkdir($id.'-'.$u['user_pseudo'],0777);
            echo "Le répertoire". $id.'-'.$u['user_pseudo']." vient d\'être créé!";      
        }
    }

} else {

    echo "user existe pas..";
}







;
?>