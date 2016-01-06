'use strict'
var Cart = {
    totalPrice:0,
    product:[],
    order:{},

    addOderItem:function(id,quantity){
        this.order[id] = quantity;
        this.orderToCookie();
        $('#successAddInCart').fadeIn().delay(2500).fadeOut();
    },

    orderToCookie: function () {
        Cookies.set('SwC',this.order);
        console.log(Cookies.get());
    },

    orderToObj:function(){
        this.order = JSON.parse(Cookies.get('SwC'));
        console.log(this.order);
    },
    orderProced: function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var name = $('#CustomerName').val();
        var mail = $('#CustomerMail').val();
        console.log(name,mail);
        $.ajax({
            url:'/validationOrder/',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                order:this.order,
                name:name,
                email:mail,
                total:this.totalPrice
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
    }

}



$(document).ready(function(){

    var isProduct = location.pathname.split('/')[1] == 'products' ? true : false;
    if(isProduct){
        Cart.orderToObj();
    }

});

$('#orderValidation').submit(function(evt){
    evt.preventDefault();
    Cart.orderProced();
});

$('input[name="order"]').on('click',function(evt){
    evt.preventDefault();
    Cart.addOderItem($('input[name="product_id"]').val(),$('#quantity :selected').text());
});
