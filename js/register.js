$(document).ready(function(){
 
    $('#account-info-btn').click(function(){
     
     var error_email = '';
     var error_password = '';
     var error_confirm = '';
     var error_first_name = '';
     var error_last_name = '';
     var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
     
     if($.trim($('#email').val()).length == 0)
     {
      error_email = 'Please enter your email. (No spam, we promise!)';
      $('#error_email').text(error_email);
     }
     else
     {
      if (!filter.test($('#email').val()))
      {
       error_email = 'Invalid Email';
       $('#error_email').text(error_email);
      }
      else
      {
       error_email = '';
       $('#error_email').text(error_email);
      }
     }
     
     if($.trim($('#password').val()).length == 0)
     {
      error_password = 'Please enter a password for your account.';
      $('#error_password').text(error_password);
     }
     else
     {
      error_password = '';
      $('#error_password').text(error_password);
     }

     if($.trim($('#confirm').val()).length == 0)
     {
      error_confirm = 'Passwords must match.';
      $('#error_confirm').text(error_confirm);
     }
     else if ($.trim($('#confirm').val()) != $.trim($('#password').val()))
     {
        error_confirm = 'Passwords must match.';
        $('#error_confirm').text(error_confirm);
     }
     else
     {
      error_password = '';
      $('#error_password').text(error_password);
     }

     if($.trim($('#first_name').val()).length == 0)
     {
     error_first_name = 'Please enter your first name.';
     $('#error_first_name').text(error_first_name);
     $('#first_name').addClass('has-error');
     }
     else
     {
     error_first_name = '';
     $('#error_first_name').text(error_first_name);
     }

     if($.trim($('#last_name').val()).length == 0)
     {
      error_last_name = 'Please enter your last name.';
      $('#error_last_name').text(error_last_name);
     }
     else
     {
      error_last_name = '';
      $('#error_last_name').text(error_last_name);
     }

     if(error_email != '' || error_password != '' || error_confirm != '' || error_first_name != '' || error_last_name != '')
     {
      return false;
     }
     else
     {
        $('#account-info-container').addClass('tab-pane fade');
        $('#account-info-container').removeClass('active');
        $('#personal-info-container').addClass('active in');
     }
    });

    $('#personal-info-btn').click(function(){

        /* ------------WORKING AJAX CONNECTION------------------

        hr = new XMLHttpRequest();
        var url = "imageupload.php";
        vars = document.getElementById("country").value;
        
        hr.open("POST", url, true);
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        hr.onreadystatechange = function()
        {
            if(hr.readyState == 4 && hr.status == 200)
            {
                var return_data = hr.responseText;
                document.getElementById("msg").innerHTML = return_data;
            }
        }
        hr.send();
        //vars goes inside when passing data to php 
        
        ------------WORKING AJAX CONNECTION------------------*/

        var file_data = $("#fileToUpload").prop('files')[0];
        var form_data = new FormData();                  
        form_data.append('file', file_data);
        //alert(form_data);
        
        if(file_data != null)
        {
            $.ajax({
                url: './php/headshotupload.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){
                    //alert(php_script_response); // display response from the PHP script, if any
                }
            });
        }
        form_data.delete('file');

        var error_country = '';

        if($.trim($('#country').val()).length == 0)
        {
        error_country = 'Please specify your location.';
        $('#error_country').text(error_country);
        }
        else
        {
        error_country = '';
        $('#error_country').text(error_country);
        }
        if(error_country != '')
        {
        return false;
        }
        else
        {  
            $('#personal-info-container').addClass('tab-pane fade');
            $('#create-project-container').addClass('active in');
            $('#personal-info-container').removeClass('active'); 
        }
    
    });

   $('#create-project-btn').click(function(){

        var file_data = $("#logoUpload").prop('files')[0];
        var form_data = new FormData();         
        form_data.append('file', file_data);
        //alert(form_data);
         
        if(file_data != null)
        {
            $.ajax({
                url: './php/logoupload.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){
                    //alert(php_script_response); // display response from the PHP script, if any
                }
            });
        }
        form_data.delete('file');

        var error_project_name = '';
        var error_project_bio = '';

        if($.trim($('#project_name').val()).length == 0)
        {
        error_project_name = 'Please enter a name for this project.';
        $('#error_project_name').text(error_project_name);
        }
        else
        {
        error_project_name = '';
        $('#error_project_name').text(error_project_name);
        }

        if($.trim($('#project_bio').val()).length == 0)
        {
        error_project_bio = 'Please enter the names of your group members.';
        $('#error_project_bio').text(error_project_bio);
        }
        else
        {
        error_project_bio = '';
        $('#error_project_bio').text(error_project_bio);
        }
        if(error_project_name != '' || error_project_bio != '')
        {
        return false;
        }
        else
        {  
            $('#create-project-container').addClass('tab-pane fade');
            $('#extra-info-container').addClass('active in');
            $('#create-project-container').removeClass('active'); 
        }
    
    });

    /*$('#encrypt-docs-btn').click(function(){
        $('#extra-info').removeClass('disabled');
        $('#encrypt-docs').removeAttr('href data-toggle');
        $('#encrypt-docs-container').addClass('tab-pane fade');
        $('#extra-info').attr('href', '#encrypt-docs-container');
        $('#extra-info').attr('data-toggle', 'tab');
        $('#extra-info-container').addClass('active in');
        $('#encrypt-docs-container').removeClass('active');
    });*/

});

$("#imageUpload").change(function() {
    readURL(this);
});

var readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.profile-pic').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(".file-upload").on('change', function(){
    readURL(this);
});

$(".upload-button").on('click', function() {
   $(".file-upload").click();
});



    