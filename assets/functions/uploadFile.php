<?php 

class uploadFile{



    function uploadAudio($tmp_name,$name,$nomduboug,$idduboug){
        $formataudio = array('mp3','ogg','wav','wma','m4a');

        $nn = pathinfo($name);
        $filename = strtolower($nn['filename']);
        $ext =  strtolower($nn['extension']);

        // si le fichier est un bien un fichier audio
        if (in_array($ext,$formataudio)){

            $name = $idduboug.'-beat-x.'.$ext;


            $dir = 'data/'.$idduboug.'-'.$nomduboug.'/beats/';

            // Vérifie si le répertoire existe :
            if (!is_dir("data")) { 
                mkdir("data",0777);
                echo 'Le répertoire data vient d\'être créé!';      
            }

            // Vérifie si le répertoire existe :
            if (!is_dir("data/".$idduboug.'-'.$nomduboug)) { 
                mkdir("data/".$idduboug.'-'.$nomduboug,0777);
                echo 'Le répertoire '.$idduboug.'-'.$nomduboug.' vient d\'être créé!';      
            }

            if (!is_dir("data/".$idduboug.'-'.$nomduboug.'/beats')){ 
                mkdir("data/".$idduboug.'-'.$nomduboug.'/beats',0777);
                echo 'Le répertoire tracks vient d\'être créé!'; 
            }

            //localisation du fichier
            $direction = $dir.basename($name);

            // PLACER
            if(move_uploaded_file($tmp_name,$direction)){
                return $direction;
            }
            // Erreur de placement
            else{
                return 'error2';
            }
        } 
        // ce n'est pas un fichier audio
        else {
            return 'error1';
        }
    } // END function uploadAudio

    function uploadImage($tmp_name,$name,$nomduboug,$idduboug){
        $formatImage = array('png','jpg','jpeg');

        $nn = pathinfo($name);
        $filename = "photo";
        $ext =  strtolower($nn['extension']);

        // si le fichier est un bien un fichier Image
        if (in_array($ext,$formatImage)){

            $name = $idduboug.'-'.strtolower($filename).'.'.$ext;


            $dir = 'data/'.$idduboug.'-'.$nomduboug.'/images/';

            // Vérifie si le répertoire existe :
            if (!is_dir("data")) { 
                mkdir("data",0777);
                echo 'Le répertoire data vient d\'être créé!';      
            }

            // Vérifie si le répertoire existe :
            if (!is_dir("data/".$idduboug.'-'.$nomduboug)) { 
                mkdir("data/".$idduboug.'-'.$nomduboug,0777);
                echo 'Le répertoire '.$idduboug.'-'.$nomduboug.' vient d\'être créé!';      
            }

            if (!is_dir("data/".$idduboug.'-'.$nomduboug.'/images')){ 
                mkdir("data/".$idduboug.'-'.$nomduboug.'/images',0777);
                echo 'Le répertoire images vient d\'être créé!'; 
            }

            //localisation du fichier
            $direction = $dir.basename($name);


            // PLACER
            if(move_uploaded_file($tmp_name,$direction)){

                return $direction;

            }
            // Erreur de placement
            else{
                return 'error2';

            }

        } 
        // ce n'est pas un fichier Image
        else {

            return 'error1';


        }
    } // END function uploadImage

    function uploadCoverBeats($tmp_name,$name,$title,$nomduboug,$idduboug,$idbeat){
        $formatImage = array('png','jpg','jpeg');

        $nn = pathinfo($name);
        $ext =  strtolower($nn['extension']);

        // si le fichier est un bien un fichier Image
        if (in_array($ext,$formatImage)){

            $name = $idduboug.'-'.strtolower($nomduboug).'-cover_beat-'.$idbeat.'.'.$ext;


            $dir = 'data/'.$idduboug.'-'.$nomduboug.'/images/cover/';

            // Vérifie si le répertoire existe :
            if (!is_dir("data")) { 
                mkdir("data",0777);
                echo 'Le répertoire data vient d\'être créé!';      
            }

            // Vérifie si le répertoire existe :
            if (!is_dir("data/".$idduboug.'-'.$nomduboug)) { 
                mkdir("data/".$idduboug.'-'.$nomduboug,0777);
                echo 'Le répertoire '.$idduboug.'-'.$nomduboug.' vient d\'être créé!';      
            }

            if (!is_dir("data/".$idduboug.'-'.$nomduboug.'/images')){ 
                mkdir("data/".$idduboug.'-'.$nomduboug.'/images',0777);
                echo 'Le répertoire imagesvient d\'être créé!'; 
            }
            if (!is_dir("data/".$idduboug.'-'.$nomduboug.'/images/cover')){ 
                mkdir("data/".$idduboug.'-'.$nomduboug.'/images/cover',0777);
                echo 'Le répertoire cover vient d\'être créé!'; 
            }

            //localisation du fichier
            $direction = $dir.basename($name);


            // PLACER
            if(move_uploaded_file($tmp_name,$direction)){

                return $direction;

            }
            // Erreur de placement
            else{
                return 'error2';

            }

        } 
        // ce n'est pas un fichier Image
        else {

            return 'error1';


        }
    } // END function uploadImage


}


?>