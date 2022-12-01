if(!sessionStorage.getItem("darkmode"))
    sessionStorage.setItem("darkmode", "0");

const elemsToColor = "body, #fullscreen>*, a, #nav * , #content, #content>*";

function switchcolors() {
    sessionStorage.setItem("darkmode", sessionStorage.getItem("darkmode") == "0" ? "1" : "0");
    setcolors();
}

function setcolors() {
    let textcol = document.getElementById("textcol").value;
    let bgcol = document.getElementById("bgcol").value;
    let selected = document.querySelectorAll(elemsToColor);

    if(sessionStorage.getItem("darkmode") == "0") {
        Array.from(selected).forEach(elem => {
            elem.style.backgroundColor = "";
            elem.style.color = "";
            elem.style.boxShadow = "";
        });
        document.getElementById("colswitch").innerHTML = "Zmień kolor";
    } else {
        Array.from(selected).forEach(elem => {
            elem.style.color = textcol;
            elem.style.backgroundColor = bgcol;
            elem.style.boxShadow = "0px 0px 3px gray";
        });
        document.getElementById("colswitch").innerHTML = "Domyślny kolor";
    }
}

function showtime() {
    let now = new Date;
    let date = leadingzero(now.getDate())+"."+leadingzero(now.getMonth()+1)+"."+now.getFullYear();
    let time = leadingzero(now.getHours())+":"+leadingzero(now.getMinutes())+":"+leadingzero(now.getSeconds());
    document.getElementById("time").innerHTML = date;
    document.getElementById("date").innerHTML = time;
    setTimeout(showtime, 1000);
}

function leadingzero(val) {
    if(val<10)
        return "0"+val;
    else
        return val;
}
