const thumbnail = document.querySelector('#thumbnail'); // album cover 
const song = document.querySelector('#song'); // audio 

const songArtist = document.querySelector('.song-artist'); // element où noms artistes apparaissent
const songTitle = document.querySelector('.song-title'); // element où titre apparait
const progressBar = document.querySelector('#progress-bar'); // element où progress bar apparait
let pPause = document.querySelector('#play-pause'); // element où images play pause apparaissent

let mouseDown = false;



songIndex = 0;
songs = ['./audio/go_legend.mp3','./audio/futsal_shuffle_2020.mp3','./audio/tip_toe.mp3']; //Stockage des audios
thumbnails = ['./img/bigmetro.jpg', './img/luv.jpg', './img/roddy.jpg']; //Stockage des covers
songArtists = ['Big Sean & Metro Boomin(ft. Travis Scott)', 'Lil Uzi Vert', 'Roddy Rich']; //Stockage Noms Artistes
songTitles = ["Go Legend", "Futsal Shuffle 2020", "Tip Toe"]; //Stockage Titres

/*
let playing = true;
function playPause(songIndex) {
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

*/


let playing = true;
function playPause(songIndex) {
    song.src = songs[songIndex];
    thumbnail.src = thumbnails[songIndex];
    songArtist.innerHTML = songArtists[songIndex];
    songTitle.innerHTML = songTitles[songIndex];
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
setInterval(updateProgressValue, 500);

// Valeur de la bar qd curseur est glissé sans lecture
function changeProgressBar() {
    song.currentTime = progressBar.value;
};
