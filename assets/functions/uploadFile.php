<?php 

class uploadFile{



    function upload($tmp_name,$name){
        print_r("$$$ <br>");

        $nom = "uploadeuh"; // Le nom du répertoire à créer

        // Vérifie si le répertoire existe :
        if (is_dir($nom)) {
            echo 'Le répertoire existe déjà!'; // note : le chier sera écrsé avec les fichier du mm nom  
        }
        // Création du nouveau répertoire
        else { 
            mkdir($nom);
            echo 'Le répertoire '.$nom.' vient d\'être créé!';      
        }

        move_uploaded_file($tmp_name,$nom.'/'.$name);
    }
}


?>