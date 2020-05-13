let audio = new Audio('Malcolm.mp3');

let seekBar = document.querySelector('.seek-bar'); //barre de recherche
let playButton = document.querySelector('button.play'); //bouton play
let playButtonIcon = playButton.querySelector('i'); //icone bouton play
let fillBar = seekBar.querySelector('.fill'); //barre de remplissage

let mouseDown = false;




//fonctionnement du bouton Lecture/Pause
playButton.addEventListener('click', function () { 
    if (audio.paused) {
        audio.play();
    } else {
        audio.pause();
    }
});
audio.addEventListener('play', function () {
    playButtonIcon.className = 'ion-pause';
});
audio.addEventListener('pause', function () {
    playButtonIcon.className = 'ion-play';
});


//Mise a jour de la barre de remplissage en fct du temps
audio.addEventListener('timeupdate', function () {
    if (mouseDown) return;
    let p = audio.currentTime / audio.duration;
    fillBar.style.width = p * 100 + '%';
});


//encadrement de valeurs
function clamp (min, val, max) {
    return Math.min(Math.max(min, val), max);
}

//Détermine où on clique sur la barre
function getP (e) {
    let p = (e.clientX - seekBar.offsetLeft) / seekBar.clientWidth;
    p = clamp(0, p, 1); //encadrement entre 0 (début) et 1 (fin)
    return p;
}


seekBar.addEventListener('mousedown', function (e) {
    mouseDown = true;
    let p = getP(e);
    fillBar.style.width = p * 100 + '%';
});

//Relacher la souris où tu veux
window.addEventListener('mouseup', function (e) {
    if (!mouseDown) return;
    mouseDown = false;
    let p = getP(e);
    fillBar.style.width = p * 100 + '%';
    audio.currentTime = p * audio.duration;
});
window.addEventListener('mousemove', function (e) {
    if (!mouseDown) return;
    let p = getP(e);
    fillBar.style.width = p * 100 + '%';
});