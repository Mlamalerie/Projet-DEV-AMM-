const thumbnail = document.querySelector('#thumbnail'); // album cover 
const song = document.querySelector('#song'); // audio 

const songArtist = document.querySelector('.song-artist'); // element où noms artistes apparaissent
const songTitle = document.querySelector('.song-title'); // element où titre apparait
const progressBar = document.querySelector('#progress-bar'); // element où progress bar apparait
let pPause = document.querySelector('#play-pause'); // element où images play pause apparaissent

let mouseDown = false;

songIndex = 0;
songs = ['./audio/high_fashion.mp3','./audio/DB5.mp3','./audio/Malcolm.mp3']; //Stockage des audios
thumbnails = ['./img/roddy.jpg', './img/DB5.jpg', './img/MILS.jpg']; //Stockage des covers
songArtists = ['Roddy Rich', 'Leto', 'Ninho']; //Stockage Noms Artistes
songTitles = ["High Fashion", "Double Bang 5", "Malcolm"]; //Stockage Titres


let playing = true;
function playPause() {
    if (playing) {
        const song = document.querySelector('#song'),
              thumbnail = document.querySelector('#thumbnail');
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
    playPause();
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
    playPause();
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
setInterval(updateProgressValue, 500);

// Valeur de la bar qd curseur est glissé sans lecture
function changeProgressBar() {
    song.currentTime = progressBar.value;
};

