<?php



$old = $_GET['old'];
$new = $_GET['new'];

if($ok) {
    if(rename($old,$new)){
        echo "rename reussi";
    }else {
        echo "reeeru";
    }
}

;
?>