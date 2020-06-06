<?php
session_start();
include_once("assets/db/connexiondb.php");
$_SESSION['ici_index_bool'] = false;

print_r("$ <br><br><br><br>rg<br>");
print_r($_SESSION);
print_r($_FILES);


$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {

    $okconnectey = true;
} 


require_once 'assets/functions/uploadFile.php';

$upd = new uploadFile();

if(isset($_FILES['uploadAudio'])) {
    if($_FILES['uploadAudio']['size'] != 0) { 
        // FICHIER RECU
        var_dump($_FILES['uploadAudio']);
        $tmp_name = $_FILES['uploadAudio']['tmp_name'];
        $name = $_FILES['uploadAudio']['name'];

        $nomduboug = $_SESSION['user_pseudo'];
        $idduboug = $_SESSION['user_id'];

        //        for($i)
        // $req = $BDD->prepare("SELECT beat_title
        //                            FROM beat
        //                            WHERE beat_id = ? 
        //                                ");
        //            $req->execute(array($i));
        //            $b = $req->fetch();
        //
        //            if(isset($b['user_id'])){
        //                $continuecherche = false;
        //                $err_email = "Cet e-mail existe déjà !";
        //            }

        $destination = $upd->uploadAudio($tmp_name,$name,$nomduboug,$idduboug);


    }
    else {
        $destination = "error0";
    }

} 

$okaudioposer = true;
if (substr($destination,0,-1) == "error") { 
    if ($destination[5] == "0") { 
        $err_upload = "Taille 0";
        $okaudioposer = false;

    } else if( $destination[5] == "1") { 
        $err_upload = "Taille 0";
        $okaudioposer = false;

    }else if( $destination[5] == "2") { 
        $err_upload = "Taille 0";
        $okaudioposer = false;

    }

} 

if(isset($err_upload)) {
    echo $err_upload;
}
//        $date_upload = date("Y-m-d H:i:s"); 
//
//        // preparer requete
//        $req = $BDD->prepare("INSERT INTO beat (beat_title,beat_author,beat_format,beat_genre,beat_description,beat_year,beat_price,beat_dateupload,beat_cover,beat_tags,beat_source) VALUES (?,?,?,?,?,?,?,?,?,?,?)"); 
//
//        $req->execute(array($title,$author,$format,$genre,$description,$year,$price,$dateupload,$cover,$tags,$source));
//
//        $_SESSION['user_pseudo'] = $pseudo;
//
//        header('Location: index.php');
//        exit;



?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <script src="https://kit.fontawesome.com/8157870d7a.js" crossorigin="anonymous"></script>
        <!--        <link rel="stylesheet" type="text/css" href="assets/css/styles-index.css"> -->
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">

        <title>New upload</title>
    </head>
    <body>
        <br><br><br><br><br><br><br>
        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->

        <?php
      //  require_once('assets/skeleton/navbar.php');
        ?>;
        <?php
        if (isset($err_upload)) { ?>
        <a href=javascript:history.go(-1)>Retournez en arrière</a>

        <?php   }
        else { ?>

        <?= $destination ?>

        <?php

            $annulationupload = false;
              if ($annulationupload){
                  unlink($destination);
              }
             }
        ?>







        <?php
        require_once('assets/skeleton/endLinkScripts.php');
        ?>
        <script>


        </script>

    </body>
</html>
