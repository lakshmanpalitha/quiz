



$(document).ready(function () {




    //Initialize the timer
    var sec = 0;
    function pad(val) {
        return val > 9 ? val : "0" + val;
    }
    var timer = setInterval(function () {
        document.getElementById("seconds").innerHTML = pad(++sec);
        document.getElementById("time-counter").value = pad(++sec);
        //document.getElementById("seconds").innerHTML = pad(++sec % 60);
        //document.getElementById("minutes").innerHTML = pad(parseInt(sec / 60, 5));
    }, 1000);

    setTimeout(function () {
        clearInterval(timer);
    }, 5000000);



//dome redy close
});


