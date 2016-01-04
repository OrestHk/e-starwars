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
        var total = 0;
        for(var i = 0; i < product.length - 1;i++){
            this.totalPrice += this.order[product.id] * product[i].price;
            var _html = '<div class=""><p>name: '+product[i].name+'</p>'+
                '<img src="assets/images/products/'+product[i].picture.filename+'">'+
                '<p>price: '+product[i].price+'</p>'+
                '<p>quantity: '+this.order[product[i].id]+'</p>'+
                '<p>final cost: '+this.order[product[i].id] * product[i].price+'</p></div>';
            total += this.order[product[i].id] * product[i].price;
            $('#orderList').append(_html);
        }
        $('#orderList').append('<p>total = '+total+'</p>');

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
                  email:mail
              },
              dataType: 'JSON',
              complete: function (data){
                  Cart.productToHTML(JSON.parse(data.responseText));
                  localStorage.clean();
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
    var isOrder = location.pathname.split('/')[1] == 'order' ? true : false;
    var checkekCart = localStorage.getItem('command');
      if(typeof(checkekCart) !== typeof(Cart) && isProduct){
          Cart.orderToArray();
      }
      if(isOrder){
        Cart.orderList();
      }
  });

  $('#orderValidation').submit(function(evt){
      evt.preventDefault();
     Cart.orderProced();
  });

  $('input[name="order"]').on('click',function(){
      Cart.addOderItem($(this).attr('data-id'),$('#quantity :selected').text());
  });
