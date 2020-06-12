<!-- JS du player -->

<?php 
function returnMusicListStr($bay, $resuBEATS){
    $str = "[";
    if ($bay == 'songs') {

        foreach($resuBEATS as $r) {
            $pose = $r['beat_source'];

            $str .= "'audio/$pose',";

        }

    } else if ($bay == 'thumbnails'){
        foreach($resuBEATS as $r) {
            $pose = $r['beat_cover'];

            $str .= "'$pose',";
        }
    }
    else if ($bay == 'artists'){
        foreach($resuBEATS as $r) {
            $pose = $r['beat_author'];

            $str .= "'$pose',";
        }
    }else if ($bay == 'titles'){
        foreach($resuBEATS as $r) {
            $pose = $r['beat_title'];

            $str .= "'$pose',";
        }
    } else if ($bay == 'prices'){
        foreach($resuBEATS as $r) {
            $pose = $r['beat_price'];

            $str .= "'$pose',";
        }
    } else if ($bay == 'ids'){
        foreach($resuBEATS as $r) {
            $pose = $r['beat_id'];

            $str .= "'$pose',";
        }
    } 
    // ici effacer la virgule en + puis c bon
    $str = substr($str,0,-1);
    $str .= "]";

    if($str == "]") {
        $str = "[]";
    }
    return $str;


}


?>

<script>
            function changeAllBtn(playing,idbeat) {
                let btn = document.getElementById('1btnbeat-'+idbeat.toString());
                if(btn != null){
                if(playing){
                    btn.innerHTML = "<i class='fa fa-play iconPlay'></i>";
                }else {
                     btn.innerHTML = "<i class='fa fa-pause iconPlay'></i>";
                }}

            }

            function playBeat(){

            }

        </script>

<script id="scriptDuPlayer">

    const thumbnail = document.querySelector('#thumbnail'); // album cover 
    const song = document.querySelector('#song'); // audio 

    const btnAcheterPrice = document.querySelector('#btn-player-acheter');
    const songArtist = document.querySelector('.song-artist'); // element où noms artistes apparaissent
    const songTitle = document.querySelector('.song-title'); // element où titre apparait
    const progressBar = document.querySelector('#progress-bar'); // element où progress bar apparait
    let pPause = document.querySelector('#btn-play-pause'); // element où images play pause apparaissent

    let mouseDown = false;



    songIndex = 0;
    songs = <?=returnMusicListStr("songs", $resuPLAYLIST); ?>;  //Stockage des audios
    songsID = <?=returnMusicListStr("ids", $resuPLAYLIST); ?>;  //Stockage des audios
    thumbnails = <?=returnMusicListStr("thumbnails", $resuPLAYLIST); ?>; //Stockage des covers
    songArtists = <?=returnMusicListStr("artists", $resuPLAYLIST); ?>; //Stockage Noms Artistes
    songTitles = <?=returnMusicListStr("titles", $resuPLAYLIST); ?>; //Stockage Titres
    songPrices = <?=returnMusicListStr("prices", $resuPLAYLIST); ?>; //Stockage price
    let playing = true;
    var idencours = 0;
    function playPause(songIndex,idbeat) {
        
        
        document.getElementById('audioplayer').setAttribute('style',''); 
        pPause.setAttribute('onclick',"playPause(songIndex," +songsID[songIndex].toString() + ")"); 
        song.src = songs[songIndex];
        thumbnail.src = thumbnails[songIndex];
        songArtist.innerHTML = songArtists[songIndex];
        songTitle.innerHTML = songTitles[songIndex];
         
        
        if(idencours != songsID[songIndex]){playing = true};
        idencours = songsID[songIndex];
       
        
        if (playing) {
            
            pPause.setAttribute('class','player-pause-icon'); 
            
            song.play();
            
            console.log('play()',idencours);
            playing = false;
            changeAllBtn(playing,songsID[songIndex]);
        } else {
            pPause.setAttribute('class','player-play-icon'); 
            song.pause();
            console.log('pause()');
            playing = true;
            changeAllBtn(playing,songsID[songIndex]);
        }
    }



    // joue automatiquement le son suivant
    song.addEventListener('ended', function(){
        nextSong();
    });

    function nextSong() {
        songIndex++;
        if (songIndex > songs.length -1) {
            songIndex = 0;
        };
        song.src = songs[songIndex];
        thumbnail.src = thumbnails[songIndex];
        if((songArtists[songIndex] != null) && (songTitles[songIndex] != null)){
            songArtist.innerHTML = songArtists[songIndex];
            songTitle.innerHTML = songTitles[songIndex];
        }
        playing = true;
        playPause(songIndex);
    }

    function previousSong() {
        songIndex--;
        if (songIndex < 0) {
            songIndex = songs.length -1;
        };
        song.src = songs[songIndex];
        thumbnail.src = thumbnails[songIndex];
        if((songArtists[songIndex] != null) && (songTitles[songIndex] != null)){
            songArtist.innerHTML = songArtists[songIndex];
            songTitle.innerHTML = songTitles[songIndex];
        }
        playing = true;
        playPause(songIndex);
    }

    // maj de la durée max du son, maj temps actuel
    function updateProgressValue() {
        progressBar.max = song.duration;
        progressBar.value = song.currentTime;
        document.querySelector('.currentTime').innerHTML = (formatTime(Math.floor(song.currentTime)));
        if (document.querySelector('.durationTime').innerHTML === "NaN:NaN") {
            document.querySelector('.durationTime').innerHTML = "0:00";
        } else {
            document.querySelector('.durationTime').innerHTML = (formatTime(Math.floor(song.duration)));
        }
    };


    // conversion du temps en minutes/secondes dans le lecteur
    function formatTime(seconds) {
        let min = Math.floor((seconds / 60));
        let sec = Math.floor(seconds - (min * 60));
        if (sec < 10){ 
            sec  = `0${sec}`;
        };
        return `${min}:${sec}`;
    };

    // actualisation du lecteur en fct du temps(demi-secondes)
    setInterval(updateProgressValue, 1000);

    // Valeur de la bar qd curseur est glissé sans lecture
    function changeProgressBar() {
        song.currentTime = progressBar.value;
    };



</script>
<!--   END JS du Player     -->