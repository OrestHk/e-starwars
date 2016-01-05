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

    $(window).resize(function(){
        menuOverflow();
        fixFooter();
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

/**
 * Set a cookie
 * @param {string} name : the name of the cookie
 * @param {string} value : the value of the cookie
 * @param {integer} expire : days until expiration
 */
function setCookie(name, value, expire){
    var date = new Date();
    date.setTime(date.getTime() + (expire * 24 * 60 * 60 * 1000));
    var expires = "expires="+date.toUTCString();
    document.cookie = name + "=" + value + "; " + expire;
}
/**
 * Get a cookie
 * @param {string} name : the name of the cookie
 */
function getCookie(name){
    var name = name + "=";
    var cookies = document.cookie.split(';');
    var i = 0;
    var nbCookies = cookies.length;

    for(i; i < nbCookies; i++){
        var cookie = cookies[i];
        while (cookie.charAt(0) == ' ') cookie = cookie.substring(1);
        if(cookie.indexOf(name) == 0)
            return cookie.substring(name.length, cookie.length);
    }
    return "";
}
