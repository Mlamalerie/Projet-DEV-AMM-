<nav id='audioplayer' class=" navplayer fixed-bottom " style="display:none">  
    <!--        -->
    <audio src="" id="song" volume = 0.75></audio>


    <div class="box ">

        <table class=" tableuh">
            <tbody id="">
                <tr class="d-flex justify-content-start ml-4 mb-2">

                    <th  class='border-0 d-flex align-middle ' style="width: 250px";>
                        <div class='p-2 d-flex w-100 align-middle'>
                            <img id="thumbnail"  src='assets/img/cover_default.jpg' alt='' width='90' class='img-fluid rounded shadow-sm ml-2'>
                            <div class='ml-3 d-inline-block align-middle mt-2'>
                              <span class="song-title">WEBEATS</span>
                               
                                <span class='text-muted font-weight-normal font-italic d-block'><span class="song-artist">zgzbrzgz</span></span>
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
                        <div class="container-fluid d-block ">
                            <div class="row d-flex flex-row d-flex justify-content-center">
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

                    </td>

                    <td class='border-0 align-middle'>
                        <!-- volume-->
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
                    </td>


                </tr>


            </tbody>
        </table>

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


</nav>

<?php
require_once('assets/skeleton/AudioPlayer/js-audioplayer.php');
?>

                        </div>
                        <!--        range -->
                        <div class="container-fluid d-block ">
                            <div class="row d-flex flex-row d-flex justify-content-center">
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

                    </td>

                    <td class='border-0 align-middle'>
                        <!-- volume-->
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
                    </td>


                </tr>


            </tbody>
        </table>

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


</nav>

<?php
require_once('assets/skeleton/AudioPlayer/js-audioplayer.php');
?>
