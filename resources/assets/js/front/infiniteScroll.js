$(document).ready(function(){
    initInfinite();
});

/**
 * Init infinite scroll handler
 */
function initInfinite(){
    var scroll = {
        // Vars
        marg: 150, // Marg when to launch query next page
        page: 1, // Current page
        lastPage: false, // Check if no more page
        inProgress: false, // Check if a query is already in progress
        loadEasing: 'linear', // Loader animation easing
        loadDuration: 200, // Loader animation duration
        // Methods
        /**
         * Check if infinite scroll is required
         */
        isRequired: function(){
            if(typeof pagData.url !== 'undefined'){
                this.left = $(".blocs.left");
                this.right = $(".blocs.right");
                this.url = pagData.url;
                if(typeof pagData.page !== 'undefined')
                    this.page = parseInt(pagData.page);
                return true;
            }
            return false;
        },
        /**
         * Check if scroll is at end page
         */
        bottom: function(){
            if(this.inProgress || this.lastPage)
                return false;

            var ph = $(".main-container").outerHeight() + $("footer").outerHeight();
            var ws = $(window).scrollTop() + this.marg;
            var wh = $(window).height();
            if(ph - wh < ws)
                this.nextPage();
        },
        /**
         * Get next page products
         */
        nextPage: function(){
            var _this = this;
            this.inProgress = true;
            var url = this.url + (this.page + 1);

            this.displayLoader(true);
            this.launchLoader();

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'JSON',
                complete: function(data){
                    if(data.responseText == 'last'){
                        _this.lastPage = true;
                        _this.displayLoader(false);
                        $(".products-container .no-more").slideDown();
                    }
                    else{
                        _this.page += 1;
                        _this.inProgress = false;
                        _this.left.append(data.responseJSON.left);
                        _this.right.append(data.responseJSON.right);
                    }
                },
                error: function(error){

                }
            });
        },
        /**
         * Hide or show loader
         */
        displayLoader: function(display){
            if(display)
                $(".container-loader").slideDown();
            else
                $(".container-loader").slideUp();
        },
        /**
         * Initiate loader animation
         */
        launchLoader: function(){
            var _this = this;
            if(!this.inProgress){
                this.displayLoader(false);
                return false;
            }

            $(".loader .top").velocity({'width': '100%'}, _this.loadDuration, _this.loadEasing, function(){
                $(".loader .right").velocity({'height': '100%'}, _this.loadDuration, _this.loadEasing, function(){
                    $(".loader .bot").velocity({'width': '100%'}, _this.loadDuration, _this.loadEasing, function(){
                        $(".loader .left").velocity({'height': '100%'}, _this.loadEasing, _this.loadDuration, function(){
                            $(".loader").addClass('invert');
                            $(".loader .top").velocity({'width': '0%'}, _this.loadDuration, _this.loadEasing, function(){
                                $(".loader .right").velocity({'height': '0%'}, _this.loadDuration, _this.loadEasing, function(){
                                    $(".loader .bot").velocity({'width': '0%'}, _this.loadDuration, _this.loadEasing, function(){
                                        $(".loader .left").velocity({'height': '0%'}, _this.loadDuration, _this.loadEasing, function(){
                                            $(".loader").removeClass('invert');
                                            $(".loader div").removeClass('style');
                                            _this.launchLoader();
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
            });
        },
        /**
         * Initialise infinite scroll
         */
        init: function(){
            var _this = this;
            if(this.isRequired()){
                $(window).scroll(function(){
                    _this.bottom();
                });
            }
        }
    };

    scroll.init();
}
