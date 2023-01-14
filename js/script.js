// Przechowuje informację czy zastosowano własny styl kolorystyczny dla sesji
// dla switchcolors(), setcolors()
if(!sessionStorage.getItem("darkmode"))
    sessionStorage.setItem("darkmode", "0");

// Lista elementów które mogą zmienić kolor
// w formacie znaczników CSS
// dla switchcolors()
const elems_to_color = "body, #fullscreen>*, a, #nav, #nav * , #content, #content>*, #content>*, #cart-tab, #cart-tab>*";

// Funkcja neguje wartość zmiennej darkmode i wywołuje funkcję setcolors
function switchcolors() {
    sessionStorage.setItem("darkmode", sessionStorage.getItem("darkmode") == "0" ? "1" : "0");
    setcolors();
}

// Funkcja zmienia kolory na podstawie value elementów DOM id:
//  textcol, bgcol (są to pola input type=color)
// oraz na postawie zmiennych globalnych:
//  darkmode, elems_to_color
// przez modyfikację style
// Zmienia także odpowiednio innerHTML elementu DOM id: colswitch
//  (jest to <div onclick=switchcolors() ...)
function setcolors() {
    let textcol = document.getElementById("textcol").value;
    let bgcol = document.getElementById("bgcol").value;
    let selected = document.querySelectorAll(elems_to_color);

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

// Pokaż datę i zegarek cyforwy w innerHTML elementów time, date
// Aktualizacja co 1s
function showtime() {
    let now = new Date;
    let date = leadingzero(now.getDate())+"."+leadingzero(now.getMonth()+1)+"."+now.getFullYear();
    let time = leadingzero(now.getHours())+":"+leadingzero(now.getMinutes())+":"+leadingzero(now.getSeconds());
    document.getElementById("time").innerHTML = date;
    document.getElementById("date").innerHTML = time;
    setTimeout(showtime, 1000);
}

// Dodaj zero z przodu jeśli liczba val jest jednocyfrowa
// Dla daty i czasu
function leadingzero(val) {
    if(val<10)
        return "0"+val;
    else
        return val;
}
