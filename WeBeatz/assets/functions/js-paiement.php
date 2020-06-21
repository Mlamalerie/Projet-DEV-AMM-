
<script id="jsPaiementhein">

    function supprVar(quoi) {
        console.log("supprVarSeesion");
        var xmlhttp = new XMLHttpRequest();

        let idboug = <?php if($okconnectey) { echo $_SESSION['user_id'];}else{echo 0;} ?>; 
        let ou = "supprVarSession.php?qq=";
        ou += quoi.toString();
        console.log(ou);
        xmlhttp.open("GET",ou,true);
        xmlhttp.send();
    }

    function ajoutBDDVente(idbeat) {
        console.log("ajoutVenteBDD");
        var xmlhttp = new XMLHttpRequest();

        let idboug = <?php if($okconnectey) { echo $_SESSION['user_id'];}else{echo 0;} ?>; 
        let ou = "goVenteBDD.php?qq="
        ou += idboug.toString();
        ou += "-" + idbeat.toString();
        console.log(ou);
        xmlhttp.open("GET",ou,true);
        xmlhttp.send();
    }


    function  ajoutToutPanierdansVente(){
        <?php $req = $BDD->prepare("SELECT * FROM panier WHERE panier_user_id = ?");
        $req->execute(array($_SESSION['user_id']));
        $resuPANIER = $req->fetchAll();

        foreach($resuPANIER as $p) {

            $req = $BDD->prepare("SELECT *
                                            FROM beat
                                            WHERE beat_id = ?");
            $req->execute(array($p['panier_beat_id']));
            $resuPAN = $req->fetchAll();

            foreach($resuPAN as $b) { ?>
        ajoutBDDVente(<?= $b['beat_id'] ?>);

       
                      

        <?php  } 
        } 
        ?>

    }

    function  deleteAllPAnier(){
        <?php $req = $BDD->prepare("SELECT * FROM panier WHERE panier_user_id = ?");
        $req->execute(array($_SESSION['user_id']));
        $resuPANIER = $req->fetchAll();

        foreach($resuPANIER as $p) {

            $req = $BDD->prepare("SELECT *
                                            FROM beat
                                            WHERE beat_id = ?");
            $req->execute(array($p['panier_beat_id']));
            $resuPAN = $req->fetchAll();

            foreach($resuPAN as $b) { ?>
        supprBDDPanier(<?= $b['beat_id'] ?>);

        <?php  }

        } 
        ?>


    }

    function ToutEstBonTransac(nb) {
        ajoutToutPanierdansVente();
        deleteAllPAnier();

        let str = "bravo.php?n=";
        str += nb;
        setTimeout(redir(str,2000));


    }


</script>


