<?php 

class uploadFile{



    function uploadAudio($tmp_name,$name,$nomduboug,$idduboug,$date){
        $formataudio = ['mp3','ogg','wav','wma','m4a'];

        $nn = pathinfo($name);
        $filename = $nn['filename'];
        $ext =  $nn['extension'];


        if (in_array($ext,$formataudio)){

            $name = $idduboug.'-'.strtolower($nomduboug).'-'.strtolower($filename).'.'.$ext;



            // Vérifie si le répertoire existe :
            if (is_dir("datausers")) {
                echo 'Le répertoire datausers existe déjà!'; 
            }
            // Création du nouveau répertoire
            else { 
                mkdir("datausers");
                echo 'Le répertoire datausers vient d\'être créé!';      
            }

            // Vérifie si le répertoire existe :
            if (is_dir("datausers/".$nomduboug)) {
                echo 'Le répertoire existe déjà!'; 
            }
            // Création du nouveau répertoire
            else { 
                mkdir("datausers/".$nomduboug);
                echo 'Le répertoire '.$nomduboug.' vient d\'être créé!';      
            }

            if (is_dir("datausers/".$nomduboug.'/beats')) {
                echo 'Le répertoire tracks existe déjà!'; // note : le chier sera écrsé avec les fichier du mm nom  
            }
            // Création du nouveau répertoire
            else { 
                mkdir("datausers/".$nomduboug.'/beats');
                echo 'Le répertoire tracks vient d\'être créé!'; 

            }

            $direction = 'datausers/'.$nomduboug.'/beats/'.$name;
            echo "DIRECTION :".$direction;

            move_uploaded_file($tmp_name,$direction);

            $path_parts = pathinfo($direction);
            echo $path_parts['dirname'], "*<br>";
            echo $path_parts['basename'], "**<br>";
            echo $path_parts['extension'], "***<br>";
            echo $path_parts['filename'], "****<br>";
            
            return $direction;
        } 
        else {
            return 'error1';
            
            
        }




    }
}


?>