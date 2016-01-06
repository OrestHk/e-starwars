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
            console.log(this.url, this.page, this.page + 1);
            var url = this.url + (this.page + 1);
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'JSON',
                complete: function(data){
                    if(data.responseText == 'last')
                        _this.lastPage = true;
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
