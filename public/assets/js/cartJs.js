'use strict'
var Cart = {
    totalPrice:0,
    product:[],
    order:{},

    addOderItem:function(id,quantity){
        this.order[id] = quantity;
        this.orderToCookie();
    },

    orderToCookie: function () {
        Cookies.set('SwC',this.order);
        console.log(Cookies.get());
    },



    orderToArray:function(){
        var arrayTest = [];
        var string = localStorage.command;
        if(typeof(string) == typeof('string')){
            if(typeof(string.split('|')) === typeof(arrayTest)){
                string = localStorage.command.split('|');
                for(var i = 0 ; i < string.length ; i++){
                    var str = string[i].split('_');
                    this.order[str[0]]=str[1];
                }
            }else{
                var str = localStorage.command.split('_');
                this.order[str[0]]=str[1];
            }
        }
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
                localStorage.clear();
            },
            error:function(error){
                console.log(error);
                //alert('Whoops !! error:'+error);
            }
        });
    }
    /*
     orderList:function(){

     this.orderToArray();
     var order;
     var tab = [];
     for(order in this.order){
     tab.push(order);
     }
     this.AjaxProduct(tab);

     },

     AjaxProduct:function(ids){
     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
     $.ajax({
     url:'/orderObj/',
     type: 'POST',
     data: {
     _token: CSRF_TOKEN,
     'ids':ids
     },
     dataType: 'JSON',
     complete: function (data){
     Cart.productToHTML(JSON.parse(data.responseText));
     },
     error:function(error){
     console.log(error);
     //alert('Whoops !! error:'+error);
     }
     });
     },

     productToHTML:function(product){
     console.log(product);
     var total = 0;
     for(var i = 0; i < product.length ;i++){
     this.totalPrice += this.order[product.id] * product[i].price;
     var _html = '<div class=""><p>name: '+product[i].name+'</p>'+
     '<img src="assets/images/products/'+product[i].picture.filename+'">'+
     '<p>price: '+product[i].price+'</p>'+
     '<p>quantity: '+this.order[product[i].id]+'</p>'+
     '<p>final cost: '+this.order[product[i].id] * product[i].price+'</p></div>';
     total += this.order[product[i].id] * product[i].price;
     $('#orderList').append(_html);
     }
     this.totalPrice = total;
     $('#orderList').append('<p>total = '+total+'</p>');

     },*/


}



$(document).ready(function(){

    var isProduct = location.pathname.split('/')[1] == 'products' ? true : false;
    var isOrder = location.pathname.split('/')[1] == 'order' ? true : false;
    var checkekCart = localStorage.getItem('command');
    if(typeof(checkekCart) !== typeof(Cart) && isProduct){
        Cart.orderToArray();
    }
    if(isOrder){
        //Cart.orderList();
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
