<?php


function returnMusicListStr($bay, $listeSons){
$str = "[";
    if ($bay == 'songs') {
        foreach($listeSons as $ss) {
            $pose = $ss['beat_url'];
            
            str += "'.$pose.',";
            
        }

    } else if ($bay == 'covers'){

    }
    else if ($bay == 'artists'){

    }else if ($bay == 'titles'){

    }
    // ici effacer la virgule en + puis c bon
    
    $str += "]";
    
    return str;


}


?>