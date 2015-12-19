  'use strict'
  var Cart = {
    orders: [],
    order:{},

    addOderItem:function(id,quantity){
      this.order[id] = quantity;
      this.orderToString();
    },

    orderToString:function(){
        var string = localStorage.getItem('command');
        localStorage.clear();
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

      var string = localStorage.command.split('|');
      localStorage.clear();
      if(string.length > 0){
        for(var i = 0 ; i < string.length - 1; i++){
          var str = string[i].split('_');
          this.orders.push(this.order[str[0]]=str[1]);
        }
      }else{
        var str = string.split('_');
        this.orders.push(this.order[str[0]]=str[1]);
      }
      console.log('orderToArray');
        console.log(this.orders);
    },


  }



  $(document).ready(function(){
    var checkekCart = localStorage.getItem('command');
    if(typeof(checkekCart) !== typeof(Cart)){
        Cart.orderToArray();
    }
    else {

    }
  });


  $('input[name="order"]').on('click',function(){
      Cart.addOderItem($(this).attr('data-id'),$('#quantity :selected').text());
  });
