$(document).ready(function(){
    $('.alert.alert-info').delay(5000).fadeOut('slow');

    $(".form-group .btn-delete").click(function(){
      var form = $(".delete-conf form");
      var action = form.attr('data-url')+'/'+$(this).attr('data-id');
      form.attr('action', action);
      $(".delete-conf #id").val($(this).attr('pid'));
      $(".delete-conf").fadeIn(300);
    });

    $(".delete-conf .aboart").click(function(e){
      e.preventDefault();
      $(".delete-conf").fadeOut(300);
    });
});
