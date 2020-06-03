<nav class="navplayer  fixed-bottom">        
            <audio src="./audio/go_legend.mp3" id="song"></audio>
            <div class="box">     
                <img src="./img/bigmetro.jpg" id="thumbnail" />

                <img src="./assets/icon/play.png" onclick="playPause(songIndex)" id="play-pause" />
                <img src="./assets/icon/forward.png" onclick="nextSong()" id="next-song" />
                <img src="./assets/icon/backward.png" onclick="previousSong()" id="previous-song" />

                <div class="song-artist">WeBeats</div>
                <div class="song-title"></div>

                <input 
                       type="range" 
                       id="progress-bar" 
                       min="0" 
                       max="" 
                       value="0" 
                       onchange="changeProgressBar()"
                       />

<!--                <button type="button" class="btn btn-danger " id='btn-player-acheter'>Acheter</button>-->

                <div class="currentTime"></div>
                <div class="durationTime"></div>
            </div>
        </nav>