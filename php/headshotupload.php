<?php
    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], 'C:/Users/anous/_InnoVC/_Clients/Hulsey/_CodeBase-Hulsey/uploads/' . $_FILES['file']['name']);
        //$headshot = $_FILES['file']['name'];

        $file_name = $_FILES['file']['name'];
        $file_extn = substr($file_name, strrpos($file_name, '.')+1);

        $dir = ("C:/Users/anous/_InnoVC/_Clients/Hulsey/_CodeBase-Hulsey/uploads/");
        if ($file_extn == 'png')
        {
            $dst_name = "headshot.png";
            copy($dir . '/' . $file_name, $dir . '/' . $dst_name); 
        }
        else if ($file_extn == 'jpg')
        {
            $dst_name = "headshot.jpg";
            copy($dir . '/' . $file_name, $dir . '/' . $dst_name); 
        }
        else if ($file_extn == 'jpeg')
        {
            $dst_name = "headshot.jpeg";
            copy($dir . '/' . $file_name, $dir . '/' . $dst_name); 
        }
        else if ($file_extn == 'PNG')
        {
            $dst_name = "headshot.PNG";
            copy($dir . '/' . $file_name, $dir . '/' . $dst_name); 
        }
        else if ($file_extn == 'JPG')
        {
            $dst_name = "headshot.JPG";
            copy($dir . '/' . $file_name, $dir . '/' . $dst_name); 
        }

        unlink ($dir . '/' . $file_name);      //This DELETES the 'uploaded' image file AFTER copying it as 'headshot'
    }

?>