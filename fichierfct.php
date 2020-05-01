<?php 
function listannee($debut,$n){
$aaans = $debut;
    for($i = 0; $i < $n; $i++){
        echo"<option value=" . ($aaans + $i) . " >" . ($aaans + $i) . "</option>" ;

    }

}

?>
