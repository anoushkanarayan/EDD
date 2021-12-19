<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InnoVC | Login</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css"  href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script  src="../js/login-download-a.js"></script>
    <script  src="../js/login-download-b.js"></script>
    <script  src="../js/login.js"></script>

</head>
<body>
    <script type="text/javascript">
        //window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13)
        //{if(e.target.nodeName=='INPUT'&&e.target.type=='text'){e.preventDefault();return false;}}},true);
        
        window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13)
        {if(e.target.nodeName=='INPUT'){e.preventDefault();return false;}}},true);
    </script>


    <!-- SOURCE: https://codepen.io/uiswarup/pen/ExYvPEe Thanks, Man!-->
    <div class="main-bg">
        <div class="box-conatiner-login">
            <div id="a">
                <div class="circle-ripple"></div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6"></div>
                <div class="col-sm-6 col-md-6">
                    <div class="wrap-login100">
                        <span class="login100-form-title">
                            <h4>Welcome Back!</h4>
                        </span>
                        <form action = "login.php" method="post" class="login100-form validate-form p-l-55 p-r-55 p-t-20">
                            <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
                                <input class="input100" type="username" name="username" id = "username" placeholder="Email Address" />
                                <p id="error_username" class="text-danger"></p>
                            </div>
                            <?php
                            if (isset($_GET['error']))
                            {
                                if ($_GET['error'] == "notfound")
                                {
                                    echo '<p class = "has-error text-danger"> Account not found. </p>';
                                }
                            }
                            ?>
                            <div class="wrap-input100 validate-input" data-validate="Please enter password">
                                <input class="input100" type="password" name="password" id = "password" placeholder="Password" />
                                <p id="error_password" class="text-danger"></p>
                            </div>
                            <?php
                            if (isset($_GET['error']))
                            {
                                if ($_GET['error'] == "incorrectpassword")
                                {
                                    echo '<p class = "has-error text-danger"> Password is incorrect. </p>';
                                }
                            }
                            ?>
                            <div class="container-login100-form-btn p-t-20" id = "login_btn">
                                <button class="login100-form-btn"  id = "login_btn"  type = "submit" name = "submit">
                                    <h6>Sign in</h6>
                                </button>
                            </div>
                            <div class="flex-col-c p-t-140 p-b-40">
                                <span class="txt1 p-b-9">
                                    <center>Don’t have an account? <a href="./openproject.php" class="txt2"> Create one here. </a></center><br>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>