$(document).ready(function(){
		myAudio = new Audio('./music/lobby-theme.mp3');
myAudio.addEventListener('ended', function() {
    this.currentTime = 0;
    this.play();
}, false);
myAudio.play();
});
