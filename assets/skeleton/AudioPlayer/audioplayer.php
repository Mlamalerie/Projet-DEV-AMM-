<nav id='audioplayer' class=" navplayer fixed-bottom " style="display:none">  
    <!--        -->
    <audio src="" id="song" volume = 0.75 onerror="probleme()"></audio>


    <div class="box ">

        <table class=" tableuh">
            <tbody id="tbodyAudioPlayer">
                <tr class="d-flex justify-content-start ml-4 mb-2">

                    <th  class='border-0 d-flex align-middle ' style="width: 250px";>
                        <div class='p-2 d-flex w-100 align-middle'>
                            <img id="thumbnail"  src='assets/img/cover_default.jpg' alt='' width='90' class='img-fluid rounded shadow-sm ml-2'>
                            <div class='ml-3 d-inline-block align-middle mt-2'>
                              <span class="song-title"></span>
                               
                                <span class='text-muted font-weight-normal font-italic d-block'><small>by</small> <span class="song-artist"></span></span>
                            </div>
                        </div>
                    </th>

                    <td class='border-0  flex-column'>
                        <div class=" mx-4 row p-1 ">
                         
                          <span class="player-prev-icon"  onclick="previousSong()" id="btn-prev" ></span>
                          <span class="player-play-icon "  onclick="playPause(songIndex)" id="btn-play-pause" ></span>
                          <span class="player-next-icon "  onclick="nextSong()" id="btn-next" ></span>
                           
                        </div>
                        <!--        range -->
                        <div  class="container-fluid d-block " >
                            <div class="row d-flex flex-row d-flex justify-content-center">
                                <div class="currentTime"></div>
                                <input
                                       type="range"
                                       id="progress-bar"
                                       min="0"
                                       max=""
                                       value="0"
                                       onchange="changeProgressBar()"
                                       onmouseup="changeProgressBar()"
                                       onclick="changeProgressBar()"

                                       />
                                <div class="durationTime"></div>
                            </div>
                        </div>

                    </td>

                    <td class='border-0 align-middle '>
                        <!-- volume-->
                        <div class="volume row mt-3 ">
                             <div id="divMute" class="icon text-light p-2" onclick="caMute(this)">
                                <i class="fa fa-volume-up icon-size" ></i>
                            </div>
                            <input id="volume_range" onmouseup='goVolume(this)' onchange="goVolume(this)" type="range" min="0" max="100" value="75" class="volume-range">
                          
                            <div class="bar-hoverbox">
                                <div class="bar">
                                    <div class="bar-fill"></div>
                                </div>
                            </div>
                        </div>
                    </td>


                </tr>


            </tbody>
        </table>

    </div>
    <script>
function probleme(){
        songTitle.innerHTML = '<i class="fas fa-exclamation-triangle text-warning"></i> erreur';
        songArtist.innerHTML = ' ...';
    }

        // Change le son
        var son = document.getElementById("song");
var volvol;
        
        function caMute(bay){
            
            // 
            if(son.volume > 0) {
                volvol = son.volume;
                 son.volume = 0;
                bay.innerHTML = "<i class='fas fa-volume-mute icon-size'></i>";
            } else {
                son.volume = volvol;
                bay.innerHTML = " <i class='fa fa-volume-up icon-size' ></i>";
            }
            
        }

        function goVolume(bay){
            let s = parseInt(bay.value)/100;
            son.volume = s;
            console.log("volume",s);
            
            if(s == 0){
                console.log('x');
                 document.getElementById("divMute").innerHTML = "<i class='fas fa-volume-mute icon-size'></i>";
            } else {
                 document.getElementById("divMute").innerHTML = "<i class='fas fa-volume-up icon-size'></i>";
            } 
        }

    </script>


</nav>

<?php
require_once('assets/skeleton/AudioPlayer/js-audioplayer.php');
?>

                    
