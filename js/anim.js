$( document ).ready(function() {
    $(".test-block").on("click", function() {
        $(this).animate({
            width: "500px",
            opacity: 0.4,
            fontSize: "3em",
            borderwidth: "10px"
        }, 1500);
    });

    $("#content img").on({
        mouseenter: function() {
            let zoom = 1;
            $(this).click(function() {
                if(zoom < 2.5)
                    zoom += 0.75;   
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
