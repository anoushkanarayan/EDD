<?php

    if(isset($_POST['extra-info-btn']))
    {
        // VARIABLES FOR accounts TABLE
        $first_name = $_REQUEST['first_name'];
        $last_name  = $_REQUEST['last_name'];
        $email      = $_REQUEST['email'];
        $password   = $_REQUEST['password'];
        $city       = $_REQUEST['city']; 
        $country    = $_REQUEST['country']; 
        //$profile_picture = ??;


        // VARIABLES FOR projects TABLE
        $project_name = $_REQUEST['project_name'];
        $project_bio  = $_REQUEST['project_bio'];
        $field = $_REQUEST['tags'];
        //$logo = ??;
        $additional_info = $_REQUEST['extra_info'];

        $encrypted_password = md5($password);
        $password = "replace";

        /////////////////////////////////////////////////////////////
        //Create connection to the database
        /////////////////////////////////////////////////////////////
        $servername = "localhost";
        $username = "root";
        $password_mysql = "cutnuch81";
        $dbname = "innovc_db";
        $conn = new mysqli($servername, $username, $password_mysql, $dbname);

        // Check connection
        if(mysqli_connect_error())  {
            die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error());
        }
        else
        {
            $result      = mysqli_query($conn, "SELECT account_num from accounts ORDER BY account_num DESC LIMIT 1");
            $result_proj = mysqli_query($conn, "SELECT project_id from projects ORDER BY project_id DESC LIMIT 1");

            if( $result && $result_proj )
            {
                $result      = mysqli_fetch_array($result);
                $account_num = $result['account_num'];
                $result_proj = mysqli_fetch_array($result_proj);
                $project_id  = $result_proj['project_id'];
            }
        }

        //Increment the account_num so that it is ready for insertion
        $account_num += 1;
        //printf("Last account_num: %d    \n", (int)$account_num);
        $project_id  += 1;
        //printf("Last project_id: %d\n", (int)$project_id);


        ///////////////////////////////////////////////////////////////////
        // Generate requisite directory and files for the Account
        ///////////////////////////////////////////////////////////////////
        $dir = ("c:/Users/anous/_InnoVC/_Clients/Hulsey/_CodeBase-Hulsey/user_accounts/" . $first_name . $last_name . $account_num);
        //echo ($dir);
        $userfile    = ($dir . "/" . $first_name . $last_name . $account_num . ".php");
        $projectfile = ($dir . "/" . $project_name . $project_id . ".php");


        // Uploaded files are in the directory -- 'imglogosrc'
        $imglogosrc = ("c:/Users/anous/_InnoVC/_Clients/Hulsey/_CodeBase-Hulsey/uploads/");  
        
        $srcdir      = opendir($imglogosrc);           // Open the directory 
        $headshotfile= NULL;
        $logofile    = NULL;
        $headshot_extn = NULL;
        $logo_extn   = NULL;
        while( $file = readdir($srcdir) )              // Loop through the files in source directory (ONLY TWO FILES)
        {  
            $file_name = substr($file, 0, strrpos($file, "."));
            $file_extn = substr($file, strrpos($file, '.')+1);
            
            if ( $file_name == 'headshot')  {
                $headshotfile = ($dir . "/" . $file);
                $headshot_extn = substr($file, strrpos($file, '.')+1);
            }
            if ( $file_name == 'logo')  { 
                $logofile     = ($dir . "/" . $file);
                $logo_extn   = substr($file, strrpos($file, '.')+1);
            }
        }  
        closedir($srcdir); 
        
        // PUT FILE PATH INTO DATABASE
        $new_entry = "INSERT INTO accounts (`account_num`,`first_name`, `last_name`, `email`, `password`, `file`, `headshot`, `city`, `country`)  
                    VALUES ('$account_num', '$first_name', '$last_name', '$email', '$encrypted_password', '$userfile', '$headshotfile', '$city', '$country')";
        
        $project_entry = "INSERT INTO projects (`project_id`, `owner_email`, `project_name`, `field`, `project_desc`, `logo`, `additional_info`, `project_file`)  
                    VALUES ('$project_id', '$email', '$project_name', '$field', '$project_bio', '$logofile', '$additional_info', '$projectfile')";

        if (mysqli_query($conn, $new_entry) && mysqli_query($conn, $project_entry))
        {
            mkdir($dir, 7);
            $handle = fopen($userfile, "w");
            fclose($handle);
            $handle = fopen($projectfile, "w");
            fclose($handle);
            custom_copy($imglogosrc, $dir); 

            foreach(glob($imglogosrc .'/*.*') as $file) {
                unlink ($file);
            }
            
            session_set_cookie_params(0);
            session_start();
            $_SESSION['userEmail'] = $email;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['acc_num'] = $account_num;
            //$_SESSION['proj_id'] = $project_id;

        } 
        else 
        {
            echo("Error: " . $new_entry . "<br>" . mysqli_error($conn));
        }

        mysqli_close($conn);
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

    $projectbox = "<div class=\"p-l-500\">
    <a href = \"../user_accounts/" . $first_name . $last_name . $account_num . "/" . $project_name . $project_id . ".php\">
      <div class=\"row\">
        <div class=\"project-column-catalog\">
          <div class = \"col-md-6\">
            <img class = \"project-square\" src = \"../user_accounts/" . $first_name . $last_name . $account_num . "/logo." . $logo_extn . "\"/>
          </div>
          <div class = \"project-minicontainer-catalog\"> <br/>
            <div class = \" col-md-6 project-text-catalog\">
              <p6 style = \" -webkit-box-decoration-break: clone; box-decoration-break: clone; \">" . $project_name . "</p6> <br/> 
              <p7 style = \" -webkit-box-decoration-break: clone; box-decoration-break: clone; \">" . $project_bio . "</p7><br/>
              <p8>" . $field . "</p8><br/><br/>
              <p2><div class = \"projectdescription-text\"><b>Project Description:</b> " . $additional_info . "</div></p2>
            </div>
          </div>
        </div>
      </div>
    </a>
    </div><br/>";

    $addToCatalog = fopen("catalog.php", "a"); //opens file in append mode  
    fwrite($addToCatalog, $projectbox);  
    fclose($addToCatalog);

    $userphp = "<!DOCTYPE html>
    <html lang=\"en\">
    <head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>InnoVC | My Account</title>
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    
    <?php include \"../../php/_header-user.php\"; ?>
    
      <div class=\"col-md-6 col-sm-6 p-t-125 p-l-150 m-b-16\">
        <div class=\"row\">
          <div class=\"account-column\">
            <img id=\"headshot\" class = \"account-square\" src = \"../../temp_accounts/" . $first_name . $last_name . $account_num . "/headshot." . $headshot_extn . "\"/><br>
            <div class = \"account-minicontainer\"> <br/>
              <p3 style = \"-webkit-box-decoration-break: clone; box-decoration-break: clone; \">" . $first_name . " " .  $last_name . "</p3> <br/>
              <p4 style = \"-webkit-box-decoration-break: clone; box-decoration-break: clone; \">" . $city . ", " . $country . "</p4><br/><br/>
              <div style=\"padding-left: 10px; font-weight: bold;\">Open Projects</div>
              <img id=\"one\" src=\"../../img/one-icon.png\" style = \"height: 25px; position: relative; bottom: 24px; right: 10px; float: right;\"><br/>
             </div>
          </div>
        </div>    
      </div>
    
        <div class=\"p-t-125\">
          <p9> Open Projects </p9><br/>
          <img id=\"one\" src=\"../../img/one-icon.png\" style = \"height: 40px; position: relative; bottom: 38px; left: 5px;\">
          <a href = \"../../temp_accounts/". $first_name . $last_name . $account_num . "/" . $project_name . $project_id. ".php\">
            <div class=\"row\">
              <div class=\"project-column\">
                <div class = \"col-md-6\">
                  <img class = \"project-square\" src = \"../../temp_accounts/" . $first_name . $last_name . $account_num . "/logo." . $logo_extn . "\"/>
                </div>
                <div class = \"project-minicontainer\"> <br/>
                  <div class = \" col-md-6 project-text\">
                    <p6 style = \" -webkit-box-decoration-break: clone; box-decoration-break: clone; \">" . $project_name . "</p6> <br/> 
                    <p8 style = \" -webkit-box-decoration-break: clone; box-decoration-break: clone; \">" . $project_bio . "</p8><br/>
                    <p8>" . $field . "</p8><br/><br/>
                    <p2><div class = \"projectdescription-text\"><b>Project Description:</b> " . $additional_info . "</div></p2>
                    <!--Two Lines of project description + Read More button-->
                  </div>
                </div>
              </div>
            </div> 
          </a>
        </div>
    </html>";

    file_put_contents($userfile, $userphp);

    $projectphp = "<!DOCTYPE html>
    <html lang=\"en\">
    <head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>InnoVC | My Account</title>
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    
    <?php include \"../../php/_header-user.php\" ?>
    
      <div class=\"col-md-6 col-sm-6 p-t-125 p-l-150 m-b-16\">
        <div class=\"row\">
          <div class=\"projectpage-column\">
            <img id=\"logo-project\" class = \"projectpage-square\" src = \"../../user_accounts/" . $first_name . $last_name . $account_num . "/logo." . $logo_extn . "\"/>
            <div class = \"projectpage-minicontainer\"> <br/>
              <p3 style = \" -webkit-box-decoration-break: clone; box-decoration-break: clone; \">" . $project_name . "</p3><br/>
              <p4 style = \" -webkit-box-decoration-break: clone; box-decoration-break: clone; \">" . $project_bio . "</p4><br/>
              <div style=\"padding-left: 10px; font-weight: bold; -webkit-box-decoration-break: clone; box-decoration-break: clone;\">" . $field . "</div><br/>
            </div>
          </div>
        </div>    
      </div>
    
      <div class=\"p-t-125\">
        <p9>" . $project_name . "</p9><br/><br/>
        <div class=\"row\">
          <div class=\"projectcontainer-column\">
            <div class = \"projectcontainer-minicontainer\">
              <div class = \"projectcontainer-text\">
                <p7>Project Description</p7><br/><br/>
                <p2>" . $additional_info . "</p2><br/><br/>
                <p7>Links</p7><br/><br/>
                <!-- Links must be in https://www.google.com format-->
                <a href=\"javascript:void(0)\" onclick=\"return linkPopUp();\">Click here to upload a link to this project.</a><br/><br/>
                
                <p7>Files</p7><br/><br/>
                <a href=\"javascript:void(0)\" onclick=\"return filePopUp();\">Click here to upload a file to this project.</a>
                
              </div>
            </div>
          </div>
        </div>    
      </div>
    
      <div style=\"visibility: hidden;\" id = \"linkpopup\">
        <div class=\"Modal\" id=\"modal-attach-link\" style = \"display: block;\">
          <a class=\"Modal-dismissButton\" id = \"x\" onclick= \"return linkFullExitFunction();\"></a>
          <div class=\"Modal-heading\" style = \"color:#333\">
                <b>Links</b>
          </div><br/>
          <form method=\"post\"> <!--action = \"project-linkupload.php\"-->
            <p>
              Name
            </p>
            <input type=\"text\" name=\"linkname\" id=\"linkname\" /></br></br>
            <p>
              Link
            </p>
            <input type=\"text\" name=\"link\" id=\"link\" />
          </form>
          <div class=\"u-margin-top--x-large\">
          <button class=\"login100-form-btn2\" id = \"link-upload-btn\" type = \"submit\" onclick= \"return linkExitFunction();\">
              Upload Link
          </button>
          </div>
          <!-- PUT LINK IN DATABASE -->
        </div>
      </div>
    
      <div style=\"visibility: hidden;\" id = \"popup\">
        <div class=\"Modal\" id=\"modal-attach-file\" style = \"display: block;\">
            <a class=\"Modal-dismissButton\" id = \"x\" onclick= \"return exitFullFunction();\"></a>
            <div class=\"Modal-heading\" style = \"color:#333;\">
                <b>Attach Files</b>
            </div>
            <p>
                Choose the files you would like to attach.
            </p>
            
    
            <ul class=\"FileList\">
              <form method=\"post\" enctype=\"multipart/form-data\">
                <file id=\"projfile\"/>
                <input type=\"file\" name=\"fileProjectPage\" id=\"fileProjectPage\" class=\"inputfile\" onchange=\"document.getElementById('projfile').src = window.URL.createObjectURL(this.files[0])\"/>
                <label for=\"fileProjectPage\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"17\" viewBox=\"0 0 20 17\">
                  <path d=\"M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z\"></path></svg>
                </label>
                <!-- <input type=\"submit\" value=\"attach\" name=\"fileProjectPage\" style=\"float: right; color: #5ca9bf; background-color: white;\"> -->
                <button type=\"button\" name=\"attach\" style=\"float: right; color: #5ca9bf; background-color: white;\" id = \"attach\">Attach</button> 
              </form>
              <div id = \"phpoutput\"></div>
            </ul>
    
            <div class=\"u-margin-top--x-large\">
              <a class=\"login100-form-btn2\" type=\"button\" href=\"../../php/project-fileupload.php\">Upload Files</a>
            </div>
            <!-- CHECK IF ALL THE FILES ARE GOOD TO GO ON SUBMIT -- THROW ERROR IF FILE EXCEEDS MAX FILE SIZE 
            OR IS NOT A LEGIT FILE OR ISN'T ONE OF THE ACCEPTED FILE TYPES. MOVE THESE FILES TO USER DIRECTORY-->
        </div>
      </div>
    
    </body>
    
    </html>";

    file_put_contents($projectfile, $projectphp);

    // copy directory - temp accounts
    $src = ("c:/Users/anous/_InnoVC/_Clients/Hulsey/_CodeBase-Hulsey/user_accounts/" . $first_name . $last_name . $account_num);
    $dst = ("c:/Bitnami/wampstack-7.4.9-0/apache2/htdocs/temp_accounts/" . $first_name . $last_name . $account_num);  
    custom_copy($src, $dst); 

    // copy directory - user accounts
    $src2 = ("c:/Users/anous/_InnoVC/_Clients/Hulsey/_CodeBase-Hulsey/user_accounts/" . $first_name . $last_name . $account_num);
    $dst2 = ("c:/Bitnami/wampstack-7.4.9-0/apache2/htdocs/user_accounts/" . $first_name . $last_name . $account_num); 
    custom_copy($src2, $dst2);

    //copy directory - catalog
    $src3 = ("c:/Bitnami/wampstack-7.4.9-0/apache2/htdocs/php");  
    $dst3 = ("c:/Users/anous/_InnoVC/_Clients/Hulsey/_CodeBase-Hulsey/php");
    custom_copy($src3, $dst3);

    header("Location: http://innovc.io/temp_accounts/" . $first_name . $last_name . $account_num . "/" . $first_name . $last_name . $account_num . ".php");

?>