const background = document.querySelector('#background'); 
const thumbnail = document.querySelector('#thumbnail'); 
const song = document.querySelector('#song'); 

const songArtist = document.querySelector('.song-artist'); 
const songTitle = document.querySelector('.song-title'); 
const progressBar = document.querySelector('#progress-bar');
let pPause = document.querySelector('#play-pause');

songIndex = 0;
songs = ['./assets/music/high_fashion.mp3', './assets/music/Malcolm.mp3']; 
thumbnails = ['./assets/img/roddy.jpg', './assets/img/MILS.jpg']; 
songArtists = ['Roddy Rich', 'Ninho']; 
songTitles = ["High Fashion", "Malcolm"];

let playing = true;
function playPause() {
    if (playing) {
        const song = document.querySelector('#song'),
        thumbnail = document.querySelector('#thumbnail');

        pPause.src = "./assets/icons/pause.png";
        
        song.play();
        playing = false;
    } else {
        pPause.src = "./assets/icons/play.png";
        
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
    if (songIndex > 1) {
        songIndex = 0;
    };
    song.src = songs[songIndex];
    thumbnail.src = thumbnails[songIndex];
    background.src = thumbnails[songIndex];

    songArtist.innerHTML = songArtists[songIndex];
    songTitle.innerHTML = songTitles[songIndex];

    playing = true;
    playPause();
}

function previousSong() {
    songIndex--;
    if (songIndex < 0) {
        songIndex = 1;
    };
    song.src = songs[songIndex];
    thumbnail.src = thumbnails[songIndex];
    background.src = thumbnails[songIndex];

    songArtist.innerHTML = songArtists[songIndex];
    songTitle.innerHTML = songTitles[songIndex];

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