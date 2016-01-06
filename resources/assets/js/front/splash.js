$(document).ready(function(){
    initSplash();
});

/**
 * Init splash screen handler
 */
function initSplash(){
    if(!$(".splash").length)
        return false;

    // Splash object
    splash = {
        // Vars
        images: ['/assets/images/logo.png', '/assets/images/header-border.png', '/assets/images/footer-border.png'],
        container: $(".splash"),
        bot: $(".splash .bot"),
        top: $(".splash .top"),
        image: $(".splash img"),
        openDelay: 800,
        // Methods
        // Load images required for the animation
        load: function(){
            var _this = this;
            var i = 0;
            var count = 1;
            var nbImages = this.images.length;
            for(i; i < nbImages; i++){
                var image = new Image();
                image.onload = function(){
                    count++;
                    if(count === nbImages)
                         _this.animate();
                };
                image.src = this.images[i];
            }
        },
        // Launch splash animation
        animate: function(){
            var _this = this;
            this.container.addClass('ready');
            this.image.fadeIn(300, function(){
                $(window).scrollTop(0);
                _this.top.delay(_this.openDelay).velocity({
                    height: 60
                }, 450);
                _this.bot.delay(_this.openDelay).velocity({
                    height: 0,
                    bottom: '-20px'
                }, 450);
                _this.image.delay(_this.openDelay).velocity({
                    top: '-80px',
                    marginTop: 0
                }, 450, function(){
                    _this.container.fadeOut();
                });
            });
        }
    };

    splash.load();
}
