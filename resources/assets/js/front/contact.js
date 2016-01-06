$(document).ready(function(){
    initContact();
});

/**
 * Init contact page events and handlers
 */
function initContact(){
    // Prevent default submit, launch ajax
    $("#contact").submit(function(e){
        e.preventDefault();
        sendMessage();
    });

    // Remove sent message on focus fields
    $("#contact textarea, #contact input").focus(function(){
        if($("#contact").hasClass('sent'))
            $("#contact").removeClass('sent');
    });
}

/**
 * Ajax allowing to send message
 */
function sendMessage(){
    $("#contact").addClass('progress');
    // Serialise form data
    var data = $("#contact").serialize();
    $.ajax({
        url: '/contact/send',
        type: 'POST',
        data: data,
        dataType: 'JSON',
        complete: function(data){
            // Get json response
            var response = data.responseJSON;
            // If no error
            if(response.error && response.error == 'sent'){
                $("#contact").removeClass('progress');
                // Empty fields
                $("#message").val('');
                $("#email").val('');
                // Display message
                $("#contact").addClass('sent');
            }
        },
        error: function(error){

        }
    });
}
