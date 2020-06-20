<script>



    function liker(modemode,idbeat) {
        console.log("liker");
        var xmlhttp = new XMLHttpRequest();

        let idboug = <?php if($okconnectey) { echo $_SESSION['user_id'];}else{echo 0;} ?>; 
        let ou = "goLikeBDD.php?qq=";
        ou += modemode; // mode like ou dislike
        ou += "-" + idboug.toString();
        ou += "-" + idbeat.toString(); // id du beat
        console.log(ou);
        xmlhttp.open("GET",ou,true);
        xmlhttp.send();
    }

    function goLikeuh(bay,idbeat) {
        console.log(bay);
        console.log();
        let spannb = document.getElementById('span_nbLike-'+idbeat);
        let n = spannb.innerHTML;
        console.log(n);

        // si le bay est liker
        if(bay.classList.contains('coeur_active')) {
            bay.innerHTML = "<i class='far fa-heart'></i>";
            bay.classList.remove('coeur_active');
            liker("dislikedislike",idbeat) ;
            refreshBeatBDD(idbeat);
            spannb.innerHTML = parseInt(n) - 1;


        } else {
            bay.innerHTML = "<i class='fas fa-heart'></i>"
            bay.classList.add('coeur_active');
            liker("likelike",idbeat);
            refreshBeatBDD(idbeat);
            spannb.innerHTML = parseInt(n) + 1;
        }
    }


</script>