var toReach = new Date("June 22, 2020 00:00:00");

function countdown() {



    var now = new Date();
    var diff = Math.floor((toReach.getTime() - now.getTime()) / 1000);
    if (diff > 0) {
        var days = Math.floor(diff /(60*60*24));
        var hours = Math.floor(diff%86400 / 3600);

        $("#d").html(days+"j");
     
    } else {

        $("#countdown").html("Date dépassé");

    }
}

$(document).ready(function(){

    window.setInterval(countdown,1000);
    countdown();

})