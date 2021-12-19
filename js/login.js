$(document).ready(function(){
    
    $('#login_btn').click(function(){
     var error_username = '';
     var error_password = '';
     
     if($.trim($('#username').val()).length == 0)
     {
      error_username = 'Please enter your email.';
      $('#error_username').text(error_username);
      $('#username').addClass('has-error');
     }
     else
     {
      error_username = ' ';
      $('#error_username').text(error_username);
     }
     
     if($.trim($('#password').val()).length == 0)
     {
      error_password = 'Please enter your password.';
      $('#error_password').text(error_password);
      $('#password').addClass('has-error');
     }
     else
     {
      error_password = ' ';
      $('#error_password').text(error_password);
     }
     
     if(error_username != ' ' || error_password != ' ')
     {
        return false;
     }
     else
     {
        /* LET 'EM LOGIN */
        return true;
     }
    });

});