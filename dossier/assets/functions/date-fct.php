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

function date_outil($date,$nombre_jour) {

    $year = substr($date, 0, -6);   
    $month = substr($date, -5, -3);   
    $day = substr($date, -2);   

    // récupère la date du jour
    $date_string = mktime(0,0,0,$month,$day,$year);

    // Supprime les jours
    $timestamp = $date_string - ($nombre_jour * 86400);
    $nouvelle_date = date("Y-m-d", $timestamp); 

    // pour afficher
    return $nouvelle_date;

}
 
?>