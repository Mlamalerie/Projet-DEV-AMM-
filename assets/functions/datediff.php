<?php

function dateDiff($date1, $date2){
    $diff = $date1->diff($date2); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
    $res = "er";
    if(intval($diff->format('%a')) > 0) {
        $res = $diff->format('%R%a jours');
    } else if(intval($diff->format('%h')) > 0) {
        $res = $diff->format('%R%h heures');
    } else if(intval($diff->format('%i')) > 0) {
        $res = $diff->format('%R%i minutes');
    } 
    return $res;
 
    
}
 
?>