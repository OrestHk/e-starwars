$(document).ready(function(){
    init();
});

/**
 * Init all functions
 */
function init(){
    // Allow ajax calls globaly
    $.ajaxSetup({
       headers:{'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content')}
    });

    scroll();
    menu();
    fixFooter();
    buttons();

    $(window).resize(function(){
        menuOverflow();
        fixFooter();
    });
}

/**
 * Buttons events handlers
 */
function buttons(){
    $(".container-btn input.btn").focus(function(){
        $(this).parent('.container-btn').addClass('hover');
    });
    $(".container-btn input.btn").focusout(function(){
        $(this).parent('.container-btn').removeClass('hover');
    });
}
/**
 * Fix footer if not enought content
 */
function fixFooter(){
    var container = $(".main-container").height();
    var wh = $(window).height();
    if(container < wh)
        $("footer").addClass('fixed');
    else
        $("footer").removeClass('fixed');
}

/**
 * Init menu overflow handler
 */
function menuOverflow(){
    var availableSize = $(".main-menu").height();
    $(".main-menu .main").each(function(){
        availableSize -= $(this).outerHeight(true);
    })
    availableSize -= $(".main-menu .tags").outerHeight(true) - $(".main-menu .tags").outerHeight();
    $(".main-menu .tags").css('max-height', availableSize);
}

/**
 * Init open close menu listener
 */
function menu(){
    // Open Close
    $(".menu, .overlay").click(function(){
        $(".menu").toggleClass('open');
        $(".overlay").fadeToggle(300);
        $(".main-menu").toggleClass('open');
        $('body').toggleClass('hidden');
    });
    // Overflow
    menuOverflow();
}

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
