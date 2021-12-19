<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>InnoVC | File Upload</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicons 
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png"> -->

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

<!-- Stylesheet -->
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="fonts/open-sans.css">
<link rel="stylesheet" type="text/css" href="fonts/raleway.css">
<link rel="stylesheet" type="text/css" href="fonts/lato.css">
<link rel="stylesheet" type="text/css" href="css/origin.css">

<!-- Javscript -->
<script src = "js/fileupload.js"></script>

</head>

<div class="container-file">
  <div class="Modal" id="modal-attach" style = "display: block;">
    <a class="Modal-dismissButton" id = "x" onclick= "return exitFunction();"></a>
    <div class="Modal-heading">
      Attach Files To Publish
    </div>
    <p>
      Choose a file or files to attach.
    </p>

    
    <ul class="FileList">

      <form method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload" class="inputfile"/>
        <label for="fileToUpload"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
          <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
        </label>
        <input type="submit" value="Attach" name="fileToUpload" style="float: right; color: #5ca9bf; background-color: white;">
      </form>


      <?php
      if(isset($_FILES['fileToUpload'])) {
        $name = $_FILES['fileToUpload']['name'];
        $check = filesize($_FILES["fileToUpload"]["tmp_name"]);

        if($check != false) { ?>
          <label class="File" for="file--01">
            <input type="checkbox" class="u-margin-right--small" id="file--01"/>
            <span class="File-name has-Icon"> 
              <?php echo $name ?>           
            </span>
          </label>
      <?php
        } else {
          echo "Error";
        }
      }
      /*else {
        echo "Click the icon to select the file you want to upload and then click 'Upload'.";
      }*/
      ?>
    </ul>


    <div class="u-margin-top--x-large">
      <button class="login100-form-btn2" type = "submit">
        Upload Selected Files
      </button>
    </div>
    <!-- CHECK IF ALL THE FILES ARE GOOD TO GO ON SUBMIT -- THROW ERROR IF FILE EXCEEDS MAX FILE SIZE 
    OR IS NOT A LEGIT FILE OR ISN'T ONE OF THE ACCEPTED FILE TYPES. MOVE THESE FILES TO USER DIRECTORY-->
  </div>

</div>

</html>