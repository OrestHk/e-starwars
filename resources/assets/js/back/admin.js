$("input[value='delete']").on('click',function(evt){
  var validation = confirm('are you sure ?');
  if(!validation){
    evt.preventDefault();
  }
});

$(document).ready(function(){
  $('.alert.alert-info').delay(5000).fadeOut('slow'); 
});
