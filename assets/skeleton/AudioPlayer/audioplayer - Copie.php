
<nav id='audioplayer' class=" navplayer  fixed-bottom  " style="">   
    <!--   display:none     -->
    <audio src="" id="song" volume = 0.75></audio>
    <div class="box w-100 row">    
        <!--       image -->
        <div>
            <img src="" id="thumbnail" />
        </div>
        <!--        option pause suivant-->
        <div>
            <img src="./assets/icon/play.png" onclick="playPause(songIndex)" id="play-pause" />
            <span class="video-icon" onclick="nextSong()" id="next-song" ></span>
            <img src="./assets/icon/forward.png" onclick="nextSong()" id="next-song" />
            <img src="./assets/icon/backward.png" onclick="previousSong()" id="previous-song" />
            <div>
                <div class="song-artist"></div>
                <div class="song-title"></div>
            </div>
        </div>
        <!--        range -->
        <div class="container-fluid d-block">
            <div class="row d-flex">
                <div class="currentTime"></div>
                <input 
                       type="range" 
                       id="progress-bar" 
                       min="0" 
                       max="" 
                       value="0" 
                       onchange="changeProgressBar()"
                       />
                <div class="durationTime"></div>
            </div>
        </div>
        <!--        volume-->
        <div class="volume">
            <input id="volume_range" onchange="goVolume(this)" type="range" min="0" max="100" value="75" class="volume-range">
            <div class="icon">
                <i class="fa fa-volume-up icon-size" aria-hidden="true" onclick="caMute()"></i>
            </div>
            <div class="bar-hoverbox">
                <div class="bar">
                    <div class="bar-fill"></div>
                </div>
            </div>
        </div>


        <script>

            // Change le son
            var son = document.getElementById("song");

            function caMute(){
                son.volume = 0;
            }

            function goVolume(bay){
                let s = parseInt(bay.value)/100;
                son.volume = s;
                console.log("volume",s);
            }

        </script>




    </div>
</nav>

<?php
require_once('assets/skeleton/AudioPlayer/js-audioplayer.php');
?>

