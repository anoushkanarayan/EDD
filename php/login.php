
<?php

    if(isset($_POST['submit']))
    {
        $email              = $_REQUEST['username'];
        $password           = $_REQUEST['password'];

        $encrypted_password = md5($password);
        $password           = "replace";
        
        
        $servername         = "localhost";
        $username           = "root";
        $password_mysql     = "cutnuch81";
        $dbname             = "innovc_db";

        // Create connection
        $conn = new mysqli($servername, $username, $password_mysql, $dbname);

        // Check connection
        if(mysqli_connect_error())  {
            die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error());
        }
        else
        {
            $email = trim($email);
            $sql = "SELECT * FROM accounts WHERE email = '$email'";
            //$sqli = "SELECT * FROM investors WHERE email = '$email'";

            if ($result = mysqli_query($conn, $sql))
            {   
                if ($row = mysqli_fetch_row($result))
                {
                    //print_r($row);
                    //printf ("%s   \n", $row[4] );
                    $match_password = $row[4];
                    $first_name = $row[1];
                    $last_name = $row[2];
                    $account_num = $row[0];

                    if ($match_password == $encrypted_password)
                    {
                        session_start();
                        $_SESSION['userEmail'] = $email;
                        $_SESSION['first_name'] = $first_name;
                        $_SESSION['last_name'] = $last_name;
                        $_SESSION['acc_num'] = $account_num;

                        // copy directory
                        $src = ("c:/Users/anous/_InnoVC/_Clients/Hulsey/_CodeBase-Hulsey/user_accounts/" . $row[1] . $row[2] . $row[0]);
                        $dst = ("c:/Bitnami/wampstack-7.4.9-0/apache2/htdocs/temp_accounts/" . $row[1] . $row[2] . $row[0]);  
                        custom_copy($src, $dst); 
                        
                        $dst = ("../temp_accounts/". $row[1] . $row[2] . $row[0] . "/" . $row[1] . $row[2] . $row[0] . ".php");
                        mysqli_close($conn);
                        header("location: $dst") ;
                    }
                    else
                    {
                        header("Location: ./login-main.php?error=incorrectpassword");
                        exit();
                    }
                }
                else 
                {
                    header("Location: ./login-main.php?error=notfound");
                    exit();
                }
            }
            /*if ($result = mysqli_query($conn, $sqli))
            {
                if ($row = mysqli_fetch_row($result))
                {
                    //print_r($row);
                    //printf ("%s   \n", $row[4] );
                    $match_password = $row[4];
                    $first_name = $row[1];
                    $last_name = $row[2];
                    $account_num = $row[0];

                    if ($match_password == $encrypted_password)
                    {
                        session_set_cookie_params(0);
                        session_start();
                        $_SESSION['userEmail'] = $email;
                        $_SESSION['first_name'] = $first_name;
                        $_SESSION['last_name'] = $last_name;
                        $_SESSION['acc_num'] = $account_num;
                        $_SESSION['investor'] = "set";

                        // copy directory
                        //$src = ("c:/Users/anous/_InnoVC/_CodeBase-InnoVC/investor_accounts/" . $row[1] . $row[2] . $row[0]);
                        //$dst = ("c:/Apache24/htdocs/InnoVC/temp_accounts/" . $row[1] . $row[2] . $row[0]);  
                        //custom_copy($src, $dst); 

                        //copy directory
                        $src2 = ("c:/Users/anous/_InnoVC/_Clients/Hulsey/_CodeBase-Hulsey/user_accounts/");
                        $dst2 = ("c:/Apache24/htdocs/EDD-Final-Presentations/temp_accounts/"); 
                        custom_copy($src2, $dst2);
                        
                        $dst = ("../temp_accounts/". $row[1] . $row[2] . $row[0] . "/" . $row[1] . $row[2] . $row[0] . ".php");
                        mysqli_close($conn);
                        header("location: $dst") ;
                    }
                    else
                    {
                        header("Location: ./login-main.php?error=incorrectpassword");
                        exit();
                    }
                }
                else 
                {
                    header("Location: ./login-main.php?error=notfound");
                    exit();
                }
            }*/
        }
    }


    // FUNCTION TO COPY DIRECTORY INTO NEW LOCATION
    function custom_copy($src, $dst) 
    {  
        // Open the source directory 
        $dir = opendir($src);  
        // Make the destination directory if not exist 
        @mkdir($dst, 6);  
    
        // Loop through the files in source directory 
        while( $file = readdir($dir) ) 
        {  
            if (( $file != '.' ) && ( $file != '..' )) {  
                if ( is_dir($src . '/' . $file) )  
                {  
                    // Recursively calling custom copy function 
                    // for sub directory  
                    custom_copy($src . '/' . $file, $dst . '/' . $file);  
                }  
                else {  
                    copy($src . '/' . $file, $dst . '/' . $file);  
                }  
            }  
        }  
        closedir($dir); 
    }  
            
    
?>