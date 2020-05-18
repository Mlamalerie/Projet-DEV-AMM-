<?php 

class uploadFile{



    function uploadAudio($tmp_name,$name,$nomduboug,$idduboug,$date){
        $formataudio = array('mp3','ogg','wav','wma','m4a');

        $nn = pathinfo($name);
        $filename = strtolower($nn['filename']);
        $ext =  strtolower($nn['extension']);


        if (in_array($ext,$formataudio)){

            $name = $idduboug.'-'.strtolower($nomduboug).'-'.strtolower($filename).'.'.$ext;


            $dir = 'datausers/';
            // Vérifie si le répertoire existe :
            if (!is_dir("datausers")) { 
                mkdir("datausers",0777);
                echo 'Le répertoire datausers vient d\'être créé!';      
            }

            // Vérifie si le répertoire existe :
            if (!is_dir("datausers/".$nomduboug)) { 
                mkdir("datausers/".$nomduboug,0777);
                echo 'Le répertoire '.$nomduboug.' vient d\'être créé!';      
            }

            if (!is_dir("datausers/".$nomduboug.'/beats')){ 
                mkdir("datausers/".$nomduboug.'/beats',0777);
                echo 'Le répertoire tracks vient d\'être créé!'; 
            }

            $direction = 'datausers/'.$nomduboug.'/beats/'.$name;
            echo "DIRECTION :".$direction;


            $direction = $dir.basename($name);
            echo "DIRECTION22 :".$direction;

            if(move_uploaded_file($tmp_name,$direction)){
                echo "<br><br>FICHIER ENVOYER AVEC SUCCES <br>";
                $path_parts = pathinfo($direction);
                echo $path_parts['dirname'], "*<br>";
                echo $path_parts['basename'], "**<br>";
                echo $path_parts['extension'], "***<br>";
                echo $path_parts['filename'], "****<br>";

            }else
            {
                $direction = 'error2';

            }



            return $direction;
        } 
        else {
            return 'error1';


        }
    }

    function uploadImage($tmp_name,$name,$nomduboug,$idduboug,$date){
        $formatautorise = array('jpg','jpe','jpeg','png');

        $nn = pathinfo($name);
        $filename = strtolower($nn['filename']);
        $ext =  strtolower($nn['extension']);


        if (in_array($ext,$formatautorise)){

            $name = $idduboug.'-'.strtolower($nomduboug).'-'.strtolower($filename).'.'.$ext;


            $dir = 'datausers/'.$nomduboug.'/images/'.$name;
            // Vérifie si le répertoire existe :
            if (!is_dir("datausers")) { 
                mkdir("datausers",0777);
                echo 'Le répertoire datausers vient d\'être créé!';      
            }

            // Vérifie si le répertoire existe :
            if (!is_dir("datausers/".$nomduboug)) { 
                mkdir("datausers/".$nomduboug,0777);
                echo 'Le répertoire '.$nomduboug.' vient d\'être créé!';      
            }

            if (!is_dir("datausers/".$nomduboug.'/images')){ 
                mkdir("datausers/".$nomduboug.'/images',0777);
                echo 'Le répertoire tracks vient d\'être créé!'; 
            }

            $direction = 'datausers/'.$nomduboug.'/images/'.$name;
            echo "DIRECTION :".$direction;


            $direction = $dir.basename($name);
            echo "DIRECTION22 :".$direction;

            if(move_uploaded_file($tmp_name,$direction)){
                echo "<br><br>FICHIER ENVOYER AVEC SUCCES <br>";
                $path_parts = pathinfo($direction);
                echo $path_parts['dirname'], "*<br>";
                echo $path_parts['basename'], "**<br>";
                echo $path_parts['extension'], "***<br>";
                echo $path_parts['filename'], "****<br>";

            }else
            {
                $direction = 'error2';

            }



            return $direction;
        } 
        else {
            return 'error1';


        }




    }
}


?>