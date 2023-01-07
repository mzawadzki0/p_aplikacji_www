
// Skrypt odpowiada za pasek przewijania i przycisk scroll top na podstronach

// Ostatnia pozycja aby sprawdzić kierunek przewijania
let lastscroll = 0;

// Kiedy załadowano, przewinięto albo zmieniono rozmiar okna
$(window).on("load resize scroll", "", function() {
    let maxscroll = window.scrollMaxY;

    // Jeśli przewijanie możliwe
    if(maxscroll > 0) {
        // Pokaż pasek postępu i przycisk
        $("#scrollprogress").css("visibility", "visible");
        $("#scroll-to-top").css("visibility", "visible");

        let maxwidth = window.visualViewport.width;
        let currentscroll = window.scrollY;

        // Postęp przewijania od 0 do 1
        let progress = currentscroll / maxscroll;
        

        // Szerokość paska postępu to procent viewport.width
        $("#scrollprogress").css("width", progress * maxwidth  + "px");

        // Pokaż lub ukryj w zależności od kierunku przewijania
        // byłoby trudniej z animate()
        // transition:; w CSS już załatwia sprawę zmiany pozycji przed zakończeniem animacji
        if(currentscroll > 0 && currentscroll >= lastscroll) {
            $("#scroll-to-top").css("bottom", "5px");
        } else {
            $("#scroll-to-top").css("bottom", "");
        }
        lastscroll = currentscroll;
    } else {
        // Domyślna widoczność hidden ale tu dla pewności bo rozmiar okna może się zmienić
        $("#scrollprogress").css("visibility", "");
        $("#scroll-to-top").css("visibility", "");
    }
    
});
