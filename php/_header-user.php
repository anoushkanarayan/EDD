<?php session_start(); ?>

<?php if(isset($_SESSION['userEmail']))
{ ?>

  <!-- Favicons 
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png"> -->

  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../../fonts/font-awesome/css/font-awesome.css">

  <!-- Stylesheet -->
  <link rel="stylesheet" type="text/css" href="../../css/style.css">
  <link rel="stylesheet" type="text/css" href="../../fonts/open-sans.css">
  <link rel="stylesheet" type="text/css" href="../../fonts/raleway.css">
  <link rel="stylesheet" type="text/css" href="../../fonts/lato.css">
  <link rel="stylesheet" type="text/css" href="../../css/origin.css">

  <!-- Javascript -->
  <script src = "../../js/jquery.1.11.1.js"></script>
  <script src = "../../js/fileupload.js"></script>
  <script src = "../../js/scoped.js"></script>

  </head>
  <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
  <!-- Navigation -->
  <nav id="menu" class="navbar navbar-default navbar-fixed-top">
    <div class="container"> 
      
      <!-- NAVBAR -->
      <div class="navbar-header">
        <a href="../../php/index.php"><img src="../../img/logo_original.png" width = "200" alt=""></a> 
      </div>
      
      <!-- NAVBAR -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="http://innovc.io/php/catalog.php" class="page-scroll"><b>Catalog</b></a></li>
          <li><a href="../../temp_accounts/<?php echo $_SESSION['first_name'] . $_SESSION['last_name'] . $_SESSION['acc_num'];?>/<?php echo $_SESSION['first_name'] . $_SESSION['last_name'] . $_SESSION['acc_num'];?>.php" class="page-scroll"><b>My Account</b></a></li>
          <li><a href="../../php/logout.php" class="page-scroll"><b>Logout</b></a></li>
        </ul>
      </div>
      
      <!-- /.navbar-collapse --> 
    </div>
  </nav>
<?php } 

else
{ ?>
    <!-- Favicons 
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png"> -->

  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../../fonts/font-awesome/css/font-awesome.css">

  <!-- Stylesheet -->
  <link rel="stylesheet" type="text/css" href="../../css/style.css">
  <link rel="stylesheet" type="text/css" href="../../fonts/open-sans.css">
  <link rel="stylesheet" type="text/css" href="../../fonts/raleway.css">
  <link rel="stylesheet" type="text/css" href="../../fonts/lato.css">
  <link rel="stylesheet" type="text/css" href="../../css/origin.css">

  <!-- Javascript -->
  <script src = "../../js/jquery.1.11.1.js"></script>
  <script src = "../../js/fileupload.js"></script>
  <script src = "../../js/scoped.js"></script>

  </head>
  <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
  <!-- Navigation -->
  <nav id="menu" class="navbar navbar-default navbar-fixed-top">
    <div class="container"> 
      
      <!-- NAVBAR -->
      <div class="navbar-header">
        <a href="../../php/index.php"><img src="../../img/logo_original.png" width = "200" alt=""></a> 
      </div>
      
      <!-- NAVBAR -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="http://innovc.io/services.html" class="page-scroll"><b>About</b></a></li>
          <li><a href="http://innovc.io/php/catalog.php" class="page-scroll"><b>Catalog</b></a></li>
          <li><a href="http://innovc.io/php/login-main.php" class="page-scroll"><b>Log In</b></a></li>
        </ul>
      </div>
      
      <!-- /.navbar-collapse --> 
    </div>
  </nav>
<?php } ?>

    