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
        updated: false, // Cart updated
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
         * Buy what's in the cart
         */
        orderProced: function(){
            var _this = this;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var name = $('#CustomerName').val();
            var mail = $('#CustomerMail').val();
            console.log(name,mail);
            $.ajax({
                url:'/validationOrder/',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    order: _this.order,
                    name: name,
                    email: mail,
                    total: _this.totalPrice
                },
                dataType: 'JSON',
                complete: function (data){
                    if(data == 1){
                        $('#successOrder').fadeIn().delay(5000).fadeOut();
                        window.location.reload();
                    }
                },
                error:function(error){
                    console.log(error);
                    //alert('Whoops !! error:'+error);
                }
            });
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

            $("#quantity").keypress(function(e){
                _this.forceNumbers(e, $(this));
            });
        },
    };

    Cart.init();
}
