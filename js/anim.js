// Funkcja działa od momentu pełnego załadowania strony
// inaczej może nie znaleźć elementów DOM
$( document ).ready(function() {
    // test
    // animacja <div class=test-block> na stronie jQuery
    $(".test-block").on("click", function() {
        $(this).animate({
            width: "500px",
            opacity: 0.4,
            fontSize: "3em",
            borderwidth: "10px"
        }, 1500);
    });

    // Funkcja powiększenie obrazu po kliknięciu
    // działa na elementach img w treści strony
    // tzn. w <div id=content>
    // dwa kliknięcia powiększają o 75 pp, trzecie wraca do 100%
    // oraz wraca do domyślnej wartości po opuszczeniu przez kursor obszaru danego img
    $(".article img, #product-tab img").on({
        mouseenter: function() {
            let zoom = 1;
            $(this).click(function() {
                if(zoom < 2.2)
                    zoom += 0.6;
                else
                    zoom = 1;
                 $(this).css("transform", "scale("+zoom+")");
            })
        },
        mouseleave: function() {
            $(this).css({"transform": ""})
        }
    });
});
