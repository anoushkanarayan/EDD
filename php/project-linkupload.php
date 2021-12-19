<?php

    session_start();

    $linkname = $_POST['one'];
    $link     = $_POST['two']; 
    //$projectname = $_POST['three'];

    $_SESSION['linkname'] = $linkname;
    $_SESSION['link'] = $link;
    
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
        $email = $_SESSION['userEmail'];
        $email = trim($email);
        $sql   = "SELECT * FROM projects WHERE owner_email = '$email'";

        
        if ( $result_proj = mysqli_query($conn, $sql) ) {
            //echo mysqli_num_rows($result_proj);

            while ($row = mysqli_fetch_row($result_proj))
            {
                //echo $linkname;
                $addlink = "UPDATE projects SET link_name= '$linkname', link= '$link' WHERE owner_email = '$email'";
                mysqli_query($conn, $addlink);

                //if (mysqli_query($conn, $addlink) )   echo "Done";
                //else                                  echo "NOT Done";  
            }
        }
        mysqli_free_result($result_proj);      // Free $result_proj array
    } 

    $sql         = "SELECT * FROM accounts WHERE email = '$email'";
    $result_acc  = mysqli_query($conn, $sql);
    $row         = mysqli_fetch_row($result_acc);
    $account_num = $row[0];
    $first_name  = $row[1];
    $last_name   = $row[2];
    mysqli_free_result($result_acc);       // Free $result_acc  array

    $sql             = "SELECT * FROM projects WHERE owner_email = '$email'";
    $result_proj     = mysqli_query($conn, $sql);
    $row             = mysqli_fetch_row($result_proj);
    $project_id      = $row[0];
    $project_name    = $row[2];
    $project_bio     = $row[4];
    $field           = $row[3];
    $additional_info = $row[6];
    $file_name    = $row[11];
    mysqli_free_result($result_proj);      // Free $result_proj array
    
    mysqli_close($conn);

    $dir = ("c:/Users/anous/_InnoVC/_Clients/Hulsey/_CodeBase-Hulsey/user_accounts/" . $first_name . $last_name . $account_num);
    $fileToReplace = ($dir . "/" . $project_name . $project_id . ".php");
    $dir2 = ("../user_accounts/" . $first_name . $last_name . $account_num);
    $fileToReplace2 = ($dir2 . "/" . $project_name . $project_id . ".php");
    $tmp_projectfile = ("../temp_accounts/". $first_name . $last_name . $account_num . "/" . $project_name . $project_id . ".php");

    $srcdir = ("../temp_accounts/" . $first_name . $last_name . $account_num);
    $dstdir = ("c:/Users/anous/_InnoVC/_Clients/Hulsey/_CodeBase-Hulsey/user_accounts/" . $first_name . $last_name . $account_num);
    copy($srcdir, $dstdir);


    $projectphpnofile = "<!DOCTYPE html>
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
            <img id=\"logo-project\" class = \"projectpage-square\" src = \"../../user_accounts/" . $first_name . $last_name . $account_num . "/logo.jpg\"/>
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
                <a target=\"_blank\" rel=\"noopener noreferrer\" href=\"" . $link . "\"><p2>" . $linkname . "</p2></a></br>
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

    $projectphpwithfile = "<!DOCTYPE html>
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
            <img id=\"logo-project\" class = \"projectpage-square\" src = \"../../user_accounts/" . $first_name . $last_name . $account_num . "/logo.jpg\"/>
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
                <a target=\"_blank\" rel=\"noopener noreferrer\" href=\"" . $link . "\"><p2>" . $linkname . "</p2></a></br>
                <a href=\"javascript:void(0)\" onclick=\"return linkPopUp();\">Click here to upload a link to this project.</a><br/><br/>
                
                <p7>Files</p7><br/><br/>
                <a target=\"_blank\" rel=\"noopener noreferrer\" href=\"./" . $file_name . "\"><p2>" . $file_name . "</p2></a><br/>
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

    if ($file_name == NULL)
    {
        file_put_contents($tmp_file, $filephpnolink);
        file_put_contents($fileToReplace, $filephpnolink);
        file_put_contents($fileToReplace2, $filephpnolink);
    }
    else
    {
        file_put_contents($tmp_file, $filephpwithlink);
        file_put_contents($fileToReplace, $filephpwithlink);
        file_put_contents($fileToReplace2, $filephpwithlink);
    }

    $dst = ("../temp_accounts/". $first_name . $last_name . $account_num . "/" . $project_name . $project_id . ".php");
    header("location: $dst") ;
?>