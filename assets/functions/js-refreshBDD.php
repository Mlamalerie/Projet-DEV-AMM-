

<script>
    function refreshBeatBDD(idbeat) {
        console.log("refreshliker");
        var xmlhttp = new XMLHttpRequest();

        let idboug = <?php if($okconnectey) { echo $_SESSION['user_id'];}else{echo 0;} ?>; 
        let ou = "refreshBDDbeat.php?qq=";

        ou += idbeat.toString(); // id du beat
        console.log(ou);
        xmlhttp.open("GET",ou,true);
        xmlhttp.send();
    }



    function refreshAllBeats(){

        <?php
        $req = $BDD->prepare("SELECT beat_id FROM beat ");
        $req->execute(array());
        $listeBeats = $req->fetchAll();

        foreach($listeBeats as $b) {

        ?> 
        refreshBeatBDD(<?= $b['beat_id']?>); 
        <?php
        }
        ?>


    }
</script>