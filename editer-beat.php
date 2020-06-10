<?php
session_start();
$_SESSION['ici_index_bool'] = false;
include('assets/db/connexiondb.php'); 

print_r($_GET);
print_r("<br>");
print_r($_POST);
print_r($_SESSION);

$baseid = (int) $_GET['profil_id'];/*récupère id du profil qu'on a cliqué*/

$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    $okconnectey = true;
} else {
    header('Location: connexion.php');
    exit;
}





$req = $BDD->prepare("SELECT * 
    FROM beat 
    WHERE beat_author_id = ?");

$req->execute(array($baseid));
$afficher_beat = $req->fetch();

$basenom = $afficher_beat['beat_title'];
$basedescription = $afficher_beat['beat_description'];
$baseprix = $afficher_beat['beat_price'];
$basegenre = $afficher_beat['beat_genre'];
$baseannee = $afficher_beat['beat_year'];
$basecover = $afficher_beat['beat_cover'];
$basetags = $afficher_beat['beat_tags'];

?>