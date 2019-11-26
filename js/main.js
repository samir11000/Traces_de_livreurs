function getWidth() {
    return Math.max(
      document.body.scrollWidth,
      document.documentElement.scrollWidth,
      document.body.offsetWidth,
      document.documentElement.offsetWidth,
      document.documentElement.clientWidth
    );
  }

function cut()
{
    var short = document.getElementById("short").innerHTML;
    var short2 = document.getElementById("short2").innerHTML;
    var short3 = document.getElementById("short3").innerHTML;

    var xLength = window.innerWidth;

    console.log(xLength);

    if (short.length >= 103 && xLength <= 854) {
        document.getElementById("short").innerHTML = short.slice(0, 103);
    }
    
    if (short2.length >= 126 && xLength <= 854) {
        document.getElementById("short2").innerHTML = short2.slice(0, 126);
    }

    if (short3.length >= 20 && xLength <= 854) {
        document.getElementById("short3").innerHTML = short3.slice(0, 88);
    }

    console.log(short);
}


window.onload = cut;