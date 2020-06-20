<?
$fichier = (String) $_GET['bay'];                             /* Fichier à supprimer */


if( file_exists ('././'.$fichier)){
    unlink( $fichier ) ;
    header('Location: edit-newupload.php');
    exit;

} else {
    echo "existe pazs";
}

?>