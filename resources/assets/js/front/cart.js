'use strict';

// Global vars
var Cart;

$(document).ready(function(){
    initCart();
});

/**
 * Init cart handler
 */
function initCart(){
    Cart = {
        // Vars
        order: {}, // Client order
        totalPrice: 0, // Order total price
        updated: false, // Cart updated ?
        updatingPrices: false, // Updating prices ?
        // Methods
        /**
         * Add an item to the cart
         */
        addOderItem: function(id, quantity){
            // If quantity = 0, remove from cart
            if(quantity == 0){
                // Hide message already in cart
                $(".already").addClass('none');
                delete this.order[id];
            }
            // Update quantity
            else
                this.order[id] = quantity;

            // Display Cart updated message
            this.updated = true;
            $("#addcart .add .message").velocity({'top': 0}, 200);

            // Update cookie
            this.orderToCookie();
            // Change quantity in already in cart
            $(".already .quantity").text(quantity);
        },
        /**
         * Update order cookie
         */
        orderToCookie: function () {
            Cookies.set('SwC', this.order);
            this.updateCartSize();
            console.log(Cookies.get());
        },
        /**
         * Transform cookie to this.order
         */
        orderToObj: function(){
            // Check if cookie exist
            if(!Cookies.get('SwC'))
                return false;

            // Update this.order
            this.order = JSON.parse(Cookies.get('SwC'));
            this.updateCartSize();
            this.giveQuantity();
            console.log(this.order);
        },
        /**
         * Update number of elements in the cart
         */
        updateCartSize: function(){
            // Cart size
            var size = 0;
            var order;
            for(order in this.order){
                size++;
            }

            // Change cart size
            $(".cart .items").text(size);
        },
        /**
         * Give quantity if already in the cart
         */
        giveQuantity: function(){
            // If not in single product page, aboart
            if(!$(".product .single").length)
                return false;

            // Get product id
            var id = $("#product_id").val();
            // If product is in cart
            if(this.order[id]){
                // Change quantity to the one in the cart
                $("#quantity").val(this.order[id]);
                // Display message already in cart
                $(".already").removeClass('none');
                $(".already .quantity").text(this.order[id]);
            }
        },
        /**
         * Remove product from the cart
         */
        removeOderItem: function(id){
            var _this = this;
            // Check if prices already updating
            if(this.updatingPrices)
                return false;
            // Remove item from order
            delete this.order[id];
            // Update cookie
            this.orderToCookie();
            // Get products datas
            this.getProductsInfos(function(data){
                _this.updatingPrices = false;
                // If no errors
                if(data != false){
                    _this.updatePrices(data);
                    // Hide product from list
                    _this.hideProduct(id);
                }
            });
        },
        /**
         * Hide products deleted from the cart
         */
        hideProduct: function(id){
            var _this = this;
            // Get product to remove
            var product = $(".orderContainer.product-"+id);
            // Check cart size
            var cartSize = this.getSize();
            if(cartSize > 0){
                // Hide then remove the product
                product.wrap('<div class="wrapper"></div>');
                product.parent('.wrapper').slideUp(300, function(){
                    $(this).remove();
                });
            }
            // If no more products in cart, hide summary
            else{
                // Hide cart summary
                $("#orderList").slideUp(300, function(){
                    // Show empty message
                    $(".order .empty").fadeIn();
                    // Reset cart
                    _this.order = {};
                    _this.updateCartSize();
                    // Delete cookie
                    Cookies.remove('SwC');
                });
            }
        },
        /**
         * Return cart size (number of products in it)
         */
        getSize: function(){
            var size = 0;
            var order;
            for(order in this.order){
                size++;
            }
            return size;
        },
        /**
         * Get products informations
         */
        getProductsInfos: function(callback){
            this.updatingPrices = true;
            // Loader

            // Get updated data
            $.ajax({
                url:'/order/',
                type: 'GET',
                data: null,
                dataType: 'JSON',
                complete: function(data){
                    // If return contain products
                    if(typeof data.responseJSON != 'indefined')
                        callback(data.responseJSON);
                    // Return error
                    else
                        callback(false);
                },
                error: function(){
                    // Return error
                    callback(false);
                }
            });
        },
        /**
         * Update summary prices
         */
        updatePrices: function(infos){
            // Update total price
            $(".finalPrice .amount").text(infos.cost);
            var i = 0;
            var nbProdcuts = infos.products.length;
            // Update products prices (if needed)
            for(i; i < nbProdcuts; i++){
                var productData = infos.products[i];
                var product = $(".orderContainer.product-"+productData.id);
                product.find('.price .amount').text(productData.price);
                product.find('.totalPrice .amount').text(productData.final_price);
            }
        },
        /**
         * Buy what's in the cart
         */
        orderProced: function(){
            var _this = this;
            // Hide error if displayed
            $("#orderValidation .error").slideUp();
            // Get user inputs
            var name = $('#CustomerName').val();
            var mail = $('#CustomerMail').val();
            console.log(name,mail);
            // Controle purchase
            $.ajax({
                url:'/order/validation/',
                type: 'POST',
                data: {
                    name: name,
                    email: mail,
                    order: _this.order,
                },
                dataType: 'JSON',
                complete: function(data){
                    var response = data.responseJSON ? data.responseJSON : false;
                    if(typeof response.error != 'undefined')
                        _this.errorHandler(response.error);
                },
                error:function(error){
                    console.log(error);
                    //alert('Whoops !! error:'+error);
                }
            });
        },
        /**
         * Purchase erros handler
         */
        errorHandler: function(error){
            var _this = this;
            switch(error){
                // No error
                case 0 :
                    // Hide cart summary
                    $("#orderList").slideUp(300, function(){
                        // Show confirm message
                        $(".order .confirm").fadeIn();
                        $(".order").addClass('ordered');
                        // Reset cart
                        _this.order = {};
                        _this.updateCartSize();
                    });
                break;
                // User not registered
                case 1 :
                    // Display error message
                    $("#orderValidation .error")
                        .text('Looks like you ain\'t one of us !')
                        .slideDown();
                break;
            }
        },
        /**
         * Input type number quantity
         */
        forceNumbers: function(e, el){
            // Get char value
            var char = parseInt(String.fromCharCode(e.keyCode));
            var regxp = /^[0-9]{0,2}$/;
            // Check if char isn't a number
            if(!regxp.test(char))
                e.preventDefault();
        },
        /**
         * Change product quantity
         */
        changeQuantity: function(add){
            // Get current quantity
            var quantity = parseInt($("#quantity").val());
            // Check if not a number
            if(isNaN(quantity))
                quantity = 0;
            // Add or remove from current quantity
            quantity += add;
            // If result < 0, set it to 0
            if(quantity < 0)
                quantity = 0;
            // If result > 99, set it to 99
            if(quantity > 99)
                quantity = 99;

            // Hide Cart updated message
            if(this.updated)
                $("#addcart .add .message").velocity({'top': '100%'}, 200);

            // Update quantity
            $("#quantity").val(quantity);
        },
        /**
         * Init cart
         */
        init: function(){
            var _this = this;
            this.orderToObj();

            // Add to cart handler
            $('#addcart').submit(function(e){
                e.preventDefault();
                // Get current quantity
                var quantity = parseInt($("#quantity").val());
                // Check if not a number, if so set to 0
                if(isNaN(quantity))
                    quantity = 0;
                // Get product id
                var id = $("#product_id").val();
                _this.addOderItem(id, quantity);
            });

            // Buy what's in the cart
            $('#orderValidation').submit(function(e){
                e.preventDefault();
                _this.orderProced();
            });

            // Add more or less of the product
            $(".quantity").click(function(){
                if($(this).hasClass('more'))
                    _this.changeQuantity(1);
                else
                    _this.changeQuantity(-1);
            });

            // Remove product from cart
            $(".orderContainer .remove").click(function(){
                _this.removeOderItem($(this).attr('data-id'));
            });

            $("#quantity").keypress(function(e){
                _this.forceNumbers(e, $(this));
            });
        },
    };

    Cart.init();
}
