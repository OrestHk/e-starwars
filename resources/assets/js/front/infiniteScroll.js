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
                // Check if given page (ex: /products/2)
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
            // If already loading a page or no more pages, end
            if(this.inProgress || this.lastPage)
                return false;

            // Page height
            var ph = $(".main-container").outerHeight() + $("footer").outerHeight();
            // Window scroll
            var ws = $(window).scrollTop() + this.marg;
            // Window height
            var wh = $(window).height();
            // If end page, load next page
            if(ph - wh < ws)
                this.nextPage();
        },
        /**
         * Get next page products
         */
        nextPage: function(){
            var _this = this;
            this.inProgress = true;
            // Next page url
            var url = this.url + (this.page + 1);

            // Show loader
            this.displayLoader(true);
            this.launchLoader();

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'JSON',
                success: function(data){
                    // If no more products (last page)
                    if(data.responseText == 'last'){
                        _this.lastPage = true;
                        // Hide loader
                        _this.displayLoader(false, function(){
                            // Show message
                            $(".products-container .no-more").slideDown();
                        });
                    }
                    else{
                        // Change current page
                        _this.page += 1;
                        // Append products
                        _this.left.append(data.responseJSON.left);
                        _this.right.append(data.responseJSON.right);
                    }
                    _this.inProgress = false;
                },
                error: function(error){

                }
            });
        },
        /**
         * Hide or show loader
         */
        displayLoader: function(display, callback){
            if(display){
                $(".container-loader").slideDown(300, function(){
                    if(callback)
                        callback();
                });
            }
            else{
                $(".container-loader").delay(200).slideUp(300, function(){
                    if(callback)
                        callback();
                });
            }
        },
        /**
         * Initiate loader animation
         */
        launchLoader: function(){
            var _this = this;
            // If page isn't loading, hide loader
            if(!this.inProgress){
                this.displayLoader(false);
                return false;
            }

            // Loader animation
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
