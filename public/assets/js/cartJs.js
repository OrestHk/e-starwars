  'use strict'
  var Cart = {
    totalPrice:0,
    product:[],
    order:{},

    addOderItem:function(id,quantity){
      this.order[id] = quantity;
      this.orderToString();
    },

    orderToString:function(){
        var string = localStorage.getItem('command');

        var order;
        for(order in this.order){
          if(typeof(string)===typeof(this))
            string = order+'_'+this.order[order];
          else
            string += '|'+order+'_'+this.order[order];
        }
        localStorage.setItem('command', string);
        console.log('orderToString');
        console.log(localStorage.command);
        // this.orderString = this.order+'*'+this.order.quantity+'|';
        // console.log(this.orderString);
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
      console.log('orderToArray');
      console.log(this.order);
    },

    orderList:function(){

      this.orderToArray();
      var order;
      for(order in this.order){
        this.AjaxProduct(order);
      }


    },

    AjaxProduct:function(id){
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      console.log(id);
      $.ajax({
          url:'/order/'+id,
          type: 'GET',
          data: {_token: CSRF_TOKEN,
                'id':id
              },
          dataType: 'JSON',
          complete: function (data) {
              Cart.productToHTML(data.responseText);
          },
          error:function(error){
            console.log(error);
            //alert('Whoops !! error:'+error);
          }
      });
    },

    productToHTML:function(product){
      console.log(this.order);
      console.log(product);
      /*
      this.totalPrice += this.order[product.id] * product.price;
        var _html = '<p>name: '+product.name+'</p>'+
                    '<p>price: '+product.price+'</p>'+
                    '<p>quantity: '+this.order[product.id]+'/<p>'+
                    '<p>final cost: '+this.order[product.id] * product.price+'/<p>';

      $('#orderList').append(_html);
      */
    },

  }



  $(document).ready(function(){

    var isProduct = location.pathname.split('/')[1] == 'products' ? true : false;
    var isOrder = location.pathname.split('/')[1] == 'order' ? true : false;
    var checkekCart = localStorage.getItem('command');
      if(typeof(checkekCart) !== typeof(Cart) && isProduct){
          Cart.orderToArray();
      }
      if(isOrder){
        Cart.orderList();
      }
  });


  $('input[name="order"]').on('click',function(){
      Cart.addOderItem($(this).attr('data-id'),$('#quantity :selected').text());
  });
