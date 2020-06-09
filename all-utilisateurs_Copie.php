

<?php 
session_start();
$_SESSION['ici_index_bool'] = false;

include('assets/db/connexiondb.php'); 


$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {

    $okconnectey = true;
    $get_id = 1;
} 

$req= $BDD -> prepare("SELECT * 
                    FROM messagerie 
                    WHERE ((id_from,id_to)=(:id1,:id2) OR (id_from, id_to)=(:id2,:id1)) 
                    ORDER BY date_message ASC
                    LIMIT 25");/*affichage limité à 25 messages*/
$req->execute(array('id1'=>$_SESSION['user_id'], 'id2' => $get_id));

$afficher_message=$req->fetchAll();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php        require_once('assets/skeleton/headLinkCSS.html');
        ?>

        <!--    Lien pour défiler les pages    -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">


        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
        <link rel="stylesheet" type="text/css" src="assets/css/all-utilisateurs.css">
        <title>All Users</title>
        <style>
            tr {
                height: 5px;
                padding: none;

            }
            tbody tr td{
                font-size: 10px;
                height: 5px;
            }
            thead tr th{
                font-size: 15px;
            }
        </style>
    </head>

    <body>
        <!--   ************************** NAVBAR  **************************  -->

        <?php
        require_once('assets/skeleton/navbar.php');
        ?>


        <?php
        require_once('assets/skeleton/endLinkScripts.php');
        ?>
    </body>

</html>