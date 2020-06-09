        <!-- JS du player -->
        <?php  include("assets/functions/fctforaudioplayer.php"); ?>
        <script id="scriptDuPlayer">

            const thumbnail = document.querySelector('#thumbnail'); // album cover 
            const song = document.querySelector('#song'); // audio 

            const btnAcheterPrice = document.querySelector('#btn-player-acheter');
            const songArtist = document.querySelector('.song-artist'); // element où noms artistes apparaissent
            const songTitle = document.querySelector('.song-title'); // element où titre apparait
            const progressBar = document.querySelector('#progress-bar'); // element où progress bar apparait
            let pPause = document.querySelector('#play-pause'); // element où images play pause apparaissent

            let mouseDown = false;



            songIndex = 0;
            songs = <?=returnMusicListStr("songs", $resuBEATS); ?>;  //Stockage des audios
            thumbnails = <?=returnMusicListStr("thumbnails", $resuBEATS); ?>; //Stockage des covers
            songArtists = <?=returnMusicListStr("artists", $resuBEATS); ?>; //Stockage Noms Artistes
            songTitles = <?=returnMusicListStr("titles", $resuBEATS); ?>; //Stockage Titres
            songPrices = <?=returnMusicListStr("prices", $resuBEATS); ?>; //Stockage price
            let playing = true;
            function playPause(songIndex) {
                document.getElementById('audioplayer').setAttribute('style','');
                song.src = songs[songIndex];
                thumbnail.src = thumbnails[songIndex];
                songArtist.innerHTML = songArtists[songIndex];
                songTitle.innerHTML = songTitles[songIndex];

                //                let prixprix;
                //                if(parseFloat(songPrices[songIndex]) == 0.00){
                //                    prixprix = "FREE";
                //
                //                } else {
                //                    prixprix = songPrices[songIndex] +"€";
                //                }
                //                btnAcheterPrice.innerHTML = "<i class='fas fa-shopping-cart iconPanierbtn'></i><sup>+</sup>"+ prixprix ;
                //                console.log(btnAcheterPrice);
                //                btnAcheterPrice.setAttribute('onclick',"go2Panier(this,'" + songTitles[songIndex] + "','" + songArtists[songIndex] + "', '"+ songPrices[songIndex] +"', '" + thumbnails[songIndex] + "');");
                //                btnAcheterPrice.setAttribute('class','btn btn-danger');


                if (playing) {
                    pPause.src = "./assets/icon/pause.png"
                    song.play();
                    playing = false;
                } else {
                    pPause.src = "./assets/icon/play.png"
                    song.pause();
                    playing = true;
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
            setInterval(updateProgressValue, 50);

            // Valeur de la bar qd curseur est glissé sans lecture
            function changeProgressBar() {
                song.currentTime = progressBar.value;
            };



        </script>
        <!--   END JS du Player     -->