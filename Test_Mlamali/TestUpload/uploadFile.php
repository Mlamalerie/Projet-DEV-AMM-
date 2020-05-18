<?php 

class uploadFile{



    function uploadAudio($tmp_name,$name,$nomduboug){
        print_r("$$$ <br>");

        $name = strtolower($nomduboug).'_beats_'.strtolower($name);
        
        $nom = $nomduboug; // Le nom du répertoire à créer

        // Vérifie si le répertoire existe :
        if (is_dir($nom)) {
            echo 'Le répertoire existe déjà!'; // note : le chier sera écrsé avec les fichier du mm nom  
        }
        // Création du nouveau répertoire
        else { 
            mkdir($nom);
            echo 'Le répertoire '.$nom.' vient d\'être créé!';      
        }
        
        if (is_dir($nom.'/tracks')) {
            echo 'Le répertoire existe déjà!'; // note : le chier sera écrsé avec les fichier du mm nom  
        }
        // Création du nouveau répertoire
        else { 
            mkdir($nom.'/tracks');
            echo 'Le répertoire '.$nom.' vient d\'être créé!'; 
            
        }
        echo "DIRECTION :".$nom.'/tracks/'.$name;
        move_uploaded_file($tmp_name,$nom.'/tracks/'.$name);
    }
}


?>