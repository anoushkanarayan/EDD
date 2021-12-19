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
  <div class="Modal" id="modal-attach-link" style = "display: block;">
    <a class="Modal-dismissButton" id = "x" onclick= "return linkExitFunction();"></a>
    <div class="Modal-heading">
        Links
    </div><br/>
    <form method="post">
      <p>
        Name
      </p>
      <input type="text" name="linkname" id="linkname" /></br></br>
      <p>
        Link
      </p>
      <input type="text" name="link" id="link" />
      </form>
      <div class="u-margin-top--x-large">
      <button class="login100-form-btn2" type = "submit" onclick= "return linkExitFunction();">
          Upload Links
      </button>
      </div>
        <!-- CHECK IF ALL THE FILES ARE GOOD TO GO ON SUBMIT -- THROW ERROR IF FILE EXCEEDS MAX FILE SIZE 
        OR IS NOT A LEGIT FILE OR ISN'T ONE OF THE ACCEPTED FILE TYPES. MOVE THESE FILES TO USER DIRECTORY-->
  </div>
</div>

</html>