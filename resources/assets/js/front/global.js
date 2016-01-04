$(document).ready(function(){
    scroll();
});

/**
 * Init scroll listener to toggle header reduced form
 */
function scroll(){
    // Check if window already scrolled reduced form
    if($(window).scrollTop() > 50)
        $("body").addClass('reduced');
    else
        $("body").removeClass('reduced');
    // Listen scroll to toggle form
    $(window).scroll(function(){
        if($(this).scrollTop() > 50)
            $("body").addClass('reduced');
        else
            $("body").removeClass('reduced');
    });
}
