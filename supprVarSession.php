<?php
session_start();
print_r($_SESSION);
$qq = (String) $_GET['qq'];

print_r("<br>");


if(!isset($_SESSION[$qq])){
    $ok = false;
    echo "cette var existe pas dans session";
} else {
    unset($_SESSION[$qq]);
    print_r($_SESSION);
}

?>


<script> alert("eh") </script>