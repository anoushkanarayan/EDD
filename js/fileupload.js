
$(document).ready(function(){
    
    $('#attach').click(function(){

        var file_data = $("#fileProjectPage").prop('files')[0];
        var form_data = new FormData();                  
        form_data.append('file', file_data);

        if(file_data != null)
        {
            //alert("Hiiiiiiiiii");
            $.ajax({
                url: '../../php/project-fileupload.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(response){
                    //alert(response); // display response from the PHP script, if any
                    $("#phpoutput").append(response);
                }
            });
        } 
        form_data.delete('file');
    });


    $('#link-upload-btn').click(function(){

        var linkname = $("#linkname").val();
        var link     = $("#link").val();

        if(linkname != null && link != null)
        {
            $.ajax({
                url: '../../php/project-linkupload.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                data: {one: linkname, two: link},                         
                type: 'POST',
                success: function(response){
                    document.location.reload(true);
                    //alert(response); // display response from the PHP script, if any
                }
            }); 
        } 
    });

    /* $('#file-upload-btn').click(function(){

        var file = $("#linkname").val(); // WHAT GOES HERE?

        if(linkname != null && link != null)
        {
            $.ajax({
                url: '../../project-fileupload.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                data: {one: file},                         
                type: 'POST',
                success: function(response){
                    document.location.reload(true);
                    //alert(response); // display response from the PHP script, if any
                }
            }); 
        } 
    });*/

});


var style = document.createElement('style');
var css_rules_num = style.cssRules.length;

function exitFunction() {
    var fileclose = document.getElementById("modal-attach-file");
    fileclose.style.visibility = "hidden";
    style.sheet.deleteRule(css_rules_num);
}

function exitFullFunction() {
    var fileclose = document.getElementById("modal-attach-file");
    fileclose.style.visibility = "hidden";
    style.sheet.deleteRule(css_rules_num);
    document.location.reload(true);
}

function linkExitFunction() {
    var linkclose = document.getElementById("modal-attach-link");
    linkclose.style.visibility = "hidden";
    style.sheet.deleteRule(css_rules_num);
}

function linkFullExitFunction() {
    var linkclose = document.getElementById("modal-attach-link");
    linkclose.style.visibility = "hidden";
    style.sheet.deleteRule(css_rules_num);
    document.location.reload(true);
}

function filePopUp() {
    var popup = document.getElementById("popup");
    popup.style.visibility = "visible";

    document.head.appendChild(style);
    style.sheet.insertRule('body > *:not(#popup) {filter: blur(20px)}', css_rules_num)
}

function linkPopUp() {
    var linkpopup = document.getElementById("linkpopup");
    linkpopup.style.visibility = "visible";

    document.head.appendChild(style);
    style.sheet.insertRule('body > *:not(#linkpopup) {filter: blur(20px)}', css_rules_num);
}


